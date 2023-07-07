<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

    $post = Post::paginate(10)->all();
    return response()->json([
        'data' => $post
    ],200);

    }

    public function store(Request $request){
        $id = Auth::id();
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $request->image,
            'user_id' => $id,
            'categories_id' =>$request->categories_id
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil disimpan',
            'data' => $post
        ]);
    }

    public function show($id){

        $post = Post::find($id);
        if($post){
            return response()->json([
                'status' => true,
                'message' => "Data ditemukan",
                'data' => $post
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => "Data tidak ditemukan",
                'data' => $post
            ]);
        }

    }

    public function update(Request $request, $id){
        $id_login = Auth::id();

        $post = Post::find($id);

        if($post){
        $post->title = $request->title;
        $post->content = $request->content;
        $post->image = $request->image;
        $post->user_id = $id_login;
        $post->categories_id = $request->categories_id;
        $post->save();

        return response()->json([
            'status' =>true,
            'message'=> 'data berhasil diubah',
            'data' => $post
        ]);
    }
        // }else{
        //     return response()->json([
        //         'message'=> 'data gagal diubah',
        //     ]);
        // }
    }

    public function destroy($id){
        $post = Post::find($id);
        $post->delete();
        return response()->json([
            'status' => true,
            'message' => "Post Telah DIhapus"
        ]);
    }
}
