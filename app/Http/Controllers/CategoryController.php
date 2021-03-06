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
        $categoryRetrieved = new Category();
        $categoryRetrieved = $categoryRetrieved->getCategories();

        $res = (object) array (
            'status' => 200,
            'message' => 'All Categories Fetched Succesfully',
            'data' => $categoryRetrieved
        );
        return response()->json($res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newCategory = new Category();
        $newCategory = $newCategory->createCategory($request);
        
        $res = (object) array (
            'status' => 200,
            'message' => "Category $newCategory->category created successfully",
            'success' => true,
            'data' => $newCategory
        );
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($category)
    {
        $categoryRetrieved = new Category();
        $categoryRetrieved = $categoryRetrieved->getCategory($category);

        $res = (object) array (
            'status' => 201,
            'message' => "category $categoryRetrieved->title Fetched Succesfully",
            'data' => $categoryRetrieved
        );
        return response()->json($res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $catId)
    {
        if ($catId == 1) {
            $res = (object) array (
                'status' => 403,
                'message' => "This category cannot be updated"
            ); 
            return response()->json($res);
        }
            
        $category = new Category();
        $category = $category->updateCategory($request, $catId);

        $res = (object) array (
            'status' => 201,
            'message' => "Category $category[0] Updated to $category[1] Succesfully"
        );
        return response()->json($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($catId)
    {
        if ($catId == 1) {
            $res = (object) array (
                'status' => 403,
                'message' => "This category cannot be deleted"
            ); 
            return response()->json($res);
        }

        $category = new Category();
        $category = $category->deleteCategory($catId);

        $res = (object) array (
            'status' => 201,
            'message' => "Category $category->category Deleted Succesfully"
        );
        return response()->json($res);
    }
}
