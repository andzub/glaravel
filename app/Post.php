<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title' , 'body', 'author_id'
    ];

    /**
     * One article belongs to one author
     */
    public function author()
    {
      return $this->belongsTo('App\User');
    }
}
