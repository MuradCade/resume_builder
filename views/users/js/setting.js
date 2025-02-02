$(document).ready(function(){


    function loadprofileinfo(){
        $.ajax({
            url:'slices/update_personalinfo.php',
            method:'GET',
            success:function(response){
                const data = JSON.parse(response);
                $('#username').val(data['username']);
                $('#email').val(data['email']);
                // console.log(response);
                
            }
        })
    }


    loadprofileinfo();

    // update personal information
$('#Personalinfoform').submit(function(event){
    event.preventDefault();

    $.ajax({
        url:'slices/update_personalinfo.php',
        method:'POST',
        data:$('#Personalinfoform').serialize(),
        success:function(response){
            const data = JSON.parse(response);
            if(data == 'emptyusername'){
                $('#msg1').removeClass('d-none');
                $('#msg1').removeClass('bg-success');
                $('#msg1').addClass('bg-danger');
                $('#msg1').html('Username field is empty');
            }else if(data == 'updatefailed'){
                $('#msg1').removeClass('d-none');
                $('#msg1').removeClass('bg-success');
                $('#msg1').addClass('bg-danger');
                $('#msg1').html('Sorry update failed');
            }else if(data =='updatesuccess'){
                $('#msg1').removeClass('d-none');
                $('#msg1').removeClass('bg-danger');
                $('#msg1').addClass('bg-success');
                $('#msg1').html('Profile Information Updated Successfully');
                loadprofileinfo();
            }else{
                console.log(data);
                
            }
            
        }
    })
})




    // update password
    $('#updatepassword').submit(function(event){
        event.preventDefault();
        $.ajax({
            url:'slices/changepassword.php',
            method:'POST',
            data:$('#updatepassword').serialize(),
            success:function(response){
                const data = JSON.parse(response);

                if(data == 'emptypassword'){
                    $('#msg2').removeClass('d-none');
                    $('#msg2').removeClass('bg-success');
                    $('#msg2').addClass('bg-danger');
                    $('#msg2').html('Empty New Password Feild');
                    $('#updatepassword')[0].reset();
                }else if(data == 'updatefailed'){
                    $('#msg2').removeClass('d-none');
                    $('#msg2').removeClass('bg-success');
                    $('#msg2').addClass('bg-danger');
                    $('#msg2').html('Sorry , failed to update');
                    $('#updatepassword')[0].reset();

                }else if(data == 'updatesuccess'){
                    $('#msg2').removeClass('d-none');
                    $('#msg2').removeClass('bg-danger');
                    $('#msg2').addClass('bg-success');
                    $('#msg2').html('Password Updated Successfully');
                    $('#updatepassword')[0].reset();

                }else{
                    console.log(data);
                    $('#updatepassword')[0].reset();

                    
                }
            
            }
        })
    })
})