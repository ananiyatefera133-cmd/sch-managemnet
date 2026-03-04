<?php
require_once 'auth_check.php';
require_once '../config/db.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_name = trim($_POST['student_name'] ?? '');
    $class = trim($_POST['class'] ?? '');
    $parent_phone = trim($_POST['parent_phone'] ?? '');

    if ($student_name === '' || $class === '') {
        $error = 'Student name and class are required.';
    } else {
        $stmt = $conn->prepare('INSERT INTO students (student_name, class, parent_phone) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $student_name, $class, $parent_phone);
        if ($stmt->execute()) {
            $message = 'Student added successfully.';
        } else {
            $error = 'Could not add student.';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Add Student</h2>
    <div class="nav">
        <a href="dashboard.php">Dashboard</a>
        <a href="students.php">Student List</a>
    </div>
    <?php if ($error): ?>
        <div class="message error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <?php if ($message): ?>
        <div class="message success"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <form method="post">
        <label>Student Name</label>
        <input type="text" name="student_name" required>

        <label>Class</label>
        <input type="text" name="class" required>

        <label>Parent Phone</label>
        <input type="text" name="parent_phone">

        <button type="submit">Save</button>
    </form>
</div>
</body>
</html>
