
@extends('layouts.app')

@section('title', '検索一覧')

@section('content')
    <div class='container'>
        <div class='row justify-content-center'>
            <p>検索ワード：{{ $searchQuery }}</a></p>
            <div>
            </div>
            @foreach ($getSearchTweets as $searchTweet)
                <div class='col-md-8 mb-3'>
                    <div class='card'>
                        <div class="card-haeder p-3 w-100 d-flex">
                            <img src="" class="rounded-circle" width="50" height="50">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ Auth::user()->name }}</p>
                                <a href="" class="text-secondary"></a>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $searchTweet->created_at }}</p>
                            </div>
                        </div>
                        <div class='card-body'>
                            {{ $searchTweet->content }}
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary"><a
                                        href="{{ route('tweet.detail', ['id' => $searchTweet->id]) }}">詳細を見る</a></p>
                            </div>
                            @php
                                $isFavorite = auth()
                                    ->user()
                                    ->isFavorite($searchTweet->id);
                            @endphp
                            <p class="favorite-marke">
                                <a class="js-like-toggle {{ $isFavorite ? 'loved' : '' }}" href=""
                                    data-tweetid="{{ $searchTweet->id }}">
                                    <i class="fas fa-heart"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $getSearchTweets->appends(['searchQuery' => $searchQuery])->links() }}
        </div>
    </div>

    <script src="{{ asset('/js/favorite.js') }}"></script>

@endsection()
