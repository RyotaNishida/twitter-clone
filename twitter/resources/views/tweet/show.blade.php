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
                            @php
                                $isFavorite = auth()
                                    ->user()
                                    ->isFavorite($tweetDetail->id);
                            @endphp

                            <p class="favorite-marke">
                                <a class="js-like-toggle {{ $isFavorite ? 'loved' : '' }}" href=""
                                    data-tweetid="{{ $tweetDetail->id }}">
                                    <i class="fas fa-heart"></i>
                                </a>
                            </p>
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

                        <div class="d-flex justify-content-end flex-grow-1">
                            <form action="{{ route('tweet.reply', ['id' => $tweetDetail->id]) }}" method="POST">
                                @csrf
                                <input type="text" name='reply' placeholder="返信する">
                                <button type="submit">返信</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class='container'>
        <div class='row justify-content-center'>
            <h3>↓コメントです</h3>
            @foreach ($allReply as $reply)
                <div class='col-md-8 mb-3'>
                    <div class='card'>
                        <div class="card-haeder p-3 w-100 d-flex">
                            <img src="" class="rounded-circle" width="50" height="50">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ Auth::user()->name }}</p>
                                <a href="" class="text-secondary"></a>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $reply->created_at }}</p>
                            </div>
                        </div>
                        <div class='card-body'>
                            <div>
                                <p class='reply-content' id='reply-content-{{ $reply->id }}'>{{ $reply->content }}</p>

                                <form action="{{ route('tweet.editreply', ['id' => $reply->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="replyId" value="{{ $reply->id }}">
                                    <input class="edit-formarea edit-formarea-{{ $reply->id }}" name="reply"
                                        style="display:none"></input>
                                    <input class="edit-formbtn edit-form-button-{{ $reply->id }}" type="submit"
                                        style="display:none" value='送信'>
                                </form>
                                </p>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <button type="submit" class="edit-btn" data-reply-id="{{ $reply->id }}">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>

                                <form action="{{ route('tweet.deletereply', ['id' => $reply->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
<script src="{{ asset('/js/reply.js') }}"></script>
@endsection()
