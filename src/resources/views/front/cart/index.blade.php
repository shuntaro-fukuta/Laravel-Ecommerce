@extends('front.layouts.base')

@section('title', 'カート')

@section('content')

<h1>カートの中身</h1>
<div class="mx-auto col-8">
<h1>カート</h1>
  <div id="app" class="card">
    @foreach ($products as $janCode => $item)
    <div class="col-12 mx-auto">
      <div class="row">
        <div class="col-4">
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
    </div>
    @endforeach

    <div class="btn btn-secondary col-2 mx-auto mb-3">
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
