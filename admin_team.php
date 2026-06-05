<?php
session_start();
include 'db_connect.php';

// ✅ Authentication check
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. Please login as admin.");
}

// ✅ Delete Member
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM team WHERE id=$id");
    echo "<p style='color:red'>Member deleted successfully!</p>";
}

// ✅ Add Member
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_member'])) {
    $name       = $_POST['name'];
    $role       = $_POST['role'];
    $type       = $_POST['type'];
    $department = $_POST['department'];

    $photo_url = "";
    if (!empty($_FILES['photo']['name'])) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);
        $target_file = $target_dir . time() . "_" . basename($_FILES["photo"]["name"]);
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $photo_url = $target_file;
        }
    }

    $stmt = $conn->prepare("INSERT INTO team (name, role, photo_url, type, department) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $role, $photo_url, $type, $department);
    $stmt->execute();
    $stmt->close();

    echo "<p style='color:green'>Member added successfully!</p>";
}

// ✅ Update Member
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_id'])) {
    $id         = intval($_POST['update_id']);
    $name       = $_POST['name'];
    $role       = $_POST['role'];
    $type       = $_POST['type'];
    $department = $_POST['department'];

    $photo_url = $_POST['old_photo'];
    if (!empty($_FILES['photo']['name'])) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);
        $target_file = $target_dir . time() . "_" . basename($_FILES["photo"]["name"]);
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $photo_url = $target_file;
        }
    }

    $stmt = $conn->prepare("UPDATE team SET name=?, role=?, photo_url=?, type=?, department=? WHERE id=?");
    $stmt->bind_param("sssssi", $name, $role, $photo_url, $type, $department, $id);
    $stmt->execute();
    $stmt->close();

    echo "<p style='color:green'>Member updated successfully!</p>";
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Manage Team</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function openModal(id) {
      document.getElementById("modal-" + id).classList.remove("hidden");
    }
    function closeModal(id) {
      document.getElementById("modal-" + id).classList.add("hidden");
    }
  </script>
</head>
<body class="bg-gray-100 p-6">

  <!-- Add Member Form -->
  <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6 mb-8">
    <h2 class="text-2xl font-bold mb-4">Add Team Member</h2>

    <form method="post" enctype="multipart/form-data" class="space-y-4">
      <input type="hidden" name="add_member" value="1">
      <div>
        <label class="block font-semibold">Name</label>
        <input type="text" name="name" required class="w-full p-2 border rounded">
      </div>

      <div>
        <label class="block font-semibold">Role</label>
        <input type="text" name="role" required class="w-full p-2 border rounded">
      </div>

      <div>
        <label class="block font-semibold">Type</label>
        <select name="type" class="w-full p-2 border rounded">
          <option value="manager">Manager</option>
          <option value="peer" selected>Peer</option>
        </select>
      </div>

      <div>
        <label class="block font-semibold">Department</label>
        <input type="text" name="department" placeholder="e.g. IT, HR, Marketing" required class="w-full p-2 border rounded">
      </div>

      <div>
        <label class="block font-semibold">Photo</label>
        <input type="file" name="photo" accept="image/*" class="w-full">
      </div>

      <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
        Add Member
      </button>
    </form>
  </div>

  <!-- Show Existing Members -->
  <div class="max-w-5xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Team Members</h2>
    <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
      <thead class="bg-gray-200">
        <tr>
          <th class="p-2">Photo</th>
          <th class="p-2">Name</th>
          <th class="p-2">Role</th>
          <th class="p-2">Type</th>
          <th class="p-2">Department</th>
          <th class="p-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $result = $conn->query("SELECT * FROM team ORDER BY id DESC");
        while ($row = $result->fetch_assoc()) {
            echo "
              <tr class='border-b'>
                <td class='p-2'><img src='{$row['photo_url']}' class='w-12 h-12 rounded-full'></td>
                <td class='p-2'>{$row['name']}</td>
                <td class='p-2'>{$row['role']}</td>
                <td class='p-2 capitalize'>{$row['type']}</td>
                <td class='p-2'>{$row['department']}</td>
                <td class='p-2'>
                  <button onclick='openModal({$row['id']})' class='bg-green-600 text-white px-2 py-1 rounded text-sm'>Edit</button>
                  <a href='?delete={$row['id']}' onclick=\"return confirm('Delete this member?')\" class='bg-red-600 text-white px-2 py-1 rounded text-sm'>Delete</a>
                </td>
              </tr>

              <!-- Modal for Edit -->
              <div id='modal-{$row['id']}' class='hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center'>
                <div class='bg-white rounded-lg p-6 w-96'>
                  <h2 class='text-xl font-bold mb-4'>Edit Member</h2>
                  <form method='post' enctype='multipart/form-data' class='space-y-3'>
                    <input type='hidden' name='update_id' value='{$row['id']}'>
                    <input type='hidden' name='old_photo' value='{$row['photo_url']}'>

                    <div>
                      <label class='block font-semibold'>Name</label>
                      <input type='text' name='name' value='{$row['name']}' class='w-full p-2 border rounded'>
                    </div>

                    <div>
                      <label class='block font-semibold'>Role</label>
                      <input type='text' name='role' value='{$row['role']}' class='w-full p-2 border rounded'>
                    </div>

                    <div>
                      <label class='block font-semibold'>Type</label>
                      <select name='type' class='w-full p-2 border rounded'>
                        <option value='manager' ".($row['type']=="manager"?"selected":"").">Manager</option>
                        <option value='peer' ".($row['type']=="peer"?"selected":"").">Peer</option>
                      </select>
                    </div>

                    <div>
                      <label class='block font-semibold'>Department</label>
                      <input type='text' name='department' value='{$row['department']}' class='w-full p-2 border rounded'>
                    </div>

                    <div>
                      <label class='block font-semibold'>Photo</label>
                      <input type='file' name='photo' class='w-full'>
                    </div>

                    <div class='flex justify-between mt-4'>
                      <button type='submit' class='bg-blue-600 text-white px-3 py-1 rounded'>Update</button>
                      <button type='button' onclick='closeModal({$row['id']})' class='bg-gray-500 text-white px-3 py-1 rounded'>Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
            ";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
