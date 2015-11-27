<?php
require'inc/User.Class.php';
require 'inc/Item.Class.php';
include 'inc/database_connection.php';
include 'inc/load_user.php';
include 'inc/load_todo_list.php';
?>

<html>
    <head>
        <title>To-do List</title>
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <meta charset="UTF-8">
    </head>

    <body>
        <header class='whiteonblue'>
            <h1>A Web-based To-do List</h1>
        </header>
        <br>
        <div class="blueonwhite">
            <font style="position: absolute; right: 1%;">
            <?php
            $name = $user->getFirstName() . ' ' . $user->getLastName();
            
            echo "You are logged in as {$name}";
            ?>
            </font>
            <br>
            <a href='create.php?user_id=<?php echo $user->getUserId(); ?>'>Create new</a>
            <a href="login.php" style="position: absolute; right: 1%;">Logout...</a>
        </div>
        <br>

        <div class="blueonwhite">
            <table id="todo_list_table" width="100%">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Created</th>
                    <th>Last updated</th>
                    <th>Action</th>
                </tr>
                <?php
                foreach ($todo_list as $key => $item)
                {
                    ?>
                    <tr>
                        <td><?php echo $item->getTitle(); ?></td>
                        <td><?php echo $item->getDescription(); ?></td>
                        <td><?php echo $item->getDatetimeCreated(); ?></td>
                        <td><?php echo $item->getDatetimeLastUpdated(); ?></td>
                        <td><?php
                            $item_id = $item->getItemId();
                            $user_id = $item->getUserId();
                            echo "<a href='update.php?item_id={$item_id}&user_id={$user_id}'>Edit</a>"
                            . " / "
                            . "<a href='delete.php?item_id={$item_id}&user_id={$user_id}'"
                            . " onclick=\"return confirm('Confirm: delete this item?');\""
                            . ">Delete</a>";
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>

        <footer class='whiteonblue'>
            Copyright © Matthew Jarvis, 2015
        </footer>
    </body>
</html>