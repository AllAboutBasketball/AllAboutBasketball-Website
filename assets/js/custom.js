$(document).ready(function () {
    
    $(document).on('click','.increment-btn', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if(value < 10)
        {
            value++;           
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
        
    });

    $(document).on('click','.decrement-btn', function (e) {
      
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if(value > 1)
        {
            value--;           
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
        
    });

    $(document).on('click','.updateQty', function () {

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).closest('.product_data').find('.prodId').val();


        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id" : prod_id,
                "prod_qty" : qty,
                "scope" : "update"
            },
            success: function (response) {
                //alert(response);
            }
        });
    });

    $(document).on('click','.deleteItem', function () {

        var cart_id = $(this).val();
        //alert(cart_id);

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "cart_id" : cart_id,
                "scope" : "delete"
            },
            success: function (response) {
                if(response == 200)
                {
                    alertify.success("Item Removed Successfully");
                    $('#mycart').load(location.href + " #mycart");

                }
                else
                {
                    alertify.success(response);

                }
            }
        });
    });

$("#proceedBtn").click(function() {
        alert('clicked');
        // var selectedItems = [];

        // $(".checkbox-item:checked").each(function() {
        //   selectedItems.push($(this).val());
        // });

        // if (selectedItems.length > 0) {
        //   // Process the selected items
        //   console.log("Selected Items: ", selectedItems);
        //   // You can perform further actions with the selected items here
        //   localStorage.setItem("carts", selectedItems);
        // } else {
        //   console.log("No items selected.");
        // }
      });





    
});

