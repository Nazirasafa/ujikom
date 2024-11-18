<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Love;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // Mendapatkan parameter kategori dari request
        $category = $request->query('category');

        // Query post dengan relasi kategori
        $postsQuery = Post::with('categories', 'user');

        // Jika ada parameter kategori, tambahkan filter berdasarkan kategori
        if ($category) {
            $postsQuery->whereHas('categories', function ($query) use ($category) {
                $query->where('title', $category);
            });
        }

        // Dapatkan semua post sesuai dengan query
        $posts = $postsQuery->get();

        $posts->transform(function ($post) {
            $post->img = url($post->img);
            //$post->created_at = $post->created_at->diffForHumans();
            return $post;
        });


        return $this->sendResponse(PostResource::collection($posts), 'Posts retrieved successfully.');
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
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'category_ids' => 'required|array', // Mengharuskan category_ids sebagai array
            'category_ids.*' => 'exists:categories,id', // Memastikan setiap Color_id ada di tabel categories
            'user_id' => 'required|exists:users,id',
            'body' => 'required|string',
            'read_time' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }


        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('public/images', 'public');
            $imageUrl =  '/storage/' . $imagePath;
        }
        // Membuat post baru
        $post = Post::create([
            'title' => $input['title'],
            'user_id' => $input['user_id'],
            'body' => $input['body'],
            'read_time' => $input['read_time'],
            'img' => $imageUrl,
        ]);

        // Menambahkan kategori ke post menggunakan attach
        $post->categories()->attach($input['category_ids']);

        return $this->sendResponse(new PostResource($post), 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $post = Post::with('categories', 'images', 'user')->find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $userId = $input['user_id'];


        if (is_null($post)) {
            return $this->sendError('Post not found.');
        }

        $post->increment('views');

        $post->img = url($post->img);
        //$post->created_at = Carbon::parse($post->created_at)->diffForHumans(); // Mengubah format created_at

        $post->images->transform(function ($image) {
            $image->image = url($image->image);
            return $image;
        });

        $post->isLiked = $post->loves()->where('user_id', $userId)->exists();
        $post->likes = $post->loves()->count();


        return $this->sendResponse(new PostResource($post), 'Post retrieved successfully.');
    }

    public function latestPosts()
    {
        // Get the latest 3 posts with related categories and user information
        $posts = Post::with('categories')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Check if the posts collection is empty
        if ($posts->isEmpty()) {
            return $this->sendError('No posts available.');
        }

        // Transform image paths for each post
        $posts->transform(function ($post) {
            $post->img = url($post->img);
            return $post;
        });

        return $this->sendResponse(PostResource::collection($posts), 'Latest posts retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'category_ids' => 'required|array', // Validasi sebagai array
            'category_ids.*' => 'exists:categories,id', // Setiap Color_id harus valid
            'user_id' => 'required|exists:users,id',
            'body' => 'required|string',
            'read_time' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $post->title = $input['title'];
        $post->user_id = $input['user_id'];
        $post->body = $input['body'];
        $post->read_time = $input['read_time'];
        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('public/images', 'public');
            $fullPath = storage_path('app/public/' . $imagePath);
            $post->img =  '/storage/' .$imagePath;
            $post->save();
        }
        $post->save();

        $post->categories()->sync($input['category_ids']);


        return $this->sendResponse(new PostResource($post), 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return $this->sendResponse([], 'Post deleted successfully.');
    }


    public function addImage(Request $request, $postId)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // Cari post berdasarkan ID
        $post = Post::findOrFail($postId);

        // Simpan file gambar ke dalam folder storage (misalnya: public/images)
        $imagePath = $request->file('image')->store('public/images');
        $imageUrl = str_replace('public/', 'storage/', $imagePath);

        $post->images()->create([
            'image' => $imageUrl,
            'post_id' => $post->id, // Tetapkan post_id ke image
        ]);

        return $this->sendResponse('Photo added successfully.', 'Photo added successfully.');
    }


    public function deleteImage(Image $image)
    {
        $image->delete();

        return $this->sendResponse([], 'Image deleted successfully.');
    }
}
