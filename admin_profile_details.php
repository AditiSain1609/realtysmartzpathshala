<?php
session_start();
include 'db.php'; 

// ✅ Sirf admin hi access kare
if(!isset($_SESSION['role']) || $_SESSION['role'] !== "admin"){
    header("Location: login.php");
    exit();
}

$search = "";
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM user_profiles 
            WHERE full_name LIKE '%$search%' 
               OR email LIKE '%$search%' 
               OR contact_no LIKE '%$search%' 
            ORDER BY created_at DESC";
} else {
    $sql = "SELECT * FROM user_profiles ORDER BY created_at DESC";
}
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Profiles</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa;
    background: url('assets/img/gallery/section_bg02.png') no-repeat center center fixed; 
        background-size: cover; }
    table img { border-radius: 6px; object-fit: cover; }
  </style>
</head>
<body>
<div class="container py-4">
  <h3 class="mb-4">User Profiles</h3>

  <!-- Search -->
  <form method="get" action="" class="mb-3">
    <div class="input-group">
      <input type="text" class="form-control" name="search" 
             value="<?php echo htmlspecialchars($search ?? '', ENT_QUOTES, 'UTF-8'); ?>" 
             placeholder="Search by name, email or contact">
      <button class="btn btn-dark" type="submit">Search</button>
    </div>
  </form>

  <!-- Table -->
  <div class="table-responsive shadow-sm">
    <table class="table table-bordered table-hover align-middle">
      <thead class="table-dark text-center">
        <tr>
          <th>ID</th>
          <th>Photo</th>
          <th>Full Name</th>
          <th>Email</th>
          <th>Contact</th>
          <th>DOB</th>
          <th>Current Address</th>
          <th>Permanent Address</th>
          <th>Experience</th>
          <th>Education</th>
          <th>Aadhar</th>
          <th>PAN</th>
          <th>Cheque</th>
          <th>Passbook</th>
          <th>Offer Letter</th>
          <th>Relieving Letter</th>
          <th>Salary Slip</th>
          <th>Rehire Mail</th>
          <th>Marksheet</th>
          <th>Contact Relation</th>
          <th>Father</th>
          <th>Mother</th>
          <th>Other</th>
          <th>Created At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";

        // ID
        echo "<td class='text-center'>{$row['id']}</td>";

        // ✅ Profile photo path fix
        if (!empty($row['profile_photo'])) {
            $photoPath = $row['profile_photo'];
            if (strpos($photoPath, 'uploads/') !== 0) {
                $photoPath = 'uploads/' . $photoPath;
            }
            echo "<td class='text-center'><img src='" . htmlspecialchars($photoPath) . "' width='50' height='50'></td>";
        } else {
            echo "<td class='text-center'><img src='assets/img/default-user.png' width='50' height='50'></td>";
        }

        // Full name, email, contact
        echo "<td>" . htmlspecialchars($row['full_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['contact_no']) . "</td>";

        // DOB, addresses, experience, education
        echo "<td>" . htmlspecialchars($row['dob']) . "</td>";
        echo "<td>" . htmlspecialchars($row['current_address']) . "</td>";
        echo "<td>" . htmlspecialchars($row['permanent_address']) . "</td>";
        echo "<td>" . htmlspecialchars($row['experience']) . "</td>";
        echo "<td>" . htmlspecialchars($row['education']) . "</td>";

        // ✅ Documents path fix
        $docs = [
          'aadhar_doc','pan_doc','cheque_doc','passbook_doc',
          'offer_letter_doc','relieving_letter_doc','salary_slip_doc',
          'up_rehire_mail_doc','marksheet_doc'
        ];
        foreach ($docs as $doc) {
            if (!empty($row[$doc])) {
                $docPath = $row[$doc];
                if (strpos($docPath, 'uploads/') !== 0) {
                    $docPath = 'uploads/' . $docPath;
                }
                echo "<td class='text-center'><a href='" . htmlspecialchars($docPath) . "' target='_blank' class='btn btn-sm btn-outline-primary'>View</a></td>";
            } else {
                echo "<td class='text-center text-muted'>-</td>";
            }
        }

        // Contact relation + family info
        echo "<td>" . htmlspecialchars($row['contact_relation']) . "</td>";
        echo "<td>" . htmlspecialchars($row['father_name'] . ' (' . $row['father_contact'] . ') ' . $row['father_address']) . "</td>";
        echo "<td>" . htmlspecialchars($row['mother_name'] . ' (' . $row['mother_contact'] . ') ' . $row['mother_address']) . "</td>";
        echo "<td>" . htmlspecialchars($row['other_name'] . ' (' . $row['other_contact'] . ') ' . $row['other_address']) . "</td>";

        // Created at
        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";

        // Actions
        echo "<td class='text-center'>
                <a href='edit_user.php?id=" . urlencode($row['id']) . "' class='btn btn-sm btn-warning'>Edit</a>
                <a href='delete_user.php?id=" . urlencode($row['id']) . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure?')\">Delete</a>
              </td>";

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='25' class='text-center text-muted'>No records found</td></tr>";
}
$conn->close();
?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>
