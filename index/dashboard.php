<?php
require_once 'auth_check.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h2>
    <div class="nav">
        <a href="dashboard.php">Dashboard</a>
        <a href="add_student.php">Add Student</a>
        <a href="students.php">Student List</a>
        <a href="add_payment.php">Record Payment</a>
        <a href="payments.php">Payment History</a>
        <a href="logout.php">Logout</a>
    </div>
    <p>This is a simple School Fee Management System.</p>
</div>
</body>
</html>
