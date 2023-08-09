@extends('layouts.app')

@section('title', 'ユーザー詳細')

@section('content')
<div>
  <ul>
    <p>現在のユーザー情報</p>
    <li>ID：{{ $userDetail->id }}</li>
    <li>ユーザー名：{{ $userDetail->name }}</li>
    <li>メールアドレス：{{ $userDetail->email }}</li>
  </ul>

  <form action="{{ route('user.update', ['id' => $userDetail->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <ul>
      <li>
        <label for="name">ユーザー名</label>
        <input value={{ $userDetail->name }} name='name'>
      </li>
      <li>
        <label for="email">メールアドレス</label>
        <input value={{ $userDetail->email }} name='email'>
      </li>
      @if($errors->any())
        <div>
          <ul>
            @forEach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
    </ul>

    <button type="submit" class="btn btn-primary">
      ユーザ情報を更新する
    </button>
  </form>

  <form action="{{ route('user.delete', ['id' => $userDetail->id]) }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-primary">
      ユーザ情報を削除する
    </button>
  </form>
</div>
@endsection