<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /** Using the variable {product} in the API, is possible 
     * to use implicit route
     * model binding which makes easier the query for a 
     * specific product inside the controller
    */
    public function index()
    {
        return Product::all();
    }

    public function show(Product $product)/** The argument is the ID*/ 
    {
        return $product;
    }

    public function store(Request $req)
    {
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function update(Request $req, Product $product)
    {
        $product->update($req->all());
        return response()->json($product, 200);
    }

    public function delete(Product $product)
    {
        $product->delete();
        return response()->json("Deleted",204);
    }
}
