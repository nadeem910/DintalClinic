<?php
require_once "DatabaseHandler.php";
require_once "ValidateInput.php";

class Companies extends DatabaseHandler
{
	/*
	Method that shows all the existing comnpanies
	*/
	public function displaycompaniesList($where)
	{
		//searching spicific company
		$companies=$this->getRecords("SELECT * FROM companies".(!empty($where)? " WHERE c_name LIKE '%".$where."%' OR email LIKE '%".$where."%' OR phone LIKE '%".$where."%'":''),array());
		
		echo '<thead><tr><td>שם החברה</td><td>טלפון</td><td></td><td></td></tr></thead><tbody>';
		
		foreach($companies as $company)//Displaying all the companies information
		{
		?>
			<tr>
				<td><?php echo $company['c_name']; ?></td>
				<td><?php echo $company['phone']; ?><br>
				<?php echo $company['email']; ?></td>
				<td><span class="glyphicon glyphicon-pencil editCompany" data-toggle="modal" data-target="#updateModal" data-id="<?php echo $company['company_id']; ?>"></span></td>
				<td><span class="glyphicon glyphicon-remove deleteCompany" data-id="<?php echo $company['company_id']; ?>"></span></td>
			</tr>
		<?php
		}
		
		echo '</tbody>';
	}
	
	/*
	Method that manages the company (updates or inserts,according to the comapnyId (if 0-adding, if not- updating)
	*/
	public function manageCompany($company_name,$phone,$email,$compId=0)
	{
		$errors=array();//Array that will contain comapny management errors
		
		$validate=new ValidateInput();//Creating a new input validation object
		
		$validate->validateCompanyName($company_name,$this,$errors);//Validating treatment name
		$validate->validatePhone($phone,$errors);//validating the phone number
		$validate->validateEmail($email,$errors);//validating the email address
				
		if(empty($errors))//If there aren't any errors
		{
			if($compId)//If type id is not 0-updating			
				$this->commitQuery("UPDATE companies SET c_name=?,phone=?,email=? WHERE company_id=?",array($company_name,$phone,$email,$compId));
			else//If type id is 0-adding
				$this->commitQuery("INSERT INTO companies(c_name,phone,email) VALUES(?,?,?)",array($company_name,$phone,$email));
				
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
	Method that gets company's information according to its id number
	*/
	public function getById($compIg)
	{
		$comapnyInfo=$this->getRecords("SELECT * FROM companies WHERE company_id=?",array($compIg))[0];
		?>
		שם חברה:<br>
			 <input type="text" class="updateCompanyName" value="<?php echo $comapnyInfo['c_name']; ?>" required>
			 <br>			          
		 
			טלפון:<br>
			 <input type="text" class="updatePhone" value="<?php echo $comapnyInfo['phone']; ?>" required>
			 <br>
			 
			אימייל:<br>
			 <input type="text" class="updateEmail" value="<?php echo $comapnyInfo['email']; ?>" required>
			 <br>	
		<?php		
	}
	
	/*
	Method that deletes an existing company
	*/
	public function deleteCompany($compId)
	{
		$this->commitQuery("DELETE FROM companies WHERE company_id=?",array($compId));
	
	}
	
	/*
	Method that returns comapmnies as select element's options
	*/
	public function getCompaniesList()
	{
		$companies=$this->getRecords("SELECT * FROM companies");//Getting all the existing companies from the database
		echo '<option value="0">ללא חברה</option>';
		foreach($companies as $company)
		{
		?>
			<option value="<?php echo $company['company_id']?>"><?php echo $company['c_name']?></option>
		<?php
		}
	}
}

$company=new Companies('localhost','root','','dental');//Creating a new company object

//Showing all the existing companies
if(isset($_POST['show_companies']))
{
	die($company->displaycompaniesList($_POST['where']));
}
//Managing the company(update/insert)
elseif(isset($_POST['manage_company']))
{
	die($company->manageCompany($_POST['company_name'],$_POST['phone'],$_POST['email'],$_POST['manage_company']));
}
//Deleting an existing company
elseif(isset($_POST['delete_company']))
{
	die($company->deleteCompany($_POST['delete_company']));
}
//Deleting an existing company
elseif(isset($_POST['get_by_id']))
{
	die($company->getById($_POST['get_by_id']));
}
//Getting the selection of all companies
elseif(isset($_POST['get_companies_list']))
{
	die($company->getCompaniesList());
}
?>