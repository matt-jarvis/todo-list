<?php

try
{
    $sql = 'SELECT * FROM item WHERE item_id=:i_id AND user_id=:u_id';
    $stmnt = $dbconn->prepare($sql);
    $stmnt->execute(array(':i_id' => $_GET['item_id'], ':u_id' => $_GET['user_id']));
    $stmnt->setFetchMode(PDO::FETCH_CLASS, 'Item');
    $item = $stmnt->fetch();
} catch (PDOException $e)
{
    die('Error: ' . $e->getMessage());
}

?>