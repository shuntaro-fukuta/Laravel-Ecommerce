@extends('back.layouts.base')

@section('title', 'カテゴリー詳細')

@section('content')
<div class="logo text-center mt-5">カテゴリー詳細</div>
<div class="card col-8 mx-auto">
  <div class="card-body">
    <table>
      <tr>
        <th scope="row">ID:</th>
        <td>{{ $category->id }}</td>
      </tr>

      <tr>
        <th scope="row">Name:</th>
        <td>{{ $category->name }}</td>
      </tr>
  </div>
</div>
@endsection
