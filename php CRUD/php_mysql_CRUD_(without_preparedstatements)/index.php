<?php 

require_once 'core/init.php';

$mysqli = new mysqli("localhost", "root", "", "football");


// #######################    INSERT DATA INTO TABLE    ############################## //
if(Input::get('submit')){
    $username = Input::get('username');
    $country = Input::get('country');
    $age = Input::get('age');

    $sql = "INSERT INTO player(username, country, age) VALUES ('$username', '$country', '$age')";
    $mysqli->query($sql);
}
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

<!-- #######################   FORM    ##############################-->
insert data into table player
    <form action="" method="post">
        <ul>
                <label>Username</label>
                <input type="text" name="username"> <br>
                <label>Country &nbsp &nbsp</label>
                <input type="text" name="country"> <br>
                <label>Age &nbsp &nbsp &nbsp &nbsp &nbsp</label>
                <input type="text" name="age"> <br>
                <input type="submit" name="submit" value="submit"></input>
        </ul>
    </form>



<!-- #######################    DISPLAY ALL ROWS ON THE TABLE    ##############################-->
    <?php 
        $sql = "SELECT * FROM player";
        $result = $mysqli->query($sql);
    ?>
    <br><br>
    SELECT * FROM player
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


<!-- #######################    DISPLAY ROWS IKUT COLUMN VALUE    ##############################-->
    <?php 
        $sql = "SELECT * FROM player WHERE country='Argentina'";
        $result = $mysqli->query($sql);
    ?>
    <br><br>
    SELECT * FROM player WHERE country='Argentina'
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




    <!-- #######################   UPDATE DATA   ##############################-->


    <!-- display data dulu -->
    <?php 
        $sql = "SELECT * FROM player";
        $result = $mysqli->query($sql);
    ?>
    <br><br>
    SELECT * FROM player
    <table>
        <thead>
        <tr>
            <th>Username</th>
            <th>Country</th>
            <th>Age</th>
            <th>Update</th>
        </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['username'];?></td>
            <td><?= $row['country'];?></td>
            <td><?= $row['age'];?></td>
            <td><a href="kemaskini.php?id=<?= $row['id'];?>">Update</a></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    
    <!-- #######################   DELETE ROW  ##############################-->
    <?php 
        $sql = "SELECT * FROM player";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    ?>
    <br><br>
    <table>
        <thead>
        <tr>
            <th>Username</th>
            <th>Country</th>
            <th>Age</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['username'];?></td>
            <td><?= $row['country'];?></td>
            <td><?= $row['age'];?></td>
            <td><a onClick="javascript: return confirm('u shure want to delete meh?');" href="index.php?id=<?= $row['id'];?>">Delete</a></td>
        </tr>
        <?php } ?>

        <?php 
            if(Input::get('id')){
                $sql = "DELETE FROM player WHERE id = ?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param('i', $id);
                $id = Input::get('id');
                $stmt->execute();
                
                echo "<script>alert('Berjaya delete data!');</script>"; 
                echo "<script>location='index.php';</script>";  //pakai ni utk refresh page sebab takleh pakai Redirect::to(index)  //refresh utk update table kat screen
                
                   
     
                                
                }
            
        ?>



        </tbody>
    </table>

    

    
    
    
</body>

</html>