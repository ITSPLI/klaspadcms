<?php
//echo '<pre>';
//print_r($crossword);
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?php echo 'Power Point'; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="klaspad/css/main.css" rel="stylesheet" />
<!--<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script> -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.js"></script>
<link rel="stylesheet" type="text/css" href="klaspad/highslide/highslide.css" /> 
<script type="text/javascript" src="klaspad/highslide/highslide-with-html.js"></script> 
<script type="text/javascript">
hs.graphicsDir = 'klaspad/highslide/graphics/';
hs.outlineType = 'rounded-white';
hs.wrapperClassName = 'draggable-header';
</script>
  <script>
         jQuery(document).ready(function(){
$("#open").click(function () {
$("#close").slideToggle("slow");
});
});
  </script>
<script>
 function showcomment(str){
	 if(document.getElementById(str).style.display=='none'){
		document.getElementById(str).style.display='block'; 
	 }else{
		document.getElementById(str).style.display='none'; 
	 }
 }
 </script>  
  
  
<style>
    #slides {
      display: none
    }

    #slides .slidesjs-navigation {
      margin-top:5px;
    }
	
	.slidesjs-container {
		height:521.723214px !important;
    }
	.slidesjs-control {
		height:521.723214px !important;
    }

    a.slidesjs-next,
    a.slidesjs-previous,
    a.slidesjs-play,
    a.slidesjs-stop {
      background-image: url(klaspad/images/btns-next-prev.png);
      background-repeat: no-repeat;
      display:block;
      width:12px;
      height:18px;
      overflow: hidden;
      text-indent: -9999px;
      float: left;
      margin-right:5px;
    }

    a.slidesjs-next {
      margin-right:10px;
      background-position: -12px 0;
    }

    a:hover.slidesjs-next {
      background-position: -12px -18px;
    }

    a.slidesjs-previous {
      background-position: 0 0;
    }

    a:hover.slidesjs-previous {
      background-position: 0 -18px;
    }

    a.slidesjs-play {
      width:15px;
      background-position: -25px 0;
    }

    a:hover.slidesjs-play {
      background-position: -25px -18px;
    }

    a.slidesjs-stop {
      width:18px;
      background-position: -41px 0;
    }

    a:hover.slidesjs-stop {
      background-position: -41px -18px;
    }

    .slidesjs-pagination {
      margin: 7px 0 0;
      float: right;
      list-style: none;
    }

    .slidesjs-pagination li {
      float: left;
      margin: 0 1px;
    }

    .slidesjs-pagination li a {
      display: block;
      width: 13px;
      height: 0;
      padding-top: 13px;
      background-image: url(klaspad/images/pagination.png);
      background-position: 0 0;
      float: left;
      overflow: hidden;
    }

    .slidesjs-pagination li a.active,
    .slidesjs-pagination li a:hover.active {
      background-position: 0 -13px
    }

    .slidesjs-pagination li a:hover {
      background-position: 0 -26px
    }

    #slides a:link,
    #slides a:visited {
      color: #333
    }

    #slides a:hover,
    #slides a:active {
      color: #9e2020
    }

    .navbar {
      overflow: hidden
    }
  
    #slides {
      display: none
    }

    .container1 {
      margin: 0 auto
    }

    /* For tablets & smart phones */
    @media (max-width: 767px) {
      body {
        padding-left: 20px;
        padding-right: 20px;
      }
      .container1 {
        width: auto
      }
    }

    /* For smartphones */
    @media (max-width: 480px) {
      .container1 {
        width: auto
      }
    }

    /* For smaller displays like laptops */
    @media (min-width: 768px) and (max-width: 979px) {
      .container1 {
        width: 724px
      }
    }

    /* For larger displays */
    @media (min-width: 1200px) {
      .container1 {
        width: 100%;
      }
    }
  </style>
  <style>
    .savebutton{
		text-align:center;
	}
    .savebutton a{
		background:#4f81bc;
		padding:5px 30px;
		color:#fff;
		font-size:18px;
		text-decoration:none;
		border-radius:5px;
	}
	
	.rightthreeTab{
		width:324px;
		float:right;
	}
	
	.rightthreeTab ul{
		margin:0px;
		padding:0px;
	}
	
	.rightthreeTab ul li{
		list-style:none;
		float:left;
	}
	
	.rightthreeTab ul li a{
		background:#ECECEC;
		padding:0px 10px;
		/*height:30px;*/
		line-height:30px;
		color:#000;
		text-decoration:none;
		-webkit-transition:all 0.5s;
		-transition:all 0.5s;
		border-radius:5px;
		float:left;
		margin-right:1px;
		font-family:Calibri;
		font-size:14px;
	}
	
	.rightthreeTab ul li a:hover, .rightthreeTab ul li a.select{
		background:#f2f2f2;
	}
    </style>
 <script>
 function showtext(){
	if(document.getElementById('ntmsg').style.display=='none'){
		document.getElementById('ntmsg').style.display='block';
	}else{
		document.getElementById('ntmsg').style.display='none';
	}
 }
 </script>
 <script>
 function showtext1(){
	if(document.getElementById('descvid').style.display=='none'){
		document.getElementById('descvid').style.display='block';
	}else{
		document.getElementById('descvid').style.display='none';
	}
 }
 </script>
 <script>
 function showtext2(){
	if(document.getElementById('desclen').style.display=='none'){
		document.getElementById('desclen').style.display='block';
	}else{
		document.getElementById('desclen').style.display='none';
	}
 }
 </script>
 <script>
 function showcontent(dv1,dv2,dv3,dv4,dv5,dv6,a1,a2,a3,a4,a5,a6){
	document.getElementById(dv1).style.display='block';
	document.getElementById(dv2).style.display='none';
	document.getElementById(dv3).style.display='none';
	document.getElementById(dv4).style.display='none';
	document.getElementById(dv5).style.display='none';
	document.getElementById(dv6).style.display='none';
	document.getElementById(a1).className='select';
	document.getElementById(a2).className='';
	document.getElementById(a3).className='';
	document.getElementById(a4).className='';	 
	document.getElementById(a5).className='';
	document.getElementById(a6).className='';	 
 }
 </script>
 <script>
 function showtext3(str){
	if(document.getElementById(str).style.display=='none'){
		document.getElementById(str).style.display='block';
	}else{
		document.getElementById(str).style.display='none';
	}
 }
 </script>
 <script>
function showcomment(str){
if(document.getElementById(str).style.display=='none'){
	document.getElementById(str).style.display='block'
}else{
	document.getElementById(str).style.display='none'
}
}
</script>
<script>
		function shownxtpg(str, str1, str2){
		for(var j=1; j<str1; j++){	
		if(j==str){
		document.getElementById('pptex'+str2+'_'+j).style.display='block';
		}else{
		document.getElementById('pptex'+str2+'_'+j).style.display='none';
		}
		}
		}
		</script>
        
        <script>
		function fcmnt(str){
			if(document.getElementById('feedcomment'+str).style.display=='none'){
				document.getElementById('feedcomment'+str).style.display='block';
			}else{
				document.getElementById('feedcomment'+str).style.display='none';
			}
		}
		</script>
 
 <script type="text/javascript" src="klaspad/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
 /*tinyMCE.init({
  // General options
  mode : "textareas",
  theme : "advanced",
  plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

  // Theme options
  theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
  theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
  theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
  theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
  theme_advanced_toolbar_location : "top",
  theme_advanced_toolbar_align : "left",
  theme_advanced_statusbar_location : "bottom",
  theme_advanced_resizing : true,

  // Example content CSS (should be your site CSS)
  content_css : "css/content.css",

  // Drop lists for link/image/media/template dialogs
  template_external_list_url : "lists/template_list.js",
  external_link_list_url : "lists/link_list.js",
  external_image_list_url : "lists/image_list.js",
  media_external_list_url : "lists/media_list.js",

  // Style formats
  style_formats : [
   {title : 'Bold text', inline : 'b'},
   {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
   {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
   {title : 'Example 1', inline : 'span', classes : 'example1'},
   {title : 'Example 2', inline : 'span', classes : 'example2'},
   {title : 'Table styles'},
   {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
  ],

  // Replace values for the template plugin
  template_replace_values : {
   username : "Some User",
   staffid : "991234"
  }
 });*/
</script>   
<link href="klaspad/highslide/highslide.css" rel="stylesheet">
<script src="klaspad/highslide/highslide-with-html.js" type="text/javascript"></script>
<script type="text/javascript">
hs.graphicsDir = 'klaspad/highslide/graphics/';
hs.outlineType = 'rounded-white';
hs.wrapperClassName = 'draggable-header';
</script> 
<script>
function goBack() {
    window.history.back()
}
</script>
</head>
<body oncontextmenu="return false">
<!-- oncontextmenu="return false" -->
<!-- Header -->
<?php //echo $this->load->view('include/header.php'); ?>
<!-- End Header -->
<!-- Container -->
<div id="ntmsg" style="width:700px; height:500px; min-height:200px; position:fixed; right:15px; top:45px; background-color:#FFF; display:none; border: 5px solid #4f81bc; z-index:999999999; overflow:auto;">
<div style="width:100%; background:#5e77aa !important;"><h3 style="font-family:Calibri; color:#FFF; margin-left:20px; float:left; width:88%; background:#5e77aa !important;">Add Notes</h3><span style="float:right; width:5%;"><img src="klaspad/images/closeIcon.jpg" style="cursor:pointer;" onClick="document.getElementById('ntmsg').style.display='none';"></span>
<div class="clear"></div>
</div>
<form method="post" action="index.php?route=klaspad/klaspad/insertnotes&moduleid=<?php echo $_GET['moduleid']; ?>&topicid=<?php echo $_GET['topicid']; ?>&headingid=<?php echo $_GET['headingid']; ?>&courseid=<?php echo $_GET['courseid']; ?>" name="notesfrm" id="notesfrm">
<table width="350" cellpadding="5" cellspacing="0" border="0" align="center">
<tr>
<td>
<textarea name="msg" id="msg" placeholder="Notes"  style="height:400px;"></textarea>
</td>
</tr>
<tr>
<td align="center">
<div class="savebutton" style="margin-top:20px; margin-bottom:20px;">
<a href="javascript:void(0);" onClick="document.getElementById('notesfrm').submit();">Save</a>
</div>
</td>
</tr>
</table>
</form>
</div>
<div class="container">
<!-- Aside -->
<!-- End Aside -->
<div style="text-align:left;">
<?php
$csq=mysql_query("select coursename from course where courseid='".$_GET['courseid']."'");
$css=mysql_fetch_array($csq);
$mdq=mysql_query("select modulename from coursemodule where moduleid='".$_GET['moduleid']."'");
$mds=mysql_fetch_array($mdq);
?>
<?php if($_GET['type']=='notassigned'){ ?>
<!--<a href="index.php?route=klaspad/klaspad/module_activity&moduleid=<?php echo $_GET['moduleid']; ?>&coursename=<?php echo $css['coursename']; ?>&modulename=<?php echo $mds['modulename']; ?>&role=internal&courseid=<?php echo $_GET['courseid']; ?>">Back to module</a> -->
<!--<a href="index.php?route=klaspad/klaspad/getcoutsedetails_new&courseid=<?php echo $_GET['courseid']; ?>">Back to course</a> -->
<?php }else{ ?>
<a href="index.php?route=klaspad/klaspad/module_activity&moduleid=<?php echo $_GET['moduleid']; ?>&coursename=<?php echo $css['coursename']; ?>&modulename=<?php echo $mds['modulename']; ?>&role=internal&courseid=<?php echo $_GET['courseid']; ?>">Back to module</a>
<!--<a href="index.php?route=klaspad/klaspad/getcoutsedetails&courseid=<?php echo $_GET['courseid']; ?>">Back to course</a> -->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
$headingid1='';
$previd1='';
$nextid1='';
$res1=explode(',',$_GET['allresource']);
$cnt1=count($res1);
		$kk1=0;	 
		$prevsid1=''; 
		for($l1=0; $l1<$cnt1;$l1++){
			if($res1[$l1]==$_GET['headingid']){
				//echo $l1.'<br />';
			$prevsid1=$l1-2;
			$headingsid1=$l1-1;
			$nextsid1=$l1;	
			}
		} 
		//echo $headingsid1.'h<br />';
		//echo $prevsid1.'p<br />';
		//echo $nextsid1.'n<br />';
			$headingid1=$res1[$headingsid1];
			//echo '<br />';
			$previd1=$res1[$prevsid1];
			//echo '<br />';
			$nextid1=$res1[$nextsid1];
		//echo '<br />';
?>
<?php if($_GET['previd']!=0 && $_GET['previd']!=''){ ?>

<a href="index.php?route=klaspad/klaspad/module_activity&moduleid=<?php echo $_GET['moduleid']; ?>&topicid=<?php echo $_GET['topicid']; ?>&headingid=<?php echo $headingid1; ?>&courseid=<?php echo $_GET['courseid']; ?>&allresource=<?php echo $_GET['allresource']; ?>&previd=<?php echo $previd1; ?>&nextid=<?php echo $nextid1; ?>">Previous Resource</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php } ?>
<?php
$headingid='';
$previd='';
$nextid='';
$res=explode(',',$_GET['allresource']);
$cnt=count($res);
		$kk=0;	 
		$prevsid='';
		for($l=0; $l<$cnt;$l++){
			if($res[$l]==$_GET['headingid']){
			$prevsid=$l;
			$headingsid=$l+1;
			$nextsid=$l+2;	
			}
		}
		
			$headingid=$res[$headingsid];
			//echo '<br />';
			$previd=$res[$prevsid];
			//echo '<br />';
			$nextid=$res[$nextsid];
		//echo '<br />';
		
?>
<?php if($_GET['nextid']!=0 && $_GET['nextid']!=''){ ?>

<a href="index.php?route=klaspad/klaspad/module_activity&moduleid=<?php echo $_GET['moduleid']; ?>&topicid=<?php echo $_GET['topicid']; ?>&headingid=<?php echo $headingid; ?>&courseid=<?php echo $_GET['courseid']; ?>&allresource=<?php echo $_GET['allresource']; ?>&previd=<?php echo $previd; ?>&nextid=<?php echo $nextid; ?>">Next Resource</a>
<?php } ?>
<?php } ?>
<!--<a href="javascript:void(0);" onclick="goBack()">Back</a> -->
<?php 
//echo "select headingname from e_".$this->session->userdata('connectid')."_edu_heading where id='".$this->uri->segment(4)."'";
$hq=mysql_query("select headingname from e_".$this->session->data['campusid']."_edu_headings where id='".$_GET['headingid']."'");
$shq=mysql_fetch_array($hq);
echo '<h1 style="font-size:18px; font-family:Calibri; color:#000; padding-left:24px;">'.$shq['headingname'].'</h1>';
?>
<span style="float:right; margin-top:-40px; margin-right:20px;">
<?php /*if(@$exedata['description']!=''){ ?>
<a href="javascript:void(0);" onClick="showtext1();"><img src="klaspad/images/learning_outcome.png" height="20" title="Description"></a>
<?php }*/ ?>
&nbsp;&nbsp;
<?php if(@$exedata['learningoutcomes']!=''){ ?>
<a href="javascript:void(0);" onClick="showtext2();"><img src="klaspad/images/description.png" height="20" title="Learning Outcomes"></a>
<?php } ?>
</span>
</div><!-- <?php echo baseurl; ?>/insertnotes -->
<!-- Right Body -->

<div class="rightBody thirdrightbox">
<!-- Third Page Header -->
 <!-- End Third Page Header -->
 <!-- Gray Box -->
<div class="grayBox" >
<div class="innerheading"><?php //echo ucfirst($description); ?></div>	 
  <!-- Gray Box Left -->
  <div class="grayBoxLeft" style="text-align:center; margin-top:0px; margin-bottom:10px; width:65% !important;">
  <?php $i=1; foreach($exe_data as $exedata){
		echo '<div>'.$exedata['wordssentence'].'</div>';
	 ?>
  <?php if($exedata['excercises_audio']!=''){ ?>
  <div class="container1">
   <audio controls>
  <source src="<?php echo $exedata['excercises_audio']; ?>" type="audio/mpeg">
</audio> 
  </div>   
  <?php } ?>
  <div class="container1">
  <?php 
  $edt=explode(',',$exedata['pptimagepath']);
  $tct=count($edt);
  $eedt=explode('/',$edt[0]);
  $ctc=count($eedt);
  $ttct=$ctc-1;
  
  $filesrc=str_replace($eedt[$ttct],'',$edt[0]);
 // echo $filesrc;
/*if($handle = opendir($filesrc)) {
	$x=0;
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
		$x++;	
		//echo $entry.', ';
//echo '<img src="klaspad/uploads/10/1/ppt/5/'.$entry.'">';
        }
    }
	
    closedir($handle);
}*/
//echo $x; ?>
<div id="slides">
<?php for($j=1;$j<=$tct; $j++){
	
	 ?>
<?php echo '<img src="'.$filesrc.'Slide'.$j.'.JPG">'; ?>
<?php } ?>
</div>
    <?php /*?><div id="slides">

<?php 
if($handle = opendir('klaspad/uploads/'.$this->session->data['campusid'].'/'.$course_id.'/ppt/'.$exedata['id'])) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
		echo $entry.', ';
echo '<img src="klaspad/uploads/'.$this->session->data['campusid'].'/'.$course_id.'/ppt/'.$exedata['id'].'/'.$entry.'">';
        }
    }
    closedir($handle);
} ?>

    </div><?php */?>
  </div>
  <div id="descvid" style="width:400px; height:500px; min-height:200px; position:fixed; right:45px; top:40px; background-color:#FFF; display:none; border: 5px solid #4f81bc; z-index:999999999; overflow:auto;">
<div style="width:383px; background:#5e77aa !important; position:fixed;"><h3 style="font-family:Calibri; color:#FFF; margin-left:20px; float:left; width:88%; background:#5e77aa !important;">Description</h3><span style="float:right; width:5%;"><img src="klaspad/images/closeIcon.jpg" style="cursor:pointer;" onClick="document.getElementById('descvid').style.display='none';"></span>
<div class="clear"></div>
</div>
<div style="padding:5px; text-align:left; margin-top:20px;">
<?php echo $exedata['learningoutcomes']; ?>
</div>
</div>
<div id="desclen" style="width:400px; height:500px; min-height:200px; position:fixed; right:45px; top:40px; background-color:#FFF; display:none; border: 5px solid #4f81bc; z-index:999999999; overflow:auto;">
<div style="width:100%; background:#5e77aa !important;"><h3 style="font-family:Calibri; color:#FFF; margin-left:20px; float:left; width:88%; background:#5e77aa !important;">Learning Outcomes</h3><span style="float:right; width:5%;"><img src="klaspad/images/closeIcon.jpg" style="cursor:pointer;" onClick="document.getElementById('desclen').style.display='none';"></span>
<div class="clear"></div>
</div>
<div style="padding:5px; text-align:left;">
<?php echo $exedata['learningoutcomes']; ?>
</div>
</div>
<?php 	 $i++; } ?>
  </div>
  <?php /*?><div style="width:32%; float:right; vertical-align:top; "><h1>Conversations</h1></div>
  <div style="width:32%; float:right; vertical-align:top; height:300px; overflow:auto;">
  <ul>
  <?php $kk=1; if(isset($discussion)){ foreach($discussion as $disc){ ?>
  <li style="list-style:none; float:left;" onClick="showcomment('comment<?php echo $kk; ?>');"><?php echo  '<strong>'.$kk.'. '.stripslashes(html_entity_decode($disc['topic'])).'</strong>'; ?>
  <div id="comment<?php echo $kk; ?>" style="display:none;">
  <ul>
  <?php $lk=1;if(isset($disc['comment'])){ foreach($disc['comment'] as $comment){ ?>
  <li style="list-style:none; float:left; width:30%"><img src="" height="50" width="50" /></li>
  <li style="list-style:none; float:right; width:68%"><?php echo $comment['comment']; ?></li>
  <div class="clear"></div>
  <?php $lk++; } } ?>
  </ul>
  </div>
  </li>
  <?php $kk++; }} ?>
  </ul>
  </div>
  <div style="width:32%; float:right; vertical-align:top; "><h1>Notes</h1></div>
   <div style="width:32%; float:right; vertical-align:top; height:300px; overflow:auto;">
  <ul>
  <?php $kk1=1; if(isset($notes)){ foreach($notes as $not){ ?>
  <li style="list-style:none; float:left;"><?php echo  '<strong>'.$kk1.'. '.stripslashes(html_entity_decode($not['msg'])).'</strong>'; ?>
  </li>
  <div class="clear"></div>
  <?php $kk1++; }} ?>
  </ul>
  </div><?php */?>
  <div class="rightthreeTab">
    <ul>
    <li onClick="showcontent('stnts','nts','conv','assgn','refree','exercse','aa6','aa2','aa1','aa3','aa4','aa5')"><a href="#" id="aa6">My notes</a></li>
    <?php if(@$exedata['learningoutcomes']!=''){ ?>
   <li onClick="showcontent('nts','conv','assgn','refree','exercse','stnts','aa2','aa1','aa3','aa4','aa5','aa6')"><a href="#" id="aa2"><img src="image/notes.png" title="Read more..." /></a></li>
   <?php } ?>
   <?php if($_GET['type']=='notassigned'){}else{ ?>
    <?php if(!empty($discussion)){ ?>
     <li onClick="showcontent('conv','nts','assgn','refree','exercse','stnts','aa1','aa2','aa3','aa4','aa5','aa6')"><a href="#" id="aa1" class="select"><!--<img src="image/conversation.png" title="Conversations" /> -->Conversations</a></li>
     <?php } ?>
     
     <?php if(!empty($assignment)){ ?>
     <li onClick="showcontent('assgn','conv','nts','refree','exercse','stnts','aa3','aa1','aa2','aa4','aa5','aa6')"><a href="#" id="aa3"><!--<img src="image/assignment.png" title="Assignments" /> -->Assignments</a></li>
     <?php } ?>
     <?php if(@$reference!=''){ ?>
     <li onClick="showcontent('refree','conv','nts','assgn','exercse','stnts','aa4','aa1','aa2','aa3','aa5','aa6')"><a href="#" id="aa4"><!--<img src="image/refrences.png" title="Reference" /> -->Reference</a></li>
     <?php } ?>
     <?php if(!empty($crossword) || !empty($multiple) || !empty($fill) || !empty($descripting) || !empty($truefalse) || !empty($draganddrop)){ ?>
     <li onClick="showcontent('exercse','refree','conv','nts','assgn','stnts','aa5','aa4','aa1','aa2','aa3','aa6')"><a href="#" id="aa5"><!--<img src="image/exercise.png" title="Exercises" /> -->Exercises</a></li>
     <?php } ?>
     <?php } ?>
    </ul>
    <div style="clear:both;"></div>
   <div id="conv" style="width:100%; float:right; vertical-align:top; height:800px; overflow:auto; display:none;">
   <div style="width:100%; float:right; vertical-align:top; "><h1>Conversations</h1></div>
   <?php  
  //echo '<pre>';
  //print_r($discussion);
  $j=1;
  if(isset($discussion)){
  foreach($discussion as $dat){ ?>
  <?php //$i=0; foreach($module_course_wise[$dat->courseid] as $module_course_wis){ ?>  
  <div class="headingimagescourse">
  <div id="disc<?php echo $j; ?>" onClick="showcomment('comm<?php echo $j; ?>')">
   <?php echo $j; ?>
   
   <?php echo $dat['topic']; ?>
   </div>
   <div class="clear"></div>
   <div id="comm<?php echo $j; ?>" style="display:none;">
   <ul style="margin:0px; padding:0px;">
 <?php if($this->session->data['userid']===FALSE){}else{ ?>
 <li><a href="javascript:void(0);" onClick="fcmnt('<?php echo $j; ?>')">Add Comment</a></li>
 <li id="feedcomment<?php echo $j; ?>" style="display:none;">
 <form name="frm<?php echo $j; ?>" id="frm<?php echo $j; ?>" method="post" action="index.php?route=klaspad/klaspad/insertcomments">
 <input type="text" name="assignment" id="assignment" style="height:50px; width:90%;" />
 <!--<textarea name="assignment" id="assignment"></textarea> -->
 <input type="hidden" name="course_id" id="course_id" value="<?php echo $_GET['courseid']; ?>" />
 <input type="hidden" name="assignment_id" id="assignment_id" value="<?php echo $dat['id']; ?>" />
 <input type="button" value="Submit" style="width:30%;" onClick="document.getElementById('frm<?php echo $j; ?>').submit();" />
 </form>
 </li>
 <?php } ?>
 <?php 
 //print_r($dis['comment']);
 foreach($dat['comment'] as $com){ ?>
 <li style="list-style:none;">
 <ul style="margin:0px; padding:0px;"><li style="list-style:none; float:left; width:25%;"><img src="<?php echo $com['image']; ?>" /></li><li style="list-style:none; float:right; width:73%;"><?php echo $com['comment']; ?></li></ul>
 <div class="clear"></div>
 </li>
 <?php } ?>
 </ul>
 </div>  
   <!--<div id="comm<?php echo $j; ?>" style="display:none;">
   <?php foreach($dat['comment'] as $comment){ ?>
   <div class="imagesLeft">
   <img src="<?php echo $comment['image']; ?>" height="60" width="60">
   </div>
   <div class="textright" style="margin-top:0px !important;">
   <?php echo $comment['comment']; ?>
   </div>
   <div class="clear"></div>
   <?php } ?>
   
   </div> -->
  </div>
  <div class="clear"></div>
  <?php $j++; }} ?>
  <?php /*?><ul>
  <?php $kk=1; if(isset($discussion)){ foreach($discussion as $disc){ ?>
  <li style="list-style:none; float:left;" onClick="showcomment('comment<?php echo $kk; ?>');"><?php echo  '<strong>'.$kk.'. '.stripslashes(html_entity_decode($disc['topic'])).'</strong>'; ?>
  <div id="comment<?php echo $kk; ?>" style="display:none;">
  <ul>
  <?php $lk=1;if(isset($disc['comment'])){ foreach($disc['comment'] as $comment){ ?>
  <li style="list-style:none; float:left; width:30%"><img src="" height="50" width="50" /></li>
  <li style="list-style:none; float:right; width:68%"><?php echo $comment['comment']; ?></li>
  <div class="clear"></div>
  <?php $lk++; } } ?>
  </ul>
  </div>
  </li>
  <?php $kk++; }} ?>
  </ul><?php */?>
  </div>
  <div id="nts" style="width:100%; float:right; vertical-align:top; height:800px; overflow:auto; display:none;">
  <!--<div style="width:100%; float:right; vertical-align:top; "><h1 style="width:90% !important; float:left;"><a href="javascript:void(0);" onClick="showtext1();">Read more....</a></h1></div>-->
  <div style="padding:5px; text-align:left; font-family:calibri; font-size:16px;">
<?php if(@$exedata['learningoutcomes']!=''){ ?>
<?php 
$st=explode('</p>',$exedata['learningoutcomes']);
$cnt=count($st);
$cntt=$cnt-1;
if($cntt<=3){
echo $st[0].'</p>'.$st[1].'</p>'.$st[2].'</p>'.$st[3].'</p>';
}else{
echo $st[0].'</p>'.$st[1].'</p>'.$st[2].'</p>'.$st[3].'</p><a href="javascript:void(0);" onClick="showtext1();">....Read more</a>';	
}
//echo substr($exedata['description'],0,1000); ?>
<?php } ?>
</div>
  </div>
  
  <div id="stnts" style="width:100%; float:right; vertical-align:top; height:800px; overflow:auto;">
  <!--<div style="width:100%; float:right; vertical-align:top; "><h1 style="width:90% !important; float:left;"><a href="javascript:void(0);" onClick="showtext1();">Read more....</a></h1></div>-->
  <div style="padding:5px; text-align:left; font-family:calibri; font-size:16px;">
  <table width="100%" cellpadding="5" cellspacing="0" border="0">
  <tr>
  <td colspan="3">
  <form method="post" name="stfrm" id="stfrm" action="index.php?route=klaspad/klaspad/insert_stickynotes" />
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
<td><textarea name="content" rows="18" style="width:100%; height:90%;" placeholder="If you want to write some notes on this resource please type them here."></textarea></td>
</tr>
<tr>
<td align="center"><input type="submit" value="Save" />
<input type="hidden" name="headingid" id="headingid" value="<?php echo $_GET['headingid']; ?>" />
<input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION['userid']; ?>" />
</td>
</tr>
</table>
</form>
  </td>
  </tr>
  <?php 
  $w=1;
  $stn=mysql_query("select * from stickynotes where headingid='".$_GET['headingid']."' and userid='".$_SESSION['userid']."'");
  while($stns=mysql_fetch_array($stn)){
  ?>
  <tr>
  <td width="5%"><?php echo $w; ?></td>
  <td width="80%"><?php echo $stns['content']; ?></td>
  <td width="15%"><a href="index.php?route=klaspad/klaspad/addstickynotes&id=<?php echo $stns['id']; ?>" onClick="return hs.htmlExpand(this, { objectType: 'iframe', preserveContent: false, width:350, height:375} )"><img src="image/view_btn.jpg" alt="View Details" width="15" border="0" /></a>&nbsp;<a href="index.php?route=klaspad/klaspad/deletestickynotes&id=<?php echo $stns['id']; ?>"><img src="image/delete.png" style="width:15px !important;" /></a></td>
  </tr>
  <?php $w++;} ?>
  </table>
<!--<a href="index.php?route=klaspad/klaspad/addstickynotes&headingid=<?php echo $_GET['headingid']; ?>&userid=<?php echo $_SESSION['userid']; ?>" onClick="return hs.htmlExpand(this, { objectType: 'iframe', preserveContent: false, width:350, height:375} )">Add</a> -->
</div>
  </div>
  <!--<div id="nts" style="width:100%; float:right; vertical-align:top; height:800px; overflow:auto; display:none;">
  <div style="width:100%; float:right; vertical-align:top; "><h1 style="width:90% !important; float:left;">Notes</h1><span><a href="javascript:void(0);" onClick="showtext();"><img src="klaspad/images/editicon.png" title="Add Notes"></a></span></div>
  <ul>
  <?php $kk1=1; if(isset($notes)){ foreach($notes as $not){ ?>
  <li style="list-style:none; float:left;"><?php echo  '<strong>'.$kk1.'. '.stripslashes(html_entity_decode($not['msg'])).'</strong>'; ?>
  </li>
  <div class="clear"></div>
  <?php $kk1++; }} ?>
  </ul>
  </div> -->
  <div id="assgn" style="width:100%; float:right; vertical-align:top; height:800px; overflow:auto; display:none;">
  <div style="width:100%; float:right; vertical-align:top; "><h1>Assignments</h1></div>
  <ul>
  <?php $kkk1=1; if(isset($assignment)){ foreach($assignment as $ass){ ?>
  <a href="index.php?route=klaspad/klaspad/assignmentdetails&id=<?php echo $ass['id']; ?>" onClick="return hs.htmlExpand(this, { objectType: 'iframe', preserveContent: false, width:800, height:370} )" style="text-decoration:none;"><li style="list-style:none; float:left;"><?php echo  '<strong>'.$kkk1.'. </strong>';?></li><li style="list-style:none; float:left;"> <?php echo '<strong>'.stripslashes(html_entity_decode($ass['topic'])).'</strong>'; ?></li></a>
  
   <?php /*?><a href="javascript:void(0);" onClick="showtext3('assignmentdiv<?php echo $kkk1; ?>');" style="text-decoration:none;"><li style="list-style:none; float:left; width: 100%;">
   <?php $stq=mysql_query("select comments from e_".$this->session->data['campusid']."_edu_result_assignment where assignmentid='".$ass['id']."' and userid='".$this->session->data['userid']."'");
   $sstq=mysql_fetch_array($stq);
     ?>
   <?php if($sstq['comments']!=''){ echo 'See Comments'; }else{ echo  '<strong>Submit Assignment</strong>'; } ?></li></a><?php */?>
  <?php /*?><a href="javascript:void(0);" onClick="showtext3('assignmentdiv<?php echo $kkk1; ?>');" style="text-decoration:none;"><li style="list-style:none; float:left;"><?php echo  '<strong>'.$kkk1.'. ';?></li><li style="list-style:none; float:left;"> <?php echo ''.stripslashes(html_entity_decode($ass['topic'])).'</strong>'; ?></li></a><?php */?>
  <form method="post" name="assnfrm" id="assnfrm<?php echo $kkk1; ?>" action="index.php?route=klaspad/klaspad/saveassignmentresult">
<div id="assignmentdiv<?php echo $kkk1; ?>"  style="width:700px; height:500px; min-height:200px; position:fixed; left:0px; top:72px; background-color:#FFF; display:none; border: 5px solid #4f81bc; z-index:999999999; overflow:auto;">
<div style="width:100%; background:#5e77aa !important;"><h3 style="font-family:Calibri; color:#FFF; margin-left:20px; float:left; width:88%; background:#5e77aa !important;">Assignment</h3><span style="float:right; width:5%;"><img src="klaspad/images/closeIcon.jpg" style="cursor:pointer;" onClick="document.getElementById('assignmentdiv<?php echo $kkk1; ?>').style.display='none';"></span>
<div class="clear"></div>
</div>
<?php $asq=mysql_query("select * from e_".$this->session->data['campusid']."_edu_result_assignment where assignmentid='".$ass['id']."' and userid='".$this->session->data['userid']."'");
$sasq=mysql_fetch_array($asq);
 ?>
 <?php if($sasq['comments']!=''){ ?>
 <strong>Teacher's comment : </strong><br />
 <?php echo stripslashes($sasq['comments']); ?>
 <?php } ?>
<textarea name="description" id="description" style="height:400px;"><?php echo stripslashes($sasq['description']); ?></textarea>
<input type="hidden" name="assignmentid" id="assignmentid" value="<?php echo $ass['id']; ?>" />
<input type="hidden" name="submitted" id="submitted<?php echo $kkk1; ?>" value="" />
<div class="savebutton" style="margin-top:20px; margin-bottom:20px;">
<?php if($sasq['submitted']==0){ ?>
 <a href="javascript:void(0);" onClick="document.getElementById('submitted<?php echo $kkk1; ?>').value='0'; document.getElementById('assnfrm<?php echo $kkk1; ?>').submit();">Save</a>
 <a href="javascript:void(0);" onClick="AdmofferedValidation('<?php echo $kkk1; ?>');">Submit</a>
 <?php } ?>
 </div>
</div>
</form>
  
  <div class="clear"></div>
  <?php $kkk1++; }} ?>
  </ul>
  </div>
  <div id="refree" style="width:100%; float:right; vertical-align:top; height:800px; overflow:auto; display:none;">
  <div style="width:100%; float:right; vertical-align:top; "><h1 style="width:90% !important; float:left;">References</h1></div>
  <ul>
  <li style="list-style:none; float:left;"><?php 
  $ref=str_replace('<a','<a onclick="return hs.htmlExpand(this, { objectType: \'iframe\', preserveContent: false, width:800, height:600} );"',$reference);
  echo  '<strong>'.$ref.'</strong>'; ?>
  </li>
  <div class="clear"></div>
  </ul>
  </div>
  <div id="exercse" style="width:100%; float:right; vertical-align:top; height:800px; overflow:auto; display:none;">
 
  <div style="width:100%; float:right; vertical-align:top; "><h1 style="width:90% !important; float:left;">Exercises</h1></div>
  
  <ul>
  <?php $kkk1=1; if(isset($crossword)){ foreach($crossword as $crs){ ?>
  <li style="list-style:none; float:left;"><a href="index.php?route=klaspad/klaspad/module_activity&moduleid=<?php echo $_GET['moduleid']; ?>&topicid=<?php echo $_GET['topicid']?>&headingid=<?php echo $crs['topic_id']; ?>&courseid=<?php echo $_GET['courseid']; ?>&resourceid=<?php echo $crs['resourceid']; ?>" style="background:none !important;"><?php echo  '<strong>'.$crs['headingname'].'</strong>'; ?></a>
  </li>
  <div class="clear"></div>
  <?php $kkk++;} } ?>
  <div class="clear"></div>
  </ul>
  <?php /*if(isset($multiple)){ ?>
  <div style="width:100%; float:right; vertical-align:top; "><h1 style="width:90% !important; float:left;">Multiple Choice</h1></div>
  <?php }*/ ?>
  <ul>
  <?php $kkk1=1; $ttid=0; if(isset($multiple)){ foreach($multiple as $crs){
	  $ttid=$tid;
	  $tid=$crs['topic_id'];
	  if($ttid!=$crs['topic_id']){
	   ?>
  <li style="list-style:none; float:left;"><a href="index.php?route=klaspad/klaspad/module_activity&moduleid=<?php echo $_GET['moduleid']; ?>&topicid=<?php echo $_GET['topicid']?>&headingid=<?php echo $crs['topic_id']; ?>&courseid=<?php echo $_GET['courseid']; ?>&resourceid=<?php echo $crs['resourceid']; ?>" style="background:none !important;"><?php echo  '<strong>'.$crs['headingname'].'</strong>'; ?></a>
  </li>
  <div class="clear"></div>
  <?php }$kkk++;} } ?>
  <div class="clear"></div>
  </ul>
  
  <ul>
  <?php $kkk2=1; $ttid=0; if(isset($fill)){ foreach($fill as $crs){
	  $ttid=$tid;
	  $tid=$crs['topic_id'];
	  if($ttid!=$crs['topic_id']){
	   ?>
  <li style="list-style:none; float:left;"><a href="index.php?route=klaspad/klaspad/module_activity&moduleid=<?php echo $_GET['moduleid']; ?>&topicid=<?php echo $_GET['topicid']?>&headingid=<?php echo $crs['topic_id']; ?>&courseid=<?php echo $_GET['courseid']; ?>&resourceid=<?php echo $crs['resourceid']; ?>" style="background:none !important;"><?php echo  '<strong>'.$crs['headingname'].'</strong>'; ?></a>
  </li>
  <div class="clear"></div>
  <?php }$kkk2++;} } ?>
  <div class="clear"></div>
  </ul>
  <ul>
  <?php $kkk3=1; $ttid=0; if(isset($descripting)){ foreach($descripting as $crs){
	  $ttid=$tid;
	  $tid=$crs['topic_id'];
	  if($ttid!=$crs['topic_id']){
	   ?>
  <li style="list-style:none; float:left;"><a href="index.php?route=klaspad/klaspad/module_activity&moduleid=<?php echo $_GET['moduleid']; ?>&topicid=<?php echo $_GET['topicid']?>&headingid=<?php echo $crs['topic_id']; ?>&courseid=<?php echo $_GET['courseid']; ?>&resourceid=<?php echo $crs['resourceid']; ?>" style="background:none !important;"><?php echo  '<strong>'.$crs['headingname'].'</strong>'; ?></a>
  </li>
  <div class="clear"></div>
  <?php }$kkk3++;} } ?>
  <div class="clear"></div>
  </ul>  
  <ul>
  <?php $kkk4=1; $ttid=0; if(isset($truefalse)){ foreach($truefalse as $crs){
	  $ttid=$tid;
	  $tid=$crs['topic_id'];
	  if($ttid!=$crs['topic_id']){
	   ?>
  <li style="list-style:none; float:left;"><a href="index.php?route=klaspad/klaspad/module_activity&moduleid=<?php echo $_GET['moduleid']; ?>&topicid=<?php echo $_GET['topicid']?>&headingid=<?php echo $crs['topic_id']; ?>&courseid=<?php echo $_GET['courseid']; ?>&resourceid=<?php echo $crs['resourceid']; ?>" style="background:none !important;"><?php echo  '<strong>'.$crs['headingname'].'</strong>'; ?></a>
  </li>
  <div class="clear"></div>
  <?php }$kkk4++;} } ?>
  <div class="clear"></div>
  </ul>
  <ul>
  <?php $kkk5=1; $ttid=0; if(isset($draganddrop)){ foreach($draganddrop as $crs){
	  $ttid=$tid;
	  $tid=$crs['topic_id'];
	  if($ttid!=$crs['topic_id']){
	   ?>
  <li style="list-style:none; float:left;"><a href="index.php?route=klaspad/klaspad/module_activity&moduleid=<?php echo $_GET['moduleid']; ?>&topicid=<?php echo $_GET['topicid']?>&headingid=<?php echo $crs['topic_id']; ?>&courseid=<?php echo $_GET['courseid']; ?>&resourceid=<?php echo $crs['resourceid']; ?>" style="background:none !important;"><?php echo  '<strong>'.$crs['headingname'].'</strong>'; ?></a>
  </li>
  <div class="clear"></div>
  <?php }$kkk5++;} } ?>
  <div class="clear"></div>
  </ul>
  </div>
   </div>
  <!-- End Gray Box Left -->
 <script>
function AdmofferedValidation(str){
var con =confirm('After submission the assignment will be submitted to your teacher and you will not be able to make changes to it. Do you want to continue?');
      if(con){
		  document.getElementById('submitted'+str).value='1'; 
		  document.getElementById('assnfrm'+str).submit();
		  
      }else{
         return false;  
      }
	
}
</script> 
  <!-- Box Right -->
  
  <!-- End Box Right -->
  <div class="clear"></div>
 </div> <!-- End Gray Box -->
 
 <!-- Footer Box -->
 <!-- End Footer Box -->
</div>
<!-- End Right Body -->
</div>
  <!-- End SlidesJS Required -->
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

  <!-- SlidesJS Required: Link to jquery.slides.js -->
  <script src="klaspad/js/jquery.slides.min.js"></script>
  <!-- End SlidesJS Required -->

  <!-- SlidesJS Required: Initialize SlidesJS with a jQuery doc ready -->
  <script>
    $(function() {
      $('#slides').slidesjs({
        width: 700,
        height: 500,
        play: {
          active: true,
          auto: true,
          interval: 20000,
          swap: true
        }
      });
    });
  </script>

<!-- End Container -->
</body>
</html>