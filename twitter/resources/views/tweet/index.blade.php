@extends('layouts.app')

@section('title', 'ホーム')

@section('content')
    <div class='container'>
        <h1>{{ isset($query) ? '検索結果' : 'ツイート一覧' }}</h1>

        <div class='row justify-content-center'>
            <p><a href="{{ route('tweet.getFavorite', ['userId' => Auth::id()]) }}">いいねした投稿一覧</a></p>
            <div>
                <form action="{{ route('tweet.getAll') }}" method="GET">
                    <p>
                        <input type="text" name="searchQuery" value="" placeholder="検索">
                        <input type="submit" value="検索">
                        <p>
                             {{-- 検索フォームが空の状態でsubmitした時にバリデーションメッセージ表示 --}}
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </p>
                    </p>
                </form>
            </div>
            @foreach ($tweets as $tweet)
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
                            @php
                                $isFavorite = auth()
                                    ->user()
                                    ->isFavorite($tweet->id);
                            @endphp
                            <p class="favorite-marke">
                                <a class="js-like-toggle {{ $isFavorite ? 'loved' : '' }}" href=""
                                    data-tweetid="{{ $tweet->id }}">
                                    <i class="fas fa-heart"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- ツイート一覧のページネーション --}}
            {{ $tweets->links() }}
        </div>
    </div>

    <script src="{{ asset('/js/favorite.js') }}"></script>

@endsection()
