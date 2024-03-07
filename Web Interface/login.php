<?php
session_start();

// Define a simple array for user validation
$valid_credentials = [
    'employee1' => '12345',
    'employee2' => '67890',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeName = $_POST['employeeName'] ?? '';
    $employeeId = $_POST['employeeId'] ?? '';

    // Check if credentials are valid
    if (isset($valid_credentials[$employeeName]) && $valid_credentials[$employeeName] == $employeeId) {
        $_SESSION['employeeName'] = $employeeName;
        $_SESSION['employeeId'] = $employeeId;
        header('Location: index.php'); 
        exit;
    } else {
        $error = 'Invalid credentials!';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f2f5;
            text-align: center;
            padding-top: 50px;
        }
        .login-form {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            display: inline-block;
        }
        .logo {
            background-image: url('JMPLogo2.jpeg');
            background-size: contain;
            background-repeat: no-repeat;
            height: 160px; 
            width: 160px;
            margin: 0 auto 30px auto;
            margin-bottom: 0px;
} 
        input[type="text"], input[type="password"] {
            margin-bottom: 20px;
            padding: 15px;
            border: none;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
            transition: box-shadow 0.3s;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            outline: none;
            box-shadow: 0 0 0 2px #0056b3;
        }
        input[type="submit"] {
            padding: 15px 30px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #004099;
        }
        .error {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <div class="logo"></div>
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="" method="post">
            <input type="text" name="employeeName" placeholder="Employee Name" required><br>
            <input type="password" name="employeeId" placeholder="Employee ID" required><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>