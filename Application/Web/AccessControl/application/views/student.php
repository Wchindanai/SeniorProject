<?php
    if(isset($_SESSION['add_student'])){
        if(!$_SESSION['add_student']){
            echo "<script> (window).alert('Add Student Fail Duplicate Student ID') </script>";
            unset($_SESSION['add_student']);
        }
        else{
            echo "<script> (window).alert('Add Student Success') </script>";
            unset($_SESSION['add_student']);
        }

    }
?>
<html>
<head>
    <?php include "static/head.php"?>
</head>
<body>
<?php include "static/sidebar.php"; ?>
<div id="page-content-wrapper">
    <div id="page-content" style="">
            <div class="panel-body">
                <h3 class="title-hero">
                    <p class="font-size-20">Student & Permission</p>
                </h3>
                <div class="example-box-wrapper">
                    <ul class="list-group list-group-separator row list-group-icons">
                        <li class="col-md-3 active">
                            <a href="#tab-example-1" data-toggle="tab" class="list-group-item">
                                <i class="glyph-icon font-blue icon-users"></i>
                                Student
                            </a>
                        </li>
                        <li class="col-md-3">
                            <a href="#tab-example-2" data-toggle="tab" class="list-group-item">
                                <i class="glyph-icon font-blue icon-clock-o"></i>
                                Permission
                            </a>
                        </li>
                    </ul>
                    <div class="panel">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-example-1">
                                <?php include "student/student_tab.php"?>
                            </div>
                            <div class="tab-pane fade" id="tab-example-2">
                                <?php include "student/permission.php"?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
</body>
<script src="../../static/assets-minified/bootstrap.js"></script>
<script>
    $(document).ready(function () {
        $('#student').addClass('active');
        $('#student').css({'background-color':'#61A8F8','border':'transparent'});
    });
</script>
</html>