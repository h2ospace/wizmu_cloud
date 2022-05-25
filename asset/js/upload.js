$(document).ready(function () {
    //describe file information
    $('#movie').on('change', function () {
        let file_data = $('#movie').prop('files')[0];
        let file_name = file_data['name'];
        let file_size = file_data['size'];
        let allowed_type = ['.mp4', '.mov'];
        let file_type = file_name.slice(-4).toLowerCase();
        console.log(file_data);
        $('.progress_1').css('display', 'none');
        if (file_name) {
            if (allowed_type.indexOf(file_type) > -1) {
                $('.file_name').html(file_name);
            } else {
                alert("ファイル選択エラー。  *.mp4、*.mov ファイルを選択する必要があります。");
                $('.file_name').html("");
                $('.reset').trigger('click');
            }
        }
    });
    //file upload
    $('.upload_btn').on('click', function () {
        $('.progress').css('display', 'none');
    });
    $('.upload_frm').submit(function (e) {
        e.preventDefault();
        let file_data = $('#movie').prop('files')[0];
        if (file_data) {
            $(this).ajaxSubmit({
                target: "#msg",
                beforeSubmit: function () {
                    $(".progress-bar_1").width('0%');
                },
                uploadProgress: function (event, position, total, percent) {
                    $('.progress_1').css('display', 'block');
                    $(".progress-bar_1").width(percent + '%');
                    $(".progress-bar_1").html('<div id="progress-status">' + percent + ' %</div>');
                    $('.upload_btn').attr('disabled', true);
                    $('.loading_icon').css('display', 'block');
                },
                success: function () {
                    var result = $('#msg span').data('val');
                    $('.progress_1').css('display', 'none');
                    $('.upload_btn').attr('disabled', false);
                    $('.loading_icon').hide();
                    if (result == '1') {
                        $('.file_name').html("アップロード成功");
                        $('.status').css('display', 'block');
                        $('.result').html('アップロード成功');
                        $('.icon_movie p').html("読み込み中...しばらくお待ちください。");

                        var init_val = 1;
                        function icon_eff(){
                            if( init_val ==1){
                                $('.icon_movie i').css('opacity',0.3);
                                init_val =0;
                            } else {
                                $('.icon_movie i').css('opacity',1);
                                init_val =1;
                            }
                        }
                        icon_eff();
                        setInterval(icon_eff, 1000);
                    } else if(result == '2') {
                        $('.result').html('アップロードエラー');
                    } else if(result == '3'){
                        $('.result').html('ファイルが存在します。');
                    }
                    
                },
                resetForm: true
            });
            return false;
        } else {
            alert("ファイルを選択する必要があります。")
        }

    });
});