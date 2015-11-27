<?php
include 'inc/database_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if ($_POST['password'] == $_POST['confirm_password'])
    {
        try
        {
            $sql = "INSERT INTO user (username, password, first_name, last_name, dob)";
            $sql .= " VALUES (:username, :password, :first_name, :last_name, :dob)";
            $stmnt = $dbconn->prepare($sql);
            $params = array(
                ':username' => $_POST['username'],
                ':password' => $_POST['password'],
                ':first_name' => $_POST['firstname'],
                ':last_name' => $_POST['lastname'],
                ':dob' => $_POST['dob']
            );
            if ($stmnt->execute($params))
            {
                $user_id = $dbconn->lastInsertId();
                $url = 'http://localhost:8888/todo-list/read.php';
                header('Location: ' . $url . '?user_id=' . $user_id);
            } else
            {
                die('Unable to create user.');
            }
        } catch (PDOException $e)
        {
            die('Error: ' . $e->getMessage());
        }
    } else
    {
        $err = 'Passwords did not match, please try again.';
    }
}
?>
<html>
    <head>
        <title>To-do List: Register</title>
        <link href = "css/style.css" rel = "stylesheet" type = "text/css">
        <meta charset = "UTF-8">
    </head>
    <body>
        <header class = "whiteonblue">
            <h1>A Web-Based To-do List</h1>
        </header>
        <h3 class = "blueonwhite">Please register</h3>
        <form class = "blueonwhite" action = "register.php" method = "post">
            <table class = "blueonwhite">
                <tr>
                    <td>First name: </td>
                    <td><input type = "text" name = "firstname" maxlength = "45"/>*</td>
                </tr>
                <tr>
                    <td>Last name: </td>
                    <td><input type = "text" name = "lastname" maxlength = "45"/>*</td>
                </tr>
                <tr>
                    <td>Date of birth: </td>
                    <td><input type = "date" name = "dob" max = "<?php echo date('Y-m-d'); ?>"/>(YYYY-mm-dd)</td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type = "text" name = "username" maxlength = "45"/>*</td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type = "password" name = "password" maxlength = "45"/>*</td>
                </tr>
                <tr>
                    <td>Confirm password: </td>
                    <td><input type = "password" name = "confirm_password" maxlength = "45"/>*</td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type = "submit" value = "Register" /></td>
                </tr>
            </table>
        </form>
        <font color = "red"><?php echo $err; ?>
        </font>

        <footer class = 'whiteonblue'>
            Copyright © Matthew Jarvis, 2015
        </footer>
    </body>
</html>    