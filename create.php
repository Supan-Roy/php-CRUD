<?php
  include "connection.php";
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $join_date = empty($_POST['join_date']) ? date('Y-m-d') : $_POST['join_date'];

    $sql = "INSERT INTO employee (name, email, phone, join_date) VALUES ('$name', '$email', '$phone', '$join_date')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      header("Location: index.php");
      exit();
    } else {
      echo "<script>alert('Failed to insert employee!');</script>";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add New Employee</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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

<!-- Form -->
<div class="container">
  <div class="container-box col-md-8 mx-auto">
    <h2 class="text-center mb-4">Create New Employee</h2>
    <form method="POST" autocomplete="off">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" id="email" required>
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" class="form-control" id="phone" required>
      </div>
      <div class="form-group">
        <label for="join_date">Joining Date</label>
        <input type="date" class="form-control" id="join_date" name="join_date">
      </div>
      <div class="text-center">
        <button type="submit" name="submit" class="btn btn-success px-4 mr-2">Submit</button>
        <a href="index.php" class="btn btn-secondary px-4">Cancel</a>
      </div>
    </form>
  </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  flatpickr("#join_date", {
    dateFormat: "Y-m-d",
    maxDate: "today"
  });
</script>

</body>
</html>
