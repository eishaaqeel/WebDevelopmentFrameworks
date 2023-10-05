<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    //the block of code below is commented because the block of code right after does the same thing using an array_map
    /*
    //read all file in the posts directory
    $files = File::files(resource_path("posts"));
    $posts = [];

    foreach($files as $file){
        $document = YamlFrontMatter::parseFile($file);
        $posts[] = new Post(
            $document->title,
            $document->excerpt,
            $document->date,
            $document->body(),
            $document->slug
        );
    }
    */
    //The block of code below is commented because the one right under does the same stuff but using laravels collection approch
    /*
    $posts = array_map(function($file){
        $document = YamlFrontMatter::parseFile($file);
        return new Post(
            $document->title,
            $document->excerpt,
            $document->date,
            $document->body(),
            $document->slug
        );
    }, $files);
    */

    /*
    //laravels collection approch - collect an array and wrap it within a colection object
    //find all of the posts in the posts directory and collect them into a collection and then map (loop) over each item and for each one parse that file into a document
    $posts = collect(File::files(resource_path("posts")))
        ->map(fn($file) => YamlFrontMatter::parseFile($file))
        //once you have a collection of documents, then map over for a second time, but this time we build our own Post object
        ->map(fn ($document) => new Post(
            $document->title,
            $document->excerpt,
            $document->date,
            $document->body(),
            $document->slug
        ));
    */

    return view('posts',[
        'posts' => Post::all()
    ]);
});

// {post} = {*} aka wildcard
Route::get('posts/{post}', function ($slug) {
    //Find a post by its slug and pass it to a view called "post"

    return view('post', [
        'post' => Post::findOrFail($slug)
    ]);
});
