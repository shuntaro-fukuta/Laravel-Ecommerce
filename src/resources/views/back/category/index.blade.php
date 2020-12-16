@extends('back.layouts.base')

@section('title', 'カテゴリー一覧')

@section('content')
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
                <td><a href="{{-- route('back.categories.show', $category) --}}">{{ $category->name }}</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
