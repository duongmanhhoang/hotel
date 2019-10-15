function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#is_image').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#select_image").change(function () {
    readURL(this);
});


function numberWithCommas(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    return parts.join(".");
}

$(".price").each(function () {
    var num = $(this).text();
    var commaNum = numberWithCommas(num);
    $(this).text(commaNum);
});
