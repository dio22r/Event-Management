<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataProducts = Product::with("category")->get();

        return view(
            'product.index',
            ['products' => $dataProducts]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();

        $product->name = old("name");
        $product->price = old("price");
        $product->detail = old("detail");
        $product->category_id = old("category_id");

        return view(
            'product.form',
            [
                "product" => $product,
                "method" => "POST",
                "action_url" => url('/product'),
                "categories" => Category::all()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'detail' => 'required',
            'category_id' => 'required',
            // 'type' => 'required',
        ]);

        $product = new Product($request->all());
        $product->type = 0;

        $product->save();

        return redirect('/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view(
            'product.detail',
            ['product' => $product]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view(
            'product.form',
            [
                "product" => $product,
                "method" => "PUT",
                "action_url" => url('/product/' . $product->id),
                "categories" => Category::all()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'detail' => 'required',
            'category_id' => 'required',
            // 'type' => 'required',
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->detail = $request->detail;
        $product->category_id = $request->category_id;

        $product->save();

        return redirect('/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/product');
    }
}
