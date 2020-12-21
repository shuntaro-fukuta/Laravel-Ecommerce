@extends('front.layouts.base')

@section('title', 'カート')

@section('content')

<h1>カートの中身</h1>
<div class="mx-auto col-8">
  <div class="card">
    @foreach ($cartHandler->getContents() as $janCode => $item)
    <div class="col-12 mx-auto">
      <div class="row">
        <div class="col-4">
          <img src="{{ $item->getImageUrl() }}" alt="">
        </div>
        <div class="">
          <p>name: {{ $item->getName() }}</p>
          <p>price: {{ $item->getUnitPrice() }}</p>
          <p>quantity: {{ $item->getQuantity() }}</p>
        </div>
      </div>
    </div>
    @endforeach

    <div class="btn btn-secondary col-2 mx-auto mb-3">
      購入手続きへ
    </div>
  </div>
</div>
@endsection
