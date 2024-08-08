<?php
require_once "DatabaseHandler.php";
require_once "ValidateInput.php";

//Class is responsible to add/show suggestions
class Suggestions extends DatabaseHandler
{	
	//Method that adds a new suggestion	
	public function addSuggestion($firstname,$lastname,$content)
	{
		$errors=array();//Array that will contain suggestion errors
		
		$validate=new ValidateInput();//Creating a new input validation object
		
		$validate->validateFname($firstname,$errors);//Validating the first name
		$validate->validateLname($lastname,$errors);//Validating the last namer
		$validate->validateSuggestion($content,$errors);//Validating the suggestion message
		
		if(empty($errors))//Ifthere aren't any errors
		{
			//Adding a new suggestion
			$this->commitQuery("INSERT INTO suggestions(first_name,last_name,content) VALUES(?,?,?)",array($firstname,$lastname,$content));
			echo 'success';
		}
		else//Displaying all errors
		{
			foreach($errors as $e)
			{
				echo $e."<br>";
			}
		}		
	}
	
	//Method that shows all the existing suggestions
	public function showSuggestions($where)
	{
		echo '<div class="col-md-12"><table class="table table-striped"><tr><td>תאריך</td><td>שם פרטי</td><td>שם משפחה</td><td>תוכן</td></tr>';
		
		$suggestions=$this->getRecords("SELECT first_name,last_name,content,DATE_FORMAT(add_date,'%d/%m/%Y %H:%i') as s_date FROM suggestions".(!empty($where)? " WHERE first_name LIKE '%".$where."%' OR last_name LIKE '%".$where."%'":''));
		foreach($suggestions as $s)
		{
		?>
			<tr><td><?php echo $s['s_date']; ?></td><td><?php echo(!empty($s['first_name'])? $s['first_name']: 'לא נרשם' ); ?></td><td><?php   echo(!empty($s['last_name'])? $s['last_name']: 'לא נרשם' ); ?></td><td><p style="width:40%;padding:20px;word-wrap:break-word;"><?php  echo $s['content']; ?></p></td></tr>
		<?php
		}
		
		echo '</table></div>';
	}
}

$s=new Suggestions('localhost','root','','dental');

//Adding a new suggestion
if(isset($_POST['add_suggestion']))
{
	die($s->addSuggestion($_POST['firstname'],$_POST['lastname'],$_POST['content']));
}
//Showing all the existing suggestions
elseif(isset($_POST['show_suggestion']))
{
	die($s->showSuggestions($_POST['where']));
}
?>