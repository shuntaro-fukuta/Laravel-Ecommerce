@extends('back.layouts.base')

@section('title', '商品')

@section('content')
<div class="logo text-center mt-5">商品管理メニュー</div>
<div class="card col-8 mx-auto">
  <div class="card-body col-md-11">
    <div class="row">
      <div class="col-10 mx-auto d-flex">
        <div class="col-md-6">
          <a class="text-white" href="{{ route('back.products.index') }}">
            <button class="btn btn-dark btn-block">
              商品一覧
            </button>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
