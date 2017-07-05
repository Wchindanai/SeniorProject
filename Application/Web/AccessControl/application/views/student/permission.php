<?php
/**
 * Created by PhpStorm.
 * User: Dream
 * Date: 7/23/16
 * Time: 13:29
 */
?>
<link rel="stylesheet" href="../../static/css/student.css">
<div class="panel-body">
    <h3 class="title-hero center-div font-size-18">
        Permission
    </h3>
    <div class="example-box-wrapper">
        <div class="input-group center-div" style="width: 300px; margin-top: 10px;">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search Student ID." id="search_permission">
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
                <th>Select</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $query = $this->db->get('Student');
            $i=1;
                foreach ($query->result() as $row ){
                    echo "<tr>
                            <td>$i</td>
                            <td>$row->StudentID</td>
                            <td>$row->StudentFirstname</td>
                            <td>$row->StudentLastname</td>
                            <td>  <input type='checkbox' name='student_per[]' class='per_id' value='$row->StudentID'></td>
                          </tr>";
                    $i++;
                }
            ?>
            </tbody>
        </table>
    </div>
</div>
<div class="center-div">
    <button type="button" class="btn btn-primary glyph-icon icon-arrow-circle-down" data-toggle="modal" data-target="#permission_modal" id="add_per" disabled></button>
</div>
<div id="table_permission">

</div>

<?php include "permission_modal.php" ?>

<script src="../../static/js/permission.js"></script>
