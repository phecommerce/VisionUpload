<?php require_once'config/init.php';

function deleteItem($db) {
    $getid = $_POST['id'];

    $db->query("DELETE FROM users WHERE id = '$getid'");
}
deleteItem($db);