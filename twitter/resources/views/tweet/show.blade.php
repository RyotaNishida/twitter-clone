@extends('layouts.app')

@section('title', 'ツイート詳細')

@section('content')
    <div class='container'>
        <div class='row justify-content-center'>
            <div class='col-md-8 mb-3'>
                <div class='card'>
                    <div class="card-haeder p-3 w-100 d-flex">
                        <img src="" class="rounded-circle" width="50" height="50">
                        <div class="ml-2 d-flex flex-column">
                            <p class="mb-0">{{ Auth::user()->name }}</p>
                            <a href="" class="text-secondary"></a>
                        </div>
                        <div class="d-flex justify-content-end flex-grow-1">
                            <p class="mb-0 text-secondary">{{ $tweetDetail->created_at }}</p>
                        </div>
                    </div>
                    <div class='card-body'>
                        {{ $tweetDetail->content }}
                        <div class="d-flex justify-content-end flex-grow-1">
                            <p>
                                <button type="submit" class="btn btn-danger">
                                    <a href="{{ route('tweet.edit', ['id' => $tweetDetail]) }}">編集する</a>
                                </button>
                            </p>
                            <p>
                            <form action="{{ route('tweet.delete', ['id' => $tweetDetail->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">削除</button>
                            </form>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
