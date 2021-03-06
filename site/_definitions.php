<?php

$failed_to_connect_to_sql_database = false;
$iEmail = '';
$iPassword = '';
$iUsername = '';
$stmt = '';

if(isset($_COOKIE['username'])) $global_username = $_COOKIE['username']; else $global_username = '';


//Create the SQL connection...
try {
    $con = new PDO("mysql:host=127.0.0.1;dbname=dusttoash", 'root', file_get_contents($_SERVER['DOCUMENT_ROOT']."/block/password.blocked"));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $con->prepare('INSERT INTO users (email, password, sessionID, signup_date, username) VALUES(:email, :password, :sessionID, CURRENT_DATE, :username)');
	$gennedSessionID = genSessionID($iUsername);
	$stmt->bindParam(':email', $iEmail);
	$stmt->bindParam(':password', $iPassword);
	$stmt->bindParam(':sessionID', $gennedSessionID);
	$stmt->bindParam(':username', $iUsername);
    }
catch(PDOException $e)
    {
     $failed_to_connect_to_sql_database = true;
	}
	
	
	//Generates a session id...
	function genSessionID($name){
		return 'asdfkj23foi13lkf';
	}
	
	
	$addUserStmtName ='';
	$addUserStmt = $con->prepare("SELECT username FROM users WHERE username=:name");
	$addUserStmt->bindParam(':name', $addUserStmtName);
	//Adds a user to the database...
	function addUser($email, $username, $password){
		global $failed_to_connect_to_sql_database, $iEmail, $iPassword, $iUsername, $stmt, $cookie_loggedin_override, $addUserStmtName,$addUserStmt, $genned_sessionID, $con;
		if($failed_to_connect_to_sql_database){return "connection failure";}
		if(strpos($_POST['email'], '@')===false || strpos($_POST['email'],'.')===false || strlen($_POST['email'])<7){
			return "invalid email";
}
if(strlen($password)<4)return "password too short";
		
		foreach($con->query('SELECT email FROM users WHERE 1') as $i){
			foreach($i as $p)
	if(strcasecmp($email, $p)===false)
	return 'duplicate email';}
	foreach($con->query('SELECT username FROM users WHERE 1') as $i){
	if(strcasecmp($username, $i)===false)
	return 'duplicate username';
}
		
		$addUserStmtName=$username;
		$addUserStmt->execute();
		$check = $addUserStmt->fetchAll();
		if(sizeof($check)>0)return false;
		$iEmail = $email;
		$iPassword=$password;
		$iUsername=$username;
		$genned_sessionID = genSessionID($username);
	$stmt->execute();
	$cookie_loggedin_override = "a";
	return 'success';
	}
	
	
	
	
	
	
	//Stuff for log in function.
	$logInStmt = $con->prepare("UPDATE users SET sessionID=:id WHERE username=:name");
	$logInStmt2 = $con->prepare("SELECT password FROM users WHERE username=:name");
	$logInStmtId = '';
	$logInStmtName = '';
	$logInStmt->bindParam(':id', $logInStmtId);
	$logInStmt->bindParam(':name', $logInStmtName);
	$logInStmt2->bindParam(':name', $logInStmtName);
	
	//Logs a user in...
	function logIn($username, $password){
		global $logInStmt, $logInStmtName, $logInStmtId, $logInStmt2, $name, $con, $cookie_loggedin_override;
		$logInStmtName = $username;
		$logInStmt2->execute();
			$lol = $logInStmt2->fetchAll();
		foreach($lol as $thing){
		if($thing[0] === $password){
		$logInStmtId = genSessionID($username);
		$logInStmt->execute();
		setcookie('sessionId', $logInStmtId, time()+ 86400*3, '');
		setcookie('username', $logInStmtName, time()+ 86400*3, '');
		$name = $logInStmtName;
		$cookie_loggedin_override = "a";
		return true;}
		
		
		}
		return false;
		
	}
	
	
	//Checks if someone is logged in...
	function isLoggedIn(){
		global $cookie_loggedin_override, $cookie_signedout_override;
		return (isset($_COOKIE['username']) || isset($cookie_loggedin_override)) && !isset($cookie_signedout_override) ;
	}

include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/_templateLoader.php';
?>
