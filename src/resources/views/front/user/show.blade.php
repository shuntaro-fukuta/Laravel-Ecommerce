@extends('front.layouts.base')

@section('title', 'MyPage')

@section('content')
<table border="1">
  <tr>
    <td style="background-color: gray;">name</td>
    <td>{{ $user->name }}</td>
  </tr>

  <tr>
    <td style="background-color: gray;">email</td>
    <td>{{ $user->email }}</td>
  </tr>

  <tr>
    <td style="background-color: gray;">address</td>
    <td>{{ $user->address }}</td>
  </tr>

  <tr>
    <td style="background-color: gray;">phone_number</td>
    <td>{{ $user->phone_number }}</td>
  </tr>
</table>

<a href="{{ route('user.edit', $user->id) }}">Edit</a>
@stop
