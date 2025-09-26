<?php
session_start();

// Hardcoded credentials (for demo)
$USERNAME = "admin";
$PASSWORD = "admin";
$error = "";

// Handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: index.php");
    exit;
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    if ($user === $USERNAME && $pass === $PASSWORD) {
        $_SESSION['logged_in'] = true;

        // Redirect after login to prevent form resubmission
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}

// Check if user is logged in
$loggedIn = !empty($_SESSION['logged_in']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $loggedIn ? "Admin Dashboard" : "Login" ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #1e1e2f;
            color: #f0f0f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        h1 { color: #ff6b6b; margin-bottom: 10px; text-align: center; }
        p { color: #ccc; margin-bottom: 20px; text-align: center; }
        .box {
            background: #2c2c3c;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.5);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }
        input[type=text], input[type=password] {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: none;
        }
        button {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            background: #ff6b6b;
            color: #fff;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover { background: #ff4b4b; }
        .error { color: #ff4b4b; margin-bottom: 15px; }
        footer { position: absolute; bottom: 15px; font-size: 0.9em; color: #888; }
    </style>
</head>
<body>

<?php if (!$loggedIn): ?>
    <div class="box">
        <h1>Admin Login</h1>
        <p>Please enter your credentials to access the server administration panel.</p>
        <?php if ($error) echo "<div class='error'>$error</div>"; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
    </div>
<?php else: ?>
    <div class="box">
        <h1>Admin Dashboard</h1>
        <p>Welcome, Admin! This page is for server administration.</p>
        <a href="?action=logout"><button>Logout</button></a>
    </div>
<?php endif; ?>

<footer>
    &copy; <?= date('Y') ?> Server Administration
</footer>

</body>
</html>
