<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Resources\GalleryResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Gallery;
use Illuminate\Http\JsonResponse;

class PhotoController extends BaseController
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::all();
    
        return $this->sendResponse(GalleryResource::collection($galleries), 'Galleries retrieved successfully.');
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
            'desc' => 'required|string',
            'img' => 'required|string',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $gallery = Gallery::create($input);
   
        return $this->sendResponse(new GalleryResource($gallery), 'Gallery created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gallery = Gallery::find($id);
  
        if (is_null($gallery)) {
            return $this->sendError('Product not found.');
        }
   
        return $this->sendResponse(new GalleryResource($gallery), 'Gallery retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'img' => 'required|string',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $gallery->name = $input['name'];
        $gallery->desc = $input['desc'];
        $gallery->img = $input['img'];
        $gallery->save();
   
        return $this->sendResponse(new GalleryResource($gallery), 'Gallery updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
   
        return $this->sendResponse([], 'Gallery deleted successfully.');
    }
}