<?php
require_once 'auth_check.php';
require_once '../config/db.php';

$result = $conn->query('SELECT id, student_name, class, parent_phone, created_at FROM students ORDER BY id DESC');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Student List</h2>
    <div class="nav">
        <a href="dashboard.php">Dashboard</a>
        <a href="add_student.php">Add Student</a>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Class</th>
            <th>Parent Phone</th>
            <th>Created</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo (int)$row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                <td><?php echo htmlspecialchars($row['class']); ?></td>
                <td><?php echo htmlspecialchars($row['parent_phone']); ?></td>
                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
