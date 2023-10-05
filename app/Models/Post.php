<?php
namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{

    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    /**
     * Post constructor
     * @param $title
     * @param $excerpt
     * @param $date
     * @param $body
     * @param $slug
     */
    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all()
    {
        //commented because the line right below shows another way of doing it
        /*
        //read a directory of files
        $files = File::files(resource_path("posts/"));

        return array_map(fn($file)=> $file ->getContents(), $files);
        */

        return cache()->rememberForever('posts.all', function (){
            //laravels collection approch - collect an array and wrap it within a colection object
            //find all of the posts in the posts directory and collect them into a collection and then map (loop) over each item and for each one parse that file into a document
            return collect(File::files(resource_path("posts")))
            ->map(fn($file) => YamlFrontMatter::parseFile($file))
            //once you have a collection of documents, then map over for a second time, but this time we build our own Post object
            ->map(fn ($document) => new Post(
                $document->title,
                $document->excerpt,
                $document->date,
                $document->body(),
                $document->slug
            ))
            //make the posts show in this order (post with the most recent date shows up first):
            ->sortByDesc('date');
        });
    }

    public static function find($slug)
    {
        //$post = file_get_contents(__DIR__ . '/../resources/posts/my-first-post.html');

        //base_path();

        //Not using the comented approches anymore
        /*
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
        */

        // of all the blog posts, find the one with a slug (id) that matches the one that was requested:
        return static::all()->firstWhere('slug', $slug);

    }

    public static function findOrFail($slug)
    {
        $post = static::find($slug);

        if (! $post){
            throw new ModelNotFoundException();
        }
        return $post;

    }
}
