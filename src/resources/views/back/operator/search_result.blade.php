@extends('back.layouts.base')

@section('title', 'LaravelEcommerce-Back')

@section('content')
  <div class="logo text-center mt-5">検索結果</div>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                  </thead>
                  <tbody>
                    @forelse ($operators as $operator)
                      <tr>
                        <td>{{ $operator->id }}</td>
                        <td><a href="{{ route('back.operator.show', $operator) }}">{{ $operator->name }}</a></td>
                        <td>{{ $operator->email }}</td>
                      </tr>
                    @empty
                      <tr>Not Found.</tr>
                    @endforelse
                  </tbody>

                  {{ $operators->appends(['name' => $name, 'email' => $email])->links() }}
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
