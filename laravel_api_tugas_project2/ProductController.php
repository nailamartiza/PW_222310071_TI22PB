<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller {
    public function index(Product $product) {
        $data = $product->all();

        return new ProductResource(200, "Success!", $data);
    }

    public function store(Request $request){
        $dataRequest = $request->all(["name", "desc", "qty", "price"]);

        $validate = Validator::make($dataRequest, [
            "name" => ["required", "max:100"],
            "desc" => ["required", "max:100"],
            "qty" => ["required"],
            "price" => ["required"]
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }

        $data = Product::create($dataRequest);

        return new ProductResource(201, "Created successful", $data);
    }
    public function show(Product $product){
        $data = $product->find($product->id);

        return new ProductResource(200, "success!", $data);
    }

    public function update(Request $request, Product $product)
{
    $dataRequest = $request->only(['name', 'desc', 'qty', 'price']);

    $validate = Validator::make($dataRequest, [
        'name' => ['required', 'max:100'],
        'desc' => ['required', 'max:100'],
        'qty' => ['required'],
        'price' => ['required']
    ]);

    if($validate->fails()){
        return response()->json($validate->errors(), 400);
    }

    $product->update($validate->validated());

    return new ProductResource(200, 'Success!', $product);
}

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json('Product deleted successfully.', 200);
    }

}
