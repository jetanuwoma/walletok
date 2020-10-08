
var currencies = {};
$(document).ready(function () {
    fetch('token-status').then(response => response.json()).then(function(details) {
        if(details.hasToken == 0) {
           $('.token-form').modal({
            backdrop: 'static',
            keyboard: false
           });
        }
    })

    
});

$('.show-balance').on('click', function(){
    const type = $(this).attr('type');
    if (checkBalance(type) == false ) {
        $('.token-check').modal({
            backdrop: 'static',
            keyboard: false
        });
    } else {
        $('.'+type).html(checkBalance(type));
        $(this).hide();
    }
});

$('.submit-token-check').on('click', function() {
    const token = $('.token-text').val();
    if (token.length < 4) {
        alert('Invalid pin');
    } else {
        fetch('checkpin',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({token})
        }).then(response => response.json())
        .then(function(data) {
            console.log(data)
            if ('hasError' in currencies) {
                $('.token-text').val('')
               alert('Wrong pin')
            } else {
                $('.token-text').val('')
                currencies = data;
            }
            $('.token-check').modal('hide');
        }).catch(function(){
            $('.token-check').modal('hide')
            alert('error occur');
        });
    }
});

function checkBalance(type) {
  if (type in currencies) {
      return currencies[type];
  } else {
      return false;
  }
}
