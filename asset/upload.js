$(document).ready(function (e) {
    $('#upload').on('click', function () {
        let file_data = $('#movie').prop('files')[0];
        let file_name = file_data['name'];
        let file_type = file_name.substr(-4);
        let allowedType = ['.mp4','.mov'];
        let verify_type = (allowedType.indexOf(file_type) > -1)? 1 : 0;
        let form_data = new FormData();
        form_data.append('file', file_data);
        if(verify_type == 1 )
        {
            let upload = $.ajax({
                url: 'upload.php', // point to server-side PHP script 
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                dataType : 'json',
                success: function (res) {
                    $('#msg').html(res.html); // display success response from the PHP script
                    if(res.success == 2){
                        location.href = 'done.php';
                    }
                },
                error: function (res) {
                    $('#msg').html(res.html); // display error response from the PHP script
                },
                
            });
            
        } else {
                alert('Unsupported file');
        }
           
    });

    $('.close_btn').on('click', function(){
        location.href = 'index.php';
    });
    
});