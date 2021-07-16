$("#login_btn").click(function(e){
    e.preventDefault();
    console.log('PRIVET');
    let login = $('input[name="login"]').val(),
        password = $('input[name="password"]').val();
    
        $.ajax({
            url: '/login',
            type: 'POST',
            dataType: 'json',
            data: {
                login: login,
                password: password
            
            },
            success(data) {
                if (data.status == true) {
                    window.location.replace("/");
                }
              
            else
            {

                $(".msg_error").removeClass('d-none').text(data.message);
               
            }
            }
        }); 

}); 
//