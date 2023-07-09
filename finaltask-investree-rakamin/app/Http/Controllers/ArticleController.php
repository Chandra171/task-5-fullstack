<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use App\Models\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = Article::all();
        $user = User::all();
        return view('article.index', compact('article', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('article.create', compact('category'));
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
            'content' => 'required',
    		'image' => 'required|max:2048',
            'category_id' => 'required'
        ]);

        $id = Auth::id();
  
        $imageName = time().'.'.$request->image->extension();  
   
        $request->image->move(public_path('images'), $imageName);

        $article = new Article;
 
        $article->title = $request->title;
        $article->content = $request->content;
        $article->image = $imageName;
        $article->user_id = $id;
        $article->category_id = $request->category_id;

        $article->save();

        return redirect('/article');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        $category = Category::all();
        $user = User::all();

        return view('article.show', compact('article', 'category', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $category = Category::all();
        return view ('article.edit', compact('article', 'category'));
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
        $request->validate([
            'title' => 'required',
            'content' => 'required',
    		'image' => 'max:2048',
            'category_id' => 'required'
        ]);

        $article = Article::find($id);
        $imageName = $article->image;

        if($request->has('image')){
            $path = "images/";
            File::delete($path . $article->image);

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $article->image = $imageName;
            $article->save();
        }
        
        $article->title = $request->title;
        $article->content = $request->content;
        $article->category_id = $request->category_id;

        $article->save();

        return redirect('/article');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $path = 'images/';
        file::delete($path, $article->image);
        $article->delete();

        return redirect('/article');
    }

    public function isOwner()
    {
        $user = User::all();
        return Auth::user()->id == $this->$user->id;
    }

}
