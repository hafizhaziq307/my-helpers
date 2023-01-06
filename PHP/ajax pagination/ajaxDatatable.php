<?php
include 'config.php';

/**
 * Generate search query. 
 * Example: " AND (No_IC LIKE '%searchValue%' OR NamaPenuh LIKE '%searchValue%' OR Email LIKE '%$searchValue%')"
 */
function generateSearchQuery($searchValue, $fields)
{
    $arrSearch = [];
    foreach ($fields as $field) {
        array_push($arrSearch, $field . " LIKE '%" . $searchValue . "%'");
    }

    return " AND (" . implode(" OR ", $arrSearch) . ") ";
}


## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value


## custom field value
$tableName = $_POST['tableName'];
$fields = $_POST['fields'];
$excludeSearchFields = $_POST['excludeSearchFields'];


## Search 
$searchQuery = "";
if ($searchValue != '') {
    $searchableFields = array_diff($fields, $excludeSearchFields);
    $searchQuery = generateSearchQuery($searchValue, $searchableFields);
}

## Total number of records without filtering
$result = odbc_exec($odbc, "SELECT count(*) AS allcount FROM " . $tableName);
$rows = odbc_fetch_array($result);
$totalRecords = $rows['allcount'];


## Total number of records with filtering
$result = odbc_exec($odbc, "SELECT count(*) AS allcount FROM " . $tableName . " WHERE 1=1 " . $searchQuery);
$rows = odbc_fetch_array($result);
$totalRecordwithFilter = $rows['allcount'];


## Fetch records
$sql = " SELECT * FROM "
    . " ("
    . " SELECT ROW_NUMBER() OVER (ORDER BY " . $columnName . " " . $columnSortOrder . ") rowNum, *"
    . " FROM " . $tableName
    . " WHERE 1=1 " . $searchQuery
    . " ) newtbl"
    . " WHERE newtbl.rowNum"
    . " BETWEEN " . $row . " AND " . $row + $rowperpage;
$result = odbc_exec($odbc, $sql);

$data = [];
while ($rows = odbc_fetch_array($result)) {
    $tempArr = [];
    foreach ($fields as $field) {
        $tempArr[$field] = $rows[$field];
    }
    $data[] = $tempArr;
}


## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);
echo json_encode($response);
