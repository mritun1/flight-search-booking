<!DOCTYPE html>
<html>
<head>
  <title>Login and Register Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 90%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #4caf50;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .form-divider {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }

    .form-divider::before,
    .form-divider::after {
      content: "";
      flex: 1;
      border-bottom: 1px solid #ddd;
    }

    .form-divider::before {
      margin-right: 10px;
    }

    .form-divider::after {
      margin-left: 10px;
    }
    .container{
        margin-top:10%;
    }
  </style>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container">