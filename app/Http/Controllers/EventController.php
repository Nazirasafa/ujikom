<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('pages.events.index', compact('events'));
    }

    public function create()
    {
        return view('pages.events.create');
    }

    public function store(EventRequest $request)
{
    try {
        $validated = $request->validated();
        
        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('images', 'public');
            $fullPath = storage_path('app/public/' . $imagePath);
            $validated['img'] = '/storage/' . $imagePath;
        }
        
        $event = Event::create($validated);
        
        return redirect()
            ->route('dashboard.events')
            ->with('success', 'Event created successfully.');
            
    } catch (\Exception $e) {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Failed to create event: ' . $e->getMessage());
    }
}

    public function show(Event $event)
    {
        return view('pages.events.show', compact('product'));
    }

    public function edit(Event $event)
    {
        return view('pages.events.edit', compact('event'));
    }

    public function update(EventRequest $request, Event $event)
    {
        try {
            $validated = $request->validated();
            
            // Handle image upload
            if ($request->hasFile('img')) {
                // Delete old image if exists
                if ($event->img && Storage::exists($event->img)) {
                    Storage::delete($event->img);
                }
                
                $imagePath = $request->file('img')->store('images', 'public');
                $fullPath = storage_path('app/public/' . $imagePath);
                $validated['img'] = '/storage/' . $imagePath;
            }
            
            $event->update($validated);
            
            return redirect()
                ->route('dashboard.events')
                ->with('success', 'Event updated successfully.');
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update event: ' . $e->getMessage());
        }
    }

    public function destroy(Event $event)
    {
        $event->delete();
        
        return redirect()
            ->route('dashboard.events')
            ->with('success', 'Product deleted successfully.');
    }

}
