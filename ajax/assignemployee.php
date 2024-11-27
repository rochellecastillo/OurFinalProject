<?php
include_once'../class/employee.php';
$e=new employee();
$employeeid=$_GET['employeeid'];
$companyid=$_GET['companyid'];
echo $e->assignemployee($employeeid,$companyid);
?>