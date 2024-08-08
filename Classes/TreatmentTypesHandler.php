<?php
require_once "DatabaseHandler.php";
require_once "ValidateInput.php";

/*
Class is responsible for updating/deleting/showing/adding treatment types
*/
class TreatmentTypesHandler extends DatabaseHandler
{
	/*
	Method that displays information for all types
	*/
	public function showTypes($where)
	{
		//searching a spicific treatment
		$types=$this->getRecords("SELECT * FROM treatment_type".(!empty($where)? " WHERE title LIKE '%".$where."%'":''),array());
		
		echo '<thead><tr><td>סוג הטיפול</td><td></td><td></td></tr></thead><tbody>';
		
		foreach($types as $type)//Displaying all the types' information
		{
		?>
			<tr>
				<td><?php echo $type['title']; ?></td>				
				<td><span class="glyphicon glyphicon-pencil editType" data-toggle="modal" data-target="#updateModal" data-id="<?php echo $type['id']; ?>"></span></td>
				<td><span class="glyphicon glyphicon-remove deleteType" data-id="<?php echo $type['id']; ?>"></span></td>
			</tr>
		<?php
		}
		
		echo '</tbody>';
	}
	
	/*
	Method that deletes an existing treatment type
	*/
	public function deleteType($typeId)
	{
		$this->commitQuery("DELETE FROM treatment_client WHERE t_id=?",array($typeId));//deleting treatment from client
		$this->commitQuery("DELETE FROM treatment_type WHERE id=?",array($typeId));//then deleting the tretment type 
	}	
	
	/*
	Method that manages the treatment type (updates or inserts,according to the typeId (if 0-adding, if not- updating)
	*/
	public function manageType($name,$description,$time,$typeId=0)
	{
		$errors=array();//Array that will contain type management errors
		
		$validate=new ValidateInput();//Creating a new input validation object
		
		$validate->validateTreatmentName($name,$errors);//Validating treatment name
		$validate->validateDescription($description,$errors);//Validating description
		$validate->validateTime($time,$errors);//Validate treatment time
				
		if(empty($errors))//If there aren't any errors
		{
			if($typeId)//If type id is not 0-updating			
				$this->commitQuery("UPDATE treatment_type SET title=?,description=?,treatment_time=? WHERE id=?",array($name,$description,$time,$typeId));
			else//If type id is 0-adding
				$this->commitQuery("INSERT INTO treatment_type(title,description,treatment_time) VALUES(?,?,?)",array($name,$description,$time));
				
			echo 'success';
		}
		else//If there are some type management errors
		{
			//Displaying all errors we had
			foreach($errors as $err)
			{
				echo $err."<br>";
			}
		}
	}	
	
	/*
	Method that gets type's information according to its id number
	*/
	public function getById($typeId)
	{
		$typeInfo=$this->getRecords("SELECT * FROM treatment_type WHERE id=?",array($typeId))[0];
		?>
		שם הטיפול:<br>
		 <input type="text" class="updateType" value="<?php echo $typeInfo['title']; ?>" required>
		 <br>			          
	 
		הסבר:<br>
		 <textarea class="updateDescription" required><?php echo $typeInfo['description']; ?></textarea>
		 <br>
		 
		משך הטיפול:<br>
		 <input type="number" class="updateTime" value="<?php echo $typeInfo['treatment_time']; ?>" required>
		 <br>	
		<?php		
	}
}

$type=new TreatmentTypesHandler('localhost','root','','dental');//Creating a new type' handler object

//Showing all the existing types
if(isset($_POST['show_types']))
{
	die($type->showTypes($_POST['where']));
}
//Deleting an existing treatment type
elseif(isset($_POST['delete_type']))
{
	die($type->deleteType($_POST['delete_type']));
}
//Managing the treatment type(update)
elseif(isset($_POST['manage_type']))
{
	die($type->manageType($_POST['name'],$_POST['description'],$_POST['time'],$_POST['manage_type']));
}
//Getting type's information by its id
elseif(isset($_POST['get_by_id']))
{
	die($type->getById($_POST['get_by_id']));
}
?>