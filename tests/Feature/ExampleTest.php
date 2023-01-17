<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Product;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        //will be pass
        $response->assertSee('documentation');

        // will be failed.
       // $response->assertSee('symphony');


        $response->assertStatus(200);
    }

    public function test_homepage_contanins_product_list(){

        $products= Product::create([
            'title'=> 'Product 2',
            'content'=> 'content',
            'price'=> 10.10
        ]);

        //$products = Product::all();

        $response = $this->get('/product');

       
        $response->assertStatus(200);
        //$response->assertDontSee(__('test'));
       $response->assertSee(__('Product 2'));

        $response->assertViewHas('products',function($collection) use ($products){
             return $collection->contains($products);
        });
    }
}
