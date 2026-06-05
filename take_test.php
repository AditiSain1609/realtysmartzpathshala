<?php
session_start();
include 'db_connect.php';

// login ke waqt sirf user_id session me save hua tha
$user_id = $_SESSION['user_id'];

// ab users table se naam aur email nikal lo
$userRes = mysqli_query($conn, "SELECT name, email FROM users WHERE id = $user_id");
$userData = mysqli_fetch_assoc($userRes);

$user_name = $userData['name'];
$user_email = $userData['email'];

$checkSubmit = mysqli_query($conn, "SELECT set_no, start_time, end_time 
                                    FROM user_attempts 
                                    WHERE user_id = $user_id");

if (mysqli_num_rows($checkSubmit) > 0) {
    $row = mysqli_fetch_assoc($checkSubmit);
    if (!empty($row['end_time'])) {
        // ✅ User already attempted → direct result page dikhao
        header("Location: submit_test.php?set_no=".$row['set_no']);
        exit();
    }
    $set_no = $row['set_no'];
    $start_time = $row['start_time'];
} else {
    // Random ek set assign karo (1-10 ke beech)
    $set_no = rand(1, 10);
    mysqli_query($conn, "INSERT INTO user_attempts (user_id, set_no) VALUES ($user_id, $set_no)");
    $start_time = null;
}

// Agar user ne start button dabaya
if (isset($_POST['startTest'])) {
    $start_time = date("Y-m-d H:i:s");
    mysqli_query($conn, "UPDATE user_attempts  
                         SET start_time='$start_time' 
                         WHERE user_id=$user_id AND set_no=$set_no");
    header("Location: take_test.php"); // reload page
    exit();
}

// Questions fetch karo
$query = "SELECT * FROM questions WHERE set_id = $set_no";
$result = mysqli_query($conn, $query);
$questions = [];
while($row = mysqli_fetch_assoc($result)){
    $questions[] = $row;
}

// Remaining time calculate karo
$remaining_time = 900; // 15 min
if ($start_time) {
    $elapsed = time() - strtotime($start_time);
    $remaining_time = 900 - $elapsed;
    if ($remaining_time < 0) $remaining_time = 0;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Take Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('/assets/img/gallery/section_bg02.png') no-repeat center center fixed;
            background-size: cover;
            color: #222;
            user-select: none;
        }
        .container {
            width: 70%;
            margin: auto;
            background: rgba(255, 255, 255, 0.69);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
            margin-top: 40px;
        }
        .timer {
            font-size: 20px;
            font-weight: bold;
            color: red;
            text-align: right;
            display: none;
        }
        button {
            background: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .question-block {
            margin-bottom: 20px;
        }
    </style>
</head>
<body oncontextmenu="return false">

<div class="container">
<div style="text-align: center;">
    <!-- User Info -->
     <h2>Aptitude Skill Test</h2>

    <h2>Welcome, <?php echo $user_name; ?></h2>
    <p>Email: <?php echo $user_email; ?></p>

     <h5>Note : Please read all the articles of website before giving the test.</h5>
</div>
    <!-- Timer -->
    <div class="timer" id="timer">15:00</div>

    <!-- Start Button -->
    <?php if (!$start_time) { ?>
        <div id="startSection" style="text-align: center;">
            <form method="post">
                <button name="startTest"> Start Test</button>
            </form>
        </div>
    <?php } ?>

    <!-- Test Form -->
   
        <form method="post" action="submit_test.php" id="testForm" 
      style="display:<?php echo $start_time ? 'block' : 'none'; ?>;"
      onsubmit="return confirm('Do you want to submit your test?');">
        <?php 
        $i = 1;
        foreach($questions as $row) { ?>
            <div class="question-block">
                <p><b>Q<?php echo $i++; ?>. <?php echo $row['question_text']; ?></b></p>
                <label><input type="radio" name="ans[<?php echo $row['id']; ?>]" value="A"> <?php echo $row['option_a']; ?></label><br>
                <label><input type="radio" name="ans[<?php echo $row['id']; ?>]" value="B"> <?php echo $row['option_b']; ?></label><br>
                <label><input type="radio" name="ans[<?php echo $row['id']; ?>]" value="C"> <?php echo $row['option_c']; ?></label><br>
                <label><input type="radio" name="ans[<?php echo $row['id']; ?>]" value="D"> <?php echo $row['option_d']; ?></label><br>
            </div>
            <hr>
        <?php } ?>
        <input type="hidden" name="set_id" value="<?php echo $set_no; ?>">
        <button type="submit">Submit Test</button>
    </form>
</div>

<script>
    let timeLeft = <?php echo $remaining_time; ?>;
    let timerInterval;

    function updateTimer() {
        let minutes = Math.floor(timeLeft / 60);
        let seconds = timeLeft % 60;
        document.getElementById("timer").innerHTML =
            (minutes < 10 ? "0" : "") + minutes + ":" + 
            (seconds < 10 ? "0" : "") + seconds;

        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            document.getElementById("testForm").submit(); // auto submit
        }
        timeLeft--;
    }

    <?php if ($start_time) { ?>
        document.getElementById("timer").style.display = "block";
        timerInterval = setInterval(updateTimer, 1000);
    <?php } ?>


    // 🚨 Anti-cheating with warning first, then submit
    let cheatCount = 0;
    let submittingNow = false; // ✅ नया flag

    document.addEventListener("visibilitychange", function() {
        if (document.hidden && !submittingNow) {   // ✅ अगर submit नहीं हो रहा तभी cheating check
            cheatCount++;
            if (cheatCount === 1) {
                alert("⚠️ Warning: Tab switching detected! Next time your test will be submitted.");
            } else if (cheatCount >= 2) {
                alert("❌ Cheating detected again! Your test is being submitted.");
                document.getElementById("testForm").onsubmit = null; 
                document.getElementById("testForm").submit();
            }
        }
    });

    // ✅ जब user खुद submit करे, flag true कर दो
    document.getElementById("testForm").addEventListener("submit", function() {
        submittingNow = true;
    });

    // कुछ shortcut block karo
    document.onkeydown = function(e) {
        if (e.ctrlKey && (e.key === "c" || e.key === "u" || e.key === "v" || e.key === "x" || e.key === "a")) {
            return false;
        }
        if (e.key === "F12" || e.key === "Escape") {
            return false;
        }
    };
</script>

</body>
</html>
