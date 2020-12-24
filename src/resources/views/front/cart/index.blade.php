@extends('front.layouts.base')

@section('title', 'カート')

@section('content')

<div class="mx-auto col-8">
<h1>カート</h1>
  <div id="app" class="card col-8 mx-auto">
    @forelse ($products as $janCode => $item)
      <div class="row mt-4">
        <div class="col-5">
          <img src="{{ $item->getImageUrl() }}" alt="">
        </div>
        <div class="">
          <p>name: {{ $item->getName() }}</p>
          <p>price: {{ $item->getUnitPrice() }}</p>
          <div>
            数量：
            <button class="btn btn-danger" type="button" @click="decrement({{ $janCode }})">-</button>
            <input id="quantity_{{ $janCode }}"
                   class="col-2"
                   type="text"
                   maxlength="2"
                   value="{{ $item->getQuantity() }}" >
            <button class="btn btn-primary" type="button" @click="increment({{ $janCode }})">+</button>
          </div>
        </div>

      </div>
    @empty
      <p class="text-center">カートに商品はありません</p>
    @endforelse

    <div class="btn btn-secondary col-4 mx-auto my-3">
      購入手続きへ
    </div>
  </div>
</div>

<script>
new Vue({
    el: '#app',
    methods: {
      increment(janCode) {
        let url = '/carts/' + janCode + '/increment';

        let params = {
          'quantity' : document.getElementById('quantity_' + janCode).value
        };

        axios.post(url, params)
          .then(response => {
            document.getElementById('quantity_' + janCode).value = response.data.quantity;
          }).catch(error => {

          })
      },
      decrement(janCode) {
        let url = '/carts/' + janCode + '/decrement';

        let params = {
          'quantity' : document.getElementById('quantity_' + janCode).value
        };

        axios.post(url, params)
          .then(response => {
            document.getElementById('quantity_' + janCode).value = response.data.quantity;
          }).catch(error => {

          })
      }
    }
})
</script>
@endsection
