$(function(){

    $('#autocomplete').autocomplete({
        source: path + 'search/',
        minLength: 1,
        select: function ( event, ui){
            window.location = path + 'search/?search=' + encodeURIComponent(ui.item.value);
        }
    });

    //highlight
    if(search != ''){
        $('.product h1').highlight(search);
    }


    $('.catalog').dcAccordion();

    $('#forgot-link').click(function(){
        $('#auth').fadeOut(300, function(){
            $('#forgot').fadeIn();
        });
        return false;
    });

    $('#auth-link').click(function(){
        $('#forgot').fadeOut(300, function(){
            $('#auth').fadeIn();
        });
        return false;
    });

    //Реєстрація
    $(".access").change(function () {
        var $this = $(this);
        var val = $.trim($this.val());
        var dataField = $this.attr('data-field');
        var span = $this.next();

        span.removeClass();
        if(val == ''){
            span.addClass('reg-cross');
            span.next().text('Заповніть поле');
        }else{
            span.addClass('reg-loader');
            $.ajax({
                url: path + 'registration',
                type: 'POST',
                data: {val: val, dataField: dataField},
                success: function(res){
                    var result = JSON.parse(res);
                    span.removeClass();
                    span.next().text('');
                    if( result.answer == 'no' ){
                        span.addClass('reg-cross');
                        span.next().text(result.info);
                    }else{
                        span.addClass('reg-check');
                    }
                }
            });
        }

    });


});