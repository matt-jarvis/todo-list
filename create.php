<?php
include 'inc/database_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    try
    {
        $sql = "INSERT INTO item (user_id, title, description)";
        $sql .= " VALUES (:user, :title, :desc)";
        $stmnt = $dbconn->prepare($sql);
        $params = array(
            ':user' => $_POST['user_id'],
            ':title' => $_POST['title'],
            ':desc' => $_POST['desc']
        );
        if ($stmnt->execute($params))
        {
            $url = 'http://localhost:8888/todo-list/read.php';
            header('Location: ' . $url . '?user_id=' . $_POST['user_id']);
        } else
        {
            die('Unable to create item.');
        }
    } catch (PDOException $e)
    {
        die('Error: ' . $e->getMessage());
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    ?>
    <!DOCTYPE HTML>
    <html>
        <head>
            <title>To-do List: Create new</title>
            <link href="css/style.css" rel="stylesheet" type="text/css">
            <meta charset="UTF-8">
        </head>
        <body>
            <header class='whiteonblue'>
                <h1>Create new item</h1>
            </header>

            <form action='create.php' method='post'>
                <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>"/>
                <table>
                    <tr>
                        <td>Title: </td> 
                        <td><input type="text" name="title" maxlength="45"/></td>
                    </tr>
                    <tr>
                        <td>Description: </td>
                        <td><textarea name="desc" rows="6" cols="25" maxlength="100"></textarea></td>
                    </tr>
                    <tr> 
                        <td></td>
                        <td><input type='submit' value='Create'/></td>
                    </tr>
                </table>  
            </form>
            <?php
        }
        ?>
        <a href='read.php'>Go back to your to-do list</a>
        <footer class='whiteonblue'>
            Copyright © Matthew Jarvis, 2015
        </footer>
    </body>
</html>