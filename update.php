<?php
require 'inc/Item.Class.php';
include 'inc/database_connection.php';
include 'inc/load_item.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    try
    {
        $sql = "UPDATE item SET title=:title, description=:desc";
        $sql .= " WHERE item_id=:i_id AND user_id=:u_id";
        $stmnt = $dbconn->prepare($sql);
        $params = array(
            ':i_id' => $_POST['item_id'],
            ':u_id' => $_POST['user_id'],
            ':title' => $_POST['title'],
            ':desc' => $_POST['desc']
        );
        if ($stmnt->execute($params))
        {
            $url = 'http://localhost:8888/todo-list/read.php';
            header('Location: ' . $url . '?user_id=' . $_POST['user_id']);
        } else
        {
            die('Unable to update item.');
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
            <title>To-do List: Update</title>
            <link href="css/style.css" rel="stylesheet" type="text/css">
            <meta charset="UTF-8">
        </head>
        <body>
            <header class='whiteonblue'>
                <h1>Update item</h1>
            </header>
            <form action='update.php' method='post'>
                <input type="hidden" name="item_id" value="<?php echo $_GET['item_id']; ?>"/>
                <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>"/>
                <table>
                    <tr>
                        <td>Title: </td> 
                        <td><input type="text" name="title" maxlength="45" value="<?php echo $item->getTitle(); ?>"/></td>
                    </tr>
                    <tr>
                        <td>Description: </td>
                        <td><textarea name="desc" rows="6" cols="25" maxlength="100"><?php echo $item->getDescription(); ?></textarea></td>
                    </tr>
                    <tr> 
                        <td></td>
                        <td><input type='submit' value='Save changes'/></td>
                    </tr>
                </table>  
            </form>
            <?php
        }
        ?>
        <a href="read.php?user_id=<?php echo $_GET['user_id']; ?>">Go back to your to-do list</a>
        <footer class='whiteonblue'>
            Copyright © Matthew Jarvis, 2015
        </footer>
    </body>
</html>