@extends('layouts.app')

@section('title', 'ホーム')

@section('content')
    <div class='container'>
        <div class='row justify-content-center'>
            <div class='col-md-8 mb-3'>
                <h3>いいねしたツイート</h3>
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
                                </div>
                                @if (!auth()->user()->isFavorite(Auth::user()->id, $favoriteTweet->id))
                                    <p class="favorite-marke">
                                        <a class="js-like-toggle loved" href=""
                                            data-tweetid="{{ $favoriteTweet->id }}">
                                            <i class="fas fa-heart"></i>
                                        </a>
                                    </p>
                                @else
                                    <p class="favorite-marke">
                                        <a class="js-like-toggle" href="" data-tweetid="{{ $favoriteTweet->id }}">
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
    </div>

@endsection()
