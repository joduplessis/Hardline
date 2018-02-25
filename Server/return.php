<?php
	define("HOST", "sql13.jnb2.host-h.net");
	define("USERNAME", "joduptrkzn_1");
	define("PASSWORD", "nH1QTEX8");
	define("DATABASE", "legacy");
	mysql_connect(HOST,USERNAME,PASSWORD) or die(mysql_error()) ;
	mysql_select_db(DATABASE) or die(mysql_error()) ;
	
?>

<?php 

if ($_GET['type']=="list") { 

	$id = $_GET['id'];

	$sql = mysql_query("SELECT * FROM messages WHERE phoneid = '$id'") or die(mysql_error()) ;
	
	if (mysql_num_rows($sql)!=0) {
		while($data = mysql_fetch_row($sql)) {
		
			$id = $data['0'] ;
		
			echo "<li>" ;
			echo '<a href="#" id="button-message-view" sp="'.$id.'">' ;
			echo "<h3>".$data['1']."</h3>" ;
			echo '<p class="topic">'.substr($data['2'],0,35).'...</p>' ;
			
			$c_sql = mysql_query("SELECT * FROM comments WHERE mid = '$id'") or die(mysql_error()) ;
			
			echo '<span class="ui-li-count">'.mysql_num_rows($c_sql).'</span>' ;
			echo "</a>" ;
			echo "</li>" ;
			
		}
	} else { 
		echo "<li style='color:#666666;'>" ;
		echo "<p style='color:#666666;'><span  style='color:#666666;'><br/>There are no open conversations.</span></p>" ;
		echo "</li>" ;
	}

} 

?>

<?php 

if ($_GET['type']=="message") { 

	$id = $_GET['id'] ;
	$sql_query = "SELECT * FROM messages WHERE id = ".$id ;
	$sql = mysql_query($sql_query) or die(mysql_error()) ;
	
	$data = mysql_fetch_row($sql) ;
	
	$cdate = strtotime( $data['9'] ) ; 
	$cdate_nice = date( 'd F l', $cdate);

	echo "<div class='block'>" ;
	echo "<span>".$cdate_nice."</span>" ;
	echo "<h1>".$data['1']."</h1>" ;
	echo "<p>".$data['2']."</p>" ;
	echo "</div>" ;
	
	$c_sql = mysql_query("SELECT * FROM comments WHERE mid = '$id'") or die(mysql_error()) ;
	
	if (mysql_num_rows($c_sql)!=0) {
	
		while($c_data = mysql_fetch_row($c_sql)) {

			$cdate = strtotime( $c_data['2'] ) ; 
			$cdate_nice = date( 'd F l', $cdate);
		
			if ($c_data['3']) {
				echo "<div class='block comment avalanche'>" ;
			} else {
				echo "<div class='block comment'>" ;
			}
			echo "<span>".$cdate_nice."</span>" ;
			echo "<p>".$c_data['1']."</p>" ;
			echo "</div>" ;
			
		}
		
	}		


} 

?>



<?php 

if ($_GET['type']=="getuser") { 

	$id = $_GET['id'] ;
	$sql_query = "SELECT * FROM user WHERE phoneid = '".$id."'" ;
	$sql = mysql_query($sql_query) or die(mysql_error()) ;
	$data = mysql_fetch_row($sql) ;
	
	if (mysql_num_rows($sql)==0) {

		echo '<p>Set up some personal details.</p>' ;
		echo '<input type="text" name="text-basic" id="setting-name" value="Name" onClick="this.value=\'\'">' ;
		echo '<input type="text" name="text-basic" id="setting-contact" value="Number" onClick="this.value=\'\'">' ;
		echo '<p>And then some nice-to-haves.</p>' ;
		echo '<input type="text" name="text-basic" id="setting-email" value="Email" onClick="this.value=\'\'">' ;
		echo '<input type="text" name="text-basic" id="setting-company" value="Company" onClick="this.value=\'\'">' ;
		echo '<input type="text" name="text-basic" id="setting-position" value="Position" onClick="this.value=\'\'">' ;
	
	} else {
	
		echo '<p>Set up some personal details.</p>' ;
		echo '<input type="text" name="text-basic" id="setting-name" value="'.$data['1'].'" onClick="this.value=\'\'">' ;
		echo '<input type="text" name="text-basic" id="setting-contact" value="'.$data['2'].'" onClick="this.value=\'\'">' ;
		echo '<p>And then some nice-to-haves.</p>' ;
		echo '<input type="text" name="text-basic" id="setting-email" value="'.$data['3'].'" onClick="this.value=\'\'">' ;
		echo '<input type="text" name="text-basic" id="setting-company" value="'.$data['4'].'" onClick="this.value=\'\'">' ;
		echo '<input type="text" name="text-basic" id="setting-position" value="'.$data['5'].'" onClick="this.value=\'\'">' ;
	
	}
	

} 

?>



<?php 

if ($_GET['type']=="setuser") { 

	$name = $_GET['name'] ;
	$contact = $_GET['contact'] ;
	$email = $_GET['email'] ;
	$company = $_GET['company'] ;
	$position = $_GET['position'] ;
	$phoneid = $_GET['phoneid'] ;
	
	$sql_query = "SELECT * FROM user WHERE phoneid = '".$phoneid."'" ;
	$sql = mysql_query($sql_query) or die(mysql_error()) ;
	$data = mysql_fetch_row($sql) ;
	
	if (mysql_num_rows($sql)==0) {

		$sql = mysql_query("INSERT INTO user (name,contact,email,company,position,phoneid) VALUES ('$name','$contact','$email','$company','$position','$phoneid')") or die(mysql_error()) ;
	
	} else {
	
		$sql = mysql_query("UPDATE user SET name = '$name', contact = '$contact', email = '$email', company = '$company', position = '$position' WHERE phoneid = '$phoneid'") or die(mysql_error()) ;
	
	}
	

} 

?>












<?php 

if ($_GET['type']=="delete") { 

	$id = $_GET['id'] ;
	mysql_query("DELETE FROM messages WHERE id = $id") ;
	
} 

?>

<?php 

if ($_GET['type']=="comment") { 

	$comment = $_GET['comment'] ;
	$id = $_GET['id'] ;
	mysql_query("INSERT INTO comments (comment, date, mid) VALUES ('$comment',CURDATE(),'$id')") ;
	
} 

?>

<?php 

if ($_GET['type']=="add") { 

	$message = $_GET['message'] ;
	$topic = $_GET['topic'] ;
	$name = $_GET['name'] ;
	$contact = $_GET['contact'] ;
	$email = $_GET['email'] ;
	$company = $_GET['company'] ;
	$position = $_GET['position'] ;
	$phoneid = $_GET['phoneid'] ;
	
	$from = "hello@joduplessis.com"; 
	$to = "hello@joduplessis.com"; 
	$subject = "Hardline"; 
	$html_data = $topic." > ".$phoneid; 
	$headers = "Content-Type: text/html; charset=iso-8859-1\r\n" ; 
	$headers .= "From: Avalanche Hardline <hello@joduplessis.com>\r\n";
	$mail = mail($to, $subject, $html_data, $headers);
		
	mysql_query("INSERT INTO messages (topic,message,name,contact,email,company,position,phoneid,date) VALUES ('$topic','$message','$name','$contact','$email','$company','$position','$phoneid',CURDATE())") ;
	
} 

?>