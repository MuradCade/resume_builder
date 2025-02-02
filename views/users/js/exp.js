$(document).ready(function(){

  // getting data from url
  var url = window.location.href;
  var url_string = new URL(url);
  var cvfileid = url_string.searchParams.get('resume_id');

 // load expreince data  put inside the papaer
 function loadexperienceinfoinsidepaper(){
    $.ajax({
        url:'slices/resumeload.php',
        method:'GET',
        data:{action:'expo',cvid:cvfileid},
        success:function(response){
            // console.log(response);
            
            $('#display-expo-info').html(response);
        }
    })
}
loadexperienceinfoinsidepaper();


 // delete from paper
 $(document).on('click','.btn-delete-3',function(){
    const id = $(this).data('id');
    const table = 'experience';
    $.ajax({
        url:'slices/resumeload.php',
        method:'GET',
        data:{action:'delete',id:id,tablename:table},
        success:function(response){
            alert(response);
            // console.log(response);
            
            
loadexperienceinfoinsidepaper();
loadexperience();

        }
    })
})
//   load experience information
function loadexperience(){
    $.ajax({
        url:"slices/exp.php",
        method:"GET",
        data:{cvid:cvfileid},
        success:function(response){
            $('#experienceinformation').html(response);
        }
    })
}

loadexperience();





    // save expreience data
    $('#expreinceform').submit(function(event){
        event.preventDefault();
        let jobname = $('#jobname').val();
        let companyname = $('#companyname').val();
        let desc = $('#desc').val();
        let date = $('#date1').val();
        let end_date = $('#date2').val();
        


        $.ajax({
            url:"slices/exp.php",
            method:"POST",
            data:{chosemethod:'save',cvid:cvfileid,jobname:jobname,companyname:companyname,desc:desc,date:date,end_date:end_date},
            success:function(response){
            const data = JSON.parse(response);
            if(data == 'emptyjobname'){
                $('#msg3').removeClass('d-none');
                $('#msg3').removeClass('bg-success');
                $('#msg3').addClass('bg-danger');
                $('#msg3').html('Empty Jobname Field');
            }else if(data == 'emptycompanyname'){
                $('#msg3').removeClass('d-none');
                $('#msg3').removeClass('bg-success');
                $('#msg3').addClass('bg-danger');
                $('#msg3').html('Empty Company Name Field');
            }else if(data == 'emptydesc'){
                $('#msg3').removeClass('d-none');
                $('#msg3').removeClass('bg-success');
                $('#msg3').addClass('bg-danger');
                $('#msg3').html('Empty  Description Field');
            }else if(data == 'emptystarted_date'){
                $('#msg3').removeClass('d-none');
                $('#msg3').removeClass('bg-success');
                $('#msg3').addClass('bg-danger');
                $('#msg3').html('Empty Started Date Field');
            }else if(data == 'emptyend_date'){
                $('#msg3').removeClass('d-none');
                $('#msg3').removeClass('bg-success');
                $('#msg3').addClass('bg-danger');
                $('#msg3').html('Empty End date  Field');
            }else if(data == 'success'){
                $('#msg3').removeClass('d-none');
                $('#msg3').removeClass('bg-danger');
                $('#msg3').addClass('bg-success');
                $('#msg3').html('Experience Information Saved Successfully');
                loadexperience();
                loadexperienceinfoinsidepaper();
                $('#expreinceform')[0].reset();
            }else if(data == 'failed'){
                $('#msg3').removeClass('d-none');
                $('#msg3').removeClass('bg-success');
                $('#msg3').addClass('bg-danger');
                $('#msg3').html('Sorry, Failed To Save Experience Informations');
                $('#expreinceform')[0].reset();

                loadexperience();
                loadexperienceinfoinsidepaper();
            }else{
                console.log(data);
                
            }
            }
        })
    });




    // update experience information
    $('#updateexpreinceform').submit(function(event){
        event.preventDefault();
        $.ajax({
            url:"slices/exp.php",
            method:"POST",
            data:$('#updateexpreinceform').serialize()+ '&chosemethod=update',
            success:function(response){
                const data = JSON.parse(response);
                if(data == 'updatefailed'){
                    $('#update3').removeClass('d-none');
                    $('#update3').removeClass('bg-success');
                    $('#update3').addClass('bg-danger');
                    $('#update3').html('Sorry ,Failed to Update Experience Data');
                    loadexperience();
                    loadexperienceinfoinsidepaper();
                }else if(data == 'updatesuccess'){
                    $('#update3').removeClass('d-none');
                    $('#update3').removeClass('bg-danger');
                    $('#update3').addClass('bg-success');
                    $('#update3').html('Experience Data Saved Successfully');
                    loadexperience();
                    loadexperienceinfoinsidepaper();
                }else {
                        console.log(data);
                        
                }
              
                
            }
        })
    })
})