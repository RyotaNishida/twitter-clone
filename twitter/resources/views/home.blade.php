@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>投稿一覧</h2>
            <p>{{Auth::user()->name}}</p>
            <p>ツイートを投稿する *ここをリンクにして、ツイート投稿ページに飛びたい</p>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('ログイン!!') }}<br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
