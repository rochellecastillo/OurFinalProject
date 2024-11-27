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
    public function updateclient($companyid, $companyname, $natureofcompany, $address, $contact, $contactperson){
        $sql = "update client set companyname=?,natureofcompany=?,address=?,contact=?,contactperson=? where companyid=?";
        $stmt=$this->con->prepare($sql);
        $stmt->bind_param('ssssss', $companyname, $natureofcompany, $address, $contact, $contactperson,$companyid);

        if($stmt->execute()){
            $stmt->close();
            return 'Client Information Updated Successfully!';
        } else{
            $stmt->close();
            return $this->con->error;
        }
        
    }
    public function deleteclient($companyid){
        $sql = "delete from client where companyid=?";
        $stmt=$this->con->prepare($sql);
        $stmt->bind_param('s',$companyid);

        if($stmt->execute()){
            $stmt->close();
            return 'Client Information Deleted Successfully!';
        } else{
            $stmt->close();
            return $this->con->error;
        }
        
    }
}
?>