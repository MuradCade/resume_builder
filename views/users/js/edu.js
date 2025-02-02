$(document).ready(function(){

    // getting data from url
    var url = window.location.href;
    var url_string = new URL(url);
    var cvfileid = url_string.searchParams.get('resume_id');
    
    



     // load eduaction data  put inside the papaer
     function loadeducationinfoinsidepaper(){
        $.ajax({
            url:'slices/resumeload.php',
            method:'GET',
            data:{action:'education',cvid:cvfileid},
            success:function(response){
                // console.log(response);
                
                $('#display-educationinfo').html(response);
            }
        })
    }
    loadeducationinfoinsidepaper();



     // delete from paper
     $(document).on('click','.btn-delete-2',function(){
        const id = $(this).data('id');
        const table = 'education';
        $.ajax({
            url:'slices/resumeload.php',
            method:'GET',
            data:{action:'delete',id:id,tablename:table},
            success:function(response){
                alert(response);
                // console.log(response);
                
                loadeducationinfoinsidepaper();
                loadeducationinformation();
            }
        })
    })
    // load education information
    function loadeducationinformation(){
        $.ajax({
            url:"slices/edu.php",
            method:'GET',
            data:{cvid:cvfileid},
            success:function(response){
                
                $('#educationinformation').html(response);
            }
        })   
    }
    // call the function that displays education information
    loadeducationinformation();

    // save education information
    $('#educationform').submit(function(event){
        event.preventDefault();
        const etitle = $('#etitle').val();
        const uniname = $('#uniname').val();
        const started_date = $('#started_date').val();
        const end_date = $('#end_date').val();

        $.ajax({
            url:"slices/edu.php",
            method:'POST',
            data:{chosemethod:'save',cvid:cvfileid,etitle:etitle,uniname:uniname,started_date:started_date,end_date:end_date},
            success:function(response){
              
                const data = JSON.parse(response);
                if(data == 'emptytitle'){
                    $('#msg2').removeClass('d-none');
                    $('#msg2').removeClass('bg-success');
                    $('#msg2').addClass('bg-danger');
                    $('#msg2').html('Empty Title Field');
                }else if(data =='emptyuniname'){
                    $('#msg2').removeClass('d-none');
                    $('#msg2').removeClass('bg-success');
                    $('#msg2').addClass('bg-danger');
                    $('#msg2').html('Empty University Name Feild');
                }else if(data == 'emptystarted_date'){
                    $('#msg2').removeClass('d-none');
                    $('#msg2').removeClass('bg-success');
                    $('#msg2').addClass('bg-danger');
                    $('#msg2').html('Empty Started Date Field');
                }else if(data == 'emptyend_date'){
                    $('#msg2').removeClass('d-none');
                    $('#msg2').removeClass('bg-success');
                    $('#msg2').addClass('bg-danger');
                    $('#msg2').html('Empty Ended Date Field');
                }
                else if(data == 'success'){
                    $('#msg2').removeClass('d-none');
                    $('#msg2').removeClass('bg-danger');
                    $('#msg2').addClass('bg-success');
                    $('#msg2').html('Saved Successfull');
                    loadeducationinfoinsidepaper();
                    $('#educationform')[0].reset();
                    loadeducationinformation();
                }else if(data == 'failed'){
                    $('#msg2').removeClass('d-none');
                    $('#msg2').removeClass('bg-success');
                    $('#msg2').addClass('bg-danger');
                    $('#msg2').html('Failed To Save');
                    $('#educationform')[0].reset();
                    loadeducationinformation();
                    loadeducationinfoinsidepaper();

                }else{
                    console.log(data);
                    
                }
                
            }
        })
    })



// update education information

$('#updateeducationform').submit(function(event){
    event.preventDefault();

    $.ajax({
        url:"slices/edu.php",
        method:"POST",
        data:$('#updateeducationform').serialize()+ '&chosemethod=update',
        success:function(response){
           const data = JSON.parse(response);
           if(data == 'updatesuccess'){
            $('#update2').removeClass('d-none');
            $('#update2').removeClass('bg-danger');
            $('#update2').addClass('bg-success');
            $('#update2').html('Education Data Updated Successfully');
            loadeducationinfoinsidepaper();
            loadeducationinformation();
           }else if(data == 'updatefailed'){
            $('#update2').removeClass('d-none');
            $('#update2').removeClass('bg-success');
            $('#update2').addClass('bg-danger');
            $('#update2').html('Education Data Failed To Update');
            loadeducationinfoinsidepaper();
            loadeducationinformation();
           }else{
            console.log(data);
            
           }
            
        }
    })
})
});