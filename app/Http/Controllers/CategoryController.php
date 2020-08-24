<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;
class CategoryController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $categories = Category::all();
        return view('admin/view_category',compact('categories'));
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $categories = Category::all();
        $category = new Category;
        $category->name = ucfirst($request->get('category'));
        if($categories->pluck('name')->contains($category->name)){
        return redirect('categories');
        }else {
        $category->save();
        return redirect('categories');
        }
    }

    /**
    * Display the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
    //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $categories = Category::find($id);
        return view('admin.view_category',compact('$categories'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $categories = Category::all();
        $category = Category::find($id);
        $category->name = ucfirst($request->get('category'));
        if($categories->pluck('name')->contains($category->name)){
        return redirect('categories');
        }else {
        $category->save();
        return redirect('categories');
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $categories = Category::find($id);
        if($categories )
        $categories->delete();
        return back();
    }

    function check(Request $request)
    {
        $name = $request->get('category');
        if($request->ajax()){
            $value = DB::table('categories')->where('name', $name)->get();
            return $value;
        }
    }
    function check_update(Request $request)
    {
        $name = $request->get('category');
        if($request->ajax()){
            $value = DB::table('categories')->where('name', $name)->get();
            return $value;
        }
    }

}
