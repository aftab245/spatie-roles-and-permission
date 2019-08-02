<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Post;
use Auth;
use Session;

class PostController extends Controller {

    public function __construct() {
        $this->middleware(['auth', 'clearance'])->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index() {
        $posts = Post::orderby('id', 'desc')->paginate(3);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) { 

    //Validating title and body field
        $this->validate($request, [
            'title'=>'required|max:100',
            'image' =>'image|nullable',
            ]);

        if($request->hasFile('image'))//file upload
        {
            $fileNameWithExt = $request->file('image')->getClientOriginalName();  //file name with extension
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);              //just file name
            $extension = $request->file('image')->getClientOriginalExtension();   //just extension
            $fileNameToStore = $fileName.'-'.time().'.'.$extension;                    //file name to store
            $path = $request->file('image')->storeAs('public/images',$fileNameToStore);   //image upload
        }
        else
        {
            $fileNameToStore = 'avatar.jpg';
        }
        
        $post = new Post;
        $post->title = $request->input('title');
        $post->user_id = auth()->user()->id;
        $post->image = $fileNameToStore ; 
        $post->save();
        return redirect()->route('posts.index')
            ->with('flash_message', 'Post
             '. $post->title.' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $post = Post::findOrFail($id); //Find post of id = $id
        // if(auth()->user()->id != $post->user_id)
        // {
        //     return redirect()->route('posts.index')
        //     ->with('flash_message',
        //      'This post is private');
        // }

        return view ('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'title'=>'required|max:100',
            'image'=>'image|nullable',
        ]);

        if($request->hasFile('image'))//file upload
        {
            $fileNameWithExt = $request->file('image')->getClientOriginalName();  //file name with extension
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);              //just file name
            $extension = $request->file('image')->getClientOriginalExtension();   //just extension
            $fileNameToStore = $fileName.'-'.time().'.'.$extension;                    //file name to store
            $path = $request->file('image')->storeAs('public/images',$fileNameToStore);   //image upload
        }
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->image = $request->input('image');
        if($request->hasFile('image'))
        {
            $post->image = $fileNameToStore;
        }
        $post->save();

        return redirect()->route('posts.show', 
            $post->id)->with('flash_message', 
            'Post '. $post->title.' updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $post = Post::findOrFail($id);
        if(auth()->user()->id != $post->user_id)
        {
            return redirect()->route('posts.index')
            ->with('flash_message',
             'Post cannot be deleted');
        }
        if($post->image != 'avatar.jpg')
        {
            Storage::delete('public/images/'.$post->image);
        }
        $post->delete();

        return redirect()->route('posts.index')
            ->with('flash_message',
             'Post successfully deleted');

    }
}