@extends('layouts.master')

@section('content')
    <div class="post">
        @if(!empty($post))
            <h2>{{$post->title}}</h2>
            @if($post->picture)
                <img src="{{url('uploads', $post->picture->uri)}}">
            @endif
            <p>{{$post->content}}</p>
            @if($post->category)
                <p><b>Catégorie :</b> <a href="{{URL('category',$post->category->id)}}">{{$post->category->title}}</a></p>
            @else
                <p>Pas de catégorie.</p>
            @endif
            @if($post->tags)
                <p><b>Tag :</b>
                    @foreach($post->tags as $tag)
                        {{$tag->name}}
                    @endforeach
                <p>
            @else
                Pas de tags.
            @endif
            @if($post->published_at)
                <p><b>Publié le:</b> {{$post->published_at->format('d/m/Y')}}</p>
            @else
                Date de publication non renseignée.
            @endif
        @else
            <p>Pas d'articles</p>
        @endif
    </div>
@endsection