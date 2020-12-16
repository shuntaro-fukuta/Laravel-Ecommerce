@extends('back.layouts.base')

@section('title', 'ユーザー登録')

@section('content')
<div class="logo text-center mt-5">Create</div>
<div class="card col-8 mx-auto">
  <div class="card-body">
    <form action="{{ route('back.users.store') }}" method="post" class="text-left">
      @csrf
      <div class="form-group my-4 col-9 mx-auto">
        <label class="text-dark font-weight-bold" for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        @if($errors->has('name'))
          <p class="text-danger">{{ $errors->first('name') }}</p>
        @endif
      </div>

      <div class="form-group my-4 col-9 mx-auto">
        <label class="text-dark font-weight-bold"for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
        @if($errors->has('email'))
          <p class="text-danger">{{ $errors->first('email') }}</p>
        @endif
      </div>

      <div class="form-group my-4 col-9 mx-auto">
       <label class="text-dark font-weight-bold"for="phone_number">Phone</label>
        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
        @if($errors->has('phone_number'))
          <p class="text-danger">{{ $errors->first('phone_number') }}</p>
        @endif
      </div>

      <div class="form-group my-4 col-9 mx-auto">
        <label class="text-dark font-weight-bold" for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
        @if($errors->has('address'))
          <p class="text-danger">{{ $errors->first('address') }}</p>
        @endif
      </div>

      <div class="form-group my-4 col-9 mx-auto">
        <label class="text-dark font-weight-bold" for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
        @if($errors->has('password'))
          <p class="text-danger">{{ $errors->first('password') }}</p>
        @endif
      </div>

      <div class="form-group my-4 col-9 mx-auto">
        <label class="text-dark font-weight-bold" for="password_confirmation">Password(確認用)</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
      </div>

      <div class="row">
        <input type="submit" class="btn btn-info mx-auto mb-3" value="更新">
      </div>
    </form>

    <a href="{{}}">
      <button class="btn btn-dark mb-3">戻る</button>
    </a>
  </div>
</div>
@endsection
