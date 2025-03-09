<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Creepster&display=swap');
        .THAI{
            font-family: 'Mitr', sans-serif;
        }
        body {
            font-family: 'Creepster', cursive;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-red-900 h-screen p-4">
            <div class="text-white text-2xl font-bold mb-6"><a href="Foradmin.php"></a>GhostCool 👻</div>
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
            <h1 class="text-2xl font-bold">Welcome to the Admin Dashboard</h1>
            <p class="THAI">ใช้แถบด้านข้างเพื่อ ลบ และ แก้ไขข้อมูล</p>

            <div class="text-center mt-6">
            </div>
        </div>
    </div>
</body>

</html>