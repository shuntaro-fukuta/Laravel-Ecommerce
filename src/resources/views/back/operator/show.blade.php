@extends('back.layouts.base')

@section('title', 'LaravelEcommerce-Back')

@section('content')
<div class="logo text-center mt-5">Show</div>
<div class="card col-8 mx-auto">
  <div class="card-body">
    <table>
      <tr>
        <th scope="row">ID:</th>
        <td>{{ $operator->id }}</td>
      </tr>

      <tr>
        <th scope="row">Name:</th>
        <td>{{ $operator->name }}</td>
      </tr>

      <tr>
        <th scope="row">Email:</th>
        <td>{{ $operator->email }}</td>
      </tr>
    </table>
  </div>
</div>
@endsection
