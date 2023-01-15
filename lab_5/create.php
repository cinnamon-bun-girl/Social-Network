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


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $conn = new mysqli("localhost", "root", "", "social_site");
        if($conn->connect_error){
            die("Ошибка: " . $conn->connect_error);
        }
        $name = $conn->real_escape_string($_POST["name"]);
        $birthday = $conn->real_escape_string($_POST["birthday"]);
        $city = $conn->real_escape_string($_POST["city"]);
        
        $sql = "INSERT INTO account (name, birthday, city) VALUES ('$name', '$birthday', '$city')";
        if($conn->query($sql)){
            echo "Данные успешно добавлены";
        } else{
            echo "Ошибка: " . $conn->error;
        }
        $conn->close();
    }

    
    ?>
    <form method="POST" action="create.php">
        ФИО: <input type="text" name="name" required /><br />
        День рождения: <input type="date" name="birthday" /><br />
        Город: <input type="text" name="city" /><br />
        
        <input type="submit" value="Сохранить" />
    </form>
</body>

</html>