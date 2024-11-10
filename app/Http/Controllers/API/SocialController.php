<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Resources\SocialResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Social;
use Illuminate\Http\JsonResponse;

class SocialController extends BaseController
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socials = Social::all();
    
        return $this->sendResponse(SocialResource::collection($socials), 'Socials retrieved successfully.');
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
   
        $social = Social::create($input);
   
        return $this->sendResponse(new SocialResource($social), 'Social created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $social = Social::find($id);
  
        if (is_null($social)) {
            return $this->sendError('Product not found.');
        }
   
        return $this->sendResponse(new SocialResource($social), 'Social retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Social $social)
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
   
        $social->name = $input['name'];
        $social->link = $input['link'];
        $social->img = $input['img'];
        $social->save();
   
        return $this->sendResponse(new SocialResource($social), 'Social updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Social $social)
    {
        $social->delete();
   
        return $this->sendResponse([], 'Social deleted successfully.');
    }
}