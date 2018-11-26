var $_GET = (function(){
    var url = window.document.location.href.toString();
    var u = url.split("?");
    if(typeof(u[1]) == "string"){
        u = u[1].split("&");
        var get = {};
        for(var i in u){
            var j = u[i].split("=");
            get[j[0]] = j[1];
        }
        return get;
    } else {
        return {};
    }
})();
function getcount() {
	$.ajax({
		type : "GET",
		url : "ajax.php?act=getcount",
		dataType : 'json',
		async: true,
		success : function(data) {
			$('#count_yxts').html(data.yxts);
			$('#count_orders').html(data.orders);
			$('#count_orders1').html(data.orders1);
			$('#count_orders2').html(data.orders2);
			$('#count_orders_all').html(data.orders);
			$('#count_orders_today').html(data.orders2);
			$('#count_money').html(data.money);
			$('#count_money1').html(data.money1);
			if(data.gift != null){
				$.each(data.gift, function(k, v) {
					$('#pst_1').append('<li><strong>'+k+'</strong> 获得&nbsp;'+v+'</li>');
				});
				$('.giftlist').show();
				$('.giftlist ul').css('height',(35*$('#pst_1 li').length)+'px');
				scollgift();
			}
		}
	});
}
function scollgift(){
  setInterval(function() {
    var frist_li_idx = $("#pst_1 li:first");
    var c_li = frist_li_idx.clone();
    frist_li_idx.animate({
      "marginTop": "-35px",
      "opacity": "hide"
    }, 600, function() {
      $(this).remove();
      $("#pst_1").append(c_li);
    });
  }, 2000);
}
function getPoint() {
	if($('#tid option:selected').val()=="0"){
		$('#inputsname').html("");
		$('#inputsname').hide();
		$('#alert_frame').hide();
		return false;
	}
	var multi = $('#tid option:selected').attr('multi');
	var count = $('#tid option:selected').attr('count');
	var price = $('#tid option:selected').attr('price');
	var shopimg = $('#tid option:selected').attr('shopimg');
	if(multi==1 && count>0){
		$('#need').val('￥'+price +"元 ➠ "+count+"个");
	}else{
		$('#need').val('￥'+price +"元");
	}
	if(price == 0){
		$('#submit_buy').val('立即免费领取');
	}else{
		$('#submit_buy').val('立即购买');
	}
	if(multi == 1){
		$('#display_num').show();
	}else{
		$('#display_num').hide();
	}
	var alert = $('#tid option:selected').attr('alert');
	if(alert!=''){
		$('#alert_frame').show();
		$('#alert_frame').html(unescape(alert));
	}else{
		$('#alert_frame').hide();
	}
	var inputname = $('#tid option:selected').attr('inputname');
	if(inputname!=''){
		$('#inputname').html(inputname);
	}else{
		$('#inputname').html("下单ＱＱ");
	}
	var inputsname = $('#tid option:selected').attr('inputsname');
	if(inputsname!=''){
		$('#inputsname').html("");
		$.each(inputsname.split('|'), function(i, value) {
			if(value.indexOf('{')>0 && value.indexOf('}')>0){
				var addstr = '';
				var selectname = value.split('{')[0];
				var selectstr = value.split('{')[1].split('}')[0];
				$.each(selectstr.split(','), function(i, v) {
					if(v.indexOf(':')>0){
						i = v.split(':')[0];
						v = v.split(':')[1];
					}else{
						i = v;
					}
					addstr += '<option value="'+i+'">'+v+'</option>';
				});
				$('#inputsname').append('<div class="form-group"><div class="input-group"><div class="input-group-addon" id="inputname'+(i+2)+'">'+selectname+'</div><select name="inputvalue'+(i+2)+'" id="inputvalue'+(i+2)+'" class="form-control">'+addstr+'</select></div></div>');
			}else{
			if(value=='说说ID'||value=='说说ＩＤ')
				var addstr='<div class="input-group-addon onclick" onclick="get_shuoshuo(\'inputvalue'+(i+2)+'\',$(\'#inputvalue\').val())">自动获取</div>';
			else if(value=='日志ID'||value=='日志ＩＤ')
				var addstr='<div class="input-group-addon onclick" onclick="get_rizhi(\'inputvalue'+(i+2)+'\',$(\'#inputvalue\').val())">自动获取</div>';
			else if(value=='作品ID'||value=='作品ＩＤ'||value=='快手作品ID')
				var addstr='<div class="input-group-addon onclick" onclick="get_kuaishou(\'inputvalue'+(i+2)+'\',$(\'#inputvalue\').val())">自动获取</div>';
			else if(value=='抖音评论ID')
				var addstr='<div class="input-group-addon onclick" onclick="getCommentList(\'inputvalue'+(i+2)+'\',$(\'#inputvalue\').val())">自动获取</div>';
			else
				var addstr='';
			$('#inputsname').append('<div class="form-group"><div class="input-group"><div class="input-group-addon" id="inputname'+(i+2)+'">'+value+'</div><input type="text" name="inputvalue'+(i+2)+'" id="inputvalue'+(i+2)+'" value="" class="form-control" required/>'+addstr+'</div></div>');
			}
		});
		$('#inputsname').show();
	}else{
		$('#inputsname').html("");
		$('#inputsname').hide();
	}
	if($("#inputname").html() == '快手ID'||$("#inputname").html() == '快手ＩＤ'||$("#inputname").html() == '快手用户ID'){
		$('#inputvalue').attr("placeholder", "在此输入快手作品链接 可自动获取");
		if($("#inputname2").html() == '作品ID'||$("#inputname2").html() == '作品ＩＤ'||$("#inputname2").html() == '快手作品ID'){
			$('#inputvalue2').attr("placeholder", "不要在这里手动输入任何内容");
		}
	}else if($("#inputname").html() == '歌曲ID'||$("#inputname").html() == '歌曲ＩＤ'){
		$('#inputvalue').attr("placeholder", "在此输入歌曲的分享链接 可自动获取");
	}else if($("#inputname").html() == '火山ID'||$("#inputname").html() == '火山作品ID'||$("#inputname").html() == '火山ＩＤ'){
		$('#inputvalue').attr("placeholder", "在此输入火山视频的链接 可自动获取");
	}else if($("#inputname").html() == '抖音ID'||$("#inputname").html() == '抖音作品ID'||$("#inputname").html() == '抖音ＩＤ'){
		$('#inputvalue').attr("placeholder", "在此输入抖音的分享链接 可自动获取");
	}else if($("#inputname").html() == '微视ID'||$("#inputname").html() == '微视作品ID'||$("#inputname").html() == '微视ＩＤ'){
		$('#inputvalue').attr("placeholder", "在此输入微视的作品链接 可自动获取");
	}else if($("#inputname").html() == '微视主页ID'){
		$('#inputvalue').attr("placeholder", "在此输入微视的主页链接 可自动获取");
	}else if($("#inputname").html() == '头条ID'||$("#inputname").html() == '头条ＩＤ'){
		$('#inputvalue').attr("placeholder", "在此输入今日头条的链接 可自动获取");
	}else{
		$('#inputvalue').removeAttr("placeholder");
		$('#inputvalue2').removeAttr("placeholder");
	}
	if($('#tid option:selected').attr('isfaka')==1){
		$('#inputname').html("你的邮箱");
		$('#inputvalue').attr("placeholder", "用于接收卡密以及查询订单使用");
		$('#display_left').show();
		$.ajax({
			type : "POST",
			url : "ajax.php?act=getleftcount",
			data : {tid:$('#tid option:selected').val()},
			dataType : 'json',
			success : function(data) {
				$('#leftcount').val(data.count)
			}
		});
		if($.cookie('email'))$('#inputvalue').val($.cookie('email'));
	}else{
		$('#display_left').hide();
	}
}
function get_shuoshuo(id,uin,km,page){
	km = km || 0;
	page = page || 1;
	if(uin==''){
		layer.alert('请先填写QQ号！');return false;
	}
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : "GET",
		url : "ajax.php?act=getshuoshuo&uin="+uin+"&page="+page+"&hashsalt="+hashsalt,
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				var addstr='';
				$.each(data.data, function(i, item){
					addstr+='<option value="'+item.tid+'">'+item.content+'</option>';
				});
				var nextpage = page+1;
				var lastpage = page>1?page-1:1;
				if($('#show_shuoshuo').length > 0){
					$('#show_shuoshuo').html('<div class="input-group"><div class="input-group-addon onclick" title="上一页" onclick="get_shuoshuo(\''+id+'\',$(\'#inputvalue\').val(),'+km+','+lastpage+')"><i class="fa fa-chevron-left"></i></div><select id="shuoid" class="form-control" onchange="set_shuoshuo(\''+id+'\');">'+addstr+'</select><div class="input-group-addon onclick" title="下一页" onclick="get_shuoshuo(\''+id+'\',$(\'#inputvalue\').val(),'+km+','+nextpage+')"><i class="fa fa-chevron-right"></i></div></div>');
				}else{
					if(km==1){
						$('#km_inputsname').append('<div class="form-group" id="show_shuoshuo"><div class="input-group"><div class="input-group-addon onclick" title="上一页" onclick="get_shuoshuo(\''+id+'\',$(\'#km_inputvalue\').val(),'+km+','+lastpage+')"><i class="fa fa-chevron-left"></i></div><select id="shuoid" class="form-control" onchange="set_shuoshuo(\''+id+'\');">'+addstr+'</select><div class="input-group-addon onclick" title="下一页" onclick="get_shuoshuo(\''+id+'\',$(\'#km_inputvalue\').val(),'+km+','+nextpage+')"><i class="fa fa-chevron-right"></i></div></div></div>');
					}else{
						$('#inputsname').append('<div class="form-group" id="show_shuoshuo"><div class="input-group"><div class="input-group-addon onclick" title="上一页" onclick="get_shuoshuo(\''+id+'\',$(\'#inputvalue\').val(),'+km+','+lastpage+')"><i class="fa fa-chevron-left"></i></div><select id="shuoid" class="form-control" onchange="set_shuoshuo(\''+id+'\');">'+addstr+'</select><div class="input-group-addon onclick" title="下一页" onclick="get_shuoshuo(\''+id+'\',$(\'#inputvalue\').val(),'+km+','+nextpage+')"><i class="fa fa-chevron-right"></i></div></div></div>');
					}
				}
				set_shuoshuo(id);
			}else{
				layer.alert(data.msg);
			}
		} 
	});
}
function set_shuoshuo(id){
	var shuoid = $('#shuoid').val();
	$('#'+id).val(shuoid);
}
function get_rizhi(id,uin,km,page){
	km = km || 0;
	page = page || 1;
	if(uin==''){
		layer.alert('请先填写QQ号！');return false;
	}
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : "GET",
		url : "ajax.php?act=getrizhi&uin="+uin+"&page="+page+"&hashsalt="+hashsalt,
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				var addstr='';
				$.each(data.data, function(i, item){
					addstr+='<option value="'+item.blogId+'">'+item.title+'</option>';
				});
				var nextpage = page+1;
				var lastpage = page>1?page-1:1;
				if($('#show_rizhi').length > 0){
					$('#show_rizhi').html('<div class="input-group"><div class="input-group-addon onclick" onclick="get_rizhi(\''+id+'\',$(\'#inputvalue\').val(),'+km+','+lastpage+')"><i class="fa fa-chevron-left"></i></div><select id="blogid" class="form-control" onchange="set_rizhi(\''+id+'\');">'+addstr+'</select><div class="input-group-addon onclick" onclick="get_rizhi(\''+id+'\',$(\'#inputvalue\').val(),'+km+','+nextpage+')"><i class="fa fa-chevron-right"></i></div></div>');
				}else{
					if(km==1){
						$('#km_inputsname').append('<div class="form-group" id="show_rizhi"><div class="input-group"><div class="input-group-addon onclick" onclick="get_rizhi(\''+id+'\',$(\'#km_inputvalue\').val(),'+km+','+lastpage+')"><i class="fa fa-chevron-left"></i></div><select id="blogid" class="form-control" onchange="set_rizhi(\''+id+'\');">'+addstr+'</select><div class="input-group-addon onclick" onclick="get_rizhi(\''+id+'\',$(\'#km_inputvalue\').val(),'+km+','+nextpage+')"><i class="fa fa-chevron-right"></i></div></div></div>');
					}else{
						$('#inputsname').append('<div class="form-group" id="show_rizhi"><div class="input-group"><div class="input-group-addon onclick" onclick="get_rizhi(\''+id+'\',$(\'#inputvalue\').val(),'+km+','+lastpage+')"><i class="fa fa-chevron-left"></i></div><select id="blogid" class="form-control" onchange="set_rizhi(\''+id+'\');">'+addstr+'</select><div class="input-group-addon onclick" onclick="get_rizhi(\''+id+'\',$(\'#inputvalue\').val(),'+km+','+nextpage+')"><i class="fa fa-chevron-right"></i></div></div></div>');
					}
				}
				set_rizhi(id);
			}else{
				layer.alert(data.msg);
			}
		} 
	});
}
function set_rizhi(id){
	var blogid = $('#blogid').val();
	$('#'+id).val(blogid);
}
function fillOrder(id,skey){
	if(!confirm('是否确定补交订单？'))return;
	$.ajax({
		type : "POST",
		url : "ajax.php?act=fill",
		data : {orderid:id,skey:skey},
		dataType : 'json',
		success : function(data) {
			layer.alert(data.msg);
			$("#submit_query").click();
		}
	});
}
function getsongid(){
	var songurl=$("#inputvalue").val();
	if(songurl==''){layer.alert('请确保每项不能为空！');return false;}
	if(songurl.indexOf('.qq.com')<0){layer.alert('请输入正确的歌曲的分享链接！');return false;}
	try{
		var songid = songurl.split('s=')[1].split('&')[0];
	}catch(e){
		layer.alert('请输入正确的歌曲的分享链接！');return false;
	}
	$('#inputvalue').val(songid);
}
function getkuaishouid(){
	var kuauishouurl=$("#inputvalue").val();
	if(kuauishouurl==''){layer.alert('请确保每项不能为空！');return false;}
	if(kuauishouurl.indexOf('gifshow.com')<0 && kuauishouurl.indexOf('kuaishou.com')<0 && kuauishouurl.indexOf('kwai.com')<0 && kuauishouurl.indexOf('etoote.com')<0 && kuauishouurl.indexOf('kspkg.com')<0){layer.alert('请输入正确的快手作品链接！');return false;}
	if(kuauishouurl.indexOf('/s/')>0){
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=getkuaishou",
			data : {url:kuauishouurl},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					$('#inputvalue').val(data.authorid);
					if($('#inputvalue2').length>0)$('#inputvalue2').val(data.videoid);
				}else{
					layer.alert(data.msg);return false;
				}
			}
		});
	}else{
	try{
		if(kuauishouurl.indexOf('userId=')>0){
			var authorid = kuauishouurl.split('userId=')[1].split('&')[0];
		}else{
			var authorid = kuauishouurl.split('photo/')[1].split('/')[0];
		}
		if(kuauishouurl.indexOf('photoId=')>0){
			var videoid = kuauishouurl.split('photoId=')[1].split('&')[0];
		}else{
			var videoid = kuauishouurl.split('photo/')[1].split('/')[1].split('?')[0];
		}
	}catch(e){
		layer.alert('请输入正确的快手作品链接！');return false;
	}
	$('#inputvalue').val(authorid);
	if($('#inputvalue2').length>0)$('#inputvalue2').val(videoid);
	}
}
function get_kuaishou(id,ksid){
	if(ksid==''){
		ksid = $('#inputvalue2').val();
		if(ksid==''){
			layer.alert('请先填写快手作品链接！');return false;
		}
	}
	var zpid = $('#'+id).val();
	if(ksid.indexOf('http')>=0){
		var kuauishouurl = ksid;
	}else if(zpid.indexOf('http')>=0){
		var kuauishouurl = zpid;
	}else if(zpid==''){
		layer.alert('请先填写快手作品链接！');return false;
	}else{
		return true;
	}
	if(kuauishouurl.indexOf('gifshow.com')<0 && kuauishouurl.indexOf('kuaishou.com')<0 && kuauishouurl.indexOf('kwai.com')<0 && kuauishouurl.indexOf('etoote.com')<0 && kuauishouurl.indexOf('kspkg.com')<0){layer.alert('请输入正确的快手作品链接！');return false;}
	if(kuauishouurl.indexOf('/s/')>0){
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=getkuaishou",
			data : {url:kuauishouurl},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					$('#inputvalue').val(data.authorid);
					$('#inputvalue2').val(data.videoid);
				}else{
					layer.alert(data.msg);return false;
				}
			}
		});
	}else{
	try{
		if(kuauishouurl.indexOf('userId=')>0){
			var authorid = kuauishouurl.split('userId=')[1].split('&')[0];
		}else{
			var authorid = kuauishouurl.split('photo/')[1].split('/')[0];
		}
		if(kuauishouurl.indexOf('photoId=')>0){
			var videoid = kuauishouurl.split('photoId=')[1].split('&')[0];
		}else{
			var videoid = kuauishouurl.split('photo/')[1].split('/')[1].split('?')[0];
		}
	}catch(e){
		layer.alert('请输入正确的快手作品链接！');return false;
	}
	$('#inputvalue').val(authorid);
	$('#inputvalue2').val(videoid);
	}
}
function gethuoshanid(){
	var songurl=$("#inputvalue").val();
	if(songurl==''){layer.alert('请确保每项不能为空！');return false;}
	if(songurl.indexOf('.huoshan.com')<0){layer.alert('请输入正确的链接！');return false;}
	if(songurl.indexOf('/t.huoshan.com/')>0){
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=gethuoshan",
			data : {url:songurl},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					$('#inputvalue').val(data.songid);
				}else{
					layer.alert(data.msg);return false;
				}
			}
		});
	}else{
		try{
			if(songurl.indexOf('video/')>0){
				var songid = songurl.split('video/')[1].split('/')[0];
			}else if(songurl.indexOf('item/')>0){
				var songid = songurl.split('item/')[1].split('/')[0];
			}else if(songurl.indexOf('room/')>0){
				var songid = songurl.split('room/')[1].split('/')[0];
			}else{
				var songid = songurl.split('user/')[1].split('/')[0];
			}
		}catch(e){
			layer.alert('请输入正确的链接！');return false;
		}
		$('#inputvalue').val(songid);
	}
}
function getdouyinid(){
	var songurl=$("#inputvalue").val();
	if(songurl==''){layer.alert('请确保每项不能为空！');return false;}
	if(songurl.indexOf('.douyin.com')<0 && songurl.indexOf('.iesdouyin.com')<0){layer.alert('请输入正确的链接！');return false;}
	if(songurl.indexOf('/v.douyin.com/')>0){
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=getdouyin",
			data : {url:songurl},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					$('#inputvalue').val(data.songid);
				}else{
					layer.alert(data.msg);return false;
				}
			}
		});
	}else{
	try{
		if(songurl.indexOf('video/')>0){
			var songid = songurl.split('video/')[1].split('/')[0];
		}else{
			var songid = songurl.split('user/')[1].split('/')[0];
		}
	}catch(e){
		layer.alert('请输入正确的链接！');return false;
	}
	$('#inputvalue').val(songid);
	}
}
function gettoutiaoid(){
	var songurl=$("#inputvalue").val();
	if(songurl==''){layer.alert('请确保每项不能为空！');return false;}
	if(songurl.indexOf('.toutiao.com')<0){layer.alert('请输入正确的链接！');return false;}
	try{
		if(songurl.indexOf('user/')>0){
			var songid = songurl.split('user/')[1].split('/')[0];
		}else{
			var songid = songurl.split('profile/')[1].split('/')[0];
		}
	}catch(e){
		layer.alert('请输入正确的链接！');return false;
	}
	$('#inputvalue').val(songid);
}
function getweishiid(){
	var songurl=$("#inputvalue").val();
	if(songurl==''){layer.alert('请确保每项不能为空！');return false;}
	if(songurl.indexOf('.qq.com')<0){layer.alert('请输入正确的链接！');return false;}
	try{
		if(songurl.indexOf('feed/')>0){
			var songid = songurl.split('feed/')[1].split('/')[0];
		}else if(songurl.indexOf('personal/')>0){
			var songid = songurl.split('personal/')[1].split('/')[0];
		}else{
			var songid = songurl.split('id=')[1].split('&')[0];
		}
	}catch(e){
		layer.alert('请输入正确的链接！');return false;
	}
	$('#inputvalue').val(songid);
}
function getCommentList(id,aweme_id,km,page){
	km = km || 0;
	page = page || 1;
	if(aweme_id==''){
		layer.alert('请先填写抖音作品ID！');return false;
	}
	if(aweme_id.length != 19){
		layer.alert('抖音作品ID填写错误');return false;
	}
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : "GET",
		url : "https://api.douyin.qlike.cn/api.php?act=GetCommentList&aweme_id="+aweme_id+"&page="+page+"&hashsalt="+hashsalt,
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.total != 0){
				var addstr='';
				$.each(data.comments, function(i, item){
					addstr+='<option value="'+item.cid+'">[昵称 => '+item.user.nickname+'][内容 => '+item.text+'][赞数量=>'+item.digg_count+']</option>';
				});
				var nextpage = page+1;
				var lastpage = page>1?page-1:1;
				if($('#show_shuoshuo').length > 0){
					$('#show_shuoshuo').html('<div class="input-group"><div class="input-group-addon onclick" title="上一页" onclick="getCommentList(\''+id+'\',$(\'#inputvalue\').val(),'+km+','+lastpage+')"><i class="fa fa-chevron-left"></i></div><select id="shuoid" class="form-control" onchange="set_shuoshuo(\''+id+'\');">'+addstr+'</select><div class="input-group-addon onclick" title="下一页" onclick="getCommentList(\''+id+'\',$(\'#inputvalue\').val(),'+km+','+nextpage+')"><i class="fa fa-chevron-right"></i></div></div>');
				}else{
					if(km==1){
						$('#km_inputsname').append('<div class="form-group" id="show_shuoshuo"><div class="input-group"><div class="input-group-addon onclick" title="上一页" onclick="getCommentList(\''+id+'\',$(\'#km_inputvalue\').val(),'+km+','+lastpage+')"><i class="fa fa-chevron-left"></i></div><select id="shuoid" class="form-control" onchange="set_shuoshuo(\''+id+'\');">'+addstr+'</select><div class="input-group-addon onclick" title="下一页" onclick="getCommentList(\''+id+'\',$(\'#km_inputvalue\').val(),'+km+','+nextpage+')"><i class="fa fa-chevron-right"></i></div></div></div>');
					}else{
						$('#inputsname').append('<div class="form-group" id="show_shuoshuo"><div class="input-group"><div class="input-group-addon onclick" title="上一页" onclick="getCommentList(\''+id+'\',$(\'#inputvalue\').val(),'+km+','+lastpage+')"><i class="fa fa-chevron-left"></i></div><select id="shuoid" class="form-control" onchange="set_shuoshuo(\''+id+'\');">'+addstr+'</select><div class="input-group-addon onclick" title="下一页" onclick="getCommentList(\''+id+'\',$(\'#inputvalue\').val(),'+km+','+nextpage+')"><i class="fa fa-chevron-right"></i></div></div></div>');
					}
				}
				set_shuoshuo(id);
			}else{
				layer.alert('您的作品好像没人评论');
			}
		},
		error: function(a) {
			layer.close(ii);
			layer.alert('网络错误，请稍后重试');
		}
	});
}
function showOrder(id,skey){
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : "POST",
		url : "ajax.php?act=order",
		data : {id:id,skey:skey},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				var item = '<table class="table table-condensed table-hover">';
				item += '<tr><td colspan="6" style="text-align:center"><b>订单基本信息</b></td></tr><tr><td class="info">订单编号</td><td colspan="5">'+id+'</td></tr><tr><td class="info">商品名称</td><td colspan="5">'+data.name+'</td></tr><tr><td class="info">订单金额</td><td colspan="5">'+data.money+'元</td></tr><tr><td class="info">购买时间</td><td colspan="5">'+data.date+'</td></tr><tr><td class="info">下单信息</td><td colspan="5">'+data.inputs+'</td></tr>';
				if(data.list){
					item += '<tr><td colspan="6" style="text-align:center"><b>订单实时状态</b></td><tr><td class="warning">下单数量</td><td>'+data.list.num+'</td><td class="warning">下单时间</td><td colspan="3">'+data.list.add_time+'</td></tr><tr><td class="warning">初始数量</td><td>'+data.list.start_num+'</td><td class="warning">当前数量</td><td>'+data.list.now_num+'</td><td class="warning">订单状态</td><td><font color=blue>'+data.list.order_state+'</font></td></tr>';
				}else if(data.kminfo){
					item += '<tr><td colspan="6" style="text-align:center"><b>以下是你的卡密信息</b></td><tr><td colspan="6">'+data.kminfo+'</td></tr>';
				}
				if(data.alert){
					item += '<tr><td colspan="6" style="text-align:center"><b>商品简介</b></td><tr><td colspan="6">'+data.alert+'</td></tr></table>';
				}
				item += '</table>';
				layer.open({
				  type: 1,
				  title: '订单详细信息',
				  skin: 'layui-layer-rim',
				  content: item
				});
			}else{
				layer.alert(data.msg);
			}
		}
	});
}
var handlerEmbed = function (captchaObj) {
	captchaObj.appendTo('#captcha');
	captchaObj.onReady(function () {
		$("#wait").hide();
	}).onSuccess(function () {
		var result = captchaObj.getValidate();
		if (!result) {
			return alert('请完成验证');
		}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=pay",
			data : {tid:$("#tid").val(),inputvalue:$("#inputvalue").val(),inputvalue2:$("#inputvalue2").val(),inputvalue3:$("#inputvalue3").val(),inputvalue4:$("#inputvalue4").val(),inputvalue5:$("#inputvalue5").val(),num:$("#num").val(),hashsalt:hashsalt,geetest_challenge:result.geetest_challenge,geetest_validate:result.geetest_validate,geetest_seccode:result.geetest_seccode},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code >= 0){
					$('#alert_frame').hide();
					alert('领取成功！');
					window.location.href='?buyok=1';
				}else{
					layer.alert(data.msg);
					captchaObj.reset();
				}
			} 
		});
	});
};
$(document).ready(function(){
$("#showSearchBar").click(function () {
	$("#display_selectclass").slideToggle();
	$("#display_searchBar").slideToggle();
});
$("#closeSearchBar").click(function () {
	$("#display_searchBar").slideToggle();
	$("#display_selectclass").slideToggle();
});
$("#doSearch").click(function () {
	var kw = $("#searchkw").val();
	if(kw==''){$("#closeSearchBar").click();return;}
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$("#tid").empty();
	$("#tid").append('<option value="0">请选择商品</option>');
	$.ajax({
		type : "POST",
		url : "ajax.php?act=gettool",
		data : {kw:kw},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				var num = 0;
				$.each(data.data, function (i, res) {
					$("#tid").append('<option value="'+res.tid+'" cid="'+res.cid+'" price="'+res.price+'" alert="'+escape(res.alert)+'" inputname="'+res.input+'" inputsname="'+res.inputs+'" multi="'+res.multi+'" isfaka="'+res.isfaka+'" shopimg="'+res.shopimg+'">'+res.name+'</option>');
					num++;
				});
				$("#tid").val(0);
				getPoint();
				if(num==0 && cid!=0)$("#tid").html('<option value="0">没有搜索到相关商品</option>');
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
});
$("#inputvalue").blur(function () {
	if($("#inputname").html() == '快手ID'||$("#inputname").html() == '快手ＩＤ'||$("#inputname").html() == '快手用户ID'){
		if($("#inputvalue").val()!='' && $("#inputvalue").val().indexOf('http')>=0){
			getkuaishouid();
		}
	}
	if($("#inputname").html() == '歌曲ID'||$("#inputname").html() == '歌曲ＩＤ'){
		if($("#inputvalue").val().indexOf("s=") ==-1){
			if($("#inputvalue").val().length != 12 && $("#inputvalue").val().length != 16){
				layer.alert('歌曲ID是一串12位或16位的字符!<br>输入K歌作品链接即可！');
				return false;
			}
		}else if($("#inputvalue").val()!=''){
			getsongid();
		}
	}
	if($("#inputname").html() == '火山ID'||$("#inputname").html() == '火山作品ID'||$("#inputname").html() == '火山ＩＤ'){
		if($("#inputvalue").val()!='' && $("#inputvalue").val().indexOf('http')>=0){
			gethuoshanid();
		}
	}
	if($("#inputname").html() == '抖音ID'||$("#inputname").html() == '抖音作品ID'||$("#inputname").html() == '抖音ＩＤ'){
		if($("#inputvalue").val()!='' && $("#inputvalue").val().indexOf('http')>=0){
			getdouyinid();
		}
	}
	if($("#inputname").html() == '微视ID'||$("#inputname").html() == '微视作品ID'||$("#inputname").html() == '微视ＩＤ'||$("#inputname").html() == '微视主页ID'){
		if($("#inputvalue").val()!='' && $("#inputvalue").val().indexOf('http')>=0){
			getweishiid();
		}
	}
	if($("#inputname").html() == '头条ID'||$("#inputname").html() == '头条ＩＤ'){
		if($("#inputvalue").val()!='' && $("#inputvalue").val().indexOf('http')>=0){
			gettoutiaoid();
		}
	}
});
$("#cid").change(function () {
	var cid = $(this).val();
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$("#tid").empty();
	$("#tid").append('<option value="0">请选择商品</option>');
	$.ajax({
		type : "GET",
		url : "ajax.php?act=gettool&cid="+cid,
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				var num = 0;
				$.each(data.data, function (i, res) {
					$("#tid").append('<option value="'+res.tid+'" cid="'+res.cid+'" price="'+res.price+'" alert="'+escape(res.alert)+'" inputname="'+res.input+'" inputsname="'+res.inputs+'" multi="'+res.multi+'" isfaka="'+res.isfaka+'" count="'+res.value+'">'+res.name+'</option>');
					num++;
				});
				if($_GET["tid"]){
					var tid = parseInt($_GET["tid"]);
					$("#tid").val(tid);
				}else{
					$("#tid").val(0);
				}
				getPoint();
				if(num==0 && cid!=0)$("#tid").html('<option value="0">该分类下没有商品</option>');
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
});
	$("#submit_buy").click(function(){
		var tid=$("#tid").val();
		if(tid==0){layer.alert('请选择商品！');return false;}
		var inputvalue=$("#inputvalue").val();
		if(inputvalue=='' || tid==''){layer.alert('请确保每项不能为空！');return false;}
		if($("#inputvalue2").val()=='' || $("#inputvalue3").val()=='' || $("#inputvalue4").val()=='' || $("#inputvalue5").val()==''){layer.alert('请确保每项不能为空！');return false;}
		if($('#inputname').html()=='下单ＱＱ' && (inputvalue.length<5 || inputvalue.length>11 || isNaN(inputvalue))){layer.alert('请输入正确的QQ号！');return false;}
		var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
		if($('#inputname').html()=='你的邮箱' && !reg.test(inputvalue)){layer.alert('邮箱格式不正确！');return false;}
		if($("#inputname2").html() == '说说ID'||$("#inputname2").html() == '说说ＩＤ'){
			if($("#inputvalue2").val().length != 24){layer.alert('说说必须是原创说说！');return false;}
		}
		$("#inputvalue").blur();
		if($("#inputname2").html() == '作品ID'||$("#inputname2").html() == '作品ＩＤ'){
			if($("#inputvalue2").val()!='' && $("#inputvalue2").val().indexOf('http')>=0){
				$("#inputvalue").val($("#inputvalue2").val());
				get_kuaishou('inputvalue2',$('#inputvalue').val());
			}
		}
		if($("#inputname").html() == '抖音作品ID'||$("#inputname").html() == '火山作品ID'||$("#inputname").html() == '火山直播ID'){
			if($("#inputvalue").val().length != 19){layer.alert('您输入的作品ID有误！');return false;}
		}
		if($("#inputname2").html() == '抖音评论ID'){
			if($("#inputvalue2").val().length != 16){layer.alert('您输入的评论ID有误！请点击自动获取手动选择评论！');return false;}
		}
		$('#pay_frame').hide();
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=pay",
			data : {tid:tid,inputvalue:inputvalue,inputvalue2:$("#inputvalue2").val(),inputvalue3:$("#inputvalue3").val(),inputvalue4:$("#inputvalue4").val(),inputvalue5:$("#inputvalue5").val(),num:$("#num").val(),hashsalt:hashsalt},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					$('#alert_frame').hide();
					$('#tid').attr("disabled",true);
					$('#qq1').attr("disabled",true);
					$('#submit_buy').hide();
					$('#orderid').val(data.trade_no);
					$('#needs').val("￥"+data.need);
					$("#pay_frame").slideDown();
					if($('#inputname').html()=='你的邮箱'){
						$.cookie('email', inputvalue);
					}
				}else if(data.code == 1){
					$('#alert_frame').hide();
					if($('#inputname').html()=='你的邮箱'){
						$.cookie('email', inputvalue);
					}
					alert('领取成功！');
					window.location.href='?buyok=1';
				}else if(data.code == 2){
					$.getScript("//static.geetest.com/static/tools/gt.js");
					layer.open({
					  type: 1,
					  title: '完成验证',
					  skin: 'layui-layer-rim',
					  area: ['320px', '100px'],
					  content: '<div id="captcha"><p id="wait" class="text-center">正在加载验证码......</p></div>'
					});
					$.ajax({
						url: "ajax.php?act=captcha&t=" + (new Date()).getTime(),
						type: "get",
						dataType: "json",
						success: function (data) {
							console.log(data);
							initGeetest({
								gt: data.gt,
								challenge: data.challenge,
								new_captcha: data.new_captcha,
								product: "popup",
								width: "100%",
								offline: !data.success
							}, handlerEmbed);
						}
					});
				}else{
					layer.alert(data.msg);
				}
			} 
		});
	});
	$("#submit_checkkm").click(function(){
		var km=$("#km").val();
		if(km==''){layer.alert('请确保卡密不能为空！');return false;}
		$('#submit_km').val('Loading');
		$('#km_show_frame').hide();
		$.ajax({
			type : "POST",
			url : "ajax.php?act=checkkm",
			data : {km:km},
			dataType : 'json',
			success : function(data) {
				if(data.code == 0){
					$('#submit_checkkm').hide();
					$('#km').attr("disabled",true);
					$('#km_tid').val(data.tid);
					$('#km_name').val(data.name);
					if(data.alert!=''){
						$('#km_alert_frame').show();
						$('#km_alert_frame').html(data.alert);
					}else{
						$('#km_alert_frame').hide();
					}
					var inputname = data.inputname;
					if(inputname!=''){
						$('#km_inputname').html(inputname);
					}else{
						$('#km_inputname').html("下单ＱＱ");
					}
					var inputsname = data.inputsname;
					if(inputsname!=''){
						$('#km_inputsname').html("");
						$.each(inputsname.split('|'), function(i, value) {
							if(value=='说说ID'||value=='说说ＩＤ')
								var addstr='<div class="input-group-addon onclick" onclick="get_shuoshuo(\'km_inputvalue'+(i+2)+'\',$(\'#km_inputvalue\').val(),1)">自动获取</div>';
							else if(value=='日志ID'||value=='日志ＩＤ')
								var addstr='<div class="input-group-addon onclick" onclick="get_rizhi(\'km_inputvalue'+(i+2)+'\',$(\'#km_inputvalue\').val(),1)">自动获取</div>';
							else
								var addstr='';
							$('#km_inputsname').append('<div class="form-group"><div class="input-group"><div class="input-group-addon" id="km_inputname">'+value+'</div><input type="text" name="inputvalue'+(i+2)+'" id="km_inputvalue'+(i+2)+'" value="" class="form-control" required/>'+addstr+'</div></div>');
						});
						$('#km_inputsname').show();
					}else{
						$('#km_inputsname').html("");
						$('#km_inputsname').hide();
					}

					$("#km_show_frame").slideDown();
				}else{
					layer.alert(data.msg);
				}
				$('#submit_checkkm').val('检查卡密');
			} 
		});
	});
	$("#submit_card").click(function(){
		var km=$("#km").val();
		var inputvalue=$("#km_inputvalue").val();
		if(inputvalue=='' || km==''){layer.alert('请确保每项不能为空！');return false;}
		if($("#km_inputvalue2").val()=='' || $("#km_inputvalue3").val()=='' || $("#km_inputvalue4").val()=='' || $("#km_inputvalue5").val()==''){layer.alert('请确保每项不能为空！');return false;}
		if($('#km_inputname').html()=='下单ＱＱ' && (inputvalue.length<5 || inputvalue.length>11)){layer.alert('请输入正确的QQ号！');return false;}
		if($("#km_inputname2").html() == '说说ID'||$("#km_inputname2").html() == '说说ＩＤ'){
			if($("#km_inputvalue2").val().length != 24){layer.alert('说说必须是原创说说！');return false;}
		}
		$('#submit_card').val('Loading');
		$('#result1').hide();
		$.ajax({
			type : "POST",
			url : "ajax.php?act=card",
			data : {km:km,inputvalue:inputvalue,inputvalue2:$("#km_inputvalue2").val(),inputvalue3:$("#km_inputvalue3").val(),inputvalue4:$("#km_inputvalue4").val(),inputvalue5:$("#km_inputvalue5").val()},
			dataType : 'json',
			success : function(data) {
				if(data.code == 0){
					alert(data.msg);
					window.location.href='?buyok=1';
				}else{
					layer.alert(data.msg);
				}
				$('#submit_card').val('立即购买');
			} 
		});
	});
	$("#submit_query").click(function(){
		var qq=$("#qq3").val();
		//if(qq==''){layer.alert('请确保每项不能为空！');return false;}
		$('#submit_query').val('Loading');
		$('#result2').hide();
		$('#list').html('');
		$.ajax({
			type : "POST",
			url : "ajax.php?act=query",
			data : {qq:qq},
			dataType : 'json',
			success : function(data) {
				if(data.code == 0){
					var status;
					$.each(data.data, function(i, item){
						if(item.status==1)
							status='<span class="label label-success">已完成</span>';
						else if(item.status==2)
							status='<span class="label label-warning">处理中</span>';
						else if(item.status==3)
							status='<span class="label label-danger">异常</span>&nbsp;<button type="submit" class="btn btn-info btn-xs" onclick="fillOrder('+item.id+',\''+item.skey+'\')">补交</button>';
						else if(item.status==4)
							status='<font color=red>已退款</font>';
						else
							status='<span class="label label-primary">待处理</span>';
						$('#list').append('<tr orderid='+item.id+'><td>'+item.input+'</td><td>'+item.name+'</td><td>'+item.value+'</td><td class="hidden-xs">'+item.addtime+'</td><td>'+status+'</td><td><a onclick="showOrder('+item.id+',\''+item.skey+'\')" title="查看订单详细" class="btn btn-info btn-xs">详细</a></td></tr>');
						if(item.result!=null){
							if(item.status==3){
								$('#list').append('<tr><td colspan=5><font color="red">异常原因：'+item.result+'</font></td></tr>');
							}else{
								$('#list').append('<tr><td colspan=5><font color="blue">处理结果：'+item.result+'</font></td></tr>');
							}
						}
					});
					$("#result2").slideDown();
					if($_GET['buyok']){
						showOrder(data.data[0].id,data.data[0].skey)
					}
				}else{
					layer.alert(data.msg);
				}
				$('#submit_query').val('立即查询');
			} 
		});
	});
	$("#submit_lqq").click(function(){
		var qq=$("#qq4").val();
		if(qq==''){layer.alert('QQ号不能为空！');return false;}
		if(qq.length<5 || qq.length>11){layer.alert('请输入正确的QQ号！');return false;}
		$('#result3').hide();
		if($.cookie('lqq') && $.cookie('lqq').indexOf(qq)>=0){
			$('#result3').html('<div class="alert alert-success"><img src="assets/img/ico_success.png">&nbsp;该QQ已经提交过，请勿重复提交！</div>');
			$("#result3").slideDown();
			return false;
		}
		$('#submit_lqq').val('Loading');
		$.ajax({
			type : "POST",
			url : "ajax.php?act=lqq",
			data : {qq:qq,salt:hashsalt},
			dataType : 'json',
			success : function(data) {
				if($.cookie('lqq')){
					$.cookie('lqq', $.cookie('lqq')+'-'+qq);
				}else{
					$.cookie('lqq', qq);
				}
				$('#result3').html('<div class="alert alert-success"><img src="assets/img/ico_success.png">&nbsp;QQ已提交 正在为您排队,可能需要一段时间 请稍后查看圈圈增长情况</div>');
				$("#result3").slideDown();
				$('#submit_lqq').val('立即提交');
			} 
		});
	});
$("#buy_alipay").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='other/submit.php?type=alipay&orderid='+orderid;
});
$("#buy_qqpay").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='other/submit.php?type=qqpay&orderid='+orderid;
});
$("#buy_wxpay").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='other/submit.php?type=wxpay&orderid='+orderid;
});
$("#buy_tenpay").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='other/submit.php?type=tenpay&orderid='+orderid;
});
$("#buy_shop").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='shop.php?act=submit&orderid='+orderid;
});

var i = $("#num").val();
$("#num_add").click(function () {
	if ($("#need").val() == ''){
		layer.alert('请先选择商品');
		return false;
	}
	var multi = $('#tid option:selected').attr('multi');
	var count = $('#tid option:selected').attr('count');
	if (multi == 0){
		layer.alert('该商品不支持选择数量');
		return false;
	}
	i++;
	var price = $('#tid option:selected').attr('price');
	$("#num").val(i);
	price = price * i;
	count = count * i;
	if(count>0)$('#need').val('￥'+price.toFixed(2) +"元 ➠ "+count+"个");
	else $('#need').val('￥'+price.toFixed(2) +"元");
});
$("#num_min").click(function (){
	if($("#num").val()<=1){
    	layer.msg('最低下单一份哦！'); 
      	return false;
    }
	if ($("#need").val() == ''){
		layer.alert('请先选择商品');
		return false;
	}
	var multi = $('#tid option:selected').attr('multi');
	var count = $('#tid option:selected').attr('count');
	if (multi == 0){
		layer.alert('该商品不支持选择数量');
		return false;
	}
	i--;
	var price = $('#tid option:selected').attr('price');
	$("#num").val(i);
	price = price * i;
	count = count * i;
	if(count>0)$('#need').val('￥'+price.toFixed(2) +"元 ➠ "+count+"个");
	else $('#need').val('￥'+price.toFixed(2) +"元");
	if (i <= 0) {
		$("#num").val(1);
		i = 1;
		if(count>0)$('#need').val('￥'+$('#tid option:selected').attr('price') +"元 ➠ "+count+"个");
		else $('#need').val('￥'+$('#tid option:selected').attr('price') +"元");
	}
});
$("#num").blur(function () {
	var price = $('#tid option:selected').attr('price');
	var count = $('#tid option:selected').attr('count');
	if($("#num").val()<1){
		$("#num").val("1")
	}
	price = price * $("#num").val();
	count = count * $("#num").val();
	if(count>0)$('#need').val('￥'+price.toFixed(2) +"元 ➠ "+count+"个");
	else $('#need').val('￥'+price.toFixed(2) +"元");
});

var gogo; 
$("#start").click(function(){
	ii=layer.load(1,{shade:0.3});
	$.ajax({
		type:"GET",
		url:"ajax.php?act=gift_start",
		dataType:"json",
		success:function(choujiang){
			layer.close(ii);
			if(choujiang.code == 0){
				$("#start").css("display",'none');
				$("#stop").css("display",'block');
				var obj = eval(choujiang.data);
                var len = obj.length;
                gogo = setInterval(function(){
                    var num = Math.floor(Math.random()*len);
                    var id = obj[num]['tid'];
                    var v = obj[num]['name'];
                    $("#roll").html(v);
                },100);
			}else{
				layer.alert(choujiang.msg);
			}
		}
	});
});
$("#stop").click(function(){
	ii=layer.load(1,{shade:0.3});
	clearInterval(gogo);
	$("#roll").html('正在抽奖中..');
	var rand = Math.random(1);
	$.ajax({
		type:"GET",
		url:"ajax.php?act=gift_start&action=ok&r=" + rand,
		dataType:"json",
		success:function(msg){
			layer.close(ii);
			if(msg.code==0){
				$.ajax({
					type:"POST",
					url:"ajax.php?act=gift_stop&r=" + rand,
					data:{hashsalt:hashsalt,token:msg.token},
					dataType:"json",
					success:function(data){
						if(data.code == 0){
							$("#roll").html('恭喜您抽到奖品：'+data.name);
							$("#start").css("display",'block');
							$("#stop").css("display",'none');
							layer.alert('恭喜您抽到奖品：'+data.name+'，请填写中奖信息', {
							  skin: 'layui-layer-lan'
							  ,closeBtn: 0
							}, function(){
								window.location.href='?gift=1&cid='+data.cid+'&tid='+data.tid;
							});
						}else{
							layer.alert(data.msg,{icon:2,shade:0.3});
							$("#roll").html('点击下方按钮开始抽奖');
							$("#start").css("display",'block');
							$("#stop").css("display",'none');
						}
					}
				});
			}else{
				layer.alert(msg.msg,{icon:2,shade:0.3});
				$("#start").css("display",'block');
				$("#stop").css("display",'none');
			}
		}
	});
});


if(homepage == true){
	getcount();
}
if($_GET['buyok']){
	var orderid = $_GET['orderid'];
	$("#tab-query").tab('show');
	$("#submit_query").click();
	isModal=false;
}
if($_GET['gift']){
	isModal=false;
}
if($_GET['cid']){
	var cid = parseInt($_GET['cid']);
	$("#cid").val(cid);
}
$("#cid").change();

if($.cookie('sec_defend_time'))$.removeCookie('sec_defend_time', { path: '/' });
if( !$.cookie('op') && isModal==true){
	$('#myModal').modal({
		keyboard: true
	});
	var cookietime = new Date(); 
	cookietime.setTime(cookietime.getTime() + (60*60*1000));
	$.cookie('op', false, { expires: cookietime });
}
var visits = $.cookie("counter")
if(!visits)
{
 visits=1;
}
else
{
 visits=parseInt(visits)+1;
}
$('#counter').html(visits);
$.cookie("counter", visits, 24*60*60*30);
});