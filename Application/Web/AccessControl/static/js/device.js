$(document).ready(function () {
    $('#device').addClass('active');
    $('#device').css({'background-color':'#61A8F8','border-color':'transparent'});
    $('.check_ip').mask('099.099.099.099');
});
$('#ip_address').keyup(function () {
    var ip = $(this).val();
    // console.log(ip);
    if(ip==""){
        $('#save_device').attr('disabled',true);
    }
    else if(ip=="000.000.000.000" || ip == "255.255.255.255"){
        $('#error_ip').slideDown(300);
        $('#save_device').attr('disabled',true);
    }
    else {
        $('#error_ip').slideUp(300);
        $('#save_device').attr('disabled',false);
    }
});

function delte_device() {
    if(confirm("Are You Sure To Delete ?")){
        return true;
    }
    else {
        return false;
    }
}
