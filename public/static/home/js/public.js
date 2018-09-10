/**
 * Created by Administrator on 2018/7/20.
 */

$(function(){
    //点击事件
    $('.ajax').click(function(){
        var url = $(this).attr('data_url');
        $.get(url , {} , function(data){
            if(data.code == 1){ // 删除成功
                layer.msg(data.msg , {time: 2000} , function(){
                    window.location.href = data.url;//跳转
                });
            }else{
                layer.msg(data.msg , {time: 2000});
            }
        });
    });
    //表单提交
    $('.sub').click(function(){
        $.ajax({
            url:$('.form').attr('action'),
            type:'post',
            data:$('.form').serializeArray(),
            dataType:'json',
            success:function(data){
                if(data.code == 1){
                    layer.msg(data.msg , {time: 2000} , function(){
                        window.location.href = data.url;
                    });
                }else{
                    layer.msg(data.msg );
                }
            }
        });
    })
})