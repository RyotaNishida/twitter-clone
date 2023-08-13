@extends('layouts.app')

@section('title', 'ツイート編集')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update</div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ route('tweet.update', [
                                'id' => $tweets->id,
                                'user_id' => $tweets->user_id,
                                'content' => $tweets->content,
                            ]) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row mb-0">
                                <div class="col-md-12 p-3 w-100 d-flex">
                                    <img src="" class="rounded-circle" width="50" height="50">
                                    <div class="ml-2 d-flex flex-column">
                                        <p class="mb-0">{{ Auth::user()->name }}</p>
                                        {{-- <a href="{{ url('users/' .$user->id) }}" class="text-secondary">{{ $user->screen_name }}</a> --}}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control @error('text') is-invalid @enderror" name="tweet" required autocomplete="text"
                                        rows="4" value='{{ $tweets->content }}'>
                                        {{ old('text') ?: $tweets->text }}
                                    </textarea>

                                    @error('text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12 text-right">
                                    <p class="mb-4 text-danger">140文字以内</p>
                                    <button type="submit" class="btn btn-primary">
                                        編集する
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
