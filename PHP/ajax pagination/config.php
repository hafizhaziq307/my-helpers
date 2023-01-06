<?php
$odbc = odbc_connect("Driver={SQL Server};Server=localhost\SQLExpress;Database=NATSISApp;", "sa", "admin@234");

if (!$odbc) {
    die("Connection Failed: - " . $odbc . "<br>" .  odbc_error());
}
