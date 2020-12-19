@extends('front.layouts.base')

@section('title', 'Laravel-Ecommerce')

@section('content')
<div class="col-10">
  @forelse ($products->chunk(4) as $chunk)
    <div class="row my-3">
      @foreach ($chunk as $product)
        @if ($product->is_published)
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
        @endif
      @endforeach
    </div>
  @empty
    <h2 class="text-center mt-5">商品はまだありません</h2>
  @endforelse
{{ $products->links('pagination::bootstrap-4') }}
@stop
