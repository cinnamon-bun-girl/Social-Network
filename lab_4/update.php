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
    $id = 0;
    $fio = '';
    $birthday = '';
    $city = '';
    

    $xml = simplexml_load_file("data.xml") or die("Error: Cannot create object");

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $id = $_GET['id'];

        foreach ($xml->item as $item) {
            if ($item['id'] == $id) {
                $fio = $item->fio;
                $birthday = $item['birthday'];
                $city = $item->city;
                $node = $item;
                break;
            }
        }
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        foreach ($xml->item as $item) {
            if ($item['id'] == $id) {
                $item->fio = $_POST['fio'];
                $item['birthday'] = $_POST['birthday'];
                $item->city = $_POST['city'];
                break;
            }
        }
        $xml->saveXML('data.xml');
    }
    ?>

    <form method="POST" action="update.php?id=<?= $id ?>">
        ФИО: <input type="text" name="fio" required value="<?= $fio ?>" /><br />
        День рождения: <input type="date" name="birthday" value="<?php $birthday ?>" /><br />
        Город: <input type="text" name="city" required value="<?= $city ?>" /><br />
        <input type="hidden" value="<?= $id ?>" name="id"/>
        <input type="submit" value="Сохранить" />
    </form>
</body>

</html>