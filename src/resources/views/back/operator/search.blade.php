@extends('back.layouts.base')

@section('title', 'LaravelEcommerce-Back')

@section('content')
  <div class="logo text-center mt-5">Search</div>
  <div class="card col-6 mx-auto mt-2">
    <form id="login-form" class="text-left">
      @csrf
  			<div class="form-group my-4 col-9 mx-auto">
  				<label class="text-dark font-weight-bold" for="name">Name</label>
  				<input type="text" class="form-control" id="name" name="name" value="{{ old('name', $name) }}">
          @if($errors->has('name'))
          <div class="row">
            <div class="error col-8 mx-auto text-center">
              <p>{{ $errors->first('name') }}</p>
            </div>
          </div>
          @endif
        </div>

  			<div class="form-group my-4 col-9 mx-auto">
  				<label class="text-dark font-weight-bold"for="email">Email</label>
  				<input type="text" class="form-control" id="email" name="email" value="{{ old('email', $email) }}">
          @if($errors->has('email'))
          <div class="row">
            <div class="error col-8 mx-auto text-center">
              <p>{{ $errors->first('email') }}</p>
            </div>
          </div>
          @endif
  			</div>
        <div class="row">
          <input type="submit" class="btn btn-dark mx-auto mb-3" value="検索">
        </div>
    </form>
  </div>

  <div class="card col-10 mx-auto">
    <div class="card-body col-10">
      <div class="table-responsive">
        <table class="table">
          <thead class=" text-primary">
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
          </thead>
          <tbody>
            @foreach ($operators as $operator)
              <tr>
                <td>{{ $operator->id }}</td>
                <td><a href="{{ route('back.operators.show', $operator) }}">{{ $operator->name }}</a></td>
                <td>{{ $operator->email }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{ $operators->appends(request()->input())->links('pagination::bootstrap-4') }}
      </div>
    </div>
  </div>
@endsection
