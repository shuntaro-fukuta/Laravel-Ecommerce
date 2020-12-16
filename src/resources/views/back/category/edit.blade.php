@extends('back.layouts.base')

@section('title', 'カテゴリー編集')

@section('content')
<div class="logo text-center mt-5">カテゴリー編集</div>
<div class="card col-8 mx-auto">
  <div class="card-body">
    <form method="post" action="{{ route('back.categories.update', $category) }}" class="text-left">
      @csrf
      @method('PUT')
      <div class="form-group my-4 col-9 mx-auto">
        <label class="text-dark font-weight-bold" for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}">
        @if($errors->has('name'))
          <p class="text-danger">{{ $errors->first('name') }}</p>
        @endif
      </div>

      <div class="row">
        <input type="submit" class="btn btn-info mx-auto mb-3" value="更新">
      </div>
    </form>

    <a href="{{ route('back.categories.show', $category) }}">
      <button class="btn btn-dark mb-3">戻る</button>
    </a>
  </div>
</div>
@endsection
