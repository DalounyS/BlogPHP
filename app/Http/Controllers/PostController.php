<?php

namespace App\Http\Controllers;

use Auth;
use File;
use App\Tag;
use App\Post;
use App\Picture;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{

    private $paginate = 10;

    public function __construct(){
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Post';
        $posts = Post::with('category','user','tags')->paginate($this->paginate);

        return view('admin.post.index', compact('posts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('title','id');
        $tags = Tag::lists('name','id');
        $userId = Auth::user()->id;

        return view('admin.post.create', compact('categories','tags','userId','picture'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());

        if(!empty($request->input('tag_id')))
            $post->tags()->attach($request->input('tag_id'));

        $im = $request->file('picture');

        // refactoring voir plus bas la méthode private upload
        if (!empty($im))
            $this->upload($im, $request->input('name'), $post->id);

        return redirect('post')->with(['message'=>'Article crée avec un succès']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::lists('title', 'id');
        $tags = Tag::lists('name','id');
        $userId = Auth::user()->id;

        return view('admin.post.edit', compact('post','categories','tags','userId','picture'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);
        $post->update($request->all());

        if (!empty($request->input('tag_id')))
            $post->tags()->sync($request->input('tag_id'));

        if($request->input('supprimer')) {
           $this->deletePicture($post);
        }

        $im = $request->file('picture');

        if(!empty($im)){
            $this->deletePicture($post);
            $this->upload($im, $request->input('name'),$post->id);
        } else {
            if(!is_null($request->input('name'))){
                $post->picture->update($request->all());
            }
        }

        return redirect('post')->with(['message'=>'Mise à jour de l\'article avec succès']);
    }

    /**
     * upload method
     *
     * @param $im
     * @param $postId
     * @return bool
     */
    private function upload($im, $name, $postId)
    {
        $ext = $im->getClientOriginalExtension(); // extension du fichier
        $uri = str_random(50) . '.' . $ext;

            Picture::create([
                'name' => $name,
                'uri' => $uri,
                'size' => $im->getSize(),
                'mime' => $im->getClientMimeType(),
                'post_id' => $postId
            ]);

            $im->move(env('UPLOAD_PICTURES', 'uploads'), $uri);

        return true;
    }

    /**
     * @param Post $p
     * @return bool
     */
    private function deletePicture(Post $p)
    {
        if (!is_null($p->picture)) {

            $fileName = public_path('uploads') . DIRECTORY_SEPARATOR . $p->picture->uri;

            if (File::exists($fileName))
                File::delete($fileName);

            $p->picture->delete();

            return true;
        }

        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $title = $post->title;

        $post->delete();

        return redirect('post')->with(['message'=>sprintf('L\'article %s a été supprimé avec succès.', $title)]);
    }

    public function changeStatus($id)
    {
        $post = Post::findOrFail($id);
        $title = $post->title;

        $status = $post->status=='published'? 'unpublished' : 'published';
        $post->status = $status;
        $post->save();

        return redirect('post')->with(['message'=>'Le status a été modifié.']);
    }
}
