@extends('front.layouts.base')

@section('title', '会員情報')

@section('content')
<div class="container">
  <h2 class="text-center my-3">会員情報</h2>

  <div class="card col-6 mx-auto mt-2">
    <div class="row mt-3">
      <div class="col-8 mx-auto d-flex my-2 font-weight-bold">
        <div class="col-5">氏名</div>
        <div>{{ $user->name }}</div>
      </div>
    </div>

    <div class="row">
      <div class="col-8 mx-auto d-flex my-2 font-weight-bold">
        <div class="col-5">メールアドレス</div>
        <div>{{ $user->email }}</div>
      </div>
    </div>

    <div class="row">
      <div class="col-8 mx-auto d-flex my-2 font-weight-bold">
        <div class="col-5">住所</div>
        <div>{{ $user->address }}</div>
      </div>
    </div>

    <div class="row">
      <div class="col-8 mx-auto d-flex my-2 font-weight-bold">
        <div class="col-5">電話番号</div>
        <div>{{ $user->phone_number }}</div>
      </div>
    </div>

    <div class="mx-auto mt-4 mb-3">
      <a class="plain-link" href="{{ route('user.edit', $user->id) }}">
        <button class="btn btn-secondary">
          編集
        </button>
      </a>
    </div>
  </div>

  <div class="text-center mt-3">
    <a class="h5" href="{{ route('user.withdraw', $user) }}">退会する</a>
  </div>
</div>

@stop
