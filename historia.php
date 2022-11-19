<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Portal sklepowy</title>
        <?php
            session_start();
            $con = new mysqli("localhost","root","","mydb");
            $sql = "SELECT l.id AS l_id, u.id AS u_id, u.login, l.name, l.price, l.state FROM list l JOIN users u ON u.id = l.user_id WHERE l.state =".$_SESSION['id'];
            $res = $con->query($sql);
            $row = $res->fetch_all(MYSQLI_ASSOC);
        ?>
</head>
<body>
    <?php
        $spr=1;
        for($i=0;$i<count($row);$i++)
        {
            if($spr==1)
            {
                echo "<table><tr><th>Od</th><th>Nazwa</th><th>Cena</th></tr>";
                $spr=0;
            }
            echo "<tr><td>".$row[$i]['login']."</td>";
            echo "<td>".$row[$i]['name']."</td>";
            echo "<td>".$row[$i]['price']."</td>";
        }
        if($spr==1)
        {
            echo "brak zakupów";
        }
        echo "</table>";
        $con->close();
    ?>
</body>
</html>