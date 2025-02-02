$(document).ready(function(){

    $(document).on('click','.btn-download',function(){
        const resume_content = $('#cv_content').html();
        // let styled_content = `
        // <style>
        //     .bi {
        //         display: none !important;
        //     }
        // </style>
        // ` + resume_content.html();
        // let icons = $('.bi');
        // icons.hide();
      

        // console.log(resume_content);
        
        

        $.ajax({
            url:'slices/pdf_file.php',
            method:'POST',
            data:{data:resume_content},
            success:function(response){
                const data = JSON.parse(response);
                if(data.file){
                    window.open(data.file,'_blank'); 
                }else{
                    alert('sorry, pdf file failed to be generated , please try again later')
                }
                
            },
        //     complete:function(){
        //         icons.show();
        //     }
        })
    })
})