<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $fillable = ['title', 'description', 'content', 'category_id', 'published'];
    protected $hidden = ['category_id'];

    public function createArticle($request) {
        // $newArticle = new Article();
        // $newArticle->title = $request->input('title');
        // $newArticle->description = $request->input('description');
        // $newArticle->content  = $request->input('content');
        // $newArticle->category_id  = $request->input('category_id');
        // $newArticle->published  = $request->input('published');
        // $newArticle->save();

        // return $newArticle;

        return $this::create($request->all());
    } 

    public function getArticles () {
        return $this::all();
    }

    public function getArticle($articleId) {
        $articleRetrieved = $this::find($articleId);
        $article = $articleRetrieved->category;
        return $articleRetrieved;
    }

    public function updateArticle($request, $articleId) {
        $articleRetrieved = $this::find($articleId);
        
        $request = $request->input();
        foreach ($request as $reqKey => $val) {
            if($reqKey != "tag") {
                $articleRetrieved->$reqKey = $val;
            }
        }

        $articleRetrieved->save();

        $updatedArticle = $articleRetrieved;
        return $updatedArticle;
    }

    public function deleteArticle($articleId) {
        $articleRetrieved = $this::find($articleId);
        $articleRetrieved->delete();

        return $articleRetrieved;
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
}
