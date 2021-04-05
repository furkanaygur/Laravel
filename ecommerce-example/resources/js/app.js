require('./bootstrap');


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.minus, .add').on('click', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    var piece = $(this).attr('data-piece');
    $.ajax({
        type: 'PATCH',
        url: '/cart/update/'+id,
        data: {
            piece : piece
        },
        success: function () {
            window.location.href= '/cart';
        }
    })
});