<?php

    $query23="SELECT acedemic_year FROM acc_year where current=1";
    $data223=mysql_query($query23);
    while($predata=mysql_fetch_array($data223)){
        $ac=$predata['acedemic_year'];
        $query75_2="select * from event where academic_year='$ac' order by s_date";
        $event_details=mysql_query($query75_2);
        if($event_details) {
            echo"<b>Events in $ac academic year</b><br><br>";
            echo '<table border="0"align="center"><tr><th>Event<th>Starting Date<th>Duration<th>Status<th>Notice</tr>';
            while($data=mysql_fetch_array($event_details)){
                echo "<tr class=trbgc><td align=left>".$data['description']."<td align=center>".$data['s_date'];
                if($data['duration']==1){
                    echo "<td align=center>".$data['duration']." day";
                }
                else{
                    echo "<td align=center>".$data['duration']." days";  
                }
                if($data['confirmation']==1){
                    echo "<td align=left><b>Confirmed</b>";
                }else{
                    echo "<td align=left>Not Confirmed";
                }
                if($data['news_id']!= null){
                    $n_id=$data['news_id'];
                    $query75_1="select * from notice where Notice_ID='".$n_id."'";
                    $query75=mysql_query($query75_1);
                    
                    if(mysql_num_rows($query75)!=0){
	
                        while($notice_details=mysql_fetch_array($query75)){
                            $title2=$notice_details['Title'];
                            $File_Name2=$notice_details['File_Name'];
                            echo"<td align=left><a href='./downloads/Notices/$File_Name2' target='_blank'>Download</a>";
				        }
				    }
                }else{
                echo"<td align=left>Not found";
                }
                echo "</tr>";
            }
            echo "</table><br />";
        }
        else{
            echo "No Events for '$ac' academic year";
        }
    }


?>
