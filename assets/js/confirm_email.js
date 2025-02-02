$(document).ready(function(){
   
    $('#emailverify').submit(function(event){
        event.preventDefault();
        $('#actualbutton').addClass('d-none');
        $('#waitingbtn').removeClass('d-none');
        const verificationcode = $('#verificationcode').val();
          
            $.ajax({
                url:'../includes/confirm_email.inc.php',
                method:"POST",
                data:{verificationcode:verificationcode},
                success:function(response){
                    
                    const data = JSON.parse(response);
                    // console.log(data);
                    
                    if(data == 'emptyverificationcode'){
                        $('#emailmessage').hide();
                        $('#msgdisplay').show();
                        $('#msgdisplay').html('Empty Verification Code Field');
                    }else if(data == 'codeerror'){
                        $('#emailmessage').hide();
                        $('#msgdisplay').show();
                        $('#msgdisplay').html('Sorry, In Valid Verification Code');
                    }else if(data == 'success'){
                        $('#msgdisplay').hide();
                        window.location="login.php";
                    }
                    else{
                        $('#msgdisplay').hide();
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