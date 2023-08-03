@extends('layouts.app')
@section('content')
<div>
    <form action="/home" method="post">
        @csrf
        <input type="text" id="tweet" name="tweet">
        <input type="submit" value="ツイートする">
    </form>
</div>
@endsection
