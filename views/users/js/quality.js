$(document).ready(function(){
        // getting data from url
        var url = window.location.href;
        var url_string = new URL(url);
        var cvfileid = url_string.searchParams.get('resume_id');



 // load quality data  put inside the papaer
 function loadqualityinfoinsidepaper(){
    $.ajax({
        url:'slices/resumeload.php',
        method:'GET',
        data:{action:'quality',cvid:cvfileid},
        success:function(response){
            // console.log(response);
            
            $('#display-quality').html(response);
        }
    })
}
loadqualityinfoinsidepaper();

 // delete from paper
 $(document).on('click','.btn-delete-4',function(){
    const id = $(this).data('id');
    const table = 'qualities';
    $.ajax({
        url:'slices/resumeload.php',
        method:'GET',
        data:{action:'delete',id:id,tablename:table},
        success:function(response){
            alert(response);
            // console.log(response);
            
            
            loadqualityinfoinsidepaper();
            loadqualityinformation()

        }
    })
})

    // load quality information
    function loadqualityinformation(){
        $.ajax({
            url:"slices/quality.php",
            method:"GET",
            data:{cvid:cvfileid},
            success:function(response){
                $('#qaulityinfo').html(response);
            }
        })
    }

    loadqualityinformation()
        // sav quality information
        $('#qualityform').submit(function(event){
            event.preventDefault();
            const qualityname = $('#qualityname').val();
            $.ajax({
                url:"slices/quality.php",
                method:"POST",
                data:{chosemethod:'save',cvid:cvfileid,qualityname:qualityname},
                success:function(response){
                    // console.log(response);
                    
                    const data = JSON.parse(response)
                     if(data == 'emptyqualityname'){
                        $('#msg4').removeClass('d-none');
                        $('#msg4').removeClass('bg-success');
                        $('#msg4').addClass('bg-danger');
                        $('#msg4').html('Empty Quality Name');

                    }else if(data == 'failed'){
                        $('#msg4').removeClass('d-none');
                        $('#msg4').removeClass('bg-success');
                        $('#msg4').addClass('bg-danger');
                        $('#msg4').html('Failed To Save Quality Information');
                        $('#qualityform')[0].reset();
                        loadqualityinformation();
                        loadqualityinfoinsidepaper();
                    }
                    else if(data == 'success'){
                        $('#msg4').removeClass('d-none');
                        $('#msg4').removeClass('bg-danger');
                        $('#msg4').addClass('bg-success');
                        $('#msg4').html('Quality Information Saved Successfully');
                        $('#qualityform')[0].reset();
                        loadqualityinformation();
                        loadqualityinfoinsidepaper();
                    }else{
                        console.log(data);
                        
                    }
                    
                }
            })
        })




        // update quality ifnormation

        $('#updatequalityform').submit(function(event){
            event.preventDefault();

            $.ajax({
                url:"slices/quality.php",
                method:"POST",
                data:$('#updatequalityform').serialize()+ '&chosemethod=update',
                success:function(response){
                    const data = JSON.parse(response);

                    if(data == 'updatefailed'){
                        $('#update4').removeClass('d-none');
                        $('#update4').removeClass('bg-success');
                        $('#update4').addClass('bg-danger');
                        $('#update4').html('Failed to update quality information');
                        loadqualityinfoinsidepaper();
                    }else if(data == 'updatesuccess'){
                        $('#update4').removeClass('d-none');
                        $('#update4').removeClass('bg-danger');
                        $('#update4').addClass('bg-success');
                        $('#update4').html('Quality information updated successfully');
                        loadqualityinfoinsidepaper();
                    }else{
                        console.log(data);
                        
                    }
                    
                }

            })
        })
})