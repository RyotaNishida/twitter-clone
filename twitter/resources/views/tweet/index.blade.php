@extends('layouts.app')

@section('title', 'ホーム')

@section('content')
    <div class='container'>
        <div class='row justify-content-center'>
            <p><a href="{{ route('tweet.getFavorite', ['userId' => Auth::id()]) }}">いいねした投稿一覧</a></p>
            @foreach ($allTweets as $tweet)
                <div class='col-md-8 mb-3'>
                    <div class='card'>
                        <div class="card-haeder p-3 w-100 d-flex">
                            <img src="" class="rounded-circle" width="50" height="50">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ Auth::user()->name }}</p>
                                <a href="" class="text-secondary"></a>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $tweet->created_at }}</p>
                            </div>
                        </div>
                        <div class='card-body'>
                            {{ $tweet->content }}
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary"><a
                                        href="{{ route('tweet.detail', ['id' => $tweet->id]) }}">詳細を見る</a></p>
                            </div>
                            @if (!auth()->user()->isFavorite(Auth::user()->id, $tweet->id))
                                <p class="favorite-marke">
                                    <a class="js-like-toggle loved" href="" data-tweetid="{{ $tweet->id }}">
                                        <i class="fas fa-heart"></i>
                                    </a>
                                </p>
                            @else
                                <p class="favorite-marke">
                                    <a class="js-like-toggle" href="" data-tweetid="{{ $tweet->id }}">
                                        <i class="fas fa-heart"></i>
                                    </a>
                                    {{-- <span class="favoriteCount"></span> --}}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection()
