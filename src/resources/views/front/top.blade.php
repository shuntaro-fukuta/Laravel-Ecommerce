@extends('front.layouts.base')

@section('title', 'Laravel-Ecommerce')

@section('content')
<div class="container">
  <div class="col-12 mx-auto">
    @foreach ($products->chunk(4) as $chunk)
      <div class="row my-3">
        @foreach ($chunk as $product)
        <div class="card col-3">
          @if ($product->image_url !== null)
            <img src="{{ $product->image_url }}" alt="">
          @endif

          {{ $product->name }}
          <br>
          ￥{{ number_format($product->price) }}
        </div>
        @endforeach
      </div>
    @endforeach
  </div>

  {{ $products->links('pagination::bootstrap-4') }}
</div>
@stop
