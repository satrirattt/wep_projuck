<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ghost_cool";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to log actions
function logAction($conn, $action, $table_name, $record_id, $admin_username) {
    $stmt = $conn->prepare("INSERT INTO action_logs (action, table_name, record_id, admin_username) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $action, $table_name, $record_id, $admin_username);
    $stmt->execute();
    $stmt->close();
}

// Admin username
$admin_username = "admin"; // Change to the actual admin username

// Handle user actions
if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    $conn->query("DELETE FROM review_votes WHERE user_id = $user_id");
    $conn->query("DELETE FROM reviews WHERE user_id = $user_id");
    $conn->query("DELETE FROM users WHERE id = $user_id");
    logAction($conn, 'DELETE', 'users', $user_id, $admin_username);
}

if (isset($_POST['edit_user'])) {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $conn->query("UPDATE users SET username = '$username', email = '$email' WHERE id = $user_id");
    logAction($conn, 'EDIT', 'users', $user_id, $admin_username);
}

// Fetch users
$users = $conn->query("SELECT * FROM users");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>User Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Creepster&display=swap');

    body {
        font-family: 'Mitr', sans-serif;
    }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-red-900 h-screen p-4">
        <div class="text-white text-2xl font-bold mb-6"><a href="Foradmin.php">GhostCool 👻</a></div>
            <nav>
                <ul>
                    <li class="mb-4"><a class="flex items-center text-white" href="users.php"><i class="fas fa-user mr-2"></i>Users</a></li>
                    <li class="mb-4"><a class="flex items-center text-white" href="places.php"><i class="fas fa-map-marker-alt mr-2"></i>Places</a></li>
                    <li class="mb-4"><a class="flex items-center text-white" href="reviews.php"><i class="fas fa-comments mr-2"></i>Reviews</a></li>
                    <li class="mb-4"><a class="flex items-center text-white" href="logs.php"><i class="fas fa-file-alt mr-2"></i>Logs</a></li>
                    <li class="mb-4"><a class="flex items-center text-white" href="adminlogout.php"><i class="fas fa-file-alt mr-2"></i>Logout</a></li>

                </ul>
            </nav>
        </div>
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h2 class="text-xl font-bold mb-4">User  Management</h2>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-8 border-b">ID</th>
                        <th class="py-2 px-8 border-b">Username</th>
                        <th class="py-2 px-8 border-b">Email</th>
                        <th class="py-2 px-8 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = $users->fetch_assoc()): ?>
                        <tr>
                            <form method="POST">

                                <td class="py-2 px-8 border-b text-center"><?php echo $user['id']; ?></td>
                                <td class="py-2 px-8 border-b text-center"><input type="text" name="username" value="<?php echo $user['username']; ?>" required></td>
                                <td class="py-2 px-8 border-b text-center"><input type="email" name="email" value="<?php echo $user['email']; ?>" required></td>
                                <td class="py-2 px-8 border-b text-center">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" name="edit_user" class="bg-blue-600 text-white py-1 px-3 rounded">Edit</button>
                                    <button type="submit" name="delete_user" class="bg-red-600 text-white py-1 px-3 rounded">Delete</button>
                                </td>
                            </form>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div class="text-center mt-6">
            </div>
        </div>
    </div>
</body>
</html>