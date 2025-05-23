<?php
include "connection.php";

if (!isset($_GET['id'])) {
    // If no ID provided, redirect to home
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Fetch existing employee data to fill the form
$sql = "SELECT * FROM employee WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // If no employee found, redirect to home
    header("Location: index.php");
    exit;
}

$employee = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $join_date = $_POST['join_date'] ?? '';

    // Update query
    $updateSql = "UPDATE employee SET name=?, email=?, phone=?, join_date=? WHERE id=?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssssi", $name, $email, $phone, $join_date, $id);

    if ($updateStmt->execute()) {
        // Redirect to index.php after successful update
        header("Location: index.php");
        exit;
    } else {
        $error = "Update failed: " . $conn->error;
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" />

    <title>Edit Employee - Employee Management System</title>

    <style>
      body {
        background-color: #f1f3f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 1.05rem;
      }
      .navbar {
        background-color: #2c2f36 !important;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      }
      .navbar-brand {
        font-size: 1.7rem;
      }
      .container-box {
        background-color: #fff;
        padding: 25px;
        margin-top: 40px;
        border-radius: 8px;
        box-shadow: 0 1px 12px rgba(44, 47, 54, 0.2);
      }
      h2 {
        font-size: 2rem;
        color: #000;
      }
    </style>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand text-white font-weight-bold" href="#">SR Group of Industries</a>
        <div class="ml-auto">
          <a href="index.php" class="btn btn-outline-light mr-2">Home</a>
          <a href="create.php" class="btn btn-light">Add New</a>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="container-box">
        <h2 class="mb-4 text-center">Edit Employee</h2>

        <?php if (!empty($error)): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" action="">
          <div class="form-group">
            <label for="name">Name</label>
            <input
              type="text"
              class="form-control"
              id="name"
              name="name"
              value="<?= htmlspecialchars($employee['name']) ?>"
              required
            />
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              value="<?= htmlspecialchars($employee['email']) ?>"
              required
            />
          </div>

          <div class="form-group">
            <label for="phone">Phone Number</label>
            <input
              type="text"
              class="form-control"
              id="phone"
              name="phone"
              value="<?= htmlspecialchars($employee['phone']) ?>"
              required
            />
          </div>

          <div class="form-group">
            <label for="join_date">Joining Date</label>
            <input
              type="date"
              class="form-control"
              id="join_date"
              name="join_date"
              value="<?= htmlspecialchars($employee['join_date']) ?>"
              required
            />
          </div>

          <button type="submit" class="btn btn-success">Update Employee</button>
          <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
        </form>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
  </body>
</html>
