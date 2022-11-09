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
            <button type="submit">
                Zatwierdź
            </button>
        </form>
        <?php
            if(isset($_POST['login']) && isset($_POST['password']))
                while($row=$res->fetch_assoc())
                {
                    if($_POST['login'] == $row['login'])
                    {
                        if($_POST['password'] == $row['password'])
                        header("Location: test.html");
                    }
                }
            $con->close();
        ?>
    </body>
</html>