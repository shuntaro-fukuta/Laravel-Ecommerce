@extends('front.layouts.base')

@section('title', 'Laravel-Ecommerce')

@section('content')
<div class="col-10">
  @foreach ($products->chunk(4) as $chunk)
    <div class="row my-3">
      @foreach ($chunk as $product)
      <div class="card col-3">
        <a class="text-dark" href="{{ route('products.show', $product) }}">
          <div class="my-2 text-center">
            @if ($product->image_url !== null)
              <div class="mx-auto">
                <img src="{{ $product->image_url }}" alt="">
              </div>
            @endif
            {{ $product->name }}
            <br>
            ￥{{ number_format($product->price) }}
          </div>
        </a>
      </div>
      @endforeach
    </div>
  @endforeach
{{ $products->links('pagination::bootstrap-4') }}
@stop
