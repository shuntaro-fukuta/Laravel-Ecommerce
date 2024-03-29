@extends('back.layouts.base')

@section('title', 'ユーザー詳細')

@section('content')
<div class="logo text-center mt-5">Show</div>
<div class="card col-8 mx-auto">
  <div class="card-body">
    <table>
      <tr>
        <th scope="row">ID:</th>
        <td>{{ $user->id }}</td>
      </tr>

      <tr>
        <th scope="row">Name:</th>
        <td>{{ $user->name }}</td>
      </tr>

      <tr>
        <th scope="row">Email:</th>
        <td>{{ $user->email }}</td>
      </tr>

      <tr>
        <th scope="row">Phone:</th>
        <td>{{ $user->phone_number }}</td>
      </tr>

      <tr>
        <th scope="row">Address:</th>
        <td>{{ $user->address }}</td>
      </tr>
    </table>

    <div class="row text-center">
      <a href="{{ route('back.users.edit', $user) }}">
        <button class="btn btn-info mb-3">編集</button>
      </a>

      <form action="{{ route('back.users.destroy', $user) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger mb-3">削除</button>
      </form>
    </div>
    <a href="{{ route('back.users.index') }}">
      <button class="btn btn-dark mb-3">戻る</button>
    </a>

  </div>
</div>
@endsection
