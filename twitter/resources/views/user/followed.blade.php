@extends('layouts.app')

@section('title', 'ホーム')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Follow List</h2>
                @foreach ($followed as $follow)
                    {{-- ログイン中のユーザーは非表示に --}}
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            <img src="" class="rounded-circle" width="50" height="50">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $follow->name }}</p>
                                <a href="{{ url('users/' . $follow->id) }}"
                                    class="text-secondary">{{ $follow->screen_name }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
