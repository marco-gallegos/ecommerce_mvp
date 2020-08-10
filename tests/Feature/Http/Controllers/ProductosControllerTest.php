<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Productos;

class ProductosControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_stores_productos_and_redirects()
    {

        $productos = factory(Productos::class)->make();
        $data = $productos->attributesToArray();
        $response = $this->post(route('productos.store'), $data);
        $response->assertRedirect(route('productos.index'));
        $response->assertSessionHas('status', 'Productos created!');
    }

    /**
     * @test
     */
    public function it_updates_productos_and_redirects()
    {
        $productos = factory(Productos::class)->create();
        $data = factory(Productos::class)->make()->attributesToArray();
        $response = $this->put(route('productos.update', ['productos' => $productos]), $data);
        $response->assertRedirect(route('productos.index'));
        $response->assertSessionHas('status', 'Productos updated!');
    }

    /**
     * @test
     */
    public function it_destroys_productos_and_redirects()
    {
        $productos = factory(Productos::class)->create();
        $response = $this->delete(route('productos.destroy', ['productos' => $productos]));
        $response->assertRedirect(route('productos.index'));
        $response->assertSessionHas('status', 'Productos destroyed!');
    }
}
