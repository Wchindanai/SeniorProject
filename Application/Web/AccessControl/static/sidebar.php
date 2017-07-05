
<div id="page-header" class="bg-gradient-9">
    <div id="header-logo" class="logo-bg">
        <div style="display: inline-block; text-align: center; padding: 10%;">
            <span class="glyph-icon icon-unlock-alt"></span>
            <span>Access Control</span>
            <a id="close-sidebar" href="#" title="Close sidebar">
                <i class="glyph-icon icon-angle-left"></i>
            </a>
        </div>
    </div>
    <div id="header-nav-left">
        <div class="user-account-btn dropdown">
            <a href="#" title="My Account" class="user-profile clearfix" data-toggle="dropdown">
                <?php echo $_SESSION['name'];?>
                <i class="glyph-icon icon-angle-down" style="margin-left: 5px"></i>
            </a>
            <div class="dropdown-menu float-left">
                <div class="box-sm">
                    <div class="login-box clearfix">
                        <div class="user-info">
                            <span>
                                <?php echo $_SESSION['name'];?>
                                <i>Teacher DPU CE</i>
                            </span>
                        </div>
                    </div>
                    <div class="pad5A button-pane button-pane-alt text-center">
                        <a href="logout" class="btn display-block font-normal btn-danger">
                            <i class="glyph-icon icon-power-off"></i>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- #header-nav-left -->
    <div id="header-nav-right">

        <div class="dropdown" id="notifications-btn">
            <a data-toggle="dropdown" title="">

                <i class="glyph-icon icon-linecons-megaphone"></i>
                <?php
                $this->db->where('LogType != ',0);
                $query = $this->db->get('Log');
                $row = $query -> num_rows();

                if($row == 0){
                    //nothing
                }
                else{
                    echo "<div class=\"bs-badge bg-red badge-absolute\">$row</div>";
                }

                ?>
            </a>
            <div class="dropdown-menu box-md float-right">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;"><div class="scrollable-content scrollable-slim-box" style="overflow: hidden; width: auto; height: 250px;">
                        <ul class="no-border notifications-box">
                            <li>
                                <?php
                                $this->db->where('LogType != ',0);
                                $this->db->order_by('LogTime','DESC');
                                $query = $this->db->get('Log');

                                    foreach ($query->result() as $rows){
                                        echo "<span class=\"bg-danger icon-notification glyph-icon icon-bullhorn\"></span>
                                                 <span class=\"notification-text\">$rows->StudentID Doesn't has permission</span>
                                            <div class=\"notification-time\">
                                                $rows->LogTime
                                                  <span class=\"glyph-icon icon-clock-o\"></span>
                                             </div>
                                            ";
                                    }
                                ?>


                            </li>
                        </ul>
                    </div><div class="slimScrollBar" style="background-color: rgb(141, 160, 170); width: 6px; position: absolute; top: 0px; opacity: 0.4; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 6px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; background-color: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px; background-position: initial initial; background-repeat: initial initial;"></div></div>
                <div class="pad10A button-pane button-pane-alt text-center">
                    <a href="clearNoti" onclick="confirm('Are you sure to clear notification');" class="btn btn-primary" title="View all notifications">
                        Clear Notification
                    </a>
                </div>
            </div>
        </div>
    </div><!-- #header-nav-right -->
</div>
<div id="page-sidebar" aria-expanded="false" class="collapse" style="height: 345px;">
    <div class="scroll-sidebar" style="height: 345px;">
        <ul id="sidebar-menu" class="">
            <li>
                <span>Menu</span>
            </li>
            <div class="list-group font-size-18" >
                <!--Status-->
                <a href="main" class="list-group-item" id="main">
                    <i class="glyph-icon font-blue-alt icon-dashboard" style="color: #00BCA6;"></i>
                    Status
                    <i class="glyph-icon font-blue-alt icon-chevron-right" style="color: #00BCA6;"></i>
                </a>
                <!--Device-->
                <a href="device" class="list-group-item" id='device'>
                    <i class="glyph-icon font-blue-alt icon-gears"></i>
                    Device
                    <i class="glyph-icon font-blue-alt icon-chevron-right"></i>
                </a>
                <!--Stat-->
                <a href="stat" class="list-group-item" id="stat">
                    <i class="glyph-icon font-blue-alt icon-bar-chart-o"></i>
                    Stat
                    <i class="glyph-icon font-blue-alt icon-chevron-right"></i>
                </a>
                <!--Student-->
                <a href="student" class="list-group-item" id="student">
                    <i class="glyph-icon font-blue-alt icon-users"></i>
                    Student
                    <i class="glyph-icon font-blue-alt icon-chevron-right"></i>
                </a>
            </div>
        </ul>
    </div>
</div>