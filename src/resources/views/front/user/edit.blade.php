@extends('front.layouts.base')

@section('title', 'MyPage')

@section('content')
<form method="post">
  @csrf

  <label for="name">name</label>
  <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}">
  @if($errors->has('name'))
    <div class="error">
        <p>{{ $errors->first('name') }}</p>
    </div>
  @endif
  <br>

  <label for="email">email</label>
  <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}">
  @if($errors->has('email'))
    <div class="error">
        <p>{{ $errors->first('email') }}</p>
    </div>
  @endif
  <br>

  <label for="address">address</label>
  <input id="address" type="text" name="address" value="{{ old('address', $user->address) }}">
  @if($errors->has('address'))
    <div class="error">
        <p>{{ $errors->first('address') }}</p>
    </div>
  @endif
  <br>

  <label for="phone_number">phone_number</label>
  <input id="phone_number" type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
  @if($errors->has('phone_number'))
    <div class="error">
        <p>{{ $errors->first('phone_number') }}</p>
    </div>
  @endif
  <br>

  <a href="{{ route('user.show', $user->id) }}">Back</a>
  <input type="submit" value="Edit">
</form>

@stop
