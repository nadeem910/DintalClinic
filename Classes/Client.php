<?php
require_once "DatabaseHandler.php";
require_once "ValidateInput.php";
require_once "Mailer.php";
/*
This class is responsive for signing client for a new treatment (client information is added/updated at the database)
*/
class Client extends DatabaseHandler
{
	/*
	Method adds/updates a client and signs him for a new treatment
	*/
	public function signClient($fname,$lname,$email,$phone,$datetime,$treatmentId,$company)
	{
		$signErrors=array();//Array that will contain sign errors
		
		$validate=new ValidateInput();//Creating a new input validation object
		
		$validate->validateFname($fname,$signErrors);//Validating first name
		$validate->validateLname($lname,$signErrors);//Validating last name
		$validate->validateEmail($email,$signErrors);//Validating email address
		$validate->validatePhone($phone,$signErrors);//Validating a phone number
		$validate->validateDateTime($datetime,$treatmentId,$signErrors,$this);//Validating date and time
		$validate->validateTreatmentId($treatmentId,$this,$signErrors);//Validating the treatment id
		
		if($company)//If the client has chosen a company id
			$validate->validateCompanyId($company,$this,$signErrors);//Validating the company id
		
		if(empty($signErrors))//If there aren't any errors
		{
			$treatment_date=$datetime;
			
			//Changing the datetime format
			$new_format=explode(" ",$datetime);
			$date=explode("/",$new_format[1]);	
			$datetime=$date[2].'-'.$date[1].'-'.$date[0].' '.$new_format[0];//Creating a new datetime format
			
			$this->commitQuery("START TRANSACTION");//Transaction means that both queries will be executed or fail
			//Adding/ updating the client at our database
			$this->commitQuery("INSERT INTO client(firstname,lastname,email,phone) VALUES(?,?,?,?) ON DUPLICATE KEY UPDATE lastname=?,phone=?",array($fname,$lname,$email,$phone,$lname,$phone));
			
			
			$info=array($email,$treatmentId,$datetime);
			
			if($company)//If company was chosen
				$info[]=$company;
				
			
			//Tor
			$this->commitQuery("INSERT INTO treatment_client(email,t_id,treatment_date".($company!=0 ?',company_id':'').") VALUES(?,?,?".($company!=0 ?',?':'').")",$info);
			$this->commitQuery("COMMIT");
			
			//Checking if the client signed in successfully to a treatment
			if(count($this->getRecords("SELECT * FROM client WHERE email=?",array($email))))
			{

				
				$m1=new Mailer();//New mailer object is created
				$msubject= "תורך נקבע בהצלחה";
				$mbody=  "סוג טיפולך:".$this->getRecords("SELECT title FROM treatment_type WHERE id=?",array($treatmentId))[0]['title']."<br>טיפולך בתאריך:".$treatment_date.'<br>הבחירה הנכונה,<br>&nbsp;&nbsp;&nbsp;Dental Clinic';
				$mail1result=$m1->sendMail($email,$msubject ,$mbody );

				$m2=new Mailer();//New mailer object is created
				$msubject2= "טיפול חדש נקבע";
				$mbody2=  "פרטי הלקוח:".$fname.' '.$lname.' '.$email.' '.$phone."<br>סוג טיפול:".$this->getRecords("SELECT title FROM treatment_type WHERE id=?",array($treatmentId))[0]['title']."<br>הטיפול בתאריך:".$treatment_date.'<br>הבחירה הנכונה,<br>&nbsp;&nbsp;&nbsp;Dental Clinic';
				$mail2result=$m2->sendMail('dentalc734@gmail.com',$msubject2 ,$mbody2 );
								
				
				if( $mail1result && $mail2result)
					echo 'success';
				else//If the email couldn't be added to a mail queue
					echo "התור נקבע בהצלחה,אבל אין באפשרתנו לשלוח אישור באימייל";
			}
			else
				echo "אין אפשרות לרשום אותך לטיפול";
			
		}
		else
		{
			//Displaying all errors we had
			foreach($signErrors as $err)
			{
				echo $err."<br>";
			}
		}
	}
	
	/*
	Method that shows all the existing clients
	*/
	public function displayClientsList($where)
	{
		$clients=$this->getRecords("SELECT * FROM client".(!empty($where)? " WHERE firstname LIKE '%".$where."%' OR lastname LIKE '%".$where."%' OR email LIKE '%".$where."%' OR phone LIKE '%".$where."%'":''),array());
		
		echo '<thead><tr><td>שם מלא</td><td>פרטי לקוח</td><td></td><td></td></tr></thead><tbody>';
		
		foreach($clients as $client)//Displaying all the clients information
		{
		?>
			<tr>
				<td><?php echo $client['firstname'].' '.$client['lastname']; ?></td>
				<td><?php echo $client['phone']; ?><br>
				<?php echo $client['email']; ?></td>
				<td><span class="glyphicon glyphicon-pencil editClient" data-toggle="modal" data-target="#updateModal" data-id="<?php echo $client['email']; ?>"></span></td>
				<td><span class="glyphicon glyphicon-remove deleteClient" data-id="<?php echo $client['email']; ?>"></span></td>
			</tr>
		<?php
		}
		
		echo '</tbody>';
	}
	
	/*
	Method that deletes an existing client
	*/
	public function deleteClient($email)
	{
		
		$this->commitQuery("DELETE FROM treatment_client WHERE email=?",array($email));//מוחק טיפול
		$this->commitQuery("DELETE FROM client WHERE email=?",array($email));//מוחק לקוח
	}
	
	/*
	Method that gets client's information according to his Email
	*/
	public function getByEmail($email)
	{
		$clientInfo=$this->getRecords("SELECT * FROM client WHERE email=?",array($email))[0];
		?>
		
				 שם:<br>
                 <input type="text" class="updateFirstname" value="<?php echo $clientInfo['firstname']; ?>" required>
                 <br>
                 משפחה:<br>
                 <input type="text" class="updateLastname" value="<?php echo $clientInfo['lastname']; ?>" required><br>             
             
                טלפון:<br>
                <input type="text" class="updatePhone"  value="<?php echo $clientInfo['phone']; ?>" required>   <br> 
		<?php		
	}
	
	/*
	Method that updates an existing client
	*/
	public function updateClient($email,$firstname,$lastname,$phone)
	{
		$errors=array();//Array that will contain sign errors
		
		$validate=new ValidateInput();//Creating a new input validation object
		
		$validate->validateFname($firstname,$errors);//Validating first name
		$validate->validateLname($lastname,$errors);//Validating last name		
		$validate->validatePhone($phone,$errors);//Validating a phone number
		
		if(empty($errors))//If there aren't any errors
		{
			$this->commitQuery("UPDATE client SET firstname=?,lastname=?,phone=? WHERE email=?",array($firstname,$lastname,$phone,$email));
			echo 'success';
		}
		else
		{
			//Displaying all errors we had
			foreach($errors as $err)
			{
				echo $err."<br>";
			}
		}
	}
	
	/*
	Method that shows all treatments' history
	*/
	public function showTreatmentHistory($where)
	{
		$history=$this->getRecords("SELECT concat(firstname,' ',lastname) as fullName,c.email as email,phone,title,DATE_FORMAT(treatment_date,'%d/%m/%Y %h:%i') as treatment_date FROM client c INNER JOIN treatment_client tc ON c.email=tc.email 
		INNER JOIN treatment_type tt ON tt.id=tc.t_id".(!empty($where)? " WHERE firstname LIKE '%".$where."%' OR lastname LIKE '%".$where."%' OR c.email LIKE '%".$where."%' OR phone LIKE '%".$where."%'":''));
	
		$list='<table class="table"><thead><tr><td>שם מלא</td><td>אימייל</td><td>טלפון</td><td>סוג הטיפול</td><td>תאריך ושעת הטיפול</td></tr></thead><tbody>';
		
		foreach($history as $h)
		{
			$list.='<tr><td>'.$h['fullName'].'</td><td>'.$h['email'].'</td><td>'.$h['phone'].'</td><td>'.$h['title'].'</td><td>'.$h['treatment_date'].'</td></tr>';
		}	

		$list.='</tbody></table>';	
		
		die($list);
	}
}

$client=new Client('localhost','root','','dental');//Creating a new client object

//If a client wants to sign for a treatment
if(isset($_POST['add_client']))
{
	die($client->signClient($_POST['name'],$_POST['lname'],$_POST['email'],$_POST['phone'],$_POST['datetime'],$_POST['treatment'],$_POST['company']));
}
//Showing all the existing clients
elseif(isset($_POST['show_clients']))
{
	die($client->displayClientsList($_POST['where']));
}
//Deleting an existing client
elseif(isset($_POST['delete_client']))
{
	die($client->deleteClient($_POST['delete_client']));
}
//Getting cleints's information by his email
elseif(isset($_POST['get_by_email']))
{
	die($client->getByEmail($_POST['get_by_email']));
}
//Updating existing client's information
elseif(isset($_POST['update_client']))
{
	die($client->updateClient($_POST['update_client'],$_POST['firstname'],$_POST['lastname'],$_POST['phone']));
}
//Showing the treatment history
elseif(isset($_POST['show_history']))
{
	die($client->showTreatmentHistory($_POST['where']));
}
?>