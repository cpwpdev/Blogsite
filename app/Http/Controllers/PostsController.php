<?php

namespace App\Http\Controllers;
use App\Http\Requests\PostForRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => ['required','min:10'],
            'imagepath' => 'required'

    
        ]);
        if (!$request->has('imagepath')) {
            return response()->json(['message' => 'Missing file'], 422);
        }
         
        $image_path = $request->file('imagepath')->store('images', 'public');

        $post = new Post();
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->imagepath = $image_path;
        $post->save();

        return redirect()->route('home')
        ->with('success','post is Submited')
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
         
        return view('posts.edit',[
            'post' => $post,
         ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Post $post)
    {
         
        $request->validate([
            'title' => 'required',
            'description' => ['required','min:10']
            //'imagepath' => 'required'

    
        ]);
         
        if ($request->has('imagepath')) {
        $image_path = $request->file('imagepath')->store('images', 'public');
        }
        $post = $post;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        if ($request->has('imagepath')) {
        $post->imagepath = $image_path;
    }
        $post->save();
        
        return redirect()->route('home',[$post])
        ->with('success','Post updated!:');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post = $post;
        $post->delete();
        return redirect()->route('home',[$post])
        ->with('success','DELETED');
    }
}
