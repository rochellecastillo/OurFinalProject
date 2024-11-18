<?php
session_start();
if(!isset($_SESSION['userid'])){
    header('location:index.php');
}else if($_SESSION['role']!='admin'){
    header('location:mainhr.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once'res/includes.php'?>
    <title>admin main</title>
</head>
<body>
    <?php
    include_once'class/employee.php';
    $e=new employee();
    if(isset($_POST['save'])){
        $idnum=$_POST['idnum'];
        $ln=$_POST['ln'];
        $fn=$_POST['fn'];
        $mn=$_POST['mn'];
        $address=$_POST['address'];
        $bdate=$_POST['bdate'];
        $gender=$_POST['gender'];
        $contact=$_POST['contact'];
        echo'
            <script>
                Swal.fire({
				title: "Success",
				text: "'.$e->addemployee($idnum,$ln,$fn,$mn,$address,$bdate,$gender,$contact,'hr').'",
				icon: "success"
				});
            </script>
        
        ';
        
    }
    include_once'res/nav.php';
    ?>

    <div class="container">
        <form method="POST">
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="idnum">Id Number</label>
                    <input type="text" class="form-control" name="idnum">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="ln">LastName</label>
                    <input type="text" class="form-control"name="ln">
                </div>
                <div class="col-md-4">
                    <label for="fn">FirstName</label>
                    <input type="text" class="form-control"name="fn">
                </div>
                <div class="col-md-4">
                    <label for="mn">MiddleName</label>
                    <input type="text" class="form-control"name="mn">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-10">
                    <label for="address">Address</label>
                    <input type="text" class="form-control"name="address">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="bdate">BirthDate</label>
                    <input type="date" class="form-control"name="bdate">
                </div>
                <div class="col-md-3">
                    <label for="gender">Gender</label>
                    <select name="gender" id="" class="form-control">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="contact">ContactNo</label>
                    <input type="text" class="form-control"name="contact">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-2">
                    <button class="btn btn-primary form-control"name="save">SAVE</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
