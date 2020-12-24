@extends('front.layouts.base')

@section('title', $product->name)

@section('content')
<div class="col-7 mx-auto">
  <div class="card mt-4">
    <div class="item my-4">
      <div class="row ml-5 mt-3">
        <div class="col-4 ml-5">
          <img src="{{ $product->image_url }}" alt="">
        </div>

        <div id="app" class="col-4">
          <h4>{{ $product->name }}</h4>
          <h4>￥{{ number_format($product->price) }}</h4>

          <form action="{{ route('cart.add') }}" method="post">
            @csrf
            <input type="hidden" name="name" value="{{ $product->name }}">
            <input type="hidden" name="janCode" value="{{ $product->jan_code }}">
            <input type="hidden" name="price" value="{{ $product->price }}">
            <input type="hidden" name="image_url" value="{{ $product->image_url}}">

            <div>
              数量：
              <button class="btn btn-danger" type="button" @click="decrement({{ $product->jan_code }})">-</button>
              <input id="quantity_{{ $product->jan_code }}"
                     name="quantity"
                     class="col-3"
                     type="text"
                     maxlength="2"
                     value="1">
              <button class="btn btn-primary" type="button" @click="increment({{ $product->jan_code }})">+</button>

              <p>
                <small>※一度に注文できるのは20点までです</small>
              </p>
            </div>
            <button type="submit" class="btn btn-lg mt-1 btn-success">買い物かごへ入れる</button>
          </form>
          <button class="mt-2 btn btn-sm btn-info text-white">欲しい物リストへ追加</button>
        </div>
      </div>

      <div class="row">
        <div class="col-9 mx-auto mt-3">
          <!-- TODO: メーカー名表示 -->
          <p>メーカー:&nbsp;{{ $product->maker->name }}</p>
          <span>{{ $product->description }}</span>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
new Vue({
    el: '#app',
    methods: {
      increment(janCode) {
        quantityInput = document.getElementById('quantity_' + janCode);
        quantity = Number(quantityInput.value);
        if (quantity < 20) {
          quantityInput.value = quantity + 1;
        }
      },
      decrement(janCode) {
        quantityInput = document.getElementById('quantity_' + janCode);
        quantity = Number(quantityInput.value);
        if (quantity > 1) {
          quantityInput.value = quantity - 1;
        }
      }
    }
})
</script>
@endsection
