<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(){
        $posts=Post::orderBy('id','desc')->get();
        if($posts->count()>0){
            // return PostResource::collection($posts);
            return view('posts',['title'=>'All Posts','posts'=>$posts]);
        }else{
            // return response()->json([
            //     'message'=>'no post available'
            // ],200);
            return view('posts',['title'=>'No Posts Available','posts'=>$posts]);
        }
    }
    public function create(){
        // return redirect()->route('posts.create',['title'=>'Create Post']);
        return view('create',['title'=>'Create Post']);
    }
    public function store(Request $request){
        // $validated=Validator::make($request->all(),[
        //     'title'=>'required|string|max:255',
        //     'description'=>'required|string',
        //     'author'=>'required|string|max:255',   
        // ]);
        // if($validated->fails()){
        //     return response()->json($validated->errors(),422);
        // }
        // try{
        //     $post=Post::create([
        //         'title'=>$request->title,
        //         'description'=>$request->description,    
        //         'author'=>$request->author
        //     ]);
        //      return response()->json([
        //     'message'=>'post has been created successfully',
        //     'data'=>new PostResource($post)
        // ],200);
        // }
        // catch(\Exception $exception){
        //     return response()->json(['error'=>$exception->getMessage()],403);
            
        // }
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
        // return view('posts',['title'=>'All Posts','posts'=>Post::all()]);
       }
       return redirect()->route('posts.store',['title'=>'Create Post']);
        
       
    }
    public function show($id){
        // return new PostResource($post);
        $post=Post::find($id);
        if(!$post){
            return response()->json([
                'message'=>'post not found'
            ],404);

        }else{
            // 
            return view('post',['title'=>'Single Post','post'=>$post]);

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
       return redirect()->route('posts.edit',['title'=>'Edit Post','post'=>$post]);
       

    }
    public function destroy($id){
        
        $post=Post::find($id);
        if(!$post){
            return redirect()->route('posts.index')->with('error','post not found');
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success','deleted successfully');

        // return response()->json([
        //     'message'=>'post has been deleted successfully'
        // ],200);
        
    }
    public function edit( $id){
        $post=Post::find($id);
        // dd($post->id);
        // if(!$post){
        //     session()->flash('error','post not found');
        //     return redirect()->route('posts.index');
        // }
        // return redirect()->route('posts.edit')->with('post',$post);
        return view('edit',['title'=>'Edit Post','post'=>$post]);
    }
}
