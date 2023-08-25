@extends('layouts.app')

@section('title', 'ホーム')

@section('content')
    <div class='container'>
        <div class='row justify-content-center'>
            @foreach ($favoriteTweets as $favoriteTweet)
                <div class='col-md-8 mb-3'>
                    <div class='card'>
                        <div class="card-haeder p-3 w-100 d-flex">
                            <img src="" class="rounded-circle" width="50" height="50">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ Auth::user()->name }}</p>
                                <a href="" class="text-secondary"></a>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $favoriteTweet->created_at }}</p>
                            </div>
                        </div>
                        <div class='card-body'>
                            {{ $favoriteTweet->content }}
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary"><a
                                        href="{{ route('tweet.detail', ['id' => $favoriteTweet->id]) }}">詳細を見る</a></p>
                            </div>
                            @php
                                $isFavorite = auth()
                                    ->user()
                                    ->isFavorite($favoriteTweet->id);
                            @endphp
                            <p class="favorite-marke">
                                <a class="js-like-toggle {{ $isFavorite ? 'loved' : '' }}" href=""
                                    data-tweetid="{{ $favoriteTweet->id }}">
                                    <i class="fas fa-heart"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="{{ asset('/js/favorite.js') }}"></script>

@endsection()
