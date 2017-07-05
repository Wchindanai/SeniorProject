<?php ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "static/head.php"?>
    <style>
        .center-table
        {
            margin: 0 auto !important;
            float: none !important;
        }
    </style>
</head>
<body>
<?php include "static/sidebar.php"; ?>
<div id="page-content-wrapper">
    <div id="page-content" style="">
        <div style="text-align: center; font-size: 40px; color: #858585">Status</div>

        <?php
            $query = $this->db->query("SELECT * FROM Device");
            foreach ($query->result() as $row){
                echo "<div style='text-align: center;'><img src='../../static/img/device.png'></div>";
                echo "<table style='font-size: 20px' class='center-table'>";
                echo "<tbody>";
                echo "<tr><td>Room : </td><td>".($row -> roomName)."</td></tr>";
                $status = $row ->status;
                if($status==0){
                    $status = "Disconnect";
                }
                else if($status==1){
                    $status = "Connected";
                }
                echo "<tr><td>Status : &nbsp;</td> <td>".$status."</td> </tr>";
                echo "</table>";
                echo "<p></p>";
            }
        ?>
    </div>
</div>
</body>
<!-- JS Demo -->
<script type="text/javascript" src="../../static/assets-minified/bootstrap.js"></script>
<script>
    $(document).ready(function () {
        $('#main').addClass('active');
        $('#main').css({'background-color':'#61A8F8','border':'transparent'});
    });
</script>
</html>