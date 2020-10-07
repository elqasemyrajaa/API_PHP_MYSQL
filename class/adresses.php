<?php
    class Adresse{

        // Connection
        private $conn;

        // Table
        private $db_table = "adresse";

        // Columns
        public $id_adress;
        public $adress;
        public $latitude;
        public $longitude;
        public $date;
       

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAdresses(){
            $sqlQuery = "SELECT id_adress,adress,latitude,longitude,date FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createAdresse(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        adress = :adress, 
                        latitude = :latitude, 
                        longitude = :longitude"; 
            $stmt = $this->conn->prepare($sqlQuery);
             // sanitize
             $this->adress=htmlspecialchars(strip_tags($this->adress));
             $this->latitude=htmlspecialchars(strip_tags($this->latitude));
             $this->longitude=htmlspecialchars(strip_tags($this->longitude));
 
         
             // bind data
             $stmt->bindParam(":adress", $this->adress);
             $stmt->bindParam(":latitude", $this->latitude);
             $stmt->bindParam(":longitude", $this->longitude);
         
             if($stmt->execute()){
                return true;
             }
             return false;
        
           
        }

        // UPDATE
        public function getSingleAdress(){
            $sqlQuery = "SELECT
                        id_adress, 
                        adress, 
                        latitude, 
                        longitude, 
                        date
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id_adress = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id_adress);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id_adress = $dataRow['id_adress'];
            $this->adress = $dataRow['adress'];
            $this->latitude = $dataRow['latitude'];
            $this->longitude = $dataRow['longitude'];
            $this->date = $dataRow['date'];
        } 
        
        // UPDATE
        public function updateAdresse(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        adress = :adress, 
                        latitude = :latitude, 
                        longitude = :longitude
                    WHERE 
                        id_adress = :id_adress";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->adress=htmlspecialchars(strip_tags($this->adress));
            $this->latitude=htmlspecialchars(strip_tags($this->latitude));
            $this->longitude=htmlspecialchars(strip_tags($this->longitude));
            $this->date=htmlspecialchars(strip_tags($this->date));
            $this->id_adress=htmlspecialchars(strip_tags($this->id_adress));
        
            // bind data
            $stmt->bindParam(":adress", $this->adress);
            $stmt->bindParam(":latitude", $this->latitude);
            $stmt->bindParam(":longitude", $this->longitude);
            $stmt->bindParam(":date", $this->date);
            $stmt->bindParam(":id_adress", $this->id_adress);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }


        // DELETE
        function deleteAdress(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_adress = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_adress=htmlspecialchars(strip_tags($this->id_adress));
        
            $stmt->bindParam(1, $this->id_adress);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
