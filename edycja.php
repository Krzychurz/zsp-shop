<!DOCTYPE html>
<html lang="pl">
    <head>  
        <meta charset="UTF-8">
        <title>Portal sklepowy</title>
        <?php
            session_start();
            $con = new mysqli("localhost","root","","mydb");
            $sql = "SELECT u.id as u_id, u.login, p.id as p_id, p.name, p.category, p.price, p.availability, sh.ammount  FROM `users` u JOIN shopping_history sh ON sh.users_id = u.id JOIN products p ON p.id = sh.products_id WHERE u.id =".$_SESSION['id'];
            $sql2 = "SELECT id, login FROM users";
            $res = $con->query($sql);
            $res2 = $con->query($sql2);
            $row = $res->fetch_all(MYSQLI_ASSOC);
            $row2 = $res2->fetch_all(MYSQLI_ASSOC);
        ?>
    </head>
    <body>
        <p>
            Zalogowano jako: <?php echo $_SESSION['login']?>
        </p>
        <?php
            echo "<table><tr><th>Nazwa</th><th>Kategoria</th><th>Cena</th><th>Ilość</th></tr></table>";
            for($i=0;$i<count($row);$i++)
            {
                echo "<form method='POST'>";
                echo "<input type='text' name='".$i."name' value='".$row[$i]['name']."'>";
                echo "<input type='text' name='".$i."category' value='".$row[$i]['category']."'>";
                echo "<input type='number' name='".$i."price' value='".$row[$i]['price']."'>";
                echo "<input type='number' name='".$i."ammount' value='".$row[$i]['ammount']."'>";
                echo "<br>";
                /*
                echo "<tr><td>".$row[$i]['name']."</td>";
                echo "<td>".$row[$i]['category']."</td>";
                echo "<td>".$row[$i]['price']."</td>";
                echo "<td>".$row[$i]['ammount']."</td></tr>";
                */

            }
            echo "<button type='submit'>Nadpisz</button>";
            echo "</form>";
            
            if()

            echo "<br>Dodaj ofertę:<br>";
            echo "<form>";
            echo "<input type='text' name='".$i."name'>";
            echo "<input type='text' name='".$i."category'>";
            echo "<input type='number' name='".$i."price'>";
            echo "<input type='number' name='".$i."ammount'>";
            echo "<br>";
            echo "<button type='submit'>Dodaj</button>";
            echo "</form>";
            $con->close();
        ?>
    </body>
</html>