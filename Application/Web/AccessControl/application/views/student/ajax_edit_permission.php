<?php
    $this->db->where('RecordID',$pid);
    $query = $this->db->get('Permission');
    $row = $query->row();
?>
<script>
    var mo = 0 ,
        tu = 0 ,
        we = 0 ,
        th = 0 ,
        fr = 0 ,
        sa = 0 ,
        su = 0 ;
    $(document).ready(function () {
        var date = $('#date-hide').val();
        date = date.split('/');
        date = new Array(date[0].split('-'),date[1].split('-'));
        sdate = date[0][1]+'/'+date[0][2]+'/'+date[0][0] ;
        edate = date[1][1]+'/'+date[1][2]+'/'+date[1][0] ;
        $('#edit_date').val(sdate+' - '+edate);

        //console.log('Sdate: '+sdate+' Edate: '+edate)
    });
</script>
<input type="text" id="per_id" value="<?php echo $row->RecordID?>" hidden>
<input type="text" id="dows" hidden value="<?php echo $row->RecordDoW ?>">
<input type="text" id="date-hide" value="<?php echo $row->RecordStartDate?>/<?php echo $row->RecordEndDate?>" hidden>
<div class="form-group">
    <b class="" style=" font-size: 15px;">Permission Date</b>
    <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon">
                                        <i class="glyph-icon icon-calendar"></i>
                                    </span>
        <input type="text" name="daterange" id="edit_date" class="form-control" value='' placeholder="M/D/Y - M/D/Y" required>
    </div>
</div>
<div style="margin-top: 20px;">
    <b style=" font-size: 15px;">Permission Time</b>
    <div class="form-group">
        <label class="col-sm-1 control-label" style="margin-top: 9px;">From</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="edit_time" value="<? echo $row->RecordStartTime?>" placeholder="00:00:00">
        </div>
        <label class="col-sm-1 control-label" style="margin-top: 9px;">To.</label>
        <div class="col-sm-5" style="left: -18px">
            <input type="text" class="form-control" id="edit_to_time" value="<? echo $row->RecordEndTime?>" placeholder="24:00:00">
            <div class="error_time" id="error_edit_time" hidden>Wrong Time</div>
        </div>
    </div>
    <div style="margin-top: 50px; font-size: 15px;">
        <b>Days Of Week</b>
        <div>
            <a href="#" class="circle monday">Monday</>
            <a href="#" class="circle tuesday">Tuesday</a>
            <a href="#" style="font-size: 18px;" class="circle wednesday">Wednesday</a>
            <a href="#" class="circle thursday">Thursday</a>
            <a href="#" class="circle friday">Friday</a>
            <a href="#" class="circle saturday">Saturday</a>
            <a href="#" class="circle sunday">Sunday</a>
        </div>
    </div>
    <div style="margin-top: 40%; width: 300px">
        <b>Room :</b>
        <select class="form-control" id="edit_roomId">
            <?php
            $query = $this->db->get("Device");
            foreach ($query -> result() as $rows){
                echo "<option value='$rows->ip'>$rows->roomName</option>";
            }
            ?>
        </select>
    </div>
</div>


<script src="../../static/assets/widgets/daterangepicker.js"></script>
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
<script>

    var dows = $('#dows').val();
    $(document).ready(function () {
        $('#edit_time').mask('99:99:00');
        $('#edit_to_time').mask('99:99:00');
        dows = dows.split('/');
        for (var a in dows){
            if(dows[a]=='Monday'){
                mo = 1;
                $('.monday').addClass('activeMon');
            }
            else if(dows[a]=='Tuesday'){
                tu = 1 ;
                $('.tuesday').addClass('activeTue');
            }
            else if(dows[a]=='Wednesday'){
                we = 1 ;
                $('.wednesday').addClass('activeWed');
            }
            else if(dows[a]=='Thursday'){
                th = 1;
                $('.thursday').addClass('activeThur');
            }
            else if (dows[a]=='Friday'){
                fr = 1 ;
                $('.friday').addClass('activeFri');
            }
            else if (dows[a]=='Saturday'){
                sa = 1 ;
                $('.saturday').addClass('activeSat');
            }
            else if (dows[a]=='Sunday'){
                su = 1;
                $('.sunday').addClass('activeSun');
            }
        }
        $('.monday').click(function () {
            if(mo==0){
                mo=1;
                $(this).addClass('activeMon');
                //console.log(mond);
            }
            else if(mo==1){
                mo=0;
                $(this).removeClass('activeMon');
                //console.log(mond);
            }
        });
        $('.tuesday').click(function () {
            if(tu==0){
                tu=1;
                $(this).addClass('activeTue');
                //console.log(mond);
            }
            else if(tu==1){
                tu=0;
                $(this).removeClass('activeTue');
                //console.log(mond);
            }
        });
        $('.wednesday').click(function () {
            if(we==0){
                we=1;
                $(this).addClass('activeWed');
                //console.log(mond);
            }
            else if(we==1){
                we=0;
                $(this).removeClass('activeWed');
                //console.log(mond);
            }
        });
        $('.thursday').click(function () {
            if(th==0){
                th=1;
                $(this).addClass('activeThur');
                //console.log(mond);
            }
            else if(th==1){
                th=0;
                $(this).removeClass('activeThur');
                //console.log(mond);
            }
        });
        $('.friday').click(function () {
            if(fr==0){
                fr=1;
                $(this).addClass('activeFri');
                //console.log(mond);
            }
            else if(fr==1){
                fr=0;
                $(this).removeClass('activeFri');
                //console.log(mond);
            }
        });
        $('.saturday').click(function () {
            if(sa==0){
                sa=1;
                $(this).addClass('activeSat');
                //console.log(mond);
            }
            else if(sa==1){
                sa=0;
                $(this).removeClass('activeSat');
                //console.log(mond);
            }
        });
        $('.sunday').click(function () {
            if(su==0){
                su=1;
                $(this).addClass('activeSun');
                //console.log(mond);
            }
            else if(su==1){
                su=0;
                $(this).removeClass('activeSun');
                //console.log(mond);
            }
        });

    });
</script>
<script>
    var dows = new Array;
    function edit_per() {
        var deviceip =  $("#edit_roomId").val();
        var id = $('#per_id').val();
        // console.log('id ='+id);
        var time = $('#edit_time').val();
        var to_time = $('#edit_to_time').val();
        // console.log('Time ='+time+' To_time='+to_time);
        if(time > to_time){
            $('#error_edit_time').slideDown(300);
            return ;
        }
        var date = $('#edit_date').val();
//        console.log('Date = '+date);
        if(date == " "){
            console.log("error date");
            return;
        }
        date = date.split('-');
        date = new Array(date[0].split(' '),date[1].split(' '));
        // console.log(date);
        var start_date = date[0][0].split('/');
        var end_date = date[1][1].split('/');
        // console.log(start_date+" "+end_date);
        var sdate = start_date[2]+"-"+start_date[0]+"-"+start_date[1];
        var edate = end_date[2]+"-"+end_date[0]+"-"+end_date[1];
       // console.log("Start "+sdate+" end "+edate);
        push_dow();
        $.ajax({
            url : 'edit_per',
            method : 'post',
            data : {
                id : id,
                time : time,
                to_time: to_time,
                sdate: sdate,
                edate: edate,
                dow:dows,
                deviceIP:deviceip
            },
            success : function (data) {
                console.log(data);
                permission_table();
            }
        });
        $('#edit_permission').modal('hide');

    }
    function push_dow() {

        if(mo==1){
            dows.push('Monday');
        }
        if(tu==1){
            dows.push('Tuesday');
        }
        if(we==1){
            dows.push('Wednesday');
        }
        if(th==1){
            dows.push('Thursday');
        }
        if(fr==1){
            dows.push('Friday');
        }
        if(sa==1){
            dows.push('Saturday');
        }
        if(su==1){
            dows.push('Sunday');
        }

    }
</script>

