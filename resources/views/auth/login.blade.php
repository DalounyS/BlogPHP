@extends('layouts.master')

@section('content')
    <form method="POST" action="{{url('login')}}">
        {{csrf_field()}}
        <label>Email</label>
        <input type="email" name="email" value="">
        @if($errors->has('email'))
            <span class="error">{{$errors->first('email')}}</span>
        @endif
        <label>Mot de passe</label>
        <input type="password" name="password">
        @if($errors->has('password'))
            <span class="error">{{$errors->first('password')}}</span>
        @endif
        <label>Se rappeler de moi</label>
        <input type="radio" id="remember" name="remember" value="remember">
        <p><input type="submit" value="Connexion" class="btn-connect"></p>
    </form>
@endsection