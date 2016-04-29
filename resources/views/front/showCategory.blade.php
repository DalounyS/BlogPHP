@extends('layouts.master')

@section('content')
    <div class="post categ-front">
    @if(!empty($category))
        <h1 class="h1-form">Articles de la catégorie: {{$category->title}}</h1>
        @forelse($category->posts as $post)
            <h2><a href="{{URL('article', $post->id)}}"><p>{{$post->title}}<p></a></h2>
            <p class="excerpt">{{excerpt($post->content)}}</p>
            @if($post->picture)
                <div class="picture">
                    <img src="{{url('uploads', $post->picture->uri)}}">
                </div>
            @endif

        @empty
            <p>Pas d'articles</p>
        @endforelse
    @else
        <p>Catégorie non trouvé</p>
    @endif
    </div>
@endsection