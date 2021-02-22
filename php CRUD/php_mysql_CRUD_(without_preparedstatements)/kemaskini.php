<?php 

require_once 'core/init.php';

$mysqli = new mysqli("localhost", "root", "", "football");

?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>

<a href="index.php">Back</a>
<br><br><br>

<!-- #######################    DISPLAY ROWS IKUT id kat URL    (GET array)   ##############################-->
    <?php 
        $id = Input::get('id');

        $sql = "SELECT * FROM player WHERE id='$id'";
        $result = $mysqli->query($sql);
    ?>
    <br><br>
    <table>
        <thead>
        <tr>
            <th>Username</th>
            <th>Country</th>
            <th>Age</th>
        </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['username'];?></td>
            <td><?= $row['country'];?></td>
            <td><?= $row['age'];?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>

    <br><br><br>




    <!-- #######################    update form   ##############################-->

<?php 

// fetch row where id = value on get array, sot that the row values can be display on form input
if(isset($_GET["id"]  )) {
    $id=$_GET['id'];

    $sql = "SELECT * FROM player WHERE id='$id'";
    $result = $mysqli->query($sql);
    $row=$result->fetch_assoc();

  
    $username = $row['username'];
    $country = $row['country'];
    $age = $row['age'];

}


//update row 
if(isset($_POST["update"])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $country = $_POST['country'];
    $age = $_POST['age'];

 
    $sql = "UPDATE player SET username=?, country=?, age=? WHERE id=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssii", $username,$country,$age,$id);
    $stmt->execute();

    header("Refresh:0"); //refresh utk update table kat screen
}

if(isset($_POST["reset"]  )) {
    header("Refresh:0");
}


?>

    <div>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <div>
                <input type="text" name="username" value="<?= $username; ?>" required>
            </div>
            <div>
                <input type="text" name="country" value="<?= $country; ?>" required>
            </div>
            <div>
                <input type="text" name="age" value="<?= $age; ?>" required>
            </div>
            
            <div>
                <input type="submit" name="update" class="btn btn-success btn-block" value="update">
                <input type="submit" name="reset" class="btn btn-danger btn-block" value="reset">
            </div>
        </form>
    </div>       
    
    
    
    
    
</body>

</html>
