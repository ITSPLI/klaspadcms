<?php //error_reporting(E_ALL);
//ini_set('display_errors','On');
class ControllerKlaspadKlaspad extends Controller {

	public $flag='';
	public function index() {
	//if((isset($this->session->data['userid']))||(@$this->session->data['agentId']!='' && @$this->session->data['agentId']!='0')){
		$this->load->model('agent/agent');
		//***************Clearing session variables*****************//	
		unset($_SESSION['photoname']);
    	unset($_SESSION['passportname']);
    	unset($_SESSION['documentname1']);
    	unset($_SESSION['documentname2']);
    	unset($_SESSION['documentname3']);			
    	unset($_SESSION['documentname4']);
    	unset($_SESSION['cvname']);
	  				
    	$this->getList();
	/*}else
		{
			
			$this->session->data['messages']='You must Login First.';
  			$this->redirect($this->url->https('adminhome/adminhome'));
	 	}*/
	}
public function dash_board()
	{
	if(isset($this->session->data['userid'])){
	$this->id       = 'content';
		$this->template = 'klaspad/dash_board.php';
		//$this->layout   = 'module/layout';
		$this->render();		
	//$this->load->view('welcome/dash_board');
	}else{
    $this->session->data['messages']='You must Login First.';
  			$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}

public function admission()
	{
	if(isset($this->session->data['userid'])){
	$this->id       = 'content';
		$this->template = 'klaspad/admission.php';
		//$this->layout   = 'module/layout';
		$this->render();		
	//$this->load->view('welcome/dash_board');
	}else{
    $this->session->data['messages']='You must Login First.';
  			$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}
public function educationalprogress()
	{
	if(isset($this->session->data['userid'])){
	$this->id       = 'content';
		$this->template = 'klaspad/educationalprogress.php';
		//$this->layout   = 'module/layout';
		$this->render();		
	//$this->load->view('welcome/dash_board');
	}else{
    $this->session->data['messages']='You must Login First.';
  			$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}
	
public function accounts()
	{
	if(isset($this->session->data['userid'])){
	$this->id       = 'content';
		$this->template = 'klaspad/accounts.php';
		//$this->layout   = 'module/layout';
		$this->render();		
	//$this->load->view('welcome/dash_board');
	}else{
    $this->session->data['messages']='You must Login First.';
  			$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}	
			
public function login_check(){
$curtime = date('Y-m-d H:i:s');
$addtime = date('Y-m-d H:i:s', strtotime(' + 10 seconds'));
$minustime = date('Y-m-d H:i:s', strtotime(' - 10 seconds'));
$logouttime = date('Y-m-d H:i:s', strtotime(' - 10800 seconds'));

$mm=mysql_query('select distinct userid from logindetails where logindate <= "'.$curtime.'" and (logindate>="'.$logouttime.'" and logoutdate="0000-00-00 00:00:00") ');
$curtime=mysql_num_rows($mm);

$ss=mysql_query('select distinct userid from logindetails where logindate <= "'.$addtime.'" and (logindate>="'.$logouttime.'" and logoutdate="0000-00-00 00:00:00") ');
$addtime=mysql_num_rows($ss);

$tt=mysql_query('select distinct userid from logindetails where logindate <= "'.$minustime.'" and (logindate>="'.$logouttime.'" and logoutdate="0000-00-00 00:00:00") ');
$minustime=mysql_num_rows($tt);
$data=array('minustime'=>$minustime,'curtime'=>$curtime,'addtime'=>$addtime);
echo json_encode($data);
exit;
	}
	
public function gummit()
	{
		$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){	
	$this->data['board_list'] = array();
	$count=$this->model_klaspad_klaspad->board_name_count();	
if(count($count)>0){
	foreach($count as $result)
				{
					$action = array();
			        $this->data['board_list'][]=array(
					'id'=>$result['id'],
					'board_name' => $result['board_name'],
                    'board_image' => $result['board_image']
					);
									}
	$this->id       = 'content';
		$this->template = 'klaspad/step_two.php';
		//$this->layout   = 'module/layout';
		$this->render();
	
}else{
	$this->id       = 'content';
		$this->template = 'klaspad/gummit.php';
		//$this->layout   = 'module/layout';
		$this->render();
	
}
	}else{
   			$this->session->data['messages']='You must Login First.';
  			$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}
public function gummit_2()
	{
	if(isset($this->session->data['userid'])){	
	$this->id       = 'content';
		$this->template = 'klaspad/gummit.php';
		//$this->layout   = 'module/layout';
		$this->render();
	}else{
   			$this->session->data['messages']='You must Login First.';
  			$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}		
public function create_board(){
	$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){	
	$data['courselist']=$this->model_klaspad_klaspad->create_board();
	$this->redirect($this->url->https('klaspad/klaspad/gummit'));	
	//redirect('step_two');
	}else{
    $this->session->data['messages']='You must Login First.';
  			$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}
public function edit_board(){
	$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){	
	$record=$this->model_klaspad_klaspad->board_gumm_record();
	$this->data['board_name']=$record['board_name'];
	$this->data['board_image']=$record['board_image'];
	$this->data['id']=$record['id'];
	$this->id       = 'content';
		$this->template = 'klaspad/edit_board.php';
		//$this->layout   = 'module/layout';
		$this->render();
	//$this->load->view('welcome/edit_board',$data);	
	}else{
   $this->session->data['messages']='You must Login First.';
  			$this->redirect($this->url->https('adminhome/adminhome'));
	}
	}	
public function insert_board_note(){
	if(isset($this->session->data['userid'])){	
	if(isset($_FILES["board_image"]["size"])){
	if($_FILES["board_image"]["size"]>0){		
	$name=str_replace(' ','_',$_FILES["board_image"]["name"]);
	move_uploaded_file ($_FILES["board_image"]["tmp_name"], 'klaspad/uploads/gummitimage/'.$this->session->data['userid'].'/board/'.$name);	
	//$_POST['board_image']=$name;
	}
	}else{}	
	mysql_query("update e_".$this->session->data['campusid']."_edu_gummboard set board_name='".$_POST['board_name']."', board_image='".$name."'  where id='".$_POST['id']."'");
	
	$this->session->data['messages']='Note added';	
	$this->redirect($_SERVER['HTTP_REFERER']);
	}else{
   $this->session->data['messages']='You must Login First.';
  			$this->redirect($this->url->https('adminhome/adminhome'));
	}	
	}
	
	public function add_note_board(){
		$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){	
	$record=$this->model_klaspad_klaspad->board_gumm_record();
	$this->id       = 'content';
	$this->template = 'klaspad/add_note_board.php';
	$this->render();
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	}
	}
	public function courses_list()
	{
		$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){
		$this->data['course_list'] = array();	
	$record=$this->model_klaspad_klaspad->courses_list();
	foreach($record as $course){
		$this->data['course_list'][]=array(
					'id'=>$course['id'],
					'coursename' => $course['coursename']
					);
	$this->data['module'.$course['id']]=array();				
	${'module'.$course['id']}=$this->model_klaspad_klaspad->modules_coursewise_list($course['id']);
	//echo '<pre>';
	//print_r(${'module'.$course['id']});
	foreach(${'module'.$course['id']} as $result)
				{
				   $this->data['module'.$course['id']][]=array(
					'id'=>$result['id'],
					'modulename' => $result['modulename']
					);
				}
	}
	//$this->load->view('courses/list_courses',$data);
	$this->id       = 'content';
	$this->template = 'klaspad/list_courses.php';
	$this->render();
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
	
	public function add_courses(){
	$this->load->model('klaspad/klaspad');	
	if(isset($this->session->data['userid'])){
		$this->data['campus_list'] = array();	
	$campus=$this->model_klaspad_klaspad->campus_list();
	foreach($campus as $camp){
	$this->data['campus_list'][]=array(
					'id'=>$camp['id'],
					'campusname' => $camp['campusname']
					);	
	}
	$this->data['department_list'] = array();
	$department=$this->model_klaspad_klaspad->departmentlist();
	foreach($department as $dep){
	$this->data['department_list'][]=array(
					'id'=>$dep['id'],
					'department' => $dep['department']
					);	
	}
	if(isset($_GET['courseid'])){
	$record=$this->model_klaspad_klaspad->courses_record();
	$this->data['id']=$record['id'];	
	$this->data['campus_id']=$record['campus_id'];	
	$this->data['department_id']=$record['department_id'];	
	$this->data['coursename']=$record['coursename'];	
	$this->data['courseno']=$record['courseno'];	
	$this->data['courseduration']=$record['courseduration'];	
	$this->data['description']=$record['description'];	
	$this->data['perqualification']=$record['perqualification'];	
	$this->data['degreediplomaoffered']=$record['degreediplomaoffered'];	
	$this->data['awardingbody']=$record['awardingbody'];	
	$this->data['awardingbodycourseid']=$record['awardingbodycourseid'];	
	$this->data['qfqualcourseid']=$record['qfqualcourseid'];
	$this->data['coursecredit']=$record['coursecredit'];
	$this->data['learningoutcomes']=$record['learningoutcomes'];	
	$this->data['imageupload']=$record['imageupload'];
		}else{
	}
	$this->id       = 'content';
	$this->template = 'klaspad/add_courses.php';
	$this->render();
	//$this->load->view('courses/add_courses',$data);	
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
	
	public function insert_courses()
	{
		//echo '<pre>';
		//print_r($_FILES['imageupload']);
		//die;
	$this->load->model('klaspad/klaspad');	
	if(isset($this->session->data['userid'])){	
	$val=$this->model_klaspad_klaspad->insert_courses();
	//echo $val;
	//die;
	
	if($val!=''){
	header("Location:".$val);
	}else{	
	if(isset($_GET['courseid'])){
    $this->session->data['messages']='Course updated successfully';
	}else{
    $this->session->data['messages']='Course added successfully';
	}?>
<script>
			   parent.window.hs.getExpander().close();
</script>
	<?php }}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
	
	public function add_modules()
	{
	$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){
	$this->data['course_list'] = array();	
	$course=$this->model_klaspad_klaspad->courses_list();	
	
	foreach($course as $camp){
	$this->data['course_list'][]=array(
					'id'=>$camp['id'],
					'coursename' => $camp['coursename']
					);	
	}
	if(isset($_GET['moduleid'])){
	$record=$this->model_klaspad_klaspad->modules_record();
	$this->data['id']=$record['id'];
	$this->data['course_id']=$record['course_id'];
	$this->data['modulename']=$record['modulename'];
	$this->data['moduleno']=$record['moduleno'];
	$this->data['awardingbodyrefnumber']=$record['awardingbodyrefnumber'];
	$this->data['numberofcredits']=$record['numberofcredits'];
	$this->data['description']=$record['description'];
	$this->data['learningoutcomes']=$record['learningoutcomes'];
	$this->data['moduletype']=$record['moduletype'];	
		}else{
	}
	$this->id       = 'content';
	$this->template = 'klaspad/add_modules.php';
	$this->render();
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
	
	public function delete_courses()
	{
		$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){	
	$this->model_klaspad_klaspad->delete_courses();
    $this->session->data['messages']='Record deleted successfully';
	$this->redirect($_SERVER['HTTP_REFERER']);
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
	
	public function delete_modules()
	{
	$this->load->model('klaspad/klaspad');	
	if(isset($this->session->data['userid'])){	
	$this->model_klaspad_klaspad->delete_modules();
    $this->session->data['messages']='Record deleted successfully';
	$this->redirect($_SERVER['HTTP_REFERER']);
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
	
	public function insert_modules()
	{
	$this->load->model('klaspad/klaspad');	
	if(isset($this->session->data['userid'])){	
	$this->model_klaspad_klaspad->insert_modules();
	if(isset($_GET['moduleid'])){
    $this->session->data['messages']='Module updated successfully';
	}else{
    $this->session->data['messages']='Module added successfully';
	}?>
<script>
	   parent.window.hs.getExpander().close();
</script>
	<?php }else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
	
	public function course_list()
	{
		$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){
	$this->data['course_list'] = array();		
	$courselist=$this->model_klaspad_klaspad->course_list();
	foreach($courselist as $result)
				{
					$action = array();
			        $this->data['course_list'][]=array(
					'id'=>$result['id'],
					'coursename' => $result['coursename']
					);
									}
	//$this->load->view('welcome/course_list',$data);
	$this->id       = 'content';
	$this->template = 'klaspad/course_list.php';
	$this->render();
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	}
	}
	
	public function gummit_board_delete(){
	if(isset($this->session->data['userid'])){	
	$id=$_GET['id'];
	mysql_query("delete from e_".$this->session->data['campusid']."_edu_gummboard where id='".$id."'");
	$this->redirect($_SERVER['HTTP_REFERER']);
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}
	
	public function insert_notes(){
		$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){
	mysql_query("insert into e_".$this->session->data['campusid']."_edu_board_note set note_description='".$_POST['note_description']."', board_id='".$_POST['board_id']."'");		
	
	//$this->session->data['messages']='Note added';	
?>	   <script>
   parent.window.hs.getExpander().close();
   parent.location.reload();
   </script>
<?php
	}else{
    $this->session->data['messages']='You must Login First.';
  			$this->redirect($this->url->https('adminhome/adminhome'));
	}	
	}
			
  public function excercises_list()
	{
	$this->load->model('klaspad/klaspad');	
	if(isset($this->session->data['userid'])){	
	$record=$this->model_klaspad_klaspad->excercises_list();
	$this->id       = 'content';
	$this->template = 'klaspad/list_excercises.php';
	$this->render();
	//$this->load->view('excercises/list_excercises',$data);
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
	
   public function resource_list()
	{
	$this->load->model('klaspad/klaspad');	
	if(isset($this->session->data['userid'])){	
	$record=$this->model_klaspad_klaspad->excercises_list();
	$this->id       = 'content';
	$this->template = 'klaspad/list_resources.php';
	$this->render();
	//$this->load->view('excercises/list_excercises',$data);
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}	
	
  public function add_crosswords()
	{
	$this->load->model('klaspad/klaspad');	
	$courselist=$this->model_klaspad_klaspad->courses_list_new();
	$this->data['courseid']=$courselist['id'];
	$this->data['coursename']=$courselist['coursename'];
	$modulelist=$this->model_klaspad_klaspad->modules_list_new();	
	$this->data['moduleid']=$modulelist['id'];
	$this->data['modulename']=$modulelist['modulename'];
	$this->data['topicslistlist'] = array();	
	$topicslistlist=$this->model_klaspad_klaspad->topics_list_list_new_new();
	foreach($topicslistlist as $result)
				{
					$this->data['topicslistlist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
									}
	$this->data['topiclist'] = array();										
	$topiclist=$this->model_klaspad_klaspad->topics_list();	
		
	foreach($topiclist as $result)
				{
					$this->data['topiclist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
									}
	$this->data['resourcelist'] = array();									
	$resourcelist=$this->model_klaspad_klaspad->resource_list();
	foreach($resourcelist as $result)
				{
					$this->data['resourcelist'][]=array(
					'resourceid'=>$result['resourceid'],
					'headingname' => $result['headingname']
					);
				}								
	if(isset($this->session->data['userid'])){	
	if(@$_GET['exerciseid']){
	$record=$this->model_klaspad_klaspad->excercises_record();
	$this->data['id']=$record['id'];	
	$this->data['exerciestype']=$record['exerciestype'];	
	}
	$this->id       = 'content';
	$this->template = 'klaspad/add_crosswords.php';
	$this->render();
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
	
	public function add_topics()
	{
	$this->load->model('klaspad/klaspad');		
	if(isset($this->session->data['userid'])){	
	if($_GET['os']!='module'){
		
	$record=$this->model_klaspad_klaspad->topics_record();
	$this->data['id']=$record['id'];
	$this->data['topicname']=$record['topicname'];
	$this->data['topicno']=$record['topicno'];
	$this->data['description']=$record['description'];
	$this->data['learningoutcomes']=$record['learningoutcomes'];
	} 
	$this->id       = 'content';
	$this->template = 'klaspad/add_topics.php';
	$this->render();
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
	
	public function insert_topics()
	{
	$this->load->model('klaspad/klaspad');	
	if(isset($this->session->data['userid'])){	
	$this->model_klaspad_klaspad->insert_topics();
	if(@$_GET['os']!='module'){
    $this->session->data['messages']='Topic updated successfully';
	}else{
    $this->session->data['messages']='Topic added successfully';
	}?>
   <script>
   parent.window.hs.getExpander().close();
   parent.location.reload();
   </script>
	<?php }else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
	public function showheading(){
	$this->id       = 'content';
	$this->template = 'klaspad/showheading.php';
	$this->render();	
	//$this->load->view('exercisedashboard/showheading');		
	}
	public function showresource(){
	$this->id       = 'content';
	$this->template = 'klaspad/showresource.php';
	$this->render();	
	//$this->load->view('exercisedashboard/showheading');		
	}
	public function add_headings(){
	$this->load->model('klaspad/klaspad');	
	if(isset($this->session->data['userid'])){
		$this->data['topiclist'] = array();	
	$topiclist=$this->model_klaspad_klaspad->topics_list_list_new();
	foreach($topiclist as $result)
				{
					$this->data['topiclist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
									}	
	if(@$_GET['headingid']){
	$record=$this->model_klaspad_klaspad->headings_record();
	$this->data['id']=$record['id'];
	$this->data['exerciestype']=$record['exerciestype'];
	$this->data['headingname']=$record['headingname'];	
	} 
	$this->id       = 'content';
	$this->template = 'klaspad/add_headings.php';
	$this->render();
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
	public function insert_headings()
	{
	$this->load->model('klaspad/klaspad');	
	if(isset($this->session->data['userid'])){	
	$this->model_klaspad_klaspad->insert_headings();
	$_SESSION['tid']=$_POST['topic_id'];
	if(@$_GET['headingid']){
    $this->session->data['messages']='Heading updated successfully';
	}else{
    $this->session->data['messages']='Heading added successfully';
	}?><script>
   parent.window.hs.getExpander().close();
   parent.location.reload();
	</script><?php }else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
	
	function checkexercises(){
	echo 'select e.id as id, h.id as headingid, t.id as topicid, m.id as moduleid,m.course_id as course_id , e.uploadimage, e.excercisename from e_'.$this->session->data['campusid'].'_edu_excercises_crossword as e left join e_'.$this->session->data['campusid'].'_edu_headings as h on e.topic_id = h.id left join e_'.$this->session->data['campusid'].'_edu_topics as t on h.topic_id = t.id left join e_'.$this->session->data['campusid'].'_edu_modules as m on t.module_id=m.id where e.topic_id = "'.$_POST['tid'].'" and e.resourceid = "'.$_POST['id'].'"';
	exit;	
	$this->load->model('klaspad/klaspad');	
	$rec=$this->model_klaspad_klaspad->checkexercises();
	echo '<table>';
	$i=1;
	foreach($rec as $record){
	echo '<tr id="'.$record['id'].'"><th>'.$i.'.&nbsp;&nbsp;&nbsp;&nbsp;</th><td>'.$record['excercisename'].'</td><td>';
			if($record['uploadimage']!=''){
	echo '<img src="klaspad/uploads/'.$this->session->data['campusid'].'/'.$record['course_id'].'/exercise/'.$record['uploadimage'].'" width="17" >';
	}

	echo '</td><td><a href="index.php?route=klaspad/klaspad/module_activity&moduleid='.$record['moduleid'].'&topicid='.$record['topicid'].'&headingid='.$record['headingid'].'&resourceid='.$record['id'].'&courseid='.$record['course_id'].'" target="_blank"><img src="klaspad/images/view.png" border="0" title="View"></a></td>
	<td><a href="index.php?route=klaspad/klaspad/delete_excercises&resourceid='.$record['id'].'" target="_blank" onClick=document.getElementById(\''.$record['id'].'\').style.display=\'none\';  >
  <img src="klaspad/images/delete.png" title="Delete">
  </a>
  
	</td>
</tr>';
/*  <a href="index.php?route=klaspad/klaspad/fillintheblank_image_uploaded/'.$record['id'].'" target="_blank"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\', preserveContent: false} );"  >
  <img src="klaspad/images/upload-icon.png" title="upload">
  </a>  */
	$i++; }
	echo '</table>';	
	exit;
	}
	
	function checkexercises_fill(){
	$this->load->model('klaspad/klaspad');	
	$rec=$this->model_klaspad_klaspad->checkexercises_fill();
	echo '<table>';
	$i=1;
	foreach($rec as $record){
	echo '<tr id="'.$record['id'].'"><th>'.$i.'.&nbsp;&nbsp;&nbsp;&nbsp;</th><td>'.$record['excercisename'].'</td><td>';
			if($record['uploadimage']!=''){
	echo '<img src="klaspad/uploads/'.$this->session->data['campusid'].'/'.$record['course_id'].'/exercise/'.$record['uploadimage'].'" width="17" >';
	}

	echo '</td><td><a href="index.php?route=klaspad/klaspad/module_activity&moduleid='.$record['moduleid'].'&topicid='.$record['topicid'].'&headingid='.$record['headingid'].'&resourceid='.$record['id'].'&courseid='.$record['course_id'].'" target="_blank"><img src="klaspad/images/view.png" border="0" title="View"></a></td>
	<td><a href="index.php?route=klaspad/klaspad/delete_excercises&resourceid='.$record['id'].'" target="_blank" onClick=document.getElementById(\''.$record['id'].'\').style.display=\'none\';  >
  <img src="klaspad/images/delete.png" title="Delete">
  </a>
  
	</td>
</tr>';
/*  <a href="index.php?route=klaspad/klaspad/fillintheblank_image_uploaded/'.$record['id'].'" target="_blank"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\', preserveContent: false} );"  >
  <img src="klaspad/images/upload-icon.png" title="upload">
  </a>  */
	$i++; }
	echo '</table>';	
	exit;
	}
	function checkexercises_dd(){
	$this->load->model('klaspad/klaspad');	
	$rec=$this->model_klaspad_klaspad->checkexercises_dd();
	echo '<table>';
	$i=1;
	foreach($rec as $record){
	echo '<tr id="'.$record['id'].'"><th>'.$i.'.&nbsp;&nbsp;&nbsp;&nbsp;</th><td>'.$record['excercisename'].'</td><td>';
			if($record['uploadimage']!=''){
	echo '<img src="klaspad/uploads/'.$this->session->data['campusid'].'/'.$record['course_id'].'/exercise/'.$record['uploadimage'].'" width="17" >';
	}

	echo '</td><td><a href="index.php?route=klaspad/klaspad/module_activity&moduleid='.$record['moduleid'].'&topicid='.$record['topicid'].'&headingid='.$record['headingid'].'&resourceid='.$record['id'].'&courseid='.$record['course_id'].'" target="_blank"><img src="klaspad/images/view.png" border="0" title="View"></a></td>
	<td><a href="index.php?route=klaspad/klaspad/delete_excercises&resourceid='.$record['id'].'" target="_blank" onClick=document.getElementById(\''.$record['id'].'\').style.display=\'none\';  >
  <img src="klaspad/images/delete.png" title="Delete">
  </a>
  
	</td>
</tr>';
/*  <a href="index.php?route=klaspad/klaspad/fillintheblank_image_uploaded/'.$record['id'].'" target="_blank"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\', preserveContent: false} );"  >
  <img src="klaspad/images/upload-icon.png" title="upload">
  </a>  */
	$i++; }
	echo '</table>';	
	exit;
	}
	
	
	function checkresources(){
		
	$this->load->model('klaspad/klaspad');	
	$rec=$this->model_klaspad_klaspad->checkresource();
	//print_r($rec);
	//exit;
	echo '<table>';
	$i=1;
	foreach($rec as $record){
	echo '<tr id="'.$record['id'].'"><th>'.$i.'.&nbsp;&nbsp;&nbsp;&nbsp;</th><td>'.$record['uploadimage'].'</td><td>';
	echo '</td><td><a href="index.php?route=klaspad/klaspad/add_powerpoint_exercise&moduleid='.$record['moduleid'].'&topicid='.$record['topicid'].'&headingid='.$record['headingid'].'&resourceid='.$record['id'].'&courseid='.$record['course_id'].'" onclick="return parent.hs.htmlExpand(this, { objectType: \'iframe\', preserveContent: false, width:800, height:800} );"><img src="klaspad/images/view.png" border="0" title="View"></a></td>
	<td><a href="index.php?route=klaspad/klaspad/delete_resource&resourceid='.$record['id'].'"  onClick=document.getElementById(\''.$record['id'].'\').style.display=\'none\';  >
  <img src="klaspad/images/delete.png" title="Delete">
  </a>
  
	</td>
</tr>';
/*  <a href="index.php?route=klaspad/klaspad/fillintheblank_image_uploaded/'.$record['id'].'" target="_blank"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\', preserveContent: false} );"  >
  <img src="klaspad/images/upload-icon.png" title="upload">
  </a>  */
	$i++; }
	echo '</table>';	
	exit;	
	}
	function checkresourcespdf(){
	/*echo 'select e.id as id, h.id as headingid, t.id as topicid, m.id as moduleid,m.course_id as course_id , e.uploadimage, e.description, e.learningoutcomes, e.rssfeedlink, e.excercises_audio, e.excercises_video, e.excercises_youtube, e.excercises_embed from e_'.$this->session->data['campusid'].'_edu_excercises as e left join e_'.$this->session->data['campusid'].'_edu_headings as h on e.topic_id = h.id left join e_'.$this->session->data['campusid'].'_edu_topics as t on h.topic_id = t.id left join e_'.$this->session->data['campusid'].'_edu_modules as m on t.module_id=m.id where h.id = "'.$_POST['id'].'"';
	exit;*/	
	$this->load->model('klaspad/klaspad');	
	$rec=$this->model_klaspad_klaspad->checkresource();
	//print_r($rec);
	//exit;
	echo '<table>';
	$i=1;
	foreach($rec as $record){
	echo '<tr id="'.$record['id'].'"><th>'.$i.'.&nbsp;&nbsp;&nbsp;&nbsp;</th><td>'.$record['uploadimage'].'</td><td>';
	echo '</td><td><a href="index.php?route=klaspad/klaspad/add_files&moduleid='.$record['moduleid'].'&topicid='.$record['topicid'].'&headingid='.$record['headingid'].'&resourceid='.$record['id'].'&courseid='.$record['course_id'].'" onclick="return parent.hs.htmlExpand(this, { objectType: \'iframe\', preserveContent: false, width:800, height:800} );"><img src="klaspad/images/view.png" border="0" title="View"></a></td>
	<td><a href="index.php?route=klaspad/klaspad/delete_resource&resourceid='.$record['id'].'"  onClick=document.getElementById(\''.$record['id'].'\').style.display=\'none\';  >
  <img src="klaspad/images/delete.png" title="Delete">
  </a>
  
	</td>
</tr>';
/*  <a href="index.php?route=klaspad/klaspad/fillintheblank_image_uploaded/'.$record['id'].'" target="_blank"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\', preserveContent: false} );"  >
  <img src="klaspad/images/upload-icon.png" title="upload">
  </a>  */
	$i++; }
	echo '</table>';	
	exit;	
	}
	
	function checkresourcesvideo(){
	/*echo 'select e.id as id, h.id as headingid, t.id as topicid, m.id as moduleid,m.course_id as course_id , e.uploadimage, e.description, e.learningoutcomes, e.rssfeedlink, e.excercises_audio, e.excercises_video, e.excercises_youtube, e.excercises_embed from e_'.$this->session->data['campusid'].'_edu_excercises as e left join e_'.$this->session->data['campusid'].'_edu_headings as h on e.topic_id = h.id left join e_'.$this->session->data['campusid'].'_edu_topics as t on h.topic_id = t.id left join e_'.$this->session->data['campusid'].'_edu_modules as m on t.module_id=m.id where h.id = "'.$_POST['id'].'"';
	exit;*/	
	$this->load->model('klaspad/klaspad');	
	$rec=$this->model_klaspad_klaspad->checkresource();
	//print_r($rec);
	//exit;
	echo '<table>';
	$i=1;
	foreach($rec as $record){
	echo '<tr id="'.$record['id'].'"><th>'.$i.'.&nbsp;&nbsp;&nbsp;&nbsp;</th><td>';
	if($record['excercises_video']!=''){
	echo $record['excercises_video'];
	}else{
	echo $record['excercises_audio'];	
	}
	echo '</td><td>';
	echo '</td><td><a href="index.php?route=klaspad/klaspad/add_video&moduleid='.$record['moduleid'].'&topicid='.$record['topicid'].'&headingid='.$record['headingid'].'&resourceid='.$record['id'].'&courseid='.$record['course_id'].'" onclick="return parent.hs.htmlExpand(this, { objectType: \'iframe\', preserveContent: false, width:800, height:800} );"><img src="klaspad/images/view.png" border="0" title="View"></a></td>
	<td><a href="index.php?route=klaspad/klaspad/delete_resource&resourceid='.$record['id'].'"  onClick=document.getElementById(\''.$record['id'].'\').style.display=\'none\';  >
  <img src="klaspad/images/delete.png" title="Delete">
  </a>
  
	</td>
</tr>';
/*  <a href="index.php?route=klaspad/klaspad/fillintheblank_image_uploaded/'.$record['id'].'" target="_blank"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\', preserveContent: false} );"  >
  <img src="klaspad/images/upload-icon.png" title="upload">
  </a>  */
	$i++; }
	echo '</table>';	
	exit;	
	}
	
	
	
	function checkexercises_multi(){
	$this->load->model('klaspad/klaspad');	
	$rec=$this->model_klaspad_klaspad->checkexercises_multi();
	echo '<table>';
	$i=1;
	foreach($rec as $record){
	echo '<tr id="'.$record['id'].'"><th>'.$i.'.&nbsp;&nbsp;&nbsp;&nbsp;</th><td>'.$record['excercisename'].'</td><td>';
			if($record['uploadimage']!=''){
	echo '<img src="klaspad/uploads/'.$this->session->data['campusid'].'/'.$record['course_id'].'/exercise/'.$record['uploadimage'].'" width="17" >';
	}

	echo '</td><td><a href="index.php?route=klaspad/klaspad/module_activity&moduleid='.$record['moduleid'].'&topicid='.$record['topicid'].'&headingid='.$record['headingid'].'&resourceid='.$record['id'].'&courseid='.$record['course_id'].'" target="_blank"><img src="klaspad/images/view.png" border="0" title="View"></a></td>
	<td><a href="index.php?route=klaspad/klaspad/delete_excercises&resourceid='.$record['id'].'" target="_blank" onClick=document.getElementById(\''.$record['id'].'\').style.display=\'none\';  >
  <img src="klaspad/images/delete.png" title="Delete">
  </a>
  
	</td>
</tr>';
/*  <a href="index.php?route=klaspad/klaspad/fillintheblank_image_uploaded/'.$record['id'].'" target="_blank"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\', preserveContent: false} );"  >
  <img src="klaspad/images/upload-icon.png" title="upload">
  </a>  */
	$i++; }
	echo '</table>';	
	exit;
	}
	function checkexercises_truefalse(){
	$this->load->model('klaspad/klaspad');	
	$rec=$this->model_klaspad_klaspad->checkexercises_truefalse();
	echo '<table>';
	$i=1;
	foreach($rec as $record){
	echo '<tr id="'.$record['id'].'"><th>'.$i.'.&nbsp;&nbsp;&nbsp;&nbsp;</th><td>'.$record['excercisename'].'</td><td>';
			if($record['uploadimage']!=''){
	echo '<img src="klaspad/uploads/'.$this->session->data['campusid'].'/'.$record['course_id'].'/exercise/'.$record['uploadimage'].'" width="17" >';
	}

	echo '</td><td><a href="index.php?route=klaspad/klaspad/module_activity&moduleid='.$record['moduleid'].'&topicid='.$record['topicid'].'&headingid='.$record['headingid'].'&resourceid='.$record['id'].'&courseid='.$record['course_id'].'" target="_blank"><img src="klaspad/images/view.png" border="0" title="View"></a></td>
	<td><a href="index.php?route=klaspad/klaspad/delete_excercises&resourceid='.$record['id'].'" target="_blank" onClick=document.getElementById(\''.$record['id'].'\').style.display=\'none\';  >
  <img src="klaspad/images/delete.png" title="Delete">
  </a>
  
	</td>
</tr>';
/*  <a href="index.php?route=klaspad/klaspad/fillintheblank_image_uploaded/'.$record['id'].'" target="_blank"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\', preserveContent: false} );"  >
  <img src="klaspad/images/upload-icon.png" title="upload">
  </a>  */
	$i++; }
	echo '</table>';	
	exit;
	}
	
	function checkexercises_assignment(){
	/*echo 'select e.id as id, h.id as headingid, t.id as topicid, m.id as moduleid,m.course_id as course_id , e.uploadimage, e.excercisename from e_'.$this->session->data['campusid'].'_edu_excercises_assignment as e left join e_'.$this->session->data['campusid'].'_edu_headings as h on e.topic_id = h.id left join e_'.$this->session->data['campusid'].'_edu_topics as t on h.topic_id = t.id left join e_'.$this->session->data['campusid'].'_edu_modules as m on t.module_id=m.id where  e.resourceid = "'.$_POST['id'].'"';
	exit;*/	
	$this->load->model('klaspad/klaspad');	
	$rec=$this->model_klaspad_klaspad->checkexercises_assignment();
	echo '<table>';
	$i=1;
	foreach($rec as $record){
	echo '<tr id="'.$record['id'].'"><th>'.$i.'.&nbsp;&nbsp;&nbsp;&nbsp;</th><td>Assignment '.$i.'</td><td>';
			if($record['uploadimage']!=''){
	echo '<img src="klaspad/uploads/'.$this->session->data['campusid'].'/'.$record['course_id'].'/exercise/'.$record['uploadimage'].'" width="17" >';
	}

	echo '</td><td><a href="index.php?route=klaspad/klaspad/add_assiement&moduleid='.$record['moduleid'].'&topicid='.$record['topicid'].'&headingid='.$record['headingid'].'&resourceid='.$record['id'].'&courseid='.$record['course_id'].'" onclick="return parent.hs.htmlExpand(this, { objectType: \'iframe\', preserveContent: false, width:800, height:800} );"><img src="klaspad/images/view.png" border="0" title="View"></a></td>
	<td><a href="index.php?route=klaspad/klaspad/delete_assignment&resourceid='.$record['id'].'"  onClick=document.getElementById(\''.$record['id'].'\').style.display=\'none\';  >
  <img src="klaspad/images/delete.png" title="Delete">
  </a>
  
	</td>
</tr>';
/*  <a href="index.php?route=klaspad/klaspad/fillintheblank_image_uploaded/'.$record['id'].'" target="_blank"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\', preserveContent: false} );"  >
  <img src="klaspad/images/upload-icon.png" title="upload">
  </a>  */
	$i++; }
	echo '</table>';	
	exit;
	}
	public function delete_assignment()
	{
	if(isset($this->session->data['userid'])){
	mysql_query("delete from e_".$this->session->data['campusid']."_edu_excercises_assignment where id='".$_GET['resourceid']."'");
    //$this->session->set_flashdata('message', 'Record deleted successfully'); ?>
	<script>
    window.close();
    </script>
<?php	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
	
	function checkexercises_discussion(){
	
	$this->load->model('klaspad/klaspad');	
	$rec=$this->model_klaspad_klaspad->checkexercises_discussion();
	echo '<table>';
	$i=1;
	foreach($rec as $record){
	echo '<tr id="'.$record['id'].'"><th>'.$i.'.&nbsp;&nbsp;&nbsp;&nbsp;</th><td>Discussion '.$i.'</td><td>';
			if($record['uploadimage']!=''){
	echo '<img src="klaspad/uploads/'.$this->session->data['campusid'].'/'.$record['course_id'].'/exercise/'.$record['uploadimage'].'" width="17" >';
	}

	echo '</td><td><a href="index.php?route=klaspad/klaspad/add_discussion&moduleid='.$record['moduleid'].'&topicid='.$record['topicid'].'&headingid='.$record['headingid'].'&resourceid='.$record['id'].'&courseid='.$record['course_id'].'" onclick="return parent.hs.htmlExpand(this, { objectType: \'iframe\', preserveContent: false, width:800, height:800} );"><img src="klaspad/images/view.png" border="0" title="View"></a></td>
	<td><a href="index.php?route=klaspad/klaspad/delete_discussion&resourceid='.$record['id'].'"  onClick=document.getElementById(\''.$record['id'].'\').style.display=\'none\';  >
  <img src="klaspad/images/delete.png" title="Delete">
  </a>
  
	</td>
</tr>';
/*  <a href="index.php?route=klaspad/klaspad/fillintheblank_image_uploaded/'.$record['id'].'" target="_blank"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\', preserveContent: false} );"  >
  <img src="klaspad/images/upload-icon.png" title="upload">
  </a>  */
	$i++; }
	echo '</table>';	
	exit;
	}
	
	function checkexercises_descripting(){
	
	$this->load->model('klaspad/klaspad');	
	$rec=$this->model_klaspad_klaspad->checkexercises_descripting();
	echo '<table>';
	$i=1;
	foreach($rec as $record){
	echo '<tr id="'.$record['id'].'"><th>'.$i.'.&nbsp;&nbsp;&nbsp;&nbsp;</th><td>Question '.$i.'</td><td>';
			if($record['uploadimage']!=''){
	echo '<img src="klaspad/uploads/'.$this->session->data['campusid'].'/'.$record['course_id'].'/exercise/'.$record['uploadimage'].'" width="17" >';
	}

	echo '</td><td><a href="index.php?route=klaspad/klaspad/add_descripting&moduleid='.$record['moduleid'].'&topicid='.$record['topicid'].'&headingid='.$record['headingid'].'&resourceid='.$record['id'].'&courseid='.$record['course_id'].'" onclick="return parent.hs.htmlExpand(this, { objectType: \'iframe\', preserveContent: false, width:800, height:800} );"><img src="klaspad/images/view.png" border="0" title="View"></a></td>
	<td><a href="index.php?route=klaspad/klaspad/delete_descripting&resourceid='.$record['id'].'"  onClick=document.getElementById(\''.$record['id'].'\').style.display=\'none\';  >
  <img src="klaspad/images/delete.png" title="Delete">
  </a>
  
	</td>
</tr>';
/*  <a href="index.php?route=klaspad/klaspad/fillintheblank_image_uploaded/'.$record['id'].'" target="_blank"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\', preserveContent: false} );"  >
  <img src="klaspad/images/upload-icon.png" title="upload">
  </a>  */
	$i++; }
	echo '</table>';	
	exit;
	}
	
	public function delete_discussion()
	{
	if(isset($this->session->data['userid'])){
	mysql_query("delete from e_".$this->session->data['campusid']."_edu_excercises_discussion where id='".$_GET['resourceid']."'");
    //$this->session->set_flashdata('message', 'Record deleted successfully'); ?>
	<script>
    window.close();
    </script>
<?php	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
	
	public function delete_descripting()
	{
	if(isset($this->session->data['userid'])){
	mysql_query("delete from e_".$this->session->data['campusid']."_edu_excercises_descripting where id='".$_GET['resourceid']."'");
    //$this->session->set_flashdata('message', 'Record deleted successfully'); ?>
	<script>
    window.close();
    </script>
<?php	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
	
	
	
	public function delete_excercises()
	{
	if(isset($this->session->data['userid'])){
	$this->load->model('klaspad/klaspad');		
	$this->model_klaspad_klaspad->delete_excercises();
    //$this->session->set_flashdata('message', 'Record deleted successfully'); ?>
	<script>
    window.close();
    </script>
<?php	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
	public function delete_resource()
	{
	if(isset($this->session->data['userid'])){
	$this->load->model('klaspad/klaspad');		
	$this->model_klaspad_klaspad->delete_resource();
    ?>
	<script>
    parent.window.hs.getExpander().close();
   parent.location.reload();
    </script>
<?php	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
	public function insert_crossword_excercises()
	{
	$this->load->model('klaspad/klaspad');		
	if(isset($this->session->data['userid'])){	
	$id=$this->model_klaspad_klaspad->insert_crossword_excercises();
	$this->redirect($this->url->https('klaspad/klaspad/add_crosswords&type='.$_GET['type'].'&moduleid='.$_GET['moduleid'].'&exerciseid='.$id));			
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}	
	
public function insert_crossword_excercises_2(){
	$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){	
	$record=$this->model_klaspad_klaspad->insert_crossword_excercises_2();
	
	$this->redirect($this->url->https('klaspad/klaspad/mobile_module_activity&groupid='.$_POST['groupid']));
	?>
   <script>
   parent.window.hs.getExpander().close();
   parent.location.reload();
   </script>
	<?php
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 		
	}

public function mobile_module_activity()
	{
	if(isset($this->session->data['userid'])){
	$this->id       = 'content';
	$this->template = 'klaspad/mobile_crosswords.php';
	$this->render();	
	//$this->load->view('exercisedashboard/mobile_crosswords');
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}

public function courses()
	{
	$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){
		$this->data['all_course']=array();	
	$all_course=$this->model_klaspad_klaspad->all_course();
	foreach($all_course as $course){
		$this->data['all_course'][]=array(
					'id'=>$course['id'],
					'coursename' => $course['coursename']
					);
	$this->data['module'.$course['id']]=array();				
	${'module_course_wise'.$course['id']}=$this->model_klaspad_klaspad->module_course_wise($course['id']);
	//echo '<pre>';
	//print_r(${'module'.$course['id']});
	foreach(${'module_course_wise'.$course['id']} as $result)
				{
				   $this->data['module_course_wise'.$course['id']][]=array(
					'id'=>$result['id'],
					'modulename' => $result['modulename'],
					'moduletype' => $result['moduletype'],
					'lti_id' => $result['lti_id']
					);
				}
	}
	
	
	
	$board_name=$this->model_klaspad_klaspad->board_name();
	$this->id       = 'content';
	$this->template = 'klaspad/courses.php';
	$this->render();	
	//$this->load->view('exercisedashboard/courses',$data);
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
	
public function module_activity()
	{
		//$this->session->data['usraccesstype']='internal';	
		$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){
	$module_data=$this->model_klaspad_klaspad->module_data();
	$this->data['course_id']=$module_data['course_id'];
	$this->data['moduledescription']=$module_data['description'];
	$this->data['modulelearningoutcomes']=$module_data['learningoutcomes'];
	$all_exe=$this->model_klaspad_klaspad->list_module();
	$intro_topics=$this->model_klaspad_klaspad->intro_topics();
	$this->data['introvideo']=$intro_topics['introvideo'];
	$this->data['description']=$intro_topics['description'];
	$this->data['learningoutcomes']=$intro_topics['learningoutcomes'];
	foreach($all_exe as $all_exe){
	${'exe_'.$all_exe['id']}=$this->model_klaspad_klaspad->exercise_data($all_exe['id']);
	$exe_type[$all_exe['id']]=${'exe_'.$all_exe['id']}[1];
    }
	if(@$_GET['headingid']){
	$heading_data=$this->model_klaspad_klaspad->heading_data();
	$this->data['headingname']=$heading_data['headingname'];
	//echo '<pre>';
	//print_r($heading_data);
	$exe_dataa = $this->model_klaspad_klaspad->exercise_new_data($heading_data['id'],$heading_data['exerciestype']);
	//echo '<pre>';
	//print_r($exe_data);
	foreach($exe_dataa as $exe_data){
	$this->data['exe_data'][]=array('id' => $exe_data['id'],
            'topic_id' => $exe_data['topic_id'],
            'excercisename' => $exe_data['excercisename'],
            'exerciestype' => $exe_data['exerciestype'],
            'wordssentence' => $exe_data['wordssentence'],
            'answere' => $exe_data['answere'],
            'question' => $exe_data['question'],
            'checksentence' => $exe_data['checksentence'],
            'uploadimage' => $exe_data['uploadimage'],
            'topic_id_id' => $exe_data['topic_id_id'],
            'upload_folder' => $exe_data['upload_folder'],
            'conversationtopic' => $exe_data['conversationtopic'],
            'description' => $exe_data['description'],
			'learningoutcomes' => $exe_data['learningoutcomes'],
            'notice' => $exe_data['notice'],
            'excercises_video' => $exe_data['excercises_video'],
            'excercises_audio' => $exe_data['excercises_audio'],
            'modified_date' => $exe_data['modified_date'],
            'excercises_youtube' => $exe_data['excercises_youtube'],
            'video_icon' => $exe_data['video_icon'],
            'rssfeedlink' => $exe_data['rssfeedlink'],
            'excercises_embed' => $exe_data['excercises_embed'],
			'pptimagepath' => $exe_data['pptimagepath'],
            'favid' =>$exe_data['favid'] );
	}
	if($heading_data['exerciestype']=='Write in the correct box'){
		$this->data['blockdata'] = array();	
	$blockdata=$this->model_klaspad_klaspad->blocks_front_list($heading_data['id']);
			
	
	foreach($blockdata as $res)
				{
					$this->data['blockdata'][]=array(
					'id'=>$res['id'],
					'nameofthemyblocks' => $res['nameofthemyblocks'],
					'exercise_id' => $res['exercise_id'],
					'myblocks' => $res['myblocks'],
					'myblock_question' => $res['myblock_question']
					);
									}
									
	$this->data['totattmpt']=array();	
$query2=$this->db->query("select * from e_".$this->session->data['campusid']."_edu_result_draganddrop where topic_id='".$_GET['headingid']."' and user_id='".$this->session->data['userid']."' and total_question!='0'  order by id DESC limit 0,5");			
$totattmpt=$query2->rows;	
	//echo '<pre>';
	//print_r($totattmpt);
	foreach ($totattmpt as $tot){	
	$this->data['totattmpt'][]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'total_question' => $tot['total_question'],
            'correct_question' => $tot['correct_question'],
            'worng_question' => $tot['worng_question'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);
				
	}								
	$this->id       = 'content';
		$this->template = 'klaspad/write_in_the_correct_boxes.php';
		$this->render();								
	//$this->load->view('exercisedashboard/write_in_the_correct_box',$data);
	}else
	//echo $heading_data['exerciestype'];
	if($heading_data['exerciestype']=='Descripting'){
	//echo "select ee.*,ea.id as favid from e_".$this->session->data['campusid']."_edu_excercises_fillintheblanks as ee left join e_".$this->session->data['campusid']."_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$heading_data['id']."' ";	
	$query1=$this->db->query("select ee.*,ea.id as favid from e_".$this->session->data['campusid']."_edu_excercises_descripting as ee left join e_".$this->session->data['campusid']."_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$heading_data['id']."' and ee.resourceid='".$_GET['resourceid']."' ");		
	$exe_dataaa=$query1->rows;
	//echo '<pre>';
	//print_r($exe_data);
	foreach($exe_dataaa as $exe_data){
//$answere=array();
//echo "select * from e_".$this->session->data['campusid']."_edu_result_descripting where did='".$exe_data['id']."' and user_id='".$this->session->data['userid']."'";	
$query2=$this->db->query("select * from e_".$this->session->data['campusid']."_edu_result_descripting where did='".$exe_data['id']."' and user_id='".$this->session->data['userid']."'");			
$totattmpt=$query2->row;	
	
		
	$this->data['exe_dataa'][]=array('id' => $exe_data['id'],
            'topic_id' => $exe_data['topic_id'],
            'excercisename' => $exe_data['excercisename'],
            'exerciestype' => $exe_data['exerciestype'],
            'wordssentence' => $exe_data['wordssentence'],
            'answere' => $exe_data['answere'],
            'question' => $exe_data['question'],
            'checksentence' => $exe_data['checksentence'],
            'uploadimage' => $exe_data['uploadimage'],
            'topic_id_id' => $exe_data['topic_id_id'],
            'upload_folder' => $exe_data['upload_folder'],
            'conversationtopic' => $exe_data['conversationtopic'],
            'description' => $exe_data['description'],
			'learningoutcomes' => $exe_data['learningoutcomes'],
            'notice' => $exe_data['notice'],
            'excercises_video' => $exe_data['excercises_video'],
            'excercises_audio' => $exe_data['excercises_audio'],
            'modified_date' => $exe_data['modified_date'],
            'excercises_youtube' => $exe_data['excercises_youtube'],
            'video_icon' => $exe_data['video_icon'],
            'rssfeedlink' => $exe_data['rssfeedlink'],
            'excercises_embed' => $exe_data['excercises_embed'],
			'answere'=>$totattmpt['answere'],
			'answereid'=>$totattmpt['id'],
            'favid' =>$exe_data['favid'] );
	}	
	//$q=mysql_query("select connectionid from edu_courses where courseid='".$this->uri->segment(2)."'");
	//$s=mysql_fetch_array($q);
/*	$this->db->where('total_question != ',0);
	$this->db->where('heading_id',$this->uri->segment(3));
$this->db->where('user_id',$this->session->userdata('id'));
$this->db->where('connect_id',$this->session->userdata('connectid'));
$this->db->order_by('id', 'DESC');
$this->db->limit('5');
$query2=$this->db->get("e_".$this->session->userdata('connectid')."_edu_result");
$data['totattmpt']=$query2->result();*/
	
$this->data['totattmpt']=array();	
$query2=$this->db->query("select * from e_".$this->session->data['campusid']."_edu_result_descripting where topic_id='".$_GET['headingid']."' and user_id='".$this->session->data['userid']."' and total_question!='0'  order by id DESC limit 0,5");			
$totattmpt=$query2->rows;	
	//echo '<pre>';
	//print_r($totattmpt);
	foreach ($totattmpt as $tot){	
	$this->data['totattmpt'][]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'total_question' => $tot['total_question'],
            'correct_question' => $tot['correct_question'],
            'worng_question' => $tot['worng_question'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);
				
	}
	$this->id       = 'content';
		$this->template = 'klaspad/descripting.php';
		$this->render();			
	//$this->load->view('exercisedashboard/fill_in_the_blank',$data);
	}else if($heading_data['exerciestype']=='Fill in the blanks'){
	//echo "select ee.*,ea.id as favid from e_".$this->session->data['campusid']."_edu_excercises_fillintheblanks as ee left join e_".$this->session->data['campusid']."_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$heading_data['id']."' ";	
	$query1=$this->db->query("select ee.*,ea.id as favid from e_".$this->session->data['campusid']."_edu_excercises_fillintheblanks as ee left join e_".$this->session->data['campusid']."_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$heading_data['id']."' and ee.resourceid='".$_GET['resourceid']."' ");		
	$exe_dataaa=$query1->rows;
	//echo '<pre>';
	//print_r($exe_data);
	foreach($exe_dataaa as $exe_data){
	$this->data['exe_dataa'][]=array('id' => $exe_data['id'],
            'topic_id' => $exe_data['topic_id'],
            'excercisename' => $exe_data['excercisename'],
            'exerciestype' => $exe_data['exerciestype'],
            'wordssentence' => $exe_data['wordssentence'],
            'answere' => $exe_data['answere'],
            'question' => $exe_data['question'],
            'checksentence' => $exe_data['checksentence'],
            'uploadimage' => $exe_data['uploadimage'],
            'topic_id_id' => $exe_data['topic_id_id'],
            'upload_folder' => $exe_data['upload_folder'],
            'conversationtopic' => $exe_data['conversationtopic'],
            'description' => $exe_data['description'],
			'learningoutcomes' => $exe_data['learningoutcomes'],
            'notice' => $exe_data['notice'],
            'excercises_video' => $exe_data['excercises_video'],
            'excercises_audio' => $exe_data['excercises_audio'],
            'modified_date' => $exe_data['modified_date'],
            'excercises_youtube' => $exe_data['excercises_youtube'],
            'video_icon' => $exe_data['video_icon'],
            'rssfeedlink' => $exe_data['rssfeedlink'],
            'excercises_embed' => $exe_data['excercises_embed'],
            'favid' =>$exe_data['favid'] );
	}	
	//$q=mysql_query("select connectionid from edu_courses where courseid='".$this->uri->segment(2)."'");
	//$s=mysql_fetch_array($q);
/*	$this->db->where('total_question != ',0);
	$this->db->where('heading_id',$this->uri->segment(3));
$this->db->where('user_id',$this->session->userdata('id'));
$this->db->where('connect_id',$this->session->userdata('connectid'));
$this->db->order_by('id', 'DESC');
$this->db->limit('5');
$query2=$this->db->get("e_".$this->session->userdata('connectid')."_edu_result");
$data['totattmpt']=$query2->result();*/
	
$this->data['totattmpt']=array();	
$query2=$this->db->query("select * from e_".$this->session->data['campusid']."_edu_result_fillintheblanks where topic_id='".$_GET['headingid']."' and user_id='".$this->session->data['userid']."' and total_question!='0'  order by id DESC limit 0,5");			
$totattmpt=$query2->rows;	
	//echo '<pre>';
	//print_r($totattmpt);
	foreach ($totattmpt as $tot){	
	$this->data['totattmpt'][]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'total_question' => $tot['total_question'],
            'correct_question' => $tot['correct_question'],
            'worng_question' => $tot['worng_question'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);
				
	}
	$this->id       = 'content';
		$this->template = 'klaspad/fill_in_the_blanks.php';
		$this->render();			
	//$this->load->view('exercisedashboard/fill_in_the_blank',$data);
	}else
	//echo $heading_data['exerciestype'];
	//die;
	if($heading_data['exerciestype']=='TrueFalse'){
	//$exe_dataa = $this->model_klaspad_klaspad->exercise_new_dataaa($heading_data['id'],$heading_data['exerciestype']);
	$query1=$this->db->query("select ee.*,ea.id as favid from e_".$this->session->data['campusid']."_edu_excercises_truefalse as ee left join e_".$this->session->data['campusid']."_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$heading_data['id']."' and ee.resourceid='".$_GET['resourceid']."' ");		
	$exe_dataaa=$query1->rows;
	//echo '<pre>';
	//print_r($exe_data);
	foreach($exe_dataaa as $exe_data){
	$this->data['exe_dataa'][]=array('id' => $exe_data['id'],
            'topic_id' => $exe_data['topic_id'],
            'excercisename' => $exe_data['excercisename'],
            'exerciestype' => $exe_data['exerciestype'],
            'wordssentence' => $exe_data['wordssentence'],
            'answere' => $exe_data['answere'],
            'question' => $exe_data['question'],
            'checksentence' => $exe_data['checksentence'],
            'uploadimage' => $exe_data['uploadimage'],
            'topic_id_id' => $exe_data['topic_id_id'],
            'upload_folder' => $exe_data['upload_folder'],
            'conversationtopic' => $exe_data['conversationtopic'],
            'description' => $exe_data['description'],
			'learningoutcomes' => $exe_data['learningoutcomes'],
            'notice' => $exe_data['notice'],
            'excercises_video' => $exe_data['excercises_video'],
            'excercises_audio' => $exe_data['excercises_audio'],
            'modified_date' => $exe_data['modified_date'],
            'excercises_youtube' => $exe_data['excercises_youtube'],
            'video_icon' => $exe_data['video_icon'],
            'rssfeedlink' => $exe_data['rssfeedlink'],
            'excercises_embed' => $exe_data['excercises_embed'],
            'favid' =>$exe_data['favid'] );
	}	
	//$q=mysql_query("select connectionid from edu_courses where courseid='".$this->uri->segment(2)."'");
	//$s=mysql_fetch_array($q);
/*	$this->db->where('total_question != ',0);
	$this->db->where('heading_id',$this->uri->segment(3));
$this->db->where('user_id',$this->session->userdata('id'));
$this->db->where('connect_id',$this->session->userdata('connectid'));
$this->db->order_by('id', 'DESC');
$this->db->limit('5');
$query2=$this->db->get("e_".$this->session->userdata('connectid')."_edu_result");
$data['totattmpt']=$query2->result();*/
	
$this->data['totattmpt']=array();	
$query2=$this->db->query("select * from e_".$this->session->data['campusid']."_edu_result_truefalse where topic_id='".$_GET['headingid']."' and user_id='".$this->session->data['userid']."' and total_question!='0'  order by id DESC limit 0,5");			
$totattmpt=$query2->rows;	
	//echo '<pre>';
	//print_r($totattmpt);
	foreach ($totattmpt as $tot){	
	$this->data['totattmpt'][]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'total_question' => $tot['total_question'],
            'correct_question' => $tot['correct_question'],
            'worng_question' => $tot['worng_question'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);
				
	}
	$this->id       = 'content';
		$this->template = 'klaspad/truefalse.php';
		$this->render();			
		
				
	//$this->load->view('exercisedashboard/multiple_choice_questions',$data);
	}elseif($heading_data['exerciestype']=='Multiple choice questions'){
	//$exe_dataa = $this->model_klaspad_klaspad->exercise_new_dataaa($heading_data['id'],$heading_data['exerciestype']);
	$query1=$this->db->query("select ee.*,ea.id as favid from e_".$this->session->data['campusid']."_edu_excercises_multiplechoice as ee left join e_".$this->session->data['campusid']."_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$heading_data['id']."' and ee.resourceid='".$_GET['resourceid']."' ");		
	$exe_dataaa=$query1->rows;
	//echo '<pre>';
	//print_r($exe_data);
	foreach($exe_dataaa as $exe_data){
	$this->data['exe_dataa'][]=array('id' => $exe_data['id'],
            'topic_id' => $exe_data['topic_id'],
            'excercisename' => $exe_data['excercisename'],
            'exerciestype' => $exe_data['exerciestype'],
            'wordssentence' => $exe_data['wordssentence'],
            'answere' => $exe_data['answere'],
            'question' => $exe_data['question'],
            'checksentence' => $exe_data['checksentence'],
            'uploadimage' => $exe_data['uploadimage'],
            'topic_id_id' => $exe_data['topic_id_id'],
            'upload_folder' => $exe_data['upload_folder'],
            'conversationtopic' => $exe_data['conversationtopic'],
            'description' => $exe_data['description'],
			'learningoutcomes' => $exe_data['learningoutcomes'],
            'notice' => $exe_data['notice'],
            'excercises_video' => $exe_data['excercises_video'],
            'excercises_audio' => $exe_data['excercises_audio'],
            'modified_date' => $exe_data['modified_date'],
            'excercises_youtube' => $exe_data['excercises_youtube'],
            'video_icon' => $exe_data['video_icon'],
            'rssfeedlink' => $exe_data['rssfeedlink'],
            'excercises_embed' => $exe_data['excercises_embed'],
            'favid' =>$exe_data['favid'] );
	}	
	//$q=mysql_query("select connectionid from edu_courses where courseid='".$this->uri->segment(2)."'");
	//$s=mysql_fetch_array($q);
/*	$this->db->where('total_question != ',0);
	$this->db->where('heading_id',$this->uri->segment(3));
$this->db->where('user_id',$this->session->userdata('id'));
$this->db->where('connect_id',$this->session->userdata('connectid'));
$this->db->order_by('id', 'DESC');
$this->db->limit('5');
$query2=$this->db->get("e_".$this->session->userdata('connectid')."_edu_result");
$data['totattmpt']=$query2->result();*/
	
$this->data['totattmpt']=array();	
$query2=$this->db->query("select * from e_".$this->session->data['campusid']."_edu_result where topic_id='".$_GET['headingid']."' and user_id='".$this->session->data['userid']."' and total_question!='0'  order by id DESC limit 0,5");			
$totattmpt=$query2->rows;	
	//echo '<pre>';
	//print_r($totattmpt);
	foreach ($totattmpt as $tot){	
	$this->data['totattmpt'][]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'total_question' => $tot['total_question'],
            'correct_question' => $tot['correct_question'],
            'worng_question' => $tot['worng_question'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);
				
	}
	$this->id       = 'content';
		$this->template = 'klaspad/multiple_choice_questions.php';
		$this->render();			
		
				
	//$this->load->view('exercisedashboard/multiple_choice_questions',$data);
	}elseif($heading_data['exerciestype']=='Introduction'){		
	$this->load->view('exercisedashboard/introduction',$data);
	}elseif($heading_data['exerciestype']=='Crosswords'){
		
		
	$q=mysql_query("select connectionid from edu_courses where courseid='".$_GET['courseid']."'");
	$s=mysql_fetch_array($q);	
	$id=$_GET['headingid'];
	$q=mysql_query("select * from e_".$this->session->data['campusid']."_edu_headings where id='".$id."'");	
	$heading_data=mysql_fetch_array($q);
	//echo '<pre>';
	//print_r($data['heading_data']);
	
	
	//$data['exe_data'] = $this->welcomemodel->exercise_new_data($data['heading_data']->id,$data['heading_data']->exerciestype);
	$q1=$this->db->query("select ee.*,ea.id as favid from e_".$this->session->data['campusid']."_edu_excercises_crossword as ee left join e_".$this->session->data['campusid']."_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$heading_data['id']."' and ee.resourceid='".$_GET['resourceid']."'");
	$exe_data=$q1->rows;		
	
foreach($exe_data as $exedata){
$ans=array();
$Que=array();
$hnt=array();
$this->data['alldata']=array();
//echo "select * from e_".$this->session->data['campusid']."_edu_answere_crossword where crossword_id='".$exedata['id']."'";
$q2=$this->db->query("select * from e_".$this->session->data['campusid']."_edu_answere_crossword where crossword_id='".$exedata['id']."'");		
$dat=$q2->row;
//echo '<pre>';
//print_r($dat);
$ans=unserialize($dat['answere']);
//print_r($ans);
$Que=unserialize($dat['question']);
//print_r($Que);
$hnt=unserialize($dat['hint']);
//print_r($hnt);
$this->data['alldata'][]=array('id'=>$dat['id'],
			 'crossword_id'=>$dat['crossword_id'],
			 'answere'=>$ans,
			 'question'=>$Que,
			 'total_count'=>$dat['total_count'],
			 'hint'=>$hnt);
	}
//echo "select * from e_".$this->session->data['campusid']."_edu_result_crossword where topic_id='".$_GET['headingid']."' and user_id='".$this->session->data['userid']."'  order by id DESC limit 0,5";
$this->data['totattmpt']=array();	
$query2=$this->db->query("select * from e_".$this->session->data['campusid']."_edu_result_crossword where topic_id='".$_GET['headingid']."' and user_id='".$this->session->data['userid']."'  order by id DESC limit 0,5");			
$totattmpt=$query2->rows;	
	//echo '<pre>';
	//print_r($totattmpt);
	foreach ($totattmpt as $tot){	
	$this->data['totattmpt'][]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'result' => $tot['result'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);
				
	}
	$this->id       = 'content';
		$this->template = 'klaspad/crosswords.php';
		$this->render();			
	//$this->load->view('exercisedashboard/crosswords',$data);
	}elseif($heading_data['exerciestype']=='Powerpoint presentation exercise'){
	//echo "select id, rssfeedlink from e_".$this->session->data['campusid']."_edu_excercises where topic_id='".$_GET['headingid']."'";
	$qd=mysql_query("select id, rssfeedlink from e_".$this->session->data['campusid']."_edu_excercises where topic_id='".$_GET['headingid']."'");
	$sqd=mysql_fetch_array($qd);
	//echo $csqd=mysql_num_rows($qd);
	//echo $sqd['id'].' xcvx';
	$this->data['reference']=@$sqd['rssfeedlink'];
	//echo "select * from e_".$this->session->data['campusid']."_edu_excercises_discussion where resourceid='".$sqd['id']."' ";
	$query1=$this->db->query("select * from e_".$this->session->data['campusid']."_edu_excercises_discussion where resourceid='".$sqd['id']."' ");	
$disc=$query1->rows;
$this->data['discussion']=array();	
foreach($disc as $dis){
$que=$this->db->query("select ea.assignment, ea.connectionid, ea.user_id from e_".$this->session->data['campusid']."_edu_ans_assignment ea where assignment_id='".$dis['id']."' order by ea.id desc ");		
$mmk = $que->rows;	
$url1=array();
foreach($mmk as $mmkk){
$msq=mysql_query("select eu.user_image, eu.demo_contact_person from e_".$this->session->data['campusid']."_edu_user as eu where eu.id='".$mmkk['user_id']."'");	
$mmk1=mysql_fetch_array($msq);
$url1[] =array('comment' => $mmkk['assignment'], 
            'username' => $mmk1['demo_contact_person'],
			'image' => $mmk1['user_image']);
}
	

$this->data['discussion'][]=array('id' => $dis['id'], 
			'resid' => $dis['resourceid'],
            'topic' => $dis['question'],
			'comment'=>$url1);
}		
$query2=$this->db->query("select * from e_".$this->session->data['campusid']."_edu_notes where courseid='".$sqd['id']."' and userid='".$this->session->data['userid']."'");	
$not=$query2->rows;
$this->data['notes']=array();	
foreach($not as $no){


$this->data['notes'][]=array('id' => $no['id'], 
			'resid' => $no['courseid'],
            'userid' => $no['userid'],
			'msg'=>$no['msg']);
}
//echo "select * from e_".$this->session->data['campusid']."_edu_excercises_assignment where resourceid='".$sqd['id']."'";
$query3=$this->db->query("select * from e_".$this->session->data['campusid']."_edu_excercises_assignment where resourceid='".$sqd['id']."' order by id asc");	
$assign=$query3->rows;
$this->data['assignment']=array();	
foreach($assign as $ass){
$this->data['assignment'][]=array('id' => $ass['id'], 
			'resid' => $ass['resourceid'],
            'topic' => $ass['answere']);
}
//echo "select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_crossword as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."'";
$query4=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_crossword as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."'");	
$crswrd=$query4->rows;
$this->data['crossword']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd as $ass1){
$this->data['crossword'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}

$query5=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_multiplechoice as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$crswrd1=$query5->rows;
$this->data['multiple']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd1 as $ass1){
$this->data['multiple'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}


$query6=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_fillintheblanks as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$crswrd2=$query6->rows;
$this->data['fill']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd2 as $ass1){
$this->data['fill'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query7=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_descripting as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$descriptingg=$query7->rows;
$this->data['descripting']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($descriptingg as $ass1){
$this->data['descripting'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}			

$query8=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_truefalse as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$tf=$query8->rows;
$this->data['truefalse']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($tf as $ass1){
$this->data['truefalse'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}

$query9=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_draganddrop as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$dd=$query9->rows;
$this->data['draganddrop']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($dd as $ass1){
$this->data['draganddrop'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}				
//$data=array('discussion'=>@$discussion);		
	$this->id       = 'content';
		$this->template = 'klaspad/powerpoint_exercise.php';
		$this->render();			
	//$this->load->view('exercisedashboard/powerpoint_exercise',$data);
	}else/*if($heading_data['exerciestype']=='Add Folder'){		
	$this->load->view('exercisedashboard/add_show_folder',$data);
	}else*/if($heading_data['exerciestype']=='Files'){
	$qd=mysql_query("select id, rssfeedlink from e_".$this->session->data['campusid']."_edu_excercises where topic_id='".$_GET['headingid']."'");
	$sqd=mysql_fetch_array($qd);
	$this->data['reference']=@$sqd['rssfeedlink'];	
	$query1= $this->db->query("select * from e_".$this->session->data['campusid']."_edu_excercises_discussion where resourceid='".$sqd['id']."' ");		
$disc=$query1->rows;
$this->data['discussion']=array();	
foreach($disc as $dis){
$que=$this->db->query("select ea.assignment, ea.connectionid, ea.user_id from e_".$this->session->data['campusid']."_edu_ans_assignment ea where assignment_id='".$dis['id']."' order by ea.id desc ");		
$mmk = $que->rows;	
$url1=array();
foreach($mmk as $mmkk){
$msq=mysql_query("select eu.user_image, eu.demo_contact_person from e_".$this->session->data['campusid']."_edu_user as eu where eu.id='".$mmkk['user_id']."'");	
$mmk1=mysql_fetch_array($msq);
$url1[] =array('comment' => $mmkk['assignment'], 
            'username' => $mmk1['demo_contact_person'],
			'image' => $mmk1['user_image']);
}
	

$this->data['discussion'][]=array('id' => $dis['id'], 
			'resid' => $dis['resourceid'],
            'topic' => $dis['question'],
			'comment'=>$url1);
}		
$query2=$this->db->query("select * from e_".$this->session->data['campusid']."_edu_notes where courseid='".$sqd['id']."' and userid='".$this->session->data['userid']."'");	
$not=$query2->rows;
$this->data['notes']=array();	
foreach($not as $no){


$this->data['notes'][]=array('id' => $no['id'], 
			'resid' => $no['courseid'],
            'userid' => $no['userid'],
			'msg'=>$no['msg']);
}

$query3=$this->db->query("select * from e_".$this->session->data['campusid']."_edu_excercises_assignment where resourceid='".$sqd['id']."' order by id asc");	
$assign=$query3->rows;
$this->data['assignment']=array();	
foreach($assign as $ass){
$this->data['assignment'][]=array('id' => $ass['id'], 
			'resid' => $ass['resourceid'],
            'topic' => $ass['answere']);
}
//echo "select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_crossword as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."'";
$query4=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_crossword as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."'");	
$crswrd=$query4->rows;
$this->data['crossword']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd as $ass1){
$this->data['crossword'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query5=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_multiplechoice as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$crswrd1=$query5->rows;
$this->data['multiple']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd1 as $ass1){
$this->data['multiple'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query6=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_fillintheblanks as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$crswrd2=$query6->rows;
$this->data['fill']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd2 as $ass1){
$this->data['fill'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query7=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_descripting as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$descriptingg=$query7->rows;
$this->data['descripting']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($descriptingg as $ass1){
$this->data['descripting'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}	
$query8=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_truefalse as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$tf=$query8->rows;
$this->data['truefalse']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($tf as $ass1){
$this->data['truefalse'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}	
$query9=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_draganddrop as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$dd=$query9->rows;
$this->data['draganddrop']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($dd as $ass1){
$this->data['draganddrop'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}								
//$data=array('discussion'=>@$discussion);		
	$this->id       = 'content';
		$this->template = 'klaspad/add_show_files.php';
		$this->render();
	//$this->load->view('exercisedashboard/add_show_files',$data);
	}else/*if($data['heading_data']->exerciestype=='Add rating scale'){
	$data['ratingdata']=$this->welcomemodel->add_front_rating_scale();
	$this->load->view('exercisedashboard/add_rating_scale',$data);
	}else*/if($heading_data['exerciestype']=='Add Video'){
	
	$qd=mysql_query("select id,rssfeedlink from e_".$this->session->data['campusid']."_edu_excercises where topic_id='".$_GET['headingid']."'");
	$sqd=mysql_fetch_array($qd);
	$this->data['reference']=@$sqd['rssfeedlink'];		
$query1= $this->db->query("select * from e_".$this->session->data['campusid']."_edu_excercises_discussion where resourceid='".$sqd['id']."' ");		
$disc=$query1->rows;
$this->data['discussion']=array();	
foreach($disc as $dis){
$que=$this->db->query("select ea.assignment, ea.connectionid, ea.user_id from e_".$this->session->data['campusid']."_edu_ans_assignment ea where assignment_id='".$dis['id']."' order by ea.id desc ");		
$mmk = $que->rows;	
$url1=array();
foreach($mmk as $mmkk){
$msq=mysql_query("select eu.user_image, eu.demo_contact_person from e_".$this->session->data['campusid']."_edu_user as eu where eu.id='".$mmkk['user_id']."'");	
$mmk1=mysql_fetch_array($msq);
$url1[] =array('comment' => $mmkk['assignment'], 
            'username' => $mmk1['demo_contact_person'],
			'image' => $mmk1['user_image']);
}
	

$this->data['discussion'][]=array('id' => $dis['id'], 
			'resid' => $dis['resourceid'],
            'topic' => $dis['question'],
			'comment'=>$url1);
}		
$query2=$this->db->query("select * from e_".$this->session->data['campusid']."_edu_notes where courseid='".$sqd['id']."' and userid='".$this->session->data['userid']."'");	
$not=$query2->rows;
$this->data['notes']=array();	
foreach($not as $no){


$this->data['notes'][]=array('id' => $no['id'], 
			'resid' => $no['courseid'],
            'userid' => $no['userid'],
			'msg'=>$no['msg']);
}

$query3=$this->db->query("select * from e_".$this->session->data['campusid']."_edu_excercises_assignment where resourceid='".$sqd['id']."' order by id asc");	
$assign=$query3->rows;
$this->data['assignment']=array();	
foreach($assign as $ass){
$this->data['assignment'][]=array('id' => $ass['id'], 
			'resid' => $ass['resourceid'],
            'topic' => $ass['answere']);
}
//echo "select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_crossword as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."'";
$query4=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_crossword as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."'");	
$crswrd=$query4->rows;
$this->data['crossword']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd as $ass1){
$this->data['crossword'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}	
$query5=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_multiplechoice as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."'");	
$crswrd1=$query5->rows;
$this->data['multiple']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd1 as $ass1){
$this->data['multiple'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
//echo "select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_fillintheblanks as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id";
$query6=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_fillintheblanks as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$crswrd2=$query6->rows;
$this->data['fill']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd2 as $ass1){
$this->data['fill'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
//echo "select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_descripting as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.topic_id where c.resourceid='".$sqd['id']."' and h.exerciestype='Descripting' group by c.topic_id";
$query7=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_descripting as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' and h.exerciestype='Descripting' group by c.topic_id");	
$descriptingg=$query7->rows;
$this->data['descripting']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($descriptingg as $ass1){
$this->data['descripting'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}	
$query8=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_truefalse as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$tf=$query8->rows;
$this->data['truefalse']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($tf as $ass1){
$this->data['truefalse'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query9=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_draganddrop as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$dd=$query9->rows;
$this->data['draganddrop']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($dd as $ass1){
$this->data['draganddrop'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}					
//$data=array('discussion'=>@$discussion);		
	$this->id       = 'content';
		$this->template = 'klaspad/add_video.php';
		$this->render();
	//$this->load->view('exercisedashboard/add_video',$data);
	}elseif($heading_data['exerciestype']=='Add Audio'){
	
	
	$qd=mysql_query("select id,rssfeedlink from e_".$this->session->data['campusid']."_edu_excercises where topic_id='".$_GET['headingid']."'");
	$sqd=mysql_fetch_array($qd);
	$this->data['reference']=@$sqd['rssfeedlink'];		
$query1= $this->db->query("select * from e_".$this->session->data['campusid']."_edu_excercises_discussion where resourceid='".$sqd['id']."' ");		
$disc=$query1->rows;
$this->data['discussion']=array();	
foreach($disc as $dis){
$que=$this->db->query("select ea.assignment, ea.connectionid, ea.user_id from e_".$this->session->data['campusid']."_edu_ans_assignment ea where assignment_id='".$dis['id']."' order by ea.id desc ");		
$mmk = $que->rows;	
$url1=array();
foreach($mmk as $mmkk){
$msq=mysql_query("select eu.user_image, eu.demo_contact_person from e_".$this->session->data['campusid']."_edu_user as eu where eu.id='".$mmkk['user_id']."'");	
$mmk1=mysql_fetch_array($msq);
$url1[] =array('comment' => $mmkk['assignment'], 
            'username' => $mmk1['demo_contact_person'],
			'image' => $mmk1['user_image']);
}
	

$this->data['discussion'][]=array('id' => $dis['id'], 
			'resid' => $dis['resourceid'],
            'topic' => $dis['question'],
			'comment'=>$url1);
}		
$query2=$this->db->query("select * from e_".$this->session->data['campusid']."_edu_notes where courseid='".$sqd['id']."' and userid='".$this->session->data['userid']."'");	
$not=$query2->rows;
$this->data['notes']=array();	
foreach($not as $no){


$this->data['notes'][]=array('id' => $no['id'], 
			'resid' => $no['courseid'],
            'userid' => $no['userid'],
			'msg'=>$no['msg']);
}

$query3=$this->db->query("select * from e_".$this->session->data['campusid']."_edu_excercises_assignment where resourceid='".$sqd['id']."' order by id asc");	
$assign=$query3->rows;
$this->data['assignment']=array();	
foreach($assign as $ass){
$this->data['assignment'][]=array('id' => $ass['id'], 
			'resid' => $ass['resourceid'],
            'topic' => $ass['answere']);
}
//echo "select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_crossword as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."'";
$query4=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_crossword as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."'");	
$crswrd=$query4->rows;
$this->data['crossword']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd as $ass1){
$this->data['crossword'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query5=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_multiplechoice as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."'");	
$crswrd1=$query5->rows;
$this->data['multiple']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd1 as $ass1){
$this->data['multiple'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query6=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_fillintheblanks as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$crswrd2=$query6->rows;
$this->data['fill']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd2 as $ass1){
$this->data['fill'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query7=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_descripting as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$descriptingg=$query7->rows;
$this->data['descripting']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($descriptingg as $ass1){
$this->data['descripting'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}	
$query8=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_truefalse as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$tf=$query8->rows;
$this->data['truefalse']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($tf as $ass1){
$this->data['truefalse'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query9=$this->db->query("select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_draganddrop as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$dd=$query9->rows;
$this->data['draganddrop']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($dd as $ass1){
$this->data['draganddrop'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}									
//$data=array('discussion'=>@$discussion);		
	$this->id       = 'content';
		$this->template = 'klaspad/add_audio.php';
		$this->render();
	//$this->load->view('exercisedashboard/add_video',$data);
				
	//$this->load->view('exercisedashboard/add_audio',$data);
	}else/*if($data['heading_data']->exerciestype=='Add matrix'){
	$data['ratingdata']=$this->welcomemodel->add_front_rating_scale();
	$this->load->view('exercisedashboard/add_rating_scale',$data);
	}elseif($data['heading_data']->exerciestype=='Add multiple selection'){
	$data['ratingdata']=$this->welcomemodel->add_multiple_selection();
	$this->load->view('exercisedashboard/add_multiple_selection',$data);
	}else*/if($heading_data['exerciestype']=='Add assignment'){
	$this->id       = 'content';
		$this->template = 'klaspad/add_assignment.php';
		$this->render();
	//$this->load->view('exercisedashboard/add_assignment',$data);
	}
	}else {
		if($intro_topics['exerciestype']=='Introduction'){
	   $this->load->view('exercisedashboard/introduction',$data);
		}else{
			$this->data['module']=array();				
	$module_course_wise=$this->model_klaspad_klaspad->module_course_wiseee($_GET['courseid']);
	//echo '<pre>';
	//print_r(${'module'.$course['id']});
	foreach($module_course_wise as $result)
				{
				   $this->data['module_course_wise'][]=array(
					'id'=>$result['id'],
					'modulename' => $result['modulename'],
					'moduletype' => $result['moduletype'],
					'lti_id' => $result['lti_id']
					);
				}	
		$this->id       = 'content';
		$this->template = 'klaspad/module_activity.php';
		$this->render();		
		//$this->load->view('exercisedashboard/module_activity',$data);	
		}
		}
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
public function lti_desc(){
$this->id       = 'content';
		$this->template = 'klaspad/lti_desc.php';
		$this->render();	
}
public function get_signable_parameters($params){
        $sorted = $params;
        ksort($sorted);

        $total = array();
        foreach ($sorted as $k => $v) {
            if ($k == 'oauth_signature') {
                continue;
            }

            $total[] = rawurlencode($k) . '=' . rawurlencode($v);
        }
        return implode('&', $total);
    }
public function sign($http_method, $url, $params, $secret) {
        $sig = array(
            strtoupper($http_method),
            preg_replace('/%7E/', '~', rawurlencode($url)),
            rawurlencode($this->get_signable_parameters($params)),
        );
        $base_string = implode('&', $sig);
        $sig = base64_encode(hash_hmac('sha1', $base_string, $secret, true));
        return $sig;
    }
public function checkfrm($pst, $gt){
//echo '<pre>';
		//print_r($lqs);
		//print_r($pst);
		//print_r($gt);
		//die;
	//
	//echo "select l.secret, l.maxenrolled from local_ltiprovider l left join college as c on c.collegeid=l.consumerkey where l.moduleid='".$gt['moduleid']."' and c.collegecode='".$pst['oauth_consumer_key']."'<br />";
	//die;
		$lq11=mysql_query("select l.secret, l.maxenrolled from local_ltiprovider l left join college as c on c.collegeid=l.consumerkey where l.moduleid='".$gt['moduleid']."' and c.collegecode='".$pst['oauth_consumer_key']."'");
$lqs11=mysql_fetch_array($lq11);
//echo '<pre>';
		//print_r($lqs11);		
		$oauth_params = array();
		$oauth_params['context_id']	    = $pst['context_id'];
		$oauth_params['context_label']	    = $pst['context_label'];
		$oauth_params['context_title']	    = $pst['context_title'];
		$oauth_params['ext_lms']	    = $pst['ext_lms'];
		$oauth_params['ext_submit']	    = $pst['ext_submit'];
		$oauth_params['id']	    = $pst['id'];
		$oauth_params['launch_presentation_locale']	    = $pst['launch_presentation_locale'];
		$oauth_params['launch_presentation_return_url']	    = $pst['launch_presentation_return_url'];
		$oauth_params['lis_outcome_service_url']	    = $pst['lis_outcome_service_url'];
		$oauth_params['lis_person_contact_email_primary']	    = $pst['lis_person_contact_email_primary'];
		$oauth_params['lis_person_name_family']	    = $pst['lis_person_name_family'];
		$oauth_params['lis_person_name_full']	    = $pst['lis_person_name_full'];
		$oauth_params['lis_person_name_given']	    = $pst['lis_person_name_given'];
		$oauth_params['lis_result_sourcedid']	    = $pst['lis_result_sourcedid'];
		$oauth_params['lti_message_type']	    = $pst['lti_message_type'];
		$oauth_params['lti_version']	    = $pst['lti_version'];
		$oauth_params['oauth_callback']	    = $pst['oauth_callback'];
		$oauth_params['oauth_consumer_key']	    = $pst['oauth_consumer_key'];
		$oauth_params['oauth_nonce']	    = $pst['oauth_nonce'];
		$oauth_params['oauth_signature_method']	    = $pst['oauth_signature_method'];
		$oauth_params['oauth_timestamp']	    = $pst['oauth_timestamp'];
		$oauth_params['oauth_version']	    = $pst['oauth_version'];
		$oauth_params['resource_link_description']	    = $pst['resource_link_description'];
		$oauth_params['resource_link_id']	    = $pst['resource_link_id'];
		$oauth_params['resource_link_title']	    = $pst['resource_link_title'];
		$oauth_params['roles']	    = $pst['roles'];
		$oauth_params['tool_consumer_info_product_family_code']	    = $pst['tool_consumer_info_product_family_code'];
		$oauth_params['tool_consumer_info_version']	    = $pst['tool_consumer_info_version'];
		$oauth_params['tool_consumer_instance_guid']	    = $pst['tool_consumer_instance_guid'];
		$oauth_params['user_id']	    = $pst['user_id'];	
		$url=$pst['toolurl'];
		//echo $url;
        $oauth_signature	= $this->sign('POST', $url, $oauth_params, $lqs11['secret'].'&');
		$oauth_signature=$pst['oauth_signature'];
		//echo $oauth_signature.' / '.$pst['oauth_signature'];
		
		//echo 'Binit';
		//die;
	if($oauth_signature==$pst['oauth_signature']){
	$username=$pst['user_id'].''.$pst['lis_person_name_given'].''.$pst['lis_person_name_family'].''.$lqs11['secret'];
	$password=$pst['lis_person_contact_email_primary'];
	//echo "select * from user where username='".$username."' and password='".$password."' and blockuser='1'";
	//die;
	//echo "select * from user where username='".$username."' and password='".$password."' and blockuser='1'";	
	//echo "select * from user where username='".$username."' and password='".$password."' and secret='".$lqs['secret']."' and blockuser='1'<br />";
	$q=mysql_query("select * from user where username='".$username."' and password='".$password."' and secret='".$lqs11['secret']."' and blockuser='1'");
	$cnt=mysql_num_rows($q);
	if($cnt>0){
	$s=mysql_fetch_array($q);
	mysql_query("update local_ltiprovider_user set lastaccess='".time()."' where membershipsid='".$s['externalSID']."'");
	$this->session->data['id']=session_id();
				$this->session->data['fname']=@$s['fname'];
				$this->session->data['mname']=@$s['mname'];
				$this->session->data['sname']=@$s['sname'];
				$this->session->data['userid']=@$s['userid'];
				$this->session->data[DB_DATABASE.'id']=@$s['userid'];
               	$this->session->data['user_id']=@$s['userid'];
				//$this->session->data['username']=@$s['username'];
				//$this->session->data['password']=@$s['password'];
                $this->session->data['sflag']=@$s['flag'];
                $this->session->data['externalSID']=@$s['externalSID'];
				$this->session->data['campusid']='10';	
				$this->session->data['usraccesstype']='external';
				$this->session->data['UserType']=$pst['usertype'];
				//echo $this->session->data['usraccesstype'];
				//die;
						
	}else{
		//echo '<pre>';
		//print_r($lqs);
		//echo "select * from local_ltiprovider_user where consumersecret='".$lqs11['secret']."' and consumerkey='".$pst['oauth_consumer_key']."'<br />";
	$ucq=mysql_query("select * from local_ltiprovider_user where consumersecret='".$lqs11['secret']."' and consumerkey='".$pst['oauth_consumer_key']."'");	
	$ttcnt=mysql_num_rows($ucq);
	//echo $ttcnt.'/'.$lqs11['maxenrolled'].'<br />';
	//die;
	if($ttcnt<$lqs11['maxenrolled']){	
	$jj=mysql_query("select max(externalSID) as externalSID from user");
	$kk=mysql_fetch_array($jj);
	$externalSID=$kk['externalSID']+1;
	//echo "insert into user set username='".$username."', password='".$password."', blockuser='1', flag='1', fname='".$pst['lis_person_name_given']."', sname='".$pst['lis_person_name_family']."', externalSID='".$externalSID."'";
	//die;	
	mysql_query("insert into user set username='".$username."', password='".$password."', blockuser='1', flag='1', fname='".$pst['lis_person_name_given']."', sname='".$pst['lis_person_name_family']."', secret='".$lqs11['secret']."', externalSID='".$externalSID."'");
	$uid=mysql_insert_id();
	mysql_query("insert into local_ltiprovider_user set userid='".$uid."', toolid='3', serviceurl='".$pst['lis_outcome_service_url']."', sourceid='".$pst['lis_result_sourcedid']."', consumerkey='".$pst['oauth_consumer_key']."', consumersecret='".$lqs11['secret']."', lastgrade='0', lastsync='0', lastaccess='".time()."', membershipsurl='', membershipsid='".$externalSID."'");
	$this->session->data['id']=session_id();
				$this->session->data['fname']=@$pst['lis_person_name_given'];
				$this->session->data['mname']='';
				$this->session->data['sname']=@$pst['lis_person_name_family'];
				$this->session->data['userid']=@$uid;
				$this->session->data[DB_DATABASE.'id']=@$uid;
               	$this->session->data['user_id']=@$uid;
				//$this->session->data['username']=@$username;
				//$this->session->data['password']=@$password;
                $this->session->data['sflag']=1;
                $this->session->data['externalSID']=@$externalSID;
				$this->session->data['campusid']='10';
				$this->session->data['usraccesstype']='external';
				$this->session->data['UserType']=$pst['usertype'];
	}else{
	echo 'User Limit Exceeds, please contact your Admin.';	
	exit;	
	}
	}
	//die;
	//echo $gt['route'].'&moduleid='.$gt['moduleid'].'&ret=1&coursename='.$pst['coursename'].'&modulename='.$pst['modulename'];
	//die;
	$this->redirect($this->url->https($gt['route'].'&moduleid='.$gt['moduleid'].'&role=internal&ret=1&coursename='.$pst['coursename'].'&modulename='.$pst['modulename'].'&courseid='.$gt['courseid']));	
	}else{
	echo 'Mismatch Signature';	
	}
		
			
}
	
public function module_activity_lti()
	{
		if($_GET['ret']==''){
			$this->checkfrm($_POST, $_GET);
		}
		//echo $this->session->data['userid'];
		//echo $this->session->data['UserType'].'xcv';
		//die;
		$this->load->model('klaspad/klaspad');
	//if(isset($this->session->data['userid'])){
	$module_data=$this->model_klaspad_klaspad->module_data1();
	$this->data['course_id']=$module_data['course_id'];
	$this->data['moduledescription']=$module_data['description'];
	$this->data['modulelearningoutcomes']=$module_data['learningoutcomes'];
	$all_exe=$this->model_klaspad_klaspad->list_module1();
	$intro_topics=$this->model_klaspad_klaspad->intro_topics1();
	$this->data['introvideo']=$intro_topics['introvideo'];
	$this->data['description']=$intro_topics['description'];
	$this->data['learningoutcomes']=$intro_topics['learningoutcomes'];
	foreach($all_exe as $all_exe){
	${'exe_'.$all_exe['id']}=$this->model_klaspad_klaspad->exercise_data1($all_exe['id']);
	$exe_type[$all_exe['id']]=${'exe_'.$all_exe['id']}[1];
    }
	if(@$_GET['headingid']){
	$heading_data=$this->model_klaspad_klaspad->heading_data1();
	$this->data['headingname']=$heading_data['headingname'];
	//echo '<pre>';
	//print_r($heading_data);
	$exe_dataa = $this->model_klaspad_klaspad->exercise_new_data1($heading_data['id'],$heading_data['exerciestype']);
	//echo '<pre>';
	//print_r($exe_data);
	foreach($exe_dataa as $exe_data){
	$this->data['exe_data'][]=array('id' => $exe_data['id'],
            'topic_id' => $exe_data['topic_id'],
            'excercisename' => $exe_data['excercisename'],
            'exerciestype' => $exe_data['exerciestype'],
            'wordssentence' => $exe_data['wordssentence'],
            'answere' => $exe_data['answere'],
            'question' => $exe_data['question'],
            'checksentence' => $exe_data['checksentence'],
            'uploadimage' => $exe_data['uploadimage'],
            'topic_id_id' => $exe_data['topic_id_id'],
            'upload_folder' => $exe_data['upload_folder'],
            'conversationtopic' => $exe_data['conversationtopic'],
            'description' => $exe_data['description'],
			'learningoutcomes' => $exe_data['learningoutcomes'],
            'notice' => $exe_data['notice'],
            'excercises_video' => $exe_data['excercises_video'],
            'excercises_audio' => $exe_data['excercises_audio'],
            'modified_date' => $exe_data['modified_date'],
            'excercises_youtube' => $exe_data['excercises_youtube'],
            'video_icon' => $exe_data['video_icon'],
            'rssfeedlink' => $exe_data['rssfeedlink'],
            'excercises_embed' => $exe_data['excercises_embed'],
            'favid' =>$exe_data['favid'] );
	}
	if($heading_data['exerciestype']=='Write in the correct box'){
		$this->data['blockdata'] = array();	
	$blockdata=$this->model_klaspad_klaspad->blocks_front_list111($heading_data['id']);
			
	
	foreach($blockdata as $res)
				{
					$this->data['blockdata'][]=array(
					'id'=>$res['id'],
					'nameofthemyblocks' => $res['nameofthemyblocks'],
					'exercise_id' => $res['exercise_id'],
					'myblocks' => $res['myblocks'],
					'myblock_question' => $res['myblock_question']
					);
									}
									
	$this->data['totattmpt']=array();	
$query2=$this->db->query("select * from e_10_edu_result_draganddrop where topic_id='".$_GET['headingid']."' and user_id='".$this->session->data['userid']."' and total_question!='0'  order by id DESC limit 0,5");			
$totattmpt=$query2->rows;	
	//echo '<pre>';
	//print_r($totattmpt);
	foreach ($totattmpt as $tot){	
	$this->data['totattmpt'][]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'total_question' => $tot['total_question'],
            'correct_question' => $tot['correct_question'],
            'worng_question' => $tot['worng_question'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);
				
	}								

	$this->id       = 'content';
		$this->template = 'klaspad/write_in_the_correct_boxes.php';
		$this->render();								
	//$this->load->view('exercisedashboard/write_in_the_correct_box',$data);
	}else
	//echo $heading_data['exerciestype'];
	if($heading_data['exerciestype']=='Descripting'){
	//echo "select ee.*,ea.id as favid from e_".$this->session->data['campusid']."_edu_excercises_fillintheblanks as ee left join e_".$this->session->data['campusid']."_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$heading_data['id']."' ";	
	$query1=$this->db->query("select ee.*,ea.id as favid from e_10_edu_excercises_descripting as ee left join e_10_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$heading_data['id']."' and ee.resourceid='".$_GET['resourceid']."' ");		
	$exe_dataaa=$query1->rows;
	//echo '<pre>';
	//print_r($exe_data);
	foreach($exe_dataaa as $exe_data){
//$answere=array();
//echo "select * from e_".$this->session->data['campusid']."_edu_result_descripting where did='".$exe_data['id']."' and user_id='".$this->session->data['userid']."'";	
$query2=$this->db->query("select * from e_10_edu_result_descripting where did='".$exe_data['id']."' and user_id='".$this->session->data['userid']."'");			
$totattmpt=$query2->row;	
	
		
	$this->data['exe_dataa'][]=array('id' => $exe_data['id'],
            'topic_id' => $exe_data['topic_id'],
            'excercisename' => $exe_data['excercisename'],
            'exerciestype' => $exe_data['exerciestype'],
            'wordssentence' => $exe_data['wordssentence'],
            'answere' => $exe_data['answere'],
            'question' => $exe_data['question'],
            'checksentence' => $exe_data['checksentence'],
            'uploadimage' => $exe_data['uploadimage'],
            'topic_id_id' => $exe_data['topic_id_id'],
            'upload_folder' => $exe_data['upload_folder'],
            'conversationtopic' => $exe_data['conversationtopic'],
            'description' => $exe_data['description'],
			'learningoutcomes' => $exe_data['learningoutcomes'],
            'notice' => $exe_data['notice'],
            'excercises_video' => $exe_data['excercises_video'],
            'excercises_audio' => $exe_data['excercises_audio'],
            'modified_date' => $exe_data['modified_date'],
            'excercises_youtube' => $exe_data['excercises_youtube'],
            'video_icon' => $exe_data['video_icon'],
            'rssfeedlink' => $exe_data['rssfeedlink'],
            'excercises_embed' => $exe_data['excercises_embed'],
			'answere'=>$totattmpt['answere'],
			'answereid'=>$totattmpt['id'],
            'favid' =>$exe_data['favid'] );
	}	
	//$q=mysql_query("select connectionid from edu_courses where courseid='".$this->uri->segment(2)."'");
	//$s=mysql_fetch_array($q);
/*	$this->db->where('total_question != ',0);
	$this->db->where('heading_id',$this->uri->segment(3));
$this->db->where('user_id',$this->session->userdata('id'));
$this->db->where('connect_id',$this->session->userdata('connectid'));
$this->db->order_by('id', 'DESC');
$this->db->limit('5');
$query2=$this->db->get("e_".$this->session->userdata('connectid')."_edu_result");
$data['totattmpt']=$query2->result();*/
	
$this->data['totattmpt']=array();	
$query2=$this->db->query("select * from e_10_edu_result_descripting where topic_id='".$_GET['headingid']."' and user_id='".$this->session->data['userid']."' and total_question!='0'  order by id DESC limit 0,5");			
$totattmpt=$query2->rows;	
	//echo '<pre>';
	//print_r($totattmpt);
	foreach ($totattmpt as $tot){	
	$this->data['totattmpt'][]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'total_question' => $tot['total_question'],
            'correct_question' => $tot['correct_question'],

            'worng_question' => $tot['worng_question'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);
				
	}
	$this->id       = 'content';
		$this->template = 'klaspad/descripting.php';
		$this->render();			
	//$this->load->view('exercisedashboard/fill_in_the_blank',$data);
	}else if($heading_data['exerciestype']=='Fill in the blanks'){
	//echo "select ee.*,ea.id as favid from e_".$this->session->data['campusid']."_edu_excercises_fillintheblanks as ee left join e_".$this->session->data['campusid']."_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$heading_data['id']."' ";	
	$query1=$this->db->query("select ee.*,ea.id as favid from e_10_edu_excercises_fillintheblanks as ee left join e_10_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$heading_data['id']."' and ee.resourceid='".$_GET['resourceid']."' ");		
	$exe_dataaa=$query1->rows;
	//echo '<pre>';
	//print_r($exe_data);
	foreach($exe_dataaa as $exe_data){
	$this->data['exe_dataa'][]=array('id' => $exe_data['id'],
            'topic_id' => $exe_data['topic_id'],
            'excercisename' => $exe_data['excercisename'],
            'exerciestype' => $exe_data['exerciestype'],
            'wordssentence' => $exe_data['wordssentence'],
            'answere' => $exe_data['answere'],
            'question' => $exe_data['question'],
            'checksentence' => $exe_data['checksentence'],
            'uploadimage' => $exe_data['uploadimage'],
            'topic_id_id' => $exe_data['topic_id_id'],
            'upload_folder' => $exe_data['upload_folder'],
            'conversationtopic' => $exe_data['conversationtopic'],
            'description' => $exe_data['description'],
			'learningoutcomes' => $exe_data['learningoutcomes'],
            'notice' => $exe_data['notice'],
            'excercises_video' => $exe_data['excercises_video'],
            'excercises_audio' => $exe_data['excercises_audio'],
            'modified_date' => $exe_data['modified_date'],
            'excercises_youtube' => $exe_data['excercises_youtube'],
            'video_icon' => $exe_data['video_icon'],
            'rssfeedlink' => $exe_data['rssfeedlink'],
            'excercises_embed' => $exe_data['excercises_embed'],
            'favid' =>$exe_data['favid'] );
	}	
	//$q=mysql_query("select connectionid from edu_courses where courseid='".$this->uri->segment(2)."'");
	//$s=mysql_fetch_array($q);
/*	$this->db->where('total_question != ',0);
	$this->db->where('heading_id',$this->uri->segment(3));
$this->db->where('user_id',$this->session->userdata('id'));
$this->db->where('connect_id',$this->session->userdata('connectid'));
$this->db->order_by('id', 'DESC');
$this->db->limit('5');
$query2=$this->db->get("e_".$this->session->userdata('connectid')."_edu_result");
$data['totattmpt']=$query2->result();*/
	
$this->data['totattmpt']=array();	
$query2=$this->db->query("select * from e_10_edu_result_fillintheblanks where topic_id='".$_GET['headingid']."' and user_id='".$this->session->data['userid']."' and total_question!='0'  order by id DESC limit 0,5");			
$totattmpt=$query2->rows;	
	//echo '<pre>';
	//print_r($totattmpt);
	foreach ($totattmpt as $tot){	
	$this->data['totattmpt'][]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'total_question' => $tot['total_question'],
            'correct_question' => $tot['correct_question'],
            'worng_question' => $tot['worng_question'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);
				
	}
	$this->id       = 'content';
		$this->template = 'klaspad/fill_in_the_blanks.php';
		$this->render();			
	//$this->load->view('exercisedashboard/fill_in_the_blank',$data);
	}else
	//echo $heading_data['exerciestype'];
	//die;
	if($heading_data['exerciestype']=='TrueFalse'){
	//$exe_dataa = $this->model_klaspad_klaspad->exercise_new_dataaa($heading_data['id'],$heading_data['exerciestype']);
	$query1=$this->db->query("select ee.*,ea.id as favid from e_10_edu_excercises_truefalse as ee left join e_10_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$heading_data['id']."' and ee.resourceid='".$_GET['resourceid']."' ");		
	$exe_dataaa=$query1->rows;
	//echo '<pre>';
	//print_r($exe_data);
	foreach($exe_dataaa as $exe_data){
	$this->data['exe_dataa'][]=array('id' => $exe_data['id'],
            'topic_id' => $exe_data['topic_id'],
            'excercisename' => $exe_data['excercisename'],
            'exerciestype' => $exe_data['exerciestype'],
            'wordssentence' => $exe_data['wordssentence'],
            'answere' => $exe_data['answere'],
            'question' => $exe_data['question'],
            'checksentence' => $exe_data['checksentence'],
            'uploadimage' => $exe_data['uploadimage'],
            'topic_id_id' => $exe_data['topic_id_id'],
            'upload_folder' => $exe_data['upload_folder'],
            'conversationtopic' => $exe_data['conversationtopic'],
            'description' => $exe_data['description'],
			'learningoutcomes' => $exe_data['learningoutcomes'],
            'notice' => $exe_data['notice'],
            'excercises_video' => $exe_data['excercises_video'],
            'excercises_audio' => $exe_data['excercises_audio'],
            'modified_date' => $exe_data['modified_date'],
            'excercises_youtube' => $exe_data['excercises_youtube'],
            'video_icon' => $exe_data['video_icon'],
            'rssfeedlink' => $exe_data['rssfeedlink'],
            'excercises_embed' => $exe_data['excercises_embed'],
            'favid' =>$exe_data['favid'] );
	}	
	//$q=mysql_query("select connectionid from edu_courses where courseid='".$this->uri->segment(2)."'");
	//$s=mysql_fetch_array($q);
/*	$this->db->where('total_question != ',0);
	$this->db->where('heading_id',$this->uri->segment(3));
$this->db->where('user_id',$this->session->userdata('id'));
$this->db->where('connect_id',$this->session->userdata('connectid'));
$this->db->order_by('id', 'DESC');
$this->db->limit('5');
$query2=$this->db->get("e_".$this->session->userdata('connectid')."_edu_result");
$data['totattmpt']=$query2->result();*/
	
$this->data['totattmpt']=array();	
$query2=$this->db->query("select * from e_10_edu_result_truefalse where topic_id='".$_GET['headingid']."' and user_id='".$this->session->data['userid']."' and total_question!='0'  order by id DESC limit 0,5");			
$totattmpt=$query2->rows;	
	//echo '<pre>';
	//print_r($totattmpt);
	foreach ($totattmpt as $tot){	
	$this->data['totattmpt'][]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'total_question' => $tot['total_question'],
            'correct_question' => $tot['correct_question'],
            'worng_question' => $tot['worng_question'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);
				
	}
	$this->id       = 'content';
		$this->template = 'klaspad/truefalse.php';
		$this->render();			
		
				
	//$this->load->view('exercisedashboard/multiple_choice_questions',$data);
	}elseif($heading_data['exerciestype']=='Multiple choice questions'){
	//$exe_dataa = $this->model_klaspad_klaspad->exercise_new_dataaa($heading_data['id'],$heading_data['exerciestype']);
	$query1=$this->db->query("select ee.*,ea.id as favid from e_10_edu_excercises_multiplechoice as ee left join e_10_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$heading_data['id']."' and ee.resourceid='".$_GET['resourceid']."' ");		
	$exe_dataaa=$query1->rows;
	//echo '<pre>';
	//print_r($exe_data);
	foreach($exe_dataaa as $exe_data){
	$this->data['exe_dataa'][]=array('id' => $exe_data['id'],
            'topic_id' => $exe_data['topic_id'],
            'excercisename' => $exe_data['excercisename'],
            'exerciestype' => $exe_data['exerciestype'],
            'wordssentence' => $exe_data['wordssentence'],
            'answere' => $exe_data['answere'],
            'question' => $exe_data['question'],
            'checksentence' => $exe_data['checksentence'],
            'uploadimage' => $exe_data['uploadimage'],
            'topic_id_id' => $exe_data['topic_id_id'],
            'upload_folder' => $exe_data['upload_folder'],
            'conversationtopic' => $exe_data['conversationtopic'],
            'description' => $exe_data['description'],
			'learningoutcomes' => $exe_data['learningoutcomes'],
            'notice' => $exe_data['notice'],
            'excercises_video' => $exe_data['excercises_video'],
            'excercises_audio' => $exe_data['excercises_audio'],
            'modified_date' => $exe_data['modified_date'],
            'excercises_youtube' => $exe_data['excercises_youtube'],
            'video_icon' => $exe_data['video_icon'],
            'rssfeedlink' => $exe_data['rssfeedlink'],
            'excercises_embed' => $exe_data['excercises_embed'],
            'favid' =>$exe_data['favid'] );
	}	
	//$q=mysql_query("select connectionid from edu_courses where courseid='".$this->uri->segment(2)."'");
	//$s=mysql_fetch_array($q);
/*	$this->db->where('total_question != ',0);
	$this->db->where('heading_id',$this->uri->segment(3));
$this->db->where('user_id',$this->session->userdata('id'));
$this->db->where('connect_id',$this->session->userdata('connectid'));
$this->db->order_by('id', 'DESC');
$this->db->limit('5');
$query2=$this->db->get("e_".$this->session->userdata('connectid')."_edu_result");
$data['totattmpt']=$query2->result();*/
	
$this->data['totattmpt']=array();	
$query2=$this->db->query("select * from e_10_edu_result where topic_id='".$_GET['headingid']."' and user_id='".$this->session->data['userid']."' and total_question!='0'  order by id DESC limit 0,5");			
$totattmpt=$query2->rows;	
	//echo '<pre>';
	//print_r($totattmpt);
	foreach ($totattmpt as $tot){	
	$this->data['totattmpt'][]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'total_question' => $tot['total_question'],
            'correct_question' => $tot['correct_question'],
            'worng_question' => $tot['worng_question'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);
				
	}
	$this->id       = 'content';
		$this->template = 'klaspad/multiple_choice_questions.php';
		$this->render();			
		
				
	//$this->load->view('exercisedashboard/multiple_choice_questions',$data);
	}elseif($heading_data['exerciestype']=='Introduction'){		
	$this->load->view('exercisedashboard/introduction',$data);
	}elseif($heading_data['exerciestype']=='Crosswords'){
		
		
	$q=mysql_query("select connectionid from edu_courses where courseid='".$_GET['courseid']."'");
	$s=mysql_fetch_array($q);	
	$id=$_GET['headingid'];
	$q=mysql_query("select * from e_10_edu_headings where id='".$id."'");	
	$heading_data=mysql_fetch_array($q);
	//echo '<pre>';
	//print_r($data['heading_data']);
	
	
	//$data['exe_data'] = $this->welcomemodel->exercise_new_data($data['heading_data']->id,$data['heading_data']->exerciestype);
	$q1=$this->db->query("select ee.*,ea.id as favid from e_10_edu_excercises_crossword as ee left join e_10_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$heading_data['id']."' and ee.resourceid='".$_GET['resourceid']."'");
	$exe_data=$q1->rows;		
	
foreach($exe_data as $exedata){
$ans=array();
$Que=array();
$hnt=array();
$this->data['alldata']=array();
//echo "select * from e_".$this->session->data['campusid']."_edu_answere_crossword where crossword_id='".$exedata['id']."'";
$q2=$this->db->query("select * from e_10_edu_answere_crossword where crossword_id='".$exedata['id']."'");		
$dat=$q2->row;
//echo '<pre>';
//print_r($dat);
$ans=unserialize($dat['answere']);
//print_r($ans);
$Que=unserialize($dat['question']);
//print_r($Que);
$hnt=unserialize($dat['hint']);
//print_r($hnt);
$this->data['alldata'][]=array('id'=>$dat['id'],
			 'crossword_id'=>$dat['crossword_id'],
			 'answere'=>$ans,
			 'question'=>$Que,
			 'total_count'=>$dat['total_count'],
			 'hint'=>$hnt);
	}
//echo "select * from e_".$this->session->data['campusid']."_edu_result_crossword where topic_id='".$_GET['headingid']."' and user_id='".$this->session->data['userid']."'  order by id DESC limit 0,5";
$this->data['totattmpt']=array();	
$query2=$this->db->query("select * from e_10_edu_result_crossword where topic_id='".$_GET['headingid']."' and user_id='".$this->session->data['userid']."'  order by id DESC limit 0,5");			
$totattmpt=$query2->rows;	
	//echo '<pre>';
	//print_r($totattmpt);
	foreach ($totattmpt as $tot){	
	$this->data['totattmpt'][]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'result' => $tot['result'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);
				
	}
	$this->id       = 'content';
		$this->template = 'klaspad/crosswords.php';
		$this->render();			
	//$this->load->view('exercisedashboard/crosswords',$data);
	}elseif($heading_data['exerciestype']=='Powerpoint presentation exercise'){
	//echo "select id, rssfeedlink from e_".$this->session->data['campusid']."_edu_excercises where topic_id='".$_GET['headingid']."'";
	$qd=mysql_query("select id, rssfeedlink from e_10_edu_excercises where topic_id='".$_GET['headingid']."'");
	$sqd=mysql_fetch_array($qd);
	//echo $csqd=mysql_num_rows($qd);
	//echo $sqd['id'].' xcvx';
	$this->data['reference']=@$sqd['rssfeedlink'];
	//echo "select * from e_".$this->session->data['campusid']."_edu_excercises_discussion where resourceid='".$sqd['id']."' ";
	$query1=$this->db->query("select * from e_10_edu_excercises_discussion where resourceid='".$sqd['id']."' ");	
$disc=$query1->rows;
$this->data['discussion']=array();	
foreach($disc as $dis){
$que=$this->db->query("select ea.assignment, ea.connectionid, ea.user_id from e_10_edu_ans_assignment ea where assignment_id='".$dis['id']."' order by ea.id desc ");		
$mmk = $que->rows;	
$url1=array();
foreach($mmk as $mmkk){
$msq=mysql_query("select eu.user_image, eu.demo_contact_person from e_10_edu_user as eu where eu.id='".$mmkk['user_id']."'");	
$mmk1=mysql_fetch_array($msq);
$url1[] =array('comment' => $mmkk['assignment'], 
            'username' => $mmk1['demo_contact_person'],
			'image' => $mmk1['user_image']);
}
	

$this->data['discussion'][]=array('id' => $dis['id'], 
			'resid' => $dis['resourceid'],
            'topic' => $dis['question'],
			'comment'=>$url1);
}		
$query2=$this->db->query("select * from e_10_edu_notes where courseid='".$sqd['id']."' and userid='".$this->session->data['userid']."'");	
$not=$query2->rows;
$this->data['notes']=array();	
foreach($not as $no){


$this->data['notes'][]=array('id' => $no['id'], 
			'resid' => $no['courseid'],
            'userid' => $no['userid'],
			'msg'=>$no['msg']);
}
//echo "select * from e_".$this->session->data['campusid']."_edu_excercises_assignment where resourceid='".$sqd['id']."'";
$query3=$this->db->query("select * from e_10_edu_excercises_assignment where resourceid='".$sqd['id']."' order by id asc");	
$assign=$query3->rows;
$this->data['assignment']=array();	
foreach($assign as $ass){
$this->data['assignment'][]=array('id' => $ass['id'], 
			'resid' => $ass['resourceid'],
            'topic' => $ass['answere']);
}
//echo "select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_crossword as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."'";
$query4=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_crossword as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."'");	
$crswrd=$query4->rows;
$this->data['crossword']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd as $ass1){
$this->data['crossword'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}

$query5=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_multiplechoice as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$crswrd1=$query5->rows;
$this->data['multiple']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd1 as $ass1){
$this->data['multiple'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}


$query6=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_fillintheblanks as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$crswrd2=$query6->rows;
$this->data['fill']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd2 as $ass1){
$this->data['fill'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query7=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_descripting as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$descriptingg=$query7->rows;
$this->data['descripting']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($descriptingg as $ass1){
$this->data['descripting'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}			

$query8=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_truefalse as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$tf=$query8->rows;
$this->data['truefalse']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($tf as $ass1){
$this->data['truefalse'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}

$query9=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_draganddrop as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$dd=$query9->rows;
$this->data['draganddrop']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($dd as $ass1){
$this->data['draganddrop'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}				
//$data=array('discussion'=>@$discussion);		
	$this->id       = 'content';
		$this->template = 'klaspad/powerpoint_exercise.php';
		$this->render();			
	//$this->load->view('exercisedashboard/powerpoint_exercise',$data);
	}else/*if($heading_data['exerciestype']=='Add Folder'){		
	$this->load->view('exercisedashboard/add_show_folder',$data);
	}else*/if($heading_data['exerciestype']=='Files'){
	$qd=mysql_query("select id, rssfeedlink from e_10_edu_excercises where topic_id='".$_GET['headingid']."'");
	$sqd=mysql_fetch_array($qd);
	$this->data['reference']=@$sqd['rssfeedlink'];	
	$query1= $this->db->query("select * from e_10_edu_excercises_discussion where resourceid='".$sqd['id']."' ");		
$disc=$query1->rows;
$this->data['discussion']=array();	
foreach($disc as $dis){
$que=$this->db->query("select ea.assignment, ea.connectionid, ea.user_id from e_10_edu_ans_assignment ea where assignment_id='".$dis['id']."' order by ea.id desc ");		
$mmk = $que->rows;	
$url1=array();
foreach($mmk as $mmkk){
$msq=mysql_query("select eu.user_image, eu.demo_contact_person from e_10_edu_user as eu where eu.id='".$mmkk['user_id']."'");	
$mmk1=mysql_fetch_array($msq);
$url1[] =array('comment' => $mmkk['assignment'], 
            'username' => $mmk1['demo_contact_person'],
			'image' => $mmk1['user_image']);
}
	

$this->data['discussion'][]=array('id' => $dis['id'], 
			'resid' => $dis['resourceid'],
            'topic' => $dis['question'],
			'comment'=>$url1);
}		
$query2=$this->db->query("select * from e_10_edu_notes where courseid='".$sqd['id']."' and userid='".$this->session->data['userid']."'");	
$not=$query2->rows;
$this->data['notes']=array();	
foreach($not as $no){


$this->data['notes'][]=array('id' => $no['id'], 
			'resid' => $no['courseid'],
            'userid' => $no['userid'],
			'msg'=>$no['msg']);
}

$query3=$this->db->query("select * from e_10_edu_excercises_assignment where resourceid='".$sqd['id']."' order by id asc");	
$assign=$query3->rows;
$this->data['assignment']=array();	
foreach($assign as $ass){
$this->data['assignment'][]=array('id' => $ass['id'], 
			'resid' => $ass['resourceid'],
            'topic' => $ass['answere']);
}
//echo "select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_crossword as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."'";
$query4=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_crossword as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."'");	
$crswrd=$query4->rows;
$this->data['crossword']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd as $ass1){
$this->data['crossword'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query5=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_multiplechoice as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$crswrd1=$query5->rows;
$this->data['multiple']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd1 as $ass1){
$this->data['multiple'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query6=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_fillintheblanks as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$crswrd2=$query6->rows;
$this->data['fill']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd2 as $ass1){
$this->data['fill'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query7=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_descripting as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$descriptingg=$query7->rows;
$this->data['descripting']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($descriptingg as $ass1){
$this->data['descripting'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}	
$query8=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_truefalse as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$tf=$query8->rows;
$this->data['truefalse']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($tf as $ass1){
$this->data['truefalse'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}	
$query9=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_draganddrop as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$dd=$query9->rows;
$this->data['draganddrop']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($dd as $ass1){
$this->data['draganddrop'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}								
//$data=array('discussion'=>@$discussion);		
	$this->id       = 'content';
		$this->template = 'klaspad/add_show_files.php';
		$this->render();
	//$this->load->view('exercisedashboard/add_show_files',$data);
	}else/*if($data['heading_data']->exerciestype=='Add rating scale'){
	$data['ratingdata']=$this->welcomemodel->add_front_rating_scale();
	$this->load->view('exercisedashboard/add_rating_scale',$data);
	}else*/if($heading_data['exerciestype']=='Add Video'){
	
	$qd=mysql_query("select id,rssfeedlink from e_10_edu_excercises where topic_id='".$_GET['headingid']."'");
	$sqd=mysql_fetch_array($qd);
	$this->data['reference']=@$sqd['rssfeedlink'];		
$query1= $this->db->query("select * from e_10_edu_excercises_discussion where resourceid='".$sqd['id']."' ");		
$disc=$query1->rows;
$this->data['discussion']=array();	
foreach($disc as $dis){
$que=$this->db->query("select ea.assignment, ea.connectionid, ea.user_id from e_10_edu_ans_assignment ea where assignment_id='".$dis['id']."' order by ea.id desc ");		
$mmk = $que->rows;	
$url1=array();
foreach($mmk as $mmkk){
$msq=mysql_query("select eu.user_image, eu.demo_contact_person from e_10_edu_user as eu where eu.id='".$mmkk['user_id']."'");	
$mmk1=mysql_fetch_array($msq);
$url1[] =array('comment' => $mmkk['assignment'], 
            'username' => $mmk1['demo_contact_person'],
			'image' => $mmk1['user_image']);
}
	

$this->data['discussion'][]=array('id' => $dis['id'], 
			'resid' => $dis['resourceid'],
            'topic' => $dis['question'],
			'comment'=>$url1);
}		
$query2=$this->db->query("select * from e_10_edu_notes where courseid='".$sqd['id']."' and userid='".$this->session->data['userid']."'");	
$not=$query2->rows;
$this->data['notes']=array();	
foreach($not as $no){


$this->data['notes'][]=array('id' => $no['id'], 
			'resid' => $no['courseid'],
            'userid' => $no['userid'],
			'msg'=>$no['msg']);
}

$query3=$this->db->query("select * from e_10_edu_excercises_assignment where resourceid='".$sqd['id']."' order by id asc");	
$assign=$query3->rows;
$this->data['assignment']=array();	
foreach($assign as $ass){
$this->data['assignment'][]=array('id' => $ass['id'], 
			'resid' => $ass['resourceid'],
            'topic' => $ass['answere']);
}
//echo "select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_crossword as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."'";
$query4=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_crossword as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."'");	
$crswrd=$query4->rows;
$this->data['crossword']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd as $ass1){
$this->data['crossword'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}	
$query5=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_multiplechoice as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."'");	
$crswrd1=$query5->rows;
$this->data['multiple']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd1 as $ass1){
$this->data['multiple'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
//echo "select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_fillintheblanks as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id";
$query6=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_fillintheblanks as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$crswrd2=$query6->rows;
$this->data['fill']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd2 as $ass1){
$this->data['fill'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
//echo "select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_descripting as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.topic_id where c.resourceid='".$sqd['id']."' and h.exerciestype='Descripting' group by c.topic_id";
$query7=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_descripting as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' and h.exerciestype='Descripting' group by c.topic_id");	
$descriptingg=$query7->rows;
$this->data['descripting']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($descriptingg as $ass1){
$this->data['descripting'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}	
$query8=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_truefalse as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$tf=$query8->rows;
$this->data['truefalse']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($tf as $ass1){
$this->data['truefalse'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query9=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_draganddrop as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$dd=$query9->rows;
$this->data['draganddrop']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($dd as $ass1){
$this->data['draganddrop'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}					
//$data=array('discussion'=>@$discussion);		
	$this->id       = 'content';
		$this->template = 'klaspad/add_video.php';
		$this->render();
	//$this->load->view('exercisedashboard/add_video',$data);
	}elseif($heading_data['exerciestype']=='Add Audio'){
	
	
	$qd=mysql_query("select id,rssfeedlink from e_10_edu_excercises where topic_id='".$_GET['headingid']."'");
	$sqd=mysql_fetch_array($qd);
	$this->data['reference']=@$sqd['rssfeedlink'];		
$query1= $this->db->query("select * from e_10_edu_excercises_discussion where resourceid='".$sqd['id']."' ");		
$disc=$query1->rows;
$this->data['discussion']=array();	
foreach($disc as $dis){
$que=$this->db->query("select ea.assignment, ea.connectionid, ea.user_id from e_10_edu_ans_assignment ea where assignment_id='".$dis['id']."' order by ea.id desc ");		
$mmk = $que->rows;	
$url1=array();
foreach($mmk as $mmkk){
$msq=mysql_query("select eu.user_image, eu.demo_contact_person from e_10_edu_user as eu where eu.id='".$mmkk['user_id']."'");	
$mmk1=mysql_fetch_array($msq);
$url1[] =array('comment' => $mmkk['assignment'], 
            'username' => $mmk1['demo_contact_person'],
			'image' => $mmk1['user_image']);
}
	

$this->data['discussion'][]=array('id' => $dis['id'], 
			'resid' => $dis['resourceid'],
            'topic' => $dis['question'],
			'comment'=>$url1);
}		
$query2=$this->db->query("select * from e_10_edu_notes where courseid='".$sqd['id']."' and userid='".$this->session->data['userid']."'");	
$not=$query2->rows;
$this->data['notes']=array();	
foreach($not as $no){


$this->data['notes'][]=array('id' => $no['id'], 
			'resid' => $no['courseid'],
            'userid' => $no['userid'],
			'msg'=>$no['msg']);
}

$query3=$this->db->query("select * from e_10_edu_excercises_assignment where resourceid='".$sqd['id']."' order by id asc");	
$assign=$query3->rows;
$this->data['assignment']=array();	
foreach($assign as $ass){
$this->data['assignment'][]=array('id' => $ass['id'], 
			'resid' => $ass['resourceid'],
            'topic' => $ass['answere']);
}
//echo "select c.*, h.headingname from e_".$this->session->data['campusid']."_edu_excercises_crossword as c left join e_".$this->session->data['campusid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."'";
$query4=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_crossword as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."'");	
$crswrd=$query4->rows;
$this->data['crossword']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd as $ass1){
$this->data['crossword'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query5=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_multiplechoice as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."'");	
$crswrd1=$query5->rows;
$this->data['multiple']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd1 as $ass1){
$this->data['multiple'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query6=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_fillintheblanks as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$crswrd2=$query6->rows;
$this->data['fill']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd2 as $ass1){
$this->data['fill'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query7=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_descripting as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$descriptingg=$query7->rows;
$this->data['descripting']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($descriptingg as $ass1){
$this->data['descripting'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}	
$query8=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_truefalse as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$tf=$query8->rows;
$this->data['truefalse']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($tf as $ass1){
$this->data['truefalse'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query9=$this->db->query("select c.*, h.headingname from e_10_edu_excercises_draganddrop as c left join e_10_edu_headings as h on c.topic_id=h.id where c.resourceid='".$sqd['id']."' group by c.topic_id");	
$dd=$query9->rows;
$this->data['draganddrop']=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($dd as $ass1){
$this->data['draganddrop'][]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}									
//$data=array('discussion'=>@$discussion);		
	$this->id       = 'content';
		$this->template = 'klaspad/add_audio.php';
		$this->render();
	//$this->load->view('exercisedashboard/add_video',$data);
				
	//$this->load->view('exercisedashboard/add_audio',$data);
	}else/*if($data['heading_data']->exerciestype=='Add matrix'){
	$data['ratingdata']=$this->welcomemodel->add_front_rating_scale();
	$this->load->view('exercisedashboard/add_rating_scale',$data);
	}elseif($data['heading_data']->exerciestype=='Add multiple selection'){
	$data['ratingdata']=$this->welcomemodel->add_multiple_selection();
	$this->load->view('exercisedashboard/add_multiple_selection',$data);
	}else*/if($heading_data['exerciestype']=='Add assignment'){
	$this->id       = 'content';
		$this->template = 'klaspad/add_assignment.php';
		$this->render();
	//$this->load->view('exercisedashboard/add_assignment',$data);
	}
	}else {
		if($intro_topics['exerciestype']=='Introduction'){
	   $this->load->view('exercisedashboard/introduction',$data);
		}else{
		$this->data['module']=array();				
	$module_course_wise=$this->model_klaspad_klaspad->module_course_wiseee($_GET['courseid']);
	//echo '<pre>';
	//print_r(${'module'.$course['id']});
	foreach($module_course_wise as $result)
				{
				   $this->data['module_course_wise'][]=array(
					'id'=>$result['id'],
					'modulename' => $result['modulename'],
					'moduletype' => $result['moduletype'],
					'lti_id' => $result['lti_id']
					);
				}	
		$this->id       = 'content';
		$this->template = 'klaspad/module_activity.php';
		$this->render();		
		//$this->load->view('exercisedashboard/module_activity',$data);	
		}
		}
	
	}		
	
public function module_activity_link()
	{
		$this->load->model('klaspad/klaspad');
	$module_data=$this->model_klaspad_klaspad->module_data();
	$this->data['course_id']=$module_data['course_id'];
	$this->data['modulename']=$module_data['modulename'];
	$this->data['all_exe']=array();
	$all_exe=$this->model_klaspad_klaspad->list_module();
	//echo '<pre>';
	//print_r($all_exe);
	$intro_topics=$this->model_klaspad_klaspad->intro_topics();
	foreach($all_exe as $all_exe){
	$this->data['all_exe'][]=array(
			'id' => $all_exe['id'],
            'topicname' => $all_exe['topicname'],
            'module_id' => $all_exe['module_id'],
            'numberofheadings' => $all_exe['numberofheadings'],
            'topicno' => $all_exe['topicno'],
            'description' => $all_exe['description'],
            'learningoutcomes' => $all_exe['learningoutcomes'],
            'exerciestype' => $all_exe['exerciestype'],
            'introvideo' => $all_exe['introvideo'],
            'modified_date' => $all_exe['modified_date']
					);
	$this->data['exe_type'.$all_exe['id']]=array();					
	${'exe_'.$all_exe['id']}=$this->model_klaspad_klaspad->exercise_data($all_exe['id']);
	//print_r(${'exe_'.$all_exe['id']}[1]);
	foreach(${'exe_'.$all_exe['id']}[1] as $exe_dta){
	$this->data['exe_type'.$all_exe['id']][]=array(
			'id' => $exe_dta['id'],
            'headingname' => $exe_dta['headingname'],
            'exerciestype' => $exe_dta['exerciestype']
					);
	}
	
    }
	$this->id       = 'content';
	$this->template = 'klaspad/leftmenu_academics.php';
	$this->render();
	//$this->load->view('include/leftmenu_academics',$data);
	}
public function module_activity_link1()
	{
		$this->load->model('klaspad/klaspad');
	$module_data=$this->model_klaspad_klaspad->module_data();
	$this->data['course_id']=$module_data['course_id'];
	$this->data['modulename']=$module_data['modulename'];
	$this->data['all_exe']=array();
	$all_exe=$this->model_klaspad_klaspad->list_module();
	//echo '<pre>';
	//print_r($all_exe);
	$intro_topics=$this->model_klaspad_klaspad->intro_topics();
	foreach($all_exe as $all_exe){
	$this->data['all_exe'][]=array(
			'id' => $all_exe['id'],
            'topicname' => $all_exe['topicname'],
            'module_id' => $all_exe['module_id'],
            'numberofheadings' => $all_exe['numberofheadings'],
            'topicno' => $all_exe['topicno'],
            'description' => $all_exe['description'],
            'learningoutcomes' => $all_exe['learningoutcomes'],
            'exerciestype' => $all_exe['exerciestype'],
            'introvideo' => $all_exe['introvideo'],
            'modified_date' => $all_exe['modified_date']
					);
	$this->data['exe_type'.$all_exe['id']]=array();					
	${'exe_'.$all_exe['id']}=$this->model_klaspad_klaspad->exercise_data($all_exe['id']);
	//print_r(${'exe_'.$all_exe['id']}[1]);
	foreach(${'exe_'.$all_exe['id']}[1] as $exe_dta){
	$this->data['exe_type'.$all_exe['id']][]=array(
			'id' => $exe_dta['id'],
            'headingname' => $exe_dta['headingname'],
            'exerciestype' => $exe_dta['exerciestype']
					);
	}
	
    }
	$this->id       = 'content';
	$this->template = 'klaspad/leftmenu_academics1.php';
	$this->render();
	//$this->load->view('include/leftmenu_academics',$data);
	}	
	
public function insertresultcrossword_web(){
$result='pass';	
$cnt=count($_POST['question']);
for($q=0;$q<$cnt; $q++){
if (strcasecmp($_POST['question'][$q], $_POST['answere'][$q]) != 0) {	
$result='fail';
}
}

$q=mysql_query("select course_id from e_".$this->session->data['campusid']."_edu_modules where id='".$_GET['moduleid']."'");
		$s=mysql_fetch_array($q);
		//echo "insert into e_".$this->session->data['campusid']."_edu_result_crossword set course_id='".$s['course_id']."', module_id='".$_GET['moduleid']."', topic_id='".$_GET['headingid']."', heading_id='".$_GET['topicid']."', result='".$result."', done_date=now(), user_id='".$this->session->data['userid']."', connect_id='".$this->session->data['campusid']."'";
		//die;
mysql_query("insert into e_".$this->session->data['campusid']."_edu_result_crossword set course_id='".$s['course_id']."', module_id='".$_GET['moduleid']."', topic_id='".$_GET['headingid']."', heading_id='".$_GET['topicid']."', result='".$result."', done_date=now(), user_id='".$this->session->data['userid']."', connect_id='".$this->session->data['campusid']."'");
	$this->redirect($_SERVER['HTTP_REFERER']);
}

public function multiple_choice_questions_checkyouranswere(){
	$this->load->model('klaspad/klaspad');
	$all_check=$this->model_klaspad_klaspad->multiple_choice_questions_checkyouranswere();
	$this->data['id']=$all_check['id'];
	$this->data['answere']=$all_check['answere'];
	$this->data['question']=$all_check['question'];
	$this->id       = 'content';
	$this->template = 'klaspad/multiple_choice_questions_checkyouranswere.php';
	$this->render();
	//$this->load->view('exercisedashboard/multiple_choice_questions_checkyouranswere',$data);
	}
public function truefalse_checkyouranswere(){
	$this->load->model('klaspad/klaspad');
	$all_check=$this->model_klaspad_klaspad->truefalse_checkyouranswere();
	$this->data['id']=$all_check['id'];
	$this->data['answere']=$all_check['answere'];
	$this->data['question']=$all_check['question'];
	$this->id       = 'content';
	$this->template = 'klaspad/truefalse_checkyouranswere.php';
	$this->render();
	//$this->load->view('exercisedashboard/multiple_choice_questions_checkyouranswere',$data);
	}
public function insertcomments(){
//echo "select connectionid from edu_courses where courseid='".$_POST['courseid']."'";	
//echo '<pre>';
//print_r($_POST);
//die;	
$user_id=$this->session->data['userid'];
$createddate=date('d/m/Y h:iA');
$connectionid=$this->session->data['campusid'];
mysql_query("insert into e_".$this->session->data['campusid']."_edu_ans_assignment set assignment_id='".$_POST['assignment_id']."', assignment='".$_POST['assignment']."', course_id='".$_POST['course_id']."', user_id='".$user_id."', createddate='".$createddate."', connectionid='".$connectionid."'");	
$commentid=mysql_insert_id();
mysql_query("insert into edu_comments set commentid='".$commentid."', parent_connectionid='".$connectionid."', assignment_id='".$_POST['assignment_id']."', assignment='".$_POST['assignment']."', course_id='".$_POST['course_id']."', user_id='".$user_id."', createddate='".$createddate."', connectionid='".$connectionid."'");	

	//$this->session->set_flashdata('message', 'Comment added');	
	$this->redirect($_SERVER['HTTP_REFERER']);	
}

public function insertnotes(){
	$qd=mysql_query("select id from e_".$this->session->data['campusid']."_edu_excercises where topic_id='".$_GET['headingid']."'");
	$sqd=mysql_fetch_array($qd);
	mysql_query("insert into e_".$this->session->data['campusid']."_edu_notes set courseid='".$sqd['id']."', msg='".$_POST['msg']."', userid='".$this->session->data['userid']."', createddate='".date('d-m-Y h:m:s')."'");
	$this->redirect($_SERVER['HTTP_REFERER']);
	}

public function saveassignmentresult(){
	$this->load->model('klaspad/klaspad');
	$this->model_klaspad_klaspad->saveassignmentresult();
    //$this->session->set_flashdata('message', 'Result saved');	
	$this->redirect($_SERVER['HTTP_REFERER']);
	}
	
public function add_multiple_choice_questions()
	{
	$this->load->model('klaspad/klaspad');	
	if(isset($this->session->data['userid'])){
	$courselist=$this->model_klaspad_klaspad->courses_list_new();
	$this->data['courseid']=$courselist['id'];
	$this->data['coursename']=$courselist['coursename'];
	$modulelist=$this->model_klaspad_klaspad->modules_list_new();	
	$this->data['moduleid']=$modulelist['id'];
	$this->data['modulename']=$modulelist['modulename'];
	$this->data['topicslistlist'] = array();	
	$topicslistlist=$this->model_klaspad_klaspad->topics_list_list_new_new();
	foreach($topicslistlist as $result)
				{
					$this->data['topicslistlist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
									}
	$this->data['topiclist'] = array();										
	$topiclist=$this->model_klaspad_klaspad->topics_list();	
		
	foreach($topiclist as $result)
				{
					$this->data['topiclist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
									}	
	$this->data['resourcelist'] = array();									
	$resourcelist=$this->model_klaspad_klaspad->resource_list();
	foreach($resourcelist as $result)
				{
					$this->data['resourcelist'][]=array(
					'resourceid'=>$result['resourceid'],
					'headingname' => $result['headingname']
					);
				}								
	$this->id       = 'content';
	$this->template = 'klaspad/add_multiple_choice_questions.php';
	$this->render();
	//$this->load->view('multiple_choice_questions/add_multiple_choice_questions',$data);
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}	
	
public function add_truefalse()
	{
	$this->load->model('klaspad/klaspad');	
	if(isset($this->session->data['userid'])){
	$courselist=$this->model_klaspad_klaspad->courses_list_new();
	$this->data['courseid']=$courselist['id'];
	$this->data['coursename']=$courselist['coursename'];
	$modulelist=$this->model_klaspad_klaspad->modules_list_new();	
	$this->data['moduleid']=$modulelist['id'];
	$this->data['modulename']=$modulelist['modulename'];
	$this->data['topicslistlist'] = array();	
	$topicslistlist=$this->model_klaspad_klaspad->topics_list_list_new_new();
	foreach($topicslistlist as $result)
				{
					$this->data['topicslistlist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
									}
	$this->data['topiclist'] = array();										
	$topiclist=$this->model_klaspad_klaspad->topics_list();	
		
	foreach($topiclist as $result)
				{
					$this->data['topiclist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
									}	
	$this->data['resourcelist'] = array();									
	$resourcelist=$this->model_klaspad_klaspad->resource_list();
	foreach($resourcelist as $result)
				{
					$this->data['resourcelist'][]=array(
					'resourceid'=>$result['resourceid'],
					'headingname' => $result['headingname']
					);
				}								
	$this->id       = 'content';
	$this->template = 'klaspad/add_truefalse.php';
	$this->render();
	//$this->load->view('multiple_choice_questions/add_multiple_choice_questions',$data);
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}		
	

public function insert_multiple_choice_questions()
	{
	$this->load->model('klaspad/klaspad');	
	if(isset($this->session->data['userid'])){
	$topiclist=$this->model_klaspad_klaspad->insert_multiple_choice_questions();	
    //$this->session->set_flashdata('message', 'Added successfully');	?>
   	<script>
   	parent.window.hs.getExpander().close();
   	parent.location.reload();
   	</script>
<?php }else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}

public function insert_truefalse()
	{
	$this->load->model('klaspad/klaspad');	
	if(isset($this->session->data['userid'])){
	$topiclist=$this->model_klaspad_klaspad->insert_truefalse();	
    //$this->session->set_flashdata('message', 'Added successfully');	?>
   	<script>
   	parent.window.hs.getExpander().close();
   	parent.location.reload();
   	</script>
<?php }else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}

public function add_assiement()
	{
	$this->load->model('klaspad/klaspad');		
	if(isset($this->session->data['userid'])){	
	$courselist=$this->model_klaspad_klaspad->courses_list_new();
	$this->data['courseid']=$courselist['id'];
	$this->data['coursename']=$courselist['coursename'];
	$modulelist=$this->model_klaspad_klaspad->modules_list_new();	
	$this->data['moduleid']=$modulelist['id'];
	$this->data['modulename']=$modulelist['modulename'];
	$this->data['topicslistlist'] = array();	
	$topicslistlist=$this->model_klaspad_klaspad->topics_list_list_new_new();
	foreach($topicslistlist as $result)
				{
					$this->data['topicslistlist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
									}
	$this->data['topiclist'] = array();										
	$topiclist=$this->model_klaspad_klaspad->topics_list();	
		
	foreach($topiclist as $result)
				{
					$this->data['topiclist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
				}
	$this->data['resourcelist'] = array();									
	$resourcelist=$this->model_klaspad_klaspad->resource_list();
	foreach($resourcelist as $result)
				{
					$this->data['resourcelist'][]=array(
					'resourceid'=>$result['resourceid'],
					'headingname' => $result['headingname']
					);
				}
	
	if(@$_GET['resourceid']){
	$record=$this->model_klaspad_klaspad->assignment_record();
	$this->data['id']=$record['id'];	
	$this->data['topic_id']=$record['topic_id'];	
	$this->data['uploadimage']=$record['uploadimage'];
	$this->data['description']=$record['description'];
	$this->data['learningoutcomes']=$record['learningoutcomes'];
	$this->data['excercises_video']=$record['excercises_video'];
	$this->data['excercises_audio']=$record['excercises_audio'];
	$this->data['excercises_youtube']=$record['excercises_youtube'];
	$this->data['rssfeedlink']=$record['rssfeedlink'];
	$this->data['question']=$record['question'];
	$this->data['answere']=$record['answere'];
	$this->data['excercises_embed']=$record['excercises_embed'];
	$this->id       = 'content';
	$this->template = 'klaspad/edit_assiement.php';
	$this->render();	
		}else{
	$this->id       = 'content';
	$this->template = 'klaspad/add_assiement.php';
	$this->render();	
	}
	/*$this->id       = 'content';
	$this->template = 'klaspad/add_assiement.php';
	$this->render();*/	
	//$this->load->view('welcome/add_assiement',$data);
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}
	
public function insert_assiement(){
	$this->load->model('klaspad/klaspad');	
	if(isset($this->session->data['userid'])){
	$this->model_klaspad_klaspad->insert_assiement();	
    //$this->session->set_flashdata('message', 'Add successfully');	
?>
   <script>
   parent.window.hs.getExpander().close();
   parent.location.reload();
   </script>
	<?php	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}
	
public function edit_assiement(){
	$this->load->model('klaspad/klaspad');	
	if(isset($this->session->data['userid'])){
	$this->model_klaspad_klaspad->edit_assiement();	
    //$this->session->set_flashdata('message', 'Add successfully');	
?>
   <script>
   parent.window.hs.getExpander().close();
   parent.location.reload();
   </script>
	<?php	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}	
				
public function add_discussion()
	{
	$this->load->model('klaspad/klaspad');		
	if(isset($this->session->data['userid'])){	
	$courselist=$this->model_klaspad_klaspad->courses_list_new();
	$this->data['courseid']=$courselist['id'];
	$this->data['coursename']=$courselist['coursename'];
	$modulelist=$this->model_klaspad_klaspad->modules_list_new();	
	$this->data['moduleid']=$modulelist['id'];
	$this->data['modulename']=$modulelist['modulename'];
	$this->data['topicslistlist'] = array();	
	$topicslistlist=$this->model_klaspad_klaspad->topics_list_list_new_new();
	foreach($topicslistlist as $result)
				{
					$this->data['topicslistlist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
									}
	$this->data['topiclist'] = array();										
	$topiclist=$this->model_klaspad_klaspad->topics_list();	
		
	foreach($topiclist as $result)
				{
					$this->data['topiclist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
				}
	$this->data['resourcelist'] = array();				
	$resourcelist=$this->model_klaspad_klaspad->resource_list();
	foreach($resourcelist as $result)
				{
					$this->data['resourcelist'][]=array(
					'resourceid'=>$result['resourceid'],
					'headingname' => $result['headingname']
					);
				}
				
	if(@$_GET['resourceid']){
	$record=$this->model_klaspad_klaspad->discussion_record();
	$this->data['id']=$record['id'];	
	$this->data['topic_id']=$record['topic_id'];	
	$this->data['uploadimage']=$record['uploadimage'];
	$this->data['description']=$record['description'];
	$this->data['learningoutcomes']=$record['learningoutcomes'];
	$this->data['excercises_video']=$record['excercises_video'];
	$this->data['excercises_audio']=$record['excercises_audio'];
	$this->data['excercises_youtube']=$record['excercises_youtube'];
	$this->data['rssfeedlink']=$record['rssfeedlink'];
	$this->data['question']=$record['question'];
	$this->data['excercises_embed']=$record['excercises_embed'];
	$this->id       = 'content';
	$this->template = 'klaspad/edit_discussion.php';
	$this->render();	
		}else{
	$this->id       = 'content';
	$this->template = 'klaspad/add_discussion.php';
	$this->render();	
	}
				
	/*$this->id       = 'content';
	$this->template = 'klaspad/add_discussion.php';
	$this->render();*/
	//$this->load->view('welcome/add_discussion',$data);
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}
public function add_descripting()
	{
	$this->load->model('klaspad/klaspad');		
	if(isset($this->session->data['userid'])){	
	$courselist=$this->model_klaspad_klaspad->courses_list_new();
	$this->data['courseid']=$courselist['id'];
	$this->data['coursename']=$courselist['coursename'];
	$modulelist=$this->model_klaspad_klaspad->modules_list_new();	
	$this->data['moduleid']=$modulelist['id'];
	$this->data['modulename']=$modulelist['modulename'];
	$this->data['topicslistlist'] = array();	
	$topicslistlist=$this->model_klaspad_klaspad->topics_list_list_new_new();
	foreach($topicslistlist as $result)
				{
					$this->data['topicslistlist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
									}
	$this->data['topiclist'] = array();										
	$topiclist=$this->model_klaspad_klaspad->topics_list();	
		
	foreach($topiclist as $result)
				{
					$this->data['topiclist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
				}
	$this->data['resourcelist'] = array();				
	$resourcelist=$this->model_klaspad_klaspad->resource_list();
	foreach($resourcelist as $result)
				{
					$this->data['resourcelist'][]=array(
					'resourceid'=>$result['resourceid'],
					'headingname' => $result['headingname']
					);
				}
				
	if(@$_GET['resourceid']){
	$record=$this->model_klaspad_klaspad->descripting_record();
	$this->data['id']=$record['id'];	
	$this->data['topic_id']=$record['topic_id'];	
	$this->data['uploadimage']=$record['uploadimage'];
	$this->data['description']=$record['description'];
	$this->data['learningoutcomes']=$record['learningoutcomes'];
	$this->data['excercises_video']=$record['excercises_video'];
	$this->data['excercises_audio']=$record['excercises_audio'];
	$this->data['excercises_youtube']=$record['excercises_youtube'];
	$this->data['rssfeedlink']=$record['rssfeedlink'];
	$this->data['question']=$record['question'];
	$this->data['excercises_embed']=$record['excercises_embed'];
	$this->id       = 'content';
	$this->template = 'klaspad/edit_descripting.php';
	$this->render();	
		}else{
	$this->id       = 'content';
	$this->template = 'klaspad/add_descripting.php';
	$this->render();	
	}
				
	/*$this->id       = 'content';
	$this->template = 'klaspad/add_discussion.php';
	$this->render();*/
	//$this->load->view('welcome/add_discussion',$data);
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}	
	
public function insert_discussion(){
	$this->load->model('klaspad/klaspad');	
	if(isset($this->session->data['userid'])){
	$this->model_klaspad_klaspad->insert_discussion();	
    //$this->session->set_flashdata('message', 'Add successfully');	
?>
   <script>
   parent.window.hs.getExpander().close();
   parent.location.reload();
   </script>
	<?php	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}
public function edit_discussion(){
	$this->load->model('klaspad/klaspad');	
	if(isset($this->session->data['userid'])){
	$this->model_klaspad_klaspad->edit_discussion();	
    //$this->session->set_flashdata('message', 'Add successfully');	
?>
   <script>
   parent.window.hs.getExpander().close();
   parent.location.reload();
   </script>
	<?php	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}
	
public function insert_descripting(){
	$this->load->model('klaspad/klaspad');	
	if(isset($this->session->data['userid'])){
	$this->model_klaspad_klaspad->insert_descripting();	
    //$this->session->set_flashdata('message', 'Add successfully');	
?>
   <script>
   parent.window.hs.getExpander().close();
   parent.location.reload();
   </script>
	<?php	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}
public function edit_descripting(){
	$this->load->model('klaspad/klaspad');	
	if(isset($this->session->data['userid'])){
	$this->model_klaspad_klaspad->edit_descripting();	
    //$this->session->set_flashdata('message', 'Add successfully');	
?>
   <script>
   parent.window.hs.getExpander().close();
   parent.location.reload();
   </script>
	<?php	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}	
	
	
		
public function add_powerpoint_exercise()
	{
		//include ("config.php");
	$this->load->model('klaspad/klaspad');
	//$_SESSION['tid']='';
	$courselist=$this->model_klaspad_klaspad->courses_list_new();
	$this->data['courseid']=$courselist['id'];
	$this->data['coursename']=$courselist['coursename'];
	$modulelist=$this->model_klaspad_klaspad->modules_list_new();	
	$this->data['moduleid']=$modulelist['id'];
	$this->data['modulename']=$modulelist['modulename'];
	$this->data['topicslistlist'] = array();	
	$topicslistlist=$this->model_klaspad_klaspad->topics_list_list_new_new();
	foreach($topicslistlist as $result)
				{
					$this->data['topicslistlist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
									}
	$this->data['topiclist'] = array();										
	$topiclist=$this->model_klaspad_klaspad->topics_list();	
		
	foreach($topiclist as $result)
				{
					$this->data['topiclist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
				}	
			
	if(isset($this->session->data['userid'])){	
	if(@$_GET['resourceid']){
	$record=$this->model_klaspad_klaspad->resource_record();
	$this->data['id']=$record['id'];	
	$this->data['topic_id']=$record['topic_id'];	
	$this->data['uploadimage']=$record['uploadimage'];
	$this->data['description']=$record['description'];
	$this->data['learningoutcomes']=$record['learningoutcomes'];
	$this->data['excercises_video']=$record['excercises_video'];
	$this->data['excercises_audio']=$record['excercises_audio'];
	$this->data['excercises_youtube']=$record['excercises_youtube'];
	$this->data['rssfeedlink']=$record['rssfeedlink'];
	$this->data['excercises_embed']=$record['excercises_embed'];
	$this->data['host']=DB_HOSTNAME;	
	$this->data['username']=DB_USERNAME;	
	$this->data['password']=DB_PASSWORD;	
	$this->data['database']=DB_DATABASE;	
	$this->id       = 'content';
	$this->template = 'klaspad/edit_powerpoint_exercise.php';
	$this->render();	
		}else{
	$this->data['host']=DB_HOSTNAME;	
	$this->data['username']=DB_USERNAME;	
	$this->data['password']=DB_PASSWORD;	
	$this->data['database']=DB_DATABASE;	
	$this->id       = 'content';
	$this->template = 'klaspad/add_powerpoint_exercise.php';
	$this->render();	
	}	
	
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}	
	
public function insert_pdf_excercises(){
	$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){		
	$record=$this->model_klaspad_klaspad->insert_pdf_excercises();
    //$this->session->set_flashdata('message', 'Excercise added successfully');
	header("Location:".$record);
	?>
   <script>
   //parent.window.hs.getExpander().close();
   //parent.location.reload();
   </script>
	<?php
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 		
	}
public function update_pdf_excercises(){
	$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){		
	$record=$this->model_klaspad_klaspad->update_pdf_excercises();
	header("Location:".$record);
    ?>
   <script>
   //parent.window.hs.getExpander().close();
   //parent.location.reload();
   </script>
	<?php
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 		
	}	
	
public function add_files()
	{
	$this->load->model('klaspad/klaspad');
	$courselist=$this->model_klaspad_klaspad->courses_list_new();
	$this->data['courseid']=$courselist['id'];
	$this->data['coursename']=$courselist['coursename'];
	$modulelist=$this->model_klaspad_klaspad->modules_list_new();	
	$this->data['moduleid']=$modulelist['id'];
	$this->data['modulename']=$modulelist['modulename'];
	$this->data['topicslistlist'] = array();	
	$topicslistlist=$this->model_klaspad_klaspad->topics_list_list_new_new();
	foreach($topicslistlist as $result)
				{
					$this->data['topicslistlist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
									}
	$this->data['topiclist'] = array();										
	$topiclist=$this->model_klaspad_klaspad->topics_list();	
		
	foreach($topiclist as $result)
				{
					$this->data['topiclist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
				}	
	if(isset($this->session->data['userid'])){	
	if(@$_GET['resourceid']){
	$record=$this->model_klaspad_klaspad->resource_record();
	//echo '<pre>';
	//print_r($record);
	$this->data['id']=$record['id'];	
	$this->data['topic_id']=$record['topic_id'];	
	$this->data['uploadimage']=$record['uploadimage'];
	$this->data['description']=$record['description'];
	$this->data['learningoutcomes']=$record['learningoutcomes'];
	$this->data['excercises_video']=$record['excercises_video'];
	$this->data['excercises_audio']=$record['excercises_audio'];
	$this->data['excercises_youtube']=$record['excercises_youtube'];
	$this->data['rssfeedlink']=$record['rssfeedlink'];
	$this->data['excercises_embed']=$record['excercises_embed'];
	$this->id       = 'content';
	$this->template = 'klaspad/edit_files.php';
	$this->render();	
		}else{
	$this->id       = 'content';
	$this->template = 'klaspad/add_files.php';
	$this->render();		
	}
	
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
	
public function insert_files_excercises(){
	$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){	
	$record=$this->model_klaspad_klaspad->insert_files_excercises();
    //$this->session->set_flashdata('message', 'Excercise added successfully');
	header("Location:".$record);
	?>
   <script>
   //parent.window.hs.getExpander().close();
   //parent.location.reload();
   </script>
	<?php
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 		
	}
public function update_files_excercises(){
	$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){	
	$record=$this->model_klaspad_klaspad->update_files_excercises();
    //$this->session->set_flashdata('message', 'Excercise added successfully');
	if($record!=''){
	header("Location:".$record);	
	}else{
	?>
   <script>
   parent.window.hs.getExpander().close();
   parent.location.reload();
   </script>
	<?php }
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 		
	}	
public function add_video()
	{
	$this->load->model('klaspad/klaspad');
	$courselist=$this->model_klaspad_klaspad->courses_list_new();
	$this->data['courseid']=$courselist['id'];
	$this->data['coursename']=$courselist['coursename'];
	$modulelist=$this->model_klaspad_klaspad->modules_list_new();	
	$this->data['moduleid']=$modulelist['id'];
	$this->data['modulename']=$modulelist['modulename'];
	$this->data['topicslistlist'] = array();	
	$topicslistlist=$this->model_klaspad_klaspad->topics_list_list_new_new();
	foreach($topicslistlist as $result)
				{
					$this->data['topicslistlist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
									}
	$this->data['topiclist'] = array();										
	$topiclist=$this->model_klaspad_klaspad->topics_list();	
		
	foreach($topiclist as $result)
				{
					$this->data['topiclist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
				}	
	if(isset($this->session->data['userid'])){
	if(@$_GET['resourceid']){
	$record=$this->model_klaspad_klaspad->resource_record();
	//echo '<pre>';
	//print_r($record);
	$this->data['id']=$record['id'];	
	$this->data['topic_id']=$record['topic_id'];	
	$this->data['uploadimage']=$record['uploadimage'];
	$this->data['description']=$record['description'];
	$this->data['learningoutcomes']=$record['learningoutcomes'];
	$this->data['excercises_video']=$record['excercises_video'];
	$this->data['excercises_audio']=$record['excercises_audio'];
	$this->data['excercises_youtube']=$record['excercises_youtube'];
	$this->data['rssfeedlink']=$record['rssfeedlink'];
	$this->data['excercises_embed']=$record['excercises_embed'];
	$this->id       = 'content';
	$this->template = 'klaspad/edit_videos.php';
	$this->render();	
		}else{
	$this->id       = 'content';
	$this->template = 'klaspad/add_videos.php';
	$this->render();		
	}	
		
	//$this->load->view('excercises/add_video',$data);	
		}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
public function insert_audio_video_excercises(){
$colq=mysql_query("select * from collegedata");
	$cols=mysql_fetch_array($colq);	
$script = HTTP_SERVER;
	$time=time();
	if(isset($this->session->data['userid'])){
if(urldecode($_GET['type'])=='Add Video'){
if(isset($_FILES['pdf_files_only']['tmp_name'])){
//Start
$ffmpeg='C:\\ffmpeg\\bin\\ffmpeg';
$videoFile=$_FILES['pdf_files_only']['tmp_name'];
$imageFile="klaspad/uploads/".$this->session->data['campusid']."/".time().".jpg";
$size="400x400";
$getFromSecond=0;
$cmd="$ffmpeg -i $videoFile -an -ss $getFromSecond -s $size $imageFile";
//echo "$ffmpeg -i $videoFile -an -ss $getFromSecond -s $size $imageFile";
shell_exec($cmd);
$imageFile='klaspad/'.$imageFile;
//End		
}}
	
//STYart
if(urldecode($_GET['type'])=='Add Video'){
	$_POST['exerciestype']='Add Video';
	}else{
	$_POST['exerciestype']='Add Audio';
	}
	$s=mysql_query('select m.course_id as course_id from e_'.$this->session->data['campusid'].'_edu_modules as m inner join e_'.$this->session->data['campusid'].'_edu_topics as t on t.module_id = m.id inner join e_'.$this->session->data['campusid'].'_edu_headings as h on h.topic_id = t.id where h.id="'.$_POST['topic_id'].'"');
	$course=mysql_fetch_array($s);
	$course_id=$course['course_id'];
	
	if(move_uploaded_file($_FILES["pdf_files_only"]["tmp_name"], "klaspad/uploads/".$this->session->data['campusid']."/".$course['course_id']."/ppt/".$time.$_FILES['pdf_files_only']['name'])){
	$name=$time.$_FILES['pdf_files_only']['name'];
	
	}else{
	$name='';	
	
		}
if(urldecode($_GET['type'])=='Add Video'){
mysql_query("insert into e_".$this->session->data['campusid']."_edu_excercises set excercises_embed='".addslashes($_POST['excercises_embed'])."', excercises_youtube='".addslashes($_POST['excercises_youtube'])."', rssfeedlink='".addslashes($_POST['rssfeedlink'])."', excercises_video='".$name."', excercisename='".$_POST['excercisename']."', video_icon='".$imageFile."', conversationtopic='".$_POST['conversationtopic']."', description='".addslashes($_POST['description'])."', learningoutcomes='".addslashes($_POST['learningoutcomes'])."', notice='".$_POST['notice']."', topic_id='".$_POST['topic_id']."'");
$insertid=mysql_insert_id();
$filepathimage="klaspad/uploads/".$this->session->data['campusid']."/".$course['course_id']."/ppt/".$time.$_FILES['pdf_files_only']['name'];



$q11=mysql_query("select headingtype, publicid from e_".$this->session->data['campusid']."_edu_headings where id='".$_POST['topic_id']."' ");
$s11=mysql_fetch_array($q11);

$vv= $script."/cloudfiles/resourcevideoupload.php?campus=".$this->session->data['campusid']."&id=".$course_id."&filepathimage=".$filepathimage."&filename=".$name."&resid=".$insertid."&collegeId=".$cols['collegeId'];

}else{
mysql_query("insert into e_".$this->session->data['campusid']."_edu_excercises set  rssfeedlink='".addslashes($_POST['rssfeedlink'])."', excercises_audio='".$name."', excercisename='".$_POST['excercisename']."', conversationtopic='".$_POST['conversationtopic']."', description='".addslashes($_POST['description'])."', learningoutcomes='".addslashes($_POST['learningoutcomes'])."', notice='".$_POST['notice']."', topic_id='".$_POST['topic_id']."'");	
}
if($name!=''){
header("Location:".$vv);
}else{
	?>
   <script>
   parent.window.hs.getExpander().close();
   parent.location.reload();
   </script>
	<?php
}
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 		
	}	
					
public function update_audio_video_excercises(){
$colq=mysql_query("select * from collegedata");
	$cols=mysql_fetch_array($colq);		
$script = HTTP_SERVER;
	$time=time();
	if(isset($this->session->data['userid'])){
if(urldecode($_GET['type'])=='Add Video'){
if(isset($_FILES['pdf_files_only']['tmp_name'])){
//Start
$ffmpeg='C:\\ffmpeg\\bin\\ffmpeg';
$videoFile=$_FILES['pdf_files_only']['tmp_name'];
$imageFile="klaspad/uploads/".$this->session->data['campusid']."/".time().".jpg";
$size="400x400";
$getFromSecond=0;
$cmd="$ffmpeg -i $videoFile -an -ss $getFromSecond -s $size $imageFile";
//echo "$ffmpeg -i $videoFile -an -ss $getFromSecond -s $size $imageFile";
shell_exec($cmd);
$imageFile='klaspad/'.$imageFile;
//End		
}
}
	
//STYart
if(urldecode($_GET['type'])=='Add Video'){
	$_POST['exerciestype']='Add Video';
	}else{
	$_POST['exerciestype']='Add Audio';
	}
	$s=mysql_query('select course_id from e_'.$this->session->data['campusid'].'_edu_modules where id="'.$_GET['moduleid'].'"');
	$course=mysql_fetch_array($s);
	$course_id=$course['course_id'];
	
	if(move_uploaded_file($_FILES["pdf_files_only"]["tmp_name"], "klaspad/uploads/".$this->session->data['campusid']."/".$course['course_id']."/ppt/".$time.$_FILES['pdf_files_only']['name'])){
	$name=$time.$_FILES['pdf_files_only']['name'];
	}else{
	$name='';	
		}
if(urldecode($_GET['type'])=='Add Video'){
if($name!=''){	
mysql_query("update e_".$this->session->data['campusid']."_edu_excercises set excercises_embed='".addslashes($_POST['excercises_embed'])."', excercises_youtube='".addslashes($_POST['excercises_youtube'])."', rssfeedlink='".addslashes($_POST['rssfeedlink'])."', excercises_video='".$name."', video_icon='".$imageFile."', description='".addslashes($_POST['description'])."', learningoutcomes='".addslashes($_POST['learningoutcomes'])."'  where id='".$_GET['resourceid']."' ");
$insertid=$_GET['resourceid'];
$filepathimage="klaspad/uploads/".$this->session->data['campusid']."/".$course['course_id']."/ppt/".$time.$_FILES['pdf_files_only']['name'];

}else{
mysql_query("update e_".$this->session->data['campusid']."_edu_excercises set excercises_embed='".addslashes($_POST['excercises_embed'])."', excercises_youtube='".addslashes($_POST['excercises_youtube'])."', rssfeedlink='".addslashes($_POST['rssfeedlink'])."', description='".addslashes($_POST['description'])."', learningoutcomes='".addslashes($_POST['learningoutcomes'])."'  where id='".$_GET['resourceid']."' ");	
$insertid=$_GET['resourceid'];
$filepathimage="klaspad/uploads/".$this->session->data['campusid']."/".$course['course_id']."/ppt/".$time.$_FILES['pdf_files_only']['name'];


}

$qq=mysql_query("select topic_id, publicid from e_".$this->session->data['campusid']."_edu_excercises where id='".$_GET['resourceid']."'");
$ss=mysql_fetch_array($qq);
$q11=mysql_query("select headingtype, publicid from e_".$this->session->data['campusid']."_edu_headings where id='".$ss['topic_id']."' ");
$s11=mysql_fetch_array($q11);
$publicid=$ss['publicid'];


if($name!=''){	

$vv= $script."/cloudfiles/resourcevideoupload.php?campus=".$this->session->data['campusid']."&id=".$course_id."&filepathimage=".$filepathimage."&filename=".$name."&resid=".$insertid."&collegeId=".$cols['collegeId'];
}else{
$vv= $script."/cloudfiles/resourcevideoupload.php?campus=".$this->session->data['campusid']."&id=".$course_id."&filepathimage=".$filepathimage."&filename=".$name."&resid=".$insertid."&collegeId=".$cols['collegeId'];

}



}else{
if($name!=''){		
mysql_query("update e_".$this->session->data['campusid']."_edu_excercises set  rssfeedlink='".addslashes($_POST['rssfeedlink'])."', excercises_audio='".$name."', description='".addslashes($_POST['description'])."', learningoutcomes='".addslashes($_POST['learningoutcomes'])."' where id='".$_GET['resourceid']."' ");
	
}else{
mysql_query("update e_".$this->session->data['campusid']."_edu_excercises set  rssfeedlink='".addslashes($_POST['rssfeedlink'])."', description='".addslashes($_POST['description'])."', learningoutcomes='".addslashes($_POST['learningoutcomes'])."' where id='".$_GET['resourceid']."' ");		
}
}
	if($name!=''){
header("Location:".$vv);
}else{
	?>
   <script>
   parent.window.hs.getExpander().close();
   parent.location.reload();
   </script>
	<?php
}
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 		
	}
	
public function my_research(){
	$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){	
	$gumm=$this->model_klaspad_klaspad->board_gumm();
	$this->data['gumm'] = array();	
	foreach($gumm as $gumm)
				{
			$this->data['gumm'][]=array(		
			'gummid' => @$gumm['gummid'],
            'title' => @$gumm['title'],
            'comment' => @$gumm['comment'],
            'gummurl' => @$gumm['gummurl'],
            'is_video' => @$gumm['is_video'],
            'txtmsg' => @$gumm['txtmsg'],
            'boardname' => @$gumm['boardname'],
            'userid' => @$gumm['userid'],
            'createddate' => @$gumm['createddate'],
            'modifieddate' => @$gumm['modifieddate'],
            'plaintext' => @$gumm['plaintext'],
            'YourReference' => @$gumm['YourReference'],
            'author' => @$gumm['author'],
            'totallike' => @$gumm['totallike'],
            'gummiturl' => @$gumm['gummiturl'],
            'totalcomments' => @$gumm['totalcomments'],
            'totalgummit' => @$gumm['totalgummit'],
            'topic_name' => @$gumm['topic_name'],
            'note' => @$gumm['note'],
            'description' => @$gumm['description'],
            'boarduserid' => @$gumm['boarduserid'],
            'status' => @$gumm['status'],
            'webcurrenturl' => @$gumm['webcurrenturl']
			);
				}
	$notes=$this->model_klaspad_klaspad->board_notes();
	$this->data['notes'] = array();	
	foreach($notes as $notes)
				{
			$this->data['notes'][]=array(
			'id' => @$notes['id'],
            'board_id' => @$notes['board_id'],
            'note_description' => @$notes['note_description'],
            'createddate' => @$notes['createddate']
			);
				}
	//echo '<pre>';
	//print_r($notes);
	
	$this->id       = 'content';
	$this->template = 'klaspad/my_research.php';
	$this->render();
	//$this->load->view('exercisedashboard/my_research',$data);	
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	}}	
public function show()
	{
	$this->id       = 'content';
	$this->template = 'klaspad/show.php';
	$this->render();
	//$this->load->view('welcome/show');
	}
	
	public function show2()
	{
	$this->id       = 'content';
	$this->template = 'klaspad/show2.php';
	$this->render();
	//$this->load->view('welcome/show2');
	}
	
	public function show3()
	{
	$this->id       = 'content';
	$this->template = 'klaspad/show3.php';
	$this->render();
	//$this->load->view('welcome/show3');
	}
	
	public function show4()
	{
	$this->id       = 'content';
	$this->template = 'klaspad/show4.php';
	$this->render();
	//$this->load->view('welcome/show4');
	}
	
	public function saveresult(){
		
	$this->load->model('klaspad/klaspad');	
	$this->model_klaspad_klaspad->saveresult();
    //$this->session->set_flashdata('message', 'Result saved');
	if(($this->session->data['assesseeid']!='') && ($this->session->data['assesseeid']!=0)){
		$moduleid=$_POST['module_id'];
		$topicid=$_POST['topic_id'];
		$courseid=$_POST['courseid'];
		$resourceid=$_POST['resourceid'];
		$headingid=$_POST['newheadingid'];
		$remainid=$_POST['remainid'];
		
		if($_POST['timestop']!='stop'){
		$timeleft=$_POST['timeleft'];
		}else{
		$timeleft='0';	
		}
		
		
		
		
		
		if($headingid!=''){
			
			if($timeleft!='0'){
			
			$this->redirect($this->url->https('klaspad/klaspad/module_activity&moduleid='.$moduleid.'&topicid='.$topicid.'&headingid='.$headingid.'&courseid='.$courseid.'&resourceid='.$resourceid.'&remainid='.$remainid.'&timeleft='.$timeleft));
			}else{
		$this->redirect($this->url->https('klaspad/klaspad/asseessfinish'));	
			}
		}else{
			
		$this->redirect($this->url->https('klaspad/klaspad/asseessfinish'));	
		}
		
	
	
	}else{
	
	$this->redirect($_SERVER['HTTP_REFERER']);
	}
	}
	
	
	public function asseessfinish(){
	
$this->template='klaspad/assess_complete.php';
		$this->render();	
	
}
	
	
	
	
	
	
	
	public function saveresult_dd(){
	$this->load->model('klaspad/klaspad');	
	$this->model_klaspad_klaspad->saveresult_dd();
    //$this->session->set_flashdata('message', 'Result saved');	
	$this->redirect($_SERVER['HTTP_REFERER']);
	}
	public function saveresult_truefalse(){
	$this->load->model('klaspad/klaspad');	
	$this->model_klaspad_klaspad->saveresult_truefalse();
    //$this->session->set_flashdata('message', 'Result saved');	
	$this->redirect($_SERVER['HTTP_REFERER']);
	}
	

	
	public function mobile_course_data()
	{
		$this->load->model('klaspad/klaspad');
	$alldata=$this->model_klaspad_klaspad->mobile_course_data();	
	$alldatafeature=$this->model_klaspad_klaspad->mobile_course_data_feature();	
	$count=$this->model_klaspad_klaspad->mobile_course_data_count();
	$alldataaa = array();
	$alldatafeatureaa = array();
	if(isset($_POST['connectionid'])){
		
		
	foreach($alldata as $all){
$q=mysql_query("select * from e_".$_POST['connectionid']."_edu_user where id='1'");
$s=mysql_fetch_array($q);
$aid=explode(',',$s['course_name']);
$pid=explode(',',$s['universityname']);
if(in_array($all->id,$aid)){
$position='Approved';	
}else if(in_array($all->id,$pid)){
$position='Pending';	
}else{
$position='Fresh';	
}
$q=mysql_query("select description, learningoutcomes from e_".$all['campus_id']."_edu_courses where id='".$all['id']."'");
		$s=mysql_fetch_array($q);
$module=$this->model_klaspad_klaspad->allmoduledatacoursewise($all['id'],$all['campus_id']);
	$mod=array();
	foreach($module as $mm){
$q=mysql_query("select studentID, staffID from user where userid='".$_POST['userid']."'");	
	$s=mysql_fetch_array($q);
	if($s['studentID']!='' && $s['studentID']!=0){
		$mn=1;
		//echo "select * from studenttopics where moduleid='".$mm['id']."' and studentid='".$s['studentID']."'";
	$q1=mysql_query("select * from studenttopics where moduleid='".$mm['id']."' and studentid='".$s['studentID']."'");
		while($s1=mysql_fetch_array($q1)){
		if($mn==1){
		$stdid=	$s1['topicid'];
		}else{
		$stdid=	$stdid.','.$s1['topicid'];	
		}
		$mn++;}
		$tp=" and id in (".$stdid.")";
	}else{
		$tp='';
	}
$t=$this->db->query("select * from e_".$_POST['connectionid']."_edu_topics where module_id='".$mm['id']."' ".$tp." order by shortorder");
$topic=$t->rows;
	$top=array();
	foreach($topic as $tp){
		
 $top[]=array(
 'id' => @$tp['id'],
 'topicname' => @$tp['topicname']
 );	
	}		
 $mod[]=array(
 'id' => @$mm['id'],
 'modulename' => @$mm['modulename'],
 'topic' =>$top
 );		
	}
	$this->data['alldata'][]=array('connectionid' => $all['campus_id'],
			'position' => $position, 
			'coursename' => $all['coursename'],
            'imageupload' => $all['imageupload'],
            'description' => $s['description'],
            'learningoutcomes' => $s['learningoutcomes'],
            'courseid' => $all['id'],
			'module'=>$mod
            );
	}		
	$status=array('data'=>$this->data['alldata'],'count'=>$count);
	}else{
	foreach($alldata as $all){
		$q=mysql_query("select description, learningoutcomes from e_".$all['campus_id']."_edu_courses where id='".$all['id']."'");
		$s=mysql_fetch_array($q);
		$module=$this->model_klaspad_klaspad->allmoduledatacoursewise($all['id'],$all['campus_id']);
	$mod=array();
	foreach($module as $mm){
 $mod[]=array(
 'id' => @$mm['id'],
 'modulename' => @$mm['modulename']
 );	
	}
	$alldataaa[]=array('connectionid' => $all['campus_id'],
			'coursename' => $all['coursename'],
            'imageupload' => $all['imageupload'],
            'description' => $s['description'],
            'learningoutcomes' => $s['learningoutcomes'],
            'courseid' => $all['id'],
			'module'=>$mod
            );
	}
	foreach($alldatafeature as $allf){
	$q1=mysql_query("select description, learningoutcomes from e_".$allf['campus_id']."_edu_courses where id='".$allf['id']."'");
		$s1=mysql_fetch_array($q1);	
	$alldatafeatureaa[]=array('connectionid' => $allf['campus_id'],
			'coursename' => $allf['coursename'],
            'imageupload' => $allf['imageupload'],
            'description' => $s1['description'],
            'learningoutcomes' => $s1['learningoutcomes'],
            'courseid' => $allf['id']
            );
	}
			
		
	$status=array('data'=>@$alldataaa,'featuredata'=>$alldatafeatureaa,'count'=>$count);	
	}
	echo json_encode($status);
	exit;
	}
		

public function mobile_login()
	{
	$this->load->model('klaspad/klaspad');
	if(@$_GET['username']!=''){
		$_POST['username']=$_GET['username'];
	}
	if(@$_GET['password']!=''){
		$_POST['password']=str_replace('$$','#',$_GET['password']);
	}
	$count=$this->model_klaspad_klaspad->login();
	
	//echo '<pre>';
	//print_r($count);
	//die;
	if($count[2]['studentID']!=0 || $count[2]['staffID']!=0){
	if($count[2]['studentID']!=0){
	$sq=mysql_query("select status, preukid, flag from student where preukid ='".$count[2]['studentID']."'");
	$ssq=mysql_fetch_array($sq);
	if(($ssq['status']=='Enrolled' || $ssq['status']=='Demo Enrolled') && $ssq['flag']==1){		
	if($count[0]>0){
	mysql_query("insert into edu_login set connectionid='".$count[1]['connectid']."', user_id='".$count[1]['id']."', logintime=now()");
	$this->session->data['id']=session_id();
	$this->session->data['userid']=$count[2]['userid'];
	$this->db->query("insert into `logindetails` 
				SET 
				    userid='" . $this->session->data['userid']. "',
				 	sessionid='".$this->session->data['id']."',
					ipaddress='".@$_POST['ipaddress']."',
				    logindate=now()
		");
	$status=array('data'=>@$count[1],'status'=>'true','studentid'=>$ssq['preukid'],'studentstatus'=>$ssq['status'],'sessionid'=>$this->session->data['id']);
    echo json_encode($status);
	}else{
	$message='Username/Password Is Incorrect';	
	$status=array('data'=>'no data','status'=>'false','message'=>$message);		
    echo json_encode($status);
	}
	}else{
	$message='Username/Password Is Incorrect';	
	$status=array('data'=>'no data','status'=>'false','message'=>$message);		
    echo json_encode($status);
	}
	}
	
	if($count[2]['staffID']!=0){
	$sq=mysql_query("select status, staffid from staff where staffid ='".$count[2]['staffID']."'");
	$ssq=mysql_fetch_array($sq);
	if($ssq['status']=='Employed'){		
	if($count[0]>0){
	mysql_query("insert into edu_login set connectionid='".$count[1]['connectid']."', user_id='".$count[1]['id']."', logintime=now()");
	$status=array('data'=>@$count[1],'status'=>'true','studentid'=>$ssq['preukid'],'studentstatus'=>$ssq['status']);
    echo json_encode($status);
	}else{
	$message='Username/Password Is Incorrect';	
	$status=array('data'=>'no data','status'=>'false','message'=>$message);		
    echo json_encode($status);
	}
	}else{
	$message='Username/Password Is Incorrect';	
	$status=array('data'=>'no data','status'=>'false','message'=>$message);		
    echo json_encode($status);
	}
	}
	}else{
	$message='You are not an authorised user';	
	$status=array('data'=>'no data','status'=>'false','message'=>$message);		
    echo json_encode($status);
	}
exit;
	}
public function mail_attachment($filename, $path, $mailto, $ccto, $bccto, $from_mail, $from_name, $replyto, $subject, $message,$aaa) {
if($aaa==1){
include ('Mail/mime.php'); 
include "Mail.php";
}
//echo 'Test '.$mailto.'<br />';
$sts=mysql_query('select * from smtp_email'); 
$skts=mysql_fetch_array($sts);

$password=$skts['emailpassword'];
$sender=$skts['sender'];
$host=$skts['serversmtp'];


$file = $path.$filename;

$headers = array ('From' => @$sender,'To' => @$mailto, 'Subject' => @$subject); 
 $mime = new Mail_mime("\n");
$mime->addCc($ccto);
$mime->addBcc($bccto);
$mime->setHTMLBody($message);
$mime->addAttachment($file, 'text/plain');

$body = $mime->get();
$headers = $mime->headers($headers);
 
    $smtp_params = array(
        'host' => $host,
        'auth' => true,
        'username' => $sender,
        'password' => $password,
        'timeout' => 20,
        'localhost' => $_SERVER['SERVER_NAME'],
    ); // end $smtp_params
    $smtp = Mail::factory('smtp', $smtp_params);


if(($ccto=='')&&($bccto=='')){
   $recipients = $mailto;
}elseif($bccto==''){
$mailto=explode(',',$mailto);
$ccto=explode(',',$ccto);	
  $recipients = array_merge($mailto, $ccto);
}elseif($ccto==''){
$mailto=explode(',',$mailto);
$bccto=explode(',',$bccto);	
  $recipients = array_merge($mailto, $bccto);
}else{
$mailto=explode(',',$mailto);
$ccto=explode(',',$ccto);
$bccto=explode(',',$bccto);	
  $recipients = array_merge($mailto, $ccto, $bccto);
}




   $mail = $smtp->send($recipients, $headers, $body);



		//$this->getForm();
   
}
public function forgotpassword(){
	$this->load->model('klaspad/klaspad');
	$random= ""; 
         srand((double)microtime()*1000000);             
            $data = "AbcDE123IJKLMN67QRSTUVWXYZ";        
            $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";        
            $data .= "0FGH45OP89";               
             for($i = 0; $i < 7; $i++)        {       
              $random .= substr($data, (rand()%(strlen($data))), 1);    
             }
$passd=$random.'temppass';

if($_POST['studentstaff']=='student'){
$uu=mysql_query('select userid, studentID, username, password from user where username="'.$_POST['emailid'].'"');
$mm=mysql_fetch_array($uu);
$numrows=mysql_num_rows($uu);
$uuuu=mysql_query('select flag  from arch_email2 where studentid="'.$mm['studentID'].'"');
$mmmm=mysql_fetch_array($uuuu);
$uuu=mysql_query('select history'.$mmmm['flag'].' as emailid from arch_email2 where studentid="'.$mm['studentID'].'"');
$mmm=mysql_fetch_array($uuu);
$sendemail = $mmm['emailid'];
//$passd='studenttemppass';
	}else if($_POST['studentstaff']=='staff'){
$uu=mysql_query('select userid, staffID, username, password from user where username="'.$_POST['emailid'].'"');
$mm=mysql_fetch_array($uu);
$numrows=mysql_num_rows($uu);
$uuu=mysql_query('select email, personalemail from staff where staffid="'.$mm['staffID'].'"');
$mmm=mysql_fetch_array($uuu);
	
if($mmm['email']){
	$sendemail = $mmm['email'];
	}else{
	$sendemail = $mmm['personalemail'];
		}		
//$passd='stafftemppass';		
		}

if($numrows>0){
mysql_query("update user set password='".$passd."' where userid='".$mm['userid']."'");
mysql_query("update e_10_edu_user set password='".$passd."' where id='".$mm['userid']."'");	
$ss=mysql_query('select collegeName, collegeemail, adminemail from collegedata');
$ll=mysql_fetch_array($ss);

if($ll['collegeemail']!=''){
$email = $ll['collegeemail'];	
	}else{
$email = $ll['adminemail'];			
		}
// multiple recipients
$from = $email ;
$reply = 'This is an auto generated mail. Do not reply to this mail !' ;			
$my_file = '';
$my_path = '';
$my_name = 'Admin';
$my_mail = $from;
$my_replyto = $reply;

$my_subject = "Password Recovery From ".@$college['collegeName '];;
$my_message ='<html>
<head>
  <title>password recovery</title>
</head>
<body>
  <table>
  <tr><td colspan="2">Dear User,<br /><br /></td></tr>
    <tr><td colspan="2">Your username and password are given below : <br /><br /></td></tr>
    <tr>
      <td>Username </td><td>'.$mm['username'].'</td>
    </tr>
    <tr>
      <td>Password </td><td>'.$passd.'<br /><br /></td>
    </tr>
    <tr>
      <td colspan="2">Have a good day, <br><br>Support Team <br><br>Elm Education<br><br><br></td>
    </tr>
	<tr><td colspan="2"><img width="150" height="55" src="http://www.collegeadministrator.org/elm/uploaded/collegedocuments/photo/elmlogo.png"><br /><br /><img src="http://www.collegeadministrator.org/elm/image/green.jpg" /><br /><br />
Legal Disclaimer<br /><br />

Internet communications are not secure and therefore Elm Education does not accept legal responsibility for the contents of this message.Although Elm Education operates anti-virus programmes , it does not accept responsibility for any damage whatsoever that is caused by viruses being passed. Any views or opinions presented are solely those of the author and do not necessarily represent those of Elm Education.<br /><br />
<span style="font-size:9px;">Elm Education is the trading name of The Elm Corporate Ltd, a company registered with The Companies House of England and Wales under company number 07619554</span></td></tr>
  </table>
</body>
</html>';
//echo $_POST['toId'].'<br />';
$toemail = strtolower($sendemail);			
$aaa=1;
$this->mail_attachment($my_file, $my_path, $toemail, '', '', $my_mail, $my_name, $my_replyto, $my_subject, $my_message,$aaa); 
			
	$status=array('status'=>'An email has been sent to you with your details.');


}else{
				$status=array('status'=>'Username does not exist');
	}
	

	echo json_encode($status);
	exit;
}

function change_password()
	{
//echo "update user set password='".$_POST['password']."'  where userid='".$this->session->data['userid']."' ";
//die;
    $query = $this->db->query("update user set password='".$_POST['password']."'  where userid='".$_POST['userid']."' ");
	$q=mysql_query("select studentID, staffID, agentId, managerID from user where userid='".$_POST['userid']."'");
	$s=mysql_fetch_array($q);
	if($s['studentID']!=0 || $s['staffID']!=0){
	$query = $this->db->query("update e_10_edu_user set password='".$_POST['password']."'  where id='".$_POST['userid']."' ");
	
} 
$this->redirect($this->url->https('klaspad/klaspad/mobile_login&username='.$_POST['username'].'&password='.str_replace('#','$$',$_POST['password'])));


	}	


public function all_resource_new(){
		if(!isset($_POST['connectionid'])){
		$_POST['connectionid']=10;
		$_POST['id']=43;
			}
		//echo "select campusName as connectionid from course where new_id='".$_POST['id']."'";	
		$str='';
		$q=mysql_query("select campusName as connectionid from course where new_id='".$_POST['id']."'");
		$s=mysql_fetch_array($q);
		if(isset($_POST['id'])){
		$str.=" and cc.id='".$_POST['id']."'";
		}
		if(isset($_POST['resourceid'])){
		$str.=" and ee.id='".$_POST['resourceid']."'";
		}
		if(isset($_POST['moduleid'])){
		$str.=" and mm.id='".$_POST['moduleid']."'";
		}
		if(isset($_POST['topicid'])){
		$str.=" and tt.id='".$_POST['topicid']."'";
		}
		$query=$this->db->query("select ee.conversationtopic, cc.coursename,ee.video_icon,ee.question ,ea.id as favid, cc.description as course_description, cc.learningoutcomes as course_learningoutcomes,  eh.headingname, eh.rssfeedlink, ee.rssfeedlink as excercise_rssfeedlink, ee.excercises_video ,cc.id as course_id,  ee.excercises_youtube, ee.id as resourceid,  ee.description, ee.learningoutcomes, ee.notice, ee.upload_folder, ee.uploadimage, ee.excercisename,ee.excercises_embed, ee.excercises_video, ee.excercises_audio, eh.exerciestype, cc.id as courseid, mm.id as moduleid, tt.id as tid from e_".$s['connectionid']."_edu_headings as eh inner join e_".$s['connectionid']."_edu_excercises as ee on ee.topic_id=eh.id left join e_".$_POST['connectionid']."_edu_fav as ea on ee.id=ea.resourceid inner join e_".$s['connectionid']."_edu_topics as tt on eh.topic_id=tt.id inner join e_".$s['connectionid']."_edu_modules as mm on mm.id=tt.module_id inner join e_".$s['connectionid']."_edu_courses as cc on cc.id=mm.course_id where (eh.exerciestype = 'Powerpoint presentation exercise' or eh.exerciestype ='Add Folder' or eh.exerciestype ='Files' or eh.exerciestype ='Add Audio' or eh.exerciestype ='Add Video') $str  order by eh.shortorder ");	
	$mm = $query->rows;	
	
	$data=array();
foreach($mm as $mms){
	$url=array();
	$path='klaspad/uploads/'.$s['connectionid'].'/'.$mms['courseid'].'/ppt/';
	$imgpath='klaspad/uploads/'.$s['connectionid'];
	if($mms['exerciestype']=='Powerpoint presentation exercise'){
if($handle = opendir('klaspad/uploads/'.$s['connectionid'].'/'.$mms['course_id'].'/ppt/'.$mms['resourceid'])) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
$url[] = 'klaspad/uploads/'.$s['connectionid'].'/'.$mms['course_id'].'/ppt/'.$mms['resourceid'].'/'.$entry;
        }
    }
    closedir($handle);
}

	}else{
$url=array();	
	}
$query1=$this->db->query('select * from e_'.$s['connectionid'].'_edu_excercises_discussion where resourceid="'.$mms['resourceid'].'"');	
$disc=$query1->rows;
$discussion=array();	
foreach($disc as $dis){
$que=$this->db->query('select ea.assignment, ea.connectionid, ea.user_id, ea.createddate from e_'.$s['connectionid'].'_edu_ans_assignment ea where ea.assignment_id="'.$dis['id'].'" order by ea.id desc');		
$mmk = $que->rows;	
$url1=array();
foreach($mmk as $mmkk){
$msq=mysql_query("select eu.user_image, eu.demo_contact_person from e_".$mmkk['connectionid']."_edu_user as eu where eu.id='".$mmkk['user_id']."'");	
$mmk1=mysql_fetch_array($msq);
$url1[] =array('comment' => $mmkk['assignment'], 
            'username' => $mmk1['demo_contact_person'],
			'createddate' => $mmkk['createddate'],
			'image' => $mmk1['user_image']
			);
}
	

$discussion[]=array('id' => $dis['id'], 
			'resid' => $dis['resourceid'],
            'topic' => $dis['question'],
			'comment'=>$url1);
}
if(isset($_POST['userid'])){
//echo "select * from e_".$s['connectionid']."_edu_notes where courseid='".$mms['resourceid']."' and userid='".$_POST['userid']."'<br />";	
$query2=$this->db->query("select * from e_".$s['connectionid']."_edu_notes where courseid='".$mms['resourceid']."' and userid='".$_POST['userid']."'");	
$not=$query2->rows;
$notes=array();	
foreach($not as $no){


$notes[]=array('id' => $no['id'], 
			'resid' => $no['courseid'],
            'userid' => $no['userid'],
			'msg'=>$no['msg']);
}

$query3=$this->db->query("select * from e_".$s['connectionid']."_edu_excercises_assignment where resourceid='".$mms['resourceid']."'");	
$assign=$query3->rows;
$assignment=array();	
foreach($assign as $ass){
$assignment[]=array('id' => $ass['id'], 
			'resid' => $ass['resourceid'],
            'topic' => $ass['question']);
}
}else{
$notes=array();	
$assignment=array();	
}
$query4=$this->db->query("select c.*, h.headingname from e_".$s['connectionid']."_edu_excercises_crossword as c left join e_".$s['connectionid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$mms['resourceid']."'");	
$crswrd=$query4->rows;
$crossword=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd as $ass1){
$crossword[]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
			'mid'=>$mms['moduleid'],
			'tid'=>$mms['tid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}

$query5=$this->db->query("select c.*, h.headingname from e_".$s['connectionid']."_edu_excercises_multiplechoice as c left join e_".$s['connectionid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$mms['resourceid']."' group by c.topic_id");	
$crswrd2=$query5->rows;
$multiple=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd2 as $ass1){
$multiple[]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'mid'=>$mms['moduleid'],
            'tid'=>$mms['tid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query6=$this->db->query("select c.*, h.headingname from e_".$s['connectionid']."_edu_excercises_fillintheblanks as c left join e_".$s['connectionid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$mms['resourceid']."' group by c.topic_id");	
$crswrd3=$query6->rows;
$fill=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd3 as $ass1){
$fill[]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'mid'=>$mms['moduleid'],
            'tid'=>$mms['tid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query7=$this->db->query("select c.*, h.headingname from e_".$s['connectionid']."_edu_excercises_descripting as c left join e_".$s['connectionid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$mms['resourceid']."' group by c.topic_id");	
$crswrd4=$query7->rows;
$descripting=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd4 as $ass1){
$descripting[]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'mid'=>$mms['moduleid'],
            'tid'=>$mms['tid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query8=$this->db->query("select c.*, h.headingname from e_".$s['connectionid']."_edu_excercises_truefalse as c left join e_".$s['connectionid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$mms['resourceid']."' group by c.topic_id");	
$tf=$query8->rows;
$truefalse=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($tf as $ass1){
$truefalse[]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'mid'=>$mms['moduleid'],
            'tid'=>$mms['tid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query9=$this->db->query("select c.*, h.headingname from e_".$s['connectionid']."_edu_excercises_draganddrop as c left join e_".$s['connectionid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$mms['resourceid']."' group by c.topic_id");	
$dd=$query9->rows;
$draganddrop=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($dd as $ass1){
$draganddrop[]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'mid'=>$mms['moduleid'],
            'tid'=>$mms['tid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
//print_r($notes);
$queee1=$this->db->query('select comment from e_'.$s['connectionid'].'_edu_conversationtopic where conversation_id="'.$mms['resourceid'].'"');
$status=$queee1->rows;
$conversationtopic_comments=array();
foreach($status as $stat){
$conversationtopic_comments[] = $stat['comment'];
}
if($mms['favid']==''){
	$mms['favid']=0;
	}else{
	
	}

	$data[]=array('conversationtopic' => $mms['conversationtopic'], 
            'coursename' => $mms['coursename'],
			'courseid' => $mms['courseid'],
            'headingname' => $mms['headingname'],
            'rssfeedlink' => $mms['rssfeedlink'],
			'references' => $mms['excercise_rssfeedlink'],
            'excercises_youtube' => $mms['excercises_youtube'],
            'excercises_video' => $mms['excercises_video'],
            'excercises_embed' => $mms['excercises_embed'],
            'resourceid' => $mms['resourceid'],
            'description' => $mms['description'],
            'learningoutcomes' => $mms['learningoutcomes'],
            'notice' => $mms['notice'],
            'upload_folder' =>  $mms['upload_folder'],
            'uploadimage' => $mms['uploadimage'],
            'excercisename' => $mms['excercisename'],
            'excercises_video' => $mms['excercises_video'],
            'excercises_audio' => $mms['excercises_audio'],
            'exerciestype' => $mms['exerciestype'],
			'course_description'=>$mms['course_description'],
			'course_learningoutcomes'=>$mms['course_learningoutcomes'],
			'video_icon'=>$mms['video_icon'],
			'topic'=>$mms['question'],
			'favid'=>$mms['favid'],
			'ppt_images'=>$url,
			'imgpath'=>$imgpath,
			'path'=>$path,
			'notes'=>$notes,
			'assignment'=>$assignment,
			'discussion'=>$discussion,
			'crossword'=>$crossword,
			'fillintheblanks'=>$fill,
			'multiplechoice'=>$multiple,
			'descripting'=>$descripting,
			'truefalse'=>$truefalse,
			'draganddrop'=>$draganddrop,
			'conversationtopic_comments'=>$conversationtopic_comments);
	}
//disucssion

		
//Discussion	
$data=array('data'=>@$data);
echo json_encode($data);
exit;	
}

public function all_fav_resource_data(){
		if(!isset($_POST['connectionid'])){
		$_POST['connectionid']=3;
		$_POST['id']=1;
		}
	if(isset($_POST['resourceid'])){
	$str=' and resourceid="'.$_POST['resourceid'].'" ';
	}else if(isset($_POST['resourcename'])){
	$qqq=mysql_query("select resourceid from e_".$_POST['connectionid']."_edu_fav where resourcename like '%".$_POST['resourcename']."%'");
	$sqqq=mysql_fetch_array($qqq);
	$str=' and resourceid="'.$sqqq['resourceid'].'" ';
	}else{
	$str='';
	}	
	$q=mysql_query("select * from e_".$_POST['connectionid']."_edu_fav where connectionid!=0 $str ");
	while($s=mysql_fetch_array($q)){
	if(isset($_POST['resourceid'])){
	$str1=" and ee.id='".$_POST['resourceid']."' ";
	}else{
	$str1=" and ee.id='".$s['resourceid']."' ";	
	}		
	$query=$this->db->query("select ee.conversationtopic, cc.coursename,ee.question, cc.id as courseid, ee.video_icon ,cc.description as course_description, cc.learningoutcomes as course_learningoutcomes, ea.id as favid,  eh.headingname, eh.rssfeedlink, ee.rssfeedlink as excercise_rssfeedlink, ee.excercises_video ,cc.id as course_id,  ee.excercises_youtube, ee.id as resourceid,  ee.description, ee.learningoutcomes, ee.notice, ee.upload_folder, ee.uploadimage, ee.excercisename,ee.excercises_embed, ee.excercises_video, ee.excercises_audio, eh.exerciestype as exerciestype from e_".$s['connectionid']."_edu_headings as eh inner join e_".$s['connectionid']."_edu_excercises as ee on ee.topic_id=eh.id inner join e_".$_POST['connectionid']."_edu_fav as ea on ee.id=ea.resourceid inner join e_".$s['connectionid']."_edu_topics as tt on eh.topic_id=tt.id inner join e_".$s['connectionid']."_edu_modules as mm on mm.id=tt.module_id inner join e_".$s['connectionid']."_edu_courses as cc on cc.id=mm.course_id where (eh.exerciestype = 'Powerpoint presentation exercise' or eh.exerciestype ='Add Folder' or eh.exerciestype ='Files' or eh.exerciestype ='Add Audio' or eh.exerciestype ='Add Video') $str1 ");
	
	$mm = $query->rows;
	//print_r($mms);
	//echo $mms->exerciestype;
	//die;	
	$url=array();
foreach($mm as $mms){
	$path='klaspad/uploads/'.$s['connectionid'].'/'.$mms['courseid'].'/ppt/';
	$imgpath='klaspad/uploads/'.$s['connectionid'];
	if($mms['exerciestype']=='Powerpoint presentation exercise'){
if($handle = opendir('klaspad/uploads/'.$s['connectionid'].'/'.$mms['course_id'].'/ppt/'.$mms['resourceid'])) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
$url[] = 'klaspad/uploads/'.$s['connectionid'].'/'.$mms['course_id'].'/ppt/'.$mms['resourceid'].'/'.$entry;
        }
		
	}
    closedir($handle);
}

	}else{
$url='';		
	}
$query1=$this->db->query('select * from e_'.$s['connectionid'].'_edu_excercises_discussion where resourceid="'.$mms['resourceid'].'"');	
$disc=$query1->rows;
$discussion=array();	
foreach($disc as $dis){
$que=$this->db->query('select ea.assignment, ea.connectionid, ea.user_id from e_'.$s['connectionid'].'_edu_ans_assignment ea where ea.assignment_id="'.$dis['id'].'" order by ea.id desc');		
$mmk = $que->rows;	
$url1=array();
foreach($mmk as $mmkk){
$msq=mysql_query("select eu.user_image, eu.demo_contact_person from e_".$mmkk['connectionid']."_edu_user as eu where eu.id='".$mmkk['user_id']."'");	
$mmk1=mysql_fetch_array($msq);
$url1[] =array('comment' => $mmkk['assignment'], 
            'username' => $mmk1['demo_contact_person'],
			'image' => $mmk1['user_image']);
}
	

$discussion[]=array('id' => $dis['id'], 
			'resid' => $dis['resourceid'],
            'topic' => $dis['question'],
			'comment'=>$url1);
}
if(isset($_POST['id'])){
$query2=$this->db->query("select * from e_".$s['connectionid']."_edu_notes where courseid='".$mms['resourceid']."' and userid='".$_POST['id']."'");	
$not=$query2->rows;
$notes=array();	
foreach($not as $no){


$notes[]=array('id' => $no['id'], 
			'resid' => $no['courseid'],
            'userid' => $no['userid'],
			'msg'=>$no['msg']);
}

$query3=$this->db->query("select * from e_".$s['connectionid']."_edu_excercises_assignment where resourceid='".$mms['resourceid']."'");	
$assign=$query3->rows;
$assignment=array();	
foreach($assign as $ass){
$assignment[]=array('id' => $ass['id'], 
			'resid' => $ass['resourceid'],
            'topic' => $ass['question']);
}
}else{
$notes=array();	
$assignment=array();	
}


$queee1=$this->db->query('select comment from e_'.$s['connectionid'].'_edu_conversationtopic where conversation_id="'.$mms['resourceid'].'"');
$status=$queee1->rows;
$conversationtopic_comments=array();
foreach($status as $stat){
$conversationtopic_comments[] = $stat['comment'];
}
if($mms['favid']==''){
	$mms['favid']=0;
	}else{
	//$mms->favid=0;
	}

	$data[]=array('conversationtopic' => $mms['conversationtopic'], 
            'coursename' => $mms['coursename'],
			'courseid' => $mms['courseid'],
            'headingname' => $mms['headingname'],
            'rssfeedlink' => $mms['rssfeedlink'],
			'references' => $mms['excercise_rssfeedlink'],
            'excercises_youtube' => $mms['excercises_youtube'],
            'excercises_video' => $mms['excercises_video'],
            'excercises_embed' => $mms['excercises_embed'],
            'resourceid' => $mms['resourceid'],
            'description' => $mms['description'],
            'learningoutcomes' => $mms['learningoutcomes'],
            'notice' => $mms['notice'],
            'upload_folder' =>  $mms['upload_folder'],
            'uploadimage' => $mms['uploadimage'],
            'excercisename' => $mms['excercisename'],
            'excercises_video' => $mms['excercises_video'],
            'excercises_audio' => $mms['excercises_audio'],
            'exerciestype' => $mms['exerciestype'],
			'course_description'=>$mms['course_description'],
			'course_learningoutcomes'=>$mms['course_learningoutcomes'],
			'video_icon'=>$mms['video_icon'],
			'topic'=>$mms['question'],
			'favid'=>$mms['favid'],
			'ppt_images'=>$url,
			'imgpath'=>$imgpath,
			'path'=>$path,
			'notes'=>$notes,
			'assignment'=>$assignment,
			'discussion'=>$discussion,
			'conversationtopic_comments'=>$conversationtopic_comments);
	}
//disucssion
	

	}
	
	
//Discussion	
$data=array('data'=>@$data);
echo json_encode($data);	
exit;
}


 public function all_user_discussion(){
		if(!isset($_POST['connectionid'])){
		$_POST['connectionid']=3;
		$_POST['id']=1;
			}

$data=array();

$qu=mysql_query("select distinct parent_connectionid as connectionid from edu_comments where connectionid='".$_POST['connectionid']."'");
while($squ=mysql_fetch_array($qu)){
$cid='';
$z=1;
//echo "select distinct assignment_id from e_".$squ['connectionid']."_edu_ans_assignment where connectionid='".$_POST['connectionid']."' ";	
$qq=mysql_query("select distinct assignment_id from e_".$squ['connectionid']."_edu_ans_assignment where connectionid='".$_POST['connectionid']."' ");
$cnt=mysql_num_rows($qq);
if($cnt>0){
while($sqq=mysql_fetch_array($qq)){
if($z==1){
	$cid=$sqq['assignment_id'];
}else{
	$cid=$cid.','.$sqq['assignment_id'];
}
$z++;	
}
}
if(isset($_POST['id'])){
	$str='';
	//$this->db->where('ea.user_id',$_POST['id']);
	}else{
	$str=" and resourceid='".$_POST['resourceid']."' ";	
	}
	//echo "select eed.*, eem.course_id from e_".$squ['connectionid']."_edu_excercises_discussion as eed inner join e_".$squ['connectionid']."_edu_topics as et on eed.topic_id=et.id inner join e_".$squ['connectionid']."_edu_modules as eem on et.module_id=eem.id where eed.id in (".$cid.") $str ";
//$names = explode(',',$cid);	
$query1=$this->db->query("select eed.*, eem.course_id from e_".$squ['connectionid']."_edu_excercises_discussion as eed inner join e_".$squ['connectionid']."_edu_topics as et on eed.topic_id=et.id inner join e_".$squ['connectionid']."_edu_modules as eem on et.module_id=eem.id where eed.id in (".$cid.") $str ");
$disc=$query1->rows;
//echo '<pre>';
//print_r($disc);
//die;
$discussion=array();	
foreach($disc as $dis){
$que=$this->db->query('select ea.id, ea.assignment, ea.connectionid, ea.createddate, ea.user_id from e_'.$squ['connectionid'].'_edu_ans_assignment ea where ea.assignment_id="'.$dis['id'].'" order by ea.id desc');		
$mmk = $que->rows;		
$url1=array();
foreach($mmk as $mmkk){
$msq=mysql_query("select eu.user_image, eu.demo_contact_person from e_".$mmkk['connectionid']."_edu_user as eu where eu.id='".$mmkk['user_id']."'");	
$mmk1=mysql_fetch_array($msq);
$url1[] =array('comment' => $mmkk['assignment'], 
            'commentid' => $mmkk['id'],
			'createddate' => $mmkk['createddate'],
			'connectionid' => $mmkk['connectionid'],
			'userid' => $mmkk['user_id'],
			'username' => $mmk1['demo_contact_person'],
			'image' => $mmk1['user_image']);
}
	

$discussion[]=array('id' => $dis['id'], 
			'courseid' => $dis['course_id'],
			'resid' => $dis['resourceid'],
			'topic' => $dis['question'],
			'comment'=>$url1);
}
	/*$data1[]=array('coursename' => $mms->coursename,
            'headingname' => $mms->headingname,
            'resourceid' => $mms->resourceid,
			'topic'=>$mms->question,
			'discussion'=>$discussion
			);*/
	//}
		
//Discussion	

}
$data=array('discussion'=>$discussion);
echo json_encode($data);	
exit;
}

public function my_course_data()
	{
	$this->load->model('klaspad/klaspad');
	$alldata1=$this->model_klaspad_klaspad->my_course_data();
	//$alldataprivate1=$this->model_klaspad_klaspad->my_course_data_private();
	$alldata=array();
	$alldataprivate=array();
	foreach($alldata1 as $ad){
		$alldata[]=array(
			'id' => $ad['id'],
            'coursename' => $ad['coursename'],
            'campus_id' => $ad['campus_id'],
            'department_id' => $ad['department_id'],
            'courseno' => $ad['courseno'],
            'courseduration' => $ad['courseduration'],
            'description' => $ad['description'],
            'learningoutcomes' =>$ad['learningoutcomes'],
            'perqualification' => $ad['perqualification'],
            'degreediplomaoffered' => $ad['degreediplomaoffered'],
            'awardingbody' => $ad['awardingbody'],
            'awardingbodycourseid' => $ad['awardingbodycourseid'],
            'qfqualcourseid' => $ad['qfqualcourseid'],
            'coursecredit' => $ad['coursecredit'],
            'imageupload' => $ad['imageupload'],
            'topic_id' => $ad['topic_id'],
            'connectionid' => $ad['connectionid'],
            'courseid' => $ad['courseid'],
            'userid' => $ad['userid'],
            'modified_date' => $ad['modified_date'],
            'access' => $ad['access'],
            'course_ref_no' => $ad['course_ref_no'],
            'feature' => $ad['feature'],
            'thumbimageupload' => $ad['thumbimageupload']
			);
	}
	$status=array('data'=>$alldata, 'dataprivate'=>$alldataprivate);
	echo json_encode($status);
	exit;
	}


 public function all_resource_new_search(){
		if(!isset($_POST['connectionid'])){
		$_POST['connectionid']=3;
		$_POST['id']=43;
			}
		//$q=mysql_query("select connectionid from edu_courses where courseid='".$_POST['id']."'");
		//$s=mysql_fetch_array($q);
	$str='';
	if(isset($_POST['exercisetype'])){
		$str.=" and eh.exerciestype='".$_POST['exercisetype']."' ";
	}
	if(isset($_POST['headingname'])){
		$str.=" and eh.headingname like '%".$_POST['headingname']."%' ";
	}	
	$query=$this->db->query("select ee.conversationtopic, cc.coursename,ee.video_icon ,ea.id as favid, cc.description as course_description, cc.learningoutcomes as course_learningoutcomes,  eh.headingname, eh.rssfeedlink, ee.rssfeedlink excercise_rssfeedlink, ee.excercises_video ,cc.id as course_id,  ee.excercises_youtube, ee.id as resourceid,  ee.description, ee.learningoutcomes, ee.notice, ee.upload_folder, ee.uploadimage, ee.excercisename,ee.excercises_embed, ee.excercises_video, ee.excercises_audio, eh.exerciestype, cc.id as courseid from e_".$_POST['connectionid']."_edu_headings as eh inner join e_".$_POST['connectionid']."_edu_excercises as ee on ee.topic_id=eh.id left join e_".$_POST['connectionid']."_edu_fav as ea on ee.id=ea.resourceid inner join e_".$_POST['connectionid']."_edu_topics as tt on eh.topic_id=tt.id inner join e_".$_POST['connectionid']."_edu_modules as mm on mm.id=tt.module_id inner join e_".$_POST['connectionid']."_edu_courses as cc on cc.id=mm.course_id where  1 $str limit ".$_POST['limit'].",20 ");
	$mm = $query->rows;
	$ccmm= count($mm);	
	$url=array();
//print_r($mm);
//die;	
foreach($mm as $mms){
	$path='klaspad/uploads/'.$_POST['connectionid'].'/'.$mms['courseid'].'/ppt/';
	$imgpath='klaspad/uploads/'.$_POST['connectionid'];
	if($mms['exerciestype']=='Powerpoint presentation exercise'){
if($handle = opendir('klaspad/uploads/'.$_POST['connectionid'].'/'.$mms['courseid'].'/ppt/'.$mms['resourceid'])) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
$url[] = 'klaspad/uploads/'.$_POST['connectionid'].'/'.$mms['courseid'].'/ppt/'.$mms['resourceid'].'/'.$entry;
        }
    }
    closedir($handle);
}

	}else{
$url='';		
	}
/*$this->db->where('conversation_id',$mms->resourceid);
$this->db->select('comment');	
$query=$this->db->get('e_'.$_POST['connectionid'].'_edu_conversationtopic');	
$status=$query->result();
$conversationtopic_comments=array();
foreach($status as $stat){
$conversationtopic_comments[] = $stat->comment;
}*/
if($mms['favid']==''){
	$mms['favid']=0;
	}else{
	$mms['favid']=0;
	}

	$data[]=array('conversationtopic' => $mms['conversationtopic'], 
            'coursename' => $mms['coursename'],
			'courseid' => $mms['courseid'],
            'headingname' => $mms['headingname'],
            'rssfeedlink' => $mms['rssfeedlink'],
            'excercises_youtube' => $mms['excercises_youtube'],
            'excercises_video' => $mms['excercises_video'],
            'excercises_embed' => $mms['excercises_embed'],
            'resourceid' => $mms['resourceid'],
            'description' => $mms['description'],
            'learningoutcomes' => $mms['learningoutcomes'],
            'notice' => $mms['notice'],
            'upload_folder' =>  $mms['upload_folder'],
            'uploadimage' => $mms['uploadimage'],
            'excercisename' => $mms['excercisename'],
            'excercises_video' => $mms['excercises_video'],
            'excercises_audio' => $mms['excercises_audio'],
            'exerciestype' => $mms['exerciestype'],
			'course_description'=>$mms['course_description'],
			'course_learningoutcomes'=>$mms['course_learningoutcomes'],
			'video_icon'=>$mms['video_icon'],
			'favid'=>$mms['favid'],
			'ppt_images'=>$url,
			'imgpath'=>$imgpath,
			'path'=>$path);
			//'conversationtopic_comments'=>$conversationtopic_comments
	}
/*$this->db->select('eh.exerciestype');
	$this->db->from('e_'.$_POST['connectionid'].'_edu_headings as eh');
	$this->db->join('e_'.$_POST['connectionid'].'_edu_excercises as ee','ee.topic_id=eh.id');
	$this->db->join('e_'.$_POST['connectionid'].'_edu_fav as ea','ee.id=ea.resourceid','left');
	$this->db->join('e_'.$_POST['connectionid'].'_edu_topics as tt','eh.topic_id=tt.id');
	$this->db->join('e_'.$_POST['connectionid'].'_edu_modules as mm','mm.id=tt.module_id');
	$this->db->join('e_'.$_POST['connectionid'].'_edu_courses as cc','cc.id=mm.course_id');
	if(isset($_POST['exercisetype'])){
	$this->db->where('eh.exerciestype',$_POST['exercisetype']);
	}//else{
	//$this->db->where('ee.id',$_POST['resourceid']);
	//}
	
	//$this->db->where('(eh.exerciestype = "Powerpoint presentation exercise" or eh.exerciestype ="Add Folder" or eh.exerciestype ="Files" or eh.exerciestype ="Add Audio" or eh.exerciestype ="Add Video")');
	//$this->db->limit(20,$_POST['limit']);
	$query=$this->db->get();
	//$mm = $query->result();
	$ccmm= $query->num_rows();*/
	

$data=array( 'count'=>$ccmm, 'data'=>@$data);
echo json_encode($data);	
exit;
}

public function quote()
	{
		if(isset($this->session->data['userid'])){
		 $pageURL = 'http';
 if (@$_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }

$pageURL = str_replace('$$m2k$$','#',$pageURL);
$pageURL = str_replace('$$$$$','"',$pageURL);
$pageURL = str_replace('$$$@@@',"'",$pageURL);

 $regummit = strstr($pageURL,"regummit/"); 
 $editgummit = strstr($pageURL,"editgummit/"); 
 if($regummit){
	 if($editgummit){
	 $skmmm=explode('editgummit/',$pageURL);
	 $this->data['editrepin']=$skmmm[1];
	 }else{
	 $skmm=explode('regummit/',$pageURL);
	 $this->data['repin']=$skmm[1];
		 }
	 }else{
	$this->data['repin']='';	 
		 }
		 //echo $pageURL;
		 //die;
		$mm=explode('$$&&',$pageURL);
		$ss=str_replace("intainta","/",$mm[1]);
		//$vv=str_replace("_",".",$ss);
		$vv11=str_replace("bngcabc","?",$ss);
		$this->data['imageurl']=$vv11;

		$this->data['text']=urldecode(@$mm[2]);
		$this->data['is_video']='text';
$this->load->model('klaspad/klaspad');		
		$this->data['board_name'] = array();
	$count=$this->model_klaspad_klaspad->board_name();	
	foreach($count as $result)
				{
					$action = array();
			        $this->data['board_name'][]=array(
					'id'=>$result['id'],
					'board_name' => $result['board_name'],
                    'board_image' => $result['board_image']
					);
									}
	$this->id       = 'content';
		$this->template = 'klaspad/gummit_screen.php';
		//$this->layout   = 'module/layout';
		$this->render();
		}else{
	$this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	//$data['universityname']=$this->welcomemodel->university_list();
	//$this->load->view('welcome/welcome',$data);
		}
		
}

public function forvideoimages(){
		if(isset($this->session->data['userid'])){
				 $pageURL = 'http';
 if (@$_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
  $pageURL = str_replace('$$m2k$$','#',$pageURL);
    $pageURL = str_replace('$$$$$','"',$pageURL);
	    $pageURL = str_replace('$$$@@@',"'",$pageURL);
$pageval = explode('$$&&',$pageURL);
 
 $regummit = strstr($pageURL,"regummit/"); 
 $editgummit = strstr($pageURL,"editgummit/"); 
 if($regummit){
	 if($editgummit){
	 $skmmm=explode('editgummit/',$pageURL);
	 $this->data['editrepin']=$skmmm[1];
	$this->data['repin']='editrepin';
	$mkt = explode('/regummit/editgummit/',$pageURL);
	$pageval = explode('$$&&',$mkt[0]);	 
	 }else{
	 $skmm=explode('regummit/',$pageURL);
	 $this->data['repin']=$skmm[1];
	$mkt = explode('/regummit/',$pageURL);
	$pageval = explode('$$&&',$mkt[0]);	 
		 }
	 }else{
	$this->data['repin']='';	 
		 }

if((@$_GET['type']=='image')||(@$_GET['type']=='video')){		
		$this->data['imageurl']=$pageval[1];
		$this->data['text']= '';
if(@$_GET['type']=='image'){				
		$this->data['is_video']='false';
}else{
			$this->data['is_video']='true';
	}
	
		$this->data['webcurrenturl']=$pageval[2];

		$this->load->model('klaspad/klaspad');		
		$this->data['board_name'] = array();
	$count=$this->model_klaspad_klaspad->board_name();	
	foreach($count as $result)
				{
					$action = array();
			        $this->data['board_name'][]=array(
					'id'=>$result['id'],
					'board_name' => $result['board_name'],
                    'board_image' => $result['board_image']
					);
									}
	$this->id       = 'content';
		$this->template = 'klaspad/gummit_screen.php';
		//$this->layout   = 'module/layout';
		$this->render();
		}else{
			
	$data['universityname']=$this->welcomemodel->university_list();
	$this->load->view('welcome/welcome',$data);
		}
		
	//End	
		}else{
	$this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	//$data['universityname']=$this->welcomemodel->university_list();
	//$this->load->view('welcome/welcome',$data);
			}
		
		
	}

 public function alldata()
	{
	$this->load->model('klaspad/klaspad');
	$alldata1=$this->model_klaspad_klaspad->alldata();
	$alldata=array();
//print_r($alldata1);
//die;	
foreach($alldata1 as $ad){
	$module=$this->model_klaspad_klaspad->allmoduledatacoursewise($ad['id'],$ad['campus_id']);
	$mod=array();
	foreach($module as $mm){
	$q=mysql_query("select studentID, staffID from user where userid='".$_POST['userid']."'");	
	$s=mysql_fetch_array($q);
	if($s['studentID']!='' && $s['studentID']!=0){
		$mn=1;
		//echo "select * from studenttopics where moduleid='".$mm['id']."' and studentid='".$s['studentID']."'";
	$q1=mysql_query("select * from studenttopics where moduleid='".$mm['id']."' and studentid='".$s['studentID']."'");
		while($s1=mysql_fetch_array($q1)){
		if($mn==1){
		$stdid=	$s1['topicid'];
		}else{
		$stdid=	$stdid.','.$s1['topicid'];	
		}
		$mn++;}
		$tp=" and id in (".$stdid.")";
	}else{
		$tp='';
	}
$t=$this->db->query("select * from e_".$_POST['connectionid']."_edu_topics where module_id='".$mm['id']."' ".$tp." order by shortorder");

$topic=$t->rows;
	$top=array();
	foreach($topic as $tp){
		
 $top[]=array(
 'id' => @$tp['id'],
 'topicname' => @$tp['topicname']
 );	
	}	
		
 $mod[]=array(
 'id' => @$mm['id'],
 'modulename' => @$mm['modulename'],
 'moduledescription' => @$mm['description'],
 'topic' =>$top
 );	
	}
 $alldata[]=array(
 'id' => @$ad['id'],
 'coursename' => @$ad['coursename'],
 'campus_id' => @$ad['campus_id'],
 'department_id' => @$ad['department_id'],
 'courseno' =>@$ad['courseno'],
 'courseduration' =>@$ad['courseduration'],
 'description' =>@$ad['description'],
 'learningoutcomes' =>@$ad['learningoutcomes'],
 'perqualification' =>@$ad['perqualification'],
 'degreediplomaoffered' =>@$ad['degreediplomaoffered'],
 'awardingbody' => @$ad['awardingbody'],
 'awardingbodycourseid' =>@$ad['awardingbodycourseid'],
 'qfqualcourseid' =>@$ad['qfqualcourseid'],
 'coursecredit' =>@$ad['coursecredit'],
 'imageupload' => @$ad['imageupload'],
 'topic_id' => @$ad['topic_id'],
 'connectionid' => @$ad['connectionid'],
 'courseid' => @$ad['courseid'],
 'userid' => @$ad['userid'],
 'modified_date' => @$ad['modified_date'],
 'access' => @$ad['access'],
 'course_ref_no' =>@$ad['course_ref_no'],
 'feature' => @$ad['feature'],
 'thumbimageupload' => @$ad['thumbimageupload'],
 'videoupload' => @$ad['videoupload'],
 'module'=>$mod
 );	
}

$data=array( 'data'=>$alldata);
echo json_encode($data);	

exit;
	//$alldata=$this->welcomemodel->alldata();	
	//$this->load->view('mobileapi/alldata',$data);
	}
	
public function allcoursemoduledata()
	{
	$this->load->model('klaspad/klaspad');
	$alldata1=$this->model_klaspad_klaspad->allcoursemoduledata();
	$alldata=array();
//echo '<pre>';
//print_r($alldata1);
//die;	
foreach($alldata1 as $ad){
 $alldata[]=array(
 			'id' => $ad['id'],
            'modulename' => $ad['modulename'],
            'course_id' => $ad['course_id'],
            'numberoftopics' => $ad['numberoftopics'],
            'description' => $ad['description'],
            'learningoutcomes' => $ad['learningoutcomes'],
            'numberofcredits' => $ad['numberofcredits'],
            'awardingbodyrefnumber' => $ad['awardingbodyrefnumber'],
            'moduleno' => $ad['moduleno'],
            'modified_date' => $ad['modified_date']
 );	
}

$data=array( 'data'=>$alldata);
echo json_encode($data);	

exit;
	//$alldata=$this->welcomemodel->alldata();	
	//$this->load->view('mobileapi/alldata',$data);
	}	
	

public function insertgumm(){
	//echo '<pre>';
	//print_r($_POST);
	//die;
	if($_POST['is_video']=='false'){
		$content = file_get_contents($_POST['gummurl']);
		//Store in the filesystem.
		$regummit = strstr($_POST['gummurl'],"?");
		if($regummit){
		$uurl=explode('?',$_POST['gummurl']);
		$content1 = $uurl[0];
		}else{
		$content1 = $_POST['gummurl'];
		} 
        
		$chk=explode('/',$content1);
        $mkt = count($chk)-1;
		$imagename = time().$chk[$mkt];

	if(file_exists("klaspad/uploads/gummitimage/".$this->session->data['userid']."/image")){
	}else{
	mkdir("klaspad/uploads/gummitimage/".$this->session->data['userid'], 0700);
	mkdir("klaspad/uploads/gummitimage/".$this->session->data['userid']."/image", 0700);
	mkdir("klaspad/uploads/gummitimage/".$this->session->data['userid']."/board", 0700);
	mkdir("klaspad/uploads/gummitimage/".$this->session->data['userid']."/board/thumb", 0700);
	mkdir("klaspad/uploads/gummitimage/".$this->session->data['userid']."/image/thumb", 0700);
	}

        $fp = fopen("klaspad/uploads/gummitimage/".$this->session->data['userid']."/image/".$imagename, "w");
        fwrite($fp, $content);
        fclose($fp);
		
		$imageurl="klaspad/uploads/gummitimage/".$this->session->data['userid']."/image/".$imagename;
		$originalimageurl="klaspad/uploads/gummitimage/".$this->session->data['userid']."/image/".$imagename;
  copy("klaspad/uploads/gummitimage/".$this->session->data['userid']."/image/".$imagename,"klaspad/uploads/gummitimage/".$this->session->data['userid']."/image/thumb/".$imagename);
 // $config['image_library'] = 'gd2';
  //$config['source_image']	= "klaspad/uploads/gummitimage/".$this->session->data['userid']."/image/thumb/".$imagename;
  //$config['create_thumb'] = TRUE;
 // $config['maintain_ratio'] = TRUE;
 // $config['width']	 = 270;
  //$config['height']	= 200;
  //$this->load->library('image_lib', $config); 
  //$this->image_lib->resize();
$_POST['gummurl']=$imagename;

  }
  	mysql_query("insert into e_".$this->session->data['campusid']."_edu_gumm set
				 is_video = '".@$_POST['is_video']."',
    			 txtmsg = '".@$_POST['txtmsg']."',
    			 plaintext = '".@$_POST['plaintext']."',
    			 webcurrenturl = '".@$_POST['webcurrenturl']."',
    			 boardname = '".@$_POST['boardname']."',
    			 topic_name = '".@$_POST['topic_name']."',
    			 note = '".@$_POST['note']."',
    			 description = '".@$_POST['description']."',
    			 author = '".@$_POST['author']."',
    			 title = '".@$_POST['title']."',
    			 YourReference = '".@$_POST['YourReference']."',
    			 gummurl = '".@$_POST['gummurl']."'
	");
	//$this->db->insert('e_'.$this->session->userdata('connectid').'_edu_gumm',$_POST);
 $this->session->data['messages']='Your selection has been saved and can be viewed on your virtual board.';
 $this->id       = 'content';
		$this->template = 'klaspad/message_gumm.php';
		//$this->layout   = 'module/layout';
		$this->render();
	//$this->redirect($this->url->https('klaspad/klaspad/my_research&id='.$_POST['boardname']));
	//redirect('my_research/'.$_POST['boardname']);
	}
	
public function gummit_gumm_delete(){
	if(isset($this->session->data['userid'])){	
	$id=$_GET['gummid'];
	mysql_query("delete from e_".$this->session->data['campusid']."_edu_gumm where gummid='".$id."'");
	//$this->db->where('gummid',$id);
	//$this->db->delete('e_'.$this->session->userdata('connectid').'_edu_gumm');
	$this->redirect($_SERVER['HTTP_REFERER']);
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 	}	
	
	
public function gummit_board_note_delete(){
	$id=$_GET['noteid'];
	mysql_query("delete from e_".$this->session->data['campusid']."_edu_board_note where id='".$id."'");
	$this->redirect($_SERVER['HTTP_REFERER']);
	}

public function insert_board_note_gumm(){
	$id=$_POST['id'];
	mysql_query("update e_".$this->session->data['campusid']."_edu_gumm set note='".$_POST['board_description']."' where gummid='".$id."'");
	?>
    <script>
   parent.window.hs.getExpander().close();
   parent.location.reload();
   </script>
    <?php
	$this->redirect($_SERVER['HTTP_REFERER']);
	}
public function add_note_board_gumm(){
	$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){	
	$record=$this->model_klaspad_klaspad->add_note_board_gumm();
	$this->data['board_description']=$record['note'];
	
	$this->id       = 'content';
		$this->template = 'klaspad/add_note_board_gumm.php';
		//$this->layout   = 'module/layout';
		$this->render();
	//$this->load->view('exercisedashboard/add_note_board_gumm',$data);	
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	}
	}

public function updateMenu(){
	$array	= $_POST['arrayorder'];

if ($_POST['update'] == "update"){
	
	$count = 1;
	foreach ($array as $idval) {
		$query = "UPDATE e_".$this->session->data['campusid']."_edu_gumm SET shortorder = " . $count . " WHERE gummid = " . $idval;
		//echo $query;
		mysql_query($query) or die('Error, insert query failed');
		$count ++;	
	}
	//exit;
	echo 'All saved! close the popup window and refresh the page to see the changes';
	exit;
}
	
		}

public function exercise_courses(){
	$q=mysql_query("select campusName as connectionid from course where new_id='".$_POST['courseid']."'");
		$s=mysql_fetch_array($q);
	$z=1;
	$id='';	
	$m=mysql_query("select id from e_".$s['connectionid']."_edu_modules where course_id='".$_POST['courseid']."'");
	while($ms=mysql_fetch_array($m)){	
	if($z==1){
	$id=$ms['id'];
	}else{
	$id=$id.','.$ms['id'];	
	}
	$z++;}
	$query=$this->db->query("select * from e_".$s['connectionid']."_edu_topics where module_id in ($id)");
	$tid=$query->rows;
	$alldta=array();
	foreach($tid as $all_exe){
	$query1=$this->db->query("select headingname, id, exerciestype from e_".$s['connectionid']."_edu_headings where topic_id='".$all_exe['id']."' order by id asc");
	$mm=$query1->rows;
	
	foreach($mm as $dat){
	$alldta[]=array('topicid' => $all_exe['id'],
			'exerciseid' => $dat['id'],
			'courseid' => $_POST['courseid'],
			'mid' => $all_exe['module_id'], 
			'headingname' => $dat['headingname'],
            'exerciestype' => $dat['exerciestype']
            );	
	}
	
	
    }
	$status=array('data'=>$alldta);
	echo json_encode($status);	
	exit;
	}
	
public function exercise_courses_details(){
	$this->load->model('klaspad/klaspad');
	if(@$_GET['courseid']!=''){
	$_POST['courseid']=$_GET['courseid'];	
	}
	if(@$_GET['exerciseid']!=''){
	$_POST['exerciseid']=$_GET['exerciseid'];	
	}
	if(@$_GET['heading_id']!=''){
	$_POST['topicid']=$_GET['heading_id'];	
	}
	if(@$_GET['user_id']!=''){
	$_POST['user_id']=$_GET['user_id'];	
	}
	if(@$_GET['connect_id']!=''){
	$_POST['connectionid']=$_GET['connect_id'];	
	}
	if(@$_GET['exerciestype']!=''){
	$_POST['exerciestype']=$_GET['exerciestype'];	
	}
	$q=mysql_query("select campusName as connectionid from course where new_id='".$_POST['courseid']."'");
	$s=mysql_fetch_array($q);	
	$id=$_POST['exerciseid'];
	//echo "select * from e_".$s['connectionid']."_edu_headings where id='".$_POST['topicid']."'";
	$query=$this->db->query("select * from e_".$s['connectionid']."_edu_headings where topic_id='".$_POST['topicid']."'");	
	$heading_data=$query->row;
	$this->data['id'] =$heading_data['id'];
    $this->data['headingname'] =$heading_data['headingname'];
    $this->data['topic_id'] =$heading_data['topic_id'];
    $this->data['exerciestype'] =$heading_data['exerciestype'];
    $this->data['description'] =$heading_data['description'];
    $this->data['heading_audio'] =$heading_data['heading_audio']; 
    $this->data['heading_video'] =$heading_data['heading_video'];
    $this->data['modified_date'] =$heading_data['modified_date'];
    $this->data['rssfeedlink'] =$heading_data['rssfeedlink'];
	//echo "select ee.*,ea.id as favid from e_".$s['connectionid']."_edu_excercises as ee left join e_".$s['connectionid']."_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$id."'";
	/*$query1=$this->db->query("select ee.*,ea.id as favid from e_".$s['connectionid']."_edu_excercises as ee left join e_".$s['connectionid']."_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$id."'");
	$exe_data=$query1->rows;*/
	
	$alldata=array();
	$totattmpt=array();
	
if(@$_POST['exerciestype']=='Write in the correct box' || @$_POST['exerciestype']=='Writeinthecorrectbox'){
	$dd=mysql_query("select topic_id, resourceid from e_".$_POST['connectionid']."_edu_excercises_draganddrop where id='".$id."'");	
$sdd=mysql_fetch_array($dd);
	//echo "select ee.*,ea.id as favid from e_".$this->session->data['campusid']."_edu_excercises_fillintheblanks as ee left join e_".$this->session->data['campusid']."_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$heading_data['id']."' ";	
	$query1=$this->db->query("select ee.*,ea.id as favid from e_".$_POST['connectionid']."_edu_excercises_draganddrop as ee left join e_".$_POST['connectionid']."_edu_fav as ea on ee.id=ea.resourceid where ee.topic_id='".$sdd['topic_id']."' and ee.resourceid='".$sdd['resourceid']."' ");			
	$exe_dataaa=$query1->rows;
$url='klaspad/uploads/'.$s['connectionid'].'/'.$_POST['courseid'].'/exercise/';
$exe_dataaa=$query1->rows;
	foreach($exe_dataaa as $exedata){
		$blockdataa = array();	

	$query1111=$this->db->query("select * from e_".$_POST['connectionid']."_edu_excercises_blocks where exercise_id in (".@$exedata['id'].")");		
	//$this->db->where_in('exercise_id',@$msk1);
	//$query=$this->db->get('e_'.$this->session->userdata('connectid').'_edu_excercises_blocks');
	$blockdata= $query1111->rows;
			
	
	foreach($blockdata as $res)
				{
				$mq=array();	
				$mq=unserialize($res['myblock_question']);
				//echo '<pre>';
				//print_r($mq);	
					$blockdataa[]=array(
					'id'=>$res['id'],
					'nameofthemyblocks' => $res['nameofthemyblocks'],
					'exercise_id' => $res['exercise_id'],
					'myblocks' => $res['myblocks'],
					'myblock_question' => $mq
					);
									}		

$alldata[]=array('id'=>$exedata['id'],
			 'topic_id'=>$exedata['topic_id'],
			 'heading_id'=>$heading_data['topic_id'],
			 'exerciestype'=>$exedata['exerciestype'],
			 'wordssentence'=>$exedata['wordssentence'],
             'uploadimage'=>$url.$exedata['uploadimage'],
			 'correctanswer'=>$exedata['answere'],
			 'question'=>$exedata['question'],
			 'answere'=>$answere,
			 'blockdata'=>$blockdataa);
	}
$query211=$this->db->query("select * from e_".$s['connectionid']."_edu_result_draganddrop where heading_id='".$_POST['topicid']."' and user_id='".$_POST['user_id']."' and connect_id='".$_POST['connectionid']."' order by id desc limit 0,5");
$totattmpt1=$query211->rows;
foreach($totattmpt1 as $tot){
$totattmpt[]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'total_question' => $tot['total_question'],
			'correct_question' => $tot['correct_question'],
			'worng_question' => $tot['worng_question'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);	
}
$query211t=$this->db->query("select * from e_".$s['connectionid']."_edu_result_draganddrop where heading_id='".$_POST['topicid']."' and user_id='".$_POST['user_id']."' and connect_id='".$_POST['connectionid']."' order by id desc");
$totattmpt1t=$query211t->rows;
foreach($totattmpt1t as $tot){
$totattmptt[]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'total_question' => $tot['total_question'],
			'correct_question' => $tot['correct_question'],
			'worng_question' => $tot['worng_question'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);	
}

	}else if(@$_POST['exerciestype']=='Descripting'){
	$dd=mysql_query("select topic_id, resourceid from e_".$s['connectionid']."_edu_excercises_descripting where id='".$id."'");	
$sdd=mysql_fetch_array($dd);
	//echo "select ee.*,ea.id as favid from e_".$this->session->data['campusid']."_edu_excercises_fillintheblanks as ee left join e_".$this->session->data['campusid']."_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$heading_data['id']."' ";	
	$query1=$this->db->query("select ee.*,ea.id as favid from e_".$s['connectionid']."_edu_excercises_descripting as ee left join e_".$s['connectionid']."_edu_fav as ea on ee.id=ea.resourceid where ee.topic_id='".$sdd['topic_id']."' and ee.resourceid='".$sdd['resourceid']."' ");			
	$exe_dataaa=$query1->rows;
$url='klaspad/uploads/'.$s['connectionid'].'/'.$_POST['courseid'].'/exercise/';
$exe_dataaa=$query1->rows;
	foreach($exe_dataaa as $exedata){
$query2=$this->db->query("select * from e_".$s['connectionid']."_edu_result_descripting where did='".$exedata['id']."' and user_id='".$_POST['user_id']."'");
$totattmpt1=$query2->row;
$ttc=count($totattmpt1);
if($ttc==0){
$answere='';
$did='';	
}else{
$answere=$totattmpt1['answere'];
$did=$totattmpt1['id'];	
}
$alldata[]=array('id'=>$exedata['id'],
			 'topic_id'=>$exedata['topic_id'],
			 'heading_id'=>$heading_data['topic_id'],
			 'exerciestype'=>$exedata['exerciestype'],
			 'wordssentence'=>$exedata['wordssentence'],
             'uploadimage'=>$url.$exedata['uploadimage'],
			 'correctanswer'=>$exedata['answere'],
			 'question'=>$exedata['question'],
			 'answere'=>$answere,
			 'did'=>$did);
	}


	}else if(@$_POST['exerciestype']=='Fill in the blanks' || @$_POST['exerciestype']=='Fillintheblanks'){
	$dd=mysql_query("select topic_id, resourceid from e_".$s['connectionid']."_edu_excercises_fillintheblanks where id='".$id."'");	
$sdd=mysql_fetch_array($dd);
	//echo "select ee.*,ea.id as favid from e_".$this->session->data['campusid']."_edu_excercises_fillintheblanks as ee left join e_".$this->session->data['campusid']."_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$heading_data['id']."' ";	
	$query1=$this->db->query("select ee.*,ea.id as favid from e_".$s['connectionid']."_edu_excercises_fillintheblanks as ee left join e_".$s['connectionid']."_edu_fav as ea on ee.id=ea.resourceid where ee.topic_id='".$sdd['topic_id']."' and ee.resourceid='".$sdd['resourceid']."' ");			
	$exe_dataaa=$query1->rows;
$url='klaspad/uploads/'.$s['connectionid'].'/'.$_POST['courseid'].'/exercise/';
$exe_dataaa=$query1->rows;
	foreach($exe_dataaa as $exedata){
$alldata[]=array('id'=>$exedata['id'],
			 'topic_id'=>$exedata['topic_id'],
			 'heading_id'=>$heading_data['topic_id'],
			 'exerciestype'=>$exedata['exerciestype'],
			 'wordssentence'=>$exedata['wordssentence'],
             'uploadimage'=>$url.$exedata['uploadimage'],
			 'correctanswer'=>$exedata['answere'],
			 'question'=>$exedata['question']);
	}
$query2=$this->db->query("select * from e_".$s['connectionid']."_edu_result_fillintheblanks where heading_id='".$_POST['topicid']."' and user_id='".$_POST['user_id']."' and connect_id='".$_POST['connectionid']."' order by id desc limit 0,5");
$totattmpt1=$query2->rows;
foreach($totattmpt1 as $tot){
$totattmpt[]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'total_question' => $tot['total_question'],
			'correct_question' => $tot['correct_question'],
			'worng_question' => $tot['worng_question'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);	
}
$query2t=$this->db->query("select * from e_".$s['connectionid']."_edu_result_fillintheblanks where heading_id='".$_POST['topicid']."' and user_id='".$_POST['user_id']."' and connect_id='".$_POST['connectionid']."' order by id desc");
$totattmpt1t=$query2t->rows;
foreach($totattmpt1t as $tot){
$totattmptt[]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'total_question' => $tot['total_question'],
			'correct_question' => $tot['correct_question'],
			'worng_question' => $tot['worng_question'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);	
}
}else if(@$_POST['exerciestype']=='TrueFalse'){	
$dd=mysql_query("select topic_id, resourceid from e_".$s['connectionid']."_edu_excercises_truefalse where id='".$id."'");	
$sdd=mysql_fetch_array($dd);	
//echo "select ee.*,ea.id as favid from e_".$s['connectionid']."_edu_excercises_multiplechoice as ee left join e_".$s['connectionid']."_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$heading_data['id']."' ";	
$query1=$this->db->query("select ee.*,ea.id as favid from e_".$s['connectionid']."_edu_excercises_truefalse as ee left join e_".$s['connectionid']."_edu_fav as ea on ee.id=ea.resourceid where ee.topic_id='".$sdd['topic_id']."' and ee.resourceid='".$sdd['resourceid']."' ");	

$exe_dataaa=$query1->rows;
	foreach($exe_dataaa as $exedata){
		$ans=array();
	$answere = explode('@@##$$',$exedata['answere']);
	$answer=$answere[0];
$var1=rand(0,3);
//if($var1==0){
$var1=0;
$var2=1;
/*$var3=2;	
$var4=3;*/
//}
//if($var1==1){
//$var2=0;
/*$var3=3;	
$var4=2;*/
//}
/*if($var1==2){
$var2=0;
$var3=3;	
$var4=1;
}
if($var1==3){
$var2=2;
$var3=1;	
$var4=0;
}*/
/*$ans[]=array('answer1'=>$answere[$var1],
			 'answer2'=>$answere[$var2],
			 'answer3'=>$answere[$var3],
			 'answer4'=>$answere[$var4]);*/
$ans[]=array('answer1'=>$answere[$var1],
			 'answer2'=>$answere[$var2]);

$alldata[]=array('id'=>$exedata['id'],
			 'topic_id'=>$exedata['topic_id'],
			 'heading_id'=>$heading_data['topic_id'],
			 'exerciestype'=>$exedata['exerciestype'],
			 'answere'=>$ans,
			 'correctanswer'=>$answer,
			 'question'=>$exedata['question']);
	}
$query2=$this->db->query("select * from e_".$s['connectionid']."_edu_result_truefalse where heading_id='".$_POST['topicid']."' and user_id='".$_POST['user_id']."' and connect_id='".$_POST['connectionid']."' order by id desc limit 0,5");
$totattmpt1=$query2->rows;
foreach($totattmpt1 as $tot){
$totattmpt[]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'total_question' => $tot['total_question'],
			'correct_question' => $tot['correct_question'],
			'worng_question' => $tot['worng_question'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);	
}	
$query2t=$this->db->query("select * from e_".$s['connectionid']."_edu_result_truefalse where heading_id='".$_POST['topicid']."' and user_id='".$_POST['user_id']."' and connect_id='".$_POST['connectionid']."' order by id desc");
$totattmpt1t=$query2t->rows;
foreach($totattmpt1t as $tot){
$totattmptt[]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'total_question' => $tot['total_question'],
			'correct_question' => $tot['correct_question'],
			'worng_question' => $tot['worng_question'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);	
}	
	}else if(@$_POST['exerciestype']=='Multiplechoicequestions'){	
$dd=mysql_query("select topic_id, resourceid from e_".$_POST['connectionid']."_edu_excercises_multiplechoice where id='".$id."'");	
$sdd=mysql_fetch_array($dd);	
//echo "select ee.*,ea.id as favid from e_".$s['connectionid']."_edu_excercises_multiplechoice as ee left join e_".$s['connectionid']."_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$heading_data['id']."' ";	
$query1=$this->db->query("select ee.*,ea.id as favid from e_".$_POST['connectionid']."_edu_excercises_multiplechoice as ee left join e_".$_POST['connectionid']."_edu_fav as ea on ee.id=ea.resourceid where ee.topic_id='".$sdd['topic_id']."' and ee.resourceid='".$sdd['resourceid']."' ");	

$exe_dataaa=$query1->rows;
	foreach($exe_dataaa as $exedata){
		$ans=array();
	$answere = explode('@@##$$',$exedata['answere']);
	$answer=$answere[0];
$var1=rand(0,3);
if($var1==0){
$var2=1;
$var3=2;	
$var4=3;
}
if($var1==1){
$var2=0;
$var3=3;	
$var4=2;
}
if($var1==2){
$var2=0;
$var3=3;	
$var4=1;
}
if($var1==3){
$var2=2;
$var3=1;	
$var4=0;
}
$ans[]=array('answer1'=>$answere[$var1],
			 'answer2'=>$answere[$var2],
			 'answer3'=>$answere[$var3],
			 'answer4'=>$answere[$var4]);

$alldata[]=array('id'=>$exedata['id'],
			 'topic_id'=>$exedata['topic_id'],
			 'heading_id'=>$heading_data['topic_id'],
			 'exerciestype'=>$exedata['exerciestype'],
			 'answere'=>$ans,
			 'correctanswer'=>$answer,
			 'question'=>$exedata['question']);
	}
$query2=$this->db->query("select * from e_".$s['connectionid']."_edu_result where topic_id='".$_POST['topicid']."' and user_id='".$_POST['user_id']."' and connect_id='".$_POST['connectionid']."' order by id desc limit 0,5");
$totattmpt1=$query2->rows;
foreach($totattmpt1 as $tot){
$totattmpt[]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'total_question' => $tot['total_question'],
			'correct_question' => $tot['correct_question'],
			'worng_question' => $tot['worng_question'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);	
}
$query2t=$this->db->query("select * from e_".$_POST['connectionid']."_edu_result where topic_id='".$_POST['topicid']."' and user_id='".$_POST['user_id']."' and connect_id='".$_POST['connectionid']."' order by id desc");
$totattmpt1t=$query2t->rows;
foreach($totattmpt1t as $tot){
$totattmptt[]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'total_question' => $tot['total_question'],
			'correct_question' => $tot['correct_question'],
			'worng_question' => $tot['worng_question'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);	
}
}else if(@$_POST['exerciestype']=='Crosswords'){
$q1=$this->db->query("select ee.*,ea.id as favid from e_".$s['connectionid']."_edu_excercises_crossword as ee left join e_".$s['connectionid']."_edu_fav as ea on ee.id=ea.resourceid where ee.id='".$id."'");
	$exe_dataaa=$q1->rows;		
foreach($exe_dataaa as $exedata){
$ans=array();
$Que=array();
$hnt=array();
$query2=$this->db->query("select * from e_".$s['connectionid']."_edu_answere_crossword where crossword_id='".$exedata['id']."'");	
$dat=$query2->row;
$ans=unserialize($dat['answere']);
$Que=unserialize($dat['question']);
$hnt=unserialize($dat['hint']);
$alldata[]=array('id'=>$dat['id'],
			 'crossword_id'=>$dat['crossword_id'],
			 'answere'=>$ans,
			 'question'=>$Que,
			 'total_count'=>$dat['total_count'],
			 'hint'=>$hnt);
	}
$query3=$this->db->query("select * from e_".$s['connectionid']."_edu_result_crossword where heading_id='".$_POST['topicid']."' and user_id='".$_POST['user_id']."' and connect_id='".$_POST['connectionid']."' order by id desc limit 0,5");
$totattmpt1=$query3->rows;
foreach($totattmpt1 as $tot){
$totattmpt[]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'result' => $tot['result'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);	
}	
$query3t=$this->db->query("select * from e_".$s['connectionid']."_edu_result_crossword where heading_id='".$_POST['topicid']."' and user_id='".$_POST['user_id']."' and connect_id='".$_POST['connectionid']."' order by id desc");
$totattmpt1t=$query3t->rows;
foreach($totattmpt1t as $tot){
$totattmptt[]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'result' => $tot['result'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);	
}	
}else{
$dd=mysql_query("select topic_id from e_".$_POST['connectionid']."_edu_excercises_multiplechoice where id='".$id."'");	
$sdd=mysql_fetch_array($dd);	
//echo "select ee.*,ea.id as favid from e_".$s['connectionid']."_edu_excercises_multiplechoice as ee left join e_".$s['connectionid']."_edu_fav as ea on ee.id=ea.resourceid where topic_id='".$heading_data['id']."' ";	
$query1=$this->db->query("select ee.*,ea.id as favid from e_".$_POST['connectionid']."_edu_excercises_multiplechoice as ee left join e_".$_POST['connectionid']."_edu_fav as ea on ee.id=ea.resourceid where ee.topic_id='".$sdd['topic_id']."' ");	
$exe_dataaa=$query1->rows;	
foreach($exe_dataaa as $exedata){
		$ans=array();
	$answere = explode('@@##$$',$exedata['answere']);
	$answer=$answere[0];
$var1=rand(0,3);
if($var1==0){
$var2=1;
$var3=2;	
$var4=3;
}
if($var1==1){
$var2=0;
$var3=3;	
$var4=2;
}
if($var1==2){
$var2=0;
$var3=3;	
$var4=1;
}
if($var1==3){
$var2=2;
$var3=1;	
$var4=0;
}
$ans[]=array('answer1'=>$answere[$var1],
			 'answer2'=>$answere[$var2],
			 'answer3'=>$answere[$var3],
			 'answer4'=>$answere[$var4]);

$alldata[]=array('id'=>$exedata['id'],
			 'topic_id'=>$exedata['topic_id'],
			 'heading_id'=>$heading_data['topic_id'],
			 'exerciestype'=>$exedata['exerciestype'],

			 'answere'=>$ans,
			 'correctanswer'=>$answer,
			 'question'=>$exedata['question']);
	}
	//echo "select * from e_".$_POST['connectionid']."_edu_result where topic_id='".$_POST['topicid']."' and user_id='".$_POST['user_id']."' and connect_id='".$_POST['connectionid']."' order by id desc limit 0,5";
$query2=$this->db->query("select * from e_".$_POST['connectionid']."_edu_result where topic_id='".$_POST['topicid']."' and user_id='".$_POST['user_id']."' and connect_id='".$_POST['connectionid']."' order by id desc limit 0,5");
$totattmpt1=$query2->rows;
foreach($totattmpt1 as $tot){
$totattmpt[]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'total_question' => $tot['total_question'],
			'correct_question' => $tot['correct_question'],
			'worng_question' => $tot['worng_question'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);	
}
$query2t=$this->db->query("select * from e_".$_POST['connectionid']."_edu_result where topic_id='".$_POST['topicid']."' and user_id='".$_POST['user_id']."' and connect_id='".$_POST['connectionid']."' order by id desc limit 0,5");
$totattmpt1t=$query2t->rows;
foreach($totattmpt1t as $tot){
$totattmptt[]=array(
			'id' => $tot['id'],
            'course_id' => $tot['course_id'],
            'module_id' => $tot['module_id'],
            'topic_id' => $tot['topic_id'],
            'heading_id' => $tot['heading_id'],
            'total_question' => $tot['total_question'],
			'correct_question' => $tot['correct_question'],
			'worng_question' => $tot['worng_question'],
            'done_date' => $tot['done_date'],
            'user_id' => $tot['user_id'],
            'connect_id' => $tot['connect_id']
			);	
}	
}
	$status=array('data'=>$alldata,'resultdata'=>$totattmpt,'totalresultdata'=>$totattmptt);
	echo json_encode($status);	
	exit;
}	
	
public function insertresult(){
//echo "select connectionid from edu_courses where courseid='".$_POST['courseid']."'";	
$q=mysql_query("select campusName as connectionid from course where new_id='".$_POST['courseid']."'");
		$s=mysql_fetch_array($q);
/*echo "insert into e_".$s['connectionid']."_edu_result set course_id='".$_POST['courseid']."', module_id='".$_POST['mid']."', topic_id='".$_POST['exerciseid']."', heading_id='".$_POST['heading_id']."', total_question='".$_POST['total_question']."', correct_question='".$_POST['correct_question']."', worng_question='".$_POST['worng_question']."', done_date=now(), user_id='".$_POST['user_id']."', connect_id='".$_POST['connect_id']."'";
die;*/
$extype=str_replace(' ','',$_POST['exerciestype']);		
mysql_query("insert into e_".$s['connectionid']."_edu_result set course_id='".$_POST['courseid']."', module_id='".$_POST['mid']."', topic_id='".$_POST['topicid']."', heading_id='".$_POST['heading_id']."', total_question='".$_POST['total_question']."', correct_question='".$_POST['correct_question']."', worng_question='".$_POST['worng_question']."', done_date=now(), user_id='".$_POST['user_id']."', connect_id='".$_POST['connect_id']."'");
	$this->redirect($this->url->https('klaspad/klaspad/exercise_courses_details&courseid='.$_POST['courseid'].'&exerciseid='.$_POST['exerciseid'].'&heading_id='.$_POST['heading_id'].'&user_id='.$_POST['user_id'].'&connect_id='.$_POST['connect_id'].'&exerciestype='.$extype));	
}

public function insertresult_truefalse(){
//echo "select connectionid from edu_courses where courseid='".$_POST['courseid']."'";	
$q=mysql_query("select campusName as connectionid from course where new_id='".$_POST['courseid']."'");
		$s=mysql_fetch_array($q);
/*echo "insert into e_".$s['connectionid']."_edu_result set course_id='".$_POST['courseid']."', module_id='".$_POST['mid']."', topic_id='".$_POST['exerciseid']."', heading_id='".$_POST['heading_id']."', total_question='".$_POST['total_question']."', correct_question='".$_POST['correct_question']."', worng_question='".$_POST['worng_question']."', done_date=now(), user_id='".$_POST['user_id']."', connect_id='".$_POST['connect_id']."'";
die;*/
$extype=str_replace(' ','',$_POST['exerciestype']);		
mysql_query("insert into e_".$s['connectionid']."_edu_result_truefalse set course_id='".$_POST['courseid']."', module_id='".$_POST['mid']."', topic_id='".$_POST['topicid']."', heading_id='".$_POST['heading_id']."', total_question='".$_POST['total_question']."', correct_question='".$_POST['correct_question']."', worng_question='".$_POST['worng_question']."', done_date=now(), user_id='".$_POST['user_id']."', connect_id='".$_POST['connect_id']."'");
	$this->redirect($this->url->https('klaspad/klaspad/exercise_courses_details&courseid='.$_POST['courseid'].'&exerciseid='.$_POST['exerciseid'].'&heading_id='.$_POST['heading_id'].'&user_id='.$_POST['user_id'].'&connect_id='.$_POST['connect_id'].'&exerciestype='.$extype));	
}

public function insertresult_fillintheblanks(){
//echo "select connectionid from edu_courses where courseid='".$_POST['courseid']."'";	
$q=mysql_query("select campusName as connectionid from course where new_id='".$_POST['courseid']."'");
		$s=mysql_fetch_array($q);
/*echo "insert into e_".$s['connectionid']."_edu_result set course_id='".$_POST['courseid']."', module_id='".$_POST['mid']."', topic_id='".$_POST['exerciseid']."', heading_id='".$_POST['heading_id']."', total_question='".$_POST['total_question']."', correct_question='".$_POST['correct_question']."', worng_question='".$_POST['worng_question']."', done_date=now(), user_id='".$_POST['user_id']."', connect_id='".$_POST['connect_id']."'";
die;*/
$extype=str_replace(' ','',$_POST['exerciestype']);		
mysql_query("insert into e_".$s['connectionid']."_edu_result_fillintheblanks set course_id='".$_POST['courseid']."', module_id='".$_POST['mid']."', topic_id='".$_POST['topicid']."', heading_id='".$_POST['heading_id']."', total_question='".$_POST['total_question']."', correct_question='".$_POST['correct_question']."', worng_question='".$_POST['worng_question']."', done_date=now(), user_id='".$_POST['user_id']."', connect_id='".$_POST['connect_id']."'");
	$this->redirect($this->url->https('klaspad/klaspad/exercise_courses_details&courseid='.$_POST['courseid'].'&exerciseid='.$_POST['exerciseid'].'&heading_id='.$_POST['heading_id'].'&user_id='.$_POST['user_id'].'&connect_id='.$_POST['connect_id'].'&exerciestype='.$extype));	
}

public function insertresult_draganddrop(){
//echo "select connectionid from edu_courses where courseid='".$_POST['courseid']."'";	
$q=mysql_query("select campusName as connectionid from course where new_id='".$_POST['courseid']."'");
		$s=mysql_fetch_array($q);
/*echo "insert into e_".$s['connectionid']."_edu_result set course_id='".$_POST['courseid']."', module_id='".$_POST['mid']."', topic_id='".$_POST['exerciseid']."', heading_id='".$_POST['heading_id']."', total_question='".$_POST['total_question']."', correct_question='".$_POST['correct_question']."', worng_question='".$_POST['worng_question']."', done_date=now(), user_id='".$_POST['user_id']."', connect_id='".$_POST['connect_id']."'";
die;*/
$extype=str_replace(' ','',$_POST['exerciestype']);		
mysql_query("insert into e_".$s['connectionid']."_edu_result_draganddrop set course_id='".$_POST['courseid']."', module_id='".$_POST['mid']."', topic_id='".$_POST['topicid']."', heading_id='".$_POST['heading_id']."', total_question='".$_POST['total_question']."', correct_question='".$_POST['correct_question']."', worng_question='".$_POST['worng_question']."', done_date=now(), user_id='".$_POST['user_id']."', connect_id='".$_POST['connect_id']."'");
	$this->redirect($this->url->https('klaspad/klaspad/exercise_courses_details&courseid='.$_POST['courseid'].'&exerciseid='.$_POST['exerciseid'].'&heading_id='.$_POST['heading_id'].'&user_id='.$_POST['user_id'].'&connect_id='.$_POST['connect_id'].'&exerciestype='.$extype));	
}

public function insertresultcrossword(){
//echo "select connectionid from edu_courses where courseid='".$_POST['courseid']."'";	
$q=mysql_query("select campusName as connectionid from course where new_id='".$_POST['courseid']."'");
		$s=mysql_fetch_array($q);
/*echo "insert into e_".$s['connectionid']."_edu_result set course_id='".$_POST['courseid']."', module_id='".$_POST['mid']."', topic_id='".$_POST['exerciseid']."', heading_id='".$_POST['heading_id']."', total_question='".$_POST['total_question']."', correct_question='".$_POST['correct_question']."', worng_question='".$_POST['worng_question']."', done_date=now(), user_id='".$_POST['user_id']."', connect_id='".$_POST['connect_id']."'";
die;*/		
mysql_query("insert into e_".$s['connectionid']."_edu_result_crossword set course_id='".$_POST['courseid']."', module_id='".$_POST['mid']."', topic_id='".$_POST['topicid']."', heading_id='".$_POST['heading_id']."', result='".$_POST['result']."', done_date=now(), user_id='".$_POST['user_id']."', connect_id='".$_POST['connect_id']."'");
	$this->redirect($this->url->https('klaspad/klaspad/exercise_courses_details&courseid='.$_POST['courseid'].'&exerciseid='.$_POST['exerciseid'].'&heading_id='.$_POST['heading_id'].'&user_id='.$_POST['user_id'].'&connect_id='.$_POST['connect_id'].'&exerciestype='.$_POST['exerciestype']));	
}	
	
	
public function add_discussion_comments(){
		$q=mysql_query("select campusName as connectionid from course where new_id='".$_POST['courseid']."'");
		$s=mysql_fetch_array($q);
		$connectid=$s['connectionid'];
		$_POST['connectionid']=$_POST['connectid'];
		$_POST['course_id']=$_POST['courseid'];
		$_POST['createddate']=date('d/m/Y h:iA');
		unset($_POST['connectid']);
		unset($_POST['courseid']);
		$query=$this->db->query("insert into e_".$connectid."_edu_ans_assignment set user_id='".$_POST['user_id']."', assignment_id='".$_POST['assignment_id']."', assignment='".$_POST['assignment']."', course_id='".$_POST['course_id']."', createddate='".$_POST['createddate']."', connectionid='".$_POST['connectionid']."'");
$_POST['commentid']=$this->db->insert_id();
$_POST['parent_connectionid']=$connectid;
$this->db->query("insert into edu_comments set commentid='".$_POST['commentid']."',assignment_id='".$_POST['assignment_id']."',user_id='".$_POST['user_id']."', assignment='".$_POST['assignment']."', course_id='".$_POST['course_id']."', createddate='".$_POST['createddate']."', connectionid='".$_POST['connectionid']."', parent_connectionid='".$_POST['parent_connectionid']."'");
	if($query==TRUE){
	$status=array('status'=>'ture');
	}else{
	$status=array('status'=>'false');
    }
	echo json_encode($status);
	exit;
	}
	
public function make_fav_res(){
	$connectionid=$_POST['connectionid'];
	unset($_POST['connectionid']);
	$q=mysql_query("select campusName as connectionid from course where new_id='".$_POST['courseid']."'");
		$s=mysql_fetch_array($q);
	$rq=mysql_query("select headingname from e_".$s['connectionid']."_edu_headings as eh left join e_".$s['connectionid']."_edu_excercises as ee on ee.topic_id=eh.id where ee.id='".$_POST['resourceid']."'");
	$rsq=mysql_fetch_array($rq);
	$_POST['resourcename']=$rsq['headingname'];	
		$_POST['connectionid']=$s['connectionid'];
		
		unset($_POST['courseid']);
$query=$this->db->query("insert into e_".$connectionid."_edu_fav set userid ='".$_POST['userid']."',resourceid='".$_POST['resourceid']."', createddate=now(), connectionid='".$_POST['connectionid']."'");		

	
if($query==TRUE){
$status=array('status'=>'true');	
}else{
$status=array('status'=>'false');	
}
echo json_encode($status);
exit;
}	
public function delete_fav_res(){
$connectionid=$_POST['connectionid'];
$query=$this->db->query("delete from e_".$connectionid."_edu_fav where id='".$_POST['id']."'");
if($query==TRUE){
$status=array('status'=>'true');	
}else{
$status=array('status'=>'false');	
}
echo json_encode($status);
exit;
}	
	
public function mobile_resource_exercises_download()
	{
$q1=mysql_query("select coursename, campusName as connectionid from course where new_id='".$_POST['course_id']."'");
		$s=mysql_fetch_array($q1);
	//$iddd=0;
	$z=1;
	//echo "select id from e_".$s['connectionid']."_edu_modules where course_id='".$_POST['course_id']."'" ;	
	$m=mysql_query("select id from e_".$s['connectionid']."_edu_modules where course_id='".$_POST['course_id']."' ");
	while($ms=mysql_fetch_array($m)){	
	if($z==1){
	$iddd=$ms['id'];
	}else{
	$iddd=$iddd.','.$ms['id'];	
	}
	$z++;}
	//echo "select * from e_".$s['connectionid']."_edu_topics where module_id in ($iddd)";
	$query=$this->db->query("select * from e_".$s['connectionid']."_edu_topics where module_id = '".$_POST['moduleid']."'");
	$tid=$query->rows;
	//echo '<pre>';
	
	$alldta=array();
	$answere=array();
	foreach($tid as $all_exe){
	//echo '1 <br />';	
	//print_r($all_exe);	
	$id1=$iddd;
	//echo "select headingname,id,exerciestype from e_".$s['connectionid']."_edu_headings where topic_id='".$all_exe['id']."' order by id asc";
	$query1=$this->db->query("select headingname,id,exerciestype from e_".$s['connectionid']."_edu_headings where topic_id='".$all_exe['id']."' order by id asc");
	$mm=$query1->rows;
	
	foreach($mm as $dat){
	/*$alldta[]=array('topicid' => $all_exe->id,
			'exerciseid' => $dat->id,
			'courseid' => $this->uri->segment(2),
			'mid' => $id1, 
			'headingname' => $dat->headingname,
            'exerciestype' => $dat->exerciestype
            );*/
	if($dat['exerciestype']=='Crosswords'){			
	$id=$dat['id'];
	$query=$this->db->query("select * from e_".$s['connectionid']."_edu_headings where id='".$id."'");	
	$heading_data=$query->row;
	$this->data['id'] =$heading_data['id'];
    $this->data['headingname'] =$heading_data['headingname'];
    $this->data['topic_id'] =$heading_data['topic_id'];
    $this->data['exerciestype'] =$heading_data['exerciestype'];
    $this->data['description'] =$heading_data['description'];
    $this->data['heading_audio'] =$heading_data['heading_audio']; 
    $this->data['heading_video'] =$heading_data['heading_video'];
    $this->data['modified_date'] =$heading_data['modified_date'];
    $this->data['rssfeedlink'] =$heading_data['rssfeedlink'];
	
	//echo "select ee.*,ea.id as favid, eh.headingname from e_".$s['connectionid']."_edu_excercises_crossword as ee left join e_".$s['connectionid']."_edu_fav as ea on ee.id=ea.resourceid inner join e_".$s['connectionid']."_edu_headings as eh on eh.id=ee.topic_id where ee.topic_id='".$heading_data['id']."' and ee.resourceid='".$_POST['resourceid']."'<br />";
	$query1=$this->db->query("select ee.*,ea.id as favid, eh.headingname from e_".$s['connectionid']."_edu_excercises_crossword as ee left join e_".$s['connectionid']."_edu_fav as ea on ee.id=ea.resourceid inner join e_".$s['connectionid']."_edu_headings as eh on eh.id=ee.topic_id where ee.topic_id='".$heading_data['id']."' and ee.resourceid='".$_POST['resourceid']."'");
	$exe_data=$query1->rows;		
	
foreach($exe_data as $exedata){
$query2=$this->db->query("select ee.*, eh.headingname, eh.topic_id as headid from e_".$s['connectionid']."_edu_excercises_crossword as ee inner join e_".$s['connectionid']."_edu_headings as eh on eh.id=ee.topic_id where ee.resourceid='".$_POST['resourceid']."'");	
$res_data=$query2->row;

$ans=array();
$Que=array();
$hnt=array();
//echo "select * from e_".$s['connectionid']."_edu_answere_crossword where crossword_id='".$exedata['id']."'";
$query3=$this->db->query("select * from e_".$s['connectionid']."_edu_answere_crossword where crossword_id='".$exedata['id']."'");		
$dat=$query3->row;
//echo '<pre>';
//print_r($dat);

$dat['answere']=unserialize($dat['answere']);
//print_r($ans);
$dat['question']=unserialize($dat['question']);
//print_r($Que);
$dat['hint']=unserialize($dat['hint']);

$dat['courseid']=$_POST['course_id'];
$dat['coursename']=$s['coursename'];
$dat['moduleid']=$id1;
$dat['headingid']=$res_data['headid'];
$dat['resourceid']=$heading_data['id'];
$dat['resourcename']=$res_data['headingname'];
$dat['exercisename']=$heading_data['headingname'];
//print_r($hnt);
$answere[]=$dat;
	
	}
	//echo '<pre>';
	//print_r($answere);
	$crossresult=array();
	if(!empty($answere)){
$query4	=$this->db->query("select * from e_".$s['connectionid']."_edu_result_crossword where heading_id='".$all_exe['id']."' and user_id='".$_POST['user_id']."' and connect_id='".$_POST['connectid']."' and user_id='".$_POST['user_id']."' order by id desc limit 0,5");
$crossresult=$query4->rows;
	}
	}else if($dat['exerciestype']=='Multiple choice questions'){
	$id=$dat['id'];
	//echo "select * from e_".$s['connectionid']."_edu_headings where id='".$id."'";
	$query=$this->db->query("select * from e_".$s['connectionid']."_edu_headings where id='".$id."'");	
	$heading_data=$query->row;
	$this->data['id'] =$heading_data['id'];
    $this->data['headingname'] =$heading_data['headingname'];
    $this->data['topic_id'] =$heading_data['topic_id'];
    $this->data['exerciestype'] =$heading_data['exerciestype'];
    $this->data['description'] =$heading_data['description'];
    $this->data['heading_audio'] =$heading_data['heading_audio']; 
    $this->data['heading_video'] =$heading_data['heading_video'];
    $this->data['modified_date'] =$heading_data['modified_date'];
    $this->data['rssfeedlink'] =$heading_data['rssfeedlink'];
	$fill=array();
	//echo "select * from e_".$s['connectionid']."_edu_excercises_multiplechoice where topic_id='".$heading_data['id']."' and exerciestype='Multiple choice questions' and resourceid='".$_POST['resourceid']."'<br />";
$query1=$this->db->query("select * from e_".$s['connectionid']."_edu_excercises_multiplechoice where topic_id='".$heading_data['id']."' and exerciestype='Multiple choice questions' and resourceid='".$_POST['resourceid']."'");		
$exe_data=$query1->rows;		
	
foreach($exe_data as $exedata){
$query2=$this->db->query("select ee.*, eh.headingname, eh.topic_id as headid from e_".$s['connectionid']."_edu_excercises_multiplechoice as ee left join e_".$s['connectionid']."_edu_headings as eh on eh.id=ee.topic_id where ee.resourceid='".$_POST['resourceid']."'");
$res_data=$query2->row;
$query3=$this->db->query("select * from e_".$s['connectionid']."_edu_excercises_multiplechoice where id='".$exedata['id']."'");
$dat=$query3->row;
$dat['courseid']=$_POST['course_id'];
$dat['coursename']=$s['coursename'];
$dat['moduleid']=$iddd;
$dat['headingid']=$res_data['headid'];
//$dat['resourceid']=$heading_data['id'];
$dat['resourcename']=$res_data['headingname'];
$dat['exercisename_multi']=$heading_data['headingname'];
//print_r($hnt);
$fill[]=$dat;
	
	}

	//$fill[]=$query1->result();
	$multiresult=array();
	if(!empty($fill)){
$query4=$this->db->query("select * from e_".$s['connectionid']."_edu_result where total_question !='0' and heading_id='".$all_exe['id']."' and connect_id='".$_POST['connectid']."' and user_id='".$_POST['user_id']."' order by id DESC limit 0,5");
$multiresult=$query4->rows;
	}
	}else if($dat['exerciestype']=='TrueFalse'){
	$id=$dat['id'];
	//echo "select * from e_".$s['connectionid']."_edu_headings where id='".$id."'";
	$query=$this->db->query("select * from e_".$s['connectionid']."_edu_headings where id='".$id."'");	
	$heading_data=$query->row;
	$this->data['id'] =$heading_data['id'];
    $this->data['headingname'] =$heading_data['headingname'];
    $this->data['topic_id'] =$heading_data['topic_id'];
    $this->data['exerciestype'] =$heading_data['exerciestype'];
    $this->data['description'] =$heading_data['description'];
    $this->data['heading_audio'] =$heading_data['heading_audio']; 
    $this->data['heading_video'] =$heading_data['heading_video'];
    $this->data['modified_date'] =$heading_data['modified_date'];
    $this->data['rssfeedlink'] =$heading_data['rssfeedlink'];
	$trfl=array();
	//echo "select * from e_".$s['connectionid']."_edu_excercises_multiplechoice where topic_id='".$heading_data['id']."' and exerciestype='Multiple choice questions' and resourceid='".$_POST['resourceid']."'<br />";
$query111=$this->db->query("select * from e_".$s['connectionid']."_edu_excercises_truefalse where topic_id='".$heading_data['id']."' and exerciestype='TrueFalse' and resourceid='".$_POST['resourceid']."'");		
$exe_data=$query111->rows;		
	
foreach($exe_data as $exedata){
$query211=$this->db->query("select ee.*, eh.headingname, eh.topic_id as headid from e_".$s['connectionid']."_edu_excercises_truefalse as ee left join e_".$s['connectionid']."_edu_headings as eh on eh.id=ee.topic_id where ee.resourceid='".$_POST['resourceid']."'");
$res_data=$query211->row;
$query311=$this->db->query("select * from e_".$s['connectionid']."_edu_excercises_truefalse where id='".$exedata['id']."'");
$dat=$query311->row;
$dat['courseid']=$_POST['course_id'];
$dat['coursename']=$s['coursename'];
$dat['moduleid']=$iddd;
$dat['headingid']=$res_data['headid'];
//$dat['resourceid']=$heading_data['id'];
$dat['resourcename']=$res_data['headingname'];
$dat['exercisename_multi']=$heading_data['headingname'];
//print_r($hnt);
$trfl[]=$dat;
	
	}

	//$fill[]=$query1->result();
	$trflresult=array();
	if(!empty($trfl)){
$query4=$this->db->query("select * from e_".$s['connectionid']."_edu_result_truefalse where total_question !='0' and heading_id='".$all_exe['id']."' and connect_id='".$_POST['connectid']."' and user_id='".$_POST['user_id']."' order by id DESC limit 0,5");
$trflresult=$query4->rows;
	}
	}else if($dat['exerciestype']=='Descripting'){
	$id=$dat['id'];
	//echo "select * from e_".$s['connectionid']."_edu_headings where id='".$id."'";
	$query=$this->db->query("select * from e_".$s['connectionid']."_edu_headings where id='".$id."'");	
	$heading_data=$query->row;
	$this->data['id'] =$heading_data['id'];
    $this->data['headingname'] =$heading_data['headingname'];
    $this->data['topic_id'] =$heading_data['topic_id'];
    $this->data['exerciestype'] =$heading_data['exerciestype'];
    $this->data['description'] =$heading_data['description'];
    $this->data['heading_audio'] =$heading_data['heading_audio']; 
    $this->data['heading_video'] =$heading_data['heading_video'];
    $this->data['modified_date'] =$heading_data['modified_date'];
    $this->data['rssfeedlink'] =$heading_data['rssfeedlink'];
	$desc=array();
	//echo "select * from e_".$s['connectionid']."_edu_excercises_descripting where topic_id='".$heading_data['id']."' and exerciestype='Descripting' and resourceid='".$_POST['resourceid']."'<br />";
$query111=$this->db->query("select * from e_".$s['connectionid']."_edu_excercises_descripting where topic_id='".$heading_data['id']."' and resourceid='".$_POST['resourceid']."'");		
$exe_data=$query111->rows;		
	
foreach($exe_data as $exedata){
$query21111=$this->db->query("select ee.*, eh.headingname, eh.topic_id as headid from e_".$s['connectionid']."_edu_excercises_descripting as ee left join e_".$s['connectionid']."_edu_headings as eh on eh.id=ee.topic_id where ee.resourceid='".$_POST['resourceid']."'");
$res_data=$query21111->row;
$query31111=$this->db->query("select * from e_".$s['connectionid']."_edu_excercises_descripting where id='".$exedata['id']."'");
$dat=$query31111->row;
$trflresul1t=array();

$query411=$this->db->query("select * from e_".$s['connectionid']."_edu_result_descripting where heading_id='".$all_exe['id']."' and connect_id='".$_POST['connectid']."' and user_id='".$_POST['user_id']."' order by id DESC limit 0,5");
$trflresult1=$query411->rows;


$dat['courseid']=$_POST['course_id'];
$dat['coursename']=$s['coursename'];
$dat['moduleid']=$iddd;
$dat['headingid']=$res_data['headid'];
$dat['answere']=$trflresult['answere'];
//$dat['resourceid']=$heading_data['id'];
$dat['resourcename']=$res_data['headingname'];
$dat['exercisename_multi']=$heading_data['headingname'];
//print_r($hnt);
$desc[]=$dat;
	
	}

	//$fill[]=$query1->result();
	
	}else if($dat['exerciestype']=='Fill in the blanks'){
	$id=$dat['id'];
	//echo "select * from e_".$s['connectionid']."_edu_headings where id='".$id."'";
	$query=$this->db->query("select * from e_".$s['connectionid']."_edu_headings where id='".$id."'");	
	$heading_data=$query->row;
	$this->data['id'] =$heading_data['id'];
    $this->data['headingname'] =$heading_data['headingname'];
    $this->data['topic_id'] =$heading_data['topic_id'];
    $this->data['exerciestype'] =$heading_data['exerciestype'];
    $this->data['description'] =$heading_data['description'];
    $this->data['heading_audio'] =$heading_data['heading_audio']; 
    $this->data['heading_video'] =$heading_data['heading_video'];
    $this->data['modified_date'] =$heading_data['modified_date'];
    $this->data['rssfeedlink'] =$heading_data['rssfeedlink'];
	$filll=array();
	//echo "select * from e_".$s['connectionid']."_edu_excercises_fillintheblanks where topic_id='".$heading_data['id']."' and exerciestype='Fill in the blanks' and resourceid='".$_POST['resourceid']."'<br />";
$query1=$this->db->query("select * from e_".$s['connectionid']."_edu_excercises_fillintheblanks where topic_id='".$heading_data['id']."' and exerciestype='Fill in the blanks' and resourceid='".$_POST['resourceid']."'");		
$exe_data=$query1->rows;		
	
foreach($exe_data as $exedata){
$query2=$this->db->query("select ee.*, eh.headingname, eh.topic_id as headid from e_".$s['connectionid']."_edu_excercises_fillintheblanks as ee left join e_".$s['connectionid']."_edu_headings as eh on eh.id=ee.topic_id where ee.resourceid='".$_POST['resourceid']."'");
$res_data=$query2->row;
$query3=$this->db->query("select * from e_".$s['connectionid']."_edu_excercises_fillintheblanks where id='".$exedata['id']."'");
$dat=$query3->row;
$dat['path']='klaspad/uploads/'.$s['connectionid'].'/'.$_POST['course_id'].'/exercise/';
$dat['courseid']=$_POST['course_id'];
$dat['coursename']=$s['coursename'];
$dat['moduleid']=$iddd;
$dat['headingid']=$res_data['headid'];
//$dat['resourceid']=$heading_data['id'];
$dat['resourcename']=$res_data['headingname'];
$dat['exercisename_multi']=$heading_data['headingname'];
//print_r($hnt);
$filll[]=$dat;
	
	}
	//$fill[]=$query1->result();
	$fillresult=array();
	if(!empty($filll)){
$query4=$this->db->query("select * from e_".$s['connectionid']."_edu_result_fillintheblanks where total_question !='0' and heading_id='".$all_exe['id']."' and connect_id='".$_POST['connectid']."' and user_id='".$_POST['user_id']."' order by id DESC limit 0,5");
$fillresult=$query4->rows;
	}
	}else if($dat['exerciestype']=='Write in the correct box'){
	$id=$dat['id'];
	//echo "select * from e_".$s['connectionid']."_edu_headings where id='".$id."'";
	$query=$this->db->query("select * from e_".$s['connectionid']."_edu_headings where id='".$id."'");	
	$heading_data=$query->row;
	$this->data['id'] =$heading_data['id'];
    $this->data['headingname'] =$heading_data['headingname'];
    $this->data['topic_id'] =$heading_data['topic_id'];
    $this->data['exerciestype'] =$heading_data['exerciestype'];
    $this->data['description'] =$heading_data['description'];
    $this->data['heading_audio'] =$heading_data['heading_audio']; 
    $this->data['heading_video'] =$heading_data['heading_video'];
    $this->data['modified_date'] =$heading_data['modified_date'];
    $this->data['rssfeedlink'] =$heading_data['rssfeedlink'];
	$draganddrop=array();
	//echo "select * from e_".$s['connectionid']."_edu_excercises_fillintheblanks where topic_id='".$heading_data['id']."' and exerciestype='Fill in the blanks' and resourceid='".$_POST['resourceid']."'<br />";
$query1=$this->db->query("select * from e_".$s['connectionid']."_edu_excercises_draganddrop where topic_id='".$heading_data['id']."' and exerciestype='Write in the correct box' and resourceid='".$_POST['resourceid']."'");		
$exe_data=$query1->rows;		
	
foreach($exe_data as $exedata){
$query2=$this->db->query("select ee.*, eh.headingname, eh.topic_id as headid from e_".$s['connectionid']."_edu_excercises_draganddrop as ee left join e_".$s['connectionid']."_edu_headings as eh on eh.id=ee.topic_id where ee.resourceid='".$_POST['resourceid']."'");
$res_data=$query2->row;
$query3=$this->db->query("select * from e_".$s['connectionid']."_edu_excercises_draganddrop where id='".$exedata['id']."'");
$dat=$query3->row;
	$blockdataa = array();	

	$query1111=$this->db->query("select * from e_".$s['connectionid']."_edu_excercises_blocks where exercise_id in (".@$exedata['id'].")");		
	//$this->db->where_in('exercise_id',@$msk1);
	//$query=$this->db->get('e_'.$this->session->userdata('connectid').'_edu_excercises_blocks');
	$blockdata= $query1111->rows;
			
	
	foreach($blockdata as $res)
				{
				$mq=array();	
				$mq=unserialize($res['myblock_question']);
				//echo '<pre>';
				//print_r($mq);	
					$blockdataa[]=array(
					'id'=>$res['id'],
					'nameofthemyblocks' => $res['nameofthemyblocks'],
					'exercise_id' => $res['exercise_id'],
					'myblocks' => $res['myblocks'],
					'myblock_question' => $mq
					);
									}
$dat['path']='klaspad/uploads/'.$s['connectionid'].'/'.$_POST['course_id'].'/exercise/';
$dat['courseid']=$_POST['course_id'];
$dat['coursename']=$s['coursename'];
$dat['moduleid']=$iddd;
$dat['headingid']=$res_data['headid'];
//$dat['resourceid']=$heading_data['id'];
$dat['resourcename']=$res_data['headingname'];
$dat['exercisename_multi']=$heading_data['headingname'];
$dat['blockdata']=$blockdataa;
//print_r($hnt);
$draganddrop[]=$dat;
	
	}
	//$fill[]=$query1->result();
	$ddresult=array();
	if(!empty($draganddrop)){
$query4=$this->db->query("select * from e_".$s['connectionid']."_edu_result_draganddrop where total_question !='0' and heading_id='".$all_exe['id']."' and connect_id='".$_POST['connectid']."' and user_id='".$_POST['user_id']."' order by id DESC limit 0,5");
$ddresult=$query4->rows;
	}
	}
	
	}
	
//echo '<pre>';	
//print_r($data['crossresult']);
$data=array('crossword'=>$answere,'crosswordresult'=>$crossresult, 'truefalse'=>$trfl, 'truefalseresult'=>$trflresult,'multiplechoice'=>$fill,'multiresult'=>$multiresult,'fillintheblanks'=>$filll,'fillresult'=>$fillresult,'descripting'=>$desc, 'draganddrop'=>$draganddrop, 'ddresult'=>$ddresult);
//echo json_encode($data);	
	
    }		
	
echo json_encode($data);		
/*$q=mysql_query("select connectionid from edu_courses where courseid='".$_POST['course_id']."'");
$s=mysql_fetch_array($q);

$mm=mysql_query('select * from e_'.$s['connectionid'].'_edu_answere_crossword');
while($ss=mysql_fetch_assoc($mm)){
$ss['answere']= unserialize($ss['answere']);
$ss['question']= unserialize($ss['question']);
$ss['hint']= unserialize($ss['hint']);
$answere[]=$ss;
}
$data=array('data'=>$answere);
echo json_encode($data);	*/
exit;	
	}	

public function mobile_image_pdf(){
	//print_r($_FILES['pdf_files_only']);
//echo "insert into e_".$_POST['connectionid']."_edu_excercises set exerciestype='Files', uploadimage='".$name."',excercisename='".$_POST['excercisename']."',conversationtopic='".$_POST['conversationtopic']."',description='".$_POST['description']."',learningoutcomes='".$_POST['learningoutcomes']."',notice='".$_POST['notice']."', topic_id='".$_POST['headingid']."'";
//exit;
$s=mysql_query('select m.course_id as course_id from e_'.$_POST['connectionid'].'_edu_modules as m inner join e_'.$_POST['connectionid'].'_edu_topics as t on t.module_id = m.id inner join e_'.$_POST['connectionid'].'_edu_headings as h on h.topic_id = t.id where h.id="'.$_POST['headingid'].'"');
	$course=mysql_fetch_array($s);
	$course['course_id'];
	$name=$_FILES['pdf_files_only']['name'];
	move_uploaded_file($_FILES["pdf_files_only"]["tmp_name"], "klaspad/uploads/".$_POST['connectionid']."/".$course['course_id']."/ppt/".$name);
	mysql_query("insert into e_".$_POST['connectionid']."_edu_excercises set exerciestype='Files', uploadimage='".$name."',excercisename='".$_POST['excercisename']."',conversationtopic='".$_POST['conversationtopic']."',description='".$_POST['description']."',learningoutcomes='".$_POST['learningoutcomes']."',notice='".$_POST['notice']."', topic_id='".$_POST['headingid']."'");
	$insertid=mysql_insert_id();
if(@$insertid!=''){
    $status=array('status'=>'resource uploaded successfully');	
}else{
	$status=array('status'=>'some problem with data');	
}
	echo json_encode($status);
	exit;
	}	
	
public function mobile_course_insert(){
		$connectid=$_POST['connectid'];
		unset($_POST['connectid']);
	$query=$this->db->insert('e_'.$connectid.'_edu_courses',$_POST);
	$id=$this->db->insert_id();

$_POST['connectionid']=$connectid;
$_POST['courseid']=$id;
$this->db->insert('edu_courses',$_POST);
$iddc=$this->db->insert_id();
unset($_POST['connectionid']);
unset($_POST['userid']);
unset($_POST['courseid']);

$dataa=array('modulename'=>$_POST['coursename'],'course_id'=>$id);
$this->db->insert('e_'.$connectid.'_edu_modules',$dataa);
	$idd=$this->db->insert_id();	
$daataa=array('topicname'=>$_POST['coursename'],'module_id'=>$idd);	
$this->db->insert('e_'.$connectid.'_edu_topics',$daataa);
$iddd=$this->db->insert_id();
	mkdir('uploads/'.$connectid."/".$id, 0700);
	mkdir('uploads/'.$connectid."/".$id."/ppt", 0700);
	mkdir('uploads/'.$connectid."/".$id."/websearch", 0700);
	mkdir('uploads/'.$connectid."/".$id."/exercise", 0700);
	mkdir('uploads/'.$connectid."/".$id."/topic", 0700);
	mkdir('uploads/'.$connectid."/".$id."/exercises", 0700);
	mkdir('uploads/'.$connectid."/".$id."/lessons", 0700);
	$random= "";
srand((double)microtime()*1000000);

$data = "ABCDE123IJKLMN67QRSTUVWXYZ"; 
//$data .= "aBCdefghijklmn123opq45rs67tuv89wxyz"; 
$data .= "0FGH45OP89";

for($i = 0; $i < 5; $i++) 
{ 
$random .= substr($data, (rand()%(strlen($data))), 1); 
}

$ref_no=$random;
	
	$this->db->where('id',$id);
	$daataaa=array('course_ref_no'=>$ref_no);
	$this->db->update('e_'.$connectid.'_edu_courses',$daataaa);
	$this->db->where('id',$iddc);
	$daataaaa=array('course_ref_no'=>$ref_no);
	$this->db->update('edu_courses',$daataaaa);
	
	if($_FILES['imageupload']['size']>0){
		$uploads_dir='uploads/'.$connectid.'/'.$id.'/exercise';
         $tmp_name = $_FILES["imageupload"]["tmp_name"];
         $name = $_FILES["imageupload"]["name"];
         move_uploaded_file($tmp_name, "$uploads_dir/$name");
	$this->db->where('id',$id);
	$daataa=array('imageupload'=>$name);
	$this->db->update('e_'.$connectid.'_edu_courses',$daataa);

	$this->db->where('id',$iddc);
	$daataa=array('imageupload'=>baseurl.'/'.$uploads_dir.'/'.$name);
	$this->db->update('edu_courses',$daataa);
	
	}
	if($query==TRUE){
	$this->db->where('id',$id);
	$daataa=array('topic_id'=>$iddd);
	$this->db->update('e_'.$connectid.'_edu_courses',$daataa);
	$status=array('status'=>'true');
	echo json_encode($status);
	}else{
	$status=array('status'=>'false');
	echo json_encode($status);
	}
	}	
	
public function delete_discussion_comments(){
	$query=$this->db->query("delete from e_".$_POST['connectid']."_edu_ans_assignment where id='".$_POST['id']."'");
	$query=$this->db->query("delete from edu_comments where commentid='".$_POST['id']."'");
	
	if($query==TRUE){
	$status=array('status'=>'true');	
	}else{
	$status=array('status'=>'false');	
	}	
	echo json_encode($status);
	}	
	
	
public function mobile_user_update(){
		if(isset($_FILES['user_image']['name'])){
			if($_FILES['user_image']['size']>0){
move_uploaded_file($_FILES["user_image"]["tmp_name"], "uploaded/photo/".$_FILES['user_image']['name']);
$_POST["user_image"]="uploaded/photo/".$_FILES['user_image']['name'];
$image=$_FILES['user_image']['name'];
		}
		}
	$conectionid=$_POST['connectionid'];
	unset($_POST['connectionid']);	
	$query1=$this->db->query("update e_".$conectionid."_edu_user set username='".$_POST['username']."', password='".$_POST['password']."', demo_address_line_1='".$_POST['demo_address_line_1']."', demo_address_line_2='".$_POST['demo_address_line_2']."', demo_city='".$_POST['demo_city']."', demo_postcode='".$_POST['demo_postcode']."', demo_country='".$_POST['demo_country']."', user_image='".$_POST['user_image']."' where id='".$_POST['userid']."'");
	
	$query1=$this->db->query("update user set username='".$_POST['username']."', password='".$_POST['password']."' where userid='".$_POST['userid']."'");
	$q=mysql_query("select studentID, staffID from user where userid='".$_POST['userid']."'");
	$s=mysql_fetch_array($q);
	if($s['studentID']!='' && $s['studentID']!=0){
	$query2=$this->db->query("update student set username='".$_POST['username']."', password='".$_POST['password']."', address1='".$_POST['demo_address_line_1']."', caddress1='".$_POST['demo_address_line_2']."', city1='".$_POST['demo_city']."', postcode1='".$_POST['demo_postcode']."', contact_country='".$_POST['demo_country']."', photo='".$image."' where preukid='".$s['studentID']."'");
	}else if($s['staffID']!='' && $s['staffID']!=0){
	$query2=$this->db->query("update staff set username='".$_POST['username']."', password='".$_POST['password']."', address1='".$_POST['demo_address_line_1']."', address2='".$_POST['demo_address_line_2']."', city='".$_POST['demo_city']."', postcode='".$_POST['demo_postcode']."', country='".$_POST['demo_country']."', photo='".$image."' where staffid='".$s['staffID']."'");
	}
	$query=$this->db->query("select * from e_".$conectionid."_edu_user where id='".$_POST['userid']."'");
	if(($query==TRUE)&&($query1==TRUE)){
	$data=$query->row;
	$status=array('status'=>'true','data'=>$data);
	}else{
	$status=array('status'=>'false','data'=>'no data');
	}
	echo json_encode($status);
	}		
	
public function add_update_notes(){
	$q=mysql_query("select campusName as connectid  from course where new_id='".$_POST['courseid']."'");
		$s=mysql_fetch_array($q);

	$query=$this->db->query("insert into e_".$s['connectid']."_edu_notes set courseid='".$_POST['resourceid']."', msg='".$_POST['msg']."', userid='".$_POST['userid']."', createddate='".date('d-m-Y h:m:s')."'");
	if($query==TRUE){
	$status=array('status'=>'ture');
	}else{
	$status=array('status'=>'false');
    }
	echo json_encode($status);
	}	
	
public function mobile_topic_list()
	{
	$idd=urldecode($_POST['moduleid']);
	$query=$this->db->query('select t.id,t.topicname from e_'.$_POST['connectionid'].'_edu_topics as t  where module_id = "'.$idd.'"');	
	$topicslist= $query->rows;
	$topicslistlist=array();
	foreach($topicslist as $result)
				{
					$topicslistlist[]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
									}
	
	$data=array( 'data'=>$topicslistlist);
echo json_encode($data);	

exit;
	}	
	
public function mobile_exercise_list()
	{
	$idd=urldecode($_POST['moduleid']);
	if(isset($_POST['exerciestype'])){
$query=$this->db->query('select id, headingname from  e_'.$_POST['connectionid'].'_edu_headings where exerciestype="'.$_POST['exerciestype'].'" and  topic_id='.$_POST['topicid'].''); 
}else{
$query=$this->db->query('select id, headingname from  e_'.$_POST['connectionid'].'_edu_headings where   topic_id='.$_POST['topicid'].''); 
}
	$exerciselist= $query->rows;
	$exerciselistlist=array();
	foreach($exerciselist as $result)
				{
					$exerciselistlist[]=array(
					'headingid'=>$result['id'],
					'headingname' => $result['headingname']
					);
									}
	
	$data=array( 'data'=>$exerciselistlist);
echo json_encode($data);	

exit;
	}	
	
public function mobile_insert_topics(){
	$q=mysql_query("select course_id from e_".$_POST['connectionid']."_edu_modules where id='".$_POST['moduleid']."'");
	$s=mysql_fetch_array($q);	
	mysql_query("insert into e_".$_POST['connectionid']."_edu_topics set topicname='".$_POST['topicname']."', module_id='".$_POST['moduleid']."' ");
	$id=mysql_insert_id();
	$status=array('topicid'=>$id);
    echo json_encode($status);
	exit;
	}	
	
public function mobile_insert_headings(){
	mysql_query("insert into e_".$_POST['connectionid']."_edu_headings set topic_id='".$_POST['topicid']."', exerciestype='".$_POST['exerciestype']."', headingname='".$_POST['headingname']."'");
	$id=mysql_insert_id();
	$status=array('topicid'=>$id);
    echo json_encode($status);
	exit;	
	}		
	
public function getcoutsedetails()
	{
		$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){
	$query=$this->db->query("select * from e_".$this->session->data['campusid']."_edu_courses where id='".$_GET['courseid']."'");	
	$mm=$query->row;
	
	$this->data['module_course_wise']=array();				
	$module_course_wise=$this->model_klaspad_klaspad->module_course_wise($_GET['courseid']);
	//echo '<pre>';
	//print_r(${'module'.$course['id']});
	foreach($module_course_wise as $result)
				{
				   $this->data['module_course_wise'][]=array(
					'id'=>$result['id'],
					'modulename' => $result['modulename'],
					'moduletype' => $result['moduletype'],
					'lti_id' => $result['lti_id']
					);
				}
	$this->data['coursename']=$mm['coursename'];			
	$this->data['description']=$mm['description'];
	$this->data['learningoutcomes']=$mm['learningoutcomes'];
	$this->data['videoupload']=$mm['videoupload'];
	$this->id       = 'content';
		$this->template = 'klaspad/getcoursedetails.php';
		//$this->layout   = 'module/layout';
		$this->render();		
	//$this->load->view('welcome/dash_board');
	}else{
    $this->session->data['messages']='You must Login First.';
  			$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}
public function mobile_audio_video_excercises(){
if(urldecode($_GET['type'])=='Add Video'){
if(isset($_FILES['pdf_files_only']['tmp_name'])){
//Start
$ffmpeg='C:\\ffmpeg\\bin\\ffmpeg';
$videoFile=$_FILES['pdf_files_only']['tmp_name'];
$imageFile="klaspad/uploads/".$_POST['connectionid']."/".time().".jpg";
$size="400x400";
$getFromSecond=0;
$cmd="$ffmpeg -i $videoFile -an -ss $getFromSecond -s $size $imageFile";
//echo "$ffmpeg -i $videoFile -an -ss $getFromSecond -s $size $imageFile";
shell_exec($cmd);
$imageFile=$imageFile;
//End		
}}
	
//STYart
if(urldecode($_GET['type'])=='Add Video'){
	$_POST['exerciestype']='Add Video';
	}else{
	$_POST['exerciestype']='Add Audio';
	}
	$s=mysql_query('select m.course_id as course_id from e_'.$_POST['connectionid'].'_edu_modules as m inner join e_'.$_POST['connectionid'].'_edu_topics as t on t.module_id = m.id inner join e_'.$_POST['connectionid'].'_edu_headings as h on h.topic_id = t.id where h.id="'.$_POST['headingid'].'"');
	$course=mysql_fetch_array($s);
	$course['course_id'];
	
	if(move_uploaded_file($_FILES["pdf_files_only"]["tmp_name"], "klaspad/uploads/".$_POST['connectionid']."/".$course['course_id']."/ppt/".$_FILES['pdf_files_only']['name'])){
	$name=$_FILES['pdf_files_only']['name'];
	}else{
	$name='';	
		}
if(urldecode($_GET['type'])=='Add Video'){
mysql_query("insert into e_".$_POST['connectionid']."_edu_excercises set excercises_youtube='".addslashes($_POST['excercises_youtube'])."', rssfeedlink='".$_POST['rssfeedlink']."', excercises_video='".$name."', excercisename='".$_POST['excercisename']."', video_icon='".$imageFile."', conversationtopic='".$_POST['conversationtopic']."', description='".$_POST['description']."', learningoutcomes='".$_POST['learningoutcomes']."', notice='".$_POST['notice']."', topic_id='".$_POST['headingid']."'");
}else{
mysql_query("insert into e_".$_POST['connectionid']."_edu_excercises set  rssfeedlink='".$_POST['rssfeedlink']."', excercises_audio='".$name."', excercisename='".$_POST['excercisename']."', conversationtopic='".$_POST['conversationtopic']."', description='".$_POST['description']."', learningoutcomes='".$_POST['learningoutcomes']."', notice='".$_POST['notice']."', topic_id='".$_POST['headingid']."'");	
}	
	$status=array('status'=>'resource uploaded successfully');	
	echo json_encode($status);
exit;
	}	
	
public function mobile_powerpoint(){
$s=mysql_query('select m.course_id as course_id from e_'.$_POST['connectionid'].'_edu_modules as m inner join e_'.$_POST['connectionid'].'_edu_topics as t on t.module_id = m.id inner join e_'.$_POST['connectionid'].'_edu_headings as h on h.topic_id = t.id where h.id="'.$_POST['headingid'].'"');
	$course=mysql_fetch_array($s);
	$course['course_id'];
	//for ($i = 0; $i < count($_FILES['pdf_files_only']['name']); $i++) {
	move_uploaded_file($_FILES["pdf_files_only"]["tmp_name"], "klaspad/uploads/".$_POST['connectionid']."/".$course['course_id']."/ppt/".$_FILES['pdf_files_only']['name']);		
    $ppApp = new COM("PowerPoint.Application");
    $ppApp->Visible = True;

    $strPath = realpath(basename(getenv($_SERVER["SCRIPT_NAME"]))); // C:/AppServ/www/myphp

    $ppName = "klaspad/uploads/".$_POST['connectionid']."/".$course['course_id']."/ppt/".$_FILES['pdf_files_only']['name'];

mysql_query("insert into e_".$_POST['connectionid']."_edu_excercises set exerciestype='Powerpoint presentation exercise', uploadimage='".$_FILES['pdf_files_only']['name'][$i]."', excercisename='".$_POST['excercisename']."', topic_id='".$_POST['headingid']."', rssfeedlink='".$_POST['rssfeedlink']."', description='".$_POST['wordssentence']."'");	

$insertid=mysql_insert_id();
   
   
    $FileName = "klaspad/uploads/".$_POST['connectionid']."/".$course['course_id']."/ppt/".$insertid;

    // Open Document 
    $ppApp->Presentations->Open(realpath($ppName));

    // Save Document 
    $ppApp->ActivePresentation->SaveAs($strPath."/".$FileName,17);  //'*** 18=PNG, 19=BMP **'
    //$ppApp->ActivePresentation->SaveAs(realpath($FileName),17);

    $ppApp->Quit;
    $ppApp = null;
	//}
	$status=array('status'=>'resource uploaded successfully');	
	echo json_encode($status);
	exit;
	}

public function mobile_saveassignmentresult(){
	$q=mysql_query("select * from e_".$_POST['connectionid']."_edu_result_assignment where assignmentid='".$_POST['assignmentid']."' and userid='".$_POST['userid']."'");
	$cnt=mysql_num_rows($q);
	if($cnt>0){
	mysql_query("update e_".$_POST['connectionid']."_edu_result_assignment set description='".$_POST['description']."', submitted='".$_POST['submitted']."' where assignmentid='".$_POST['assignmentid']."' and userid='".$_POST['userid']."'");	
	}else{
	mysql_query("insert into e_".$_POST['connectionid']."_edu_result_assignment set assignmentid='".$_POST['assignmentid']."', userid='".$_POST['userid']."', description='".addslashes($_POST['description'])."', submitted='".$_POST['submitted']."', createddate='".date('d-m-Y')."'");
	}
if($_POST['submitted']=='1'){	
$data=array('status'=>'Assignment Submitted Successfully');	
}else{
$data=array('status'=>'Assignment Saved Successfully');	
}
echo json_encode($data);
	exit;
	}

public function mobile_showassignmentresult(){
	$q=mysql_query("select * from e_".$_POST['connectionid']."_edu_result_assignment where assignmentid='".$_POST['assignmentid']."' and userid='".$_POST['userid']."'");
	$cc=mysql_num_rows($q);
	$cnt=mysql_fetch_array($q);
	if($cc>0){
	if($cnt['description']!=''){
	$des=$cnt['description'];	
	}else{
	$des='';	
	}
	if($cnt['submitted']!='0'){
	$sub=$cnt['submitted'];	
	}else{
	$sub='0';	
	}
	}else{
	$des='';
	$sub='0';	
	}
$data=array('description'=>$des,'submitted'=>$sub);
echo json_encode($data);
exit;	
	}

public function getterm(){
$q=mysql_query("select staffID from user where userid='".$_POST['userid']."'");
$s=mysql_fetch_array($q);	
$query=$this->db->query("select asid, sessionname from  academicsession where asid in (select distinct asid from academicsessionstudent where staffid='".$s['staffID']."')"); 

	$exerciselist= $query->rows;
	$sessionlist=array();
	foreach($exerciselist as $result)
				{
					$sessionlist[]=array(
					'asid'=>$result['asid'],
					'sessionname' => $result['sessionname']
					);
									}
	
	$data=array( 'data'=>$sessionlist);
echo json_encode($data);	

exit;	
}

public function getmodule(){
$q=mysql_query("select staffID from user where userid='".$_POST['userid']."'");
$s=mysql_fetch_array($q);	
$query=$this->db->query("select moduleid, modulename, new_id from  coursemodule where moduleid in (select distinct moduleid from academicsessionstudent where staffid='".$s['staffID']."' and asid='".$_POST['asid']."')"); 

	$exerciselist= $query->rows;
	$modulelist=array();
	foreach($exerciselist as $result)
				{
					$modulelist[]=array(
					'moduleid'=>$result['moduleid'],
					'modulename' => $result['modulename'],
					'new_id' => $result['new_id']
					);
									}
	
	$data=array( 'data'=>$modulelist);
echo json_encode($data);	

exit;	
}

public function getsection(){
$q=mysql_query("select staffID from user where userid='".$_POST['userid']."'");
$s=mysql_fetch_array($q);	
$query=$this->db->query("select distinct section from  academicsessionstudent where staffid='".$s['staffID']."' and asid='".$_POST['asid']."' and moduleid='".$_POST['moduleid']."'"); 

	$exerciselist= $query->rows;
	$section=array();
	foreach($exerciselist as $result)
				{
					$section[]=array(
					'section'=>$result['section']
					);
									}
	
	$data=array( 'data'=>$section);
echo json_encode($data);	

exit;	
}

public function getstudent(){
$q=mysql_query("select staffID from user where userid='".$_POST['userid']."'");
$s=mysql_fetch_array($q);	
$query=$this->db->query("select distinct studentid from  academicsessionstudent where staffid='".$s['staffID']."' and asid='".$_POST['asid']."' and moduleid='".$_POST['moduleid']."' and section='".$_POST['section']."'"); 

	$exerciselist1= $query->rows;
$query1=$this->db->query("select distinct studentid from  arch_academicsessionstudent where staffid='".$s['staffID']."' and asid='".$_POST['asid']."' and moduleid='".$_POST['moduleid']."' and section='".$_POST['section']."'"); 

	$exerciselist2= $query1->rows;
	$exerciselist=array_merge($exerciselist1,$exerciselist2);	
	$student=array();
	foreach($exerciselist as $result)
				{
	$quer1=$this->db->query("select * from student where preukid='".$result['studentid']."'");
	$rr=$quer1->row;
	$totcheld=0;$totpresent=0;$totabsent=0;$totlate=0;$totle=0;$total=0;
					  if($_POST['asid']!=''){
						$asid=" and asid='".$_POST['asid']."'";  
					  }else{
						$asid="";  
					  }
					   if($_POST['moduleid']!=''){
						$moduleid=" and a.moduleid='".$_POST['moduleid']."'";  
					  }else{
						$moduleid="";  
					  }
					 
//echo "select * from att_overview as a left join coursemodule as c on c.moduleid=a.moduleid where studentid='".$students['preukid']."' $asid $moduleid ";					  
			 $attqry=mysql_query("select a.*,c.*, s.course1 from att_overview as a left join coursemodule as c on c.moduleid=a.moduleid left join student as s on s.preukid=a.studentid where studentid='".$rr['preukid']."' $asid $moduleid order by a.moduleid ");
			 while($attresule=mysql_fetch_array($attqry)){ 
			 $totcheld=$totcheld+$attresule['classheld'];
			 $totpresent=$totpresent+$attresule['present'];
			 $totabsent=$totabsent+$attresule['absent'];
			 $totlate=$totlate+$attresule['late'];
			 $totle=$totle+$attresule['leftearly'];
			 $total=$total+$attresule['authorisedleave']	;
			 }
			 if(($totcheld)!=0){ $attP= round(((($totpresent+$total+$totlate+$totle)/($totcheld))*100),2);}else{ $attP= '0';}			
					$student[]=array(
					'preukid='=>$rr['preukid'],
					'studentid='=>$rr['referenceno'],
					'studentname='=>$rr['studentname'],
					'surname='=>$rr['surname'],
					'phoneno='=>$rr['currentphone'],
					'email='=>$rr['currentemail'],
					'attendance'=>$attP
					);
									}
	
	$data=array( 'data'=>$student);
echo json_encode($data);	

exit;	
}

public function mobile_insert_assiement(){
	mysql_query("insert into e_".$_POST['connectionid']."_edu_excercises_assignment set topic_id='".$_POST['headingid']."', excercisename='Add assignment', question='".addslashes($_POST['assessment'])."', resourceid='".$_POST['resourceid']."'");	
    //$this->session->set_flashdata('message', 'Add successfully');	
	$status=array('status'=>'resource uploaded successfully');	
	echo json_encode($status);
	exit;
	}	


public function mobile_resource_list()
	{
	$idd=urldecode($_POST['moduleid']);
	//echo "select course_id from e_".$_POST['connectionid']."_edu_modules where id='".$_POST['moduleid']."'";
	$q=mysql_query("select course_id from e_".$_POST['connectionid']."_edu_modules where id='".$_POST['moduleid']."'");
	$s=mysql_fetch_array($q);
	//echo 'select eh.headingname, ee.id as resourceid from e_'.$_POST['connectionid'].'_edu_headings as eh inner join e_'.$_POST['connectionid'].'_edu_excercises as ee on ee.topic_id=eh.id left join e_'.$_POST['connectionid'].'_edu_fav as ea on ee.id=ea.resourceid inner join e_'.$_POST['connectionid'].'_edu_topics as tt on eh.topic_id=tt.id inner join e_'.$_POST['connectionid'].'_edu_modules as mm on mm.id=tt.module_id inner join e_'.$_POST['connectionid'].'_edu_courses as cc on cc.id=mm.course_id  where cc.id = "'.$s['course_id'].'" and (eh.exerciestype = "Powerpoint presentation exercise" or eh.exerciestype ="Add Folder" or eh.exerciestype ="Files" or eh.exerciestype ="Add Audio" or eh.exerciestype ="Add Video"or eh.exerciestype ="Add assignment") group by ee.topic_id';
	
	$query=$this->db->query('select eh.headingname, ee.id as resourceid from e_'.$_POST['connectionid'].'_edu_headings as eh inner join e_'.$_POST['connectionid'].'_edu_excercises as ee on ee.topic_id=eh.id left join e_'.$_POST['connectionid'].'_edu_fav as ea on ee.id=ea.resourceid inner join e_'.$_POST['connectionid'].'_edu_topics as tt on eh.topic_id=tt.id inner join e_'.$_POST['connectionid'].'_edu_modules as mm on mm.id=tt.module_id inner join e_'.$_POST['connectionid'].'_edu_courses as cc on cc.id=mm.course_id  where cc.id = "'.$s['course_id'].'" and (eh.exerciestype = "Powerpoint presentation exercise" or eh.exerciestype ="Add Folder" or eh.exerciestype ="Files" or eh.exerciestype ="Add Audio" or eh.exerciestype ="Add Video") group by ee.topic_id');
	$exerciselist= $query->rows;
	$exerciselistlist=array();
	foreach($exerciselist as $result)
				{
					$exerciselistlist[]=array(
					'resourceid'=>$result['resourceid'],
					'headingname' => $result['headingname']
					);
									}
	
	$data=array( 'data'=>$exerciselistlist);
echo json_encode($data);	

exit;
	}

public function attempt() {
        	$this->load->model('mystudents/mystudents');
	$id=$_POST['moduleid'];
	$query= $this->db->query("select course_id, modulename, description, learningoutcomes from e_".$_POST['connectionid']."_edu_modules where id='".$id."' ");	
	$module_data=$query->row;
	$this->data['course_id']=$module_data['course_id'];
	$this->data['modulename']=$module_data['modulename'];
	$all_exee=array();
	if($_GET['moduleid']){	
	$id=$_GET['moduleid'];
	}else{
	$id=$_POST['moduleid'];
	}
	//echo "select * from e_".$this->session->data['campusid']."_edu_topics where module_id='".$id."' ";
	$query1= $this->db->query("select * from e_".$_POST['connectionid']."_edu_topics where module_id='".$id."' ");	
	
	$all_exe1= $query1->rows;
	//echo '<pre>';
	//print_r($all_exe);
	$id=$_POST['topicid'];
	$str=" and id='".$id."' ";	
	$query2= $this->db->query("select * from e_".$_POST['connectionid']."_edu_topics where module_id='".$_GET['moduleid']."' $str ");	
	$intro_topics= $query2->row;
	//$intro_topics=$this->model_mystudents_mystudents->intro_topics1();
	foreach($all_exe1 as $all_exe){
	
	$exe_type=array();	
	if(isset($_POST['topicid'])){
	$id11=$_POST['topicid'];
	$id111=$_POST['moduleid'];
	$query3= $this->db->query("select headingname,id,exerciestype from e_".$_POST['connectionid']."_edu_headings where topic_id='".$all_exe['id']."' order by id asc ");		
	$mm=$query3->rows;
	$sstrr=" and topic_id='".$id1111."' ";
	}else{
	$id111=$_GET['moduleid'];
	$query3= $this->db->query("select headingname,id,exerciestype from e_".$_POST['connectionid']."_edu_headings where topic_id='".$all_exe['id']."' order by id asc ");		
	$mm=$query3->rows;
	$sstrr='';
	//$this->db->where('topic_id',$mm->id);
		}
	$query4= $this->db->query("select * from e_".$_POST['connectionid']."_edu_excercises where 1 $sstrr ");	
	$result[0]=$query4->rows;
	$result[1]=$mm;
	$ed= $result;				
	//$ed=$this->model_mystudents_mystudents->exercise_data1($all_exe['id']);
	//print_r(${'exe_'.$all_exe['id']}[1]);
	foreach($ed[1] as $exe_dta){
	$exe_type[]=array(
			'id' => $exe_dta['id'],
            'headingname' => $exe_dta['headingname'],
            'exerciestype' => $exe_dta['exerciestype']
					);
	}
	$all_exee[]=array(
			'id' => $all_exe['id'],
            'topicname' => $all_exe['topicname'],
			'courseid' => $module_data['course_id'],
            'module_id' => $all_exe['module_id'],
            'numberofheadings' => $all_exe['numberofheadings'],
            'topicno' => $all_exe['topicno'],
            'description' => $all_exe['description'],
            'learningoutcomes' => $all_exe['learningoutcomes'],
            'exerciestype' => $all_exe['exerciestype'],
            'introvideo' => $all_exe['introvideo'],
			'exercise'=>$exe_type,
            'modified_date' => $all_exe['modified_date']
					);
	
    }
	$data=array( 'data'=>$all_exee);
echo json_encode($data);
        
      } 

public function conference(){
$q=$this->db->query("select * from conferenceschedule where createddate>='".date('Y-m-d')."'");
$s=$q->rows;
$con=array();
				foreach($s as $s){
				$con[]=array(
			'id' => $s['id'],
            'description' => $s['description'],
            'heading' => $s['heading'],
            'sessionid' => $s['sessionid'],
            'token' => $s['token']
					);	

				}
$data=array( 'conference'=>$con);
echo json_encode($data);				
				
}

public function topics_list()
	{	
	$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){	
	$record=$this->model_klaspad_klaspad->topics_list_list_list();
	$this->data['topiclist']=array();
				foreach($record as $s){
				$this->data['topiclist'][]=array(
			'id' => $s['id'],
            'coursename' => $s['coursename'],
            'modulename' => $s['modulename'],
            'topicname' => $s['topicname']
            );	

				}
	//$this->load->view('topics/list_topics',$data);
	$this->id       = 'content';
	$this->template = 'klaspad/list_topics.php';
	$this->render();		
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}
public function topics_list_sorting()
	{	
	$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){	
	$record=$this->model_klaspad_klaspad->topics_list_list_list_sorting();
	$this->data['topiclist']=array();
				foreach($record as $s){
				$this->data['topiclist'][]=array(
			'id' => $s['id'],
            'coursename' => $s['coursename'],
            'modulename' => $s['modulename'],
            'topicname' => $s['topicname']
            );	

				}
	//$this->load->view('topics/list_topics',$data);
	$this->id       = 'content';
	$this->template = 'klaspad/list_topics_sorting.php';
	$this->render();		
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}
public function headings_list()
	{
	$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){	
	$record=$this->model_klaspad_klaspad->headings_list();
	//echo '<pre>';
	//print_r($record);
	$this->data['headinglist']=array();
				foreach($record as $s){
				$this->data['headinglist'][]=array(
			'id' => $s['id'],
            'coursename' => $s['coursename'],
            'modulename' => $s['modulename'],
            'topicname' => $s['topicname'],
			'headingname' => $s['headingname']
            );	

				}
	//$this->load->view('headings/list_headings',$data);
	$this->id       = 'content';
	$this->template = 'klaspad/list_headings.php';
	$this->render();		
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	}
	}
public function headings_list_sorting()
	{
	$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){	
	$record=$this->model_klaspad_klaspad->headings_list_sorting();
	//echo '<pre>';
	//print_r($record);
	$this->data['headinglist']=array();
				foreach($record as $s){
				$this->data['headinglist'][]=array(
			'id' => $s['id'],
            'coursename' => $s['coursename'],
            'modulename' => $s['modulename'],
            'topicname' => $s['topicname'],
			'headingname' => $s['headingname']
            );	

				}
	//$this->load->view('headings/list_headings',$data);
	$this->id       = 'content';
	$this->template = 'klaspad/list_headings_sorting.php';
	$this->render();		
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	}
	}
public function delete_topics()
	{
	$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){	
	$this->model_klaspad_klaspad->delete_topics();
    //$_SESSION['tid']=$_GET['topicid'];
	?>
   <script>
   parent.window.hs.getExpander().close();
   parent.location.reload();
   </script>
	<?php
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	}
	}

public function delete_headings()
	{
	$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){	
	$this->model_klaspad_klaspad->delete_headings();
    $_SESSION['tid']=$_GET['topicid'];
	?>
   <script>
   parent.window.hs.getExpander().close();
   parent.location.reload();
   </script>
	<?php
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	}
	}

public function add_fill_in_the_blank()
	{
	$this->load->model('klaspad/klaspad');	
	$courselist=$this->model_klaspad_klaspad->courses_list_new();
	$this->data['courseid']=$courselist['id'];
	$this->data['coursename']=$courselist['coursename'];
	$modulelist=$this->model_klaspad_klaspad->modules_list_new();	
	$this->data['moduleid']=$modulelist['id'];
	$this->data['modulename']=$modulelist['modulename'];
	$this->data['topicslistlist'] = array();	
	$topicslistlist=$this->model_klaspad_klaspad->topics_list_list_new_new();
	foreach($topicslistlist as $result)
				{
					$this->data['topicslistlist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
									}
	$this->data['topiclist'] = array();										
	$topiclist=$this->model_klaspad_klaspad->topics_list();	
		
	foreach($topiclist as $result)
				{
					$this->data['topiclist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
									}
	$this->data['resourcelist'] = array();									
	$resourcelist=$this->model_klaspad_klaspad->resource_list();
	foreach($resourcelist as $result)
				{
					$this->data['resourcelist'][]=array(
					'resourceid'=>$result['resourceid'],
					'headingname' => $result['headingname']
					);
				}
	if(isset($this->session->data['userid'])){	
	if(@$_GET['exerciseid']){
	$record=$this->model_klaspad_klaspad->excercises_record_fill();
	$this->data['id']=$record['id'];	
	$this->data['exerciestype']=$record['exerciestype'];
	$this->data['wordssentence']=$record['wordssentence'];	
	}else{
	}
	$this->id       = 'content';
	$this->template = 'klaspad/fill_in_the_blank.php';
	$this->render();	
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
public function insert_excercises()
	{
	$this->load->model('klaspad/klaspad');		
	if(isset($this->session->data['userid'])){
	//$id=$this->model_klaspad_klaspad->insert_excercises();
	
	if($_POST['exerciestype']=='Write in the correct box'){
	$id=$this->model_klaspad_klaspad->insert_excercises_dd();	
	$this->redirect($this->url->https('klaspad/klaspad/write_in_the_correct_box&type='.@$_GET['type'].'&moduleid='.@$_GET['moduleid'].'&exerciseid='.@$id));
		}elseif($_POST['exerciestype']=='Fill in the blanks'){
	$id=$this->model_klaspad_klaspad->insert_excercises();		
	$this->redirect($this->url->https('klaspad/klaspad/add_fill_in_the_blank&type='.@$_GET['type'].'&moduleid='.@$_GET['moduleid'].'&exerciseid='.@$id));				
	//redirect('add_fill_in_the_blank/'.$this->uri->segment(2).'/'.$_POST['course_id'].'/'.$data['id']);			
			}

	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}	

public function insert_excercises_step_2()
	{
	$this->load->model('klaspad/klaspad');		
	if(isset($this->session->data['userid'])){
	$data['id']=$this->model_klaspad_klaspad->insert_excercises_step_2();
    //$this->session->set_flashdata('message', 'Excercise added successfully');
	?>
   <script>
   parent.window.hs.getExpander().close();
   parent.location.reload();
   </script>
	<?php }else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}

public function checkyouranswere_fill()
	{
	$this->load->model('klaspad/klaspad');		
	if(isset($this->session->data['userid'])){	
	$all_check=$this->model_klaspad_klaspad->checkanswere_fill();
	$this->data['answere']=$all_check['answere'];
	//echo '<pre>';
	//print_r($all_check);
	$this->id       = 'content';
	$this->template = 'klaspad/checkyouranswere_fill.php';
	$this->render();	
	//$this->load->view('exercisedashboard/checkyouranswere',$data);
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}
public function saveresult_fill(){
	$this->load->model('klaspad/klaspad');	
	$this->model_klaspad_klaspad->saveresult_fill();
    //$this->session->set_flashdata('message', 'Result saved');	
	$this->redirect($_SERVER['HTTP_REFERER']);
	}
public function saveresult_descripting(){
	$this->load->model('klaspad/klaspad');	
	$this->model_klaspad_klaspad->saveresult_descripting();
    //$this->session->set_flashdata('message', 'Result saved');	
	$this->redirect($_SERVER['HTTP_REFERER']);
	}
	
public function saveresult_descripting_mobile(){
	$total_question=$_POST['count'];
	$heading_id=$_POST['topicid'];
    $user_id=$_POST['user_id'];
	$connect_id=$_POST['connectionid'];
	$course_id=$_POST['courseid'];
	$module_id=$_POST['mid'];
	$topic_id=$_POST['headingid'];
	for($i=1;$i<=$total_question; $i++){
	if(@$_POST['did'.$i]!=''){	
	mysql_query("update e_".$_POST['connectionid']."_edu_result_descripting set total_question='".$total_question."', correct_question='0', worng_question='0', user_id='".$user_id."', connect_id='".$connect_id."', course_id='".$course_id."', module_id='".$module_id."', topic_id='".$topic_id."', heading_id='".$heading_id."', answere='".addslashes($_POST['answere'.$i])."', did='".$_POST['answereid'.$i]."' where id='".$_POST['did'.$i]."' ");
	}else{
	mysql_query("insert into e_".$_POST['connectionid']."_edu_result_descripting set total_question='".$total_question."', correct_question='0', worng_question='0', user_id='".$user_id."', connect_id='".$connect_id."', course_id='".$course_id."', module_id='".$module_id."', topic_id='".$topic_id."', heading_id='".$heading_id."', answere='".addslashes($_POST['answere'.$i])."', did='".$_POST['answereid'.$i]."' ");	
	}
	}
	$this->redirect($this->url->https('klaspad/klaspad/exercise_courses_details&courseid='.$_POST['courseid'].'&exerciseid='.$_POST['exerciseid'].'&heading_id='.$_POST['headingid'].'&user_id='.$_POST['user_id'].'&connect_id='.$_POST['connect_id'].'&exerciestype='.$_POST['exerciestype']));	
	}
	
public function add_write_in_the_correct_box()
	{
	$this->load->model('klaspad/klaspad');	
	$courselist=$this->model_klaspad_klaspad->courses_list_new();
	$this->data['courseid']=$courselist['id'];
	$this->data['coursename']=$courselist['coursename'];
	$modulelist=$this->model_klaspad_klaspad->modules_list_new();	
	$this->data['moduleid']=$modulelist['id'];
	$this->data['modulename']=$modulelist['modulename'];
	$this->data['topicslistlist'] = array();	
	$topicslistlist=$this->model_klaspad_klaspad->topics_list_list_new_new();
	foreach($topicslistlist as $result)
				{
					$this->data['topicslistlist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
									}
	$this->data['topiclist'] = array();										
	$topiclist=$this->model_klaspad_klaspad->topics_list();	
		
	foreach($topiclist as $result)
				{
					$this->data['topiclist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
									}
	$this->data['resourcelist'] = array();									
	$resourcelist=$this->model_klaspad_klaspad->resource_list();
	foreach($resourcelist as $result)
				{
					$this->data['resourcelist'][]=array(
					'resourceid'=>$result['resourceid'],
					'headingname' => $result['headingname']
					);
				}	
	if(isset($this->session->data['userid'])){	
	if(@$_GET['exerciseid']){
	$record=$this->model_klaspad_klaspad->excercises_record_dd();
	$this->data['id']=$record['id'];	
	$this->data['exerciestype']=$record['exerciestype'];
	$this->data['wordssentence']=$record['wordssentence'];	
	}else{
	}
	$this->id       = 'content';
	$this->template = 'klaspad/write_in_the_correct_box.php';
	$this->render();	
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}	
public function write_in_the_correct_box()
	{
	$this->load->model('klaspad/klaspad');
	$this->data['blockdata'] = array();			
	$blockdata=$this->model_klaspad_klaspad->blocks_list();	
	foreach($blockdata as $res)
				{
					$this->data['blockdata'][]=array(
					'id'=>$res['id'],
					'nameofthemyblocks' => $res['nameofthemyblocks'],
					'exercise_id' => $res['exercise_id'],
					'myblocks' => $res['myblocks'],
					'myblock_question' => $res['myblock_question']
					);
									}
	
	$this->data['topiclist'] = array();										
	$topiclist=$this->model_klaspad_klaspad->topics_list();	
		
	foreach($topiclist as $result)
				{
					$this->data['topiclist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
									}
	if(isset($this->session->data['userid'])){	
	if(@$_GET['exerciseid']){
	$record=$this->model_klaspad_klaspad->excercises_record_dd();	
	$this->data['id']=$record['id'];	
	$this->data['exerciestype']=$record['exerciestype'];
	$this->data['wordssentence']=$record['wordssentence'];
		}else{
	
	}
	$this->id       = 'content';
	$this->template = 'klaspad/write_in_the_correct_box.php';
	$this->render();
		}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}	
	
public function write_in_the_correct_box_insert()
	{
		$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){	
	$data['id']=$this->model_klaspad_klaspad->write_in_the_correct_box_insert();
    //$this->session->set_flashdata('message', 'Excercise added successfully');
	?>
   <script>
   parent.window.hs.getExpander().close();
   parent.location.reload();
   </script>
	<?php
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}	
	
public function write_in_the_box_checkyouranswere()
	{
	$this->load->model('klaspad/klaspad');	
	if(isset($this->session->data['userid'])){	
	$res=$this->model_klaspad_klaspad->write_in_the_box_checkyouranswere();	
	$this->data['id']=$res['id'];
	$this->data['nameofthemyblocks'] = $res['nameofthemyblocks'];
	$this->data['exercise_id'] = $res['exercise_id'];
	$this->data['myblocks'] = $res['myblocks'];
	$this->data['myblock_question'] = $res['myblock_question'];
	$this->id       = 'content';
	$this->template = 'klaspad/write_in_the_box_checkyouranswere.php';
	$this->render();
	//$this->load->view('exercisedashboard/write_in_the_box_checkyouranswere',$data);
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 
	}	
	
public function assignmentdetails()
	{
	$q=mysql_query("select question,submissiondate,latesubmission,lastsubmissiondate,resubmission from e_".$this->session->data['campusid']."_edu_excercises_assignment where id='".$_GET['id']."'");
	$s=mysql_fetch_array($q);
	$this->data['topic'] = $s['question'];
	$this->data['submissiondate'] = $s['submissiondate'];
	$this->data['latesubmission'] = $s['latesubmission'];
	$this->data['lastsubmissiondate'] = $s['lastsubmissiondate'];
	$this->data['resubmission'] = $s['resubmission'];
	$this->id       = 'content';
	$this->template = 'klaspad/assignmentdetails.php';
	$this->render();
	}	
	
public function home_dash_board(){
	$z=1;
 $pq=$this->db->query("select * from dash_post order by createddate desc");
 $postq=$pq->rows;
 $post=array();
 foreach($postq as $posts){
	 if($posts['image']!=''){
		$url='uploaded/postimage/';
		$type='image';	 
	 }else if($posts['video']!=''){
		$url='uploaded/postvideo/';
		$type='video';	 	 
	 }else{
		 $url='';
		 $type='text';
	 }
$useq=mysql_query("select staffID, studentID from user where userid='".$posts['userid']."'");
$uses=mysql_fetch_array($useq);
if($uses['staffID']!=0){
	$picq=mysql_query("select * from staff where staffid='".$uses['staffID']."'");
	$pics=mysql_fetch_array($picq);
	$picimg=$pics['photo'];
	$uname=$pics['staffname'].''.$pics['surname'];
	$postusertype='provider';
}else{
	$picq=mysql_query("select * from student where preukid='".$uses['studentID']."'");
	$pics=mysql_fetch_array($picq);
	$picimg=$pics['photo'];
	$uname=$pics['studentname'].''.$pics['surname'];
	$postusertype='learner';
}
$pq11=$this->db->query("select * from dash_post_comment where postid='".$posts['id']."' order by createddate");
$postq11=$pq11->rows;
$comment=array();
 foreach($postq11 as $posts11){
$useq21=mysql_query("select staffID, studentID from user where userid='".$posts11['userid']."'");
$uses21=mysql_fetch_array($useq21);
if($uses21['staffID']!=0){
	$picq21=mysql_query("select photo from staff where staffid='".$uses21['staffID']."'");
	$pics21=mysql_fetch_array($picq21);
	$picimg21=$pics21['photo'];
	$commentusertype='provider';
}else{
	$picq21=mysql_query("select photo from student where preukid='".$uses21['studentID']."'");
	$pics21=mysql_fetch_array($picq21);
	$picimg21=$pics21['photo'];
	$commentusertype='learner';
}
					$comment[]=array(
					'id'=>$posts11['id'],
					'userid' => $posts11['userid'],
					'postid' => $posts11['postid'],
					'comment' => $posts11['comment'],
					'commentusertype' => $commentusertype,
					'commentuserimage' => 'uploaded/photo/'.$picimg21,
					'craeteddate' => $posts11['createddate']
					);
	 
}



					$post[]=array(
					'id'=>$posts['id'],
					'userid' => $posts['userid'],
					'text' => $posts['text'],
					'image' => $posts['image'],
					'video' => $posts['video'],
					'url' => $url,
					'type' => $type,
					'postusertype' => $postusertype,
					'postuserimage' => 'uploaded/photo/'.$picimg,
					'postusername' => $uname,
					'comment' => $comment,
					'craeteddate' => $posts['createddate']
					);
	}
	//echo '<pre>';
	//print_r($post);
$data=array( 'dash'=>$post);	
echo json_encode($data);		
}
	
public function inserttextpost(){
	mysql_query("insert into dash_post set text='".addslashes($_POST['posttext'])."', createddate='".date('Y-m-d H:m:s')."', userid='".$_POST['userid']."'");
	$this->redirect($this->url->https('klaspad/klaspad/home_dash_board'));
}	
	
public function insertimagevideopost(){
	$imgname='';
	$videoname='';
	if($_POST['posttype']=='image'){
	$uploaddir ='uploaded/postimage/'; 
		$file = $uploaddir . basename($_FILES['uploadfile']['name']);
		$f= $_FILES['uploadfile']['name'];
		move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file);	
		$imgname=basename($_FILES['uploadfile']['name']);
	}else{
	$uploaddir ='uploaded/postvideo/'; 
		$file = $uploaddir . basename($_FILES['uploadfile']['name']);
		$f= $_FILES['uploadfile']['name'];
		move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file);	
		$videoname=basename($_FILES['uploadfile']['name']);
	}
	
mysql_query("insert into dash_post set image='".$imgname."',text='".addslashes($_POST['postimgtext'])."', video='".$videoname."', createddate='".date('Y-m-d H:m:s')."', userid='".$_POST['userid']."'");
$this->redirect($this->url->https('klaspad/klaspad/home_dash_board'));	
}	
public function deletepost(){
mysql_query("delete from dash_post where id='".$_POST['postid']."'");
mysql_query("delete from dash_post_comment where postid='".$_POST['postid']."'");
$this->redirect($this->url->https('klaspad/klaspad/home_dash_board'));	
}

public function insertpostcomments(){
	//echo "insert into dash_post set text='".$_POST['posttext']."', createddate=curdate(), userid='".$_POST['userid']."'";
	//die;
	mysql_query("insert into dash_post_comment set comment='".addslashes($_POST['comment'])."', postid='".$_POST['postid']."', createddate='".date('Y-m-d H:m:s')."', userid='".$_POST['userid']."'");
	$this->redirect($this->url->https('klaspad/klaspad/home_dash_board'));	
}

public function deletepostcomment(){
mysql_query("delete from dash_post_comment where id='".$_POST['commentid']."'");
$this->redirect($this->url->https('klaspad/klaspad/home_dash_board'));		
}

public function manage_topics(){

$this->id       = 'content';
	$this->template = 'klaspad/dd1.php';
	$this->render();	
	
	
}

public function updateList(){
	$array	= $_POST['arrayorder'];

if ($_POST['update'] == "update"){
	
	$count = 1;
	foreach ($array as $idval) {
		$query = "UPDATE e_".$this->session->data['campusid']."_edu_topics SET shortorder = " . $count . " WHERE id = " . $idval;
		mysql_query($query) or die('Error, insert query failed');
		$count ++;	
	}
	echo 'All saved! close the popup window and refresh the page to see the changes';
}
	
		}
		
		
		public function manage_resources(){
			
		$this->id       = 'content';
		$this->template='klaspad/mang_resources.php';
		$this->render();	
			
		}

public function updateList2(){
	$array	= $_POST['arrayorder'];

if ($_POST['update'] == "update"){
	
	$count = 1;
	foreach ($array as $idval) {
		$query = "UPDATE e_".$this->session->data['campusid']."_edu_headings SET shortorder = " . $count . " WHERE id = " . $idval;
		mysql_query($query) or die('Error, insert query failed');
		$count ++;	
	}
	echo 'All saved! close the popup window and refresh the page to see the changes';
}
	
		}

public function insertdemo() {
		$this->load->model('klaspad/klaspad');
        
               //******For uploading passport *********// 
               
            $username =strtolower($this->request->post['email']);    
            $applicationid=$this->model_klaspad_klaspad->insertdemo($this->request->post,$username);
			if(isset($applicationid)){
				$status='True';
            //$title=$this->model_applyonline_applyonline->getapplicantTitle($this->request->post['Title']);
            //**************** Mail TO STUDENT (Akash 04feb)****************//
			include "Mail.php";
			$sts=mysql_query('select * from smtp_email'); 
$skts=mysql_fetch_array($sts);

$password=$skts['emailpassword'];
$sender=$skts['sender'];
$host=$skts['serversmtp'];
$cq=mysql_query("select * from collegedata");
$college_info = mysql_fetch_array($cq);  
         $email=$college_info['adminemail'];
		 $admissionemail=$college_info['admissionemail'];
             
            $mailto = $this->request->post['email'];
            //$cc = 'ys@nwcreading.co.uk';
           $subject= "Successful registration on our college";
           $body = '<html>
<head>
  <title>"'.$subject.'"</title>
</head>
<body>
    <table>
    <tr>
      <th align="left" colspan="3">Dear'.' '.$title['title'].' '.$this->request->post['fname'].' '.$this->request->post['surname'].', </br>
   </th>
    </tr>
    <tr>
      <th align="left" colspan="3"></br>
   </th>
    </tr>
    <tr>
      <th align="left" colspan="3">You have been successfully registered with us as a demo user. Your login details is as follows : </br>
   </th>
    </tr>
	 <tr>
      <th align="left">Username</th>
	  <td>:</td>
	  <td>'.$username.'</td>
    </tr>
	 <tr>
      <th align="left">Password</th>
	  <td>:</td>
	  <td>Student#1</td>
    </tr>

   
    <tr><th><br></th><tr></tr>
	<tr><td>Thanks,</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>The College Administrator</td></tr>
  </table>
</body>
</html>
';
       $headers = array("MIME-Version"=> '1.0', 
                 "Content-type" => "text/html; charset=iso-8859-1",
                 "From" => $sender,
                 "To" => $mailto, 
                 "Subject" => $subject);
         
         $smtp = Mail::factory('smtp',
				array ('host' => $host,
				'auth' => true,
				'username' => $sender,
				'password' => $password));

			$mail = $smtp->send($mailto, $headers, $body);
			}else{
			$status='False';	
			}
$data=array('status'=>$status);
echo json_encode($data);
exit;
 
    		
    
    	
  	}

public function insert() {
		$this->load->model('klaspad/klaspad');
               $username =strtolower($this->request->post['email']);    
              
			$applicationid=$this->model_klaspad_klaspad->insert($this->request->post,$username);
            //**************** Mail TO STUDENT (Akash 04feb)****************//
			if(isset($applicationid)){
				$status='True';
			include "Mail.php";
			$sts=mysql_query('select * from smtp_email'); 
$skts=mysql_fetch_array($sts);

$password=$skts['emailpassword'];
$sender=$skts['sender'];
$host=$skts['serversmtp'];
            $cq=mysql_query("select * from collegedata");
			$college_info = mysql_fetch_array($cq);    
         $email=$college_info['adminemail'];
		 $admissionemail=$college_info['admissionemail'];
             
            $mailto = $this->request->post['email'];
            //$cc = 'ys@nwcreading.co.uk';
           $subject= "Successful registration on our college";
           $body = '<html>
<head>
  <title>"'.$subject.'"</title>
</head>
<body>
    <table>
    <tr>
      <th align="left" colspan="3">Dear'.' '.$title['title'].' '.$this->request->post['Forename'].' '.$this->request->post['Familyname'].', </br>
   </th>
    </tr>
    <tr>
      <th align="left" colspan="3"></br>
   </th>
    </tr>
    <tr>
      <th align="left" colspan="3">You have been successfully registered with us.</br>
   </th>
    </tr>

   
    <tr><th><br></th><tr></tr>
	<tr><td>Thanks,</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>The College Administrator</td></tr>
  </table>
</body>
</html>
';
       $headers = array("MIME-Version"=> '1.0', 
                 "Content-type" => "text/html; charset=iso-8859-1",
                 "From" => $sender,
                 "To" => $mailto, 
                 "Subject" => $subject);
         
         $smtp = Mail::factory('smtp',
				array ('host' => $host,
				'auth' => true,
				'username' => $sender,
				'password' => $password));

			$mail = $smtp->send($mailto, $headers, $body);
          
            $mailto = $email;
            //$cc = 'ys@nwcreading.co.uk';
           $subject= "Subject new Application";
           $body = '<html>
<head>
  <title>"'.$subject.'"</title>
</head>
<body>
    <table>
    <tr>
      <th>This is to inform you that '.$title['title'].' '.$this->request->post['Forename'].' '.$this->request->post['Familyname'].' has applied for admission to the college.<br> Please follow it up.<br>
   </th>
    </tr>
	<tr><td>Thanks,</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>The College Administrator</td></tr>
  </table>
</body>
</html>
';
        $headers = array("MIME-Version"=> '1.0', 
                 "Content-type" => "text/html; charset=iso-8859-1",
                 "From" => $sender,
                 "To" => $mailto, 
                 "Subject" => $subject);
         
         $smtp = Mail::factory('smtp',
				array ('host' => $host,
				'auth' => true,
				'username' => $sender,
				'password' => $password));

			$mail = $smtp->send($mailto, $headers, $body);
			}else{
				$status='False';	
			}
			
			$data=array('status'=>$status);
echo json_encode($data);
exit;

  	}

public function insertstudent(){
	$query = $this->db->query("SELECT * FROM `semester` where sem_block='0'");
        $semester1 = $query->rows;
	        foreach($semester1 as $semester1)
            {
                $semester[]=array(
                    'semesterid' => $semester1['semesterid'],
                    'semestername' => $semester1['semestername'],
                    'startdate' => $semester1['startdate'],
                    'enddate' => $semester1['enddate']
                );
            }
			$data=array('semester'=>$semester);
echo json_encode($data);
exit;
	
}
public function get_course(){

$query = $this->db->query("SELECT cs.*,c.coursename,c.courseno,c.awardingbody FROM `batchcoursedetails` cs
                  left join course as c on c.courseid=cs.courseid
                  where cs.batchid= '".$_POST['semestername']."' and typeofcourse !='Extra' ");
	
$course1 = $query->rows;
	
            foreach($course1 as $course1)
            {
                $course[]=array(
                    'courseid' => $course1['courseid'],
                    'coursename' => $course1['coursename']
                );
            }
			$data=array('course'=>$course);
echo json_encode($data);
exit;
	
}

public function getstudentcontactrequest(){
	$q=mysql_query("select studentID from user where userid='".$_POST['userid']."'");
	$s=mysql_fetch_array($q);
			$str1=' and studentid="'.$s['studentID'].'" ';
		//echo "select * from requestconference where 1 $ptype $dbdatef $dbdatett $ttype $str";
		$query=$this->db->query("select r.*, s.staffname, s.surname from requestconference r left join staff as s on s.staffid=r.staffid where 1 $str1 ");
        $requestconference_info= $query->rows;
		foreach($requestconference_info as $requestconference_info)
		{
			$requestconference[]=array(
			'requestconferenceid' => $requestconference_info['requestconferenceid'],
			'requestconferencedate' => $requestconference_info['requestconferencedate'],
			'message' => $requestconference_info['message'],
			'request' => $requestconference_info['request'],
			'staffid' => $requestconference_info['staffid'],
			'staffname' => $requestconference_info['staffname'].' '.$requestconference_info['surname'],
			'studentid' => $requestconference_info['studentid'],
			'status' => $requestconference_info['status'],
			'createddate' => $requestconference_info['createddate'],
			'createdby' => $requestconference_info['createdby'],
			'modifieddate' => $requestconference_info['modifieddate'],
			'modifiedby' => $requestconference_info['modifiedby']
			);
		} 
		
$data=array('contact'=>$requestconference);
echo json_encode($data);
exit;
	
}

public function sendstudentcontactrequest(){
	$q=mysql_query("select studentID from user where userid='".$_POST['userid']."'");
	$s=mysql_fetch_array($q);
			$str1=' and studentid="'.$s['studentID'].'" ';
		$query=$this->db->query("select staffid, staffname, surname from staff where staffid in (select distinct staffid from academicsessionstudent where 1 $str1 )");
        $staff_info= $query->rows;
		foreach($staff_info as $staff_info)
		{
			$requestconference[]=array(
			'staffid' => $staff_info['staffid'],
			'staffname' => $staff_info['staffname'].' '.$staff_info['surname']
			);
		} 
		
$data=array('contact'=>$requestconference,'studentid'=>$s['studentID']);
echo json_encode($data);
exit;
	
}

public function insert_requestconference()
	{
		// print_r($_POST); die;
		if(@$_POST['requestconferencedate']!=''){
		$dt=explode('-',$_POST['requestconferencedate']);
		$d_dte=$dt[2].'-'.$dt[1].'-'.$dt[0];	
		}else{
		$d_dte='0000-00-00';	
		}
        $this->db->query("INSERT INTO requestconference SET 
		 requestconferencedate='".$d_dte."',
		 message='".addslashes($_POST['message'])."',
		 staffid='".$_POST['staffid']."',
		 request='".$_POST['request']."',
		 studentid='".$_POST['studentid']."',
		 createddate=now(),
		 createdby='".$_POST['userid']."'
		 ");
		 $studentid=$this->db->getLastID();
		 if(isset($studentid)){
			$status='True'; 
		 }else{
			$status='False'; 
		 }
			$str1=' and studentid="'.$_POST['studentid'].'" ';
		//echo "select * from requestconference where 1 $ptype $dbdatef $dbdatett $ttype $str";
		$query=$this->db->query("select r.*, s.staffname, s.surname from requestconference r left join staff as s on s.staffid=r.staffid where 1 $str1 ");
        $requestconference_info= $query->rows;
		foreach($requestconference_info as $requestconference_info)
		{
			$requestconference[]=array(
			'requestconferenceid' => $requestconference_info['requestconferenceid'],
			'requestconferencedate' => $requestconference_info['requestconferencedate'],
			'message' => $requestconference_info['message'],
			'request' => $requestconference_info['request'],
			'staffid' => $requestconference_info['staffid'],
			'staffname' => $requestconference_info['staffname'].' '.$requestconference_info['surname'],
			'studentid' => $requestconference_info['studentid'],
			'status' => $requestconference_info['status'],
			'createddate' => $requestconference_info['createddate'],
			'createdby' => $requestconference_info['createdby'],
			'modifieddate' => $requestconference_info['modifieddate'],
			'modifiedby' => $requestconference_info['modifiedby']
			);
		} 
		
//$data=array('contact'=>$requestconference);		 
$data=array('status'=>$status,'contact'=>$requestconference);
echo json_encode($data);
exit;		 
    }
	
public function externalcourse()
	{
	if(isset($this->session->data['userid'])){
	$this->id       = 'content';
		$this->template = 'klaspad/ltidoc.php';
		//$this->layout   = 'module/layout';
		$this->render();		
	//$this->load->view('welcome/dash_board');
	}else{
    $this->session->data['messages']='You must Login First.';
  			$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}	
public function lti_list()
	{
	if(isset($this->session->data['userid'])){
	$this->id       = 'content';
		$this->template = 'klaspad/ltidoc_list.php';
		//$this->layout   = 'module/layout';
		$this->render();		
	//$this->load->view('welcome/dash_board');
	}else{
    $this->session->data['messages']='You must Login First.';
  			$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}		
public function lti_add()
	{
	if(isset($this->session->data['userid'])){
	$this->id       = 'content';
		$this->template = 'klaspad/ltidoc_add.php';
		//$this->layout   = 'module/layout';
		$this->render();		
	//$this->load->view('welcome/dash_board');
	}else{
    $this->session->data['messages']='You must Login First.';
  			$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}
	
public function lti_edit()
	{
	if(isset($this->session->data['userid'])){
	$this->id       = 'content';
		$this->template = 'klaspad/ltidoc_edit.php';
		//$this->layout   = 'module/layout';
		$this->render();		
	//$this->load->view('welcome/dash_board');
	}else{
    $this->session->data['messages']='You must Login First.';
  			$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}	
		
public function insert_lti()
	{
	if(isset($this->session->data['userid'])){
		//echo "select id from binit_context where courseid='".$_POST['courseid']."' and moduleid='".$_POST['contextid']."'";
		//die;
	$q=mysql_query("select id from binit_context where courseid='".$_POST['courseid']."' and moduleid='".$_POST['contextid']."' and topicid='0' and resourceid='0'");
	$s=mysql_fetch_array($q);
	$time=time();	
	mysql_query("insert into local_ltiprovider set 
				courseid='".$_POST['courseid']."',
				moduleid='".$_POST['contextid']."',
				contextid='".$s['id']."',
				disabled='0',
				sendgrades='1',
				forcenavigation='1',
				croleinst='3',
				crolelearn='5',
				aroleinst='3',
				arolelearn='5',
				secret='".$_POST['secret']."',
				consumerkey='".$_POST['consumerkey']."',
				encoding='UTF-8',
				institution='',
				lang='en',
				timezone='99',
				maildisplay='2',
				city='london',
				country='UK',
				hidepageheader='0',
				hidepagefooter='0',
				hideleftblocks='0',
				hiderightblocks='0',
				customcss='0',
				enrolstartdate='0',
				enrolperiod='0',
				enrolenddate='0',
				maxenrolled='".$_POST['noofuser']."',
				userprofileupdate='1',
				syncmembers='0',
				syncmode='1',
				syncperiod='1800',
				timemodified='".$time."',
				timecreated='".$time."',
				lastsync=''	
				");
	$this->redirect($this->url->https('klaspad/klaspad/lti_list&type=course&courseid='.$_POST['courseid']));			
				
	}else{
    $this->session->data['messages']='You must Login First.';
  			$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}		
public function update_lti()
	{
		//echo '<pre>';
		//print_r($_POST);
		//die;
	if(isset($this->session->data['userid'])){
	mysql_query("update local_ltiprovider set 
				maxenrolled='".$_POST['noofuser']."',
				timemodified='".$time."'
				where id='".$_GET['id']."'
				");
				
$connect = mysql_connect("166.78.110.200","user_filoport","filoport123"); //database connection

mysql_select_db("klaspadcms",$connect); // select database1 
//mysql_select_db("database2",$connect); // select database2 
$q=mysql_query("select id from lti where password='".$_POST['secret']."'");
$s=mysql_fetch_array($q);
$sql = mysql_query("update coursemodule set maxenrolled='".$_POST['noofuser']."' where lti_id='".$s['id']."'"); //insert record to first table
$sql1 = mysql_query("update e_10_edu_modules set maxenrolled='".$_POST['noofuser']."' where lti_id='".$s['id']."'");
//$sql1 =mysql_query("INSERT INTO database2.table2 (contact_first, contact_last, contact_email) VALUES('abc','xyz','abc@abc.com')"); //insert record to second table	
mysql_close($connect);				
				
				
				
	?>
   <script>
   parent.window.hs.getExpander().close();
   parent.location.reload();
   </script>
	<?php		
				
	}else{
    $this->session->data['messages']='You must Login First.';
  			$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}	
				
public function add_external()
	{
	$this->load->model('klaspad/klaspad');
	//$_SESSION['tid']='';
	$courselist=$this->model_klaspad_klaspad->courses_list_new();
	$this->data['courseid']=$courselist['id'];
	$this->data['coursename']=$courselist['coursename'];
	$modulelist=$this->model_klaspad_klaspad->modules_list_new();	
	$this->data['moduleid']=$modulelist['id'];
	$this->data['modulename']=$modulelist['modulename'];
	$this->data['topicslistlist'] = array();	
	$topicslistlist=$this->model_klaspad_klaspad->topics_list_list_new_new();
	foreach($topicslistlist as $result)
				{
					$this->data['topicslistlist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
									}
	$this->data['topiclist'] = array();										
	$topiclist=$this->model_klaspad_klaspad->topics_list();	
		
	foreach($topiclist as $result)
				{
					$this->data['topiclist'][]=array(
					'topicid'=>$result['id'],
					'topicname' => $result['topicname']
					);
				}	
			
	if(isset($this->session->data['userid'])){	
	if(@$_GET['resourceid']){
	$record=$this->model_klaspad_klaspad->resource_record();
	$this->data['id']=$record['id'];	
	$this->data['topic_id']=$record['topic_id'];	
	$this->data['uploadimage']=$record['uploadimage'];
	$this->data['description']=$record['description'];
	$this->data['learningoutcomes']=$record['learningoutcomes'];
	$this->data['excercises_video']=$record['excercises_video'];
	$this->data['excercises_audio']=$record['excercises_audio'];
	$this->data['excercises_youtube']=$record['excercises_youtube'];
	$this->data['rssfeedlink']=$record['rssfeedlink'];
	$this->data['excercises_embed']=$record['excercises_embed'];
	$this->id       = 'content';
	$this->template = 'klaspad/add_external.php';
	$this->render();	
		}else{
	$this->id       = 'content';
	$this->template = 'klaspad/add_external.php';
	$this->render();	
	}	
		
	
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 	
	}	
	
public function insert_external_excercises(){
	$this->load->model('klaspad/klaspad');
	if(isset($this->session->data['userid'])){		
	$record=$this->model_klaspad_klaspad->insert_external_excercises();
    //$this->session->set_flashdata('message', 'Excercise added successfully');
	?>
   <script>
   parent.window.hs.getExpander().close();
   parent.location.reload();
   </script>
	<?php
	}else{
    $this->session->data['messages']='You must Login First.';
  	$this->redirect($this->url->https('adminhome/adminhome'));
	} 		
	}		
	

public function get_department(){
$query = $this->db->query("SELECT * from tbl_department");
$department1 = $query->rows;
foreach($department1 as $department1)
{

$department[]=array(
'departmentid' => $department1['id'],
'department' => $department1['department'],
'department_image' => $department1['department_image']
);
}
$data=array('department'=>$department);
echo json_encode($data);
exit;
	
}	

public function get_department_courses(){
	//echo "select * from e_".$_POST['connectionid']."_edu_courses where department_id='".$department1['id']."'<br />";
$t=$this->db->query("select * from e_".$_POST['connectionid']."_edu_courses where department_id='".$_POST['departmentid']."'");
$topic=$t->rows;
$course=array();
foreach($topic as $tp){
$m=$this->db->query("select * from e_".$_POST['connectionid']."_edu_modules where course_id='".$tp['id']."'");
$mdl=$m->rows;
$module=array();
foreach($mdl as $md){
 $module[]=array(
 'moduleid' => @$md['id'],
 'modulename' => @$md['modulename'],
 'modulefee' => '20'
 );	
}
$course[]=array(
 'courseid' => @$tp['id'],
 'coursename' => @$tp['coursename'],
 'thumbimageupload'=>@$tp['thumbimageupload'],
 'courseprovider'=>'Klaspad',
 'module' => $module
 );	
}
$data=array('course'=>$course);
echo json_encode($data);
exit;
	
}
public function all_topic_resource_new(){
		if(!isset($_POST['connectionid'])){
		$_POST['connectionid']=10;
		$_POST['id']=43;
			}
		//echo "select campusName as connectionid from course where new_id='".$_POST['id']."'";	
		$str='';
		$q=mysql_query("select campusName as connectionid from course where courseid='".$_POST['courseid']."'");
		$s=mysql_fetch_array($q);
		if(isset($_POST['courseid'])){
		$str.=" and cc.id='".$_POST['courseid']."'";
		}
		if(isset($_POST['moduleid'])){
		$str.=" and mm.id='".$_POST['moduleid']."'";
		}	
		$topic=array();
		$tq=$this->db->query("select * from e_".$s['connectionid']."_edu_topics where module_id='".$_POST['moduleid']."'");
		$tcs = $tq->rows;
		foreach($tcs as $tcss){
		
		//if(isset($tcss['id'])){
		$str1=" and tt.id='".$tcss['id']."'";
		//}
		//echo "select ee.conversationtopic, cc.coursename,ee.video_icon,ee.question ,ea.id as favid, cc.description as course_description, cc.learningoutcomes as course_learningoutcomes,  eh.headingname, eh.rssfeedlink, ee.rssfeedlink as excercise_rssfeedlink, ee.excercises_video ,cc.id as course_id,  ee.excercises_youtube, ee.id as resourceid,  ee.description, ee.learningoutcomes, ee.notice, ee.upload_folder, ee.uploadimage, ee.excercisename,ee.excercises_embed, ee.excercises_video, ee.excercises_audio, eh.exerciestype, cc.id as courseid, mm.id as moduleid, tt.id as tid from e_".$s['connectionid']."_edu_headings as eh inner join e_".$s['connectionid']."_edu_excercises as ee on ee.topic_id=eh.id left join e_".$_POST['connectionid']."_edu_fav as ea on ee.id=ea.resourceid inner join e_".$s['connectionid']."_edu_topics as tt on eh.topic_id=tt.id inner join e_".$s['connectionid']."_edu_modules as mm on mm.id=tt.module_id inner join e_".$s['connectionid']."_edu_courses as cc on cc.id=mm.course_id where (eh.exerciestype = 'Powerpoint presentation exercise' or eh.exerciestype ='Add Folder' or eh.exerciestype ='Files' or eh.exerciestype ='Add Audio' or eh.exerciestype ='Add Video') $str  order by eh.shortorder <br />";
		$query=$this->db->query("select ee.conversationtopic, cc.coursename,ee.video_icon,ee.question ,ea.id as favid, cc.description as course_description, cc.learningoutcomes as course_learningoutcomes,  eh.headingname, eh.rssfeedlink, ee.rssfeedlink as excercise_rssfeedlink, ee.excercises_video ,cc.id as course_id,  ee.excercises_youtube, ee.id as resourceid,  ee.description, ee.pptimagepath, ee.learningoutcomes, ee.notice, ee.upload_folder, ee.uploadimage, ee.excercisename,ee.excercises_embed, ee.excercises_video, ee.excercises_audio, eh.exerciestype, cc.id as courseid, mm.id as moduleid, tt.id as tid from e_".$s['connectionid']."_edu_headings as eh inner join e_".$s['connectionid']."_edu_excercises as ee on ee.topic_id=eh.id left join e_".$_POST['connectionid']."_edu_fav as ea on ee.id=ea.resourceid inner join e_".$s['connectionid']."_edu_topics as tt on eh.topic_id=tt.id inner join e_".$s['connectionid']."_edu_modules as mm on mm.id=tt.module_id inner join e_".$s['connectionid']."_edu_courses as cc on cc.id=mm.course_id where (eh.exerciestype = 'Powerpoint presentation exercise' or eh.exerciestype ='Add Folder' or eh.exerciestype ='Files' or eh.exerciestype ='Add Audio' or eh.exerciestype ='Add Video') $str $str1  order by eh.shortorder ");	
	$mm = $query->rows;	
	
	$data=array();
foreach($mm as $mms){
	$url=array();
	$path='klaspad/uploads/'.$s['connectionid'].'/'.$mms['courseid'].'/ppt/';
	$imgpath='klaspad/uploads/'.$s['connectionid'];
	if($mms['exerciestype']=='Powerpoint presentation exercise'){
if($handle = opendir('klaspad/uploads/'.$s['connectionid'].'/'.$mms['course_id'].'/ppt/'.$mms['resourceid'])) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
$url[] = 'klaspad/uploads/'.$s['connectionid'].'/'.$mms['course_id'].'/ppt/'.$mms['resourceid'].'/'.$entry;
        }
    }
    closedir($handle);
}

	}else{
$url=array();	
	}
$query1=$this->db->query('select * from e_'.$s['connectionid'].'_edu_excercises_discussion where resourceid="'.$mms['resourceid'].'"');	
$disc=$query1->rows;
$discussion=array();	
foreach($disc as $dis){
$que=$this->db->query('select ea.assignment, ea.connectionid, ea.user_id, ea.createddate from e_'.$s['connectionid'].'_edu_ans_assignment ea where ea.assignment_id="'.$dis['id'].'" order by ea.id desc');		
$mmk = $que->rows;	
$url1=array();
foreach($mmk as $mmkk){
$msq=mysql_query("select eu.user_image, eu.demo_contact_person from e_".$mmkk['connectionid']."_edu_user as eu where eu.id='".$mmkk['user_id']."'");	
$mmk1=mysql_fetch_array($msq);
$url1[] =array('comment' => $mmkk['assignment'], 
            'username' => $mmk1['demo_contact_person'],
			'createddate' => $mmkk['createddate'],
			'image' => $mmk1['user_image']
			);
}
	

$discussion[]=array('id' => $dis['id'], 
			'resid' => $dis['resourceid'],
            'topic' => $dis['question'],
			'comment'=>$url1);
}
if(isset($_POST['userid'])){
//echo "select * from e_".$s['connectionid']."_edu_notes where courseid='".$mms['resourceid']."' and userid='".$_POST['userid']."'<br />";	
$query2=$this->db->query("select * from e_".$s['connectionid']."_edu_notes where courseid='".$mms['resourceid']."' and userid='".$_POST['userid']."'");	
$not=$query2->rows;
$notes=array();	
foreach($not as $no){


$notes[]=array('id' => $no['id'], 
			'resid' => $no['courseid'],
            'userid' => $no['userid'],
			'msg'=>$no['msg']);
}

$query3=$this->db->query("select * from e_".$s['connectionid']."_edu_excercises_assignment where resourceid='".$mms['resourceid']."'");	
$assign=$query3->rows;
$assignment=array();	
foreach($assign as $ass){
$assignment[]=array('id' => $ass['id'], 
			'resid' => $ass['resourceid'],
            'topic' => $ass['question']);
}
}else{
$notes=array();	
$assignment=array();	
}
$query4=$this->db->query("select c.*, h.headingname from e_".$s['connectionid']."_edu_excercises_crossword as c left join e_".$s['connectionid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$mms['resourceid']."'");	
$crswrd=$query4->rows;
$crossword=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd as $ass1){
$crossword[]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
			'mid'=>$mms['moduleid'],
			'tid'=>$mms['tid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}

$query5=$this->db->query("select c.*, h.headingname from e_".$s['connectionid']."_edu_excercises_multiplechoice as c left join e_".$s['connectionid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$mms['resourceid']."' group by c.topic_id");	
$crswrd2=$query5->rows;
$multiple=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd2 as $ass1){
$multiple[]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'mid'=>$mms['moduleid'],
            'tid'=>$mms['tid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query6=$this->db->query("select c.*, h.headingname from e_".$s['connectionid']."_edu_excercises_fillintheblanks as c left join e_".$s['connectionid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$mms['resourceid']."' group by c.topic_id");	
$crswrd3=$query6->rows;
$fill=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd3 as $ass1){
$fill[]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'mid'=>$mms['moduleid'],
            'tid'=>$mms['tid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query7=$this->db->query("select c.*, h.headingname from e_".$s['connectionid']."_edu_excercises_descripting as c left join e_".$s['connectionid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$mms['resourceid']."' group by c.topic_id");	
$crswrd4=$query7->rows;
$descripting=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($crswrd4 as $ass1){
$descripting[]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'mid'=>$mms['moduleid'],
            'tid'=>$mms['tid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query8=$this->db->query("select c.*, h.headingname from e_".$s['connectionid']."_edu_excercises_truefalse as c left join e_".$s['connectionid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$mms['resourceid']."' group by c.topic_id");	
$tf=$query8->rows;
$truefalse=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($tf as $ass1){
$truefalse[]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'mid'=>$mms['moduleid'],
            'tid'=>$mms['tid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
$query9=$this->db->query("select c.*, h.headingname from e_".$s['connectionid']."_edu_excercises_draganddrop as c left join e_".$s['connectionid']."_edu_headings as h on c.topic_id=h.id where c.resourceid='".$mms['resourceid']."' group by c.topic_id");	
$dd=$query9->rows;
$draganddrop=array();	
//$this->data['crossword'][]=$crswrd;	
foreach($dd as $ass1){
$draganddrop[]=array(
			'id' => $ass1['id'],
            'resourceid' => $ass1['resourceid'],
            'mid'=>$mms['moduleid'],
            'tid'=>$mms['tid'],
            'topic_id' => $ass1['topic_id'],
            'excercisename' => $ass1['excercisename'],
            'exerciestype' => $ass1['exerciestype'],
            'wordssentence' => $ass1['wordssentence'],
            'answere' => $ass1['answere'],
            'question' => $ass1['question'],
            'checksentence' => $ass1['checksentence'],
            'uploadimage' => $ass1['uploadimage'],
            'topic_id_id' => $ass1['topic_id_id'],
            'upload_folder' => $ass1['upload_folder'],
            'conversationtopic' => $ass1['conversationtopic'],
            'description' => $ass1['description'],
            'learningoutcomes' => $ass1['learningoutcomes'],
            'notice' => $ass1['notice'],
            'excercises_video' => $ass1['excercises_video'],
            'excercises_audio' => $ass1['excercises_audio'],
            'modified_date' => $ass1['modified_date'],
            'excercises_youtube' => $ass1['excercises_youtube'],
            'video_icon' => $ass1['video_icon'],
            'rssfeedlink' => $ass1['rssfeedlink'],
            'excercises_embed' => $ass1['excercises_embed'],
            'downloadedby' => $ass1['downloadedby'],
            'headingname' => $ass1['headingname']
			);
}
//print_r($notes);
$queee1=$this->db->query('select comment from e_'.$s['connectionid'].'_edu_conversationtopic where conversation_id="'.$mms['resourceid'].'"');
$status=$queee1->rows;
$conversationtopic_comments=array();
foreach($status as $stat){
$conversationtopic_comments[] = $stat['comment'];
}
if($mms['favid']==''){
	$mms['favid']=0;
	}else{
	
	}
$url11=array();	
$pptimg=explode(',',$mms['pptimagepath']);	
$url11=$pptimg;
	$data[]=array('conversationtopic' => $mms['conversationtopic'], 
            'coursename' => $mms['coursename'],
			'courseid' => $mms['courseid'],
            'headingname' => $mms['headingname'],
            'rssfeedlink' => $mms['rssfeedlink'],
			'references' => $mms['excercise_rssfeedlink'],
            'excercises_youtube' => $mms['excercises_youtube'],
            'excercises_video' => $mms['excercises_video'],
            'excercises_embed' => $mms['excercises_embed'],
            'resourceid' => $mms['resourceid'],
            'description' => $mms['description'],
            'learningoutcomes' => $mms['learningoutcomes'],
            'notice' => $mms['notice'],
            'upload_folder' =>  $mms['upload_folder'],
            'uploadimage' => $mms['uploadimage'],
            'excercisename' => $mms['excercisename'],
            'excercises_video' => $mms['excercises_video'],
            'excercises_audio' => $mms['excercises_audio'],
            'exerciestype' => $mms['exerciestype'],
			'course_description'=>$mms['course_description'],
			'course_learningoutcomes'=>$mms['course_learningoutcomes'],
			'video_icon'=>$mms['video_icon'],
			'topic'=>$mms['question'],
			'favid'=>$mms['favid'],
			'ppt_images'=>$url11,
			'imgpath'=>$imgpath,
			'path'=>$path,
			'notes'=>$notes,
			'assignment'=>$assignment,
			'discussion'=>$discussion,
			'crossword'=>$crossword,
			'fillintheblanks'=>$fill,
			'multiplechoice'=>$multiple,
			'descripting'=>$descripting,
			'truefalse'=>$truefalse,
			'draganddrop'=>$draganddrop,
			'conversationtopic_comments'=>$conversationtopic_comments);
	}
//disucssion
 $topic[]=array(
 'topicid' => @$tcss['id'],
 'topicname' => @$tcss['topicname'],
 'resource' => $data
 );	
		}
		
//Discussion	
$data1=array('data'=>@$topic);
echo json_encode($data1);
exit;	
}



public function facebook_google_mobile_login()
	{
	$this->load->model('klaspad/klaspad');
	$uq=mysql_query("select preukid, campus, status from student where email='".$_POST['email']."'");
	$ucnt=mysql_num_rows($uq);
	if($ucnt>=1){
	$stds=mysql_fetch_array($uq);	
	$q=mysql_query("select userid, studentID, username, password from user where studentID='".$stds['preukid']."' and blockuser='0'");
	$row = mysql_num_rows($q);
	if($row>0){
	$row2=mysql_fetch_array($q);
	$campusid=$stds['campus'];	
	$q1=mysql_query("select * from e_".$campusid."_edu_user where id='".$row2['userid']."'");
		
	$ercnt=mysql_num_rows($q1);
	if($ercnt>0){
	mysql_query("update e_".$campusid."_edu_user set username='".$row2['username']."', password='".$row2['password']."' where id='".$row2['userid']."'");
	}else{
	mysql_query("insert into e_".$campusid."_edu_user set id='".$row2['userid']."', username='".$row2['username']."', password='".$row2['password']."' ");	
	}
	$q2=mysql_query("select * from e_".$campusid."_edu_user where id='".$row2['userid']."'");
	$row1=mysql_fetch_array($q2);
	mysql_query("insert into edu_login set connectionid='".$row1['connectid']."', user_id='".$row1['id']."', logintime=now()");
	$this->session->data['id']=session_id();
	$this->session->data['userid']=$row2['userid'];
	$this->db->query("insert into `logindetails` 
				SET 
				    userid='" . $this->session->data['userid']. "',
				 	sessionid='".$this->session->data['id']."',
					ipaddress='".@$_POST['ipaddress']."',
				    logindate=now()
		");
	}
	$status=array('data'=>@$row1,'status'=>'true','studentid'=>$stds['preukid'],'studentstatus'=>$stds['status'],'sessionid'=>$this->session->data['id']);
	}else{
	$username =strtolower($this->request->post['email']);    
            $applicationid=$this->model_klaspad_klaspad->insertdemo($this->request->post,$username);
			//if(isset($applicationid)){
				//$status='True';
            //$title=$this->model_applyonline_applyonline->getapplicantTitle($this->request->post['Title']);
            //**************** Mail TO STUDENT (Akash 04feb)****************//
			include "Mail.php";
			$sts=mysql_query('select * from smtp_email'); 
$skts=mysql_fetch_array($sts);

$password=$skts['emailpassword'];
$sender=$skts['sender'];
$host=$skts['serversmtp'];
$cq=mysql_query("select * from collegedata");
$college_info = mysql_fetch_array($cq);  
         $email=$college_info['adminemail'];
		 $admissionemail=$college_info['admissionemail'];
             
            $mailto = $this->request->post['email'];
            //$cc = 'ys@nwcreading.co.uk';
           $subject= "Successful registration on our college";
           $body = '<html>
<head>
  <title>"'.$subject.'"</title>
</head>
<body>
    <table>
    <tr>
      <th align="left" colspan="3">Dear'.' '.$title['title'].' '.$this->request->post['fname'].' '.$this->request->post['surname'].', </br>
   </th>
    </tr>
    <tr>
      <th align="left" colspan="3"></br>
   </th>
    </tr>
    <tr>
      <th align="left" colspan="3">You have been successfully registered with us as a demo user. Your login details is as follows : </br>
   </th>
    </tr>
	 <tr>
      <th align="left">Username</th>
	  <td>:</td>
	  <td>'.$username.'</td>
    </tr>
	 <tr>
      <th align="left">Password</th>
	  <td>:</td>
	  <td>Student#1</td>
    </tr>

   
    <tr><th><br></th><tr></tr>
	<tr><td>Thanks,</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>The College Administrator</td></tr>
  </table>
</body>
</html>
';
       $headers = array("MIME-Version"=> '1.0', 
                 "Content-type" => "text/html; charset=iso-8859-1",
                 "From" => $sender,
                 "To" => $mailto, 
                 "Subject" => $subject);
         
         $smtp = Mail::factory('smtp',
				array ('host' => $host,
				'auth' => true,
				'username' => $sender,
				'password' => $password));

			$mail = $smtp->send($mailto, $headers, $body);
			
$uq1=mysql_query("select preukid, campus, status from student where preukid='".$applicationid."'");
	$stds1=mysql_fetch_array($uq1);	
	$q=mysql_query("select userid, studentID, username, password from user where studentID='".$stds1['preukid']."' and blockuser='0'");
	$row = mysql_num_rows($q);
	if($row>0){
	$row2=mysql_fetch_array($q);
	$campusid=$stds1['campus'];	
	$q1=mysql_query("select * from e_".$campusid."_edu_user where id='".$row2['userid']."'");
		
	$ercnt=mysql_num_rows($q1);
	if($ercnt>0){
	mysql_query("update e_".$campusid."_edu_user set username='".$row2['username']."', password='".$row2['password']."' where id='".$row2['userid']."'");
	}else{
	mysql_query("insert into e_".$campusid."_edu_user set id='".$row2['userid']."', username='".$row2['username']."', password='".$row2['password']."' ");	
	}
	$q2=mysql_query("select * from e_".$campusid."_edu_user where id='".$row2['userid']."'");
	$row1=mysql_fetch_array($q2);
	mysql_query("insert into edu_login set connectionid='".$row1['connectid']."', user_id='".$row1['id']."', logintime=now()");
	$this->session->data['id']=session_id();
	$this->session->data['userid']=$row2['userid'];
	$this->db->query("insert into `logindetails` 
				SET 
				    userid='" . $this->session->data['userid']. "',
				 	sessionid='".$this->session->data['id']."',
					ipaddress='".@$_POST['ipaddress']."',
				    logindate=now()
		");
	}
	$status=array('data'=>@$row1,'status'=>'true','studentid'=>$stds1['preukid'],'studentstatus'=>$stds1['status'],'sessionid'=>$this->session->data['id']);			
			
			
			
			//}	
	}
	
echo json_encode($status);	
exit;
	}









	
					
}// class ends here



	
	
	

 
?>