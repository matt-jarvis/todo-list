<?php
include 'inc/database_connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET')
{
    die('Item to delete not specified.');
}

try
{
    $sql = "DELETE FROM item WHERE item_id=:i_id AND user_id=:u_id";
    $params = array(':i_id' => $_GET['item_id'],':u_id' => $_GET['user_id']);
    $stmnt = $dbconn->prepare($sql);
    if($stmnt->execute($params))
    {
        $url = 'http://localhost:8888/todo-list/read.php';
        header('Location: ' . $url . '?user_id=' . $_GET['user_id']);
    }
} catch (PDOException $e)
{
    echo '<br>Error: ' . $e->getMessage();
}

?>