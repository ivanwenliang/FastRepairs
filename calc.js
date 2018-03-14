$(document).ready(function(){
    var total = 0, labor=0, partstotal=0;

    $('.parts').change(function(){
        $('.parts').each(function(){
            if($(this).val() != '')
            {
                partstotal += parseInt($(this).val());
            }
        });
        $('#partstotal').html(partstotal);
    });

    $('.mult').change(function(){
        $('.mult').each(function(){
            if($(this).val() != '')
            {
                labor += parseInt($(this).val()) * 20;
            }
        });
        $('#labor').html(labor);
    })

    $('.calc').change(function(){       
        $('.calc').each(function(){
            total = 50 + labor + partstotal;
        });
        $('#total').html(total);
    });

    
})(jQuery);