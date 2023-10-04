<?php
namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post
{
    public static function all()
    {
        //read a directory of files
        $files = File::files(resource_path("posts/"));

        //commented because the line right below does the same but cleaner
        /*
        return array_map(function ($file){
            return $file->getContents();
        }, $files);
        */
        return array_map(fn($file)=> $file ->getContents(), $files);
    }

    public static function find($slug)
    {
        //$post = file_get_contents(__DIR__ . '/../resources/posts/my-first-post.html');

        base_path();

        //if the user trys to access a page that does Not exist,
        if(!file_exists($path = resource_path("posts/{$slug}.html"))){
            //ddd = Dump, Die, Debug
            //ddd('file does not exist');

            //abort(404);

            //redirect to home page
            //return redirect('/');

            throw new ModelNotFoundException();
        }

        return cache()->remember("posts.{$slug}", 1200, fn() => file_get_contents($path));
    }
}
