<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\ConektaCustomer;
use App\Carrito;
use App\Pago;
use App\Venta;
use App\VentaDetalle;
use App\Notificaciones;


/**
 * Clase para manejar los pagos
 * 
 */
// TODO: validar la existencia y meterla al proceso
class PagosController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Sumar los valores de un carrito
     *
     * @param Carrito[] $carrito
     * @return int $response
     */
    public function sumarcarrito($carrito){
        $response = 0;
        
        foreach($carrito as $item){
            $response += ($item->Producto->precio * $item->cantidad);
        }
        return $response;
    }

    /**
     * Muestra el formulario de pago
     *
     * @return void
     */
    public function index(){
        $error = session('error');
        $user = Auth::user();
        $carrito = Carrito::where('idusuario', $user->id)->get();
        
        $data = [
            'total' => $this->sumarcarrito($carrito),
        ];
        
        return view('pagos.create', compact(["user", "carrito", "data", "error"]));
    }
    
    /**
     * Undocumented function
     *
     * @param [type] $carrito
     * @return bool
     */
    public function revisarExistencia($carrito){

        return true;
    }


    /**
     * Undocumented function
     *
     * @param [type] $carrito
     * @return void
     */
    public function convertCarritoVenta($carrito,$pago){
        $venta = Venta::create([
            'idusuario' => Auth::user()->id,
            'fecha'=> \Carbon\Carbon::now()->toDateTimeString(),
            'idpago'=> $pago->id,
        ]);
        
        if($venta){
            foreach($carrito as $item){
                //$response += ($item->Producto->precio * $item->cantidad);
                $ventadetalle = VentaDetalle::create([
                    'idventa' => $venta->id,
                    'idproducto'=> $item->idproducto,
                    'cantidad' => $item->cantidad,
                    'precio'=> $item->Producto->precio,
                    'fecha' => \Carbon\Carbon::now()->toDateTimeString()
                ]);

                if($ventadetalle){
                    $item->delete();
                }
            }
        }
    }
    
    //
    /**
     * Procesar el pago,
     * crear venta
     *
     * @return void
     */
    public function Pay(Request $request){
        $data = $request->all();
        $user = Auth::user();
        $carrito = Carrito::where('idusuario', $user->id)->get();
        $response = $this->CreateOrder($data, $carrito);


        //despues de crear la orden almacenar la venta
        if ($response['status']) {
            $pago = Pago::create([
                'idusuario' => $user->id,
                'conekta_order' => $response['order']->id,
            ]);

            // datos de venta, venta detalle y descuentos de inventario
            $this->convertCarritoVenta($carrito, $pago);
        }

        return redirect('pagos')->with(["error"=>$response['error']]);
    }

    public function CreateOrder($data, $carrito){
        \Conekta\Conekta::setApiKey(env('CONEKTA_PRIVATE_KEY', "no hay crack"));
        \Conekta\Conekta::setApiVersion("2.0.0");
        $response = [
            "status" => false,
            "order"=> null,
            "error" => "no hay error"
        ];

        $user = Auth::user();
        $customer_id = null;

        $customer = ConektaCustomer::where('idusuario', $user->id)->first();

        if ($customer) {
            //dd($customer);
            $customer_id = $customer->conekta_customer;
            $customer_response = [
                'status'=>true,
            ];
        }else{
            $customer_response = $this->CreateCustomer([
                "name"=>$data['name'],
                "email"=>$data['email'],
                "token"=>$data['conektaTokenId'],
            ]);

            if($customer_response['status']){
                $customer_id = $customer_response['customer']->id;
                ConektaCustomer::create([
                    'idusuario'=>$user->id,
                    'conekta_customer'=>$customer_id,
                ]);
            }
        }

        if($customer_response['status']){
            try{
                $orderData = array(
                    #"amount"=>$data['total'],
                    "line_items" => array(
                        array(
                            "name" => $data['description'],
                            "unit_price" => $data['total']*100, //se multiplica por 100 conekta
                            "quantity" => 1
                        )//first line_item
                    ), //line_items
                    "currency" => "MXN",
                    "customer_info" => array(
                        "customer_id" => $customer_id
                    ), //customer_info
                    "charges" => array(
                        array(
                            "payment_method" => array(
                                "type" => "default"
                            ) 
                        ) //first charge
                    ) //charges
                );//order
                
                $order = \Conekta\Order::create(
                    $orderData
                );
                $response['status'] = true;
                $response['order'] = $order;
            } catch (\Conekta\ProcessingError $error){
                $response['error']=$error->getMessage();
            } catch (\Conekta\ParameterValidationError $error){
                $response['error']=$error->getMessage();
            } catch (\Conekta\Handler $error){
                $response['error']=$error->getMessage();
            }

        }else{
            $response['error'] = $customer_response['error'];
        }

        return $response;
    }



    public function CreateCustomer($data){
        \Conekta\Conekta::setApiKey(env('CONEKTA_PRIVATE_KEY', "no hay crack"));
        \Conekta\Conekta::setApiVersion("2.0.0");
        $response = [
            "status" => false,
            "customer"=> null,
            "error" => null
        ];

        try {
            $customer = \Conekta\Customer::create(
                array(
                    "name" => $data['name'],
                    "email" => $data['email'],
                    //"phone" => "+52181818181",
                    "payment_sources" => array(
                        array(
                            "type" => "card",
                            "token_id" => $data['token']
                        )
                    )//payment_sources
                )//customer
            );
            $response['status'] = true;
            $response['customer'] = $customer;
        } catch (\Conekta\ProccessingError $error){
            $response['error']=$error->getMesage();
            return false;
        } catch (\Conekta\ParameterValidationError $error){
            $response['error']=$error->getMessage();
        } catch (\Conekta\Handler $error){
            $response['error']=$error->getMessage();
        }

        return $response;
    }
}
