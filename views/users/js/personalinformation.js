$(document).ready(function(){
    // getting data from url
    var url = window.location.href;
    var url_string = new URL(url);
    var cvfileid = url_string.searchParams.get('resume_id');
    
    

    // loadpersonalinfo and put inside the papaer
    function loadpersonalinfoinsidepaper(){
        $.ajax({
            url:'slices/resumeload.php',
            method:'GET',
            data:{action:'personaldata',cvid:cvfileid},
            success:function(response){
                
                $('#paper-personalinfo').html(response);
            }
        })
    }
    loadpersonalinfoinsidepaper();

    // delete from paper
    $(document).on('click','.btn-delete-1',function(){
        const id = $(this).data('id');
        const table = 'personal_info';
        $.ajax({
            url:'slices/resumeload.php',
            method:'GET',
            data:{action:'delete',id:id,tablename:table},
            success:function(response){
                alert(response);
                // console.log(response);
                
                loadpersonalinfoinsidepaper();
                loadpersonalinfo();

            }
        })
    })
   
    // save personal informatino
    $('#personalinfoform').submit(function(event){
        event.preventDefault();
         const fname = $('#fname').val();
        const email = $('#email').val();
        const phone = $('#phone').val();
        const address = $('#address').val();


        $.ajax({
            url:'slices/personalinformation.php',
            method:'POST',
            data:{chosemthod:'save',cvid:cvfileid,fname:fname,email:email,phone:phone,address:address},
            success:function(response){
                const data = JSON.parse(response);
                if(data == 'emptyfullname'){
                    $('#msg').removeClass('d-none');
                    $('#msg').removeClass('bg-success');
                    $('#msg').addClass('bg-danger');
                    $('#msg').html('Empty Fullname Field');

                }else if(data == 'emptyemail'){
                    $('#msg').removeClass('bg-success');

                    $('#msg').removeClass('d-none');
                    $('#msg').addClass('bg-danger');
                    $('#msg').html('Empty Email Field');
                }else if(data == 'emptyphone'){
                    $('#msg').removeClass('bg-success');
                    $('#msg').removeClass('d-none');
                    $('#msg').addClass('bg-danger');
                    $('#msg').html('Empty Phone Field');
                }else if(data == 'emptyaddress'){
                    $('#msg').removeClass('bg-success');
                    $('#msg').removeClass('d-none');
                    $('#msg').addClass('bg-danger');
                    $('#msg').html('Empty Address Field');
                    
                }
                else if(data == 'exists'){
                    $('#msg').removeClass('bg-success');
                    $('#msg').removeClass('d-none');
                    $('#msg').addClass('bg-danger');
                    $('#msg').html('Sorry You Already Fill The Personal Information , You can only update it');
                    $('#personalinfoform')[0].reset();
                    loadpersonalinfoinsidepaper();

                    
                }else{
                    $('#msg').removeClass('d-none');
                    $('#msg').removeClass('bg-danger');
                    $('#msg').addClass('bg-success');
                    $('#msg').html('Personal Information Saved Successfully');
                    loadpersonalinfo();
                    loadpersonalinfoinsidepaper();
                    $('#personalinfoform')[0].reset();

                }
                
            }
        })


        

       


    });

    // display personal information
    function loadpersonalinfo(){
        $.ajax({
            url:"slices/personalinformation.php",
            method:"GET",
            data:{cvid:cvfileid},
            success:function(response){
                $('#personalcontent').html(response);
                
            }
        })
    }

    // calling function
    loadpersonalinfo();


    // update resume
    $('#updatepersonalinfoform').submit(function(event){
        event.preventDefault();
       
        $.ajax({
            url:'slices/personalinformation.php',
            method:'POST',
            data:$('#updatepersonalinfoform').serialize() + '&chosemthod=update',
            success:function(response){
                // console.log(response);
                
                const data = JSON.parse(response);
                // console.log(response);
                
                if(data == 'updatefailed'){
                    $('#updatemsg1').removeClass('d-none');
                    $('#updatemsg1').removeClass('bg-success');
                    $('#updatemsg1').addClass('bg-danger');
                    $('#updatemsg1').html('Failed To Update Personal Information');
                    loadpersonalinfo();
                    loadpersonalinfoinsidepaper();
                }else if(data == 'updatesuccess'){
                    $('#updatemsg1').removeClass('d-none');
                    $('#updatemsg1').removeClass('bg-danger');
                    $('#updatemsg1').addClass('bg-success');
                    $('#updatemsg1').html('Personal Information Data Updated Successfully');
                    loadpersonalinfoinsidepaper();
                    loadpersonalinfo();
                }else{
                    console.log(data);
                    
                }
            }
           })

    })
   
});