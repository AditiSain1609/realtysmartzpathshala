<?php
include 'db_user.php'; // database connection file
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Users</title>
    <!-- Include Bootstrap + jQuery + DataTables CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
</head>
<style>
  body{
    background: url('assets/img/gallery/section_bg02.png') no-repeat center center fixed; 
        background-size: cover; }
table.dataTable {
    font-size: 14px;
    width: 90%;
    margin: auto;
}
table.dataTable th,
table.dataTable td {
    padding: 6px 8px;
}
.table-dark{
  background-color: rgba
(0, 94, 255, 1);
}
</style>
<body>
<div class="container mt-5">
    <h2 class="mb-4">All Users</h2>
    <table id="usersTable" class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Verified</th>
                <th>Approved</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['password']}</td>
                <td>{$row['is_verified']}</td>
                <td>{$row['is_approved']}</td>
                <td>{$row['created_at']}</td>
                <td>
                    <button class='btn btn-sm btn-primary editBtn' data-id='{$row['id']}' data-name='{$row['name']}' data-email='{$row['email']}' data-password='{$row['password']}' data-verified='{$row['is_verified']}' data-approved='{$row['is_approved']}'>Edit</button>
                    <a href='delete_user.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="update_user.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="edit_id">
          <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" id="edit_name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" id="edit_email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Password:</label>
            <input type="text" name="password" id="edit_password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Verified (0/1):</label>
            <input type="number" name="is_verified" id="edit_verified" class="form-control" min="0" max="1">
          </div>
          <div class="mb-3">
            <label>Approved (0/1):</label>
            <input type="number" name="is_approved" id="edit_approved" class="form-control" min="0" max="1">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    $('#usersTable').DataTable();

    $('.editBtn').on('click', function () {
        $('#edit_id').val($(this).data('id'));
        $('#edit_name').val($(this).data('name'));
        $('#edit_email').val($(this).data('email'));
        $('#edit_password').val($(this).data('password'));
        $('#edit_verified').val($(this).data('verified'));
        $('#edit_approved').val($(this).data('approved'));
        $('#editModal').modal('show');
    });
});
</script>
</body>
</html>
