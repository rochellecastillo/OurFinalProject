<?php
include_once'database.php';
class employee extends database{
    public function login($un,$pw){
        $sql = "select * from user where userid='$un' and password='$pw'";
        $data=$this->con->query($sql);
        return $data;
    }
    public function addemployee($idnum,$ln,$fn,$mn,$address,$bdate,$gender,$contact){
        $sql = "insert into hr values(NULL,'$idnum','$ln','$fn','$mn','$address','$bdate','$gender','$contact');";
        $sql.="insert into user values(NULL,'$idnum','$ln','hr','active')";
        if($this->con->multi_query($sql)){
            return 'Record Added Sucessfully';
        }else {
            return $this->con->error;
        }

    }
    public function deleteemployee($idnum){
        $sql="delete from hr where userid='$idnum';";
        $sql.="delete from user where userid='$idnum'";
        if($this->con->multi_query($sql)){
            return 'Record Updated Successfully!';
        }else{
            return $this->con->error;
        }
    }
    public function updateemployee($idnum,$ln,$fn,$mn,$address,$bdate,$gender,$contact){
        $sql="update hr set lastname='$ln',firstname='$fn',middlename='$mn', address='$address', birthdate='$bdate', gender='$gender', contact='$contact' where userid='$idnum'";
        if($this->con->query($sql)){
            return 'Record Updated Successfully!';
        }else{
            return $this->con->error;
        }
    }
    public function displayall($role){
        $sql="select h.* from hr h inner join user u on h.userid=u.userid order by h.lastname";
        $data=$this->con->query($sql);
        return $data;

    }
}
?>