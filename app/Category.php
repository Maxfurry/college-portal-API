<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['category'];

    public function createCategory($request) {
        return Category::create($request->all());
    } 

    public function getCategories () {
        return Category::all();
    }

    public function getCategory($category) {
        return Category::find($category);
    }

    public function updateCategory($request, $catId) {
        $catRetrieved = $this::find($catId);
        $oldCat = $catRetrieved->category;
        $catRetrieved->category = $request->category;
        $catRetrieved->save();

        $updatedCat = $catRetrieved->category;

        return [$oldCat, $updatedCat];
    }

    public function deleteCategory($catId) {
        $catRetrieved = $this::find($catId);
        $catRetrieved->delete();

        return $catRetrieved;
    }

    public function article()
    {
        return $this->hasMany('App\Article');
    }
}
