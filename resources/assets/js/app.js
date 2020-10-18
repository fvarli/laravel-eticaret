
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');

setTimeout(function () {
    $('.alert-message').slideUp(500);
},5000);

$.ajaxSetup({
   headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});

$('.decrease-product-piece, .increase-product-piece').on('click', function () {
    let id = $(this).attr('data-id');
    let piece = $(this).attr('data-piece');
    $.ajax({
        type: 'PATCH',
        url: '/box/update/' + id,
        data:{piece: piece},
        success: function () {
            window.location.href='/box';
        }
    })
});
