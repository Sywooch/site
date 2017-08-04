/**
 * Created by Макс on 15.06.2017.
 */


function showCart(cart) {
    $('.modal-body').html(cart);
    $('#cart').modal();
}

$('.purchase').on('click', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '/card/add',
        data: {id: id},
        type: 'GET',
        dataType: 'html',
        success: function (res) {
            showCart(res);
        },
        error: function () {
            alert('error');
        }
    });
});
$('.modal-body').on('click', '.del_product', function (e) {
    e.preventDefault();
    var key=$(this).data('key');
    $.ajax({
        url: '/card/delete',
        data: {key: key, page: 'add'},
        type: 'POST',
        dataType: 'html',
        success: function (res) {
            showCart(res);
        },
        error: function () {
            alert('error');
        }

    });
});
$('#clear_basket').on('click', function () {
    $.ajax({
        url: '/card/clear',

        type: 'POST',
        dataType: 'html',
        success: function (res) {
            showCart(res);
        },
        error: function () {
            alert('error');
        }
    });
});

$('#total').on('click', '.del_product', function (e) {
    e.preventDefault();
    var key=$(this).data('id');
    $.ajax({
        url: '/card/delete',
        data: {key: key, page: 'show'},
        type: 'POST',
        dataType: 'html',
        success: function (res) {
            document.getElementById('total').innerHTML=res;
        },
        error: function () {
            alert('error');
        }

    });
});
function reduceProduct(count, id) {

    if(count>1){
        $.ajax({
            url: '/card/edit',
            data: {id: id, action: -1, page: 'add'},
            type: 'POST',
            dataType: 'html',
            success: function (res) {
                showCart(res);
            },
            error: function () {
                alert('редактирование не удалось');
            }
        });
    }

 }
function reduceProductShow(count, id) {

    if(count>1){

        $.ajax({
            url: '/card/edit',
            data: {id: id, action: -1, page: 'show'},
            type: 'POST',
            dataType: 'html',
            success: function (res) {
                document.getElementById('total').innerHTML=res;
            },
            error: function () {
                alert('редактирование не удалось dddd');
            }
        });
    }

}

$('#total').on('click', '.append', function () {
   var id=$(this).data('id');
   $.ajax({
       url: '/card/edit',
       data: {id: id, action: 1 , page: 'show'},
       type: 'POST',
       dataType: 'html',
       success: function (res) {
           document.getElementById('total').innerHTML=res;
       },
       error: function () {
           alert('редактирование не удалось');
       }
   });
});
// $('#total').on('click', '.reduce', function () {
//     var id=$(this).data('id');
//     $.ajax({
//         url: '/card/edit',
//         data: {id: id, action: 'minus'},
//         type: 'POST',
//         dataType: 'html',
//         success: function (res) {
//             document.getElementById('total').innerHTML=res;
//         },
//         error: function () {
//             alert('редактирование не удалось');
//         }
//     });
// });
$('.modal-body').on('click', '.append', function () {
    var id=$(this).data('id');
    $.ajax({
        url: '/card/edit',
        data: {id: id, action: 1, page: 'add'},
        type: 'POST',
        dataType: 'html',
        success: function (res) {
            showCart(res);
        },
        error: function () {
            alert('редактирование не удалось');
        }
    });
});
// $('.modal-body').on('click', '.reduce', function () {
//     var id=$(this).data('id');
//     $.ajax({
//         url: '/card/edit',
//         data: {id: id, action: 'minus'},
//         type: 'POST',
//         dataType: 'html',
//         success: function (res) {
//             showCart(res);
//         },
//         error: function () {
//             alert('редактирование не удалось');
//         }
//     });
// });