<table class="table table-hover">
    <thead>
    <tr>
        <th>No</th>
        <th>Student No</th>
        <th>Student Name</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
<?php
    $i=1;
    $query = $this->db->query('SELECT Student.StudentID, Student.StudentFirstname, Student.StudentLastname FROM Student, StudentRecord WHERE Student.StudentID = StudentRecord.StudentID AND StudentRecord.RecordID = '.$pid);
    foreach ($query -> result() as $row){
        echo "<tr>
            <td>$i</td>
            <td>$row->StudentID</td>
            <td>$row->StudentFirstname  $row->StudentLastname</td>
            <td><input type='checkbox' class='checkStudent' name='delStudent[]' value=$row->StudentID></td>
            <input type='text' hidden value=$pid class='psid'>
            </tr>
";
$i++;
    }
?>
    </tbody>
</table>
<script>
    var x = new Array;
    $('.checkStudent').click(function () {
        x = new Array;
        $('.checkStudent:checked').each(function () {
            x.push($(this).val());
        });
        if(x.length != 0){
            $('#delPerStudent').attr('disabled',false);
        }
        else {
            $('#delPerStudent').attr('disabled',true);
        }
    });

    function delPerStu() {
        var pid = $('.psid').val();
        $.ajax({
            method : 'post',
            url : 'delPerStudent',
            data : {delStudent:x, PID:pid},
            success : function () {
                $('#perStudentModal').modal('hide');
                permission_table();
            }
        });
    }

</script>
