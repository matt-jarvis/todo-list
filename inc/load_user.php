<?php

if ($_POST['username'] && $_POST['password'])
{
    
    $sql = 'SELECT * FROM user WHERE username=:u AND password=:p';
    $params = array(':u' => $_POST['username'], ':p' => $_POST['password']);
} else if ($_GET['user_id'])
{
    $sql = 'SELECT * FROM user WHERE user_id=:u_id';
    $params = array(':u_id' => intval($_GET['user_id']));
}
else {
    backToLogin();
}

try
{
    $stmnt = $dbconn->prepare($sql);
    $stmnt->execute($params);
    $stmnt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $user = $stmnt->fetch();
    if (!$user)
    {
        backToLogin();
    }
} catch (PDOException $e)
{
    die('Error: ' . $e->getMessage());
}

function backToLogin()
{
    header('Location: http://localhost:8888/todo-list/login.php?err=1');
}

?>