<?php
session_start();

// ตรวจสอบการเข้าสู่ระบบ
if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // ถ้ายังไม่ได้เข้าสู่ระบบ
    exit();
}

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "ghost_cool";

// เชื่อมต่อฐานข้อมูล
$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
    die("เชื่อมต่อฐานข้อมูลไม่ได้: " . mysqli_connect_error());
}

// การเพิ่มผู้ใช้
if (isset($_POST['add_user'])) {
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    $new_password = $_POST['new_password'];

    $insert_sql = "INSERT INTO users (username, email, password) VALUES ('$new_username', '$new_email', '$new_password')";
    if (mysqli_query($conn, $insert_sql)) {
        echo "เพิ่มผู้ใช้สำเร็จ!";
    } else {
        echo "ไม่สามารถเพิ่มผู้ใช้ได้: " . mysqli_error($conn);
    }
}

// การลบผู้ใช้
if (isset($_GET['delete_user'])) {
    $user_id = $_GET['delete_user'];
    $delete_sql = "DELETE FROM users WHERE id = '$user_id'";
    if (mysqli_query($conn, $delete_sql)) {
        echo "ลบผู้ใช้สำเร็จ!";
    } else {
        echo "ไม่สามารถลบผู้ใช้ได้: " . mysqli_error($conn);
    }
}

// การแก้ไขข้อมูลผู้ใช้
if (isset($_POST['edit_user'])) {
    $user_id = $_POST['user_id'];
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    $new_password = $_POST['new_password'];

    $update_sql = "UPDATE users SET username='$new_username', email='$new_email', password='$new_password' WHERE id='$user_id'";
    if (mysqli_query($conn, $update_sql)) {
        echo "แก้ไขผู้ใช้สำเร็จ!";
    } else {
        echo "ไม่สามารถแก้ไขผู้ใช้ได้: " . mysqli_error($conn);
    }
}

// ดึงข้อมูลผู้ใช้ทั้งหมด
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Ghost Cool</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .button {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
        }

        .form-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h1>Welcome, Admin</h1>
<p><a href="logout.php">Logout</a></p>

<h2>Manage Users</h2>

<!-- ฟอร์มสำหรับเพิ่มผู้ใช้ใหม่ -->
<div class="form-container">
    <h3>Add New User</h3>
    <form method="POST" action="">
        <input type="text" name="new_username" placeholder="Username" required><br><br>
        <input type="email" name="new_email" placeholder="Email" required><br><br>
        <input type="password" name="new_password" placeholder="Password" required><br><br>
        <button type="submit" name="add_user" class="button">Add User</button>
    </form>
</div>

<!-- ตารางแสดงรายชื่อผู้ใช้ทั้งหมด -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a href="admin.php?edit_user=<?php echo $row['id']; ?>">Edit</a> |
                    <a href="admin.php?delete_user=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- ฟอร์มสำหรับแก้ไขผู้ใช้ -->
<?php
if (isset($_GET['edit_user'])) {
    $user_id = $_GET['edit_user'];
    $edit_sql = "SELECT * FROM users WHERE id = '$user_id'";
    $edit_result = mysqli_query($conn, $edit_sql);
    $user = mysqli_fetch_assoc($edit_result);
?>

<h3>Edit User</h3>
<form method="POST" action="">
    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
    <input type="text" name="new_username" value="<?php echo $user['username']; ?>" required><br><br>
    <input type="email" name="new_email" value="<?php echo $user['email']; ?>" required><br><br>
    <input type="password" name="new_password" value="<?php echo $user['password']; ?>" required><br><br>
    <button type="submit" name="edit_user" class="button">Update User</button>
</form>

<?php } ?>

</body>
</html>

<?php
mysqli_close($conn);
?>
