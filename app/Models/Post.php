<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //lists the things that can be mass assigned
    //protected $fillable = ['title', 'excerpt', 'body', 'id'];

    //everything can be mass assigned except the id:
    //protected $guarded = ['id'];

    protected $guarded = [];

    /*
    public function getRouteKeyName()
    {
        return 'slug';
    }
    */

    protected $with = ['category', 'author'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
