<?php 

session_start();
// var_dump($_SESSION);

if(isset($_POST["superAdmin"])) {
        $_SESSION["username"] = "namasuperAdmin";
        $_SESSION["kodKategori"] = 1;
        $_SESSION["kodCawangan"] = "BG";
}

if(isset($_POST["admin"])) {
        $_SESSION["username"] = "namaAdmin";
        $_SESSION["kodKategori"] = 2;
        $_SESSION["kodCawangan"] = "IP";
}

if(isset($_POST["user"])) {
        $_SESSION["username"] = "namauser";
        $_SESSION["kodKategori"] = 3;
        $_SESSION["kodCawangan"] = "HQ";
}


if(isset($_POST["sessionDestroy"])) {
        session_destroy();
        header("Refresh:0");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <form action="" method="post">
        <input type="submit" name="superAdmin" value="superAdmin"></input>
        <input type="submit" name="admin" value="admin"></input>
        <input type="submit" name="user" value="user"></input>
        <input type="submit" name="sessionDestroy" value="sessionDestroy"></input>
    </form>
</body>
</html>

<?php 
var_dump($_SESSION);
?>
