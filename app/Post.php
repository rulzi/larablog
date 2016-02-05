<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    public function getSlug($title)
	{
	    $slug = Str::slug($title);
	    $slugCount = count( Model::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );
	 
	    return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
	}
}
