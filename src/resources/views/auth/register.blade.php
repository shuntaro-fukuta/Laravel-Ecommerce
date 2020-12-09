@extends('front.layouts.base')

@section('title', '会員登録')

@section('content')
<div class="container">
  <h2 class="text-center my-3">会員登録</h2>

  <div class="card col-7 mx-auto mt-2">
    <form method="post">
      @csrf

      <div class="row mt-3">
        <div class="col-8 mx-auto d-flex my-2 font-weight-bold">
          <label for="name" class="col-5">氏名</label>
          <input id="name" type="text" name="name" value="{{ old('name') }}">
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
          <input id="email" type="text" name="email" value="{{ old('email') }}">
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
          <input id="address" type="text" name="address" value="{{ old('address') }}">
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
          <input id="phone_number" type="text" name="phone_number" value="{{ old('phone_number') }}">
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
        <div class="col-8 mx-auto d-flex my-2 font-weight-bold">
          <label for="password" class="col-5">パスワード</label>
          <input id="password" type="password" name="password">
        </div>
      </div>
      @if($errors->has('password'))
      <div class="row">
        <div class="error col-8 mx-auto text-center">
            <p>{{ $errors->first('password') }}</p>
        </div>
      </div>
      @endif

      <div class="row">
        <div class="col-8 mx-auto d-flex my-2 font-weight-bold">
          <label for="password_confirmation" class="col-5">パスワード(確認用)</label>
          <input id="password_confirmation" type="password" name="password_confirmation">
        </div>
      </div>

      <div class="row">
        <input type="submit" class="btn btn-secondary mx-auto mt-4 mb-3" value="登録">
      </div>
    </form>
  </div>
</div>
@stop
