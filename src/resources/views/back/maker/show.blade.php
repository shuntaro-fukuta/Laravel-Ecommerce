@extends('back.layouts.base')

@section('title', 'メーカー詳細')

@section('content')
<div class="logo text-center mt-5">メーカー詳細</div>
<div class="card col-8 mx-auto">
  <div class="card-body">
    <table>
      <tr>
        <th scope="row">ID:</th>
        <td>{{ $maker->id }}</td>
      </tr>

      <tr>
        <th scope="row">Name:</th>
        <td>{{ $maker->name }}</td>
      </tr>

      <tr>
        <th scope="row">Email:</th>
        <td>{{ $maker->email }}</td>
      </tr>

      <tr>
        <th scope="row">Phone:</th>
        <td>{{ $maker->phone_number }}</td>
      </tr>

      <tr>
        <th scope="row">Address:</th>
        <td>{{ $maker->address }}</td>
      </tr>
    </table>

    <div class="row text-center">
      <a href="{{ route('back.makers.edit', $maker) }}">
        <button class="btn btn-info mb-3">編集</button>
      </a>
    </div>
  </div>
</div>
@endsection
