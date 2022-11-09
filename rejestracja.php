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
            if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['password2']))
            {
                if($_POST['password'] == $_POST['password2'])
                    {
                        
                        $send = "INSERT INTO mydb('login','password',0) VALUES(".$_POST['login'].",".$_POST['password'].")";
                    }
                echo"<br>Niepoprawny login lub hasło";
            }
            $con->close();
        ?>
    </body>
</html>