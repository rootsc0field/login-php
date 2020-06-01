<html>
<head>
<title>Login</title>
<meta charset="utf8">
<style>

#id{margin-top:8px; padding:10px;}
body{background-color:black;background-image:url("https://i.hizliresim.com/1uIIzi.jpg"); background-repeat:no-repeat; background-position:center;}
div{color:white}
input{border-radius:10px;}
.number1{border-style:solid; border-color:white; border-radius:10px; margin-right:500px; margin-left:500px}
.number2{padding:3px;}
input:hover{border-style:1px solid; border-color:red; transition:0.8s; padding:5px;}
form{margin-top:270px; background-color:black;}

</style>
</head>

<form class="number1" method="post" action="">
<center><table>
    <div>Username</div>
    <input class="number2" type="text" name="username" placeholder="username"/>
    <div>Password</div>
    <input class="number2" type="password" name="password" placeholder="password"/><br>
    <input id="id" type="submit" value="Login"/>
</table></center>
</form>

</html>

<?php 

session_start();
define('ADMIN',true);

if($_POST){
    $user = htmlspecialchars(addslashes(trim(@$_POST["username"])));
    $pass = htmlspecialchars(addslashes(trim(@$_POST["pass"])));
    if(!$user || !$pass){
        echo "<font color='red'>Alanlarý boþ býrakmayýnýz</font>";
        header('Refresh:2;url=login.php');
    }
    if($_SESSION["login"]){
        $db = new PDO("mysql:host=localhost;db=login;charset=utf8","root","");
        $db->prepare("SELECT * FROM users WHERE username=:user,password=:pass");
        $db->fetchAll(PDO::FETCH_ASSOC);
        $db->query("SET CHARACTER 'UTF-8'");
        $data = array(
            'user' =>  $user,
            'pass' => $pass
        );
        $result = $db->execute($data);
        if($result){
            $_SESSION['login'] = true;
            $_SESSION['user'] = $result['username'];
            $_SESSION['pass'] = $result['password'];
            header('Location:index.php');
        }
        
    }else{
        header('Refresh:2;url=login.php');
    }
}


?>