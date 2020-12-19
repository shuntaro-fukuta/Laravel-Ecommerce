@extends('front.layouts.base')

@section('title', $product->name)

@section('content')
<div class="col-7 mx-auto">
  <div class="card mt-4">
    <div class="item my-4">
      <div class="row ml-5">
        <div class="col-4 ml-5">
          <img src="{{ $product->image_url }}" alt="">
        </div>

        <div class="col-4 mt-5">
          <h4>{{ $product->name }}</h4>
          <h4>￥{{ number_format($product->price) }}</h4>

          <button class="btn btn-lg btn-success">買い物かごへ入れる</button>
          <button class="mt-2 btn btn-sm btn-info text-white">欲しい物リストへ追加</button>
        </div>
      </div>

      <div class="row">
        <div class="col-9 mx-auto mt-3">
          <!-- TODO: メーカー名表示 -->
          <p>メーカー:{{ $product->maker }}</p>
          <span>{{ $product->description }}</span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
