<?php
require_once "DatabaseHandler.php";
require_once "Mailer.php";

/*
Class that is responsive for treatments
*/
class TreatmentHandler extends DatabaseHandler
{
	/*
	Method that gets all the existing treatments that the clinic can offer to its clients
	*/
	public function getTreatments()
	{
		$treatments=$this->getRecords("SELECT * FROM treatment_type");//Getting all the existing treatments from the database
		foreach($treatments as $treatment)//Displaying all the treatments
		{
		?>
			<div class="col-md-4">
				<a class="treatment_links" data-toggle="modal" data-target="#treatmentInfo" data-id="<?php echo $treatment['id']?>" href="javascript:;"><h3 class="treatmentstypes" style="text-align:center"><?php echo $treatment['title']?></h3></a>
			</div>
		<?php
		}
	}
	
	/*
	Method shows the specific treatment information((INDEX)), according to its id
	*/
	public function getTreatmentInfoById($treatmentId)
	{
		$treatments=$this->getRecords("SELECT * FROM treatment_type WHERE id=?",array($treatmentId))[0];//Getting all the existing treatments from the database
		?>
		<h2><?php echo $treatments['title']; ?></h2>
		<p><?php echo $treatments['description']; ?></p>
		<?php
	}
	
	/*
	Method that returns treatments as select element's options
	*/
	public function getTreatmentsList()
	{
		$treatments=$this->getRecords("SELECT * FROM treatment_type");//Getting all the existing treatments from the database
		echo '<option value="0">בחר טיפול</option>';
		foreach($treatments as $treatment)
		{
		?>
			<option value="<?php echo $treatment['id']?>"><?php echo $treatment['title']?></option>
		<?php
		}
	}
	
	/*
	Method that deletes an existing treatment(betool toor)
	*/
	public function deleteTreatment($email,$treatment_date)
	{			
		if(!isset($treatment_date) || empty($treatment_date))
				die("יש לבחור תאריך לפי כתובת המייל");
		
		$cancel_date=$treatment_date;
			
		//Creating a new datetime format
		$new_format=explode(" ",$treatment_date);
		$date=explode("/",$new_format[1]);	
		$treatment_date=$date[2].'-'.$date[1].'-'.$date[0].' '.$new_format[0].':00';//Creating a new datetime format
	
		//If the mentioned treatment was found at the database
		if(!empty($treatment_date) && count($this->getRecords("SELECT * FROM treatment_client WHERE email=? AND treatment_date=?",array($email,$treatment_date))))
		{			
			$this->commitQuery("DELETE FROM treatment_client WHERE email=? AND treatment_date=?",array($email,$treatment_date));
			
			$m=new Mailer();//New mailer object is created
				
			if($m->sendMail($email, "
			.", "ביטלנו את טיפולך בתאריך:".$cancel_date.'<br>הבחירה הנכונה,<br>&nbsp;&nbsp;&nbsp;Dental Clinic','dentalc734@gmail.com'))
				echo 'טיפולך בוטל בהצלחה';
			else//If the email couldn't be added to a mail queue
				echo "טיפולך בוטל בהצלחה,אבל אין באפשרתנו לשלוח אישור ביטול באימייל ";
		}
		else//If something is wrong with email
			echo "האימייל הנ''ל אינו נמצא,נא לנסות איימיל אחר ";
	}
	
	/*
	Method that displays all the treatments for the CURRENT day
	*/
	public function getTreatmentByDay($day)
	{
		if(preg_match("/^[0-9]{4}[\-]{1}[0-9]{2}[\-]{1}[0-9]{2}$/",$day))
		{
			$get_treatments=$this->getRecords("SELECT tc.t_id as t_id,tc.company_id as company_id,c_name,concat(firstname,' ',lastname) as fullname,c.phone as phone,c.email as email,title,treatment_date as t_date,DATE_FORMAT(treatment_date,'%H:%i') as date_treatment,DATE_FORMAT(DATE_ADD(treatment_date, INTERVAL treatment_time MINUTE),'%H:%i') as finish_time
			FROM client c INNER JOIN treatment_client tc ON c.email=tc.email INNER JOIN treatment_type tt ON tt.id=tc.t_id 
			LEFT OUTER JOIN companies cs ON tc.company_id=cs.company_id			
			WHERE DATE(treatment_date)=? ORDER BY treatment_date",array($day));
			
			if(!count($get_treatments))//If there aren't any treatments for the current date			
				 echo '<a href="javascript:;" class="list-group-item">לא נקבעו תורים לתאריך זה</a>';			
			else
			{
				foreach($get_treatments as $treatment)
				{
					
				?>
				 <a href="javascript:;" class="list-group-item">
				 <?php 
				 echo $treatment['date_treatment']."-".$treatment['finish_time'].' | '.$treatment['title'].' | '.$treatment['fullname'].' | '.$treatment['phone'].' | '.$treatment['c_name']; 
				 if(isset($treatment['company_id']) && !empty($treatment['company_id']))
					 echo ' | <span class="send_mail glyphicon glyphicon-envelope" data-date="'.$treatment['t_date'].'" data-treatment="'.$treatment['t_id'].'" data-email="'.$treatment['email'].'" data-id="'.$treatment['company_id'].'"></span>';
				 ?>	 <img src="images/load.gif" class="loading" style="display:none;width:20px">			 
				 </a>
				
				<?php
				}
			}
		}
		else
			echo "fail";
	}
	
	
	/*
	Method shows all treatments for the current user
	*/
	public function getCurerntUserTreatments($user_email)
	{
		$my_treatments=$this->getRecords("SELECT DATE_FORMAT(treatment_date,'%H:%i %d/%m/%Y') as disp_date FROM treatment_client WHERE email=?",array($user_email));
		if(count($my_treatments))
		{
			foreach($my_treatments as $treatment)
			{
			?>
				<option value="<?php echo $treatment['disp_date']; ?>"><?php echo $treatment['disp_date']; ?></option>
			<?php
			}
		}
		else
			echo 'no';
	}
	

	
	/*
	Method that sends an email to bituah
	*/
	public function sendBituah($date,$treatment,$email,$id)
	{
		$m=new Mailer();//New mailer object is created
		
		$get_info=$this->getRecords("SELECT DATE_FORMAT(treatment_date,'%d/%m/%Y %H:%i') as treatment_date,concat(firstname,' ',lastname) as fullname,c.phone as phone,title,cp.email as email 
		FROM client c 
		INNER JOIN treatment_client tc ON c.email=tc.email  
		INNER JOIN treatment_type tt ON tc.t_id=tt.id
		INNER JOIN companies cp ON cp.company_id=tc.company_id
		WHERE tc.email=? AND tc.treatment_date=? AND t_id=?",array($email,$date,$treatment));
		
		//Sending an email to bituah
		if($m->sendMail($get_info[0]['email'], "נקבע טיפול חדש עבור הלקוח שלכם", "קבענו טיפול חדש עבור ".$get_info[0]['fullname']." מס' טלפון: ".$get_info[0]['phone']."<br>
		עבור טיפול:".$get_info[0]['title']."<br>בתאריך:".$get_info[0]['treatment_date'].'<br>הבחירה הנכונה,<br>&nbsp;&nbsp;&nbsp;Dental Clinic','dentalc734@gmail.com'))
			echo 'success';	
		else
			echo 'fail';
	}

}

$treatments=new TreatmentHandler('localhost','root','','dental');//Creating a treatments object

//Getting all the existing treatments
if(isset($_REQUEST['get_treatments']))
{
	die($treatments->getTreatments());
}
//Getting the existing treatments as options for our select element
elseif(isset($_REQUEST['get_treatments_list']))
{
	die($treatments->getTreatmentsList());
}
//Deleting an existing treatment for the specific client
elseif(isset($_POST['del_treatment']))
{
	if(!isset($_POST['treatment_date']))
		die("יש לבחור תאריך לפי כתובת המייל");
	
	die($treatments->deleteTreatment($_POST['email'],$_POST['treatment_date']));
}
//Getting the information for the specific treatment ( by using its id)
elseif(isset($_POST['get_treatment_info']))
{
	die($treatments->getTreatmentInfoById($_POST['get_treatment_info']));
}
//Getting all treamtments for the specific day
elseif(isset($_POST['show_treatments']))
{	
	die($treatments->getTreatmentByDay($_POST['show_treatments']));
}
//Showing all treatments for the current user
elseif(isset($_POST['show_my_treatments']))
{
	die($treatments->getCurerntUserTreatments($_POST['show_my_treatments']));
}
//Sending email to bituah
elseif(isset($_POST['send_bituah']))
{
	die($treatments->sendBituah($_POST['date'],$_POST['treatment'],$_POST['email'],$_POST['id']));
}

?>