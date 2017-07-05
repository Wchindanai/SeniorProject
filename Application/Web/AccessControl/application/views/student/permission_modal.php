<?php
/**
 * Created by PhpStorm.
 * User: Dream
 * Date: 7/25/16
 * Time: 00:51
 */

?>
<script type="text/javascript" src="../../static/assets/widgets/moment.js"></script>
<script type="text/javascript" src="../../static/assets/widgets/moment-with-locales.js"></script>


<div class="modal fade" id="permission_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="top:30px; " xmlns="http://www.w3.org/1999/html">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Add Permission</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <b class="" style=" font-size: 15px;">Permission Date</b>
                        <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon">
                                        <i class="glyph-icon icon-calendar"></i>
                                    </span>
                            <input type="text" name="daterange" id="daterangepicker-example" class="form-control" value="" placeholder="M/D/Y - M/D/Y" required>
                        </div>
                </div>
                <div style="margin-top: 20px;">
                    <b style=" font-size: 15px;">Permission Time</b>
                    <div class="form-group">
                        <label class="col-sm-1 control-label" style="margin-top: 9px;">From</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="from_time" placeholder="00:00:00">
                        </div>
                        <label class="col-sm-1 control-label" style="margin-top: 9px;">To.</label>
                        <div class="col-sm-5" style="left: -18px">
                            <input type="text" class="form-control" id="to_time" placeholder="24:00:00">
                            <div class="error_time" id="error_time" hidden>Wrong Time</div>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 50px; font-size: 15px;">
                    <b>Days Of Week</b>
                    <div>
                        <a href="#" id="monday"  onclick="mon()" class="circle">Monday</>
                        <a href="#" id="tueday" onclick="tue()" class="circle">Tuesday</a>
                        <a href="#" id="wednesday" onclick="wed()" style="font-size: 18px;" class="circle">Wednesday</a>
                        <a href="#" id="thursday" onclick="thur()" class="circle">Thursday</a>
                        <a href="#" id="friday" onclick="fri()" class="circle">Friday</a>
                        <a href="#" id="saturday" onclick="sat()" class="circle">Saturday</a>
                        <a href="#" id="sunday" onclick="sun()" class="circle">Sunday</a>
                    </div>
                </div>
                <div style="margin-top: 40%; width: 300px">
                    <b>Room :</b>
                    <select class="form-control" id="roomId">
                        <?php
                        $query = $this->db->get("Device");
                        foreach ($query -> result() as $rows){
                            echo "<option value='$rows->ip'>$rows->roomName</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer" style="margin-top: 5%">
                <button type="submit" onclick="validate_permission()" class="btn btn-primary" id="save_permission">Add Permission</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="perStudentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="top:30px; " xmlns="http://www.w3.org/1999/html">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Student</h4>
            </div>
            <div class="modal-body">
                <div id="perStudent"></div>
                <div style="text-align: right; margin-right: 60px;">
                    <button class="btn btn-danger" onclick="delPerStu()" id="delPerStudent" type="button" disabled><i class="glyph-icon icon-trash-o"></i></button>
                </div>

                <div style="text-align: center;">
                    <button class="btn btn-hover btn-info addStudent"  type="button" onclick="showModalAdd()" style="width: 30%; margin-top: 20px;">
                        <span>Add Student</span>
                        <i class="glyph-icon icon-arrow-right"></i>
                    </button>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addPerStudent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="top:30px; " xmlns="http://www.w3.org/1999/html">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Add Student</h4>
            </div>
            <div class="modal-body">
                <div id="addPerStu"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="AStudent" onclick="addStudentPer()" disabled>Add Student</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_permission" tabindex="-1" role="dialog" aria-label="myModalLable" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title">Edit Permission</h4>
            </div>
            <div class="modal-body" style="height: 440px">
                    <div id="edit-permission"></div>

            </div>
            <div class="modal-footer">
                <button type="button" onclick="edit_per()" class="btn btn-primary">Save Change</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--<script type="text/javascript" src="../../static/assets/widgets/daterangepicker.js"></script>-->
<link rel="stylesheet" type="text/css" href="../../static/assets/widgets/daterangepicker.css">
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<!--<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />-->



<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });
        $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });

</script>