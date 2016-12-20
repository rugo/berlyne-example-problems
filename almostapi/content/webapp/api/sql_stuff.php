<?php
include 'util.php';

/* 
 * Water has a memory and carries within it our thoughts and prayers.
 * As you yourself are water, no matter where you are, your prayers 
 * will be carried to the rest of the world. - Masaru Emoto
 *
 * Which is why you have to be open minded towards all the things.
 * I do not understand OOP. Do I need to? No. I don't.
 *
 * I don't need to understand to be able to feel and experience
 * programming using my third eye.
 *
 */

class SqlQuery {
    /* 
     * I dream of a world without classes, where all the attributes live
     * together in one data structure. Without beeing ordered or categorized.
     * Unfortunately this is not yet possible with PHP
     */
    private $q_config = array();
    protected $conn;
    protected $query = "";

    private $allowed = array(
        "table" => array(
            "posts",
            "categories"
        ),
        "operator" => array(
            "=",
            "<",
            ">",
        ),
    );

    function __construct($conn) {
        $this->conn = $conn;
    }

    function __get($name) {
        if ($name == 'table' || $name == 'operator') {
            return $this->q_config[$name];
        } else if ($name == 'value') {
            return (int) $this->q_config[$name];
        } else if ($name == 'fields') {
            if ($this->q_config[$name]) {
                return join(", ", $this->q_config[$name]);
            }
            return "*";
        } else {
            gtfo();
        }
    }

    function __set($name, $value) {
        if(array_key_exists($name, $this->allowed)) {
            if (in_array($value, $this->allowed[$name])) {
                add_elem($this->q_config, $value, $name);
            } else {
                echo $value;
                gtfo();
            }
        } else if ($name == 'value') {
            if ((int)$value) {
                add_elem($this->q_config, $value, $name);
            }
        } else if ($name == 'fields') {
            foreach ($value as $field) {
                sqli_check($field);
            }
            $this->q_config[$name] = $value;
        }
    }

    function fire_query() {
        $res = $this->conn->query($this->query);
        if (!$res) {
            gtfo();
        }
        return $res;
    }

    /* 
     * The world FORCES us to push data in certain forms instead of
     * to align to societies standards.
     * TODO: Fix society's standard.
     */
    function fire_query_get_json() {
        $res = $this->fire_query();
        $res_arr = array();
        while($row = $res->fetch_array(MYSQL_ASSOC)) {
            $res_arr[] = $row;
        }
        return json_encode($res_arr);
    }

}

/*
 * Class hierarchy is a stigmata of OOP, leading to class conflicts.
 * This class is not a "sub"class. It is a free and indepentent 
 * spirit that chose to have certain attributes.
 */
class SqlSelectQuery extends SqlQuery{

    function build_query() {
        $this->query = "SELECT " . $this->fields . " FROM " . $this->table . " WHERE id " . $this->operator . " " . $this->value;
    }

}
