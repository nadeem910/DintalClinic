<?php
require_once "DatabaseHandler.php";
require_once "ValidateInput.php";

/*
Class is responsible for updating/deleting/showing/adding a doctor
*/
class DoctorsHandler extends DatabaseHandler
{
	/*
	Metjhod that shows all the existing doctors
	*/
	public function displayDoctorsList($where)
	{
		//searching a doctor
		$doctors=$this->getRecords("SELECT * FROM doctor".(!empty($where)? " WHERE fullname LIKE '%".$where."%' OR email LIKE '%".$where."%' OR phone LIKE '%".$where."%'":''),array());
		
		echo '<thead><tr><td>שם מלא</td><td>פרטי רופא</td><td></td><td></td></tr></thead><tbody>';
		
		foreach($doctors as $doctor)//Displaying all the doctors information
		{
		?>
			<tr>
				<td><?php echo $doctor['fullname']; ?></td>
				<td><?php echo $doctor['phone']; ?><br>
				<?php echo $doctor['email']; ?></td>
				<td><span class="glyphicon glyphicon-pencil editDoctor" data-toggle="modal" data-target="#updateModal" data-id="<?php echo $doctor['id']; ?>"></span></td>
				<td><span class="glyphicon glyphicon-remove deleteDoctor" data-id="<?php echo $doctor['id']; ?>"></span></td>
			</tr>
		<?php
		}
		
		echo '</tbody>';
	}
	
	/*
	Method that deletes an existing doctor
	*/
	public function deleteDoctor($doctorId)
	{
		$this->commitQuery("DELETE FROM doctor WHERE id=?",array($doctorId));
	}
	
	/*
	Method that manages the doctor (updates or inserts,according to the doctorId (if 0-adding, if not- updating)
	*/
	public function manageDoctor($fullname,$email,$phone,$doctorId=0)
	{
		$errors=array();//Array that will contain doctor management errors
		
		$validate=new ValidateInput();//Creating a new input validation object
		
		$validate->validateFullname($fullname,$errors);//Validating full name	
		$validate->validateEmail($email,$errors);//Validating email address
		$validate->validateEmailExists($email,$doctorId,$this,$errors);//Checkign if email address exists and who it belongs to
		$validate->validatePhone($phone,$errors);//Validating a phone number
		
		if(empty($errors))//If there aren't any errors
		{
			if($doctorId)//If doctor id is not 0-pdating			
				$this->commitQuery("UPDATE doctor SET fullname=?,email=?,phone=? WHERE id=?",array($fullname,$email,$phone,$doctorId));
			else//If doctor id is 0-adding
				$this->commitQuery("INSERT INTO doctor(fullname,email,phone) VALUES(?,?,?)",array($fullname,$email,$phone));
				
			echo 'success';
		}
		else//If there are some doctor management errors
		{
			//Displaying all errors we had
			foreach($errors as $err)
			{
				echo $err."<br>";
			}
		}
	}
	
	/*
	Method that gets doctor's information according to his id number
	*/
	public function getById($doctorId)
	{
		$doctorInfo=$this->getRecords("SELECT * FROM doctor WHERE id=?",array($doctorId))[0];
		?>
		שם מלא:<br>
		 <input type="text" class="updateFullname" value="<?php echo $doctorInfo['fullname']; ?>" required>
		 <br>			          
	 
		דואר אלקטרוני:<br>
		<input type="email" class="updateEmail" value="<?php echo $doctorInfo['email']; ?>" required>  <br>  

		טלפון:<br>
		<input type="text" class="updatePhone" value="<?php echo $doctorInfo['phone']; ?>" required>   <br> 
		<?php		
	}
}

$d=new DoctorsHandler('localhost','root','','dental');//Creating a new doctors' handler object

//Showing all the existing doctors
if(isset($_POST['show_doctors']))
{
	die($d->displayDoctorsList($_POST['where']));
}
//Deleting an existing doctor
elseif(isset($_POST['delete_doctor']))
{
	die($d->deleteDoctor($_POST['delete_doctor']));
}
//Managing doctor (insert/update)
elseif(isset($_POST['manage_doctor']))
{
	die($d->manageDoctor($_POST['fullname'],$_POST['email'],$_POST['phone'],$_POST['manage_doctor']));
}
//Getting doctor's information by his id
elseif(isset($_POST['get_by_id']))
{
	die($d->getById($_POST['get_by_id']));
}
?>