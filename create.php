<?php
  include "connection.php";
  if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $q = "INSERT INTO `crud2`(`name`, `email`, `phone`) VALUES ('$name', '$email', '$phone')";
    $query = mysqli_query($conn, $q);
    if ($query) {
      header("Location: index.php");
      exit();
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add New Employee</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f1f3f5;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-size: 1.05rem;
    }
    .navbar {
      background-color: #2c2f36 !important;
    }
    .navbar-brand {
      font-size: 1.7rem;
      font-weight: bold;
    }
    .container-box {
      background-color: #fff;
      padding: 30px;
      margin-top: 40px;
      border-radius: 8px;
      box-shadow: 0 1px 12px rgba(44, 47, 54, 0.2);
    }
    h2 {
      font-size: 1.8rem;
      color: #000;
    }
    label {
      font-weight: 600;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand text-white" href="index.php">Employee Management System</a>
    <div class="ml-auto">
      <a href="index.php" class="btn btn-outline-light mr-2">Home</a>
      <a href="create.php" class="btn btn-light">Add New</a>
    </div>
  </div>
</nav>

<!-- Form Card -->
<div class="container">
  <div class="container-box col-md-8 mx-auto">
    <h2 class="text-center mb-4">Create New Employee</h2>
    <form method="POST">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" required class="form-control" id="name">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" required class="form-control" id="email">
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" required class="form-control" id="phone">
      </div>
      <div class="text-center">
        <button class="btn btn-success px-4 mr-2" type="submit" name="submit">Submit</button>
        <a class="btn btn-secondary px-4" href="index.php">Cancel</a>
      </div>
    </form>
  </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
