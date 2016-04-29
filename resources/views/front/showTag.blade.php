@extends('layouts.master')

@section('content')
    @if(!empty($tag))
        <h1><b>Tag :</b> {{$title}}</h1>
        <h2>Articles associés :</h2>
        @forelse($tag->posts as $post)
            <a href="{{URL('article', $post->id)}}"><p>{{$post->title}}<p></a>
        @empty
            <p>Pas d'articles</p>
        @endforelse
    @else
        <p>Tag non trouvé</p>
    @endif
@endsection