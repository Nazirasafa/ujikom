<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Resources\SectionResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Section;
use Illuminate\Http\JsonResponse;

class SectionController extends BaseController
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
    
        return $this->sendResponse(SectionResource::collection($sections), 'Sections retrieved successfully.');
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
            'placement' => 'required|string|max:255',
            'img' => 'string',
            'title' => 'required|string',
            'desc' => 'required|string',
            'cta' => 'string',
            'link' => 'string',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $section = Section::create($input);
   
        return $this->sendResponse(new SectionResource($section), 'Section created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = Section::find($id);
  
        if (is_null($section)) {
            return $this->sendError('Product not found.');
        }
   
        return $this->sendResponse(new SectionResource($section), 'Section retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'placement' => 'required|string|max:255',
            'img' => 'string',
            'title' => 'required|string',
            'desc' => 'required|string',
            'cta' => 'string',
            'link' => 'string',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $section->placement = $input['name'];
        $section->img = $input['img'];
        $section->title = $input['title'];
        $section->desc = $input['desc'];
        $section->cta = $input['cta'];
        $section->link = $input['link'];
        $section->save();
   
        return $this->sendResponse(new SectionResource($section), 'Section updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();
   
        return $this->sendResponse([], 'Section deleted successfully.');
    }
}