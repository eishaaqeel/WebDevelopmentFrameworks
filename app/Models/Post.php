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

    protected $with = ['category', 'author'];

    public function scopeFilter($query, array $filters) //Post::newQuery()->filter()
    {
        /*
        if ($filters['search'] ?? false){
            $query
                ->where('title', 'like', '%' . request('search').'%')
                ->orWhere('body', 'like', '%' . request('search').'%');
        }
        */
        $query->when($filters['search'] ?? false, fn($query, $search)=>
            $query->where(fn($query)=>
                $query->where('title', 'like', '%' . $search .'%')
                ->orWhere('body', 'like', '%' . $search .'%')
            )
        );

        $query->when($filters['category'] ?? false, fn($query, $category)=>
            $query->whereHas('category', fn ($query)=>
                $query->where('slug', $category)
            )
        );
        /*
            $query
                ->whereExists(fn($query)=>
                    $query->from('categories')
                        ->whereColumn('categories.id', 'posts.category_id')
                        ->where('categories.slug', $category))
                    );
        */

        $query->when($filters['author'] ?? false, fn($query, $author)=>
            $query->whereHas('author', fn ($query)=>
                $query->where('username', $author)
            )
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
