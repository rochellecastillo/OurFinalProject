<?php
include_once'../class/employee.php';
$e=new employee();
$name=$_GET['name'];
$data=$e->displayemployee($name);

?>
<table class="table" id="employeetbl">
    <thead>
        <tr>
            <th>Employee ID</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Address</th>
            <th>Contact No</th>
            <th>-</th>
        </tr>
    </thead>
    <tbody>

        <?php
        while($row=$data->fetch_assoc()){
            echo"
            <tr>
                <td>{$row['userid']}</td>
                <td>{$row['lastname']}</td>
                <td>{$row['firstname']}</td>
                <td>{$row['middlename']}</td>
                <td>{$row['address']}</td>
                <td>{$row['contact']}</td>
                <td><button class='btn btn-primary' onclick='assignemployee(&quot;{$row['userid']}&quot;)'>Assign</button></td>
            </tr>
            ";
        }
        ?>
    </tbody>
</table>
<script>
    $(document).ready(function(){
        $('#employeetbl').DataTable();
    });
</script>