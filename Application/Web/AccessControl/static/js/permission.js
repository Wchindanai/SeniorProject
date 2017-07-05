$('#search_permission').keyup(function (e) {
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

var student_id = new Array();
$('.per_id').click(function () {
    student_id = new Array();
    $('.per_id:checked').each(function () {
        student_id.push($(this).val());
    });
    for (var x in student_id){
        //console.log(val[x]);
    }
    if(student_id.length != 0){
        $("#add_per").attr('disabled',false);
    }
    else {
        $("#add_per").attr('disabled',true);
    }

});

var dow = [] ;
var monday = 0;
var tueday = 0;
var wednesday = 0;
var thursday = 0;
var friday = 0 ;
var saturday = 0 ;
var sunday = 0 ;



function mon() {
    if(monday == 0){
        monday=1;
        $('#monday').addClass('activeMon');
    }
    else if(monday == 1){
        monday = 0;
        $('#monday').removeClass('activeMon')
    }

}
function tue() {
    if(tueday == 0){
        tueday=1;
        $('#tueday').addClass('activeTue');
    }
    else if(tueday == 1){
        tueday = 0;
        $('#tueday').removeClass('activeTue')
    }
}
function wed() {
    if(wednesday == 0){
        wednesday=1;
        $('#wednesday').addClass('activeWed');
    }
    else if(wednesday == 1){
        wednesday = 0;
        $('#wednesday').removeClass('activeWed')
    }
}
function thur() {
    if(thursday == 0){
        thursday=1;
        $('#thursday').addClass('activeThur');
    }
    else if(thursday == 1){
        thursday = 0;
        $('#thursday').removeClass('activeThur')
    }
}

function fri() {
    if(friday == 0){
        friday=1;
        $('#friday').addClass('activeFri');
    }
    else if(friday == 1){
        friday = 0;
        $('#friday').removeClass('activeFri')
    }
}

function sat() {
    if(saturday == 0){
        saturday=1;
        $('#saturday').addClass('activeSat');
    }
    else if(saturday == 1){
        saturday = 0;
        $('#saturday').removeClass('activeSat')
    }
}

function sun() {
    if(sunday == 0){
        sunday=1;
        $('#sunday').addClass('activeSun');
    }
    else if(sunday == 1){
        sunday = 0;
        $('#sunday').removeClass('activeSun')
    }
}

function validate_permission(){
    var deviceIp = $("#roomId").val();
    dow = new Array();
    var date = $('#daterangepicker-example').val();
    if(date == " "){
        console.log("error date");
        return;
    }
    date = date.split('-');
    date = new Array(date[0].split(' '),date[1].split(' '));
   // console.log(date);
    start_date = date[0][0].split('/');
    end_date = date[1][1].split('/');
   // console.log(start_date+" "+end_date);
    sdate = start_date[2]+"-"+start_date[0]+"-"+start_date[1];
    edate = end_date[2]+"-"+end_date[0]+"-"+end_date[1];
   // console.log("Start "+sdate+" end "+edate);
    var from = $('#from_time').val();
    var to = $('#to_time').val();
    time = check_time(from, to);
    if(!time){
        return;
    }
    validate_dow();
    if(dow.length == 0){
        console.log("Error Date");
        return;
    }
    $.ajax({
        method:'POST',
        url: 'add_per',
        data:{
            sid:student_id,
            sdate:sdate,
            edate:edate,
            from_time:from,
            to_time:to,
            dow:dow,
            deviceIP: deviceIp
        },
        success:function (response) {
           console.log(response);
        }
    });
    permission_table();
    clear_modal();
    $('#permission_modal').modal('hide');
}

function validate_dow() {
    if(monday==1){
        dow.push('Monday');
    }
    if(tueday==1){
        dow.push('Tuesday');
    }
    if(wednesday==1){
        dow.push('Wednesday');
    }
    if(thursday==1){
        dow.push('Thursday');
    }
    if(friday==1){
        dow.push('Friday');
    }
    if(saturday==1){
        dow.push('Saturday');
    }
    if(sunday==1){
        dow.push('Sunday');
    }
}

$(document).ready(function () {
    $('#from_time').mask('99:99:00');
    $('#to_time').mask('99:99:00');
    permission_table();


});
function check_time(from,to){
    from = $('#from_time').val();
    to = $('#to_time').val();
    //console.log("From "+from+" to."+to+" length"+to.length);
    if(to.length<5){
    }
    else {
        if(to <= from){
            $('#error_time').slideDown(300);
            return false;
            console.log('Error Time');
            //$('#save_permission').attr('disabled',true);
        }
        else{

            $('#error_time').slideUp(300);
            return true;
            //$('#save_permission').attr('disabled',false);
        }
    }
}
function clear_modal() {
    $('#daterangepicker-example').val('');
    $('#from_time').val('');
    $('#to_time').val('');
    monday=1;tueday=1;wednesday=1;thursday=1;friday=1;saturday=1;sunday=1;
    mon();tue();wed();thur();fri();sat();sun();
}

function permission_table() {
    $.ajax({
        url: 'get_per',
        success: function (data) {
            $('#table_permission').show().html(data);
        }

    });
}

$('.addStudent').click(function () {
    $.ajax({
        url: 'addPerStu',
        success: function (data) {
            $('#addPerStu').html(data);
        }
    });
});
var selectID;
function addStudentPer() {
    $.ajax({
        url : 'add_stu_per',
        method : 'POST',
        data : {sid : asid, pid : selectID},
        success : function (data) {
            console.log(data);
            $('#addPerStudent').modal('toggle');
            $('#perStudentModal').modal('toggle');
            permission_table();
        }
    });
}






function showModalAdd(){
    $('.modal-backdrop').remove();
    showAddStudent();
}
function showAddStudent() {
    $('#addPerStudent').modal('toggle');
}

/**
 * Created by Dream on 7/25/16.
 */
