<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Gallery;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $newses = Post::orderBy("created_at","desc")->limit(3)->get();
        $galleries = Gallery::orderBy("created_at","desc")->limit(3)->get();
        $events = Event::orderBy(column: "created_at",direction: "desc")->limit(3)->get();


        return view('welcome', compact(['newses','galleries','events']));
    }
}
