<ul>
    <li><a href="/">Accueil</a></li>
    <li>
        @forelse($categories as $id=>$title)
            <a href="{{URL('category',$id)}}"> {{$title}}</a>
        @empty
            <p>Pas de categ</p>
        @endforelse
    </li>
    <li><a href="{{URL('login')}}">Login</a></li>
</ul>