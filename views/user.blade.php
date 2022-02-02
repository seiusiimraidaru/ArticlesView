@extends('layout')
@section('title', $user->name)
@section('content')

<div class="card-body">
                        <h5 class="card-title fs-1">{{ $user->name }}</h5>
                        <p class="card-text fs-1">Posts: {{ $user->articles->count()}}</p>
               

                    
</div>  
<div>{{ $articles->links('partials.pagination') }}</div>
        <div class="row row-cols-4 mt-3">
            @foreach($articles as $article)
                <div class="col mb-3">
                    <div class="card">
                        @if($article->images->count())
                            @if($article->images->count() > 1)
                                @include('partials.carousel', ['images' => $article->images, 'id' => $article->id])
                            @else
                                <img src="{{ $article->images->first()->path }}" class="card-img-top" alt="...">
                            @endif
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">{{ $article->excerpt }}</p>
                            <a href="{{ route( 'article', ['article'=> $article->id] ) }}" class="btn btn-primary">Read more</a>

                            <p class="card-text">
                            <a href="{{ route( 'user', ['user'=> $article->user] ) }}"><small class="fs-4 text-decoration-none">{{ $article->user->name }}</small><br></a>
                                <small class="text-muted">Created {{ $article->created_at->diffForHumans() }}</small><br>
                                <small class="text-muted">Updated {{ $article->updated_at->diffForHumans() }}</small><br>
                                <small class="text-muted">Comments: {{ $article->comments()->count() }}</small><br>
                                <small class="text-muted">Likes: {{ $article->likes()->count() }}</small><br>
                                <a href="/articles/{{$article->id}}/like">
                                    @if($article->isLiked)
                                        unlike
                                    @else
                                        like
                                    @endif
                                </a><br>
                                @foreach($article->tags as $tag)
                                    <a href="/articles/tags/{{$tag->id}}" class="text-decoration-none">
                                        <span class="badge rounded-pill bg-secondary">{{$tag->name}}</span>
                                    </a>
                                @endforeach
                            </p>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div>{{ $articles->links('partials.pagination') }}</div>
@endsection
