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
</html>