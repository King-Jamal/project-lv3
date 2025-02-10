<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(){
        $posts=Post::get();
        if($posts->count()>0){
            return PostResource::collection($posts);
        }else{
            return response()->json([
                'message'=>'no post available'
            ],200);
        }
    }
    public function store(Request $request){
        $validated=Validator::make($request->all(),[
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'author'=>'required|string|max:255',   
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(),422);
        }
        try{
            $post=Post::create([
                'title'=>$request->title,
                'description'=>$request->description,    
                'author'=>$request->author
            ]);
             return response()->json([
            'message'=>'post has been created successfully',
            'data'=>new PostResource($post)
        ],200);
        }
        catch(\Exception $exception){
            return response()->json(['error'=>$exception->getMessage()],403);
            
        }
        
       
    }
    public function show(Post $post){
        return new PostResource($post);
    }
    public function update(Request $request,Post $post){
        $validated=Validator::make($request->all(),[
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'author'=>'required|string|max:255',   
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(),422);
        }
        try{
            $post->update([
                'title'=>$request->title,
                'description'=>$request->description,    
                'author'=>$request->author
            ]);
             return response()->json([
            'message'=>'post has been updated successfully',
            'data'=>new PostResource($post)
        ],200);
        }
        catch(\Exception $exception){
            return response()->json(['error'=>$exception->getMessage()],403);
            
        }
    }
    public function destroy(Post $post){
        $post->delete();
        return response()->json([
            'message'=>'post has been deleted successfully'
        ],200);

    }
}
