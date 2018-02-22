/**
 * Created by Waky on 1/17/2018.
 */

var filters = {
    'ages' : [],
    'genders' : []
};

$(document).ready(function () {
    console.log("Controller loaded");
    $('.filter-input').bind("change", function () {
        console.log("Somn changed!");

        var val = parseInt($(this).val());
        var isChecked = $(this).prop('checked');
        var forAge = $(this).parents('.age-filters').length > 0;
        var category = forAge ? "ages" : "genders";


        if(isChecked){
            filters[category].push(val);
        }else{
            filters[category].splice(filters[category].indexOf(val), 1);
        }

        filterBooks();
    });
});

function filterBooks(){
    var genders = filters['genders'];
    var subs = filters['ages'];
    $('.product-item').fadeOut();

    var count = 0;
    if(genders.length < 1 && subs.length >= 1){
        $('.product-item').each(function () {
            var age_id = $(this).data('age');
            if(subs.indexOf(age_id) !== -1){
                count++;
                $(this).fadeIn();
            }
        });
    }
    else if(subs.length < 1 && genders.length >= 1){
        $('.product-item').each(function () {
            var gender_id = $(this).data('gender');
            if(genders.indexOf(gender_id) !== -1){
                count++;
                $(this).fadeIn();
            }
        });
    }
    else if(subs.length >= 1 && genders.length >= 1){
        $('.product-item').each(function () {
            var age_id = $(this).data('age');
            var gender_id = $(this).data('gender');
            if(genders.indexOf(gender_id) !== -1 && subs.indexOf(age_id) !== -1){
                count++;
                $(this).fadeIn();
            }
        });
    }else{
        count = 1;
        $('.product-item').fadeIn();
    }

    if(count < 1){
        setTimeout(function(){
            $("#productsGrid").addClass('is-empty');
        }, 200);
    }else{
        setTimeout(function(){
            $("#productsGrid").removeClass('is-empty');
        }, 200);
    }
}

function sortProducts(val){
    var $divs = $(".product-item");
    var orderedDivs = $divs.sort(function (a, b) {
        if(val === "new")
            return $(a).data("date") > $(b).data("date");
        else
            return $(a).data("price") > $(b).data("price");
    });

    $("#productsGrid .row").html(orderedDivs);
}
