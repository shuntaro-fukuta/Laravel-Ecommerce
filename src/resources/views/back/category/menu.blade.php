@extends('back.layouts.base')

@section('title', 'カテゴリー管理メニュー')

@section('content')
<div class="logo text-center mt-5">カテゴリー管理メニュー</div>
<div class="card col-8 mx-auto">
  <div class="card-body col-md-11">
    <div class="row">
      <div class="col-md-6">
        <a class="text-white" href="{{ route('back.categories.index') }}">
          <button class="btn btn-dark btn-block">
            カテゴリー一覧
          </button>
        </a>
      </div>

      <div class="col-md-6">
        <a class="text-white" href="{{ route('back.categories.create') }}">
          <button class="btn btn-dark btn-block">
            カテゴリー登録
          </button>
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
