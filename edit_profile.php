<?php
session_start();
include 'db_connect.php';

// Session email
$user_email = $_SESSION['user_email'] ?? null;
if(!$user_email){
    die("User not logged in");
}

// Current data fetch
$query = "SELECT * FROM user_profiles WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if(!$user){
    die("Profile not found.");
}

// Update logic
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user_name = $_POST['user_name'];
    $contact_no = $_POST['contact_no'];
    $dob = $_POST['dob'];
    $current_address = $_POST['current_address'];

    // File uploads
    $uploads_dir = "uploads/";
    $docs = ['profile_photo','aadhar_doc','pan_doc','cheque_doc','passbook_doc','offer_letter_doc','relieving_letter_doc','salary_slip_doc','up_rehire_mail_doc','marksheet_doc'];
    $docUpdates = [];

    foreach($docs as $doc){
        if(!empty($_FILES[$doc]['name'])){
            $fileName = time().'_'.basename($_FILES[$doc]['name']);
            $targetPath = $uploads_dir.$fileName;
            move_uploaded_file($_FILES[$doc]['tmp_name'], $targetPath);
            $docUpdates[$doc] = $fileName;
        } else {
            $docUpdates[$doc] = $user[$doc]; // Purana hi rehne do
        }
    }

    // Update query
    $query = "UPDATE user_profiles SET user_name=?, contact_no=?, dob=?, current_address=?, 
              profile_photo=?, aadhar_doc=?, pan_doc=?, cheque_doc=?, passbook_doc=?, offer_letter_doc=?, 
              relieving_letter_doc=?, salary_slip_doc=?, up_rehire_mail_doc=?, marksheet_doc=?
              WHERE email=?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssssssssss", 
        $user_name, $contact_no, $dob, $current_address, 
        $docUpdates['profile_photo'], $docUpdates['aadhar_doc'], $docUpdates['pan_doc'], $docUpdates['cheque_doc'], 
        $docUpdates['passbook_doc'], $docUpdates['offer_letter_doc'], $docUpdates['relieving_letter_doc'], 
        $docUpdates['salary_slip_doc'], $docUpdates['up_rehire_mail_doc'], $docUpdates['marksheet_doc'], 
        $user_email
    );

    if($stmt->execute()){
        echo "<script>alert('Profile updated successfully!'); window.location='view_profile.php';</script>";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Profile</title>
  <style>
    body {font-family: Arial, sans-serif; background: url('assets/img/gallery/section_bg02.png') no-repeat center center fixed; 
        background-size: cover; margin:0; padding:0;}
    .container {max-width:800px; margin:40px auto; background:#fff; padding:30px; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.1);}
    h2 {text-align:center; margin-bottom:20px;}
    .field {margin-bottom:15px;}
    label {display:block; font-weight:bold; margin-bottom:5px;}
    input, textarea {width:100%; padding:8px; border:1px solid #ccc; border-radius:6px;}
    .btn {margin-top:20px; padding:12px 20px; background:#007BFF; color:#fff; border:none; border-radius:6px; cursor:pointer;}
    .btn:hover {background:#0056b3;}
    img.preview {max-width:120px; border-radius:8px; margin-top:8px;}
  </style>
</head>
<body>
  <div class="container">
    <h2>Edit Profile</h2>
    <form action="" method="POST" enctype="multipart/form-data">
      
      <div class="field">
        <label>Full Name</label>
        <input type="text" name="user_name" value="<?php echo htmlspecialchars($user['user_name']); ?>" required>
      </div>

      <div class="field">
        <label>Contact Number</label>
        <input type="text" name="contact_no" value="<?php echo htmlspecialchars($user['contact_no']); ?>" required>
      </div>

      <div class="field">
        <label>Date of Birth</label>
        <input type="date" name="dob" value="<?php echo htmlspecialchars($user['dob']); ?>">
      </div>

      <div class="field">
        <label>Current Address</label>
        <textarea name="current_address"><?php echo htmlspecialchars($user['current_address']); ?></textarea>
      </div>

      <h3>Profile Photo</h3>
      <div class="field">
        <input type="file" name="profile_photo">
        <?php if($user['profile_photo']){ ?>
          <br><img src="uploads/<?php echo $user['profile_photo']; ?>" class="preview">
        <?php } ?>
      </div>

      <h3>Upload Documents</h3>
      <?php foreach(['aadhar_doc'=>'Aadhar','pan_doc'=>'PAN','cheque_doc'=>'Cheque','passbook_doc'=>'Passbook','offer_letter_doc'=>'Offer Letter','relieving_letter_doc'=>'Relieving Letter','salary_slip_doc'=>'Salary Slip','up_rehire_mail_doc'=>'Rehire Mail','marksheet_doc'=>'Marksheet'] as $doc=>$label){ ?>
        <div class="field">
          <label><?php echo $label; ?></label>
          <input type="file" name="<?php echo $doc; ?>">
          <?php if($user[$doc]){ ?>
            <a href="uploads/<?php echo $user[$doc]; ?>" target="_blank">View Current</a>
          <?php } ?>
        </div>
      <?php } ?>

      <button type="submit" class="btn">Update Profile</button>
    </form>
  </div>
</body>
</html>
