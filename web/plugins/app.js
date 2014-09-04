//alert替代方法，利用jqueryui的dialog
$.wxAlert = function(msg,advanced){
    //动态创建div层
    var box = $("<div></div>");
    box.attr('title','提示信息');
    var p = $("<p></p>");
    p.html(msg);
    box.append(p);
    //添加一个按钮
    var buttons = [
        {
            text : '确定',
            click : function(){
                $(this).dialog( "close" );
            }
        }
    ];
    //关闭对话框时销毁对象
    var close = function(event,ui){
        $(this).remove();
    }
    //生成对话框
    box.dialog({ resizable : false,buttons:buttons,close:close,position: { my: "center", at: "top+200" } });
};

$.wxConfirm = function(msg,callback){
    //动态创建div层
    var box = $("<div></div>");
    box.attr('title','确认操作');
    var p = $("<p></p>");
    p.html(msg);
    box.append(p);
    //添加一个按钮
    var buttons = [
        {
            text : '确定',
            click : function(){
                callback();
                $(this).dialog( "close" );
            }
        },
        {
            text : '取消',
            click : function(){
                $(this).dialog( "close" );
            }
        }
    ];
    //关闭对话框时销毁对象
    var close = function(event,ui){
        $(this).remove();
    }
    //生成对话框
    box.dialog({ resizable : false,buttons:buttons,close:close,position: { my: "center", at: "top+200" } });
}



