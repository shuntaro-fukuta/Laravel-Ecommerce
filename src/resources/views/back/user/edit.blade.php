@extends('back.layouts.base')

@section('title', 'ユーザー詳細')

@section('content')
<div class="logo text-center mt-5">Show</div>
<div class="card col-8 mx-auto">
  <div class="card-body">
    <form method="post" class="text-left">
      @csrf
      <div class="form-group my-4 col-9 mx-auto">
      <label class="text-dark font-weight-bold" for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
      </div>

      <div class="form-group my-4 col-9 mx-auto">
        <label class="text-dark font-weight-bold"for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
      </div>

      <div class="form-group my-4 col-9 mx-auto">
       <label class="text-dark font-weight-bold"for="phone_number">Phone</label>
        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
      </div>

      <div class="form-group my-4 col-9 mx-auto">
        <label class="text-dark font-weight-bold"for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address) }}">
      </div>

      <div class="row">
        <input type="submit" class="btn btn-info mx-auto mb-3" value="更新">
      </div>
    </form>

    <a href="{{ route('back.users.show', $user) }}">
      <button class="btn btn-dark mb-3">戻る</button>
    </a>
  </div>
</div>
@endsection
