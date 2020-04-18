$(document).ready(function(){
    $('.btn-delete').click(function(){
        $('#deleteModal').modal();
        var current = $('#deleteForm').attr('action');
        var id = $(this).data('id');
        var arrCurr = current.split('/');
        arrCurr[arrCurr.length-1] = id;
        var finalRoute = arrCurr.join('/');
        $('#deleteForm').attr('action',finalRoute);

        $.ajax({
            url:'/api/expenses-category/get-affected-expenses/'+id,
            type:"GET",
            success: function(response){
                var html = '';
                for(responseIndex in response)
                {
                    html += '<li>'+response[responseIndex].name+' - '+response[responseIndex].expense_value+'</li>';
                }

                $('.category-list').html(html);
            }
        });
    });
});