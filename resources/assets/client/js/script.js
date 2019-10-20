function numberWithCommas(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    return parts.join(".");
}

$(".custom-price").each(function () {
    var num = $(this).text();
    var commaNum = numberWithCommas(num);
    $(this).text(commaNum);
});
