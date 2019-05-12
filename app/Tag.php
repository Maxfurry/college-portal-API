<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = ['tag'];

    public function createTag($request) {
        return $this::create($request->all());
    }

    public function findOrCreateTag($tag) {
        return $this::firstOrCreate(['tag' => $tag]);
    }

    public function getTags () {
        return $this::all();
    }

    public function getTag($tag) {
        $tagRetrieved = $this::find($tag);
        return $tagRetrieved;
    }

    public function uodateTag($request, $tagId) {
        $tagRetrieved = $this::find($tagId);
        $oldTag = $tagRetrieved->tag;
        $tagRetrieved->tag = $request->tag;
        $tagRetrieved->save();

        $updatedTag = $tagRetrieved->tag;

        return [$oldTag, $updatedTag];
    }

    public function deleteTag($tagId) {
        $tagRetrieved = $this::find($tagId);
        $tagRetrieved->delete();

        return $tagRetrieved;
    }

    public function article()
    {
        return $this->belongsToMany('App\Article')->withTimestamps();
    }
}
