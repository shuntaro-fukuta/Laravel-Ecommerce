@extends('front.layouts.base')

@section('title', '退会の確認')

@section('content')
<div class="container text-center">
  <div class="h3 mt-4">退会処理が完了しました。</div>
  <a class="h4 mt-3" href="{{ route('home') }}">TOPへ</a>
</div>
@stop
