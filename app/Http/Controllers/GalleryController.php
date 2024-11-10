<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalleryImageRequest;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all();
        return view('pages.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('pages.galleries.create');
    }

    public function store(GalleryRequest $request)
{
    try {
        $validated = $request->validated();
        
        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('images', 'public');
            $fullPath = storage_path('app/public/' . $imagePath);
            $validated['img'] = '/storage/' . $imagePath;
        }
        
        $gallery = Gallery::create($validated);
        
        return redirect()
            ->route('dashboard.galleries')
            ->with('success', 'Gallery created successfully.');
            
    } catch (\Exception $e) {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Failed to create gallery: ' . $e->getMessage());
    }
}

public function storeImage(GalleryImageRequest $request, Gallery $gallery)
{
    try {
        
        
        $validated = $request->validated();
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $fullPath = storage_path('app/public/' . $imagePath);
            $validated['image'] = '/storage/' . $imagePath;
        }

        
        $gallery->images()->create([
            'image' =>  $validated['image'],
            'gallery_id' => $gallery->id,
        ]);
        
        return redirect()
            ->route('dashboard.galleries.show', $gallery)
            ->with('success', 'Photo added successfully.');
            
    } catch (\Exception $e) {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Failed to create gallery: ' . $e->getMessage());
    }
}

    public function show(Gallery $gallery)
    {
        //$gallery = Gallery::with('images')->find($gallery->id);
        return view('pages.galleries.show', compact(['gallery']));
    }

    public function edit(Gallery $gallery)
    {
        return view('pages.galleries.edit', compact('gallery'));
    }

    public function update(GalleryRequest $request, Gallery $gallery)
    {
        try {
            $validated = $request->validated();
            
            // Handle image upload
            if ($request->hasFile('img')) {
                // Delete old image if exists
                if ($gallery->img && Storage::exists($gallery->img)) {
                    Storage::delete($gallery->img);
                }
                
                $imagePath = $request->file('img')->store('images', 'public');
                $fullPath = storage_path('app/public/' . $imagePath);
                $validated['img'] = '/storage/' . $imagePath;
            }
            
            $gallery->update($validated);
            
            return redirect()
                ->route('dashboard.galleries')
                ->with('success', 'Gallery updated successfully.');
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update gallery: ' . $e->getMessage());
        }
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        
        return redirect()
            ->route('dashboard.galleries')
            ->with('success', 'Gallery deleted successfully.');
    }

    public function destroyImage(GalleryImage $image, Gallery $gallery)
    {
        $image->delete();
        
        return redirect()
            ->route('dashboard.galleries.show', $gallery)
            ->with('success', 'Gallery deleted successfully.');
    }
}
