<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Portal sklepowy</title>
        <?php
            $con = new mysqli("localhost","root","","mydb");
            $sql = "SELECT id, login, password, is_admin FROM users";
            $res = $con->query($sql);
            session_start();
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
            <button type="submit">
                Zatwierdź
            </button>
            <br>
        </form>
        <form action="rejestracja.php" method="POST">
            <button type="submit">
                Stwórz konto
            </button>
        </form>
        <?php
            if(isset($_POST['login']) && isset($_POST['password']))
                {
                    while($row=$res->fetch_assoc())
                        {
                            if($_POST['login'] == $row['login'])
                            {
                                if($_POST['password'] == $row['password'])
                                {
                                    $_SESSION['id']=$row['id'];
                                    $_POST = array();
                                    header("Location: lista.php");
                                }
                            }
                        }
                    echo"<br>Niepoprawny login lub hasło";
                }
            $con->close();
        ?>
    </body>
</html>