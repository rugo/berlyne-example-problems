<?php
include 'sql_stuff.php';
include 'db_conn.php';

if ($_GET) {
    $sql = new SqlSelectQuery($conn);
    $sql->table = $_GET['table'];
    $sql->operator = $_GET['operator'];
    $sql->fields = explode(":", $_GET['fields']);
    $sql->value = $_GET['value'];
    $sql->build_query();
    echo $sql->fire_query_get_json();
} else {
    echo "Generic SQL to JSON mapper 3000. Example usage: q.php?table=posts&operator=%3C&fields=id:title:text:author&value=100";
}