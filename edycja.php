<!DOCTYPE html>
<html lang="pl">
    <head>  
        <meta charset="UTF-8">
        <title>Portal sklepowy</title>
        <?php
            session_start();
            $con = new mysqli("localhost","root","","mydb");
            $sql = "SELECT l.id AS l_id, u.id AS u_id, u.login, l.name, l.price, l.state FROM list l JOIN users u ON u.id = l.users_id WHERE u.id =".$_SESSION['id'];
            $res = $con->query($sql);
            $row = $res->fetch_all(MYSQLI_ASSOC);
        ?>
    </head>
    <body>
        <p>
            Zalogowano jako: <?php echo $_SESSION['login']?>
        </p>
        <?php
            echo "<table><tr><th>Nazwa</th><th>Cena</th></tr></table>";
            $i=0;
            while($i<count($row))
            {
                echo "<form method='POST'>";
                echo "<input type='hidden' name='".$i."up_id' value='".$row[$i]['l_id']."'>";
                echo "<input type='text' name='".$i."name' value='".$row[$i]['name']."'>";
                echo "<input type='number' name='".$i."price' value='".$row[$i]['price']."'>";
                echo "<input type='hidden' name='".$i."state' value='".$row[$i]['state']."'>";
                echo "<br>";
                /*
                echo "<tr><td>".$row[$i]['name']."</td>";
                echo "<td>".$row[$i]['category']."</td>";
                echo "<td>".$row[$i]['price']."</td>";
                echo "<td>".$row[$i]['ammount']."</td></tr>";
                */               
                $i++;
            }
            //echo $_POST[$x.'name'];
            echo "<br>";
            echo "<button type='submit'>Nadpisz</button>";
            echo "</form>";
            for($k=0;$k<$i;$k++)
            {
                if(isset($_POST[$k.'up_id']))
                {
                    if($_POST[$k.'name']!=$row[$k]['name'] || $_POST[$k.'price']!=$row[$k]['price'])
                        header("refresh: 0");
                    for($j=0;$j<$i;$j++)
                    {
                        $write = "UPDATE list l SET name ='".$_POST[$j.'name']."', price = '".$_POST[$j.'price']."' WHERE l.id =".$_POST[$j.'up_id'];
                        //$write = "UPDATE products p SET name='".$_POST[$j.'name']."' price=".$_POST[$j.'price']." WHERE l.id = 1";
                        //$write = "UPDATE products p SET name='".$_POST[$j.'name']."', category='".$_POST[$j.'category']."', price='".$_POST[$j.'price']."', ammount='".$_POST[$j.'ammount']."' WHERE p.id = '".$_POST[$j.'up_id']."'";
                        $con->query($write);
                    }
                    
                }
            }
            /*
            echo "<br>Dodaj ofertę:<br>";
            echo "<form>";
            echo "<input type='text' name='".$i."name'>";
            echo "<input type='text' name='".$i."category'>";
            echo "<input type='number' name='".$i."price'>";
            echo "<input type='number' name='".$i."ammount'>";
            echo "<br>";
            echo "<button type='submit'>Dodaj</button>";
            echo "</form>";
            */
            $con->close();
        ?>
    </body>
</html>