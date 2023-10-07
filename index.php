<?php

require_once 'registration.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h2>User Registration</h2>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $username; ?>"><br>
        <p style="color: red;"><?php echo $errors['username']; ?></p>
        
        <label for="password">Password:</label>
        <input type="password" name="password"><br>
        <p style="color: red;"><?php echo $errors['password']; ?></p>
        
        <input type="submit" value="Register">
    </form>
</body>
</html>