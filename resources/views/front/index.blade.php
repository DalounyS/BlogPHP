@extends('layouts.master')

@section('title', $title)

@section('content')
    @if(Session::has('message'))
        <p>{{Session::get('message')}}</p>
    @endif
        @forelse($posts as $post)
            <div class="post">
                @if($post->title)
                    <h2><a href="{{url('article',$post->id)}}">{{$post->title}}</a></h2>
                @else
                    Pas de titre.
                @endif
                @if($post->picture)
                    <img src="{{url('uploads', $post->picture->uri)}}">
                @endif
                @if($post->category)
                    <div class="info">
                        <h3>Catégories:</h3> <p class="mot">{{$post->category->title}}</p>
                    </div>
                @else
                    Pas de catégorie.
                @endif
                @if($post->tags)
                    <div class="info">
                        <h3>Mots clefs:</h3>
                        @foreach($post->tags as $tag)
                            <p class="mot">{{$tag->name}}</p>
                        @endforeach
                    </div>
                @else
                    Pas de tags.
                @endif
                @if($post->published_at)
                    <div class="info">
                        <h3>Publiée le:</h3> <p class="mot">{{$post->published_at->format('d/m/Y')}}</p>
                    </div>
                @else
                    Pas de date.
                @endif
                    @if($post->user)
                        <div class="info">
                            <h3>Publiée par:</h3> <p class="mot">{{$post->user->name}}</p>
                        </div>
                    @else
                        Auteur non renseigné.
                    @endif
            </div>
        @empty
            <p>Aucun post.</p>

        @endforelse
    {{ $posts->links() }}
@endsection