<!DOCTYPE html>
<html lang="pl">
    <head>  
        <meta charset="UTF-8">
        <title>Portal sklepowy</title>
        <?php
            session_start();
            $con = new mysqli("localhost","root","","mydb");
            $sql = "SELECT id, users_id AS u_id, name, price, state FROM list";
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
        <form method="GET">
            Oferty użytkownika:
            <select name='konto' onchange='this.form.submit()'>
                <?php
                    for($i=0;$i<count($row2);$i++)
                    {
                        if(!isset($_GET['konto']))
                            $_GET['konto']=$_SESSION['id'];
                        if($_GET['konto']==$row2[$i]['id'])
                            echo "<option name='konto' value=".$row2[$i]['id']."> ".$row2[$i]['login']." </option>";
                    }
                    for($i=0;$i<count($row2);$i++)
                    {
                        if($_GET['konto']==$row2[$i]['id'])
                            continue;
                        echo "<option name='konto' value=".$row2[$i]['id']."> ".$row2[$i]['login']." </option>";
                    }
                ?>
            </select>
        </form>
        <p>
            <?php
                $spr=1;
                for($i=0;$i<count($row);$i++)
                {
                    if($_GET['konto']==$row[$i]['u_id'] && $row[$i]['state'] < 0)
                    {
                        if($spr==1)
                        {
                            echo "<table><tr><th>Nazwa</th><th>Cena</th></tr>";
                            $spr=0;
                        }
                        echo "<tr><td>".$row[$i]['name']."</td>";
                        echo "<td>".$row[$i]['price']."</td>";
                    }
                    elseif($i==count($row)-1 && $spr==1)
                    {
                        echo " brak";
                        break;
                    }
                }
                echo "</table>";
                if($_GET['konto']==$_SESSION['id'])
                {
                    echo "<form action='edycja.php' method='POST'>";
                    echo "<input type='hidden' name='edycja' value=1>";
                    echo "<button type='submit'>Edytuj</button>";
                    echo "</form>";
                }
                
                /*
                echo "<br>Kupno:";
                $spr=1;
                for($i=0;$i<count($row);$i++)
                {
                    if($row[$i]['ammount'] < 0)
                    {
                        if($spr==1)
                        {
                            echo "<table><tr><th>Nazwa</th><th>Kategoria</th><th>Cena</th><th>Ilość</th></tr>";
                            $spr=0;
                        }
                        echo "<tr><td>".$row[$i]['name']."</td>";
                        echo "<td>".$row[$i]['category']."</td>";
                        echo "<td>".$row[$i]['price']."</td>";
                        echo "<td>".$row[$i]['ammount']*(-1)."</td></tr>";
                    }
                    else
                        echo " brak";
                }
                */
                $con->close();
            ?>
        </p>
    </body>
</html>