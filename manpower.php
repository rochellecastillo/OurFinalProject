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
    ?>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-3">
                <label for="company">Company</label>
                <select name="company" id="company" class="form-control">
                    <?php
                        $data=$c->viewallclient();
                        while($row=$data->fetch_assoc()){
                            echo "
                                <option value='{$row['companyid']}'>{$row['companyname']}</option>
                            ";
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="employee">Search Employee</label>
                <input type="search" class="form-control" name="search" id="search" placeholder="Type Employee Name..." oninput="searchemployee(this.value)">
            </div>
        </div>
        <div id="searchresult"></div>
    </div>
       
</body>
</html>
<script>
     
    function searchemployee(name){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("searchresult").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "ajax/viewemployee.php?name="+name, true);
        xhttp.send();
    }
    function assignemployee(employeeid){
        var companyid=document.getElementById("company").value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                Swal.fire({
                    title: "Success",
                    text: this.responseText,
                    icon: "success"
				});
            }
        };
        xhttp.open("GET", "ajax/assignemployee.php?employeeid="+employeeid+"&companyid="+companyid, true);
        xhttp.send();
    }
</script>