<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Confirm Registration</title>
</head>
<body>
  <h1>Thank you for signing up！</h1>

  <p>
    Click the link below to finish registration：
    <a href="{{ route('confirm_email', $user->activation_token) }}">
      {{ route('confirm_email', $user->activation_token) }}
    </a>
  </p>

</body>
</html>