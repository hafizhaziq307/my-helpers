<?php
echo "Acess forbidden";

define("ODBC", odbc_connect("dsn", "user", "password"));

// insert 
function insert_record($table, $attr)
{
    $columns = implode(',', array_keys($attr));
    $values = implode(',', array_values($attr));

    $query = "INSERT INTO" . $table . "(" . $columns . ") VALUES (" . $values . ")";
    odbc_exec(ODBC, $query) or die(odbc_errormsg());
}

// update
function update_record($table, $column, $value, $attr)
{
    $column_values = [];
    foreach ($attr as $column => $value) {
        array_push($column_values, $column . "=" . $value);
    }
    $column_values = implode(',', $column_values);
    $query = "UPDATE " . $table . " SET " . $column_values . " WHERE " . $column . "=" . $value;
    odbc_exec(ODBC, $query) or die(odbc_errormsg());
}

// delete
function delete_record($table, $column, $value)
{
    $query = "DELETE FROM " . $table . " WHERE " . $column . "=" . $value;
    odbc_exec(ODBC, $query) or die(odbc_errormsg());
}

// select
function select_record()
{
    // coming soon !
}
