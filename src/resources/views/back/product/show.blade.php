@extends('back.layouts.base')

@section('title', '商品詳細')

@section('content')
<div class="logo text-center mt-5">商品詳細</div>
<div class="card col-8 mx-auto">
  <div class="card-body">
    <table>
      <tr>
        <th scope="row">ID:</th>
        <td>{{ $product->id }}</td>
      </tr>

      <tr>
        <th scope="row">Jan:</th>
        <td>{{ $product->jan_code }}</td>
      </tr>

      <tr>
        <th scope="row">Name:</th>
        <td>{{ $product->name }}</td>
      </tr>

      <tr>
        <th scope="row">price:</th>
        <td>{{ $product->price }}</td>
      </tr>

      <tr>
        <th scope="row">Image:</th>
        <td>{{ $product->image_url }}</td>
      </tr>

      <tr>
        <th scope="row">description:</th>
        <td>{{ $product->description }}</td>
      </tr>
    </table>

    <div class="row text-center">
      <a href="{{ route('back.products.edit', $product) }}">
        <button class="btn btn-info mb-3">編集</button>
      </a>
    </div>
  </div>
</div>
@endsection
