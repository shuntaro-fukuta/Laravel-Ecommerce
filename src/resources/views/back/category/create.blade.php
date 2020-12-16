@extends('back.layouts.base')

@section('title', 'カテゴリー登録')

@section('content')
<div class="logo text-center mt-5">カテゴリー登録</div>
<div class="card col-8 mx-auto">
  <div class="card-body">
    <form action="{{ route('back.categories.store') }}" method="post" class="text-left">
      @csrf
      <div class="form-group my-4 col-9 mx-auto">
        <label class="text-dark font-weight-bold" for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        @if($errors->has('name'))
          <p class="text-danger">{{ $errors->first('name') }}</p>
        @endif
      </div>

      <div class="row">
        <input type="submit" class="btn btn-info mx-auto mb-3" value="登録">
      </div>
    </form>

    <a href="{{ route('back.categories.menu') }}">
      <button class="btn btn-dark mb-3">戻る</button>
    </a>
  </div>
</div>
@endsection
