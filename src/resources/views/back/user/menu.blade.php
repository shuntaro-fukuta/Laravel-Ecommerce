@extends('back.layouts.base')

@section('title', 'ユーザー管理メニュー')

@section('content')
<div class="logo text-center mt-5">ユーザー管理メニュー</div>
<div class="card col-8 mx-auto">
  <div class="card-body col-md-11">
    <div class="row">
      <div class="col-10 mx-auto d-flex">
        <div class="col-md-6">
          <a class="text-white" href="{{ route('back.user.index') }}">
            <button class="btn btn-dark btn-block">
              ユーザー一覧
            </button>
          </a>
        </div>

        <div class="col-md-6">
          <a class="text-white" href="{{ route('back.user.create') }}">
            <button class="btn btn-dark btn-block">
              ユーザー登録
            </button>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
