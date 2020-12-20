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
    </table>
    <div class="row text-center">
      <a href="{{ route('back.categories.edit', $category) }}">
        <button class="btn btn-info mb-3">編集</button>
      </a>
    </div>

    <a href="{{ route('back.categories.index') }}">
      <button class="btn btn-dark mb-3">戻る</button>
    </a>
  </div>
</div>
@endsection
