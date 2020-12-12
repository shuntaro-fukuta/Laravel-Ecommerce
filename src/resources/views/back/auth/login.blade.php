@extends('back.layouts.base')

@section('title', '担当者ログイン')

@section('content')
<div class="container">
  <h2 class="text-center my-3">ログイン</h2>

  <div class="card col-6 mx-auto mt-2">
    <form method="post">
      @csrf

      <div class="row mt-3">
        <div class="col-8 mx-auto d-flex my-2 font-weight-bold">
          <label for="name" class="col-5">担当者名</label>
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

      <div class="row mt-3">
        <div class="col-8 mx-auto d-flex my-2 font-weight-bold">
          <label for="password" class="col-5">パスワード</label>
          <input id="password" type="password" name="password" value="{{ old('password') }}">
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
        <input type="submit" class="btn btn-secondary mx-auto mt-4 mb-3" value="ログイン">
      </div>
    </form>
  </div>
</div>
@stop
