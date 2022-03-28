<?php

namespace App\Http\Controllers;

use App\Events\LoginUser;
use App\Http\Requests\PostRequest;
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
        return view('post.index', compact('posts'));

    }

    public function create()
    {
        return view('post.add');
    }

    public function store(PostRequest $request)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'title' => $request->get('title'),
            'body' => $request->get('body'),
        ];

        Post::query()->create($data);

        return redirect()->back()->with('msg', 'مقاله با موفقست ایجاد شد');
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