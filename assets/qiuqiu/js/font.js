$(function(){

    var options = $('#options');
    var opDiv = options.find('div.oD');
    var onColor = null;

    //表单事件
    var setForm = $('#setForm'),
        F_input = setForm.find('input'),
        F_set = setForm.find('button.set'),
        rate = $('#rate');
    var listArr = [
        { l: '', r: '', jg: '' },           //1
        { l: 'ʚ', r: 'ʚ', jg: '' },         //2
        { l: '҉', r: '҉', jg: '҉' },        //3
        { l: '❧', r: '❧', jg: '❧' },        //4
        { l: '[_̅', r: '_̅]', jg: '_̅' },     //5
        { l: 'じ☆', r: '灬', jg: '.' },       //6
        { l: 'ℳℓ', r: 'ℓℳ', jg: 'ℳ' },       //7
        { l: 'ζั͡طى', r: 'ั͡ζั͡ ̲̲̲̯̲̯̲އ ั͡✾ އ', jg: 'ั͡ζั͡' },       //8
        { l: 'ζั͡ ั͡', r: 'ั͡ζั͡ั͡✾', jg: 'ั͡ζั͡' },        //9
        { l: '◤', r: '◢', jg: '◢◤' },        //10
        { l: '╰╮', r: '╭╯', jg: '' },
        { l: '☆', r: '☆', jg: '' },
        { l: '℡﹏', r: 'ゞ', jg: '' },
        { l: 'ε', r: 'ε', jg: ''}
    ];

   //点击生成按钮, 根据listArr规则生成
   F_set.on('click', function() {
		
		if(!F_input.val()){
			$.Confirm(' ',"生成的游戏昵称不能为空!",1); 
			return 0;
		}
			var li_xml = '';
        for(var i = 0; i < listArr.length; i++){
      //加入特殊字符
            var val = F_input.val();
            val = val.replace(/./gi, '$&' + listArr[i]['jg'])
            val = listArr[i]['l'] + val + listArr[i]['r'];

            //从颜色列表中取随机一个颜色
            if(onColor) {
                var lColor = onColor;
            } else {
                var lColor = colorArray[RandomNum(0, colorArray.length - 1)];
            };
            li_xml += (
                '<p>' +
                    '<span style="color:'+lColor+';font-weight: 800;">'+val+'</span>' +
                    '<a>['+lColor.replace('#','')+']&nbsp;'+val+'</a>' +
                '</p>'
            );
        };
        rate.html(li_xml);  //赋值到ＨＴＭＬ DOM中
    });

    //选项卡切换
    var op_li = $('#op >li');
    op_li.on('click', function(){

        var ThisIndex = $(this).attr('Index');
        //清除所有按钮样式
        op_li.removeClass('active');
        $(this).addClass('active');
        opDiv.removeClass('show');
        opDiv.eq(ThisIndex).addClass('show')
    });

    //读取JSON数据加入列表
    var Dcolor = $('#Dcolor'),
        Dfont = $('#Dfont');
        Dkey = $('#Dkey'),
        colorArray = [];
    var color_li = '', font_li = '', key_li = '';
    $.get('public/font.json', function(data){

        //颜色列表
        colorArray = data.color; //提供其他函数使用颜色列表, 后面的随机颜色会用到
        for(var i = 0; i < data.color.length; i++){
            color_li += ('<li style="background-color: ' + data.color[i] + '"></li>');
        };
        Dcolor.children('ul').html(color_li);

        //符号列表
        for(var i = 0; i < data.font.length; i++){
            font_li += ('<li>' + data.font[i] + '</li>');
        };
        Dfont.children('ul').html(font_li);

        //热词列表
        for(var i = 0; i < data.key.length; i++){
            key_li += ('<li>' + data.key[i] + '</li>');
        };
        Dkey.children('ul').html(key_li);
    });

    //颜色列表事件
    Dcolor.on('click', 'li', function() {

        var ThisColor = $(this).css('background-color');
        F_input.css({
            color: ThisColor
        });
        onColor = ThisColor.toUpperCase();
        //判断是否是IE浏览器
        var isIE = !-[1,];
        if(isIE) return false;

        function rgbToHex(rgb){
            rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
            return rgb= "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
        };
        //rgb转换hex的函数
        function hex(x) {
            return ("0" + parseInt(x).toString(16)).slice(-2);
        };
        onColor = rgbToHex(ThisColor).toUpperCase();
    });
    //符号列表和热词列表 追加文本, 公用函数
    Dfont.on('click', 'li', addText);
    Dkey.on('click', 'li', addText);
    function addText(){
        var ThisText = $(this).text();
        F_input.val(F_input.val() + ThisText);
    };
});

//指定范围随机数
function RandomNum(under, over) {
	switch (arguments.length) {
		case 1: return parseInt(Math.random() * under + 1);
		case 2: return parseInt(Math.random() * (over - under + 1) + under);
		default: return 0;
	};
};