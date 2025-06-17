<?php
include "connection.php";

// Defaults
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 20;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($limit < 1) $limit = 20;
if ($page < 1) $page = 1;

// Offset calculation
$offset = ($page - 1) * $limit;

// Get total records
$total_query = "SELECT COUNT(*) as total FROM employee";
$total_result = $conn->query($total_query);
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

// Fetch limited records
$sql = "SELECT * FROM employee ORDER BY id ASC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">

    <title>Employee Management System</title>

    <style>
      body {
        background-color: #f1f3f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 1.05rem;
      }
      .navbar {
        background-color: #2c2f36 !important; /* Blackish */
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
      table th, table td {
        vertical-align: middle;
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
        <h2 class="mb-4 text-center">Welcome to Employee Management System</h2>
        <p class="text-center">Developed by Supan Roy</p>
      </div>
    </div>

    <div class="container my-4">
  <div class="d-flex justify-content-between mb-3">
    <form method="get" class="form-inline">
      <label class="mr-2 font-weight-bold">View:</label>
      <select name="limit" class="form-control mr-2" onchange="this.form.submit()">
        <option value="20" <?= $limit == 20 ? 'selected' : '' ?>>20</option>
        <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50</option>
        <option value="100" <?= $limit == 100 ? 'selected' : '' ?>>100</option>
        <option value="1000" <?= $limit == 1000 ? 'selected' : '' ?>>1000</option>
      </select>
      <input type="hidden" name="page" value="1">
    </form>
    <div><strong>Total Employees:</strong> <?= $total_records ?></div>
  </div>

  <table class="table table-bordered table-striped">
    <thead class="thead-dark">
      <tr>
        <th>Employee ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Joining Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "
          <tr>
            <th>{$row['id']}</th>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['phone']}</td>
            <td>{$row['join_date']}</td>
            <td>
              <a class='btn btn-success' href='edit.php?id={$row['id']}'>Edit</a>
              <a class='btn btn-danger' href='javascript:void(0);' onclick='confirmDelete({$row["id"]});'>Delete</a>
            </td>
          </tr>";
        }
      } else {
        echo "<tr><td colspan='6' class='text-center'>No records found.</td></tr>";
      }
      ?>
    </tbody>
  </table>

  <!-- Pagination -->
  <nav>
    <ul class="pagination justify-content-center">
      <?php if ($page > 1): ?>
        <li class="page-item">
          <a class="page-link" href="?limit=<?= $limit ?>&page=<?= $page - 1 ?>">Previous</a>
        </li>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
          <a class="page-link" href="?limit=<?= $limit ?>&page=<?= $i ?>"><?= $i ?></a>
        </li>
      <?php endfor; ?>

      <?php if ($page < $total_pages): ?>
        <li class="page-item">
          <a class="page-link" href="?limit=<?= $limit ?>&page=<?= $page + 1 ?>">Next</a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>
</div>


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="confirmDelete.js"></script>

    <!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-light text-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this employee?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a id="confirmDeleteBtn" class="btn btn-danger">Yes, Delete</a>
      </div>
    </div>
  </div>
</div>
  </body>
</html>