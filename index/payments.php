<?php
require_once 'auth_check.php';
require_once '../config/db.php';

$sql = "SELECT p.id, s.student_name, p.amount, p.payment_date, p.method, u.full_name AS created_by
        FROM payments p
        JOIN students s ON p.student_id = s.id
        LEFT JOIN users u ON p.created_by = u.id
        ORDER BY p.id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment History</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Payment History</h2>
    <div class="nav">
        <a href="dashboard.php">Dashboard</a>
        <a href="add_payment.php">Record Payment</a>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Student</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Method</th>
            <th>Recorded By</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo (int)$row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                <td><?php echo htmlspecialchars($row['amount']); ?></td>
                <td><?php echo htmlspecialchars($row['payment_date']); ?></td>
                <td><?php echo htmlspecialchars($row['method']); ?></td>
                <td><?php echo htmlspecialchars($row['created_by'] ?? 'N/A'); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
