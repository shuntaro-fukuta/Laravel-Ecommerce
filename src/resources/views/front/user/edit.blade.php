@extends('front.layouts.base')

@section('title', '会員情報編集')

@section('content')
<div class="container">
  <h2 class="text-center my-3">会員情報編集</h2>

  <div class="card col-6 mx-auto mt-2">
    <form method="post">
      @csrf

      <div class="row mt-3">
        <div class="col-8 mx-auto d-flex my-2 font-weight-bold">
          <label for="name" class="col-5">氏名</label>
          <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}">
        </div>
      </div>
      @if($errors->has('name'))
      <div class="row">
        <div class="error col-8 mx-auto text-center">
          <p>{{ $errors->first('name') }}</p>
        </div>
      </div>
      @endif

      <div class="row">
        <div class="col-8 mx-auto d-flex my-2 font-weight-bold">
          <label for="email" class="col-5">メールアドレス</label>
          <input id="email" type="text" name="email" value="{{ old('email', $user->email) }}">
        </div>
      </div>
      @if($errors->has('email'))
      <div class="row">
        <div class="error col-8 mx-auto text-center">
          <p>{{ $errors->first('email') }}</p>
        </div>
      </div>
      @endif

      <div class="row">
        <div class="col-8 mx-auto d-flex my-2 font-weight-bold">
          <label for="address" class="col-5">住所</label>
          <input id="address" type="text" name="address" value="{{ old('address', $user->address) }}">
        </div>
      </div>
      @if($errors->has('address'))
      <div class="row">
        <div class="error col-8 mx-auto text-center">
          <p>{{ $errors->first('address') }}</p>
        </div>
      </div>
      @endif

      <div class="row">
        <div class="col-8 mx-auto d-flex my-2 font-weight-bold">
          <label for="phone_number" class="col-5">電話番号</label>
          <input id="phone_number" type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
        </div>
      </div>
      @if($errors->has('phone_number'))
      <div class="row">
        <div class="error col-8 mx-auto text-center">
            <p>{{ $errors->first('phone_number') }}</p>
        </div>
      </div>
      @endif

      <div class="row">
        <input type="submit" class="btn btn-secondary mx-auto mt-4 mb-3" value="編集">
      </div>
    </form>

    <div class="row mx-auto my-2">
      <button class="btn btn-danger">
        <a class="plain-link" href="{{ route('user.show', $user->id) }}">戻る</a>
      </button>
    </div>
  </div>
</div>

@stop
