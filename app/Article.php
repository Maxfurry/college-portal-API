<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $fillable = ['title', 'description', 'content', 'category_id', 'status'];
    protected $hidden = ['category_id'];

    public function createArticle($request) {
        // $newArticle = new Article();
        // $newArticle->title = $request->input('title');
        // $newArticle->description = $request->input('description');
        // $newArticle->content  = $request->input('content');
        // $newArticle->category_id  = $request->input('category_id');
        // $newArticle->status  = $request->input('status');
        // $newArticle->save();

        // return $newArticle;

        return $this::create($request->all());
    } 

    public function getArticles () {
        return $this::all();
    }

    public function getArticle($article) {
        $articleRetrieved = $this::find($article);
        $article = $articleRetrieved->category;
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
