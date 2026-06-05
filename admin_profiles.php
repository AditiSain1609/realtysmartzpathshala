<?php
session_start();
include 'db_connect.php';

// ✅ Sirf admin access kare
if(!isset($_SESSION['role']) || $_SESSION['role'] !== "admin"){
    header("Location: login.php");
    exit();
}

// ✅ Users fetch
$query = "SELECT user_id, user_name, email, contact_no, experience, profile_photo FROM user_profiles";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All User Profiles</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { 
    background: url('assets/img/gallery/section_bg02.png') no-repeat center center fixed; 
        background-size: cover;}
    .table img { transition: 0.3s; }
    .table img:hover { transform: scale(1.2); }
    .row{
      background-color: rgba
(0, 94, 255, 1);
    }
  </style>
</head>
<body>
<div class="container py-4">
  <h3 class="mb-4">User Profiles</h3>
  <div class="card shadow-sm">
    <div class="card-body">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
          <tr id="row">
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Experience</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['user_id']; ?></td>
            <td>
              <?php if(!empty($row['profile_photo'])): ?>
                <?php 
                  // ✅ Agar sirf filename ho to uploads/ laga do
                  $photoPath = $row['profile_photo'];
                  if (strpos($photoPath, 'uploads/') !== 0) {
                      $photoPath = 'uploads/' . $photoPath;
                  }
                ?>
                <img src="<?php echo htmlspecialchars($photoPath); ?>" 
                     alt="photo" 
                     style="width:40px; height:40px; border-radius:50%; object-fit:cover; cursor:pointer;"
                     data-bs-toggle="modal" 
                     data-bs-target="#photoModal" 
                     onclick="showPhoto('<?php echo htmlspecialchars($photoPath); ?>')">
              <?php else: ?>
                <img src="assets/img/default-user.png" 
                     alt="default" 
                     style="width:40px; height:40px; border-radius:50%; object-fit:cover;">
              <?php endif; ?>
            </td>

            <td><?php echo htmlspecialchars($row['user_name']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['contact_no']); ?></td>
            <td><?php echo ucfirst($row['experience']); ?></td>
            <td>
              <a href="admin_view_profile.php?id=<?php echo $row['user_id']; ?>" class="btn btn-sm btn-primary">View</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal for Image Preview -->
<div class="modal fade" id="photoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body text-center">
        <img id="modalPhoto" src="" class="img-fluid rounded shadow-lg" alt="Profile Photo">
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function showPhoto(src) {
  document.getElementById('modalPhoto').src = src;
}
</script>
</body>
</html>
