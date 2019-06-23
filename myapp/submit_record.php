<?php
include "class/Database.php";

$data_array = array();
$data_array["name"] = $_POST["fmi_name"];
$data_array["telephone"] = $_POST["fmi_telephone"];
$data_array["email"] = $_POST["fmi_email"];
$data_array["company"] = $_POST["fmi_company"];
$data_array["file_name"] = $_FILES["fmi_fileupload"]["name"];
$data_array["file_path"] = $_FILES["fmi_fileupload"]["tmp_name"];
$data_array["file_type"] = $_FILES["fmi_fileupload"]["type"];

$db = new Database;
$db->uploadLogo($data_array);
$db->insertRecord($data_array);
?>