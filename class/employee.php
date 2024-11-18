<?php
include_once'database.php';
class employee extends database{
    public function login($un,$pw){
        $sql = "select * from user where userid='$un' and password='$pw'";
        $data=$this->con->query($sql);
        return $data;
    }
    public function addemployee($idnum,$ln,$fn,$mn,$address,$bdate,$gender,$contact,$role){

        $sql="insert into hr values(NULL,?,?,?,?,?,?,?,?)";
        $sql2="insert into user values(NULL,?,?,?,'active')";
        $stmt=$this->con->prepare($sql);
        $stmt2=$this->con->prepare($sql2);
        $stmt->bind_param('ssssssss',$idnum,$ln,$fn,$mn,$address,$bdate,$gender,$contact);
        $stmt2->bind_param('sss',$idnum,$ln,$role);
        if($stmt->execute() && $stmt2->execute()){
            $stmt->close();
            $stmt2->close();
            return'Record Added Successfully!';
        }else{
            $stmt->close();
            $stmt2->close();
            return $this->con->error;
        }

    }
    public function deleteemployee($idnum){
        $sql="delete from hr where userid=?";
        $sql2="delete from user where userid=?";
        $stmt=$this->con->prepare($sql);
        $stmt2=$this->con->prepare($sql2);
        $stmt->bind_param('s',$idnum);
        $stmt2->bind_param('s',$idnum);
        if($stmt->execute() && $stmt2->execute()){
            $stmt->close();
            $stmt2->close();
            return'Record Deleted Successfully!';
        }else{
            $stmt->close();
            $stmt2->close();
            return $this->con->error;
        }

    }
    public function updateemployee($idnum,$ln,$fn,$mn,$address,$bdate,$gender,$contact){

        $sql="update hr set lastname=?,firstname=?,middlename=?, address=?, birthdate=?, gender=?, contact=? where userid=?";
        $stmt=$this->con->prepare($sql);
        $stmt->bind_param('ssssssss',$ln,$fn,$mn,$address,$bdate,$gender,$contact,$idnum);
        if($stmt->execute()){
            $stmt->close();
            return'Record Updated Successfully!';
        }else{
            $stmt->close();
            return $this->con->error;
        }
    }
    public function displayall($role){
        $sql="select h.* from hr h inner join user u on h.userid=u.userid order by h.lastname";
        $stmt=$this->con->prepare($sql);
        //$stmt->bind_param('s',$idnum);
        $stmt->execute();
        $data=$stmt->get_result();
        $stmt->close();
        return $data;

    }
}
?>