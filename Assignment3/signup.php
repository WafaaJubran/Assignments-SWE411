<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">

    <script>
    function validateForm(event) {
        let username = document.getElementById("username").value.trim();
        let email = document.getElementById("email").value.trim();
        let password = document.getElementById("password").value.trim();
        let error = "";

        if (username === "") {
            error += "Username is required.<br>";
        } else if (!/^[A-Za-z0-9]+$/.test(username)) {
            error += "Username must contain only letters and numbers.<br>";
        } else if (username.length < 8) {
            error += "Username must be at least 8 characters long.<br>";
        }

        if (email === "") {
            error += "Email is required.<br>";
        } else if (!/^\S+@\S+\.\S+$/.test(email)) {
            error += "Invalid email format.<br>";
        }

        if (password === "") {
            error += "Password is required.<br>";
        } else {
            let hasLetter = /[A-Za-z]/.test(password);
            let hasNumber = /[0-9]/.test(password);
            let hasSpecial = /[^A-Za-z0-9]/.test(password);

            if (password.length < 8) {
                error += "Password must be at least 8 characters long.<br>";
            }
            if (!hasLetter || !hasNumber || !hasSpecial) {
                error += "Password must include at least one letter, one number, and one special character.<br>";
            }
        }

        if (error !== "") {
            event.preventDefault();
            document.querySelector(".error").innerHTML = error;
            document.querySelector(".error").style.color = "red";
        }
    }
    </script>
</head>

<body>

<?php
$isValid = true;
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email    = $_POST["email"];
    $password = $_POST["password"];
    $remember = $_POST["remember"] ?? "";

    if (empty($username)) {
        $error .= "<br>Username is required.";
        $isValid = false;
    } elseif (!preg_match("/^[A-Za-z0-9]+$/", $username)) {
        $error .= "<br>Only letters and numbers allowed in username.";
        $isValid = false;
    } elseif (strlen($username) < 8) {
        $error .= "<br>Username should be at least 8 characters long.";
        $isValid = false;
    }

    if (empty($email)) {
        $error .= "<br>Email is required.";
        $isValid = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "<br>Invalid email format.";
        $isValid = false;
    }

    $letters     = preg_match('@[a-zA-Z]@', $password);
    $nums        = preg_match('@[0-9]@', $password);
    $specialchars = preg_match('@[^\w]@', $password);

    if (empty($password)) {
        $error .= "<br>Password is required.";
        $isValid = false;
    } elseif (!$letters || !$nums || !$specialchars) {
        $error .= "<br>Password must contain at least one letter, one number, and one special character.";
        $isValid = false;
    } elseif (strlen($password) < 8) {
        $error .= "<br>Password should be at least 8 characters long.";
        $isValid = false;
    }

    if ($isValid) {
        $_SESSION['username'] = $username;
        $_SESSION['email']    = $email;
        $_SESSION['password'] = $password;
        $_SESSION['remember'] = $remember;

        header("Location: welcome.php");
        exit();
    }
}
?>

<h1>&nbsp;&nbsp;&nbsp;SIGN UP</h1>

<form action="signup.php" method="post" onsubmit="validateForm(event)">
    <p class="error"><?php echo $error; ?></p>

    <label for="username">Username</label><br>
    <input type="text" id="username" name="username"><br>

    <label for="email">E-mail</label><br>
    <input type="text" id="email" name="email"><br>

    <label for="password">Password</label><br>
    <input type="password" id="password" name="password"><br><br>

    <input type="submit" value="SIGN UP"><br><br>

    <input type="checkbox" id="remember" name="remember" value="checked" checked>
    <label for="remember">Remember me</label>
    <a href="#">Forgot password?</a>
</form>

</body>
</html>
