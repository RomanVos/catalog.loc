$(function(){

    $('textarea.editor').ckeditor();

    $('.catalog').dcAccordion();

    $('.cross-times').on('click', function () {
        $('#mes-edit').hide();
        $('#mes-edit .responce').empty();
    });

    $('.edit').each(function (){
        $(this).change(function (){
            var val = $(this).val();
            var title = $(this).attr('name');
            var url = $(this).parents('.zebra').data('table');

            updateField(val, title, url);
        });
    });

    $('.edit-price').change(function (){
        var val = $(this).val();
        var id = $(this).data('id');
        var url = $(this).parents('.zebra').data('table');
        updateField(val, id, url);
    });

    function updateField(val, title, url){
        if( !url ) url = '';
        $.ajax({
            url: path + url,
            type: 'GET',
            data: {val: val, title: title},
            beforeSend: function (){
                $('#loader').fadeIn();
            },
            success: function (res){
                $('#mes-edit .responce').text(res);
                $('#mes-edit').delay(300).fadeIn(1000).delay(1000).fadeOut(3000);
            },
            error: function (){
                alert('Помилка!');
            },
            complete: function (){
                $('#loader').delay(300).fadeOut();
            }
        });
    }

    $('.del').on('click', function (){
        var id = $(this).data('id');
        parent = $(this).closest('tr');
        var url = $(this).parents('.zebra').data('table');
        deleteRow(id, parent, url);
    });

    function deleteRow(id, parent, url){
        var res = confirm('Підтвердіть видалення');
        if(!res) return false;

        $.ajax({
            url: path + url,
            type: 'GET',
            data: {id: id},
            beforeSend: function (){
                $('#loader').fadeIn();
            },
            success: function (res){
                var answer;
                if(res === 'OK'){
                    answer = 'Видалено';
                }else{
                   answer = 'Помилка видалення';
                }
                $('#mes-edit .responce').text(answer);
                $('#mes-edit').delay(300).fadeIn(1000, function (){
                    if(res === 'OK') parent.hide();
                });
            },
            error: function (){
                alert('Помилка!');
            },
            complete: function (){
                $('#loader').delay(300).fadeOut();
            }
        });
    }


});