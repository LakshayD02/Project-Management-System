<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'enrolement';


if (isset($_GET['action'])) {
	if ($_GET['action']=='backup') {

			function backup_tables($host,$user,$pass,$name,$tables = '*')
			{

			    $link = mysql_connect($host,$user,$pass);
			    mysql_select_db($name,$link);
			    mysql_query("SET NAMES 'utf8'");

			    //get all of the tables
			    if($tables == '*')
			    {
			        $tables = array();
			        $result = mysql_query('SHOW TABLES');
			        while($row = mysql_fetch_row($result))
			        {
			            $tables[] = $row[0];
			        }
			    }
			    else
			    {
			        $tables = is_array($tables) ? $tables : explode(',',$tables);
			    }
			    $return='';
			    //cycle through
			    foreach($tables as $table)
			    {
			        $result = mysql_query('SELECT * FROM '.$table);
			        $num_fields = mysql_num_fields($result);

			        $return.= 'DROP TABLE '.$table.';';
			        $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
			        $return.= "\n\n".$row2[1].";\n\n";

			        for ($i = 0; $i < $num_fields; $i++) 
			        {
			            while($row = mysql_fetch_row($result))
			            {
			                $return.= 'INSERT INTO '.$table.' VALUES(';
			                for($j=0; $j<$num_fields; $j++) 
			                {
			                    $row[$j] = addslashes($row[$j]);
			                    $row[$j] = str_replace("\n","\\n",$row[$j]);
			                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
			                    if ($j<($num_fields-1)) { $return.= ','; }
			                }
			                $return.= ");\n";
			            }
			        }
			        $return.="\n\n\n";
			    }

			    //save file
			    $handle = fopen('databases/enrollment-backup_'.date('m-d-Y').'_'.time().'.sql','w+');
			    $dbnameSQL = 'enrollment-backup_'.date('m-d-Y').'_'.time().'.sql';

			    $sqlINSERT = mysql_query("INSERT INTO `db` (`db_name`, `date_added`) VALUES ('$dbnameSQL', NOW())");
			    if ($sqlINSERT) {
			    	header("Location:page.php?page=backup_restore&result=success");
			    }else{
			    	header("Location:page.php?page=backup_restore&result=failed");
			    }
			    

			    fwrite($handle,$return);
			    fclose($handle);



			}

			backup_tables($dbhost,$dbuser,$dbpass,$dbname);
		
			// RESTORE DATABASE
		}else{

			ini_set('memory_limit','8192M'); // set memory limit here
			$db = mysql_connect ( $dbhost, $dbuser, $dbpass ) or die('not connected');
			mysql_select_db( $dbname, $db) or die('Not found');

			
            $name = $_GET['name'];

			$fp = fopen ( "databases/$name", 'r' );
			$fetchData = fread ( $fp, filesize ( "databases/$name") );
			$sqlInfo = explode ( ";\n", $fetchData); // explode dump sql as a array data

			foreach ($sqlInfo AS $sqlData )
			{
			mysql_query ( $sqlData ) or die('Query not executed');
			
			    	header("Location:page.php?page=backup_restore&result=restore_success");
			  

			}

			echo 'Done';
		}
	}





?>