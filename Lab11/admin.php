<?php
require_once 'config.php';
checkAuth();

if ($_SESSION['role'] !== 'admin') {
    header("Location: user.php");
    exit;
}

$conn = initDB();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate major before processing
    if (isset($_POST['major']) && !in_array($_POST['major'], ['Math', 'Stat', 'CS'])) {
        die("Invalid major selected");
    }

    if (isset($_POST['insert'])) {
        $stmt = $conn->prepare("INSERT INTO student (std_id, firstname, lastname, major, dob, email, phone) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss",
            $_POST['id'],
            $_POST['fname'],
            $_POST['lname'],
            $_POST['major'],
            $_POST['date'],
            $_POST['mail'],
            $_POST['num']
        );
        $stmt->execute();
    }

    if (isset($_POST['delete_id'])) {
        $stmt = $conn->prepare("DELETE FROM student WHERE std_id = ?");
        $stmt->bind_param("s", $_POST['delete_id']);
        $stmt->execute();
    }

    if (isset($_POST['update'])) {
        $stmt = $conn->prepare("UPDATE student SET firstname=?, lastname=?, major=?, dob=?, email=?, phone=? WHERE std_id=?");
        $stmt->bind_param("sssssss",
            $_POST['fname'],
            $_POST['lname'],
            $_POST['major'],
            $_POST['date'],
            $_POST['mail'],
            $_POST['num'],
            $_POST['edit_id']
        );
        $stmt->execute();
    }

    header("Location: admin.php");
    exit;
}

$students = $conn->query("SELECT * FROM student ORDER BY std_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>
<body class="bg-gray-50">
<div class="min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold text-gray-800">Student Management</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Welcome <?php echo sanitize($_SESSION['username']); ?> (Admin)</span>
                    <a href="logout.php"
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Student Form -->
        <div class="bg-white shadow rounded-lg mb-6">
            <div class="px-4 py-5 sm:p-6">
                <form method="post" class="space-y-6" id="studentForm">
                    <h2 class="text-lg font-medium text-gray-900" id="formTitle">Add New Student</h2>
                    <input type="hidden" name="edit_id" id="editId">

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Student ID</label>
                            <input type="text" name="id" id="studentId" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" name="fname" id="firstName" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" name="lname" id="lastName" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Major</label>
                            <select name="major" id="major" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Select Major</option>
                                <option value="Math">Math</option>
                                <option value="Stat">Stat</option>
                                <option value="CS">CS</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                            <input type="date" name="date" id="dob" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="mail" id="email" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="tel" name="num" id="phone" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" id="cancelBtn"
                                class="hidden px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" name="insert" id="submitBtn"
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                            Add Student
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Students Table -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <table id="studentsTable" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last
                            Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Major
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DOB
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Phone
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <?php while ($row = $students->fetch_assoc()): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo sanitize($row['std_id']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo sanitize($row['firstname']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo sanitize($row['lastname']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo sanitize($row['major']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo sanitize($row['dob']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo sanitize($row['email']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo sanitize($row['phone']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button class="text-indigo-600 hover:text-indigo-900 edit-btn"
                                        data-id="<?php echo $row['std_id']; ?>"
                                        data-fname="<?php echo $row['firstname']; ?>"
                                        data-lname="<?php echo $row['lastname']; ?>"
                                        data-major="<?php echo $row['major']; ?>"
                                        data-dob="<?php echo $row['dob']; ?>"
                                        data-email="<?php echo $row['email']; ?>"
                                        data-phone="<?php echo $row['phone']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900 delete-btn"
                                        data-id="<?php echo $row['std_id']; ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- Delete Form -->
<form id="deleteForm" method="post" class="hidden">
    <input type="hidden" name="delete_id" id="deleteId">
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        // Initialize DataTable with custom styling
        $('#studentsTable').DataTable({
            dom: '<"flex justify-between items-center mb-4"lf>rt<"flex justify-between items-center mt-4"ip>',
            language: {
                search: "",
                searchPlaceholder: "Search students..."
            },
            initComplete: function () {
                // Style the search input
                $('.dataTables_filter input').addClass('mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm');
                // Style the length select
                $('.dataTables_length select').addClass('mt-1 block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm');
            }
        });

        // Handle Edit Button Click
        $('.edit-btn').click(function () {
            const btn = $(this);
            $('#formTitle').text('Edit Student');
            $('#studentId').val(btn.data('id')).prop('readonly', true);
            $('#firstName').val(btn.data('fname'));
            $('#lastName').val(btn.data('lname'));
            $('#major').val(btn.data('major'));
            $('#dob').val(btn.data('dob'));
            $('#email').val(btn.data('email'));
            $('#phone').val(btn.data('phone'));
            $('#editId').val(btn.data('id'));
            $('#submitBtn').text('Update Student').attr('name', 'update');
            $('#cancelBtn').removeClass('hidden');

            // Smooth scroll to form
            $('html, body').animate({
                scrollTop: $("#studentForm").offset().top - 20
            }, 500);
        });

        // Handle Delete Button Click
        $('.delete-btn').click(function () {
            if (confirm('Are you sure you want to delete this student?')) {
                $('#deleteId').val($(this).data('id'));
                $('#deleteForm').submit();
            }
        });

        // Handle Cancel Button Click
        $('#cancelBtn').click(function () {
            resetForm();
        });

        // Reset Form Function
        function resetForm() {
            $('#formTitle').text('Add New Student');
            $('#studentForm')[0].reset();
            $('#studentId').prop('readonly', false);
            $('#editId').val('');
            $('#submitBtn').text('Add Student').attr('name', 'insert');
            $('#cancelBtn').addClass('hidden');
        }
    });
</script>
</body>
</html>