<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index',[
            //'posts' => $this->getPosts(),
            'posts' => Post::latest()->filter(
                request(['search', 'category', 'author'])
            )->paginate(6)->withQueryString()
        ]);
    }

    /*
    protected function getPosts(){
        return Post::latest()->filter()->get();
        $posts = Post::latest();
        if (request('search')){
            $posts
                ->where('title', 'like', '%' . request('search').'%')
                ->orWhere('body', 'like', '%' . request('search').'%');
        }
        return $posts->get();
    }
    */

    public function show(Post $post)
    {
        //Find a post by its slug and pass it to a view called "post"
        return view('posts.show', [
            'post' => $post
        ]);
    }

}
