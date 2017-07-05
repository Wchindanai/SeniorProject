<?php
/**
 * Created by PhpStorm.
 * User: Dream
 * Date: 7/19/16
 * Time: 23:39
 */?>
<div class="panel-body">
    <h3 class="title-hero center-div font-size-18">
        Student
    </h3>
    <div class="example-box-wrapper">
        <div class="input-group center-div" style="width: 300px; margin-top: 10px;">

            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search Student ID." id="search_id">
                <span class="input-group-addon bg-primary">
                    <i class="glyph-icon icon-search"></i>
                </span>
            </div>
        </div>

        <table class="table table-hover" style="margin-top: 20px;">
            <thead>
            <tr>
                <th>No.</th>
                <th>Student ID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Edit</th>
                <th>Select</th>
            </tr>
            </thead>
            <form action="delte_student" method="post">
                <tbody>
                <?php
                $query = $this->db->get('Student');
                $i =1;
                foreach ($query -> result() as $row){
                    echo "
                        <tr>
                            <td>$i</td>
                            <td>$row->StudentID</td>
                            <td>$row->StudentFirstname</td>
                            <td>$row->StudentLastname</td>
                            <td>
                                <button type='button' class='btn btn-primary edit_student' value='$row->StudentID' data-toggle='modal' data-target='#edit_student'>
                                    <i class='glyph-icon icon-pencil'></i>
                                </button>
                            </td>
                            <td>
                               <input type='checkbox' name='student[]' class='check_id' value='$row->StudentID'>
                            </td>
                        </tr>
                        ";
                    $i++;
                }
                ?>
                </tbody>
            </table>
        <div style="margin-top: -2%; margin-left: 87%;">
         <button class="btn btn-danger" id="delete_button" onclick="return confirm('Are you sure you want to delete?')" type="submit" disabled><i class="glyph-icon icon-trash-o"></i></button>
        </div>
        </form>
        <div style="text-align: center;">
            <button class="btn btn-hover btn-info"  type="button" data-toggle="modal" data-target="#addStudent" style="width: 30%; margin-top: 20px;">
                <span>Add Student</span>
                <i class="glyph-icon icon-arrow-right"></i>
            </button>
        </div>
    </div>
</div>


<?php include "student_modal.php"; ?>
<script src='../../static/assets-minified/jquery.mask.js'></script>
<script>
    $(".check_id").click(function () {
        console.log($(this).val());
        $('#delete_button').attr('disabled',false);
    });
    $(document).ready(function () {
        $('#student_id').mask('999999999999');
    });

</script>
<script src="../../static/js/student.js"></script>


