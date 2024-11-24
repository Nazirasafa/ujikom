<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Gallery;
use App\Models\Major;
use App\Models\Post;
use App\Models\Statistic;
use App\Models\Text;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
    
        $newses = Post::orderBy('created_at', 'desc')->limit(3)->get();
        $events = Event::where('date', '>', Carbon::now())->orderBy('date', 'asc')->limit(5)->get();
        $galleries = Gallery::orderBy('created_at', 'desc')->limit(4)->get();

    
        return view('welcome', compact(
            'newses',
            'events',
            'galleries', 
        ));
    }

    public function news(){
        $newses = Post::all();

        return view('guest.news.index', compact('newses'));
    }

    public function showNews(Post $news){
        return view('guest.news.show', compact('news'));
    }

    public function events(){
        $events = Event::all();

        return view('guest.events.index', compact('events'));
    }

    public function showEvent(Event $event){
        return view('guest.events.show', compact('event'));
    }

    public function galleries(){
        $galleries = Gallery::all();

        return view('guest.galleries.index', compact('galleries'));
    }

    public function showGallery(Gallery $gallery){
        return view('guest.galleries.show', compact('gallery'));
    }

    
}
