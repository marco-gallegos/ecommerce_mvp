<?php

namespace Tests\Feature\Http\API\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Productos;
use App\User;

class ProductosControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_stores_productos_api()
    {
        $productos = factory(Productos::class)->make();
        $data = $productos->attributesToArray();
        $response = $this->json('POST','api/productos',$data);
        $response->assertStatus(201)->assertJson(['created_at'=>true]);
    }

    /**
     * @test
     */
    public function it_updates_productos_api()
    {
        $productos = factory(Productos::class)->create();
        $data = factory(Productos::class)->make()->attributesToArray();
        $response = $this->json('PUT','api/productos/'.$productos->id,$data);
        $response->assertStatus(200)->assertJson(['updated_at'=>true]);
    }

    /**
     * @test
     */
    public function it_destroys_productos_api()
    {
        $productos = factory(Productos::class)->create();
        $response = $this->json('DELETE','api/productos/'.$productos->id);
        $response->assertStatus(200)->assertJson(['deleted_at'=>true]);
        $productos->refresh();
        $this->assertDatabaseMissing('productos',['id' => $productos->id]);

    }
}
