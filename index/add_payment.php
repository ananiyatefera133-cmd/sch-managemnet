<?php
require_once 'auth_check.php';
require_once '../config/db.php';

$message = '';
$error = '';

$students = $conn->query('SELECT id, student_name FROM students ORDER BY student_name ASC');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = (int)($_POST['student_id'] ?? 0);
    $amount = trim($_POST['amount'] ?? '');
    $payment_date = trim($_POST['payment_date'] ?? '');
    $method = trim($_POST['method'] ?? 'cash');
    $created_by = (int)$_SESSION['user_id'];

    if ($student_id <= 0 || $amount === '' || $payment_date === '') {
        $error = 'Please fill required fields.';
    } else {
        $stmt = $conn->prepare('INSERT INTO payments (student_id, amount, payment_date, method, created_by) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('idssi', $student_id, $amount, $payment_date, $method, $created_by);

        if ($stmt->execute()) {
            $message = 'Payment recorded successfully.';
        } else {
            $error = 'Could not record payment.';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Payment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Record Fee Payment</h2>
    <div class="nav">
        <a href="dashboard.php">Dashboard</a>
        <a href="payments.php">Payment History</a>
    </div>

    <?php if ($error): ?>
        <div class="message error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <?php if ($message): ?>
        <div class="message success"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <form method="post">
        <label>Student</label>
        <select name="student_id" required>
            <option value="">Select student</option>
            <?php while ($s = $students->fetch_assoc()): ?>
                <option value="<?php echo (int)$s['id']; ?>"><?php echo htmlspecialchars($s['student_name']); ?></option>
            <?php endwhile; ?>
        </select>

        <label>Amount</label>
        <input type="number" step="0.01" name="amount" required>

        <label>Payment Date</label>
        <input type="date" name="payment_date" required>

        <label>Method</label>
        <select name="method">
            <option value="cash">Cash</option>
            <option value="bank">Bank</option>
            <option value="mobile">Mobile</option>
        </select>

        <button type="submit">Save Payment</button>
    </form>
</div>
</body>
</html>
