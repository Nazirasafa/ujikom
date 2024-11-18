<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class NewsController extends Controller
{
    public function index()
    {
        $newses = Post::all();
        return view('pages.news.index', compact('newses'));
    }

    public function create()
    {
        return view('pages.news.create');
    }

    public function store(PostRequest $request)
{
    try {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        
        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('images', 'public');
            $fullPath = storage_path('app/public/' . $imagePath);
            $validated['img'] = '/storage/' . $imagePath;
        }
        
        $news = Post::create($validated);
        
        return redirect()
            ->route('dashboard.news')
            ->with('success', 'News created successfully.');
            
    } catch (\Exception $e) {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Failed to create news: ' . $e->getMessage());
    }
}

    public function storeCategory(Request $request, Post $news)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'category_id' => 'required|exists:categories,id', // Ensure category exists
        ]);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Input not valid');
        }

        try {
            $news->categories()->attach($input['category_id']);

            return redirect()
                ->route('dashboard.news.show', $news)
                ->with('success', 'Category added successfully.');
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create news: ' . $e->getMessage());
        }
    }

    public function show(Post $news)
    {
        $existingCategoryIds = $news->categories()->pluck('id')->toArray();

        $all_categories = Category::whereNotIn('id', $existingCategoryIds)->get();

        return view('pages.news.show', compact(['news', 'all_categories']));
    }

    public function edit(Post $news)
    {
        return view('pages.news.edit', compact('news'));
    }

    public function update(PostRequest $request, Post $news)
    {

        try {
            $validated = $request->validated();
            
            // Handle image upload
            if ($request->hasFile('img')) {
                // Delete old image if exists
                if ($news->img && Storage::exists($news->img)) {
                    Storage::delete($news->img);
                }
                
                $imagePath = $request->file('img')->store('images', 'public');
                $fullPath = storage_path('app/public/' . $imagePath);
                $validated['img'] = '/storage/' . $imagePath;
            }
            
            $news->update($validated);
            
            return redirect()
                ->route('dashboard.news')
                ->with('success', 'Post updated successfully.');
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update news: ' . $e->getMessage());
        }
    }

    public function destroy(Post $news)
    {
        $news->delete();
        
        return redirect()
            ->route('dashboard.news')
            ->with('success', 'News deleted successfully.');
    }

    public function destroyCategory(Post $news, Category $category)
    {
        // Detach the category from the post in the pivot table
        $news->categories()->detach($category->id);
        
        return redirect()
            ->route('dashboard.news.show', $news)
            ->with('success', 'Category removed from the post successfully.');
    }
    
}
