$(document).ready(function(){
    $('#loginform').submit(function(event){
        event.preventDefault();
        $('#actualbutton').addClass('d-none');
        $('#waitingbtn').removeClass('d-none');
        const email = $('#email').val();
        const password = $('#password').val();

    $.ajax({
        url:"../includes/login.inc.php",
        method:"POST",
        data:{email:email,password:password},
        success:function(response){
            const data = JSON.parse(response);
            if(data == 'emptyemail'){
                $('#messagedisplayer').show();
                $('#messagedisplayer').html('Empty email field');
                
            }else  if(data == 'emptypassword'){
                $('#messagedisplayer').show();
                $('#messagedisplayer').html('Empty password field');
                
            }
            else  if(data == 'usernotfound'){
                $('#messagedisplayer').show();
                $('#messagedisplayer').html('Sorry , there is no user with the specified email');
                
            }else if(data == 'failed'){
                $('#messagedisplayer').show();
                $('#messagedisplayer').html('Wrong Email or Password');
                
            }else if(data == 'success'){
                    window.location.href='includes/authchecker.php';
            }else{
                console.log(data);
                
            }
            
        },
        complete:function(responses){
            $('#actualbutton').removeClass('d-none');
            $('#waitingbtn').addClass('d-none');
        }
    })
    });
});