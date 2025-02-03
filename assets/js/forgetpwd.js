$(document).ready(function(){


    // lookup if email exist in database
    $('#lookupform').submit(function(event){
        event.preventDefault();
        const email = $('#email').val();
        $.ajax({
            url:'../includes/forget_pwd.php',
            method:'POST',
            data:{action:'lookup',email:email},
            success:function(response){
                const data = JSON.parse(response);
                if(data == 'emptyemail'){
                    $('#msg01').removeClass('d-none');
                    $('#msg01').removeClass('bg-success');
                    $('#msg01').addClass('bg-danger');
                    $('#msg01').html('Empty Email  Field');
                }else if(data == 'notexist'){
                    $('#msg01').removeClass('d-none');
                    $('#msg01').removeClass('bg-success');
                    $('#msg01').addClass('bg-danger');
                    $('#msg01').html('Sorry , There is no user with that specified email');
                }else if(data == 'failed'){
                    $('#msg01').removeClass('d-none');
                    $('#msg01').removeClass('bg-success');
                    $('#msg01').addClass('bg-danger');
                    $('#msg01').html('Failed to send email , please try again later');
                }else if(data =='success'){
                    $('#msg01').removeClass('d-none');
                    $('#msg01').removeClass('bg-danger');
                    $('#msg01').addClass('bg-success');
                    $('#msg01').html('Email sent Successfully, please check your mail provide for the instructions');
                    window.location.href='../forget_pwd.php';
                }else{
                    console.log(data);
                    
                }
                
            }
        })
    })


    // update password
    $('#updatepwd').submit(function(event){
        event.preventDefault();
        const code = $('#v-code').val();
        const pwd = $('#pwd').val();

        $.ajax({
            url:'../includes/forget_pwd.php',
            method:'POST',
            data:{action:'changepwd',vcode:code,pwd:pwd},
            success:function(response){
                const data = JSON.parse(response);
                if(data == 'emptyvcode'){
                    $('#msg02').removeClass('d-none');
                    $('#msg02').removeClass('bg-success');
                    $('#msg02').addClass('bg-danger');
                    $('#msg02').html('Empty Verification Code Field');
                }else if(data =='emptypwd'){
                    $('#msg02').removeClass('d-none');
                    $('#msg02').removeClass('bg-success');
                    $('#msg02').addClass('bg-danger');
                    $('#msg02').html('Empty New Password Field');
                }else if(data =='notfound'){
                    $('#msg02').removeClass('d-none');
                    $('#msg02').removeClass('bg-success');
                    $('#msg02').addClass('bg-danger');
                    $('#msg02').html('verification code is not valid');
                }else if(data == 'incorrectcode'){
                    $('#msg02').removeClass('d-none');
                    $('#msg02').removeClass('bg-success');
                    $('#msg02').addClass('bg-danger');
                    $('#msg02').html('verification code is not valid');
                }else if(data == 'failed'){
                    $('#msg02').removeClass('d-none');
                    $('#msg02').removeClass('bg-success');
                    $('#msg02').addClass('bg-danger');
                    $('#msg02').html('Sorry , failed to update your password , please try again later');
                }else if(data == 'notauthorized'){
                    $('#msg02').removeClass('d-none');
                    $('#msg02').removeClass('bg-success');
                    $('#msg02').addClass('bg-danger');
                    $('#msg02').html('Sorry , you are not authorized ');
                    window.location.href='../forget_pwd.php';
                }else if(data == 'success'){
                    $('#msg02').removeClass('d-none');
                    $('#msg02').removeClass('bg-danger');
                    $('#msg02').addClass('bg-success');
                    $('#msg02').html('Account recovered successfully, please wait we are redirecting you to the login page');
                    window.location.href='../login.php';
                }else {
                    console.log(data);
                    
                }
            }
        })
    })
})