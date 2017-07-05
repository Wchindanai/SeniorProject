<div class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="top:80px;" xmlns="http://www.w3.org/1999/html">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Add Device</h4>
            </div>
            <div class="modal-body">
                <form action="add_student" method="post">
                    <p>Student ID</p>
                    <input type="text" class="form-control" name="student_id" id="student_id" placeholder="Input Student ID" required>

                    <p style="margin-top: 10px;">Firstname</p>
                    <input type="text" class="form-control check_ip" name="firstname" id="ip_address" placeholder="Input Firstname" required>

                    <p style="margin-top: 10px;">Lastname</p>
                    <input type="text" class="form-control" name="lastname" id="location" placeholder="Input Lastname" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="save_device">Add Student</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_student" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="top:80px;" xmlns="http://www.w3.org/1999/html">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Add Device</h4>
            </div>
            <form action="edit_student" method="post">
            <div class="modal-body">
                <div class="show_edit"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Change</button>
            </div>
            </form>
        </div>
    </div>
</div>