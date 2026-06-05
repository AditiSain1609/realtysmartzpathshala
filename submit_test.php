<?php
session_start();
include 'db_connect.php';

$user_id = $_SESSION['user_id'] ?? 0;
if (!$user_id) { die("Login required."); }


$set_no = isset($_POST['set_no']) ? intval($_POST['set_no']) : 0;
if (!$set_no && isset($_POST['set_id'])) { $set_no = intval($_POST['set_id']); }
if (!$set_no && isset($_GET['set_no'])) { $set_no = intval($_GET['set_no']); }
if (!$set_no) { die("Invalid test set."); }


$checkAttempt = mysqli_query($conn, "SELECT * FROM user_attempts 
                                     WHERE user_id=$user_id 
                                     AND set_no=$set_no 
                                     AND end_time IS NOT NULL");

if ($checkAttempt && mysqli_num_rows($checkAttempt) > 0) {
    
    $attempt = mysqli_fetch_assoc($checkAttempt);
    $score   = $attempt['score'];

    
    $qRes = mysqli_query($conn, "SELECT q.id, q.question_text, q.option_a, q.option_b, q.option_c, q.option_d, q.correct_option,
                                        ua.answer as user_answer
                                 FROM questions q
                                 LEFT JOIN user_answers ua 
                                        ON ua.question_id=q.id AND ua.user_id=$user_id
                                 WHERE q.set_id=$set_no");
    $questions = [];
    while($row = mysqli_fetch_assoc($qRes)) { $questions[] = $row; }
    $total = count($questions);

} else {
    
    $answers = $_POST['ans'] ?? [];

   
    $check = mysqli_query($conn, "SELECT start_time FROM user_attempts 
                                  WHERE user_id=$user_id AND set_no=$set_no");
    if (!$check || mysqli_num_rows($check) === 0) { die("Attempt not found."); }
    $row = mysqli_fetch_assoc($check);
    $start_time = $row['start_time'] ?? null;
    if (!$start_time) { die("Test has not been started."); }

    
    $qRes = mysqli_query($conn, "SELECT * FROM questions WHERE set_id=$set_no");
    $questions = [];
    while ($qrow = mysqli_fetch_assoc($qRes)) { $questions[] = $qrow; }
    $total = count($questions);

    $score = 0;
    foreach ($questions as $qrow) {
        $qid = (int)$qrow['id'];
        $user_answer = $answers[$qid] ?? null;
        $correct = $qrow['correct_option'];

        $is_correct = ($user_answer && $user_answer === $correct) ? 1 : 0;
        if ($is_correct) $score++;

        if ($user_answer !== null && $user_answer !== '') {
            $ua = mysqli_real_escape_string($conn, $user_answer);
            mysqli_query($conn, "INSERT INTO user_answers (user_id, question_id, answer, is_correct)
                                 VALUES ($user_id, $qid, '$ua', $is_correct)");
        }
    }

    
    mysqli_query($conn, "UPDATE user_attempts SET score=$score, end_time=NOW() 
                         WHERE user_id=$user_id AND set_no=$set_no");

    
    $qRes = mysqli_query($conn, "SELECT q.id, q.question_text, q.option_a, q.option_b, q.option_c, q.option_d, q.correct_option,
                                        ua.answer as user_answer
                                 FROM questions q
                                 LEFT JOIN user_answers ua 
                                        ON ua.question_id=q.id AND ua.user_id=$user_id
                                 WHERE q.set_id=$set_no");
    $questions = [];
    while($row = mysqli_fetch_assoc($qRes)) { $questions[] = $row; }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Result</title>
    <style>
        body { 
            font-family: Arial, sans-serif;
            background: url('/assets/img/gallery/section_bg02.png') no-repeat center center fixed;
            background-size: cover;
            color: #222;
            user-select: none;
        }
        .container { width:80%; margin:auto; background:#fff; padding:20px; border-radius:12px; margin-top:30px; box-shadow:0 0 10px rgba(0,0,0,0.2);}
        h2 { text-align:center; color:green; }
        .score { text-align:center; font-size:20px; font-weight:bold; color:blue; }
        .correct { color:green; font-weight:bold; }
        .wrong { color:red; font-weight:bold; }
        .unanswered { color:#999; font-style:italic; }
    </style>
</head>
<body>
<div class="container">
    <h2>📊 Your Test Result</h2>
    <p class="score">Your Score: <?php echo $score; ?> / <?php echo $total; ?></p>
    <hr>
    <h3>📖 Review Your Answers</h3>
    <?php foreach($questions as $i => $q) { ?>
        <div>
            <p><b>Q<?php echo $i+1; ?>. <?php echo htmlspecialchars($q['question_text']); ?></b></p>
            <ul>
                <?php foreach(["A","B","C","D"] as $opt){ 
                    $classes=[];
                    if($q['correct_option']===$opt) $classes[]='correct';
                    if(($q['user_answer']??'')===$opt && $q['user_answer']!==$q['correct_option']) $classes[]='wrong';
                ?>
                    <li class="<?php echo implode(' ', $classes); ?>">
                        <?php echo $opt.". ".htmlspecialchars($q["option_".strtolower($opt)]); ?>
                        <?php 
                        if(($q['user_answer']??'')===$opt && $q['user_answer']===$q['correct_option']) echo " ✅ (Your Answer)";
                        elseif(($q['user_answer']??'')===$opt) echo " ❌ (Your Answer)";
                        elseif($q['correct_option']===$opt) echo " ✅ (Correct)";
                        ?>
                    </li>
                <?php } ?>
            </ul>
            <?php if(empty($q['user_answer'])) { ?>
                <div class="unanswered">You did not answer this question.</div>
            <?php } ?>
        </div>
        <hr>
    <?php } ?>
    <form action="index.php"><button type="submit">Back to Dashboard</button></form>
</div>
</body>
</html>
