$(document).ready(function(){

    // Increment the quantity of the product
    $(document).on('click','.increment-btn', function(e) {
        e.preventDefault();
        var qty = $(this).closest('.product_data').find('.input_qty').val();
        // alert(qty);
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if(value < 10){
            value++;
            $(this).closest('.product_data').find('.input_qty').val(value);
        }
    });

    // decrement the quantity of the product
    $(document).on('click','.decrement-btn', function(e) {
        e.preventDefault();
        var qty = $(this).closest('.product_data').find('.input_qty').val();
        // alert(qty);
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if(value > 1){
            value--;
            $(this).closest('.product_data').find('.input_qty').val(value);
        }
    });

    // This part is for add to card button
    $(document).on('click','.addToCartbtn', function(e) {
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input_qty').val();
        var product_id = $(this).val();
        // alert(product_id);

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                 "product_id": product_id,
                 "prod_qty": qty,
                 "scope": "add"
            },
            success: function(response) {
                if(response == 201)
                {
                    $('#navcount').load(location.href + " #navcount");
                    alertify.success("Product added to cart");
            
                }
                else if(response == "Existing")
                {
                    alertify.warning("Product already in cart");
                }
                else if(response == 401)
                {
                    alertify.success("LOG IN TO CONTINUE");
                }
                else if(response == 500)
                {
                    alertify.success("Something went wrong");
                }
            }
        }); 
    });

    // This part is for add to wishlist button
    $(document).on('click','.addToWishlistbtn', function(e) {
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input_qty').val();
        var product_id = $(this).val();
        // alert(product_id);

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                 "product_id": product_id,
                 "prod_qty": qty,
                 "scope": "addwishlist"
            },
            success: function(response) {
                if(response == 201)
                {
                    alertify.success("Product added to Wishlist");
                    $('#navwishlist').load(location.href + " #navwishlist");
                }
                else if(response == "Existing")
                {
                    alertify.warning("Product already in Wishlist");
                }
                else if(response == 401)
                {
                    alertify.success("LOG IN TO CONTINUE");
                }
                else if(response == 500)
                {
                    alertify.success("Something went wrong");
                }
            }
        }); 
    });

    $(document).on('click','.updateQty', function() {
        var qty = $(this).closest('.product_data').find('.input_qty').val();
        var product_id = $(this).closest('.product_data').find('.prodId').val();
        
        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data:{
                "product_id": product_id,
                "prod_qty": qty,
                "scope": "update"
            },
            success: function (response) {
                // alert(response);
            }
        });
    });

    $(document).on('click','.deleteItem', function () {
        var cart_id = $(this).val();
        // alert(cart_id);

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data:{
                "cart_id": cart_id,
                "scope": "delete"
            },
            success: function (response) {
                if(response == 200)
                {
                    alertify.success("Item remove successfully");
                    $('#navcount').load(location.href + " #navcount");
                    $('#mycart').load(location.href + " #mycart");
                } else {
                    alertify.success(response);
                }
            }
        });
    });

    // Delete wishlist Item
    $(document).on('click','.deleteItemWishlist', function () {
        var cart_id = $(this).val();
        // alert(cart_id);

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data:{
                "cart_id": cart_id,
                "scope": "deleteWishlist"
            },
            success: function (response) {
                if(response == 200)
                {
                    alertify.success("Item remove from wishlist");
                    $('#navwishlist').load(location.href + " #navwishlist");
                    $('#mycart').load(location.href + " #mycart");
                } else {
                    alertify.success(response);
                }
            }
        });
    });

});
