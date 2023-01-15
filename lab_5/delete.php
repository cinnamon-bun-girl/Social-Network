<?php


$conn = new mysqli("localhost", "root", "", "social_site");
        if($conn->connect_error){
            die("Ошибка: " . $conn->connect_error);
        }

$id = $_POST['id'];        
$sql = "DELETE FROM account WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
  echo "Запись успешно удалена";
} else {
  echo "Ошибка при удалении записи: " . mysqli_error($conn);
}

mysqli_close($conn);
?>