<?php
if ($_GET['err'])
{
    $err = 'Incorrect login credentials, please try again.';
}
?>

<html>
    <head>
        <title>To-do List: Login</title>
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <meta charset="UTF-8">
    </head>
    <body>
        <header class="whiteonblue">
            <h1>A Web-Based To-do List</h1>
        </header>
        <h3 class="blueonwhite">
            Please login, or <a href="register.php" >create an account</a>
        </h3>

        <form class="blueonwhite" action="read.php" method="post">
            <table>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username"/></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Login" /></td>
                </tr>
            </table>
        </form>
        <font color="red"><?php echo $err; ?> </font>

        <footer class='whiteonblue'>
            Copyright © Matthew Jarvis, 2015
        </footer>
    </body>
</html>