<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts=Post::orderBy('id','desc')->get();
        if($posts->count()>0){
            return view('posts',['title'=>'All Books','posts'=>$posts]);
        }else{
            return view('posts',['title'=>'No Book Available','posts'=>$posts]);
        }
    }
    public function create(){
        return view('create',['title'=>'Create a Book']);
    }
    public function store(Request $request){
        $request->validate([
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'author'=>'required|string|max:255',   
        ],[
            'title.required'=>'title is required',
            'description.required'=>'description is required',
            'author.required'=>'author is required'
        ]);
       $create=Post::create([
        'title'=>$request->title,
        'description'=>$request->description,    
        'author'=>$request->author
       ]);
       if($create){
        return redirect()->route('posts.index')->with('success','post has been created successfully');
       }
       return redirect()->route('posts.store',['title'=>'Create a Book']);
        
       
    }
    public function show($id){
        $post=Post::find($id);
        if(!$post){
            return response()->json([
                'message'=>'post not found'
            ],404);

        }else{
            return view('post',['title'=>'Detail Book','post'=>$post]);

        }
    }
    
    public function update(Request $request, $id){
        $post=Post::find($id); 
        $request->validate([
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'author'=>'required|string|max:255',   
        ],[
            'title.required'=>'title is required',
            'description.required'=>'description is required',
            'author.required'=>'author is required'
        ]);
       $updated=$post->update([
        'title'=>$request->title,
        'description'=>$request->description,    
        'author'=>$request->author
       ]);
       if($updated){
        return redirect()->route('posts.index');
       }
       return redirect()->route('posts.edit',['title'=>'Edit Book','post'=>$post]);
       

    }
    public function destroy($id){
        
        $post=Post::find($id);
        if(!$post){
            return redirect()->route('posts.index')->with('error','post not found');
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success','deleted successfully');
    }
    public function edit( $id){
        $post=Post::find($id);
        return view('edit',['title'=>'Edit Book','post'=>$post]);
    }
}
