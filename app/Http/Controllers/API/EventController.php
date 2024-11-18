<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class EventController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();

        $events->transform(function ($event) {
            $event->img = url($event->img); 
            return $event;
        });

        return $this->sendResponse(EventResource::collection($events), 'events retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'short_desc' => 'required|string',
            'desc' => 'required|string',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'social_media' => 'required|string',
            'date' => 'required|date_format:Y-m-d|after_or_equal:1920-01-01',
            'time_start' => 'required|date_format:H:i:s',
            'time_end' => 'required|date_format:H:i:s|after:time_start',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $event = Event::create($input);

        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('public/images', 'public');
            $fullPath = storage_path('app/public/' . $imagePath);
            $event->img =  '/storage/' .$imagePath;
            $event->save();
        }

        return $this->sendResponse(new EventResource($event), 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);

        if (is_null($event)) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse(new EventResource($event), 'Event retrieved successfully.');
    }

    public function latestEvents()
    {
        $events = Event::orderBy('created_at', 'desc')
        ->take(3)
        ->get();
    
        if ($events->isEmpty()) {
            return $this->sendError('No Events available.');
        }
    
        $events->transform(function ($post) {
            $post->img = url($post->img);
            return $post;
        });
    
        return $this->sendResponse(EventResource::collection($events), 'Latest events retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'short_desc' => 'required|string',
            'desc' => 'required|string',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'social_media' => 'required|string',
            'date' => 'required|date_format:Y-m-d|after_or_equal:1920-01-01',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required|date_format:H:i|after:time_start',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $event->name = $input['name'];
        $event->short_desc = $input['short_desc'];
        $event->desc = $input['desc'];
        $event->social_media = $input['social_media'];
        $event->date = $input['date'];
        $event->time_start = $input['time_start'];
        $event->time_end = $input['time_end'];

        

        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('public/images', 'public');
            $fullPath = storage_path('app/public/' . $imagePath);
            $event->img =  '/storage/' .$imagePath;
        }

        $event->save();

        return $this->sendResponse(new EventResource($event), 'Event updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return $this->sendResponse([], 'Event deleted successfully.');
    }
}
