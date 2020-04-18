$(document).ready(function(){
    $('.btn-delete').click(function(){
        $('#deleteModal').modal();
        var current = $('#deleteForm').attr('action');
        var id = $(this).data('id');
        var arrCurr = current.split('/');
        arrCurr[arrCurr.length-1] = id;
        var finalRoute = arrCurr.join('/');

        $('#deleteForm').attr('action',finalRoute);

    });
});