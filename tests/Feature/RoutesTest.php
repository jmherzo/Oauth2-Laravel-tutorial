<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Product;

class testRoutes extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
/**------------------------------------------ INDEX ROUTE ----------------------------------------*/
    public function testProductIndexRoute()
    {

        //test using assertion to see that the view received is the expected
        $response = $this->get('/admin/product/');

        $response->assertStatus(200);
        $response->assertViewIs('admin.product.index');
    }


/**------------------------------------------ CREATE ROUTE ----------------------------------------*/
    public function testProductCreateRoute()
    {
        //test using assertion to see that the view received is the expected
        $response = $this->get('/admin/product/create');

        $response->assertStatus(200);
        $response->assertViewIs('admin.product.create');
    }


/**------------------------------------------ EDIT ROUTE ----------------------------------------*/
    public function testProductEditRoute()
    {
        $testID = factory(Product::class)->create(['name'=>'testName']);
        //test using assertion to see that the view received is the expected
        $response = $this->get('/admin/product/'.$testID->id.'/edit');

        $response->assertStatus(200);
        $response->assertViewIs('admin.product.edit');
    }

/**------------------------------------------ READ ROUTE ----------------------------------------*/
    public function testProductReadRoute()
    {
        $testID = factory(Product::class)->create(['name'=>'testName']);
        //test using assertion to see that the view received is the expected
        $response = $this->get('/admin/product/'.$testID->id);

        $response->assertStatus(200);
        $response->assertViewIs('admin.product.show');
    }
}
