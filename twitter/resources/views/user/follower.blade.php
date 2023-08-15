@extends('layouts.app')

@section('title', 'ホーム')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Follower List</h2>
                @foreach ($followers as $follower)
                    {{-- ログイン中のユーザーは非表示に --}}
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            <img src="" class="rounded-circle" width="50" height="50">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $follower->name }}</p>
                                <a href="{{ url('users/' . $follower->id) }}"
                                    class="text-secondary">{{ $follower->screen_name }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
