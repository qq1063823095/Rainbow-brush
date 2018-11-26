<?php
include 'head.php';
?>

	<div class="s3"><?php echo $conf['sitename']?></div>
		<div class="s2"><img src="<?php echo $cdnserver?>assets/qiuqiu/images/y1.png" /></div>
		<div class="s1"><img src="<?php echo $cdnserver?>assets/qiuqiu/images/hj.png" /></div>
	</div>
	<div class="nav">
		<ul>

			<li><span class="nav-txt" onclick='location.href="./"'>首页</span></li>
			<li><s class="wao">送龙蛋</s><span class="nav-txt" onclick='location.href="./?mod=tool"' style="color:#ff585d;">秒点</span></li>
			<li class="ks-active"><span class="nav-txt" onclick='location.href="./?mod=pattern";'>字体</span></li>
			<li><span class="nav-txt" onclick='location.href="./?mod=about";'>关于</span></li>
	</div>
</div><div id="bd">
<div class="ct">
        <div id="options" class="options">

            <ul id="op" class="op">
                <li class="active" Index="0">颜色</li>
                <li Index="1">符号</li>
                <li Index="2">热词</li>
            </ul>

            <div id="Dcolor" class="oD Dcolor show">
                <ul><li style="background-color: #000000"></li><li style="background-color: #2F0000"></li><li style="background-color: #600030"></li><li style="background-color: #460046"></li><li style="background-color: #28004D"></li><li style="background-color: #000079"></li><li style="background-color: #000079"></li><li style="background-color: #003E3E"></li><li style="background-color: #006030"></li><li style="background-color: #006000"></li><li style="background-color: #467500"></li><li style="background-color: #424200"></li><li style="background-color: #5B4B00"></li><li style="background-color: #844200"></li><li style="background-color: #642100"></li><li style="background-color: #613030"></li><li style="background-color: #616130"></li><li style="background-color: #336666"></li><li style="background-color: #484891"></li><li style="background-color: #6C3365"></li><li style="background-color: #4F4F4F"></li><li style="background-color: #750000"></li><li style="background-color: #BF0060"></li><li style="background-color: #930093"></li><li style="background-color: #5B00AE"></li><li style="background-color: #0000C6"></li><li style="background-color: #005AB5"></li><li style="background-color: #009393"></li><li style="background-color: #01B468"></li><li style="background-color: #00A600"></li><li style="background-color: #73BF00"></li><li style="background-color: #8C8C00"></li><li style="background-color: #AE8F00"></li><li style="background-color: #D26900"></li><li style="background-color: #BB3D00"></li><li style="background-color: #804040"></li><li style="background-color: #808040"></li><li style="background-color: #408080"></li><li style="background-color: #5A5AAD"></li><li style="background-color: #8F4586"></li><li style="background-color: #7B7B7B"></li><li style="background-color: #CE0000"></li><li style="background-color: #FF0080"></li><li style="background-color: #E800E8"></li><li style="background-color: #921AFF"></li><li style="background-color: #4A4AFF"></li><li style="background-color: #0080FF"></li><li style="background-color: #00E3E3"></li><li style="background-color: #02F78E"></li><li style="background-color: #00EC00"></li><li style="background-color: #9AFF02"></li><li style="background-color: #E1E100"></li><li style="background-color: #EAC100"></li><li style="background-color: #FF9224"></li><li style="background-color: #FF5809"></li><li style="background-color: #984B4B"></li><li style="background-color: #949449"></li><li style="background-color: #4F9D9D"></li><li style="background-color: #7373B9"></li><li style="background-color: #9F4D95"></li><li style="background-color: #ADADAD"></li><li style="background-color: #FF2D2D"></li><li style="background-color: #FF79BC"></li><li style="background-color: #FF77FF"></li><li style="background-color: #BE77FF"></li><li style="background-color: #9393FF"></li><li style="background-color: #66B3FF"></li><li style="background-color: #80FFFF"></li><li style="background-color: #7AFEC6"></li><li style="background-color: #79FF79"></li><li style="background-color: #C2FF68"></li><li style="background-color: #FFFF6F"></li><li style="background-color: #FFE153"></li><li style="background-color: #FFBB77"></li><li style="background-color: #FF9D6F"></li><li style="background-color: #C48888"></li><li style="background-color: #B9B973"></li><li style="background-color: #81C0C0"></li><li style="background-color: #A6A6D2"></li><li style="background-color: #C07AB8"></li><li style="background-color: #E0E0E0"></li><li style="background-color: #FF9797"></li><li style="background-color: #FFC1E0"></li><li style="background-color: #FFBFFF"></li><li style="background-color: #DCB5FF"></li><li style="background-color: #CECEFF"></li><li style="background-color: #ACD6FF"></li><li style="background-color: #CAFFFF"></li><li style="background-color: #C1FFE4"></li><li style="background-color: #BBFFBB"></li><li style="background-color: #DEFFAC"></li><li style="background-color: #FFFFB9"></li><li style="background-color: #FFF0AC"></li><li style="background-color: #FFDCB9"></li><li style="background-color: #FFCBB3"></li><li style="background-color: #E1C4C4"></li><li style="background-color: #D6D6AD"></li><li style="background-color: #B3D9D9"></li><li style="background-color: #D8D8EB"></li><li style="background-color: #DAB1D5"></li><li style="background-color: #FFFFFF"></li><li style="background-color: #FFECEC"></li><li style="background-color: #FFF7FB"></li><li style="background-color: #FFF7FF"></li><li style="background-color: #FAF4FF"></li><li style="background-color: #FBFBFF"></li><li style="background-color: #ECF5FF"></li><li style="background-color: #FDFFFF"></li><li style="background-color: #FBFFFD"></li><li style="background-color: #F0FFF0"></li><li style="background-color: #F5FFE8"></li><li style="background-color: #FFFFF4"></li><li style="background-color: #FFFCEC"></li><li style="background-color: #FFFAF4"></li><li style="background-color: #FFF3EE"></li><li style="background-color: #F2E6E6"></li><li style="background-color: #E8E8D0"></li><li style="background-color: #D1E9E9"></li><li style="background-color: #F3F3FA"></li><li style="background-color: #EBD3E8"></li></ul>
            </div>

            <div id="Dfont" class="oD Dfont">
               <ul><li>✾</li><li>ζ</li><li>❦</li><li>❧</li><li>ุ</li><li>ู</li><li>ั</li><li>็</li><li>ิ</li><li>ี</li><li>ึ</li><li>ื</li><li>҉</li><li>ʚ</li><li>ɞ</li><li>ε</li><li>з</li><li>◥</li><li>◤</li><li>☜</li><li>☞</li><li>༽</li><li>༼</li><li>༺</li><li>༻</li><li>╰</li><li>⊱</li><li>⋛</li><li>⋋</li><li>⋌</li><li>⋚</li><li>⊰</li><li>╯</li><li>╰</li><li>︶</li><li>﹉๑</li><li>๑</li><li>﹉</li><li>︶</li><li>╯</li><li>ℳ</li><li>ℓ</li><li>ℓ</li><li>ℳ</li><li>ก</li><li>จ</li><li>ฎ</li><li>ฏ</li><li>ด</li><li>ต</li><li>บ</li><li>ป</li><li>อ</li><li>ข</li><li>ฃ</li><li>ฉ</li><li>ฐ</li><li>ถ</li><li>ผ</li><li>ฝ</li><li>ช</li><li>ซ</li><li>ฌ</li><li>ญ</li><li>ฑ</li><li>ฒ</li><li>ณ</li><li>ท</li><li>ธ</li><li>น</li><li>พ</li><li>ฟ</li><li>ภ</li><li>ม</li><li>ย</li><li>ร</li><li>ล</li><li>ว</li><li>ฬ</li><li>ฮ</li><li>ღ</li><li>❣</li><li>❤</li><li>❥</li><li>❦</li><li>❧</li><li>♣</li><li>♦</li><li>♥</li><li>♠</li><li>☚</li><li>☛</li><li>☜</li><li>☝</li><li>☞</li><li>☟</li><li>✌</li><li>✍</li><li>ϟ</li><li>☀</li><li>☁</li><li>☂</li><li>☃</li><li>☄</li><li>☉</li><li>❅</li><li>❄</li><li>♨</li><li>♁</li><li>☾</li><li>☽</li><li>☼</li><li>❆</li><li>♈</li><li>♉</li><li>♊</li><li>♋</li><li>♌</li><li>♍</li><li>♎</li><li>♓</li><li>♒</li><li>♑</li><li>♐</li><li>♏</li><li>♩</li><li>♪</li><li>♫</li><li>♬</li><li>♭</li><li>♮</li><li>♯</li><li>☹</li><li>☺</li><li>☻</li><li>☿</li><li>♀</li><li>♂</li><li>ツ</li><li>유</li><li>웃</li><li>㋡</li><li>★</li><li>☆</li><li>✡</li><li>✦</li><li>✧</li><li>✩</li><li>✪</li><li>✰</li><li>✯</li><li>✮</li><li>✭</li><li>✬</li><li>✫</li></ul>
            </div>

            <div id="Dkey" class="oD Dkey">
                <ul><li>蠢</li><li>笑脸</li><li>龇牙</li><li>板牙</li><li>不屑</li><li>吃</li><li>丑</li><li>愤怒</li><li>发狂</li><li>花痴</li><li>紧张</li><li>泪奔</li><li>挑衅</li><li>星星眼</li><li>滑稽</li><li>暴走</li><li>●—●</li><li>酷酷</li><li>萌萌</li><li>饼干</li><li>橙子</li><li>苹果</li><li>橘子</li><li>巧克力</li><li>桃子</li><li>西瓜</li><li>糖果</li><li>咸蛋</li><li>南瓜头</li><li>地球</li><li>earth</li><li>火星</li><li>mars</li><li>冥王星</li><li>pluto</li><li>月亮</li><li>moon</li><li>星球</li><li>狗</li><li>dog</li><li>虎</li><li>牛</li><li>鸟</li><li>青蛙</li><li>鼠</li><li>熊</li><li>熊猫</li><li>猪</li><li>猫咪</li><li>鸭子</li><li>奥斯卡</li><li>菲露露</li><li>咯洛洛</li><li>咕噜咕噜</li><li>哈嗒</li><li>塔坦</li><li>希哩哩</li><li>球球</li><li>魔兽</li><li>刀塔</li><li>dota</li><li>撸啊撸</li><li>lol</li><li>我的世界</li><li>部落</li><li>炫斗三国志</li><li>斗鱼</li><li>武极天下</li><li>刀塔</li><li>仙侠世界</li><li>大主宰</li><li>征途口袋</li><li>洛克王</li><li>黑猫警长</li><li>葫芦娃</li><li>篮球</li><li>足球</li><li>剪纸</li><li>骷髅</li><li>青花瓷</li><li>雨伞</li><li>炸弹</li><li>指南针</li><li>葫芦</li><li>二维码</li><li>baby</li></ul>
            </div>
        </div>
        <!-- 文字表单 -->
        <div class="form-post">
            <form id="setForm" class="form-input">
                <p><input type="text" name="txt" placeholder="请输入游戏昵称,系统为您生成代码！" value=""></p>
                <p>
                    <button type="reset" name="reset" class="reset">清除全部</button>
                    <button type="button" name="set" class="set">生成花字体</button>
                </p>
            </form>
        </div>

        <!-- 生成的内容 -->
        <div id="rate" class="rate">
            
        </div>
</div>
</div>
</div>

<script src="<?php echo $cdnserver?>assets/qiuqiu/js/font.js"></script>
  </article>
<?php include 'foot.php';?>