<?PHP
session_start();
?>


<html>
<head>
    <title>SISTEM REKOMENDASI</title>
    <link rel="stylesheet" href="style.css" />


<script language="JavaScript">
var txt=" Sistem Rekomendasi Penentuan Gizi bagi Anak Balita ";
var kecepatan=1000;
var segarkan=null;
function bergerak() 
{ document.title=txt;
txt=txt.substring(1,txt.length)+txt.charAt(0);
segarkan=setTimeout("bergerak()",kecepatan);}bergerak();
</script>

<link href="favicon.ico" rel='shortcut icon'/>

<style type="text/css">

body{
margin:0;
padding:0;
}

#login{
background:#f3cca6;

}

#login table{
font-family:arial;
font-size:12px;
border: 5px solid #ffffff;
padding:9px;
margin-top:100px;
-webkit-border-radius: 20px;
-moz-border-radius: 20px;
border-radius: 20px;

}
#login b{
font-family:arial;
font-size:20px;
font-weight:bold;
}
input[type=text],[type=password]{
border:4px;
background: #f8ecc5;
padding:8px;
-webkit-border-radius: 45px;
-moz-border-radius: 45px;
border-radius: 45px;
}
#login a{
color:#c75c1c;
}
#button{
width : 100px; 
height:30px; 
border: 2px solid #c75c1c; 
padding:2px;
color:#ffffff;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
}
</style>
</head>
<body>
          <form action='cek_login.php' method='POST' >
			<div id="login" >
						
         				<table  align="center" cellspacing="0" cellpadding="3" border="0" bgcolor="" style="border: 10px solid #d78d51;">
					<tr bgcolor="#d78d51" >
						<td><input type="image" img src="images/login.png" width="46" height="40" style="background:#d78d51;"></td><td colspan="2" valign="center"><b>User Login </b></td>
					</tr>
					<tr height="15px">
					</tr>
					<tr>
						<td>Username</td>
						<td>:</td>
						<td><input type="text" name="username" id="username" size="45" style="text-transform:lowercase;"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td>:</td>
						<td><input type="password" name="password" id="password" size="45" style="text-transform:lowercase;"></td>
					</tr>
					<tr><td colspan="2"></td><td>
					<a href="lupa_pass.php" style="text-decoration:none">Lupa Password</a>
					</td></tr>
					<tr height="10px">
					</tr>
					<tr>
						<td colspan="2">
						</td>
						<td>
							<input type="submit" value="Login" name="login" id="button" style="background: #d78d51;">
							&nbsp;
							<input type="reset" name="reset" value="Reset" id="button" style="background: #d78d51;"/>
						</td>
						
					</tr>
					<tr height="10px">
					
					</tr>
		
           
				</table>
				</form>
				</div>
</body>
</html>