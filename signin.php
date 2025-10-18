<?php
$message = "";
if(isset($_GET['message'])){
    $message = htmlspecialchars($_GET['message']);
}

// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if(isset($_POST['add'])){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    // Check if passwords match
    if($pass !== $confirm_pass){
        $message = "Passwords do not match!";
    } else {
        // Check if email or password already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $message = "Email already used!";
        } else {
            // Hash password
            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

            // Insert user into database
            $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $phone, $hashed_pass);

            if($stmt->execute()){
                // Redirect to cart.html after successful signup
                header("Location: cart.html");
                exit();
            } else {
                $message = "Error adding user!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up</title>
<style>
body { background-color: rgb(190,151,151); font-family: Arial,sans-serif; }
.form-container { background-color: rgb(200,200,192); border-radius: 20px; width: 300px; margin: 50px auto; padding: 30px; text-align: center; }
h1 { margin-bottom: 20px; }
input { width: 90%; padding: 10px; margin: 10px 0; border-radius: 10px; border: 1px solid #999; }
button { width: 95%; padding: 10px; margin: 10px 0; border: none; border-radius: 10px; cursor: pointer; font-size: 16px; background-color: rgb(188,153,153); color: white; }
.message { color: red; margin-bottom: 10px; }
</style>
</head>
<body>
<div class="form-container">
<h1>SIGN-UP HERE!</h1>

<?php if(!empty($message)) echo "<div class='message'>$message</div>"; ?>

<form action="" method="post">
    <input type="text" name="name" placeholder="Enter your name" required>
    <input type="email" name="email" placeholder="Enter your email" required>
    <input type="tel" name="phone" placeholder="Enter your phone number" required>
    <input type="password" name="password" placeholder="Enter your password" required>
    <input type="password" name="confirm_password" placeholder="Confirm your password" required>
    <button type="submit" name="add">Continue</button>
</form>
</div>
</body>
</html>
