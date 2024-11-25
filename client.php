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
    <title>Add Client</title>
</head>
<body>
    <?php include_once'class/client.php';
    $c = new client();
    include_once 'res/nav.php';
    if(isset($_POST['save'])){
        $companyid=$_POST['companyid'];
        $companyname=$_POST['companyname'];
        $nature=$_POST['nature'];
        $address=$_POST['address'];
        $contactno=$_POST['contactno'];
        $contactperson=$_POST['contactperson'];
        echo '
            <script>
                Swal.fire({
				title: "Success",
				text: "'.$c->addclient($companyid, $companyname, $nature, $address, $contactno, $contactperson).'",
				icon: "success"
				});
            </script>
        
        ';
    }
    ?>
    <form method="POST">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <label for="companyid">Company Id</label>
                    <input type="text" class="form-control"name= "companyid">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-10">
                    <label for="companyname">Company Name</label>
                    <input type="text" class="form-control" name="companyname">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="nature">Nature Of Company</label>
                    <input type="text" class="form-control" name="nature">
                </div>
                <div class="col-md-9">
                    <label for="address">Company Address</label>
                    <input type="text" class="form-control" name="address">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="contact">Contact Number</label>
                    <input type="text" class="form-control" name="contactno">
                </div>
                <div class="col-md-4">
                    <label for="contactperson">Contact Person</label>
                    <input type="text" class="form-control" name="contactperson">
                </div>
                
            </div>
            <div class="row mt-3">
                <div class="col-md-2">
                    <button class="form-control btn btn-primary" type="submit" name="save" >Save</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>