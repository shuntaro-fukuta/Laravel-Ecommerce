<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyPage</title>
</head>
<body>
<table border="1">
  <tr>
    <td style="background-color: gray;">name</td>
    <td>{{ $user->name }}</td>
  </tr>

  <tr>
    <td style="background-color: gray;">email</td>
    <td>{{ $user->email }}</td>
  </tr>

  <tr>
    <td style="background-color: gray;">address</td>
    <td>{{ $user->address }}</td>
  </tr>

  <tr>
    <td style="background-color: gray;">phone_number</td>
    <td>{{ $user->phone_number }}</td>
  </tr>
</table>
</body>
</html>
