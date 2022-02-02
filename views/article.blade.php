@extends('layout')
@section('title', $article->title)
@section('content')


            <a class="btn btn-primary my-3" href="{{url()->previous()}}">Back</a>
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
                        <p class="card-text">{{ $article->body }}</p>
                        <p class="card-text"><small class="text-muted">{{ $article->user->name }}</small></p>
                        <p class="card-text"><small class="text-muted">Created {{ $article->created_at->diffForHumans() }}</small></p>
                        <p class="card-text"><small class="text-muted">Updated {{ $article->updated_at->diffForHumans() }}</small></p>                    </div>
                </div>

                <div class="card my-2">
                    <div class="card-body">
                       <form action="{{route('comment.store', ['article' => $article->id])}}" method="POST">
                           @csrf
                           <textarea class="form-control mb-2" name="body" placeholder="Write some comment here..."></textarea>
                            <input type="submit" class="btn btn-primary">
                       </form>
                    </div>
                </div>

                @foreach($article->comments as $comment)
                    <div class="card my-2">
                        <div class="card-body">
                            {{ $comment->body }}
                            <p class="card-text"><small class="text-muted">{{ $comment->user->name }}</small></p>
                            <p class="card-text"><small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small></p>
                        </div>
                    </div>
                @endforeach

@endsection
