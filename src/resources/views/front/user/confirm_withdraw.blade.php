@extends('front.layouts.base')

@section('title', '退会の確認')

@section('content')
<div class="container">
  <div class="h3 text-center mt-2">本当に退会しますか？</div>

  <div class="col-6 mx-auto text-center">
    <div class="mx-auto mt-4">
      <a class="plain-link" href="{{ route('users.show', $user->id) }}">
        <button type="button" class="btn btn-danger">
          戻る
        </button>
      </a>
    </div>

    <div class="mt-3">
      <form action="{{ route('users.destroy', $user) }}" method="post">
        @csrf
        @method('DELETE')
        <input class="btn btn-secondary" type="submit" value="退会する">
      </form>
    </div>
  </div>
</div>
@stop
