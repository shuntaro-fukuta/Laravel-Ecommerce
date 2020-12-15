<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    LaravelEcommerce - Back
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

  <!-- CSS Files -->
  <link href="{{ asset('css/material-dashboard.css') }}" rel="stylesheet">
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="azure" data-background-color="black">
      <div class="logo">
        <span class="simple-text logo-normal">管理画面</span>
      </div>
    </div>

    <div class="main-panel mt-5">
      <div class="logo text-center">login</div>
      <div class="card col-6 mx-auto mt-2">
        <form method="post" id="login-form" class="text-left">
          @csrf

		    	<div class="main-login-form">
		    		<div class="login-group">
		    			<div class="form-group my-4 col-9 mx-auto">
		    				<label for="name" class="sr-only">Username</label>
		    				<input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{ old('name') }}">
                @if($errors->has('name'))
                <div class="row">
                  <div class="error col-8 mx-auto text-center">
                    <p>{{ $errors->first('name') }}</p>
                  </div>
                </div>
                @endif
              </div>

		    			<div class="form-group my-4 col-9 mx-auto">
		    				<label for="password" class="sr-only">Password</label>
		    				<input type="password" class="form-control" id="password" name="password" placeholder="password" value="{{ old('password') }}">
                @if($errors->has('password'))
                <div class="row">
                  <div class="error col-8 mx-auto text-center">
                    <p>{{ $errors->first('password') }}</p>
                  </div>
                </div>
                @endif
              </div>
		    	</div>

          <div class="row">
            <input type="submit" class="btn btn-dark mx-auto mb-3" value="Login">
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
</body>
</html>
