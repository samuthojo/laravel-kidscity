/**
 * Created by Waky on 2/14/2018.
 */
var ages = [];
var genders = [];

$(document).ready(function () {
    console.log("Controller loaded");
    $('.filter-input').bind("change", function () {
        var val = parseInt($(this).val());
        var isChecked = $(this).prop('checked');

        var cat = $(this).data('filter-what');

        switch (cat){
            case "age":
                if(isChecked)
                    ages.push(val);
                else
                    ages.splice(ages.indexOf(val), 1);

                vue_app.$refs.shop.setSelectedAges(ages);

                break;

            case "gender":
                if(isChecked)
                    genders.push(val);
                else
                    genders.splice(genders.indexOf(val), 1);

                vue_app.$refs.shop.setSelectedGenders(genders);

                break;
        }
    });
});