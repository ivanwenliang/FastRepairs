$(document).ready(function(){
    $('.calc').change(function(){
        var total = 0;
        $('.calc').each(function(){
            if($(this).val() != '')
            {
                total += parseInt($(this).val());
            }
        });
        $('#total').html(total);
    });
})(jQuery);