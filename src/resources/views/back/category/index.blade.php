@extends('back.layouts.base')

@section('title', 'カテゴリー一覧')

@section('content')
  <div class="logo text-center mt-5">Search</div>
  <div class="card col-6 mx-auto mt-2">
    <form id="login-form" class="text-left">
      @csrf
      <div class="form-group my-4 col-9 mx-auto">
      <label class="text-dark font-weight-bold" for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $name) }}">
      </div>
      <div class="row">
        <input type="submit" class="btn btn-dark mx-auto mb-3" value="検索">
      </div>
    </form>
  </div>

  <div class="text-center">
    <a href="{{ route('back.categories.menu') }}">
      <button class="btn btn-dark mb-3">戻る</button>
    </a>
  </div>

  <div class="card col-10 mx-auto">
    <div class="card-body col-11">
      <div class="table-responsive">
        <table class="table">
          <thead class=" text-primary">
            <th>ID</th>
            <th>Name</th>
          </thead>
          <tbody>
            @foreach ($categories as $category)
              <tr>
                <td>{{ $category->id }}</td>
                <td><a href="{{ route('back.categories.show', $category) }}">{{ $category->name }}</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{ $categories->appends(request()->input())->links('pagination::bootstrap-4') }}
      </div>
    </div>
  </div>

  <div class="text-center">
    <a href="{{ route('back.categories.menu') }}">
      <button class="btn btn-dark mb-3">戻る</button>
    </a>
  </div>
@endsection
