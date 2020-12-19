@extends('front.layouts.base')

@section('title', 'Laravel-Ecommerce')

@section('content')
  <div class="row">
    <!-- side bar -->
    <div class="col-2 bd-sidebar">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav flex-column">
            <li class="nav-item">hoge</li>
            @foreach ($categories as $category)
              <li class="nav-item">{{ $category->name }}</li>
            @endforeach
          </ul>
        </div>
      </nav>
    </div>

    <!-- main content -->
    <div class="col-10">
      @foreach ($products->chunk(4) as $chunk)
        <div class="row my-3">
          @foreach ($chunk as $product)
          <div class="card col-3">
            <div class="my-2 text-center">
              @if ($product->image_url !== null)
                <img src="{{ $product->image_url }}" alt="">
              @endif

              {{ $product->name }}
              <br>
              ￥{{ number_format($product->price) }}
            </div>
          </div>
          @endforeach
        </div>
      @endforeach

    {{ $products->links('pagination::bootstrap-4') }}
    </div>

  </div>
@stop
