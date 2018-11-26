<?php
if(!defined('IN_CRONLITE'))exit();
class Price {
	private $zid;
	private $upzid;
	private $super;
	private $price_array = array();
	private $up_price_array = array();
	private $tool = array();

	public function __construct($zid,$siterow=null){
		global $DB;
		$this->zid=$zid;
		if(!$siterow)$siterow=$this->getSiteInfo($zid);
		$this->price_array = @unserialize($siterow['price']);
		$this->super = $siterow['power'];
		if($this->super==0){
			$data = $DB->get_row("SELECT price FROM shua_site WHERE zid='{$siterow['upzid']}' and power=1 limit 1");
			if($data){
				$this->up_price_array = @unserialize($data['price']);
				$this->upzid=$siterow['upzid'];
			}
		}
	}
	public function setToolInfo($tid,$row=null){
		global $DB;
		if(!$row)$row=$this->getToolInfo($tid);
		$this->tool=$row;
	}
	public function getToolPrice($tid){
		if($this->super==0 && $this->up_price_array[$tid]['cost'] && ($this->up_price_array[$tid]['cost']>=$this->tool['cost2'] && $this->tool['cost2']>0 || $this->up_price_array[$tid]['cost']>=$this->tool['cost'] && $this->tool['cost']>0 || $this->up_price_array[$tid]['cost']>=$this->tool['price'])){
			$cost = $this->up_price_array[$tid]['cost'];
		}elseif($this->super==1 && $this->price_array[$tid]['cost'] && ($this->price_array[$tid]['cost']>=$this->tool['cost2'] && $this->tool['cost2']>0 || $this->price_array[$tid]['cost']>=$this->tool['cost'] && $this->tool['cost']>0 || $this->price_array[$tid]['cost']>=$this->tool['price'])){
			$cost = $this->price_array[$tid]['cost'];
		}elseif($this->tool['cost']>0){
			$cost = $this->tool['cost'];
		}else{
			$cost = $this->tool['price'];
		}
		if($this->price_array[$tid]['price'] && $this->price_array[$tid]['price']>=$cost && $cost>0){
			$price=$this->price_array[$tid]['price'];
		}elseif($this->price_array[$tid]['price'] && $cost>$this->price_array[$tid]['price'] || $cost>$this->tool['price']){
			$price=$cost;
		}else{
			$price=$this->tool['price'];
		}
		return $price;
	}
	public function getToolCost($tid){
		if($this->super==0 && $this->up_price_array[$tid]['cost'] && ($this->up_price_array[$tid]['cost']>=$this->tool['cost2'] && $this->tool['cost2']>0 || $this->up_price_array[$tid]['cost']>=$this->tool['cost'] && $this->tool['cost']>0 || $this->up_price_array[$tid]['cost']>=$this->tool['price'])){
			$cost = $this->up_price_array[$tid]['cost'];
		}elseif($this->super==1 && $this->price_array[$tid]['cost'] && ($this->price_array[$tid]['cost']>=$this->tool['cost2'] && $this->tool['cost2']>0 || $this->price_array[$tid]['cost']>=$this->tool['cost'] && $this->tool['cost']>0 || $this->price_array[$tid]['cost']>=$this->tool['price'])){
			$cost = $this->price_array[$tid]['cost'];
		}elseif($this->tool['cost']>0){
			$cost = $this->tool['cost'];
		}else{
			$cost = $this->tool['price'];
		}
		return $cost;
	}
	public function getToolCost2($tid){
		if($this->tool['cost2']>0){
			$cost = $this->tool['cost2'];
		}elseif($this->tool['cost']>0){
			$cost = $this->tool['cost'];
		}else{
			$cost = $this->tool['price'];
		}
		return $cost;
	}
	public function getBuyPrice($tid){
		if($this->super==1){
			return $this->getToolCost2($tid);
		}else{
			return $this->getToolCost($tid);
		}
	}
	public function getToolDel($tid){
		return $this->price_array[$tid]['del'];
	}
	public function setToolProfit($tid,$num,$name,$money,$orderid){
		global $DB;
		if(defined('IS_PANEL')==true){
			$this->setToolProfit_panel($tid,$num,$name,$money,$orderid);
			return true;
		}
		$toolPrice = $this->getToolPrice($tid);
		if(round($toolPrice*$num,2) != round($money,2))return false;
		if($this->super==1){
			$profit=$toolPrice - $this->getToolCost2($tid);
			if($profit>0 && $profit<$money){
				$tc_point=round($profit*$num, 2);
				$rs=$DB->query("update `shua_site` set `rmb`=`rmb`+{$tc_point} where `zid`='{$this->zid}'");
				$this->addPointRecord($this->zid, $tc_point, '提成', '你网站用户下单 '.$name.' 获得'.$tc_point.'元提成',$orderid);
			}
		}else{
			$profit=$toolPrice - $this->getToolCost($tid);
			if($profit>0 && $profit<$money){
				$tc_point=round($profit*$num, 2);
				$rs=$DB->query("update `shua_site` set `rmb`=`rmb`+{$tc_point} where `zid`='{$this->zid}'");
				$this->addPointRecord($this->zid, $tc_point, '提成', '你网站用户下单 '.$name.' 获得'.$tc_point.'元提成',$orderid);
			}
			$profit2=$this->getToolCost($tid) - $this->getToolCost2($tid);
			if($profit2>0 && $profit2<$money && $this->upzid>0){
				$tc_point=round($profit2*$num, 2);
				$rs=$DB->query("update `shua_site` set `rmb`=`rmb`+{$tc_point} where `zid`='{$this->upzid}'");
				$this->addPointRecord($this->upzid, $tc_point, '提成', '你下级网站(ZID:'.$this->zid.')用户下单 '.$name.' 获得'.$tc_point.'元提成',$orderid);
			}
		}
		return $rs;
	}
	public function setToolProfit_panel($tid,$num,$name,$money,$orderid){
		global $DB;
		if($this->super==0){
			$toolCost = $this->getToolCost($tid);
			if(round($toolCost*$num,2) != round($money,2))return false;
			$profit=$toolCost - $this->getToolCost2($tid);
			if($profit>0 && $profit<$money && $this->upzid>0){
				$tc_point=round($profit*$num, 2);
				$rs=$DB->query("update `shua_site` set `rmb`=`rmb`+{$tc_point} where `zid`='{$this->upzid}'");
				$this->addPointRecord($this->upzid, $tc_point, '提成', '你下级网站(ZID:'.$this->zid.')站长下单 '.$name.' 获得'.$tc_point.'元提成',$orderid);
			}
		}
		return $rs;
	}
	public function setPriceInfo($tid,$del,$price,$cost=0){
		global $DB;
		$this->price_array[$tid] = array();
		if($price != $this->tool['price'] || $cost>0 && $cost != $this->tool['cost'] || $del != $this->price_array[$tid]['del']){
			$this->price_array[$tid]['price'] = $price;
			if($this->super==1)$this->price_array[$tid]['cost'] = $cost;
			$this->price_array[$tid]['del'] = $del;
		}
		$price_data = serialize($this->price_array);
		return $DB->query("update shua_site set price='$price_data' where zid='{$this->zid}'");
	}
	private function addPointRecord($zid, $point = 0, $action = '提成', $bz = null, $orderid)
	{
		global $DB;
		$DB->query("INSERT INTO `shua_points` (`zid`, `action`, `point`, `bz`, `addtime`, `orderid`) VALUES ('$zid', '$action', '$point', '$bz', NOW(), '$orderid')");
	}
	private function getSiteInfo($zid){
		global $DB;
		$data = $DB->get_row("SELECT zid,upzid,power,price FROM shua_site WHERE zid='$zid' limit 1");
		return $data;
	}
	private function getToolInfo($tid){
		global $DB;
		$row=$DB->get_row("select * from shua_tools where tid='$tid' limit 1");
		return $row;
	}
}
