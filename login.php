<?php
session_start();
session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ghost Cool</title>
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

        .rememberme{
            color: #828282;
        }

        .rememberme input{
            margin-left: -180px;
            margin-top: 2px;
        }

        .rememberme label{
            margin-left: -180px;
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
        <img src="images/ghost.png" alt="Ghost Icon">
        <h2>Ghost Cool</h2>

        <?php if (isset($_SESSION['error'])): ?>
    <p class='error'><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
<?php endif; ?>

        <form action="checkuser.php" method="post">
            <p align="left" style="margin-bottom: 3px; font-size: 12px;">Username</p>
            <input type="text" name="Username" required>

            <p align="left" style="margin-bottom: 3px; font-size: 12px;">Password</p>
            <input type="password" name="Password" required>
            
            

            <br><br>
            <button type="submit">Login</button>
        </form>

        <br><br>
        <p class="create-account">Not Registered Yet? <a href="register.php">Create an account</a></p>
    </div>
</body>
</html>
