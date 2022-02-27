<?php
session_start(); //to start the session
include "../connection.php";
include "hospitalbase.php";
$email = $_SESSION['email'];
$id = $_SESSION['id'];
?>
<style type="text/css">
    #log {
        background-color: rgba(0, 150, 220, 0.5);
        margin: 10px 150px;
        padding: 50px;
        color: white;
        width: 1000px;
        float: left;
    }

    td,
    th {
        padding: 10px;
    }

    #tbl {
        width: 900px;
    }

    a {
        color: #ebd231;
    }

    table {
        border-collapse: collapse;
        border: none;
    }

    th {
        background-color: rgba(0, 100, 180, 0.7);
        color: #ebd231;
    }

    /*tr:nth-child(odd) {background-color: silver;}*/
</style>
</style>
<div id="log">
    <form method="POST">
        <h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;"> Request details</h3>
        <table id="tbl" border="1">
            <tr>
                <th>REQUEST ID</th>
                <th>NAME</th>
                <th>ADDRESS</th>
                <th>PLACE</th>
                <th>EMAIL</th>
                <th>CONTACT</th>
                <th>BED</th>
                <th>REQUEST DATE</th>
                <th colspan="2">STATUS</th>
            </tr>
            <?php
            $q = "SELECT patients.*,beddetails.*,bedrequest.*,bedcategory.* FROM patients,beddetails,bedrequest, bedcategory WHERE patients.pat_id=bedrequest.pid AND beddetails.bcid=bedrequest.bcid AND bedcategory.`bcid`=beddetails.`bcid` AND beddetails.hospital_id='$id' AND bedrequest.`status`='Allocated'";

            $s = mysqli_query($conn, $q);
            while ($r = mysqli_fetch_array($s)) {
                echo '<tr>
                <td>' . $r['bookingid'] . '</td>
                <td>' . $r['name'] . '</td>
                <td>' . $r['housename'] . '</td>
                <td>' . $r['adrs'] . '</td>
                <td>' . $r['email'] . '</td>
                <td>' . $r['phone'] . '</td>
                <td>' . $r['category'] . '</td>
                <td>' . $r['bookingdate'] . '</td>
                <td>' . $r['status'] . '</td>';
                if ($r['status'] == "Allocated")
                    echo '<td><a href="approvebooking.php?id=' . $r['bookingid'] . '&status=Admitted">Mark as Admittśed</a>';
                echo '</tr>';
            }
            ?>
        </table>
    </form>
</div>