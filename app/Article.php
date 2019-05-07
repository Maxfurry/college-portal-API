<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $fillable = ['title', 'description', 'content', 'category_id', 'status'];
    protected $hidden = ['category_id'];

    public function createArticle($request) {
        // $articleName = new Article();
        // $articleName->title = $request->input('title');
        // $articleName->description = $request->input('description');
        // $articleName->content  = $request->input('content');
        // $articleName->category_id  = $request->input('category_id');
        // $articleName->status  = $request->input('status');
        // $articleName->save();

        // return $articleName;

        return Article::create($request->all());
    } 

    public function getArticles () {
        return Article::all();
    }

    public function getArticle($article) {
        $articleRetrieved = Article::find($article);
        $article = $articleRetrieved->category;
        return $articleRetrieved;
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
