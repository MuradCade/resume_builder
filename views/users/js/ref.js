$(document).ready(function(){

    // getting data from url
    var url = window.location.href;
    var url_string = new URL(url);
    var cvfileid = url_string.searchParams.get('resume_id');
 // load expreince data  put inside the papaer
 function loadrefrenceinfoinsidepaper(){
    $.ajax({
        url:'slices/resumeload.php',
        method:'GET',
        data:{action:'refrence',cvid:cvfileid},
        success:function(response){
            // console.log(response);
            
            $('#display-refrence').html(response);
        }
    })
}
loadrefrenceinfoinsidepaper();


 // delete from paper
 $(document).on('click','.btn-delete-6',function(){
    const id = $(this).data('id');
    const table = 'reference';
    $.ajax({
        url:'slices/resumeload.php',
        method:'GET',
        data:{action:'delete',id:id,tablename:table},
        success:function(response){
            alert(response);
            // console.log(response);
            
            
            loadrefrenceinfoinsidepaper();
            loadrefrenceinformation();

        }
    })
})


        // load refrences information
        function loadrefrenceinformation(){
            $.ajax({
                url:'slices/ref.php',
                method:'GET',
                data:{cvid:cvfileid},
                success:function(response){
                    $('#displayrefrences').html(response);
                }
            })
        }
        // calll the function
        loadrefrenceinformation();


    // save refrences data
    $('#refrencesform').submit(function(event){
        event.preventDefault();
       const  person_name = $('#person_name').val();
       const  person_phone = $('#person_phone').val();
       const  person_title = $('#person_title').val();


       $.ajax({
        url:'slices/ref.php',
        method:'POST',
        data:{chosemethod:'save',cvid:cvfileid,pname:person_name,pphone:person_phone,ptitle:person_title},
        success:function(response){
            const data = JSON.parse(response);
            if(data == 'emptyperson_name'){
                $('#msg6').removeClass('d-none');
                $('#msg6').removeClass('bg-success');
                $('#msg6').addClass('bg-danger');
                $('#msg6').html('Empty Person Name Field');

            }else if(data == 'emptyperson_phone'){
                $('#msg6').removeClass('d-none');
                $('#msg6').removeClass('bg-success');
                $('#msg6').addClass('bg-danger');
                $('#msg6').html('Empty Person Phone Field');
            }else if(data == 'emptyperson_title'){
                $('#msg6').removeClass('d-none');
                $('#msg6').removeClass('bg-success');
                $('#msg6').addClass('bg-danger');
                $('#msg6').html('Empty Person Title Field');
            }else if(data =='failed'){
                $('#msg6').removeClass('d-none');
                $('#msg6').removeClass('bg-success');
                $('#msg6').addClass('bg-danger');
                $('#msg6').html('Failed To Save Refrences Information');
                $('#refrencesform')[0].reset();
                loadrefrenceinfoinsidepaper();
                loadrefrenceinformation();
            }else if(data == 'savesuccess'){
                $('#msg6').removeClass('d-none');
                $('#msg6').removeClass('bg-danger');
                $('#msg6').addClass('bg-success');
                $('#msg6').html('Refrences information saved successfully');
                loadrefrenceinfoinsidepaper();
                loadrefrenceinformation();
                $('#refrencesform')[0].reset();

            }else{
                console.log(data);
                
            }
            
        }
       })
    })


    // update refrences information
    $('#updatesrefrencesform').submit(function(event){
        event.preventDefault();
        $.ajax({
            url:"slices/ref.php",
            method:"POST",
            data:$('#updatesrefrencesform').serialize() + '&chosemethod=update',
            success:function(response){
                // console.log(response);
                
                const data = JSON.parse(response);

                if(data =='updatesuccess'){
                    $('#update6').removeClass('d-none');
                    $('#update6').removeClass('bg-danger');
                    $('#update6').addClass('bg-success');
                    $('#update6').html('Refrences information Updated successfully');
                    loadrefrenceinformation();
                    loadrefrenceinfoinsidepaper();
                }else if(data == 'updatefailed'){
                    $('#update6').removeClass('d-none');
                    $('#update6').removeClass('bg-danger');
                    $('#update6').addClass('bg-success');
                    $('#update6').html('Failed To Update Refrence Information');
                    loadrefrenceinformation();
                    loadrefrenceinfoinsidepaper();
                }else{
                    console.log(data);
                    
                }
                
            }

        })
    })
})