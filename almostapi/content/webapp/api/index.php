<?php
include 'sql_stuff.php';
include 'db_conn.php';

/* 
 * This is a pre-Thangka version.
 * As you noticed, I did NOT use the patriarchalic term pre-alpha! 
 * See my tumblr for details.
 * 
 * This will be a software used by open minded, spiritual people
 * all over the world. 
 * Its main purpose is to be used at the ntcb:
 * http://www.ntcb.org/information/SpiritualHealer.pdf
 *
 */
if ($_GET) {
    $sql = new SqlSelectQuery($conn);
    $sql->table = $_GET['table'];
    $sql->operator = $_GET['operator'];
    $sql->fields = explode(":", $_GET['fields']);
    $sql->value = $_GET['value'];
    $sql->build_query();
    echo $sql->fire_query_get_json();
} else {
    echo "Generic SQL to JSON mapper 3000. Example usage: index.php?table=posts&operator=%3C&fields=id:title:text:author&value=100";
}