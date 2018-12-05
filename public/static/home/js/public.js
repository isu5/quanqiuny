/**
 * Created by Administrator on 2018/7/20.
 */

$(function(){
	var bool = false;  //加个锁  防止重复提交
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
	if(!bool){
		bool = true;//解锁
		$('.sub').click(function(){
		
        $.ajax({
            url:$('.form').attr('action'),
            type:'post',
            data:$('.form').serializeArray(),
            dataType:'json',
            success:function(data){
                if(data.code == 1){
					bool = true;  //解锁
                    layer.msg(data.msg , {time: 2000} , function(){
                        window.location.href = data.url;
                    });
                }else{
                    layer.msg(data.msg );
                }
            }
        });
    })
		
		
	}
    
})