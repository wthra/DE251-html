<?php
require_once 'config.php';
checkAuth();

if ($_SESSION['role'] === 'admin') {
    header("Location: admin.php");
    exit;
}

$conn = initDB();
$students = $conn->query("SELECT * FROM student ORDER BY std_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <div class="topnav">
        <div class="topnav-right">
            Welcome <?php echo sanitize($_SESSION['username']); ?> (User)
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- Student Table -->
    <h2>Students List</h2>
    <table id="studentsTable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Last Name</th>
            <th>Major</th>
            <th>DOB</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $students->fetch_assoc()): ?>
            <tr>
                <td><?php echo sanitize($row['std_id']); ?></td>
                <td><?php echo sanitize($row['firstname']); ?></td>
                <td><?php echo sanitize($row['lastname']); ?></td>
                <td><?php echo sanitize($row['major']); ?></td>
                <td><?php echo sanitize($row['dob']); ?></td>
                <td><?php echo sanitize($row['email']); ?></td>
                <td><?php echo sanitize($row['phone']); ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#studentsTable').DataTable();
    });
</script>
</body>
</html>
