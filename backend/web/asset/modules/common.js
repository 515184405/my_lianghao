/**

 @Name：layuiAdmin 公共业务
 @Author：贤心
 @Site：http://www.layui.com/admin/
 @License：LPPL
    
 */
 
layui.define(function(exports){
  var $ = layui.$
  ,layer = layui.layer
  ,setter = layui.setter
  ,view = layui.view
  ,admin = layui.admin
  
  //公共业务的逻辑处理可以写在此处，切换任何页面都会执行
  //……
  $.each($('.layui-nav a'),function(){
    var link = $(this).removeClass('layui-this').attr('href');
    $(this).parents('li').removeClass('layui-nav-itemed');
    var winUrl = window.location.href;
    if(winUrl.indexOf(link) !== -1){
        $(this).addClass('layui-this').parents('li').addClass('layui-nav-itemed');
    }
  })


    //设置左侧路由
    var href = location.href;
    var $item = $("#layui-side-menu a");
    $("#layui-side-menu li,#layui-side-menu dd").removeClass('layui-this');
    $.each($item,function(index,elem){
        if(href.indexOf($(elem).attr('href')) != -1){
            if($(elem).parents('dd').length > 0){
                $this = $(elem).parents('dd');
                $("#layui-side-menu a").removeClass('layui-this');
                $this.parents('li').addClass('layui-nav-itemed');
            }else{
                $this = $(elem).parents('li');
            }
            $("#layui-side-menu a").removeClass('layui-this');
            $(this).addClass('layui-this');
        }
    })

  
  //对外暴露的接口
  exports('common', {});
});