<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCategory = Category::all();

        return view(
            'category.index',
            ['categories' => $dataCategory]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();

        $category->name = old("name");
        $category->detail = old("detail");
        $category->slug = old("slug");

        return view(
            'category.form',
            [
                "category" => $category,
                "method" => "POST",
                "action_url" => url('/category')
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
            'slug' => 'required',
            'detail' => 'required'
        ]);

        $category = new Category();

        $category->name = $request->name;
        $category->detail = $request->detail;
        $category->slug = strtolower($request->slug);

        $category->save();

        return redirect('/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view(
            'category.detail',
            ['category' => $category]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view(
            'category.form',
            [
                "category" => $category,
                "method" => "PUT",
                "action_url" => url('/category/' . $category->id)
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
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'detail' => 'required'
        ]);

        $category->name = $request->name;
        $category->detail = $request->detail;
        $category->slug = strtolower($request->slug);

        $category->save();

        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/category');
    }
}
