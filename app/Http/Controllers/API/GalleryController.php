<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Resources\GalleryResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\JsonResponse;

class GalleryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::all();

        $galleries->transform(function ($gallery) {
            $gallery->img = url($gallery->img);
            return $gallery;
        });

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
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }


        $gallery = Gallery::create($input);

        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('images', 'public');
            $imageUrl = str_replace('public/', 'storage/', $imagePath);
            $gallery->img = '/storage/' . $imagePath;
            $gallery->save();
        }
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
        $gallery = Gallery::with('images')->find($id);

        if (is_null($gallery)) {
            return $this->sendError('Gallery not found.');
        }
        $gallery->img = url($gallery->img);


        // Transform setiap image untuk mengonversi path menjadi URL penuh
        $gallery->images->transform(function ($image) {
            $image->image = url($image->image); // Mengubah path menjadi URL penuh
            return $image;
        });

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
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $gallery->name = $input['name'];
        $gallery->desc = $input['desc'];
        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('images', 'public');
            $imageUrl = str_replace('public/', 'storage/', $imagePath);
            $gallery->img = '/storage/' . $imagePath;
            $gallery->save();
        }

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


    public function addImage(Request $request, $galleryId)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // Cari post berdasarkan ID
        $gallery = Gallery::findOrFail($galleryId);

        // Simpan file gambar ke dalam folder storage (misalnya: public/images)
        $imagePath = $request->file('image')->store('public/images', 'public');
        $imageUrl = str_replace('public/', 'storage/', $imagePath);

        $gallery->images()->create([
            'image' => $imageUrl,
            'gallery_id' => $gallery->id, // Tetapkan post_id ke image
        ]);

        return $this->sendResponse('Photo added successfully.', 'Photo added successfully.');
    }


    public function deleteImage(GalleryImage $image)
    {
        $image->delete();

        return $this->sendResponse([], 'Image deleted successfully.');
    }
}