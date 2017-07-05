<?php
/**
 * Created by PhpStorm.
 * User: Dream
 * Date: 7/18/16
 * Time: 23:01
 */?>
<div class="modal fade" id="addDevice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="top:80px;" xmlns="http://www.w3.org/1999/html">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Add Device</h4>
            </div>
            <div class="modal-body">
                <form action="add_device" method="post">
                <p>Room Name</p>
                <input type="text" class="form-control" name="room_name" id="room_name" placeholder="Room Name" required>

                <p style="margin-top: 10px;">IP Address</p>
                <input type="text" class="form-control check_ip" name="ip_address" id="ip_address" placeholder="0.0.0.0" required>
                <div id="error_ip" class="alert-error" hidden>! Wrong IP Address</div>

                <p style="margin-top: 10px;">Location</p>
                <input type="text" class="form-control" name="location" id="location" placeholder="Ex. Engineer Building">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="save_device" disabled>Add Device</button>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_edit_device" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="top:80px;" xmlns="http://www.w3.org/1999/html">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Device</h4>
            </div>
            <div class="modal-body">
                <form action="edit_device" method="post">
                <div id="ajax_edit_device"></div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="save_device">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>