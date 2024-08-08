<?php
class ValidateInput
{
	/*
	(2emoot/bdekat tkenoot)
	Method that validates a first name
	*/
	public function validateFname($fname,&$err)
	{
	if(!preg_match("/^[A-Za-z\p{Hebrew}]{1}[a-z\p{Hebrew}]{2,24}$/u",$fname))
		{
			$err[]="שם פרטי יכול להכיל בין 3-25 אותיות בלבד";
		}
	}
	
	/*
	Method that validates full name
	*/
	public function validateFullname($fullname,&$err)
	{
		if(!preg_match("/^[A-Za-z\p{Hebrew}]{1}[a-z\p{Hebrew}]{2,24}[\s]{1}[A-Za-z\p{Hebrew}]{1}[a-z\p{Hebrew}]{2,24}$/u",$fullname))
		{
			$err[]="שם מלא יכול להכיל בין 6-50 אותיות בלבד כולל רווח";
		}
	}
	
	/*
	Method that checks if this email already exists and who this email belongs to
	*/
	public function validateEmailExists($email,$doctorId,$db,&$err)
	{		
		$checkArr=$doctorId!=0 ? array($doctorId,$email) :array($email);
		
		if(count($db->getRecords("SELECT * FROM doctor WHERE ".($doctorId!=0 ? "id!=? AND ":"")."email=?",$checkArr)))
			$err[]="אימייל זה שייך לרופא אחר";		
	}
	
	/*
	Method that validates a last name
	*/
	public function validateLname($lname,&$err)
	{
		if(!preg_match("/^[A-Za-z\p{Hebrew}]{1}[a-z\p{Hebrew}]{2,24}$/u",$lname))
		{
			$err[]="שם משפחה יכול להכיל בין 3-25 אותיות בלבד";
		}
	}
	
	/*
	Method that validates a phone number
	*/
	public function validatePhone($phone,&$err)
	{
		
		if(!preg_match("/^\+?(972|0)(\-)?0?(([23489]{1}\d{7})|[5]{1}\d{8})$/",$phone))
		{
			$err[]="פורמט טלפון לא חוקי";
		}
	}
	
	/*
	Method that validates an email address
	*/
	public function validateEmail($email,&$err)
	{
		if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			$err[]="פורמט אימייל לא חוקי";
		}		
	}
	
	/*
	Method that validates that date time format is valid
	*/
	public function validateDateTime($datetime,$treatmentId,&$err,$db)
	{		
		if(empty($datetime))//If didn't choose any date time		
			$err[]="נא לבחור מועד";			
		else
		{	
			$new_format=explode(" ",$datetime);
		
			$date=explode("/",$new_format[1]);	
			$datetime=$date[2].'-'.$date[1].'-'.$date[0].' '.$new_format[0];//Creating a new datetime format
			
			if(strtotime($datetime)<time())//Checking that this time is not earlier than the current time			
				$err[]="מועד אינו יכול להיות מוקדם מהזמן הנוכחי";			
			else
			{				
				if(!checkdate($date[1],$date[0],$date[2]) || !preg_match("/^([0-1]{1}[0-9]{1}|[2]{1}[0-3]{1}):[0-5]{1}[0-9]{1}$/", $new_format[0]))//Checking if date & time has a valid format
					$err[]="פורמט תאריך שגוי";				
				else
				{					
					//If this date and time is already taken by another client
					if(count($db->getRecords("SELECT * FROM treatment_client tc INNER JOIN treatment_type tt ON tc.t_id=tt.id WHERE '".$datetime."' BETWEEN treatment_date AND treatment_date+ INTERVAL  treatment_time MINUTE")))
						$err[]="מועד זה הינו תפוס ,נא לבחור מועד אחר";										
				}
			}
		}
	}
	
	/*
	Method taht validates treatment id
	*/
	public function validateTreatmentId($treatmentId,$db,&$err)
	{
		if(!count($db->getRecords("SELECT * FROM treatment_type WHERE id=?",array($treatmentId))))
			$err[]="טיפול זה אינו קיים";
	}
	
	/*
	Method that validates the company id
	*/
	public function validateCompanyId($companyId,$db,&$err)
	{
		if(!count($db->getRecords("SELECT * FROM companies WHERE company_id=?",array($companyId))))
			$err[]="חברת ביטוח זו אינה קיימת";
	}
	
	/*
	Method validates a company name
	*/
	public function validateCompanyName($companyName,$db,&$err) 
	{
		if(!preg_match("/^[A-Za-z\p{Hebrew}]{1}[a-z\p{Hebrew}]{2,24}$/u",$companyName))
		{
			$err[]="שם חברת הביטוח יכול להכיל בין 3-25 אותיות בלבד";
		}
		else
		{
			//If this company name already exists
			if(count($db->getRecords("SELECT * FROM companies WHERE c_name=?",array($companyName))))				
				$err[]="חברת ביטוח זו כבר קיימת";
		}
	}
	
	/*
	Method that validates treatment name
	*/
	public function validateTreatmentName($name,&$err)
	{
		if(!preg_match("/^[A-Za-z\p{Hebrew}]{1}[a-z\p{Hebrew}]{2,24}[\s]{0,1}[A-Za-z\p{Hebrew}]{0,1}[a-z\p{Hebrew}]{0,24}$/u",$name))
		{
			$err[]="סוג טיפול יכול להכיל לפחות מילה אחת המתחילה באות";
		}
	}
	
	/*
	Method that validates treatment description
	*/
	public function validateDescription($description,&$err)
	{
		if(empty($description))
		{
			$err[]="נא להוסיף הסבר לסוג טיפול";
		}
	}		
	
	/*
	Method that validates treatment time
	*/
	public function validateTime($time,&$err)
	{
		if($time<5 || $time>240)//Minutes range
		{
			$err[]="משך זמן טיפול הינו בין 5-240 דקות בלבד";
		}
	}
	
	/*
	Method that validates a suggestion message
	*/
	public function validateSuggestion($suggestion,&$err)
	{
		if(empty($suggestion))
			$err[]="נא לרשום המלצה";
	}
}
?>
