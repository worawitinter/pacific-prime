<?php

class Database{
        private $dbconn;

        public function __construct(){
                try{
                        $this->dbconn = new PDO("mysql:dbname=db_test;host=127.0.0.1",'root','12345678');
                }catch(PDOException $e){
                        print "Error!: ".$e->getMessage()."";
                        die();
                }
                
        }

        public function insertRecord($data_array){
                try{
                        $sql = "INSERT INTO user (name, telephone, email, company, path) VALUES (:name, :telephone, :email, :company, :path)";
                        $query = $this->dbconn->prepare($sql);
                        $query->execute(array(
                                ':name' => $data_array["name"],
                                ':telephone' => $data_array["telephone"],
                                ':email' => $data_array["email"],
                                ':company' => $data_array["company"],
                                ':path' => $data_array["file_name"]
                        ));
                        return true;
                }catch(PDOException $e){
                        print "Error!: ".$e->getMessage()."";
                        die();
                }
                
        }

        public function uploadLogo($data_array){
                if($data_array["file_type"] == "image/png" || $data_array["file_type"] == "image/jpg" || $data_array["file_type"] == "image/jpeg"){
                        $temp_path = $data_array["file_path"];
                        $target_path = "upload/".$data_array["file_name"];
                        move_uploaded_file($temp_path,$target_path);
                }
        }

        public function getList(){
                try{
                        $sql = "SELECT * FROM user";
                        $query = $this->dbconn->prepare($sql);
                        $query->execute();
                        return $query->fetchALL(PDO::FETCH_ASSOC);
                }catch(PDOException $e){
                        print "Error!: ".$e->getMessage()."";
                        die();
                }
                
        }
}
?>