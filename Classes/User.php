<?php
require_once "DatabaseHandler.php";

/*
This class is responsive for update username & password
*/
class User extends DatabaseHandler
{
	/*
	Method updates username or/and password
	*/
	public function UserUpdate($username,$password,$newpassword)
	{	
		//Checking if there is a user with this username
        $userInfo=$this->getRecords("SELECT * FROM user WHERE username=?",array($_SESSION['username']));
        
        if($userInfo)//If such a user exists
        {
           $encodedPass=md5($password);
            if($encodedPass==$userInfo[0]['password'])//Chekcing the password
            {
                if($newpassword)//If the user wants to change his password to a new one
				{
                    $newencodedPass=md5($newpassword);
                    $this->commitQuery("UPDATE user SET username=?,password=? WHERE username=?",array($username,$newencodedPass,$_SESSION['username']));
                }
				else//Updating the username only
				{
                    $this->commitQuery("UPDATE user SET username=? WHERE username=?",array($username,$_SESSION['username']));                    
                }
				
				$_SESSION['username']=$username;//Updating the username session         
			    
                die('success');
            }        
        }        
		
		echo('שם משתמש/סיסמא שגויים');		
	}
}

$user=new User('localhost','root','','dental');//Creating an user object

//If admin wants to update user || password
if(isset($_POST['username']))
{
	$user->UserUpdate($_POST['username'],$_POST['password'],$_POST['newpassword']);
}
?>