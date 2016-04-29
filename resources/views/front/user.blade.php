@extends('layouts.master')

@section('content')
    @if(!empty($user))
        <h1>{{$user->name}}</h1>
        @forelse($user->posts as $post)
            <a href="{{URL('article', $post->id)}}"><p>{{$post->title}}<p></a>
        @empty
            <p>Pas d'articles</p>
        @endforelse
    @else
        <p>Pas d'auteur</p>
    @endif
@endsection