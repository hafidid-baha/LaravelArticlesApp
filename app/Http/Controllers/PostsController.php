<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        // $posts = auth()->user()->posts; 
        return view('posts.posts')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validat the comming data from the form
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'image'=>'image|nullable'
        ]);

        // handle file uploading
        if($request->hasFile('image')){
            // generate a proper file name
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $name = pathinfo($filename,PATHINFO_FILENAME).'_'.time();
            $ext = pathinfo($filename,PATHINFO_EXTENSION);

            $fullName = $name.'.'.$ext;
            // Storage::putFileAs('postsImages', $file,$fullName);
            $file->storeAs('public/postsImages',$fullName);
        }else{
            $fullName = 'noImage.jpg';
        }
        
        // create new post object
        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->image = $fullName;
        $post->save();

        // redirect to the posts page
        return redirect('/posts')->with('success','Post Created');
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
        $post = Post::find($id);
        return view('posts.single')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edite')->with('post',$post);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validat the comming data from the form
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'image'=>'image|nullable'
        ]);
        // get the desired post from database
        $post = Post::find($id);
        // handle file uploading
        if($request->hasFile('image')){
            // generate a proper file name
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $name = pathinfo($filename,PATHINFO_FILENAME).'_'.time();
            $ext = pathinfo($filename,PATHINFO_EXTENSION);

            $fullName = $name.'.'.$ext;
            // delete the old image first
            if($post->image != 'noImage.jpg'){
                Storage::delete('public/postsImages/'.$post->image);
            }

            // Storage::putFileAs('postsImages', $file,$fullName);
            $file->storeAs('public/postsImages',$fullName);
        }

    
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('image')){
            $post->image = $fullName;
        }
        $post->save();

        // redirect to the posts page
        return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // find the selected post
        $post = Post::find($id);
        $post->delete();
        Storage::delete('public/postsImages/'.$post->image);

        return redirect('/posts')->with('success','Post Deleted');
    }
}
