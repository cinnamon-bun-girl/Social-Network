<?php

$xml = simplexml_load_file("data.xml") or die("Error: Cannot create object");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css?v1" />
</head>

<body>
    <div class="container">
        <?php

        foreach ($xml->children() as $item) {
        // print_r($item);
        ?>
            <div class="task-card">
                <span class="task-card-fio"><?= $item->fio ?></span>
                <span class="task-card-birthday"><?= $item['birthday'] ?></span>
                <span class="task-card-city"><?= $item->city ?></span>
                <a href="delete.php?id=<?= $item['id']?>">Удалить</a>
            </div>
        <?php
        }

        ?>
       
    </div>
</body>

</html>