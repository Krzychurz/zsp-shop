<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Portal sklepowy</title>
        <?php
            session_start();
            $con = new mysqli("localhost","root","","mydb");
        ?>
</head>
<body>
    <table>
        <tr>
            <th>Nazwa</th><th>Cena</th>
        </tr>
    </table>
    <form method="POST">
        <input type="text" name='x'>
        <input type="number" name='y'>
        <button type="submit">Zatwierdź</button>
    </form>
    <?php
        if(isset($_POST['x']) && isset($_POST['y']))
            if($_POST['x'] != NULL && $_POST['y'] != NULL)
            {
                $sql = "INSERT INTO list (user_id,name,price,state) VALUES (".$_SESSION['id'].",'".$_POST['x']."',".$_POST['y'].",-1)";
                $con->query($sql);
                header("Location: lista.php");
            }
        $con->close();
    ?>
</body>
</html>