<?php
session_start();
if(!isset($_SESSION['userid'])){
    header('location:index.php');
}else if($_SESSION['role']!='hr'){
    header('location:main.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once'res/includes.php'?>
    <title>Admin Main</title>
</head>
<body>
    <?php
    include_once'class/employee.php';
    $e=new employee();
    include_once'res/nav.php';
    if(isset($_POST['update'])){
        $idnum=$_POST['userid'];
        $ln=$_POST['ln'];
        $fn=$_POST['fn'];
        $mn=$_POST['mn'];
        $address=$_POST['address'];
        $bdate=$_POST['birthdate'];
        $gender=$_POST['gender'];
        $contact=$_POST['contact'];
       /* echo'
            <script>
                alert("'..'");
            </script>
        ';*/
        echo'
			<script>
				Swal.fire({
				title: "Success",
				text: "'.$e->updateemployee($idnum,$ln,$fn,$mn,$address,$bdate,$gender,$contact).'",
				icon: "success"
				});
			</script>
			';

    }else if(isset($_POST['delete'])){
        $idnum=$_POST['userid'];
        echo'
            <script>
                Swal.fire({
				title: "Success",
				text: "'.$e->deleteemployee($idnum).'",
				icon: "success"
				});
            </script>
        ';
    }
    $e=new employee();
    $data=$e->displayall($_SESSION['role']);
    ?>

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="usertable">
                        <thead>

                            <tr>
                                <th class="text-nowrap">User ID</th>
                                <th class="text-nowrap">Last Name</th>
                                <th class="text-nowrap">First Name</th>
                                <th class="text-nowrap">Middle Name</th>
                                <th class="text-nowrap">Address</th>
                                <th class="text-nowrap">BirthDate</th>
                                <th class="text-nowrap">Gender</th>
                                <th class="text-nowrap">Contact</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        
                        <?php
                        while($row=$data->fetch_assoc()){
                            echo'
                                <tr>
                                    <td>'.$row['userid'].'</td>
                                    <td>'.$row['lastname'].'</td>
                                    <td>'.$row['firstname'].'</td>
                                    <td>'.$row['middlename'].'</td>
                                    <td>'.$row['address'].'</td>
                                    <td>'.$row['birthdate'].'</td>
                                    <td>'.$row['gender'].'</td>
                                    <td>'.$row['contact'].'</td>
                                    <td class="text-nowrap">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" onclick="displaydetails(&quot;'.$row['userid'].'&quot;,&quot;'.$row['lastname'].'&quot;,&quot;'.$row['firstname'].'&quot;,&quot;'.$row['middlename'].'&quot;,&quot;'.$row['address'].'&quot;,&quot;'.$row['birthdate'].'&quot;,&quot;'.$row['gender'].'&quot;,&quot;'.$row['contact'].'&quot;)">&#9776;</button>
                                    </td>
                                </tr>
                            
                            ';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>

<form method="POST">
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title">HR Information</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">
                    <div class="row mt-3">
                        <div class="col-md-5">
                            <label for="idnum">User Id</label>
                            <input type="text" class="form-control" readonly="readonly" name="userid" id="userid">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="ln">Last Name</label>
                            <input type="text" class="form-control" name="ln" id="ln">
                        </div>
                        <div class="col-md-4">
                            <label for="fn">First Name</label>
                            <input type="text" class="form-control" name="fn" id="fn">
                        </div>
                        <div class="col-md-4">
                            <label for="mn">Middle Name</label>
                            <input type="text" class="form-control" name="mn" id="mn">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-10">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="birthdate">Birthdate</label>
                            <input type="date" class="form-control" name="birthdate" id="birthdate">
                        </div>
                        <div class="col-md-3">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="birthdate">Contact</label>
                            <input type="text" class="form-control" name="contact" id="contact">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="update">Update</button>
                <button type="submit" class="btn btn-danger" name="delete">Delete</button>
            </div>

            </div>
        </div>
    </div>
</form>
</body>
</html>

<script>
    function displaydetails(userid,ln,fn,mn,address,birthdate,gender,contact){
        document.getElementById("userid").value=userid;
        document.getElementById("ln").value=ln;
        document.getElementById("fn").value=fn;
        document.getElementById("mn").value=mn;
        document.getElementById("address").value=address;
        document.getElementById("birthdate").value=birthdate;
        document.getElementById("gender").value=gender;
        document.getElementById("contact").value=contact;
    }

    $(document).ready(function() {
        $('#usertable').DataTable();
    });
</script>