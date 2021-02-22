<?php 
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

<!-- #######################    DISPLAY ALL ROWS in TABLE player   ##############################-->
    <?php 
        $sql = "SELECT * FROM player";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    ?>
    <br><br>
    <table>
    <caption>player</caption>
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


    <!-- #######################    DISPLAY ALL ROWS in TABLE manager   ##############################-->
    <?php 
        $sql = "SELECT * FROM manager";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    ?>
    <br><br>
    <table>
    <caption>manager</caption>
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
        $sql = "SELECT * FROM player WHERE country=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $country);
        $country = "Argentina";
        $stmt->execute();
        $result=$stmt->get_result();
    ?>
    <br><br>

    <table>
    SELECT * FROM player WHERE country=argentina
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

    <!-- #######################    DISPLAY ROWS IKUT COLUMN VALUE. DISTINCT a.k.a no repetition   ##############################-->
    <?php 
        $sql = "SELECT DISTINCT country FROM player";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $result=$stmt->get_result();
    ?>
    <br><br>

    <table>
    SELECT DISTINCT country FROM player //no repetition
        <thead>
        <tr>
            <th>Country</th>
        </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['country'];?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>

    <!-- #######################    Combine ALL row from table player and manager   ##############################-->
    <?php 
        $sql = "SELECT id, username, country, age FROM player  
                UNION
                SELECT * FROM manager  
                ORDER BY country";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    ?>
    <br><br>
    <table>
    
    SELECT id, username, country, age FROM player UNION SELECT * FROM manager //select all row from table player and manager
    <br>
    //if number of column & column name sama kat dua2 table boleh buat gini:  SELECT * FROM player UNION SELECT * FROM manager 
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

     <!-- #######################    Combine ALL row from table player and manager. LIMIT 5   ##############################-->
     <?php 
        $sql = "SELECT id, username, country, age FROM player   
                UNION
                SELECT * FROM manager  
                ORDER BY country
                LIMIT 5";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    ?>
    <br><br>
    <table>
    
    SELECT id, username, country, age FROM player  UNION SELECT * FROM manager LIMIT 5
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

    <!-- #######################    combine ALL country from table player and manager. DISTINCT, no repetition   ##############################-->
    <?php 
        $sql = "SELECT country FROM player 
                UNION 
                SELECT country FROM manager  
                ORDER BY country";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    ?>
    <br><br>
    <table>
    
    SELECT country FROM player UNION SELECT country FROM manager //select all country from table player and manager. no repetition
        <thead>
        <tr>
            <th>Country</th>
        </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['country'];?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>

    <!-- #######################    combine ALL country from table player and manager. Ada repetition   ##############################-->
    <?php 
        $sql = "SELECT country FROM player 
                UNION ALL
                SELECT country FROM manager  
                ORDER BY country";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    ?>
    <br><br>
    <table>
    
    SELECT country FROM player UNION ALL SELECT country FROM manager //select all country from table player and manager. ada repetition
        <thead>
        <tr>
            <th>Country</th>
        </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['country'];?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>

<!-- #######################    DISPLAY ALL ROWS in TABLE player. WHERE username start with m   ##############################-->
<?php 
        $sql = " SELECT * FROM player WHERE username LIKE 'm%' ";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    ?>
    <br><br>
    <table>
    SELECT * FROM player WHERE username LIKE 'm%'   //username start with m
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

<!-- #######################    DISPLAY ALL ROWS in TABLE player.  WHERE username end with o  ##############################-->
<?php 
        $sql = " SELECT * FROM player WHERE username LIKE '%O' ";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    ?>
    <br><br>
    <table>
    SELECT * FROM player WHERE username LIKE '%O'   //username end with O
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

<!-- #######################    DISPLAY ALL ROWS in TABLE player.  WHERE username ada huruf u  ##############################-->
<?php 
        $sql = " SELECT * FROM player WHERE username LIKE '%u%' ";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    ?>
    <br><br>
    <table>
    SELECT * FROM player WHERE username LIKE '%u%'   //username ada huruf u in any position
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

<!-- #######################    DISPLAY ALL ROWS in TABLE player.  WHERE username ada huruf gu  ##############################-->
<?php 
        $sql = " SELECT * FROM manager WHERE username LIKE '%gu%' ";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    ?>
    <br><br>
    <table>
    SELECT * FROM manager WHERE username LIKE '%gu%'   //username ada huruf gu in any position
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
  
<!-- #######################    DISPLAY username from table player and salary from table salary  ##############################-->
<?php 
        $sql = " SELECT player.username, salary.salary
                 FROM player
                 INNER JOIN salary 
                 ON player.playerID = salary.playerID ";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    ?>
    <br><br>
    <table>
    SELECT player.username, salary.salary FROM player INNER JOIN salary ON player.playerID = salary.playerID  
    <br>
    //INNER JOIN: select data from 2 table berpandukan 1 column sama yg ada kat kedua2 table    
        <thead>
        <tr>
            <th>Username</th>
            <th>Salary</th>
        </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['username'];?></td>
            <td><?= $row['salary'];?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    
    
    
</body>

</html>