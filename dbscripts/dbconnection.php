<?php

        try{
            $dbh = new PDO('mysql:host='.DBADDR.';dbname='.DBNAME.';charset=utf8',DBUSER, DBPASS);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
        }
        catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
            }   
 





//class Database{
//    protected $db;
//    public function __contruct(){
//        $this->db = new PDO('mysql:host='.HOST_CAFE.';dbname='.DATABASE_CAFE.';charset=utf8',USERNAME_CAFE, PASSWORD_CAFE);
//        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
//    }
//    
//}
//
//    try{
//        $dbh = new PDO('mysql:host='.HOST_CAFE.';dbname='.DATABASE_CAFE.';charset=utf8',USERNAME_CAFE, PASSWORD_CAFE);
//        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE); 
//        
//    }
//    catch(PDOException $e){
//        die();
//    }       
//            
//   
    
?>