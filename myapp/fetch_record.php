<?php
include "class/Database.php";

$ajax_array = array();

$db = new Database;

foreach ($db->getList() as $row) {
        $row_array['name'] = $row['name'];
        $row_array['telephone'] = $row['telephone'];
        $row_array['email'] = $row['email'];
        $row_array['company'] = $row['company'];
        $row_array['path'] = $row['path'];
        array_push($ajax_array,$row_array);
}
echo json_encode($ajax_array);
?>