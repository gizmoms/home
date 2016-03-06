$(document).ready(function(){
    $('#newProduct-name-select').change(function() {
        var width = $(this).width();
        var chosen = $("option:selected", this).text();
        $(this).next("#newProduct-name-select")
            .css({ "margin-left": -width - 3, width: width - 25 })
            .toggleClass("hidden", chosen != 'neues Produkt');
    });
});