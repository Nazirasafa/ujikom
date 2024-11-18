<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends BaseController
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        $categories->transform(function ($category) {
            $category->img = url($category->img); 
            return $category;
        });
    
        return $this->sendResponse(CategoryResource::collection($categories), 'Categories retrieved successfully.');
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
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $category = Category::create($input);

        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('public/images', 'public');
            $fullPath = storage_path('app/public/' . $imagePath);
            $category->img =  '/storage/' .$imagePath;
            $category->save();
        }
   
        return $this->sendResponse(new CategoryResource($category), 'category created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        $category->img = url($category->img);

  
        if (is_null($category)) {
            return $this->sendError('Category not found.');
        }
   
        return $this->sendResponse(new CategoryResource($category), 'category retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $category->title = $input['title'];
        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('public/images', 'public');
            $fullPath = storage_path('app/public/' . $imagePath);
            $category->img =  '/storage/' .$imagePath;
            $category->save();
        }
        $category->save();
   
        return $this->sendResponse(new CategoryResource($category), 'category updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
   
        return $this->sendResponse([], 'category deleted successfully.');
    }
}