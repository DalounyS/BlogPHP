<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;

use App\Post;

use App\User;

use App\Tag;

use View;

use Cache;

class FrontController extends Controller
{
    private $paginate = 10;

    public function index(Request $request)
    {
        $title = 'Home';
        $posts = Post::with('category','user','tags','picture')->opened()->paginate($this->paginate);
        $key = 'home'.$request->get('page');

        if(Cache::has($key)){
            $posts = Cache::get($key);
        } else {
            $posts = Post::with('category','user','tags','picture')->opened()->paginate($this->paginate);

            $expire = Carbon::now()->addMinute(1);

            Cache::put($key, $posts, $expire);
        }

    	return view('front.index', compact('posts', 'title', 'category'));
    }

    public function show($id)
    {
    	$title = 'Article';
    	$post = Post::findOrFail($id);

    	return view('front.show', compact('post','title'));
    }

    public function showPostByUser($id){

        $title = 'User';
        $user = User::findOrFail($id);

        return view('front.user', compact('user', 'title'));
    }

    public function showCategory($id){

        $category = Category::findOrFail($id);
        $title = $category->title;

        return view('front.showCategory', compact('category', 'title'));
    }

}
