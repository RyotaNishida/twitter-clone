@extends('layouts.app')

@section('title', 'ユーザー一覧')

@section('content')
  <h2>ユーザー一覧</h2>
  @foreach($users as $user)
    <ul>
      <li>ユーザー名：{{ $user->name }}</li>
      <li>メールアドレス：{{ $user->email }}</li>
    </ul>
  @endforeach
@endsection