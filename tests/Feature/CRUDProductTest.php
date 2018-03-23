<?php

/**
 * assertViewHas
 * assertResponseOk
 * assertRedirectedTo
 * assertRedirectedToRoute
 * assertRedirectedToAction
 * assertSessionHas
 * assertSessionHasErrors
 */

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Product;
use App;

class CRUDProductTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
/**----------------------------------------------TESTING STORE METHOD------------------------------------------ */
    public function test_store()
    {
        //capture info with 'clue'
        $variables=['name'=>'testName', 'description'=>'testDescription', 'code'=>'testCode', 'buyPrice'=>'12', 'sellPrice'=>'25'];
        $response = $this->json('POST', 'admin/product', $variables);
        
        //check info
        $testResponse=Product::named('testName')->get();

        //test using assertion, compare info with clue
        $this->assertEquals('testName',$testResponse->first()->name);
    }
/**----------------------------------------------TESTING UPDATE METHOD------------------------------------------ */
    public function test_update()
    {     
        //Create fake info to feed the DB with an element to update   
        factory(Product::class,4)->create();
        $testUpdate = factory(Product::class)->create(['name'=>'testName', 'description'=>'testDescription', 'code'=>'testCode', 'buyPrice'=>'12', 'sellPrice'=>'25']);

        //Launch the update method 
        $response = $this->json('PATCH', 'admin/product/'.$testUpdate->id, ['name'=>'testNameUpdated', 'description'=>'testDescription', 'code'=>'testCodeUpdated', 'buyPrice'=>'12', 'sellPrice'=>'25']);   

        //get info from the same id record
        $testUpdated = Product::ided($testUpdate->id);

        //check if we receive updated name and code with the same id
        $this->assertEquals('testNameUpdated',$testUpdated->first()->name);
        $this->assertEquals('testCodeUpdated',$testUpdated->first()->code);
    }

/**----------------------------------------------TESTING DESTROY METHOD------------------------------------------ */
    public function test_destroy()
    {   
        //Create fake info to feed the DB with an element to delete
        factory(Product::class,4)->create();
        $testDestroy = factory(Product::class)->create(['name'=>'testName', 'description'=>'testDescription', 'code'=>'testCode', 'buyPrice'=>'12', 'sellPrice'=>'25']);

        //Get the actual total amount of rows 
        $before = Product::totalrows();

        //call the method post of the route /admin/product/edit   
        $response = $this->json('DELETE', 'admin/product/'.$testDestroy->id);  

        //Get the actual total amount of rows 
        $after = Product::totalrows();

        //check if we receive the $product variable from the controller
        $this->assertGreaterThan($after, $before);
    }
}
