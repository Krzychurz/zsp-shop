<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Portal sklepowy</title>
        <?php
            $con = new mysqli("localhost","root","","mydb");
            $sql = "SELECT login, password, is_admin FROM users";
            $res = $con->query($sql);
        ?>
    </head>
    <body>
        <form method="POST">
            Login:
            <input type="text" name="login">
            <br>
            Hasło:
            <input type="password" name="password">
            <br>
            Podaj hasło ponownie:
            <input type="password" name="password2">
            <br>
            <button type="submit">
                Zatwierdź
            </button>
            <br>
        </form>
        <form action="index.php" method="POST">
            <button type="submit">
                Powróć do ekranu logowania
            </button>
        </form>
        <?php
            $x=0;
            if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['password2']))
            {
                while($row=$res->fetch_assoc())
                {
                    if($_POST['login'] == $row['login'])
                    {
                        $x=1;
                        echo"<br>Konto już istnieje";
                    }
                }
                if($_POST['password'] == $_POST['password2'] && $x==0 && strlen($_POST['login'])>0)
                    {
                        $login=$_POST['login'];
                        $haslo=$_POST['password'];
                        $send = "INSERT INTO `users` (`id`, `login`, `password`, `is_admin`) VALUES (NULL, '$login', '$haslo', '0');";
                        $con->query($send);
                    }
                else
                {
                    echo"<br>Podaj odpowiednie dane";
                }
            
            }
            $con->close();
        ?>
    </body>
</html>