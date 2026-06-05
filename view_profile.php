<?php
session_start();
include 'db_connect.php';

// Ensure user is logged in
if(!isset($_SESSION['user_name']) || !isset($_SESSION['user_email'])){
    header("Location: login.php");
    exit();
}

$userEmail = $_SESSION['user_email'];

// Profile fetch
$query = "SELECT * FROM user_profiles WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$result = $stmt->get_result();
$profile = $result->fetch_assoc();

if(!$profile){
    echo "<p>No profile found. <a href='profile_form.php'>Create Profile</a></p>";
    exit();
}

// Profile photo (default if none)
$profilePhoto = !empty($profile['profile_photo']) ? $profile['profile_photo'] : "assets/img/default-user.svg";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Profile | RealtySmartz Pathshala</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <style>
    body { 
  
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
       background: url('assets/img/gallery/section_bg02.png') no-repeat center center fixed; 
       background-size: cover;
    }
    .profile-card {
      text-align: center;
      padding: 20px;
      transition: all 0.3s ease;
    }
    .profile-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .profile-card img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      border: 4px solid #0d6efd;
      object-fit: cover;
      margin-bottom: 15px;
      transition: all 0.3s ease;
    }
    .profile-card img:hover {
      transform: scale(1.05);
      border-color: #0a58ca;
    }
    .tab-pane .field { 
      margin-bottom: 15px; 
      padding: 10px;
      border-radius: 5px;
      transition: background-color 0.2s ease;
    }
    .tab-pane .field:hover {
      background-color: #f0f7ff;
    }
    .field strong { 
      width: 180px; 
      display: inline-block; 
      color: #333; 
      font-weight: 600;
    }
    .nav-tabs .nav-link {
      color: #495057;
      font-weight: 500;
    }
    .nav-tabs .nav-link.active {
      color: #0d6efd;
      font-weight: 600;
    }
    .document-link {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      transition: all 0.2s ease;
    }
    .document-link:hover {
      transform: translateY(-2px);
    }
    .section-title {
      border-left: 4px solid #0d6efd;
      padding-left: 10px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
<div class="container py-4">
  <div class="row g-4">
    
    <!-- Left Sidebar -->
    <div class="col-lg-3">
      <div class="card profile-card shadow-sm">
        <img src="<?php echo htmlspecialchars($profilePhoto); ?>" alt="Profile Photo" class="mx-auto">
        <h4 class="mb-1"><?php echo htmlspecialchars($profile['user_name']); ?></h4>
        <p class="mb-1 text-muted"><i class="bi bi-envelope"></i> <?php echo htmlspecialchars($profile['email']); ?></p>
        <p class="mb-1"><i class="bi bi-telephone"></i> <?php echo htmlspecialchars($profile['contact_no']); ?></p>
        <p class="mb-2"><i class="bi bi-briefcase"></i> <?php echo ucfirst($profile['experience']); ?></p>
        <div class="d-grid gap-2 mt-3">
          <a href="edit_profile.php" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Edit Profile</a>
          <a href="index.php" class="btn btn-outline-secondary"><i class="bi bi-house"></i> Dashboard</a>
        </div>
      </div>
    </div>
    
    <!-- Right Content -->
    <div class="col-lg-9">
      <div class="card shadow-sm">
        <div class="card-body">
          <!-- Tabs -->
          <ul class="nav nav-tabs" id="profileTabs" role="tablist">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#personal" type="button">
                <i class="bi bi-person"></i> Personal
              </button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#kyc" type="button">
                <i class="bi bi-card-checklist"></i> KYC
              </button>
            </li>
            <?php if($profile['experience'] == 'experienced'): ?>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#experience" type="button">
                  <i class="bi bi-briefcase"></i> Experience
                </button>
              </li>
            <?php endif; ?>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#education" type="button">
                <i class="bi bi-book"></i> Education
              </button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#emergency" type="button">
                <i class="bi bi-exclamation-triangle"></i> Emergency
              </button>
            </li>
          </ul>

          <!-- Tab Contents -->
          <div class="tab-content pt-4">
            
            <!-- Personal -->
            <div class="tab-pane fade show active" id="personal">
              <h5 class="section-title">Personal Information</h5>
              <div class="row">
                <div class="col-md-6">
                  <div class="field">
                    <strong><i class="bi bi-calendar"></i> Date of Birth:</strong> 
                    <?php echo htmlspecialchars($profile['dob']); ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="field">
                    <strong><i class="bi bi-briefcase"></i> Experience:</strong> 
                    <?php echo ucfirst(htmlspecialchars($profile['experience'])); ?>
                  </div>
                </div>
                <div class="col-12">
                  <div class="field">
                    <strong><i class="bi bi-geo-alt"></i> Current Address:</strong> 
                    <?php echo htmlspecialchars($profile['current_address']); ?>
                  </div>
                </div>
                <div class="col-12">
                  <div class="field">
                    <strong><i class="bi bi-house"></i> Permanent Address:</strong> 
                    <?php echo htmlspecialchars($profile['permanent_address']); ?>
                  </div>
                </div>
              </div>
            </div>

            <!-- KYC -->
            <div class="tab-pane fade" id="kyc">
              <h5 class="section-title">KYC & Bank Documents</h5>
              <div class="row">
                <div class="col-md-6">
                  <div class="field">
                    <strong><i class="bi bi-card-text"></i> Aadhar Card:</strong> 
                    <?php if(!empty($profile['aadhar_doc'])): ?>
                      <a href="<?php echo $profile['aadhar_doc']; ?>" class="btn btn-sm btn-outline-primary document-link" target="_blank">
                        <i class="bi bi-eye"></i> View Document
                      </a>
                    <?php else: ?>
                      <span class="text-muted">Not uploaded</span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="field">
                    <strong><i class="bi bi-card-text"></i> PAN Card:</strong> 
                    <?php if(!empty($profile['pan_doc'])): ?>
                      <a href="<?php echo $profile['pan_doc']; ?>" class="btn btn-sm btn-outline-primary document-link" target="_blank">
                        <i class="bi bi-eye"></i> View Document
                      </a>
                    <?php else: ?>
                      <span class="text-muted">Not uploaded</span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="field">
                    <strong><i class="bi bi-cash"></i> Cancelled Cheque:</strong> 
                    <?php if(!empty($profile['cheque_doc'])): ?>
                      <a href="<?php echo $profile['cheque_doc']; ?>" class="btn btn-sm btn-outline-primary document-link" target="_blank">
                        <i class="bi bi-eye"></i> View Document
                      </a>
                    <?php else: ?>
                      <span class="text-muted">Not uploaded</span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="field">
                    <strong><i class="bi bi-journal-text"></i> Passbook:</strong> 
                    <?php if(!empty($profile['passbook_doc'])): ?>
                      <a href="<?php echo $profile['passbook_doc']; ?>" class="btn btn-sm btn-outline-primary document-link" target="_blank">
                        <i class="bi bi-eye"></i> View Document
                      </a>
                    <?php else: ?>
                      <span class="text-muted">Not uploaded</span>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>

            <!-- Experience -->
            <?php if($profile['experience'] == 'experienced'): ?>
            <div class="tab-pane fade" id="experience">
              <h5 class="section-title">Experience Documents</h5>
              <div class="row">
                <div class="col-md-6">
                  <div class="field">
                    <strong><i class="bi bi-file-earmark-text"></i> Offer Letter:</strong> 
                    <?php if(!empty($profile['offer_letter_doc'])): ?>
                      <a href="<?php echo $profile['offer_letter_doc']; ?>" class="btn btn-sm btn-outline-primary document-link" target="_blank">
                        <i class="bi bi-eye"></i> View Document
                      </a>
                    <?php else: ?>
                      <span class="text-muted">Not uploaded</span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="field">
                    <strong><i class="bi bi-file-earmark-text"></i> Relieving Letter:</strong> 
                    <?php if(!empty($profile['relieving_letter_doc'])): ?>
                      <a href="<?php echo $profile['relieving_letter_doc']; ?>" class="btn btn-sm btn-outline-primary document-link" target="_blank">
                        <i class="bi bi-eye"></i> View Document
                      </a>
                    <?php else: ?>
                      <span class="text-muted">Not uploaded</span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="field">
                    <strong><i class="bi bi-file-earmark-text"></i> Salary Slip:</strong> 
                    <?php if(!empty($profile['salary_slip_doc'])): ?>
                      <a href="<?php echo $profile['salary_slip_doc']; ?>" class="btn btn-sm btn-outline-primary document-link" target="_blank">
                        <i class="bi bi-eye"></i> View Document
                      </a>
                    <?php else: ?>
                      <span class="text-muted">Not uploaded</span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="field">
                    <strong><i class="bi bi-envelope"></i> Rehire Mail:</strong> 
                    <?php if(!empty($profile['up_rehire_mail_doc'])): ?>
                      <a href="<?php echo $profile['up_rehire_mail_doc']; ?>" class="btn btn-sm btn-outline-primary document-link" target="_blank">
                        <i class="bi bi-eye"></i> View Document
                      </a>
                    <?php else: ?>
                      <span class="text-muted">Not uploaded</span>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <?php endif; ?>

            <!-- Education -->
            <div class="tab-pane fade" id="education">
              <h5 class="section-title">Education Details</h5>
              <div class="row">
                <div class="col-md-6">
                  <div class="field">
                    <strong><i class="bi bi-mortarboard"></i> Qualification:</strong> 
                    <?php 
                      $education = $profile['education'];
                      $educationDisplay = $education;
                      if($education == 'post_graduation') $educationDisplay = 'Post Graduation';
                      echo ucfirst(htmlspecialchars($educationDisplay)); 
                    ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="field">
                    <strong><i class="bi bi-file-earmark-text"></i> Marksheet:</strong> 
                    <?php if(!empty($profile['marksheet_doc'])): ?>
                      <a href="<?php echo $profile['marksheet_doc']; ?>" class="btn btn-sm btn-outline-primary document-link" target="_blank">
                        <i class="bi bi-eye"></i> View Document
                      </a>
                    <?php else: ?>
                      <span class="text-muted">Not uploaded</span>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>

            <!-- Emergency -->
            <div class="tab-pane fade" id="emergency">
              <h5 class="section-title">Emergency Contact</h5>
              
              <?php if($profile['contact_relation'] == 'father'): ?>
                <div class="card mb-3 border-primary">
                  <div class="card-header bg-primary text-white">
                    <i class="bi bi-person"></i> Father's Details
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="field">
                          <strong>Name:</strong> <?php echo htmlspecialchars($profile['father_name']); ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="field">
                          <strong>Contact:</strong> <?php echo htmlspecialchars($profile['father_contact']); ?>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="field">
                          <strong>Address:</strong> <?php echo htmlspecialchars($profile['father_address']); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php elseif($profile['contact_relation'] == 'mother'): ?>
                <div class="card mb-3 border-primary">
                  <div class="card-header bg-primary text-white">
                    <i class="bi bi-person"></i> Mother's Details
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="field">
                          <strong>Name:</strong> <?php echo htmlspecialchars($profile['mother_name']); ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="field">
                          <strong>Contact:</strong> <?php echo htmlspecialchars($profile['mother_contact']); ?>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="field">
                          <strong>Address:</strong> <?php echo htmlspecialchars($profile['mother_address']); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php elseif($profile['contact_relation'] == 'other'): ?>
                <div class="card mb-3 border-primary">
                  <div class="card-header bg-primary text-white">
                    <i class="bi bi-person"></i> <?php echo htmlspecialchars($profile['other_relation']); ?>'s Details
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="field">
                          <strong>Name:</strong> <?php echo htmlspecialchars($profile['other_name']); ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="field">
                          <strong>Relationship:</strong> <?php echo htmlspecialchars($profile['other_relation']); ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="field">
                          <strong>Contact:</strong> <?php echo htmlspecialchars($profile['other_contact']); ?>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="field">
                          <strong>Address:</strong> <?php echo htmlspecialchars($profile['other_address']); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            </div>

          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
