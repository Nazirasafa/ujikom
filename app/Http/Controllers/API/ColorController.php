<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Resources\ColorResource;
use Illuminate\Support\Facades\Validator;
use App\Models\color;
use Illuminate\Http\JsonResponse;

class ColorController extends BaseController
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $colors = color::all();
    
        return $this->sendResponse(ColorResource::collection($colors), 'Colors retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'hex' => 'required|string|max:255',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $color = color::create($input);
   
        return $this->sendResponse(new ColorResource($color), 'color created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        $color = color::find($id);
  
        if (is_null($color)) {
            return $this->sendError('Product not found.');
        }
   
        return $this->sendResponse(new ColorResource($color), 'color retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, color $color): JsonResponse
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'hex' => 'required|string|max:255',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $color->name = $input['name'];
        $color->hex = $input['hex'];
        $color->save();
   
        return $this->sendResponse(new ColorResource($color), 'color updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(color $color): JsonResponse
    {
        $color->delete();
   
        return $this->sendResponse([], 'color deleted successfully.');
    }
}