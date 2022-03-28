<?php

namespace App\Http\Controllers;

use App\Events\LoginUser;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{

    public function index()
    {

        $user = auth()->user();

        event(new LoginUser($user));
        $posts = Post::all();
        return view('posts', compact('posts'));

    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        //
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        if (Gate::allows('delete', $post)) {
            $post->delete();
            session()->flash('msg', 'پست با موفقیت پاک شد');
        }
        session()->flash('err', 'شما مجوز پاک کردن این پست را ندارید');

        return redirect()->back();
    }
}