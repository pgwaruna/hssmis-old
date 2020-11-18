<?php
/*echo"&nbsp;&nbsp;Get Time Table - ";
echo"<a href=timetable/Time-Table-2013-Level-I-semester-II.pdf> for Level 1 Student</a>  And ";
echo"<a href=timetable/Time-Table-2013-semester-II.xls> for Level 2 & 3 Student</a>";
*/


/*echo"Get Time Table - ";
echo"<a href=timetable/Time-Table(2011_2012)-Semester-1-Level-I&II-Bio-Science.pdf >Biological Science Level I & II ,</a>";
echo"<a href=timetable/Time-Table(2011_2012)-Semester-1-Level-III-Bio-Science.pdf >&nbsp;&nbsp;Biological Science Level III ,</a>";
echo"<a href=timetable/Time-Table(2011_2012)-Semester-1-Physical-Science.pdf target='_blank'>&nbsp;&nbsp;Physical Science </a>";

*/
include'connection/connection.php';

	$query15_2="select * from announcement order by id desc";
	$ann=mysql_query($query15_2);
	if(mysql_num_rows($ann)!=0){
	
	echo"&nbsp;&nbsp;&nbsp;:::News::: ";
	
	while($data=mysql_fetch_array($ann)){
	echo "&nbsp;&nbsp;".$data['title'].":- ".$data['description']."&nbsp;&nbsp;";
	
	}
								}

?>
