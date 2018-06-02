    //回到顶部
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });
    $('.scrollup').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 1500);
            return false;
    });
    $(".navbar-header").on('click',function(){
        $(".navbar-collapse").slideToggle();
    });
    $(".navbar-collapse a").on('click',function(){
        $(this).addClass("active").siblings().removeClass("active");
        $(".navbar-collapse").hide();
    });
    //pc端 图片弹层
    $(".group").colorbox({rel:'group'});

    //移动端图片层
    $('.subject').on('click','.m_group',function(){
        var zoomSrc= $(this).attr('src');
        var zoomTitle= $(this).attr('title');
        /*$("html,body").css('overflow','hidden');*/
        $(".zoom_img_body").show("fast").find('img').attr('src',zoomSrc);
        $(".zoom_img p").text(zoomTitle);
    })
    $(".zoom_img_body").on('click',function(e){
        /*var target = $(e.target).attr("class");
        if(target == "zoom_img_body"){*/
            $(this).hide();
            /*$("html,body").css('overflow','');
        };*/
    })
    //移动端侧导航
    $(".bars").on('click',function(){
        $("html,body").css('overflow','hidden');
        $(".m_sidebar").show().find("ul").animate({ right: 0 }, 300);
    });
    $(".m_sidebar_mark").on('click',function(){
        $("html,body").css('overflow','');
        $(".m_sidebar").hide().find("ul").css("right", '-270px');
    });
    $(".m_sidebar").on('click','a',function(){
        $("html,body").css('overflow','');
        $(".m_sidebar").hide().find("ul").css("right", '-270px');
    });
    //导航

    var allEle = jQuery(".outline_anchor");
    var headLen = jQuery(".outline_anchor").length;
    //生成导航

    var level=1, anchor=1,strNav = '',m_strNav = '',text = '',m_sub = '';
    allEle.each(function(i){
        $(this).attr('id','outline_anchor_'+anchor);
        text = $(this).text();
        if($(this).is('h4')){
            level=1;
            m_sub= '';
        }
        if($(this).is('h5')){
           level=2;
           m_sub='m_s_sub';
        }
        if($(this).is('p')){
           level=3;
           m_sub='m_s_sub';
           if($(this).attr('state')==2){
                text = '<img src="img/icon2.png" class="outline_tb">'+$(this).attr("alt");
           }else{
                text = '<img src="img/icon1.png" class="outline_tb">'+$(this).attr("alt");
           }
        }
        strNav+='<dd id="sidebar-item-'+anchor+'" class="sideCatalog-item'+level+'">'+
                    '<a onclick="return false;" href="#outline_anchor_'+anchor+'">'+
                        text+
                    '</a>'+
                    '<span class="sideCatalog-dot"></span>'+
                '</dd>';
        m_strNav += '<li class="'+m_sub+'">'+
                        '<a href="#outline_anchor_'+anchor+'">'+text+'</a>'+
                    '</li>';
        anchor++;
    })
    $("#outline_dl").html(strNav);
    $("#m_sidebar_con").html(m_strNav);//m端侧导航
	//设置导航的位置
    var slideTop = $(window).height() - $('.slide').height();
    $('.slide').css('top',slideTop);

    var slideInnerHeight = $('#sideCatalog-catalog dl').height();
    var slideOutHeight = $('#sideCatalog-catalog').height();
    var enableTop = slideInnerHeight - slideOutHeight;
    var step = 50;
    //点击向上的按钮
    $('#sideCatalog-down').bind('click', function () {
        if ($(this).hasClass('sideCatalog-down-enable')) {
            if ((enableTop - Math.abs(parseInt($('#sideCatalog-catalog dl').css('top')))) > step) {
                $('#sideCatalog-catalog dl').stop().animate({'top': '-=' + step}, 'fast');
                $('#sideCatalog-up').removeClass('sideCatalog-up-disable').addClass('sideCatalog-up-enable');
            } else {
                $('#sideCatalog-catalog dl').stop().animate({'top': -enableTop}, 'fast');
                $(this).removeClass('sideCatalog-down-enable').addClass('sideCatalog-down-disable');
            }
        } else {
            return false;
        }
    })
    //点击向下的按钮
    $('#sideCatalog-up').bind('click', function () {
        if ($(this).hasClass('sideCatalog-up-enable')) {
            if (Math.abs(parseInt($('#sideCatalog-catalog dl').css('top'))) > step) {
                $('#sideCatalog-catalog dl').stop().animate({'top': '+=' + step}, 'fast');
                $('#sideCatalog-down').removeClass('sideCatalog-down-disable').addClass('sideCatalog-down-enable');
            } else {
                $('#sideCatalog-catalog dl').stop().animate({'top': '0'}, 'fast');
                $(this).removeClass('sideCatalog-up-enable').addClass('sideCatalog-up-disable');
            }
        } else {
            return false;
        }
    })

    //点击导航中的各个目录
    $('#sideCatalog-catalog dl').delegate('dd', 'click', function () {
        var index = $('#sideCatalog-catalog dl dd').index($(this));
        scrollSlide($(this), index);
        var ddIndex = $(this).find('a').stop().attr('href').lastIndexOf('#');
        var ddId = $(this).find('a').stop().attr('href').substring(ddIndex+1);
        var windowTop = $('#' + ddId + '').offset().top;
        $('body,html').animate({scrollTop: windowTop}, 'fast');
    })

	 if($(this).scrollTop()>($(this).height()+180)){
		 $('.slide').show();
	 }else{
		 $('.slide').hide();
	 }
     var index;
    //滚动页面，即滚动条滚动
    $(window).scroll(function () {
        if($(this).scrollTop()>($(this).height()+180)){
            $('.slide').show();
        }else{
            $('.slide').hide();
        }
        for (var i=headLen-1; i>=0; i--) {
            /*console.log("allEleTop====="+allEle.eq(i).offset().top);
            console.log("allEleH====="+allEle.eq(i).height());*/
            if ($(this).scrollTop() >=allEle.eq(i).offset().top - allEle.eq(i).height()) {
                index = i;
                $('#sideCatalog-catalog dl dd').eq(index).addClass('highlight').siblings('dd').removeClass('highlight');
                scrollSlide($('#sideCatalog-catalog dl dd').eq(index), index);
                return false;
            } else {
                $('#sideCatalog-catalog dl dd').eq(0).addClass('highlight').siblings('dd').removeClass('highlight');
            }
        }
    })

    //导航的滚动，以及向上，向下按钮的显示隐藏
    function scrollSlide(that, index){
        if (index < 15) {
            $('#sideCatalog-catalog dl').stop().animate({'top': '0'}, 'fast');
            $('#sideCatalog-down').removeClass('sideCatalog-down-disable').addClass('sideCatalog-down-enable');
            $('#sideCatalog-up').removeClass('sideCatalog-up-enable').addClass('sideCatalog-up-disable');
        } else if ((headLen-index) < 6) {
            var dlTop = parseInt($('#sideCatalog-catalog dl').css('top')) + slideOutHeight / 2 - (that.offset().top - $('#sideCatalog-catalog').offset().top);
            $('#sideCatalog-catalog dl').stop().animate({'top': dlTop}, 'fast');
            $('#sideCatalog-down').removeClass('sideCatalog-down-enable').addClass('sideCatalog-down-disable');
            $('#sideCatalog-up').removeClass('sideCatalog-up-disable').addClass('sideCatalog-up-enable');
        } else {
            var dlTop = parseInt($('#sideCatalog-catalog dl').css('top')) + slideOutHeight / 2 - (that.offset().top - $('#sideCatalog-catalog').offset().top);
            $('#sideCatalog-catalog dl').stop().animate({'top': dlTop}, 'fast');
            $('#sideCatalog-down').removeClass('sideCatalog-down-disable').addClass('sideCatalog-down-enable');
            $('#sideCatalog-up').removeClass('sideCatalog-up-disable').addClass('sideCatalog-up-enable');
        }
    }

	
    