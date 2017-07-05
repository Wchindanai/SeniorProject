<html>
<head>
    <?php include "static/head.php"?>
<!--    <script src="../../addon/browser.min.js"></script>-->

</head>
<body>
<?php include "static/sidebar.php"; ?>
<div id="page-content-wrapper">
    <div id="page-content">
        <p>Select Time</p>
        <div id="content">
        </div>
        <div id="graph"></div>
    </div>
</div>
</body>
<script src="../../static/assets-minified/bootstrap.js"></script>
<script src="../.././static/js/stat.js"></script>
<script>
    $(document).ready(function () {
        $('#stat').addClass('active');
        $('#stat').css({'background-color':'#61A8F8','border':'transparent'});
    });

</script>

</html>