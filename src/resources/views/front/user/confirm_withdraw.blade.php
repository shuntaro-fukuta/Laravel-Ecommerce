@extends('front.layouts.base')

@section('title', '退会の確認')

@section('content')
<div class="container">
  <div class="h3 text-center mt-2">本当に退会しますか？</div>

  <div class="col-6 mx-auto">
    <form method="POST" class="text-center">
      @csrf
      @method('DELETE')


      <div class="mx-auto mt-4">
        <a class="plain-link" href="{{ route('user.show', $user->id) }}">
          <button type="button" class="btn btn-danger">
            戻る
          </button>
        </a>
      </div>

      <div class="mt-3">
        <input class="btn btn-secondary" type="submit" value="退会する">
      </div>
    </form>
  </div>
</div>
@stop
