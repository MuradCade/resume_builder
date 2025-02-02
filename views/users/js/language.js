$(document).ready(function(){
    // getting data from url
    var url = window.location.href;
    var url_string = new URL(url);
    var cvfileid = url_string.searchParams.get('resume_id');

 // load expreince data  put inside the papaer
 function loadlanguageinfoinsidepaper(){
    $.ajax({
        url:'slices/resumeload.php',
        method:'GET',
        data:{action:'langauage',cvid:cvfileid},
        success:function(response){
            // console.log(response);
            
            $('#display-language').html(response);
        }
    })
}
loadlanguageinfoinsidepaper();


 // delete from paper
 $(document).on('click','.btn-delete-5',function(){
    const id = $(this).data('id');
    const table = 'languages';
    $.ajax({
        url:'slices/resumeload.php',
        method:'GET',
        data:{action:'delete',id:id,tablename:table},
        success:function(response){
            alert(response);
            // console.log(response);
            
            
            loadlanguageinfoinsidepaper();
            loadlanguageinformation();

        }
    })
})


    // display lanuage informatins

    function loadlanguageinformation(){
        $.ajax({
            url:"slices/language.php",
            method:"GET",
            data:{cvid:cvfileid},
            success:function(response){
               $('#displaylanguageform').html(response);
            }
        })
    }

    loadlanguageinformation();
    // save language information
    $('#languageform').submit(function(event){
        event.preventDefault();
        const language = $('#language').val();
        const languagelevel = $('#languagelevel').val();

        $.ajax({
            url:"slices/language.php",
            method:"POST",
            data:{chosemethod:'save',cvid:cvfileid,language:language,languagelevel:languagelevel},
            success:function(response){
                const data = JSON.parse(response);
                if(data == 'emptylanguage'){
                    $('#msg5').removeClass('d-none');
                    $('#msg5').removeClass('bg-success');
                    $('#msg5').addClass('bg-danger');
                    $('#msg5').html('Empty Language Field');
                }else if(data == 'emptylanguagelevel'){
                    $('#msg5').removeClass('d-none');
                    $('#msg5').removeClass('bg-success');
                    $('#msg5').addClass('bg-danger');
                    $('#msg5').html('Empty Language Level Field');
                }else if(data == 'failed'){
                    $('#msg5').removeClass('d-none');
                    $('#msg5').removeClass('bg-success');
                    $('#msg5').addClass('bg-danger');
                    $('#msg5').html('Failed To Save Language Information');
                    loadlanguageinfoinsidepaper();
                    loadlanguageinformation();
                    $('#languageform')[0].reset();
                }else if(data == 'savedsuccess'){
                    $('#msg5').removeClass('d-none');
                    $('#msg5').removeClass('bg-danger');
                    $('#msg5').addClass('bg-success');
                    $('#msg5').html('Language Information Saved Successfully');
                    loadlanguageinformation();
                    loadlanguageinfoinsidepaper();
                    $('#languageform')[0].reset();

                }else{
                    console.log(data);
                    
                }
                
            }
        })
    })



    // update language information

    $('#updatelanguageform').submit(function(event){
        event.preventDefault();

        $.ajax({
            url:"slices/language.php",
            method:"POST",
            data:$('#updatelanguageform').serialize()+ '&chosemethod=update',
            success:function(response){
                const data = JSON.parse(response);
                if(data == 'updatesuccess'){
                    $('#update5').removeClass('d-none');
                    $('#update5').removeClass('bg-danger');
                    $('#update5').addClass('bg-success');
                    $('#update5').html('Language Data Updated Successfully');
                    loadlanguageinfoinsidepaper();
                }else if(data == 'updatefailed'){
                    $('#update5').removeClass('d-none');
                    $('#update5').removeClass('bg-success');
                    $('#update5').addClass('bg-danger');
                    $('#update5').html('Failed To Update Language Data');
                    loadlanguageinfoinsidepaper();
                }else{
                    console.log(data);
                    
                }
                
            }
        })
    })
})