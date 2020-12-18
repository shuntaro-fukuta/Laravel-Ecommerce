@extends('back.layouts.base')

@section('title', '商品編集')

@section('content')
<div class="logo text-center mt-5">商品編集</div>
<div class="card col-8 mx-auto">
  <div class="card-body">
    <form method="post" action="{{ route('back.products.update', $product) }}" class="text-left">
      @csrf
      @method('PUT')
      <div class="form-group my-4 col-9 mx-auto">
        <label class="text-dark font-weight-bold" for="category">Category</label>
        <select id="category" name="category_id" class="form-control">
          <option value=""></option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}" @if ($category->id == old('category_id', $product->category_id)) selected @endif>{{ $category->name }}</option>
          @endforeach
        </select>
        @if($errors->has('category_id'))
          <p class="text-danger">{{ $errors->first('category_id') }}</p>
        @endif
      </div>

      <div class="form-group my-4 col-9 mx-auto">
        <label class="text-dark font-weight-bold" for="maker">Maker</label>
        <select id="maker" name="maker_id" class="form-control">
            <option value=""></option>
          @foreach ($makers as $maker)
            <option value="{{ $maker->id }}" @if ($maker->id == old('maker_id', $product->maker_id)) selected @endif>{{ $maker->name }}</option>
          @endforeach
        </select>
        @if($errors->has('maker_id'))
          <p class="text-danger">{{ $errors->first('maker_id') }}</p>
        @endif
      </div>

      <div class="form-group my-4 col-9 mx-auto">
        <label class="text-dark font-weight-bold" for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}">
        @if($errors->has('name'))
          <p class="text-danger">{{ $errors->first('name') }}</p>
        @endif
      </div>

      <div class="form-group my-4 col-9 mx-auto">
        <label class="text-dark font-weight-bold"for="price">販売価格(円)</label>
        <input type="text" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}">
        @if($errors->has('price'))
          <p class="text-danger">{{ $errors->first('price') }}</p>
        @endif
      </div>

      <div class="form-group my-4 col-9 mx-auto">
       <label class="text-dark font-weight-bold"for="image_url">画像URL</label>
        <input type="text" class="form-control" id="image_url" name="image_url" value="{{ old('image_url', $product->image_url) }}">
        @if($errors->has('image_url'))
          <p class="text-danger">{{ $errors->first('image_url') }}</p>
        @endif
      </div>

      <div class="form-group my-4 col-9 mx-auto">
        <label class="text-dark font-weight-bold" for="description">商品説明</label>
        <textarea class="form-control" name="description" id="description" cols="20" rows="5">{{ old('description', $product->description) }}</textarea>
        @if($errors->has('description'))
          <p class="text-danger">{{ $errors->first('description') }}</p>
        @endif
      </div>

      <div class="form-group my-4 col-9 mx-auto form-check">
        <label class="text-dark font-weight-bold">公開区分</label>
        <br>
        <label class="text-dark font-weight-bold" for="not_published">非公開</label>
        <input type="radio" id="not_published" name="is_published" value="0" @if ($product->is_published) checked @endif>
        &nbsp; &nbsp;
        <label class="text-dark font-weight-bold" for="published">公開</label>
        <input type="radio" id="published" name="is_published" value="1" @if (!$product->is_published) checked @endif>
        @if($errors->has('is_published'))
          <p class="text-danger">{{ $errors->first('is_published') }}</p>
        @endif
      </div>

      <div class="row">
        <input type="submit" class="btn btn-info mx-auto mb-3" value="更新">
      </div>
    </form>

    <a href="{{ route('back.products.show', $product) }}">
      <button class="btn btn-dark mb-3">戻る</button>
    </a>
  </div>
</div>
@endsection
