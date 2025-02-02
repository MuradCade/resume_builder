$(document).ready(function(){

    function loadcvfiles(){
        $.ajax({
            url:'slices/cvfile.php',
            method:'GET',
            success:function(response){
                $('#resumes').html(response);
            }
        })
    }

    loadcvfiles();

     //create new cv 
    $('#cvfileform').submit(function(event){
        $('#actualbutton').addClass('d-none');
        $('#waiting').removeClass('d-none');
        // alert('helo');
        event.preventDefault();
        const cvfilename = $('#cvfilename').val();
        
        $.ajax({
            url:'slices/createcvfile.php',
            method:'POST',
            data:{cvfilename:cvfilename},
            success:function(response){
            const data = JSON.parse(response);

            if(data == 'emptycvname'){
                $('#msg').removeClass('bg-success');
                $('#msg').removeClass('d-none');
                $('#msg').addClass('bg-danger');
                $('#msg').html('Empty Resume File Name Field');
                $('#cvfileform')[0].reset();


            }else if(data == 'success'){
                $('#msg').removeClass('d-none');
                $('#msg').removeClass('bg-danger');
                $('#msg').addClass('bg-success');
                $('#msg').html('Resume Name Saved Successfully');
                $('#cvfileform')[0].reset();
                $('#exampleModal').hide();  // Hides the modal
                $('.modal-backdrop').fadeOut(); 
         
                 loadcvfiles();

            }else if(data == 'failed'){
                $('#msg').removeClass('bg-success');
                $('#msg').removeClass('d-none');
                $('#msg').addClass('bg-danger');
                $('#msg').html('Failed to save resume name');
                $('#cvfileform')[0].reset();
                
                 loadcvfiles();
           
                
            }else if(data =='alreadyexist'){
                $('#msg').removeClass('bg-success');
                $('#msg').removeClass('d-none');
                $('#msg').addClass('bg-danger');
                $('#msg').html('Sorry , resume name is already taken');
                $('#cvfileform')[0].reset();

                
            }else{
                console.log(data);
                
            }
                
            },
            complete:function(errors){
                $('#waiting').addClass('d-none');
                $('#actualbutton').removeClass('d-none');
                
            }
        })
    })

    // display cv title before update in update form
    $(document).on('click','.btn-edit',function(){
        const cvid = $(this).data('id');
        
        // cvfilename
        $.ajax({
            url:'slices/singlecvfile.php',
            method:'POST',
            data:{cvid:cvid},
            success:function(response){
                const data = JSON.parse(response);
                if(data == 'emptydbfile'){
                    $('#msg').removeClass('d-none');
                    $('#msg').html('cv not found');
                }else{
                    
                    $('#updatetitle').val(data['title']);
                    $('#updatecvfile').data('id',cvid);
                }
                // console.log(data);
            }
        })
    })


    // update cv title
    $('#updatecvfile').submit(function(event){
        event.preventDefault();
        const title = $('#updatetitle').val();
        const cvid2 = $(this).data('id');
        $.ajax({
            url:'slices/cvfile.php',
            method:'POST',
            data:{cvid2:cvid2,title:title},
            success:function(response){
                const data = JSON.parse(response);

                if(data == 'updatesuccess'){
                    $('#updmsg').removeClass('bg-danger');
                    $('#updmsg').removeClass('d-none');
                    $('#updmsg').addClass('bg-success');
                    $('#updmsg').html('Cv Title Updated Successfully');
                    $('#updatemodel').hide();  // Hides the modal
                    $('.modal-backdrop').fadeOut(); 
                    loadcvfiles();
                }else if(data == ''){
                    $('#updmsg').removeClass('d-none');
                    $('#updmsg').removeClass('bg-success');
                    $('#updmsg').addClass('bg-danger');
                    $('#updmsg').html('Cv Title Failed To Update');
                    loadcvfiles();
                }else{
                    console.log(data);
                    loadcvfiles();
                    
                }
                
                
                
            }
        })

       
    })



    // delete entire cv
    $(document).on('click','.btn-delete',function(){
        const cvid = $(this).data('id');
        $.ajax({
            url:'slices/deletecv.php',
            method:'POST',
            data:{cvid:cvid},
            success:function(response){
                const data = JSON.parse(response);
                if(data=='success'){
                    alert('cv deleted successfully');
                    loadcvfiles();
                }else if(data == 'failed'){
                    alert('failed to delete cv file');
                    loadcvfiles();
                }
            }
        })
    })
})