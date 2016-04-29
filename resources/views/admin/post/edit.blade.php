@extends('layouts.admin')

@section('content')
    @if(Session::has('message'))
        <p class="msg">{{Session::get('message')}}</p>
    @endif
    <h1 class="h1-form">Modification d'article</h1>
    <form method="POST" action="{{url('post', $post->id)}}" enctype="multipart/form-data" class="form-create">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="user_id" value="{{$userId}}">
        <div class="title">
        <label>Titre :</label>
        <input type="text" name="title" value="{{$post->title}}">
        @if($errors->has('title'))
            <p><span class="error">{{$errors->first('title')}}</span></p>
        @endif
        </div>
        <div class="content-post">
            <label>Contenu :</label>
            <textarea name="content">{{$post->content}}</textarea>
            @if($errors->has('content'))
                <p><span class="error">{{$errors->first('content')}}</span></p>
            @endif
        </div>
        <div class="photo">
            <label>Photo :</label>
            @if($post->picture)
                <img src="{{url('uploads', $post->picture->uri)}}">
                <label>Supprimer la photo : <input type="checkbox" name="supprimer"><br></label>
                <div><label>Nom de la photo :</label><input type="text" name="name" value="{{$post->picture->name}}"></div><br>
            @else
                <p>Aucune photo.</p>
                <label>Nom de la photo:</label><input type="text" name="name"><br>
            @endif
            <label>Télécharger une autre photo :</label><input type="file" name="picture">
        </div>
        <div class="category">
            <label>Catégorie :</label>
            <select name="category_id">
                @forelse($categories as $id=>$title)
                    <option {{$post->category_id==$id? 'selected' : ''}} value="{{$id}}">{{$title}}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="content-tag">
            <label>Tags :</label>
            @forelse($tags as $id=>$title)
                <div class="tag"><input type="checkbox" name="tag_id[]" {{$post->hasTag($id)? 'checked' : ''}} value="{{$id}}"> {{$title}}<br></input></div>
            @empty
                Pas de tag.
            @endforelse
                <div class="tag"><input type="checkbox" selected value="0"> Pas de tags.</input></div>
            </select><br>
        </div>
        <div class="date">
            <label>Date :</label>
            <input type="date" name="published_at" value="{{$post->published_at->format('Y-m-d')}}">
            <p><label for="status">Publier l'article:</label> <input {{$post->status=='published'? 'checked' : ''}} id="status" type="checkbox" name="status" value="published"></p>
        </div>
        <div class="container-btn">
            <br><input type="submit" value="Mettre à jour" class="btn-validate">
            <a href="{{url("post")}}" class="btn-delete">Annuler</a>
        </div>
    </form>
@endsection
