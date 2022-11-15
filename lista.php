<!DOCTYPE html>
<html lang="pl">
    <head>  
        <meta charset="UTF-8">
        <title>Portal sklepowy</title>
        <?php
            session_start();
            $con = new mysqli("localhost","root","","mydb");
            $sql = "SELECT u.id, u.login, p.id, p.name, p.category, p.price, p.availability, sh.ammount  FROM `users` u JOIN shopping_history sh ON sh.users_id = u.id JOIN products p ON p.id = sh.products_id WHERE sh.users_id =".$_SESSION['id'];
            $res = $con->query($sql);
            $row = $res->fetch_all(MYSQLI_ASSOC);
        ?>
    </head>
    <body>
        <p>
            Zalogowano jako: <?php echo $row[$_SESSION['id']-1]['login'] ?>
        </p>
        
        <?php
            $con->close();
        ?>
    </body>
</html>