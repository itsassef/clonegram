<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class PostsController extends Controller
{
    public function _construct(){
        $this->middleware('auth');
    }

    public function index() {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        return view('posts.index')->with(['posts'=>$posts]);
    }
    public function create() {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'caption' => 'required|max:255',
            'image' => 'required|image'
        ]);


        $imagePath = request('image')->store('uploads','public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/'.auth()->user()->id);

    }

    public function show($post)
    {
        $thepost = Post::findOrFail($post);
        return view('posts.show')->with('post',$thepost);
    }
}
