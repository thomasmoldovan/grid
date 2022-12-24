$(document).ready(function () {
    setInputFilter(document.getElementById("quantity"), function(value) {
        return /^\d*$/.test(value); });// Integer >= 0
    setInputFilter(document.getElementById("price"), function(value) {
        return /^-?\d*[.,]?\d{0,2}$/.test(value); });// Currency (at most two decimal places)
    setInputFilter(document.getElementById("old_price"), function(value) {
        return /^-?\d*[.,]?\d{0,2}$/.test(value); });// Currency (at most two decimal places)

    $("#store").change(function() {
        var store_id = $(this).val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/admin/getProductStoreLocation",
            data: {
                "store_id": store_id
            },
            dataType: "json",
            success: function (response) {
                if (response.address != "") {
                    $("#location").val(response.address);
                } else {
                    $("#location").val("None");
                }
            }

        });
    });

    $(".product-image").click(function() {
        var product_id = $(this).data("id");
        var image_path = $(this).attr("src");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/setProductDefaultImage",
            data: {
                "product_id": product_id,
                "image_path": image_path
            },
            dataType: "json",
            success: function (response) {
                window.location.reload();
            }
        });
    });

    flatpickr("#start_date", {
        enableTime: false,
        dateFormat: "Y-m-d H:i",
    });

    flatpickr("#end_date", {
        enableTime: false,
        dateFormat: "Y-m-d H:i",
    });
});