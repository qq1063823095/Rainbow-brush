$.extend({
    Confirm: function(){
        var template = multiline(function(){/*!@preserve
            <style>
			    .jquery-confirm-content {width:360px;}
                .jquery-confirm-content p{margin:.7em 0 0;padding:0;}
                .jquery-confirm-cancel:hover,.jquery-confirm-ok:hover{background:#f0f0f0;}
                @media screen and (max-width: 430px) { 
                .jquery-confirm-content {width:300px;text-align:center;} 
                }
                @media screen and (max-width: 380px) { 
                .jquery-confirm-content {width:270px;text-align:center;} 
                }
                @media screen and (max-width: 350px) { 
                .jquery-confirm-content {width:210px;text-align:center;} 
                }
                @media screen and (max-width: 280px) { 
                .jquery-confirm-content {width:100%;text-align:center;} 
                }
            </style>
            <div style="position:fixed;width:100%;height:100%;display:table;text-align:center;z-index:100001;top:0;left:0;">
            <div style="position:absolute;width:100%;height:100%;top:0;left:0;background:#000;opacity:0.3;filter: alpha(opacity=30);"></div>
            <div style="position:relative;display:table-cell;vertical-align:middle;">
                <div style="display:inline-block;background:#fff;border-radius:3px;text-align:left;overflow:hidden;max-width:97%;">
                    <div style="padding:30px;line-height:1.5;border-bottom:1px solid #F2F2F2;">
                        <div class="jquery-confirm-content" style="font-size:16px;margin-top:.7em; text-align:center; color:#777777;"></div>
                    </div>
                    <div style="display:inline-table;width:100%;line-height:40px;height:40px;font-size:17px;text-align:center;">
                        <a class="jquery-confirm-cancel" href="javascript:;" style="display:table-cell;box-sizing:border-box;color:#3498DB;text-decoration:none;text-align:center;">取消</a>
                        <a class="jquery-confirm-ok" href="javascript:;" style="display:table-cell;box-sizing:border-box;color:#33CC33;text-decoration:none;text-align:center;">确定</a>
                    </div>
                </div>
            </div>
        </div>
        */console.log()});

        return function(title,content,btns_num){
            var title = title||'www.aey1.com',
                content = content||'',
                btns_num = btns_num||2,
                ok,cancel,result = {
                    ok:function(func){ok=func;return result;},
                    cancel:function(func){cancel=func;return result;}
                };

            var dom = $('<div>').html(template);

            btns_num==1
                ? dom.find('.jquery-confirm-cancel').remove()
                : dom.find('.jquery-confirm-ok').css('border-left','1px solid #F2F2F2');

            dom.on('touchmove',function(){return false;});
            dom.find('.jquery-confirm-title').html(title);
            dom.find('.jquery-confirm-content').html(content);
            dom.find('.jquery-confirm-ok').on('click',function(){
                ok && ok();
                dom.remove();
            });
            dom.find('.jquery-confirm-cancel').on('click',function(){
                cancel && cancel();
                dom.remove();
            });
            dom.appendTo( $('body') );

            return result;
        }

        function multiline(fn){ //http://www.52qiu.la
            var reCommentContents = /\/\*!?(?:\@preserve)?[ \t]*(?:\r\n|\n)([\s\S]*?)(?:\r\n|\n)[ \t]*\*\//;
            if(typeof fn !== 'function'){throw new TypeError('Expected a function');}
            var match = reCommentContents.exec(fn.toString());
            if(!match){throw new TypeError('Multiline comment missing.');}
            return match[1];
        };
    }()
});

function loadgo(str) {
	if(str=="1"){
		document.getElementById("loading").innerHTML = '<div id="loading-mask"><div class="loading"><div class="dot white"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div>';
	}
	if(str=="2"){
		document.getElementById("loading").innerHTML = '';
	}
}

function trim(str){ 
return str.replace(/^(\s|\u00A0)+/,'').replace(/(\s|\u00A0)+$/,''); 
} 