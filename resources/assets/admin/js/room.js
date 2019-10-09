function validation() {
    let sale_price = $('#sale_price').val();
    let sale_start_at = $('#sale_start_at').val();
    let sale_end_at = $('#sale_end_at').val();
    let listRoomsNumner = JSON.parse($('#listRoomsNumber').val());
    if (sale_start_at.length || sale_end_at.length != 0) {
        if (sale_price.length == 0) {
            $('.sale_price_errors').text('Vui lòng không bỏ trống nếu bạn đặt lịch khuyến mãi');
            $('.sale_start_at_errors').text('');
            $('.sale_end_at_errors').text('');
            return false;
        }
        if (sale_start_at.length == 0) {
            $('.sale_price_errors').text('');
            $('.sale_start_at_errors').text('Vui lòng không bỏ trống nếu bạn đặt lịch khuyến mãi');
            $('.sale_end_at_errors').text('');
            return false;
        }
        if (sale_end_at.length == 0) {
            $('.sale_price_errors').text('');
            $('.sale_start_at_errors').text('');
            $('.sale_end_at_errors').text('Vui lòng không bỏ trống nếu bạn đặt lịch khuyến mãi');
            return false;
        }
    }

    let listUsed = [];
    $("input[name='room_number[]']").map(function () {
        let value = $(this).val();

        if (listRoomsNumner.find(item => item == value)) {
            listUsed.push(value);
        }
    });

    if (listUsed.length > 0) {
        $('#errors-room-number').text(`Các số phòng sau đã được sử dụng ${listUsed.join()}`);

        return false;
    }

}

$(".m_repeater").repeater({
    initEmpty: !1, show: function () {
        $(this).slideDown();
    }, hide: function (e) {
        $(this).slideUp(e)
    }
});

$('.my-datepicker').datepicker({
    todayHighlight: !0,
    autoclose: !0,
    format: "mm/dd/yyyy"
});

$('#description').summernote({
    height: 400,
    toolbar: [
        ['style', ['fontname', 'bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['picture', 'link', 'video', 'table', 'hr']],
        ['color', ['color']],
        ['height', ['height']],
        ['misc', ['codeview', 'undo', 'redo']]
    ]
});