<?php
include_once 'database.php';
class client extends database{
    public function addclient($companyid, $companyname, $natureofcompany, $address, $contact, $contactperson){
        $sql = "insert into client values (NULL,?,?,?,?,?,?)";
        $stmt=$this->con->prepare($sql);
        $stmt->bind_param('ssssss',$companyid, $companyname, $natureofcompany, $address, $contact, $contactperson);

        if($stmt->execute()){
            $stmt->close();
            return 'Client Added Successfully!';
        } else{
            $stmt->close();
            return $this->con->error;
        }
        
    }
    public function viewallclient(){
        $sql="select * from client order by companyname";
        $stmt=$this->con->prepare($sql);
        $stmt->execute();
        $data=$stmt->get_result();
        $stmt->close();
        return $data;
    }
}
?>