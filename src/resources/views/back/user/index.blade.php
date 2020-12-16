@extends('back.layouts.base')

@section('title', 'ユーザー一覧')

@section('content')
  <div class="logo text-center mt-5">Search</div>
  <div class="card col-6 mx-auto mt-2">
    <form id="login-form" class="text-left">
      @csrf
        <div class="form-group my-4 col-9 mx-auto">
        <label class="text-dark font-weight-bold" for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $name) }}">
        </div>

        <div class="form-group my-4 col-9 mx-auto">
          <label class="text-dark font-weight-bold"for="email">Email</label>
          <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $email) }}">
        </div>

        <div class="form-group my-4 col-9 mx-auto">
         <label class="text-dark font-weight-bold"for="phone_number">Phone</label>
         	<input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $phone_number) }}">
        </div>

        <div class="form-group my-4 col-9 mx-auto">
          <label class="text-dark font-weight-bold"for="address">Address</label>
          <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $address) }}">
        </div>

        <div class="row">
          <input type="submit" class="btn btn-dark mx-auto mb-3" value="検索">
        </div>
    </form>
  </div>

  <div class="card col-10 mx-auto">
    <div class="card-body col-11">
      <div class="table-responsive">
        <table class="table">
          <thead class=" text-primary">
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
          </thead>
          <tbody>
            @foreach ($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td><a href="{{ route('back.users.show', $user) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ $user->address }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{ $users->appends(request()->input())->links('pagination::bootstrap-4') }}
      </div>
    </div>
  </div>
@endsection
