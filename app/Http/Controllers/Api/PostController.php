<?php

namespace App\Http\Controllers\Api;

use App\Base\Responses\apiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\storePostRequest;
use App\Http\Requests\Posts\updatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    use apiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        if (Post::all()->count() == 0) {
            return $this->successfully('There No Data', [
                'posts' => PostResource::collection($posts)]);
        }
        return $this->successfully('Data Send Successfully', [
            'posts' => PostResource::collection($posts)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storePostRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = upload_image('Posts/', $request->image);
        }
        $post = Post::create($data);
        return $this->successfully('Data created Successfully', [
            'post' => PostResource::make($post)]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return $this->failed('Post Not Found');
        }
        return $this->successfully('Get Data Of This Post Successfully', [
            'post' => PostResource::make($post)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updatePostRequest $request,$id)
    {
        $post = Post::find($id);
        $data = $request->validated();
        if (!$post) {
            return $this->failed('Post Not Found');
        }
        if ($request->hasFile('image')) {
            if ($post->image != null && File::exists(public_path('uploads/Posts/' . $post->image))) {
                unlink(public_path('uploads/Posts/' . $post->image));
            }
            $data['image'] = upload_image('Posts/', $request->image);
        }

        $post->update($data);
        return $this->successfully('Data Updated Successfully', [
            'post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return $this->failed('Post Not Found');
        }

        if ($post->image != null && File::exists(public_path('uploads/Posts/' . $post->image))) {
            unlink(public_path('uploads/Posts/' . $post->image));
        }
        $post->delete();
        return $this->successfully('Post Deleted Successfully', []);
    }
}
