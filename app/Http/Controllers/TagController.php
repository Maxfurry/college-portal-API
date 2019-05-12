<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tagRetrieved = new Tag();
        $tagRetrieved = $tagRetrieved->getTags();

        $res = (object) array (
            'status' => 200,
            'message' => 'All Tags Fetched Succesfully',
            'data' => $tagRetrieved
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
        $newTag = new Tag();
        $newTag = $newTag->createTag($request);

        $res = (object) array (
            'status' => 200,
            'message' => "Tag $newTag->tag created successfully",
            'success' => true,
            'data' => $newTag
        );
        return response()->json($res);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $tagId
     * @return \Illuminate\Http\Response
     */
    public function show($tagId)
    {
        $tagRetrieved = new Tag();
        $tagRetrieved = $tagRetrieved->getTag($tagId);

        $res = (object) array (
            'status' => 201,
            'message' => "Tag $tagRetrieved->tag Fetched Succesfully",
            'data' => $tagRetrieved
        );
        return response()->json($res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $tagId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tagId)
    {
        $tag = new Tag();
        $tag = $tag->updateTag($request, $tagId);

        $res = (object) array (
            'status' => 201,
            'message' => "Tag $tag[0] Updated to $tag[1] Succesfully"
        );
        return response()->json($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $tagId
     * @return \Illuminate\Http\Response
     */
    public function destroy($tagId)
    {
        $tag = new Tag();
        $tag = $tag->deleteTag($tagId);

        $res = (object) array (
            'status' => 201,
            'message' => "Tag $tag->tag Deleted Succesfully"
        );
        return response()->json($res);
    }
}
