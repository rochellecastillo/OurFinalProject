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
    <?php include_once 'res/includes.php'?>
    <title>Client Information</title>
</head>
<body>
    <?php
    include_once 'class/client.php';
    $c=new client();
    include_once 'res/nav.php';
    if(isset($_POST['update'])){
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
                text: "'.$c->updateclient($companyid, $companyname, $nature, $address, $contactno, $contactperson).'",
                icon: "success"
                });
            </script>
        
        ';
    }else if(isset($_POST['delete'])){
        $companyid=$_POST['companyid'];

        echo '
            <script>
                Swal.fire({
                title: "Success",
                text: "'.$c->deleteclient($companyid).'",
                icon: "success"
                });
            </script>
        
        ';
    }
    ?>
    <div class="container">
        <div class="row">
        <table id='clienttbl'>
            <thead>
                <tr>
                    <th>Company Id</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Nature</th>
                    <th>Contact</th>
                    <th>ContactPerson</th>
                    <th>-</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $data=$c->viewallclient();
                while($row=$data->fetch_assoc()){
                    echo '
                        <tr>
                            <td>'.$row['companyid'].'</td>
                            <td>'.$row['companyname'].'</td>
                            <td>'.$row['natureofcompany'].'</td>
                            <td>'.$row['address'].'</td>
                            <td>'.$row['contact'].'</td>
                            <td>'.$row['contactperson'].'</td>
                            <td class="text-nowrap">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" onclick="displaydetails(&quot;'.$row['companyid'].'&quot;,&quot;'.$row['companyname'].'&quot;,&quot;'.$row['natureofcompany'].'&quot;,&quot;'.$row['address'].'&quot;,&quot;'.$row['contact'].'&quot;,&quot;'.$row['contactperson'].'&quot;)">&#9776;</button>
                            </td>
                        </tr>
                    ';
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
    <form method="POST">
        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h4 class="modal-title">Client Information</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
                
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container">
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="companyid">Company ID</label>
                                <input type="text" class="form-control" name="companyid" id="companyid" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-8">
                                <label for="companyid">Company Name</label>
                                <input type="text" class="form-control" name="companyname" id="companyname">
                            </div>
                            <div class="col-md-4">
                                <label for="companyid">Nature of Company</label>
                                <input type="text" class="form-control" name="nature" id="nature">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-10">
                                <label for="companyid">Company Address</label>
                                <input type="text" class="form-control" name="address" id="address">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="companyid">Contact Number</label>
                                <input type="text" class="form-control" name="contactno" id="contactno">
                            </div>
                            <div class="col-md-4">
                                <label for="companyid">Contact Person</label>
                                <input type="text" class="form-control" name="contactperson" id="contactperson">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submt" class="btn btn-primary" name="update">Update</button>
                    <button type="submt" class="btn btn-primary" name="delete">Delete</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

                </div>
            </div>
        </div>
    </form>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#clienttbl').DataTable();
    });
    function displaydetails(companyid,companyname,address,nature,contact,contactperson){
        document.getElementById("companyid").value=companyid;
        document.getElementById("companyname").value=companyname;
        document.getElementById("address").value=address;
        document.getElementById("nature").value=nature;
        document.getElementById("contactno").value=contact;
        document.getElementById("contactperson").value=contactperson;
    }
</script>