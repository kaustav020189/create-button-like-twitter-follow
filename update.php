<?php

if(isset ($_POST['value']))
{
    
// Connect to MySQL
// Change the username, password and hostname in the function mysql_connect as per your configuration
include_once 'dbcon.php';

connect();

    
    $value=$_POST['value'];
    $id=$_POST['id'];
    
    /* The following switch statement decides the image URL for the appended div 
     * You may fetch the same from database as well.
     */
    switch ($id){
        case 1: $url = 'images/messi.jpg';
                $name = 'Lionel Messi';
            break;
        case 2: $url = 'images/ozil.jpg';
            $name = 'Mesut Ozil';
            break;
        case 3: $url = 'images/neymar.jpg';
            $name = 'Neymar JR';
            break;
        case 4: $url = 'images/rooney.jpg';
            $name = 'Wayne Rooney';
            break;
    }
    
        // Create tables
      $query1="CREATE TABLE IF NOT EXISTS follow (
id int(3) PRIMARY KEY,
status varchar(20)
)";

        $results1 = mysql_query($query1)
        or die(mysql_error());
    
        
        $query2="INSERT INTO follow(id, status) VALUES ('$id', '$value')
  ON DUPLICATE KEY UPDATE status='$value'";

        $results2 = mysql_query($query2)
        or die(mysql_error());
    
        if(mysql_affected_rows()>0)
        {
            if($value == 'Follow')
            {
                echo "<ul style='color:green'>
                <li><img src='".$url."' alt='create button like twitter follow'/></li>
                <li><span>You are now following ".$name."</span></li>                
                    </ul>";
            }
            elseif($value == 'Unfollow')
            {
                echo "<ul style='color:red'>
                <li><img src='".$url."' alt='create button like twitter follow'/></li>
                <li><span>You have stopped following ".$name."</span></li>                
                    </ul>";
            }
        }
}
?>
