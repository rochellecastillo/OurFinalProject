<?php
date_default_timezone_set("Asia/Manila");
include_once'database.php';
class employee extends database{
    public function login($un,$pw){
        $sql = "select * from user where userid=? and password=?";
        $stmt=$this->con->prepare($sql);
        $stmt->bind_param('ss',$un,$pw);
        $stmt->execute();
        $data=$stmt->get_result();
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
    public function displayemployee($name){
        $p=$name.'%';
        $sql="select * from hr where concat(lastname,' ',firstname) like ? or concat(firstname,' ',lastname) like ?";
        $stmt=$this->con->prepare($sql);
        $stmt->bind_param('ss',$p,$p);
        $stmt->execute();
        $data=$stmt->get_result();
        $stmt->close();
        return $data;
    }
    public function assignemployee($employeeid,$companyid){
        $date=date("Y-m-d");
        $sql="insert into assignment values(NULL,?,?,?,'active')";
        $stmt=$this->con->prepare($sql);
        $stmt->bind_param('sss',$employeeid,$companyid,$date);
        if($stmt->execute()){
            $stmt->close();
            return'Employee Assigned Successfully!';
        }else{
            $stmt->close();
            return $this->con->error;
        }
    }
    public function showassignment($companyid){
        $sql="select a.*,h.lastname,h.firstname, h.middlename, h.address, h.gender from assignment a inner join hr h on a.employeeid =h.userid where companyid=?";
        $stmt=$this->con->prepare($sql);
        $stmt->bind_param('s',$companyid);
        $stmt->execute();
        $data=$stmt->get_result();
        return $data;
    }
    public function removeassignment($employeeid){
        $sql="delete from assignment where employeeid=?";
        $stmt=$this->con->prepare($sql);
        $stmt->bind_param('s',$employeeid);
        if($stmt->execute()){
            $stmt->close();
            return 'Manpower Assignment Deleted!';
        }else{
            $stmt->close();
            return $this->con->error;
        }
    }
    public function changepassword($un,$pw,$pw2,$pw3){
        $sql="select * from user where userid=? and password=?";
        $stmt=$this->con->prepare($sql);
        $stmt->bind_param('ss',$un,$pw);
        $stmt->execute();
        $data=$stmt->get_result();
        if($data->num_rows>0){
            if($pw2==$pw3){
                $sql="update user set password=? where userid=?";
                $stmt=$this->con->prepare($sql);
                $stmt->bind_param('ss',$pw,$un);
                $stmt->execute();
                $stmt->close();
                return'Password Successfully Changed!';
            }else{
                return'New Password did not Match';
            }
        }else{
            return 'Password Incorrect';
        }
        

    }
}
?>