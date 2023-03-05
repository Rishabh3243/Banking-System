<?php
$sname ="sql312.epizy.com";
$username ="epiz_33708832";
$password ="TaGhi7PxGr";
$dbname ="epiz_33708832_Bank";
$conn1 = mysqli_connect($sname,$username,$password,$dbname);
if($conn1)
{
    echo "Connection Successful";
}
else
{
    echo "Connection Unsuccessful";
}
?>