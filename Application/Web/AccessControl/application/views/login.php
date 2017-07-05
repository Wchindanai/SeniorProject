<html>
<head>
    <link rel="stylesheet" href="../../static/assets-minified/bootstrap.css">
    <link rel="stylesheet" href="../../static/css/login.css">
    <script src="../../static/assets-minified/js-core.js"></script>
</head>
<?php
    if(isset($_SESSION['login'])){
        if($_SESSION['login']==false){
            if($_SESSION['count']==1){
                echo "<script>
                        $(document).ready(function() {
                            $('#login-username').css('border-color','#EC4A42');
                            $('#error_username').slideDown(300);
                            $('#login-username').click(function() {
                                 $('#error_username').slideUp(300);
                             });
                        });
                        console.log('Wrong Username');
            </script>";
            }
            else if($_SESSION['count']==2){
                $username = $_SESSION['username'];
                echo "<script>
                        $(document).ready(function() {
                            $('#login-username').val('$username');
                            $('#login-password').css('border-color','#EC4A42');
                            $('#error_password').slideDown(300);
                            $('#login-password').click(function() {
                                 $('#error_password').slideUp(300);
                             });
                        });
                        console.log('Wrong Password');
            </script>";
            }
        }

    }

?>

<style>
    body{
        background: -webkit-linear-gradient(45deg, #0077b5, #008891);
        background: -moz-linear-gradient(45deg, #0077b5, #008891);
        background: -o-linear-gradient(45deg, #0077b5, #008891);
        background: linear-gradient(45deg, #0077b5, #008891);
        background-attachment: fixed;
        background-color: #0077b5;
    }
</style>
<body>
<div class="container">
    <div id="loginbox" style="margin-top:13%;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Sign In</div>
            </div>

            <div style="padding-top:30px" class="panel-body" >

                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                <form id="loginform" class="form-horizontal" role="form" method="post" action="checkLogin">

                    <div style="" class="input-group">
                        <span class="input-group-addon"><i class="glyph-icon icon-linecons-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="username" placeholder="username">
                    </div>
                    <div id="error_username" class="alert-error" hidden>! Wrong Username</div>

                    <div style="margin-top: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon icon-linecons-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <div id="error_password" class="alert-error" hidden>! Wrong Password</div>
                    <div style="margin-top:25px" class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <button class=" btn btn-success" type="submit">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>