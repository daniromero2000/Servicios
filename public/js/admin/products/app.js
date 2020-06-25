$(document).ready(function () {

    $(function () {
        $("#skuProduct").on('focusout', searchProduct)
    });
    function searchProduct() {
        var skuValue = $(this).val();

        $.get('/api/getProduct/productList/' + skuValue + '', function (data) {
            $('#name').val('');
            $('#reference').val('');
            if (data[0]) {
                console.log(data[0].item)
                var nameProduct = data[0].item;
                var referenceProduct = data[0].item + data[0].sku;
                $('#name').val(nameProduct);
            }
        });
    }



});

function idproduct(dataId) {
    console.log(dataId + 'datalead')
    $("#sku_update" + dataId).on('focusout', searchProductUpdate(dataId))
}

function searchProductUpdate(dataId) {
    console.log(dataId)
    var skuValue = $("#sku_update" + dataId).val();
    $.get('/api/getProduct/productList/' + skuValue + '', function (data) {
        console.log(data)
        $('#name_update' + dataId).val('');
        $('#reference_update' + dataId).val('');
        if (data[0]) {

            console.log(data[0].item)
            var nameProduct = data[0].item;
            var referenceProduct = data[0].item + data[0].sku;

            $('#name_update' + dataId).val(nameProduct);
        }
    });
};