<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method='post'>
            username<input type="text" name="username" required>
            email<input type="text" name="email" required>
            password<input type="password" name="password" required>
            <input type="submit" name="submit" value="Submit"></input>
    </form>
</body>
</html>

<?php 
if(isset($_POST["submit"])) {
    extract($_REQUEST);
    $file = fopen("userDetail.txt", "a");

    fwrite($file,"name: ");
    fwrite($file, $username ."\n");
    fwrite($file,"Email: ");
    fwrite($file,$email."\n");
    fwrite($file,"password: ");
    fwrite($file,$password."\n");
    fclose($file);
}
   
?> 