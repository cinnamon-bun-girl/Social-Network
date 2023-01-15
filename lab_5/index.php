<?php

$conn = new mysqli("localhost", "root", "", "social_site");
if($conn->connect_error){
    die("Ошибка: " . $conn->connect_error);
}

$userid = $conn->real_escape_string($_GET["id"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyPage</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
    
    <div class="container">
        <div class="top-nav-menu-container site-style">

            <ul>
                
                <li><a href="#">Профиль</a></li>
                <li><a href="#">Друзья</a></li>
                <li><a href="#">Сообщения</a></li>
                <li><a href="#">Сообщества</a></li>
                <li><a href="#">Новости</a></li>
                <li><a href="#">Фотографии</a></li>
                <li><a href="#">Музыка</a></li>
                <li><a href="#">Видео</a></li>
                <li><a href="log_out.php?id=<?= $userid ?>">Выйти</a></li>
            </ul>
            <div>
                
                <input placeholder="Search..">
            </div>

            <script>

                function menuDrop() {
                    document.getElementById("myDropdown").classList.toggle("show");
                }

                window.onclick = function (event) {
                    if (!event.target.matches('.dropbtn')) {

                        var dropdowns = document.getElementsByClassName("dropdown-content");
                        var i;
                        for (i = 0; i < dropdowns.length; i++) {
                            var openDropdown = dropdowns[i];
                            if (openDropdown.classList.contains('show')) {
                                openDropdown.classList.remove('show');
                            }
                        }
                    }
                }
            </script>

        </div>
        
        <div class="box-left">
             <div><a href="#">ФИО</a></div>
            <div><a href="#">День рождения</a></div>
            <div><a href="#">Город</a></div>
             <div><a href="#">Имя пользователя</a></div>
            <div><a href="#">Пароль</a></div>
             
        </div>

        <div class="profile site-style">
            
            <div class="profile-block">
                <div class="profile-ava"></div>
                <div class="profile-info">

                    <input type="hidden" value="<?= $id ?>" name="id"/>
                    <?php

                        $sql = "SELECT * FROM account WHERE id = '$userid'";

                        if($result = $conn->query($sql)){
                            foreach($result as $row){
                    ?>
                                <h2 class="name"><?= $row["name"] ?></h2>
                                
                               
                    <?php
                            }
                            $result->free();
                        } else{
                            echo "Ошибка: " . $conn->error;
                        }
                        $conn->close();
                    ?>

                </div>
                <div class="profile-edit site-style">
                    <a href="update.php?id=<?= $id ?>" class="site-style-mini">Edit</a>
                    
                </div>
            </div>
        </div>

        
    </div>

</body>
</html>