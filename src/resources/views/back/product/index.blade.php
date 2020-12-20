@extends('back.layouts.base')

@section('title', '商品一覧')

@section('content')
  <div class="logo text-center mt-5">Search</div>
  <div class="card col-6 mx-auto mt-2">
    <form id="login-form" class="text-left">
      @csrf
        <div class="form-group my-4 col-9 mx-auto">
          <label class="text-dark font-weight-bold"for="jan_code">JanCode</label>
          <input type="text" class="form-control" id="jan_code" name="jan_code" value="{{ old('jan_code', $jan_code) }}">
        </div>

        <div class="form-group my-4 col-9 mx-auto">
          <label class="text-dark font-weight-bold" for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $name) }}">
        </div>

        <div class="form-group my-4 col-9 mx-auto">
          <label class="text-dark font-weight-bold"for="description">description</label>
          <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $description) }}">
        </div>

        <div class="row">
          <input type="submit" class="btn btn-dark mx-auto mb-3" value="検索">
        </div>
    </form>
  </div>

  <div class="card col-10 mx-auto">
    <div class="card-body col-11">
      <div class="table-responsive">
        <table class="table">
          <thead class=" text-primary">
            <th>ID</th>
            <th>JanCode</th>
            <th>name</th>
            <th>price</th>
            <th>is_published</th>
          </thead>
          <tbody>
            @foreach ($products as $product)
              <tr>
                <td>{{ $product->id }}</td>
                <td><a href="{{ route('back.products.show', $product) }}">{{ $product->jan_code }}</a></td>
                <td>{{ $product->name }}</a></td>
                <td>￥{{ number_format($product->price) }}</td>
                <td>{{ $product->is_published ? '公開' : '非公開' }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{ $products->appends(request()->input())->links('pagination::bootstrap-4') }}
      </div>
    </div>
  </div>
@endsection
