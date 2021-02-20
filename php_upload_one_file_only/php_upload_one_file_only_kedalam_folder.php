<?php  

$mysqli = new mysqli('localhost','root','','testing');

if(isset($_POST["submit"])) {
    $file = $_FILES['file'];
    
    $fileName =  $file['name'];
    $fileTmpName =  $file['tmp_name'];
    $fileSize =  $file['size'];
    $fileError =  $file['error'];
    $fileType =  $file['type'];

    $fileExt = explode('.', $fileName); //explode a.k.a pecahkan $fileName pada dot tu. so dia jadi array yg ada 2 element iaitu element nama file dan element file extension.
    $fileActualExt = strtolower(end($fileExt));
    $filenameBeforeExt = reset($fileExt); // reset() -- dapatkan element pertama

    $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xls', 'xlsx' );

    if (in_array($fileActualExt, $allowed)) {
        if($fileError === 0){
            //1million=1mb  10million=10mb
            if($fileSize <10000000){

                $fileNameNew = $filenameBeforeExt.".".uniqid('', false).".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                echo '<script> alert("file berjaya diupload") </script>';
                
            }else{
                echo 'your file is too big';
            }
        }else{
            echo "there was error uploading your file";
        }
    } else {
        echo "you cannot upload the files of this type";
    }

    $sql = "INSERT INTO gambar(attachment) VALUES (?)";
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
      }

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $fileNameNew);
    $stmt->execute();
}

?>


<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'> 
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Document</title>
</head>

<body>
    <form action="" method='POST' enctype='multipart/form-data'>
        <input type="file" name='file'>
        <button type='submit' name='submit'>upload</button>
    </form>     
</body>
</html>



