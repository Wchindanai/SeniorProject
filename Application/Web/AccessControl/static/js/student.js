/**
 * Created by Dream on 7/23/16.
 */
$(document).ready(function () {
    $(".edit_student").click(function () {
        var value = $(this).val();
        console.log(value);
        $.ajax({
            method : 'POST',
            url : 'ajax_edit_student',
            data : 'SID='+value,
            success : function (data) {
                $(".show_edit").show().html(data);
            }
        })
    });
    $('#search_id').keyup(function (e) {
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

});