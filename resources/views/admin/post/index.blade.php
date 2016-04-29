@extends('layouts.admin')

@section('content')
    @if(Session::has('message'))
        <p>{{Session::get('message')}}</p>
    @endif
    {{ $posts->links() }}
    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Statut</th>
            <th>Titre</th>
            <th>Date</th>
            <th>Catégorie</th>
            <th>Mot-clefs</th>
            <th>Editer</th>
            <th>Supprimer</th>
        </tr>
        </thead>
        <div id="confirm">
            <p>Confirmez vous la suppression de l'article :  <span></span> ?</p>
        </div>
        @forelse($posts as $post)
            <tr>
                <td>
                    @if($post->id)
                       <p class="id">{{$post->id}}</p>
                    @else
                        Aucun ID affecté.
                    @endif
                </td>
                <td>
                    @if($post->status)
                        <a href="{{url("changeStatus", $post->id)}}" class="btn-a">{{$post->status}}</a>
                    @else
                        No status.
                    @endif

                </td>
                <td>
                    @if($post->title)
                        <h1>{{$post->title}}</h1>
                    @else
                        Pas de titre.
                    @endif
                </td>
                <td>
                    @if($post->published_at)
                        {{$post->published_at->format('d/m/Y')}}
                    @else
                        Pas de date.
                    @endif
                </td>
                <td>
                    @if($post->category)
                        {{$post->category->title}}
                    @else
                        Pas de catégorie.
                    @endif
                </td>
                <td>
                    @if($post->tags)
                        @foreach($post->tags as $tag)
                            {{$tag->name}}
                        @endforeach
                    @else
                        Pas de tags.
                    @endif
                </td>
                <td>
                    <a href="{{URL('post',[$post->id,'edit'])}}" class="btn-a btn-edit">Editer</a>
                </td>
                <td>
                    <form action="{{url('post', $post->id)}}" method="POST">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <input type="hidden" name="title_h" value="{{$post->title}}">
                        <input type="submit" value="Delete" name="delete" class="btn-delete">
                    </form>
                </td>
                @empty
                    <p>Aucun post.</p>
            </tr>
        @endforelse
    </table>
@endsection

