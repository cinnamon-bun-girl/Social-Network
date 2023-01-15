<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    $conn = new mysqli("localhost", "root", "", "social_site");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
    }

    if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])){

        $userid = $conn->real_escape_string($_GET["id"]);
        $sql = "SELECT * FROM account WHERE id = '$userid'";
        if($result = $conn->query($sql)){
            if($result->num_rows > 0){
                foreach($result as $row){
                    $name = $row["name"];
                    $birthday = $row["birthday"];
                    $city  = $row["city"];
                   
                    echo "<td><form action='delete.php' method='post'>
                    <input type='hidden' name='id' value='" . $row["id"] . "' />
                    <input type='submit' value='Удалить'>
                    </form></td>";
            
                }
            }
            else{
                echo "<div>Пользователь не найден</div>";
            }
            $result->free();
        } else{
            echo "Ошибка: " . $conn->error;
        }
    }
    elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        $userid = $conn->real_escape_string($_POST["id"]);
        $name = $conn->real_escape_string($_POST["name"]);
        $birthday = $conn->real_escape_string($_POST["birthday"]);
        $city  = $conn->real_escape_string($_POST["city"]);
       
        $sql = "UPDATE account SET name = '$name', birthday = '$birthday', city = '$city' WHERE id = '$userid'";
        if($result = $conn->query($sql)){
            header("Location: update.php");
        } else{
            echo "Ошибка: " . $conn->error;
        }
    }
    else {
        echo "Некорректные данные";
    }
    $conn->close();

    
    ?>

    <form method="POST" action="update.php?id=<?= $userid ?>">
        ФИО: <input type="text" name="name" required value="<?= $name ?>" /><br />
        День рождения: <input type="text" name="birthday" value="<?= $birthday ?>"/><br />
        Город: <input type="text" name="city" value="<?= $city ?>" /><br />
        
        <input type="hidden" value="<?= $userid ?>" name="id"/>
        <input type="submit" value="Сохранить" />
    </form>
</body>

</html>