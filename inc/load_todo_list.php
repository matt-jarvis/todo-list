<?php

try
{
    $sql = 'SELECT * FROM item WHERE user_id=:u_id';
    $stmnt = $dbconn->prepare($sql);
    $stmnt->execute(array(':u_id' => $user->getUserId()));
    $stmnt->setFetchMode(PDO::FETCH_CLASS, 'Item');

    while ($item = $stmnt->fetch())
    {
        $todo_list[] = $item;
    }
} catch (PDOException $e)
{
    die('Error: ' . $e->getMessage());
}

?>