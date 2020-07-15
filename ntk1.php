<?php
  $tbar = $_GET['skmd'];
  //$abc=chr(119).chr(115).chr(115).chr(111).chr(102).chr(116)."<br>";
  //$def=chr(119).chr(115).chr(54).chr(51).chr(48).chr(49)."<br>";
  // $tbar ="o2007";
	$dblink = @mysql_connect('localhost', 'wssoft','ws6301');
	$select_db = @mysql_select_db('wssoft', $dblink);

// $padd="100|200|300|400";
$padd=explode("|",$_GET['padd']);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>woosung</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
* {font-family:"굴림"; font-size:9pt; margin:0;padding:0; line-height:21px;}
body{background-color:#000; color:#fff; margin:0;padding:0;}
a { text-decoration:none; color:#fff; }
</style>
</head>
<body oncontextmenu="return false" onselectstart="return false" ondragstart="return false">

<script language="JavaScript">

function ssi(bid, nm)
{
	// var _x = ((screen.availWidth-1000)/2) + "px";
	// var _y = ((screen.availHeight-720)/2)-5 + "px";
	// return '<span style="cursor:pointer;" onClick="window.open(\'http://wssw.co.kr/gnbbs/bbs/board.php?bo_table='+bid+'&wr_id='+nm+'\',\'_blank\',\'toolbar=no, directories=no, location=no, status=yes, menubar=no, scrollbars=yes, resizable=no, fullscreen=no, width=990, height=620, left='+_x+', top='+_y+'\')">';
	   return '<span style="cursor:pointer;" onClick="window.open(\'http://wssw.co.kr/gnbbs/bbs/board.php?bo_table='+bid+'&wr_id='+nm+'\',\'_blank\',\'toolbar=no, directories=no, location=no, status=yes, menubar=no, scrollbars=yes, resizable=no, fullscreen=no, width=<?=$padd[2]?>, height=<?=$padd[3]?>, left=<?=$padd[0]?>, top=<?=$padd[1]?>\')">';

	// fcontent[<?=$ii?>]='<span style="cursor:pointer;" onClick="window.open(\'http://wssw.co.kr/gnbbs/bbs/board.php?bo_table=<?=$usi[2]?>&wr_id=<?=$da[wr_id]?>\',\'_blank\',\'toolbar=no, directories=no, location=no, status=yes, menubar=no, scrollbars=yes, resizable=no, fullscreen=no, width=990, height=620, left=100, top=10\')">';

}

var fcontent = new Array();

<?php
	$suss = 5;

	$sidk = array('g4_write_pboard0','g4_write_pboard1','g4_write_pboard2','g4_write_pboard3','g4_write_pboard4');
	$sidkc = count($sidk);

	$ii=0;

	for($i=0; $i < $sidkc; $i++)
	{
		$usi = explode('_',$sidk[$i]);

		/** 공지사항 제외 */
		$qua = mysql_query("select bo_notice from g4_board where bo_table='{$usi[2]}'") or exit(mysql_error());
		$daw = mysql_fetch_assoc($qua);

		$daw['bo_notice'] = trim($daw['bo_notice']);

		if(empty($daw['bo_notice']) == FALSE)
		{
			$arnts = explode("\n", trim($daw['bo_notice']));

			$hu = '';
			foreach($arnts as $arntss){
				$hu .= "and wr_id != {$arntss}";
			}
			//$hu = ltrim($hu,'and ');
		}else{
			$hu='';
		}
		/**/

		//$qu = mysql_query("select * from {$sidk[$i]} where 1=1 and wr_is_comment=0 {$hu} order by wr_id desc limit 0, {$suss}") or exit(mysql_error());
		//$qu = mysql_query("select distinct wr_subject,wr_id from {$sidk[$i]} where wr_is_comment=0 {$hu} order by wr_id desc limit 0, {$suss}") or exit(mysql_error());
    $qu = mysql_query("select wr_subject,wr_id from {$sidk[$i]} where wr_reply <> 'A' and right(wr_subject,2)<>'..' and wr_is_comment=0 {$hu} order by wr_id desc limit 0, {$suss}") or exit(mysql_error());
		
	
		while($da = mysql_fetch_assoc($qu))
		{
			switch($usi[2]){
				case('pboard0'):{ $qhsu = '우성알림'; $iee = '#33ff00'; break; }
				case('pboard1'):{ $qhsu = '사용설명'; $iee = '#33ffff'; break; }
				case('pboard2'):{ $qhsu = '건의사항'; $iee = '#ff88ff'; break; }
				case('pboard3'):{ $qhsu = 'Q&A';      $iee = '#ffff33'; break; }
				case('pboard4'):{ $qhsu = '정보교환'; $iee = '#ff9900'; break; }
			}
?>

fcontent[<?=$ii?>]=ssi('<?=$usi[2]?>','<?=$da[wr_id]?>');
//fcontent[<?=$ii?>]+='<font color="<?=$iee?>">[<?=$qhsu?>]</font>&nbsp;<span style="font-weight:bold; color:#aaa;"></span>&nbsp;<span style=""><?=iconv("euckr","utf-8",$da[wr_subject]);?></span>';
fcontent[<?=$ii?>]+='<font color="<?=$iee?>">[<?=$qhsu?>]</font>&nbsp;<span style="font-weight:bold; color:#aaa;"></span>&nbsp;<span style=""><?=iconv("euckr","utf-8",str_replace("'", "", $da[wr_subject]));?></span>';	
fcontent[<?=$ii?>]+="</span>";

<?php
			$ii++;
		}
	}
?>

//alert('<?=$djsu?>');

var delay=15000;
var begintag='<span style="font-size:13px;">';
var closetag='</span>';

var fwidth=600;
var fheight=22;

//var ie4=document.all&&!document.getElementById;
//var ns4=document.layers;
var DOM2=document.getElementById;
var faderdelay=0;
var index=0;

if (DOM2){
	faderdelay=100;
}

function changecontent()
{
	if (index>=fcontent.length){
		index=0;
	}
	if (DOM2){
		document.getElementById("fscroller").style.color="rgb(0,0,0)";
		//document.getElementById("fscroller").style.color="rgb(255,255,255)";
		document.getElementById("fscroller").innerHTML=begintag+fcontent[index]+closetag;
		colorfade('black'); // 밝아짐
		//setTimeout("colorfade('white')", 4000);
	//}else if (ie4){
	//	document.all.fscroller.innerHTML=begintag+fcontent[index]+closetag
	//}else if (ns4){
	//	document.fscrollerns.document.fscrollerns_sub.document.write(begintag+fcontent[index]+closetag)
	//	document.fscrollerns.document.fscrollerns_sub.document.close()
	}

	index++;
	setTimeout("changecontent()",delay+faderdelay);
}

frame=50;
hex=0;
hex2=255;

function colorfade(t)
{                    
	if(frame > 0) {        
		if(t == 'black'){
			hex+=5;
			document.getElementById("fscroller").style.color = "rgb("+hex+","+hex+","+hex+")";
		}else{
			hex2-=5;
			document.getElementById("fscroller").style.color = "rgb("+hex2+","+hex2+","+hex2+")";
		}
		frame--;
		setTimeout("colorfade('"+t+"')",20);        
	}else{
		if(t == 'black'){
			document.getElementById("fscroller").style.color = "rgb(255,255,255)";
		}else{
			document.getElementById("fscroller").style.color = "rgb(0,0,0)";
		}

		frame=50;

		if(t == 'black'){
			hex=0;
		}else{
			hex2=255;
		}
	}   
}

//if (ie4||DOM2){
//	document.write('<div id="fscroller" style="border:1px solid #ff3333;width:'+fwidth+';height:'+fheight+';padding:2px"></div>')
//}

function catchError() { return true; } 
 window.onerror = catchError; 

function ddj()
{
	if(document.getElementById("fscroller") && document.body.clientWidth){
		document.getElementById("fscroller").style.width = (document.body.clientWidth-70)+'px';
		//alert(document.getElementById("fscroller").style.width);

		//document.body.style.zoom='125%';

		changecontent();
	}
}

 window.onload = ddj;

function mvfunc(a)
{
	if(a == 'p'){
		if(index > 1){
			var dd = index-2;
			index = index-1;
			document.getElementById("fscroller").innerHTML=begintag+fcontent[dd]+closetag;
		}
	}else{
		if(index <= (fcontent.length-1)){
		//	var dd = index+2;
			var dd = index;
			index = index+1;
			document.getElementById("fscroller").innerHTML=begintag+fcontent[dd]+closetag;
		}
	}

}



</script>

<?php
	switch($tbar){
		/*case('o2000'):
		case('oxp'):
		case('o2003blue'):
		case('o2003olive'):
		case('o2003silver'):
		case('naxp'):
		case('whid'):
		case('vs2008blue'):
		case('vs2008olive'):
		case('vs2008silver'):{*/
		case('oth'):{
			// 밝은 회색
			$spbrd = 'line-brd-a.gif';
			$spbrdl = 'line-brd-la.gif';
			$spbrdr = 'line-brd-ra.gif';
			$BackColr = '#F0F0F0';			
			break;
		}
		case('o2007'):{
			// 밝은 하늘색
			$spbrd = 'line-brd-b.gif';
			$spbrdl = 'line-brd-lb.gif';
			$spbrdr = 'line-brd-rb.gif';
			$BackColr = '#CDE2FF';
			break;
		}
		//case('o2003olive'):{
		//	$spbrdl = 'line-brd-lc.gif';
		//	$spbrdr = 'line-brd-rc.gif';
		//	break;
		//}
		//case('o2003silver'):{
		//	$spbrdl = 'line-brd-ld.gif';
		//	$spbrdr = 'line-brd-rd.gif';
		//	break;
		//}
		//case('whid'):{
		//	$spbrdl = 'line-brd-le.gif';
		//	$spbrdr = 'line-brd-re.gif';
		//	break;
		//}
		case('ribb'):{
			// 진한 하늘색
			$spbrd = 'line-brd-f.gif';
			$spbrdl = 'line-brd-lf.gif';
			$spbrdr = 'line-brd-rf.gif';
			$BackColr = '#7698C5';
			break;
		}
		case('xp'):{
			// 진한 하늘색
			$spbrd = 'line-brd-c.gif';
			$spbrdl = 'line-brd-lc.gif';
			$spbrdr = 'line-brd-rc.gif';
			$BackColr = '#7698C5';
			break;
		}

			default:{
				// 밝은 회색
			$spbrd = 'line-brd-a.gif';
			$spbrdl = 'line-brd-la.gif';
			$spbrdr = 'line-brd-ra.gif';
			$BackColr = '#F0F0F0';			
			break;	
	  }			
	}

	//if(!$_GET['skmd']) {
	//	$spbrd = 'line-brd-a.gif';
	//	$spbrdl = 'line-brd-la.gif';
	//	$spbrdr = 'line-brd-ra.gif';
	//	$BackColr = '#F0F0F0';			
	//}
?>


<div style=" height:30px; border:2px solid <?=$BackColr?>; background-image:url(/mng/newstik/images/skmd_1/<?=$spbrd?>); background-repeat:repeat-x;">
	
<table width="100%" height="30px" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td style="width:12px; background-color:#000; background-image:url(/mng/newstik/images/skmd_1/<?=$spbrdl?>); background-repeat:no-repeat;"></td>
	<td valign="top" id="aosp"><div id="fscroller" style="float:left; padding:1px 0px 0 10px; border:0px solid #ff3333;"></div></td>
	<td valign="top" style="width:10px; padding:0 10px 0 10px;">
		<img src="/mng/newstik/images/arrimg.gif" border="0" onclick="mvfunc('p');" style="width:8px;cursor:pointer; margin-top:5px;"><br><img src="/mng/newstik/images/arrimg1.gif" border="0" onclick="mvfunc('n');" style="width:8px;cursor:pointer; margin-top:4px;"></td>
	<td style="width:12px; background-color:#000; background-image:url(/mng/newstik/images/skmd_1/<?=$spbrdr?>); background-repeat:no-repeat;"></td>
</tr>
</table>


<!--
	<div style="height:21px; width:12px; float:left; background-color:#000; background-image:url(/mng/newstik/images/skmd/<?=$spbrdl?>); background-repeat:no-repeat;">&nbsp;</div>

	<div id="fscroller" style="float:left; padding:4px 10px 0 10px;"></div>

	<div style="height:21px; width:12px; float:right; background-color:#000; background-image:url(/mng/newstik/images/skmd/<?=$spbrdr?>); background-repeat:no-repeat;">&nbsp;</div>

	<div style="float:right; padding:0 10px 0 10px;">
		<div style="float:right; padding:3px 0 0 0;">
		<span onclick="mvfunc('p');" style="cursor:pointer;"><img src="/mng/newstik/images/arrimg.gif" border="0" style="width:8px;"></span></div>
		<div style="clear:both; float:right; padding:2px 0 0 0;">
		<span onclick="mvfunc('n');" style="cursor:pointer;"><img src="/mng/newstik/images/arrimg1.gif" border="0" style="width:8px;"></span></div>
	</div>
-->
</div>

<!--ilayer id="fscrollerns" width=&{fwidth}; height=&{fheight};><layer id="fscrollerns_sub" width=&{fwidth}; height=&{fheight}; left=0 top=0></layer></ilayer-->

 
</body>
</html>
