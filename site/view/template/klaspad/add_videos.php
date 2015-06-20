<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo 'Video'; ?></title>
<!-- Main Css -->
<link href="klaspad/css/main.css" rel="stylesheet">
<!-- End Main css -->
<!-- Show Hide -->
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<link rel="stylesheet" type="text/css" href="klaspad/highslide/highslide.css" /> 
<script type="text/javascript" src="klaspad/highslide/highslide-with-html.js"></script> 
<script type="text/javascript">
hs.graphicsDir = 'klaspad/highslide/graphics/';
hs.outlineType = 'rounded-white';
hs.wrapperClassName = 'draggable-header';
</script> 
 <script>
 $(document).ready(function() {
 $('#noofwords').change(function() {
 $("#mytableid").html('');	 
 var i=$(this).val();
 var j=0;
 for(j=0;i>j;j++){
 $("#mytableid").append('<tr><td>Word</td><td><input type="text" name="word[]"></td><td>Hint</td><td><input type="text" name="question[]"></td></tr>');
 }
 });
 });
 </script>
  
<script>
 function showhide (str){
		if(document.getElementById(str).style.display=='block')
		{
		document.getElementById(str).style.display='none';	
			}
			else{
		document.getElementById(str).style.display='block';
			}
 }
 
  function loadXMLDoc()
{
var str=document.getElementById('topic_id_id').value;	
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("topic_id").innerHTML=xmlhttp.responseText;
	document.getElementById('cheading').href='index.php?route=klaspad/klaspad/add_headings&type=<?php echo $_GET['type']; ?>&courseid=<?php  echo $courseid; ?>&moduleid=<?php echo $moduleid; ?>&topicid='+str;
	document.getElementById('hheading').href='index.php?route=klaspad/klaspad/headings_list&type=<?php echo $_GET['type']; ?>&courseid=<?php  echo $courseid; ?>&moduleid=<?php echo $moduleid; ?>&topicid='+str;
    }
  }
xmlhttp.open("POST","index.php?route=klaspad/klaspad/showheading",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("id="+str+"&exerciestype=<?php echo urldecode($_GET['type']); ?>");
}


 function unit_loadXMLDoc(str){
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("unit_id").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","index.php?route=klaspad/klaspad/unit_loadXMLDoc",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("id="+str+"&exerciestype=<?php echo urldecode($_GET['type']); ?>");
}

function topic_loadXMLDoc(str){
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("topic_id").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","index.php?route=klaspad/klaspad/topic_loadXMLDoc",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("id="+str+"&exerciestype=<?php echo urldecode($_GET['type']); ?>");
}
function checkexercises(str){
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("checkexercises").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","index.php?route=klaspad/klaspad/checkexercises",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("id="+str);
}
function checkresources(str){
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		var s=xmlhttp.responseText.split("$$$$$$$$");
		if(s[0]!=0){
			document.getElementById('notupdate').style.display='none';
		//alert(xmlhttp.responseText);
		}else{
			document.getElementById('notupdate').style.display='block';
		}
	document.getElementById("checkexercises").innerHTML=s[1];
    }
  }
xmlhttp.open("POST","index.php?route=klaspad/klaspad/checkresourcesvideo&type=<?php echo $_GET['type']; ?>",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("id="+str);
}
</script>
<script>	
<?php if(@$_GET['type']){ ?>
		function validateform(){
        var fup = document.getElementById('filename');
        var fileName = fup.value;
        var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
			if(document.getElementById('course_id').value==''){
				alert('Please select course');
				return false;
				}else if(document.getElementById('unit_id').value==''){
				alert('Please select unit');
				return false;
				}else if(document.getElementById('topic_id_id').value==''){
				alert('Please select topic');
				return false;
				}else if(document.getElementById('topic_id').value==''){
				alert('Please select heading');
				return false;
				}else  if(document.getElementById('excercisename').value==''){
				alert('Please enter excercise name');
				return false;
				}else if(ext !="pptx" && ext != "ppt"){
				alert("Upload ppt only");
				return false;
				}
			}
	<?php }else{?>
		function validateform(){
			if(document.getElementById('course_id').value==''){
				alert('Please select course');
				return false;
				}else if(document.getElementById('unit_id').value==''){
				alert('Please select unit');
				return false;
				}else if(document.getElementById('topic_id_id').value==''){
				alert('Please select topic');
				return false;
				}else if(document.getElementById('topic_id').value==''){
				alert('Please select heading');
				return false;
				}else  if(document.getElementById('exerciestype').value==''){
				alert('Please enter exercise type');
				return false;
				}
			}
<?php } ?>			
	</script>
 <script type="text/javascript" src="klaspad/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
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
	});
</script>  
    <!-- End Show Hide -->
</head>

<body onLoad="if(document.getElementById('topic_id_id').value!=''){loadXMLDoc();}">

<!-- Container -->
<div>
 
 <!-- Right Section -->
<div class="rightsection" style="float:none; width:100%;">
 <!-- Top Menu -->
<div class="topmenulist">
  <ul>
   <!--<li><a href="<?php echo baseurl; ?>/excercises_list">Excercise List</a></li> -->
   <li><a href="javascript:void(0);">Video/Audio</a></li>
  </ul>
  <div class="clear"></div>
 </div>
 <!-- End Top Menu -->
 
 <!-- Table Listing -->
<form action="index.php?route=klaspad/klaspad/insert_audio_video_excercises&type=<?php echo $_GET['type']; ?>&moduleid=<?php echo $_GET['moduleid']; ?>" enctype="multipart/form-data" onsubmit="return validateform();" method="post" id="formid" name="formid">
 <table width="100%" border="0" cellspacing="0" cellpadding="4">

  <tr>
  <td width="16%" valign="top" style="color:#F00;">Course *</td>
    <td width="27%" valign="top">
    <?php  echo $coursename; ?>
    </td>
    </tr>
    <tr>
  <td width="17%" valign="top" style="color:#F00;">Module *</td>
    <td width="35%" valign="top"><?php echo $modulename; ?></td>
  </tr>
  <tr>
  <td valign="top" style="color:#F00;">Topic *</td>
    <td valign="top">
    <select  name="topic_id_id" onChange="loadXMLDoc();" id="topic_id_id">
    <option value="">Select</option>
    <?php foreach($topicslistlist as $topics){?>
    <option value="<?php echo $topics['topicid']; ?>"  <?php echo (@$_SESSION['tid']==$topics['topicid']) ?  'selected' : '' ; ?> ><?php echo $topics['topicname']; ?></option>
    <?php } ?>
    </select>
    <a href="index.php?route=klaspad/klaspad/add_topics&os=module&courseid=<?php  echo $courseid; ?>&moduleid=<?php echo $moduleid; ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', preserveContent: false, width:400, height:390} );" style="background:url(klaspad/images/plusIcon.jpg) no-repeat left 2px; padding:0px 0px 0px 18px; color:#666; text-decoration:none;"><!--<img src="<?php echo baseurl; ?>/images/plusIcon.jpg" title="Add topics"> -->Add Topics</a>
    <a href="index.php?route=klaspad/klaspad/topics_list&courseid=<?php  echo $courseid; ?>&moduleid=<?php echo $moduleid; ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', preserveContent: false, width:700, height:390} );" style="padding:0px 0px 0px 18px; color:#666; text-decoration:none;"><!--<img src="<?php echo baseurl; ?>/images/plusIcon.jpg" title="Add topics"> -->Manage Topics</a>
    </td>
    </tr>
    <tr>
  <td valign="top" style="color:#F00;" >Resource title *</td>
    <td valign="top"><select name="topic_id" onChange="checkresources(this.value);" id="topic_id">
    <option value="">Select</option>
    <?php foreach($topiclist as $cou){?>
    <option value="<?php echo $cou['topicid']; ?>" ><?php echo $cou['topicname']; ?></option>
    <?php } ?>
    </select>
    <a href="index.php?route=klaspad/klaspad/add_headings&type=<?php echo $_GET['type']; ?>&courseid=<?php  echo $courseid; ?>&moduleid=<?php echo $moduleid; ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', preserveContent: false, width:400, height:390} );" style="background:url(klaspad/images/plusIcon.jpg) no-repeat left 2px; padding:0px 0px 0px 18px; color:#666; text-decoration:none;" id="cheading"><!--<img src="/images/plusIcon.jpg" title="Add exercise"> -->Add Resource</a>
    <a href="index.php?route=klaspad/klaspad/headings_list&courseid=<?php  echo $courseid; ?>&moduleid=<?php echo $moduleid; ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', preserveContent: false, width:700, height:390} );" id="hheading" style="padding:0px 0px 0px 18px; color:#666; text-decoration:none;"><!--<img src="<?php echo baseurl; ?>/images/plusIcon.jpg" title="Add topics"> -->Manage Resource</a>
    </td>
  </tr>
  
   <tr><td colspan="2" id="checkexercises"></td></tr> 
   <tr><td colspan="2">
   <table width="100%" border="0" cellspacing="0" cellpadding="4" id="notupdate"> 
  <tr>
    <td style="color:#F00;">File <span style="color:#F00;">(Max 10 mb)*</span>
</td>
    <td>
    <input type="file" id="filename" name="pdf_files_only" /></td>
    </tr>
    <tr>
       <td>&nbsp;</td>
    <td>&nbsp;<!--<input type="text" name="rssfeedlink" /> --></td>
  </tr>
  <?php if(urldecode($_GET['type'])=='Add Video'){ ?>
  <tr>
    <td >Youtube link
</td>
    <td>
    <input type="text" name="excercises_youtube" /></td>
    </tr>
    <tr>
    <td>Embed</td>
    <td><input type="text" name="excercises_embed" /></td>
  </tr>
  <?php } ?>
    <!--<tr>
    <td >Notice 
</td>
    <td><textarea name="notice"></textarea>
    </td>
    </tr>
    <tr>
    <td>Conversation topic</td>
    <td><textarea name="conversationtopic"></textarea></td>

  </tr> -->
  
  
    <tr>
    <td>Resource Instruction</td>
    <td><textarea name="description"></textarea></td>
  </tr>
  
<tr>
    <td>Resource Description
</td>
    <td><textarea name="learningoutcomes"></textarea>
    <input type="hidden" name="notice" value="" />
    <input type="hidden" name="conversationtopic" value="" />
    </td>
    </tr>
    <tr>
    <td>References 
</td>
    <td><textarea name="rssfeedlink"></textarea>
    </td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td><!--<textarea name="description"></textarea> -->&nbsp;</td>
  </tr>


  <tr>
  <td colspan="2" id="blocksappend">
  <input type="hidden" value="<?php echo $this->session->data['campusid']; ?>" name="connectionid" >
  </td>
  </tr>
  <tr>
   <td colspan="2" align="left"><strong><span style="color:red;">* Mandatory Fields</span></strong></td>
  </tr>
  <tr>
   <td colspan="2" align="center">
   <input type="hidden" name="exerciestype" value="<?php echo urldecode($_GET['type']); ?>">
    <input type="hidden" name="excercisename" value="">
   <input type="submit" class="classBtn" value="Submit" style="font-size:18px !important; font-weight:bold;"></td>
  </tr>
  </table>
  </td>
  </tr>
</table>
</form>
 </div>
 <!-- End Right Section -->
</div>
<!-- End Container -->
</body>
</html>