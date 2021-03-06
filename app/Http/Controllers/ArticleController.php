<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articleRetrieved = new Article();
        $articleRetrieved = $articleRetrieved->getArticles();

        $res = (object) array (
            'status' => 200,
            'message' => 'All Articles Fetched Succesfully',
            'success' => true,
            'data' => $articleRetrieved
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
        return 'Article Create Page';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \DB::beginTransaction(); 
        try {
            $newArticle = new Article();
            $newArticle = $newArticle->createArticle($request);

            if ($request->input('tag')) {
                $tag = new Tag();
                $tags = $request->tag;
                $tagIdArray = array();

                foreach($tags as $tagName) {
                    $tag = $tag->findOrCreateTag($tagName);
                    array_push($tagIdArray, $tag->id); 
                }
                $newArticle->tags()->attach($tagIdArray);
            }

            \DB::commit();

            $res = (object) array (
                'status' => 200,
                'message' => "Article $newArticle->title created successfully",
                'success' => true,
                'data' => $newArticle
            );
        } catch (\Exception $e) {

            \DB::rollback();

            $res = (object) array (
                'status' => 500,
                'message' => "Article $newArticle->title not created successfully",
                'success' => false
            );
        }
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($article)
    {
        $articleRetrieved = new Article();
        $articleRetrieved = $articleRetrieved->getArticle($article);

        $res = (object) array (
            'status' => 201,
            'message' => "Article $articleRetrieved->title Fetched Succesfully",
            'success' => true,
            'data' => $articleRetrieved
        );
        return response()->json($res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
        return 'Article Edit View';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $articleId)
    {
        \DB::beginTransaction(); 
        try {
            $article = new Article();
            $article = $article->updateArticle($request, $articleId);

            if ($request->input('tag')) {
                $tag = new Tag();
                $tags = $request->tag;
                $tagIdArray = array();

                foreach($tags as $tagName) {
                    $tag = $tag->findOrCreateTag($tagName);
                    array_push($tagIdArray, $tag->id); 
                }
                $article->tags()->sync($tagIdArray);
            }

            \DB::commit();
            
            $res = (object) array (
                'status' => 201,
                'message' => "Article $request->title updated Succesfully",
                'success' => true,
                'data' => $article
            );
        } catch (\Exception $e) {

            \DB::rollback();

            $res = (object) array (
                'status' => 500,
                'message' => "Article $newArticle->title not updated successfully",
                'success' => false
            );
        }
        return response()->json($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($articleId)
    {
        \DB::beginTransaction(); 
        try {
            $article = new Article();
            $article = $article->getArticle($articleId);
            $tagIdArray = array();

            foreach ($article->tags as $role) {
                array_push($tagIdArray, $role->pivot->tag_id); 
            }
            
            $article->tags()->detach($tagIdArray);
            $article = $article->deleteArticle($articleId);

            \DB::commit();

            $res = (object) array (
                'status' => 201,
                'message' => "Article $article->title deleted Succesfully",
                'success' => true
            );
        } catch (\Exception $e) {

            \DB::rollback();

            $res = (object) array (
                'status' => 500,
                'message' => "Article not deleted successfully",
                'success' => false
            );
        }

        return response()->json($res);
    }
}
