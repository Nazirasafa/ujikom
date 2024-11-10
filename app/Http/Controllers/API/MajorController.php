<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Resources\MajorResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Major;
use Illuminate\Http\JsonResponse;

class MajorController extends BaseController
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $majors = Major::all();
    
        return $this->sendResponse(MajorResource::collection($majors), 'Majors retrieved successfully.');
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
            'link' => 'required|string|max:255',
            'img' => 'required|string',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $major = Major::create($input);
   
        return $this->sendResponse(new MajorResource($major), 'Major created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $major = Major::find($id);
  
        if (is_null($major)) {
            return $this->sendError('Product not found.');
        }
   
        return $this->sendResponse(new MajorResource($major), 'Major retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Major $major)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'img' => 'required|string',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $major->name = $input['name'];
        $major->link = $input['link'];
        $major->img = $input['img'];
        $major->save();
   
        return $this->sendResponse(new MajorResource($major), 'Major updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Major $major)
    {
        $major->delete();
   
        return $this->sendResponse([], 'Major deleted successfully.');
    }
}