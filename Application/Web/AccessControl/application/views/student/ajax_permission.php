<table class="table table-hover" style="margin-top: 20px">
    <thead>
    <th>No.</th>
    <th>Date</th>
    <th>Time</th>
    <th>Day Of Week</th>
    <th>Student</th>
    <th>Edit</th>
    <th>Delete</th>
    </thead>
    <tbody>
    <?php
    $i =1;
$query = $this->db->get('Permission');
foreach ($query -> result() as $row){
    echo
    "
        <tr>
            <td>$i</td>
            <td>$row->RecordStartDate - $row->RecordEndDate</td>
            <td>$row->RecordStartTime - $row->RecordEndTime</td>
            <td>$row->RecordDoW</td>
            <td><button class='btn btn-default per_stu' value='$row->RecordID' data-toggle='modal' data-target='#perStudentModal' type='button' ><i class='glyph-icon icon-user'></i></button></td>
            <td><button class='btn btn-primary per_edit' value='$row->RecordID' data-toggle='modal' data-target='#edit_permission' type='button'><i class='glyph-icon icon-pencil'></i></button></td>
            <td><button class='btn btn-danger del_per'  value='$row->RecordID'><i class='glyph-icon icon-trash-o'></i></button></td>
        </tr>





";
    $i++;
}
?>
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $('button.del_per').click(function () {
            var val = $(this).val();
            var bool = confirm('Are you sure to delete this permission');
            if(bool){
                $.ajax({
                    method: 'POST',
                    url: 'del_per',
                    data: {recordID: val},
                    success: function () {
                        permission_table();
                    }
                });
            }
        });
        $('button.per_stu').click(function () {
            var val = $(this).val();
            selectID = $(this).val();
            $.ajax({
                method : 'POST',
                url: 'per_stu',
                data : 'PID='+val,
                success: function (data) {
                    $('#perStudent').show().html(data);
                }
            })
        });
        $('.per_edit').click(function () {
            var val = $(this).val();
            $.ajax({
                url : 'edit_permission',
                method : 'post',
                data :  {PID:val},
                success : function (data) {
                    $('#edit-permission').show().html(data);
                }
            })
        })
    });

</script>
