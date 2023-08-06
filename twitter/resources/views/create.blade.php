@extends('layouts.app')
@section('content')
<div>
    <form action="/tweets" method="post">
        @csrf
        <input type="text" id="tweet" name="tweet">
        <input type="submit" value="ツイートする">
    </form>
    @if($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection
