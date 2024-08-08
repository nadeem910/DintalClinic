<?php
require_once "DatabaseHandler.php";

/*
(2emoot user & Pass)
This class is responsive for admin authentication process
*/
class Authenticate extends DatabaseHandler
{
	/*
	Method loggs in an admin by checking his credentials
	*/
	public function authenticateAdmin($admin_username,$admin_password)
	{	
		//Getting a user that has these credentials
        $userInfo=$this->getRecords("SELECT * FROM user WHERE username=?",array($admin_username));
        
        if($userInfo)//If there is such a user, checking his password
        {
           $encodedPass=md5($admin_password);
            if($encodedPass==$userInfo[0]['password'])//Checking the password
            {
				//Logging in
			    $_SESSION['loggedin']=true;
                $_SESSION['username']=$admin_username;
			    
				die('success');                
            }        
        }        
		
		//If at least one of the credentials is wrong
		die('שם משתמש או סיסמה שגוים');		
	}
}

$auth=new Authenticate('localhost','root','','dental');//Creating an authentication object

//If admin wants to log in
if(isset($_POST['authenticate']))
{
	die($auth->authenticateAdmin($_POST['admin_username'],$_POST['admin_password']));
}
?>