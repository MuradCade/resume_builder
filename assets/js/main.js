$(document).ready(function(){
    // alert('helo world');
    // singup user
    $('#signupform').submit(function(event){
        event.preventDefault();
        $('#actualbutton').addClass('d-none');
        $('#waitingbtn').removeClass('d-none');
        const username = $('#username').val();
        const email = $('#email').val();
        const password = $('#password').val();

        $.ajax({
            url:"../includes/signup.inc.php",
            method:'POST',
            data:{username:username,email:email,password:password},
            success:function(response){
               
              
                const data = JSON.parse(response);
                if(response == 'emptyusername'){
                    $('#actualbutton').addClass('d-none');
                    console.log('empty username field');
                    $('#msgdisplay').show()
                    $('#msgdisplay').html('empty username field');
                }
                else if(data == 'emptyemail'){
                    $('#msgdisplay').show()
                    $('#msgdisplay').html('empty email field');
                }
                else if(data == 'emptypwd'){
                    // console.log('');
                    $('#msgdisplay').show()
                    $('#msgdisplay').html('empty password field');
                }else if(data == 'exists'){
                    $('#msgdisplay').show()
                    $('#msgdisplay').html('A user with the specified email already exists.');
                }
                else if(data == 'success'){
                    $('#msgdisplay').hide();
                   
                 
                    window.location.href='email_verification.php';
                }else{
                    $('#actualbutton').show();
                    $('#msgdisplay').show()
                    $('#msgdisplay').html(data)
                    
                }
                
            },
            complete:function(responses){
                $('#actualbutton').removeClass('d-none');
                $('#waitingbtn').addClass('d-none');
            }
        })
    })
})