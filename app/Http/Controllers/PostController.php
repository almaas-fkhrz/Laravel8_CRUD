<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::latest()->paginate(2);
        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'fullname'      => 'required',
            'bio'           => 'required'
        ]);

        $post = Post::create([
            'fullname'      => $request->fullname,
            'bio'           => $request->bio
        ]);

        if ($post){
            //redirect dengan pesan sukses
            return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('posts.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        if ($post){
            //redirect dengan pesan sukses
            return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('posts.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'fullname'      => 'required',
            'bio'           => 'required'
        ]);

        //get data Post by ID
        $post = Post::findOrFail($post->id);

        $post->update([
            'fullname'      => $request->fullname,
            'bio'           => $request->bio
        ]);

        if($post){
            //redirect dengan pesan sukses
            return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('posts.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
}