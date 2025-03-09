<?php
session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "ghost_cool";

// เชื่อมต่อฐานข้อมูล
$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
    die("เชื่อมต่อฐานข้อมูลไม่ได้: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    // ตรวจสอบว่ารหัสผ่านและยืนยันรหัสผ่านตรงกัน
    if ($pass !== $confirm_pass) {
        $error = "รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน!";
    } else {
        // ตรวจสอบว่ามีผู้ใช้ด้วยชื่อผู้ใช้หรืออีเมลนี้แล้วหรือไม่
        $check_user = "SELECT * FROM users WHERE username = '$user' OR email = '$email'";
        $result = mysqli_query($conn, $check_user);

        if (mysqli_num_rows($result) > 0) {
            $error = "ชื่อผู้ใช้หรืออีเมลนี้ถูกใช้แล้ว!";
        } else {
            // สร้างบัญชีผู้ใช้ใหม่ (บันทึกรหัสผ่านแบบไม่เข้ารหัส)
            $sql = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$pass')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['user'] = $user;
                header("Location: index.php"); // เปลี่ยนเส้นทางไปยังหน้า index.php
                exit();
            } else {
                $error = "เกิดข้อผิดพลาดในการสร้างบัญชีผู้ใช้!";
            }
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Ghost Cool</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Creepster&display=swap');
        
        body {
            background-color: #121212;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            margin: 0;
        }
        
        .login-container {
            background: #fff;
            color: black;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            width: 100%;
            max-width: 400px; /* จำกัดความกว้างของฟอร์ม */
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
            position: relative;
            margin-top: 20px;
        }
        
        .login-container::after {
            content: "";
            display: block;
            width: 100%;
            height: 25px;
            background: #910000;
            position: absolute;
            bottom: 0;
            left: 0;
            border-radius: 0 0 15px 15px;
        }
        
        .login-container h2 {
            font-family: 'Creepster', cursive;
            font-size: 30px; /* ลดขนาดหัวข้อ */
            margin-bottom: 15px;
            margin-top: 10px;
        }
        
        .login-container img {
            width: 100px; /* ปรับขนาดรูปให้พอดี */
            margin-bottom: -40px; /* ระยะห่างระหว่างรูปกับหัวข้อ */
        }
        
        .login-container input {
            width: 95%;
            padding: 10px; /* ลดขนาดของ padding */
            margin: 5px 0 10px 0; /* ลด margin ระหว่างช่องกรอกข้อมูล */
            border: 2px solid #910000;
            border-radius: 8px;
            background: #f9f9f9;
            font-size: 14px; /* ลดขนาดฟอนต์ */
        }
        
        .login-container button {
            width: 100%;
            padding: 10px;
            background: black;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px; /* ลดขนาดฟอนต์ของปุ่ม */
            font-weight: bold;
            transition: 0.3s;
        }
        
        .login-container button:hover {
            background: #910000;
        }
        
        .create-account {
            font-size: 12px; /* ลดขนาดฟอนต์ของลิงค์ */
            margin-top: 10px;
            color: #828282;
        }
        
        .create-account a {
            color: #910000;
            font-weight: bold;
            text-decoration: none;
        }
        
        .create-account a:hover {
            text-decoration: underline;
        }
        
        .error {
            color: red;
            font-size: 12px; /* ลดขนาดของข้อความผิดพลาด */
            margin-bottom: 10px;
        }

        /* Media Query สำหรับหน้าจอขนาดเล็ก */
        @media (max-width: 480px) {
            .login-container {
                padding: 20px;
                width: 90%;
            }

            .login-container h2 {
                font-size: 25px; /* ลดขนาดหัวข้อ */
            }

            .login-container img {
                width: 60px; /* ลดขนาดรูปภาพ */
            }

            .login-container input, .login-container button {
                font-size: 12px; /* ปรับขนาดฟอนต์ */
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="images/ghost.png" alt="Ghost Icon"> <!-- รูปภาพอยู่ข้างบนหัวข้อ -->
        <h2>Ghost Cool</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="">
            <p align="left" style="margin-bottom: 3px; font-size: 12px;">Username</p> <!-- ลดขนาดข้อความ -->
            <input type="text" name="username"  required>
            <p align="left" style="margin-bottom: 3px; font-size: 12px;">Email</p> <!-- ลดขนาดข้อความ -->
            <input type="email" name="email"  required>
            <p align="left" style="margin-bottom: 3px; font-size: 12px;">Password</p> <!-- ลดขนาดข้อความ -->
            <input type="password" name="password"  required>
            <p align="left" style="margin-bottom: 3px; font-size: 12px;">Confirm Password</p> <!-- ลดขนาดข้อความ -->
            <input type="password" name="confirm_password"  required>
            <br><br>
            <button type="submit">Register</button>
        </form>
        <br><br>
        <p class="create-account">Already Registered? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
