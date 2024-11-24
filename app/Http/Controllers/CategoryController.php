<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('pages.categories.index', compact('categories'));
    }

    public function getCategory(Request $request)
    {
        $tags=[];
        if ($search = $request->name){
            $tags = Category::where('title', 'LIKE', "%$search%")->get();
        }

        return response()->json($tags);
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store(CategoryRequest $request)
{
    try {
        $validated = $request->validated();
        
        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('images', 'public');
            $fullPath = storage_path('app/public/' . $imagePath);
            $validated['img'] = '/storage/' . $imagePath;
        }
        
        $category = Category::create($validated);
        
        return redirect()
            ->route('dashboard.events')
            ->with('success', 'Category created successfully.');
            
    } catch (\Exception $e) {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Failed to create event: ' . $e->getMessage());
    }
}

    public function show(Category $category)
    {
        return view('pages.categories.show', compact('product'));
    }

    public function edit(Category $category)
    {
        return view('pages.categories.edit', compact('event'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        Log::info('updating here');
        try {
            $validated = $request->validated();
            
            // Handle image upload
            if ($request->hasFile('img')) {
                // Delete old image if exists
                if ($category->img && Storage::exists($category->img)) {
                    Storage::delete($category->img);
                }
                
                $imagePath = $request->file('img')->store('images', 'public');
                $fullPath = storage_path('app/public/' . $imagePath);
                $validated['img'] = '/storage/' . $imagePath;
            }
            $category->update($validated);
            
            return redirect()
                ->route('dashboard.categories')
                ->with('success', 'Category updated successfully.');
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update event: ' . $e->getMessage());
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();
        
        return redirect()
            ->route('dashboard.categories')
            ->with('success', 'Category deleted successfully.');
    }
}
