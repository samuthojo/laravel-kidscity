var cart_count = parseInt($("#miniCartToggle .count").text());

$(document).on("click", ".product", function(event) {

    return !(event.target.nodeName === "button" || $(event.target).parents("button").length > 0);
});

function addToCart(e, id, qty){
    if($("#product-" + id).hasClass('added')){
        return removeFromCart(e, id);
    }

    $("#product-" + id).addClass('loading');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    addItemToCart(id, qty, function (success, res) {
        $("#product-" + id).removeClass('loading');

        if(!success){
            showMessage("Couldn't add item to cart!");
            return;
        }

        if(res.success){
            $("#product-" + id).addClass('added');
            $("#cartItems").removeClass('is-empty');
            $("#checkoutArea").removeClass('disabled');

            if($("#cartCount").get(0))
                $("#cartCount").get(0).setAttribute("data-badge", res.count);

            $("#cartSubTotal").text(res.subtotal);
            showMessage("Item added to cart!");
        }
        else
            showMessage(res.msg);
    });
}

//ADD TO CART
function addItemToCart(id, qty, callback){
    var url= window.Laravel.base_url + '/addToCart';
    var remarkJSONObj = {
        'id': id,
        'qty' : qty
    };
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type		:'POST',
        url         :url,
        data        : remarkJSONObj,
        dataType    : 'json',
        success     : function(res) {
            callback(true, res);
        },
        error: function (err) {
            console.log(err);
            callback(false);
        }
    });
}

//SET QTY
function setQty(id, qty, callback){
    var url= window.Laravel.base_url + '/setQty';
    var remarkJSONObj = {
        'id': id,
        'qty' : qty
    };
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type		:'POST',
        url         :url,
        data        : remarkJSONObj,
        dataType    : 'json',
        success     : function(res) {
            if(res.success){
                showMessage("Item price updated!");
                callback(true, res);
            }
            else
                callback(true, res)
        },
        error: function (err) {
            console.log(err);
            showMessage("Couldn't change item price!");
            callback(false);
        }
    });
}


function removeFromCart(e, id){
    $("#product-" + id).addClass('loading');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    removeItemFromCart(id, function (success, res) {
        $("#product-" + id).removeClass('loading');

        if(!success){
            showMessage("Couldn't remove item from cart!");
            return;
        }

        if(res.success){
            $("#product-" + id).removeClass('added');
            $("#product-" + id).addClass('removed');
            showMessage("Item removed from cart!");
            if(!res.count){
                $("#cartItems").addClass('is-empty');
                $("#checkoutArea").addClass('disabled');
            }

            if($("#cartCount").get(0))
                $("#cartCount").get(0).setAttribute("data-badge", res.count);
            $("#cartSubTotal").text(res.subtotal);
        }
        else
            showMessage(res.msg);
    });
}

function removeItemFromCart(id, callback){
    var url= window.Laravel.base_url + '/removeFromCart';

    var remarkJSONObj = {
        'id': id
    };
    $.ajax({
        type		:'POST',
        url         :url,
        data        : remarkJSONObj,
        dataType    : 'json',
        success     : function(res) {
            callback(true, res);
        },
        error: function (err) {
            console.log(err);
            callback(false);
        }
    });
}