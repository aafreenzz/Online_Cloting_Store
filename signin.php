<?php
$message = "";
if(isset($_GET['message'])){
    $message = htmlspecialchars($_GET['message']);
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

<form action="users.php" method="post">
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
