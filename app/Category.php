<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['category'];
    protected $hidden = ['id'];

    public function createCategory($request) {
        return Category::create($request->all());
    } 

    public function getCategories () {
        return Category::all();
    }

    public function getCategory($category) {
        return Category::find($category);
    }

    public function article()
    {
        return $this->hasMany('App\Article');
    }
}
