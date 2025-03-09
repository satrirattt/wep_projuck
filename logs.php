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

// Fetch logs
$logs = $conn->query("SELECT * FROM action_logs ORDER BY action_time DESC");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Action Logs</title>
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
            <h2 class="text-xl font-bold mb-4">Action Logs</h2>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Action</th>
                        <th class="py-2 px-4 border-b">Table Name</th>
                        <th class="py-2 px-4 border-b">Record ID</th>
                        <th class="py-2 px-4 border-b">Admin Username</th>
                        <th class="py-2 px-4 border-b">Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($log = $logs->fetch_assoc()): ?>
                        <tr>
                            <td class="py-2 px-4 border-b text-center"><?php echo $log['id']; ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo $log['action']; ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo $log['table_name']; ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo $log['record_id']; ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo $log['admin_username']; ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo $log['action_time']; ?></td>
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