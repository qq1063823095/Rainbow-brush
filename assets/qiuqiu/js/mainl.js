function submit() {
			loadgo("1");
			var b = document.getElementById("url").value;
			b=b.replace(/\s+/g,"");
			if (null == b.match(/^http:\/\/dwz\.cn\/\w+$/) && null == b.match(/^http:\/\/t\.cn\/\w+$/)){
			loadgo("2");
			$.Confirm("", "请输入球球大作战专属推广链接！<br>游戏里右边->获取棒棒糖<br>点击复制链接,粘贴到本站即可！"  + "", 1);
			return ;
			}
			$.ajax({
				
				url: "do.php?url=" + b,
				dataType: "json",
				success: function(a) {
					loadgo("2");
					var gg = "";
					switch (a.code) {
					case "0":
						$.Confirm("", "尊敬的：<span style=\"color:red;\">" + a.account + "</span>[" + a.id + "]，您好！<br>您的棒棒糖已刷取完毕，请前往游戏查看！<br>若未到账，请检查以下两点:<br>1.当天已经获得5个棒棒糖<br>2.本周已经获得了20个棒棒糖" + gg, 1);
						break;
					case "1":
						$.Confirm("", "尊敬的：<span style=\"color:red;\">" + a.account + "</span>[" + a.id + "]，您好！<br>您的棒棒糖今天已刷达上限，明天再来吧！" + gg, 1);
						break;
					case "2":
						$.Confirm("", "尊敬的：<span style=\"color:red;\">" + a.account + "</span>[" + a.id + "]，您好！<br>您的棒棒糖今天已刷达上限，明天再来吧！" + gg, 1);
					break;
					case "3":
						$.Confirm("", "尊敬的：<span style=\"color:red;\">" + a.account + "</span>[" + a.id + "]，您好！<br>您的棒棒糖本周已刷达上限，下周再来吧！" + gg, 1);
						break;
					case "4":
						$.Confirm("", "尊敬的：<span style=\"color:red;\">" + a.account + "</span>[" + a.id + "]，您好！<br>您今天已经刷过了，明天在来吧！<br>若未到账，请检查以下两点:<br>1.当天已经获得5个棒棒糖<br>2.本周已经获得了20个棒棒糖" + gg, 1);
						break;
					case "-1":
						$.Confirm("", "您还没有输入邀请链接！请打开球球大作战游戏->点击右上角加号->点击获取棒棒糖->点击复制链接,粘贴到本站即可！" + gg, 1);
						break;
					case "-5":
						$.Confirm("", "解析邀请链接地址失败！请重试！<br>或者您的邀请链接输错了，请打开球球大作战游戏->点击右上角加号->点击获取棒棒糖->点击复制链接,粘贴到本站即可！" + gg, 1);
						break;
					case "-3000":
						$.Confirm("", "-3000！刷棒棒糖失败！" , 1);
						break;
						}
				},
				error: function(a) {
					loadgo("2");
					$.Confirm("", "<P class=\"guanggao\">连接服务器失败，请检查链接是否正确后再重试！</p>", 1);
				}
			})
		}

function longdan() {
			loadgo("1");
			var b = document.getElementById("url").value;
			b=b.replace(/\s+/g,"");
			if (null == b.match(/^http:\/\/dwz\.cn\/\w+$/) && null == b.match(/^http:\/\/t\.cn\/\w+$/)){
				loadgo("2");
				$.Confirm("", "请输入球球大作战专属推广链接！<br>游戏里右边->获取棒棒糖<br>点击复制链接,粘贴到本站即可！"  + "", 1);
				return ;
			}
			$.ajax({
				url: "ld.php?url=" + b ,
				dataType: "json",
				success: function(a) {
					loadgo("2");
					var gg = "";
					switch (a.code) {
					case "0":
						$.Confirm("", "尊敬的：<span style=\"color:red;\">" + a.account + "</span>[" + a.id + "]，您好！<br>您的龙蛋已提交成功，龙蛋会陆续到账！" + gg, 1);
						break;
					case "1":
						$.Confirm("", "尊敬的：<span style=\"color:red;\">" + a.account + "</span>[" + a.id + "]，您好！<br>您今天的龙蛋已上限，请勿重复提交！" + gg, 1);
						break;
					case "2":
						$.Confirm("", "尊敬的：<span style=\"color:red;\">" + a.account + "</span>[" + a.id + "]，您好！<br>您提交的龙蛋正在刷取中，请耐心等待到账！" + gg, 1);
						break;
					case "101":
						$.Confirm("", "提交速度太快，请过几秒再试", 1);
						break;
					case "102":
						$.Confirm("", "提交过于频繁，请过一会再来", 1);
						break;
					case "-10112":
						$.Confirm("", "提交失败，请重试<br>如连续出此提示请截屏联系客服QQ46245520", 1);
						break;
					case "3":
						$.Confirm("", "您还没有输入邀请链接！请打开球球大作战游戏->点击右上角加号->点击获取棒棒糖->点击复制链接,粘贴到本站即可！", 1);
						break;
					case "-3000":
						$.Confirm("", "-3000！刷龙蛋失败！", 1);
						break;
					}
				},
				error: function(a) {
					loadgo("2");
					$.Confirm("", "<P class=\"guanggao\">啊哦~小伙伴们太热情了~<br>一会再来试试吧~</p>", 1);
				}
			})
		}