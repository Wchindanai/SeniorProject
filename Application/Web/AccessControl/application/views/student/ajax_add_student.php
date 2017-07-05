<div class="input-group">
    <input type="text" class="form-control" placeholder="Search Student ID." id="search_id_per">
    <span class="input-group-addon bg-primary">
                    <i class="glyph-icon icon-search"></i>
                </span>
</div>

<table class="table table-hover" style="margin-top: 10px">
    <thead>
    <tr>
        <th>No.</th>
        <th>Student No.</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Select</th>
    </tr>
    </thead>
    <tbody>
        <?php
        $query = $this->db->get('Student');
        $i =1 ;
        foreach ($query -> result() as $row){
            echo "
                <tr>
                    <td>$i</td>
                    <td>$row->StudentID</td>
                    <td>$row->StudentFirstname</td>
                    <td>$row->StudentLastname</td>
                    <td><input type='checkbox' name='ASID' class='ASID' value=$row->StudentID></td>
                </tr>
            ";
            $i++;
        }
        ?>
    </tbody>
</table>

<script>
    $('#search_id_per').keyup(function (e) {
        if ('' != this.value) {
            var reg = new RegExp(this.value, 'i'); // case-insesitive

            $('.table tbody').find('tr').each(function() {
                var $me = $(this);
                if (!$me.children('td').text().match(reg)) {
                    $me.hide();
                } else {
                    $me.show();
                }
            });
        } else {
            $('.table tbody').find('tr').show();
        }
    });
    var asid = new Array;
    $('.ASID').click(function () {
        asid = new Array;
        $('.ASID:checked').each(function () {
            asid.push($(this).val());
        });
        if(asid.length != 0 ){
            $('#AStudent').attr('disabled',false);
        }
        else {
            $('#AStudent').attr('disabled',true);
        }
        //console.log(asid);
    });
</script>