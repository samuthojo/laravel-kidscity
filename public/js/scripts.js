var cart_count = parseInt($("#miniCartToggle .count").text());

$('a[href*="#"]')
// Remove links that don't actually link to anything
.not('[href="#"]')
.not('[href="#0"]')
.click(function(event) {
    // On-page links
    if (
        location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '')
        &&
        location.hostname === this.hostname
    ) {
        // Figure out element to scroll to
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        // Does a scroll target exist?
        if (target.length) {
            // Only prevent default if animation is actually gonna happen
            event.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top
            }, 1000, function() {
                // Callback after animation
                // Must change focus!
                var $target = $(target);
                $target.focus();
                if ($target.is(":focus")) { // Checking if the target was focused
                    return false;
                } else {
                    $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                    $target.focus(); // Set focus again
                };
            });
        }
    }
});


var controller = new ScrollMagic.Controller();
// new ScrollMagic.Scene({triggerElement: '#sectionQuote', triggerHook: 1, duration: '1200'})
//     .setTween(TweenMax.to('#quoteImage', 1, {y: '-40%', ease: Power0.easeNone}))
//     //        .addIndicators()
//     .addTo(controller);

new ScrollMagic.Scene({
    triggerElement: '#sectionActivities',
    triggerHook: 0.5
})
    .setClassToggle("#titlePlaceHolder", "show")
    .addTo(controller);


new ScrollMagic.Scene({
    triggerElement: '#sectionActivities',
    triggerHook: 0.5
})
    .setClassToggle("#mainNav", "thin")
    .addTo(controller);


var navController = new ScrollMagic.Controller({globalSceneOptions: {duration: "102%"}});

new ScrollMagic.Scene({
    triggerElement: '#sectionBanner'
})
    .setClassToggle("#homeLink", "active")
    .addTo(navController);

new ScrollMagic.Scene({
    triggerElement: '#sectionAbout'
}).setClassToggle("#aboutLink", "active")
    .addTo(navController);

new ScrollMagic.Scene({
    triggerElement: '#sectionActivities'
}).setClassToggle("#activityLink", "active")
    .addTo(navController);

new ScrollMagic.Scene({
    triggerElement: '#sectionTeam'
}).setClassToggle("#teamLink", "active")
    .addTo(navController);

new ScrollMagic.Scene({
    triggerElement: '#sectionEvents'
}).setClassToggle("#eventLink", "active")
    .addTo(navController);

new ScrollMagic.Scene({
    triggerElement: '#sectionBlogs'
}).setClassToggle("#blogLink", "active")
    .addTo(navController);

new ScrollMagic.Scene({
    triggerElement: '#sectionContacts'
}).setClassToggle("#contactLink", "active")
    .addTo(navController);




/*EVENT ROLLER*/
var cur_idx = 0;
var max_idx = 3;
var OUTER_W = window.innerWidth - 590 - 65;

console.log(OUTER_W);

function nextEvent() {
    if(cur_idx < max_idx){
        cur_idx = cur_idx + 1;
        updateButtons();
    }
}


function prevEvent() {
    if(cur_idx > 0){
        cur_idx = cur_idx - 1;
        updateButtons();
    }
}

var activeComplete = function () {
    $("#eventsImagesList")
        .find(".active").removeClass("active");
};

var nextComplete = function () {
    $("#eventsImagesList")
        .find(".next")
        .removeClass("next")
        .addClass("active");
};

function updateButtons() {
    var scroll_per = (cur_idx * - OUTER_W);
    TweenMax.to('#eventsList', 0.35, {x: scroll_per + 'px', ease: Power0.easeNone});
    if(cur_idx > 0)
        $("#prevEventButton").addClass("active");
    else
        $("#prevEventButton").removeClass("active");

    if(cur_idx < max_idx){
        $("#nextEventButton").addClass("active");
    }else{
        $("#nextEventButton").removeClass("active");
    }

    $("#eventsImagesList").find("div").eq(cur_idx).addClass("next");

    TweenMax.to('#eventsImagesList .active', 0.15, {opacity: 0, ease: Power0.easeNone, onComplete: activeComplete});
    TweenMax.to('#eventsImagesList .next', 0.35, {opacity: 1, ease: Power0.easeNone, onComplete: nextComplete});
}


// var CLIENT_ID = "949057dfe8594cccb08bb0c8f00d7ab1";
// accessToken: '94764.1677ed0.c6256a27eddf41709ddf29af3469a4e5',
// userId: 94764,

var CLIENT_ID = "3fa87b3a894243cdb641147b2759913e";
var feed = new Instafeed({
    get: 'user',
    // userId: 2281507809,
    userId: 365389321,
    limit: '4',
    resolution: 'standard_resolution',
    // target: 'instagram',
    // links: 'false',
    accessToken: '365389321.3fa87b3.12e7697c6c37422e9c072d013a1bc0e7',
    sortby: 'random',
    template: '<a href="{{link}}" target="_blank" comments="{{comments}}" likes="{{likes}}" class="image layout center-center"><img src="{{image}}" /></a>',
    after: function() {
        console.log("Insta Loading complete!");
        // $("#instafeed .temp").each(function () {
        //     $(this).remove();
        // })
        $(".image.temp").remove();
    }
});

window.onload = function() {
    // feed.run();
};

// window._sharedData.entry_data.ProfilePage[0].user.id

function initMap() {
    var opt = { minZoom: 17, maxZoom: 17 };

    var map1 = new google.maps.Map(document.getElementById('siteMap'), {
        zoom: 17,
        center: {lat: -6.7561356, lng: 39.2468857}
    });


    map1.setOptions(opt);

    var image = 'images/marker.png';

    var marker = new google.maps.Marker({
        position: {lat: -6.7561356, lng: 39.2468857},
        map: map1,
        icon: image
    });

}


// CREATE EMAIL FROM USER
function sendEmail(e){
    if(e) e.preventDefault();

    $(".ipf-button")
        .attr('disabled','disabled');

    var username=$('#fullname');
    var email=$('#email');
    var message=$('#message');
    var subject="Hello Buni Divaz";
    // var to="info@activetotzone.com";
    // var to="graysonjulius@gmail.com";
    var to="wakyj07@gmail.com";


    if(validateEmail($.trim(email.val()))){
        $(".ipf-button").html('<i class="fa fa-spinner" aria-hidden="true" style="line-height: 2"></i>')
        var remarkJSONObj = {
            'userName': $.trim(username.val()),
            'email': $.trim(email.val()),
            'message': $.trim(message.val()),
            '_token' : window.Laravel.csrfToken,
            'to'      : $.trim(to),
            'subject': $.trim(subject)
        };

        $.ajax({
            type		:'POST',
            url         : mail_url,
            data        : remarkJSONObj,
            dataType    : 'json',
            success     : function(res) {
                $(".ipf-button").html("SUBMIT MESSAGE").removeAttr('disabled');
                console.log(res);

                if(res.success){
                    showMessage("Thankyou " + username.val().split(" ")[0] + ", we have received your message.");

                    email.val("");
                    username.val("");
                    message.val("");
                }else{
                    $('#feedback-error')
                        .html("Sorry! Something prevented the message from reaching us. Please try again.")
                        .css({"visibility":"visible" });
                }
            }
        });


    }else{
        alert("Please tell us something cool.");
        $('#feedback-error')
            .html("Sorry!Message failed,<br/>Fill in all fields with correct values")
            .css({"color":"red",
                "visibility":"visible" });
        $("#send-feedback").html('SUBMIT MESSAGE')
            .removeAttr('disabled');
    }


}
function validateEmail(sEmail) {
    var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else if(sEmail==""){
        return true;
    }
    else {
        return false;
    }
}


//ADD TO CART
function addToCart(e, id, qty){
    e.target.setAttribute("disabled", "disabled");
    e.target.innerText = "Adding...";

    var url='addToCart';
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
            e.target.removeAttribute("disabled");
            e.target.innerText = "add to cart";

            if(res.success){
                cart_count+=1;
                $("#product-" + id).addClass('added');
                $("#cartItems").removeClass('is-empty');
                $("#checkoutArea").removeClass('disabled');
                $("#miniCartToggle .count").text(res.count);
                $("#cartSubTotal").text(res.subtotal);
                showMessage("Item added to cart!");
            }
            else
                showMessage(res.msg);
        },
        error: function (e) {
            console.log(e);
            e.target.removeAttribute("disabled");
            e.target.innerText = "add to cart";

            showMessage("Couldn't add item to cart!");
        }
    });
}

//ADD TO CART
function setQty(id, qty){
    var url='setQty';
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
                $("#miniCartToggle .count").text(res.count);
                $("#cartSubTotal").text(res.subtotal);
            }
            else
                showMessage(res.msg);
        },
        error: function (e) {
            console.log(e);
            showMessage("Couldn't change item price!");
        }
    });
}

function removeFromCart(e, id){
    e.target.setAttribute("disabled", "disabled");
    e.target.innerText = "Removing...";

    var url='removeFromCart';
    var remarkJSONObj = {
        'id': id
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
            e.target.removeAttribute("disabled");
            e.target.innerText = "remove";

            if(res.success){
                $("#product-" + id).removeClass('added');
                $("#product-" + id).addClass('removed');
                showMessage("Item removed from cart!");
                if(!res.count){
                    $("#cartItems").addClass('is-empty');
                    $("#checkoutArea").addClass('disabled');
                }
                $("#miniCartToggle .count").text(res.count);
                $("#cartSubTotal").text(res.subtotal);
            }

            else
                showMessage(res.msg);
        },
        error: function () {
            e.target.removeAttribute("disabled");
            e.target.innerText = "remove";
            showMessage("Couldn't remove item from cart!");
        }
    });
}