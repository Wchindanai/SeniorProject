<?php
if(isset($_SESSION['add_device'])) {
    if(!$_SESSION['add_device']){
        echo "<script>window.alert('Cannot Add Device')</script>";
        unset($_SESSION['add_device']);
    }
    else{
        echo "<script>window.alert('Add Device Success')</script>";
        unset($_SESSION['add_device']);
    }
}


?>
<html>
<head>
    <?php include "static/head.php"?>
</head>
<script type="text/javascript">
    $(document).ready(function () {
        $('.edit_ajax').click(function () {
            var deviceID = $(this).val();
            console.log(deviceID);
            $.ajax({
                method: "POST",
                url: "ajax_edit_device",
                data: "deviceId="+deviceID,
                success: function (data) {
                    $("#ajax_edit_device").show().html(data);
                 //  console.log(data);
                }
            })
        })
    });


</script>
<body>
<?php include "static/sidebar.php"?>
<div id="page-content-wrapper">
    <div id="page-content" style="">
        <div class="panel-body">
            <h3 class="title-hero">
                <p style="font-size: 20px">Device</p>
            </h3>
            <div class="example-box-wrapper">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Room Name</th>
                        <th class="text-center">IP</th>
                        <th class="text-center">Location</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1 ;
                            $query = $this->db->get('Device');
                        foreach ($query->result() as $row){
                            echo "<tr>";
                                echo "<th class=\"text-center\">$no</th>";     //no
                                echo "<th class=\"text-center\">$row->roomName</th>";       //Room name
                                echo "<th class=\"text-center\">$row->ip</th>";       //IP
                                echo "<th class=\"text-center\">$row->location</th>";       //Location
                                echo "<th class=\"text-center\">
                                        <button type='button' class='btn btn-primary edit_ajax' value='$row->deviceId' id='edit_device' data-toggle='modal' data-target='#modal_edit_device'>
                                            <i class='glyph-icon icon-pencil'></i>
                                        </button>
                                     </th>";       //edit






                                echo "<th class=\"text-center\">
                                        <form method='post' action='delete_device'>
                                        <button type='submit'onclick=\"return confirm('Are you sure you want to delete?')\" name='delete' class='btn btn-danger' value='$row->deviceId'>
                                            <i class='glyph-icon icon-trash-o'></i>
                                        </button>
                                        </form>
                                      </th>";       //Delete
                            echo "</tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <p></p>
            <div style="text-align: center;">
                <button class="btn btn-hover btn-info" type="button" data-toggle="modal" data-target="#addDevice" style="width: 30%;">
                    <span>Add Device</span>
                    <i class="glyph-icon icon-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<?php include "device/modal.php"?>
</body>
<script src="../../static/assets-minified/bootstrap.js"></script>
<script src="../../static/assets-minified/jquery.mask.js"></script>
<script src="../../static/js/device.js">
</script>
</html>