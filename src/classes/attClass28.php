<?php
	include_once("connect.php");

	class attendence
	{

			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////

			public function __construct()
			{
				Connect::getConnect();

			}


			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////



		    public function getUser()
			{
			$user_name=$_SESSION['user_id'];
			return $user_name;
			}

			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////




		    public function getSubject($lect_id)
			{
			$query23="SELECT course FROM lecture where lecture_id='$lect_id'";
			$data223=mysql_query($query23);
			while($predata=mysql_fetch_array($data223)){
			return $predata['course'];
			}
			}


			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////



		    public function getAtt($lect_id, $student)
			{
			$ststus_out=0;
			$query23="SELECT `status` FROM participation where lect_id='$lect_id' and student='$student'";
			$data223=mysql_query($query23);
			while($predata22=mysql_fetch_array($data223)){

			$ststus_out=$predata22['status'];

			}

			return $ststus_out;

			}


			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////


		 	public function countStd($subject, $acy)
			{
			  $fmviweque="rumisdb.fohssmisStudents fs";
			$query232="select count(r.student) as count from registration r, $fmviweque where r.course = '$subject' and r.acedemic_year='$acy'  and r.confirm='1' and concat('sc',r.student)=fs.user_name ";

			$data2232=mysql_query($query232);
			while($predata=mysql_fetch_array($data2232)){
			return $predata['count'];
			}
			}


			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////


			public function countPre($lect_id)
			{
			   $fmviweque="rumisdb.fohssmisStudents fs";
			$query2322="select count(p.status) as count from participation p, $fmviweque where p.lect_id = '$lect_id' and concat('sc',p.student)=fs.user_name";
			$data22322=mysql_query($query2322);
			while($predata=mysql_fetch_array($data22322)){
			return $predata['count'];
			}
			}


			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////



			public function getLectDate($lect_id)
			{
			$query231="SELECT date as d FROM lecture where lecture_id = '$lect_id'";
			$data2231=mysql_query($query231);
			while($predata2=mysql_fetch_array($data2231)){
			return $predata2['d'];
			}
			}


			public function getLectHours($lect_id)
			{
			$query231="SELECT hours FROM lecture where lecture_id = '$lect_id'";
			$data2231=mysql_query($query231);
			while($predata2=mysql_fetch_array($data2231)){
			return $predata2['hours'];
			}
			}


			public function getLectTime($lect_id)
			{
			$query231="SELECT time FROM lecture where lecture_id = '$lect_id'";
			$data2231=mysql_query($query231);
			while($predata2=mysql_fetch_array($data2231)){
			return $predata2['time'];
			}
			}



			public function getLectType($lect_id)
			{
			$query2310="SELECT type FROM lecture where lecture_id = '$lect_id'";
			$data22310=mysql_query($query2310);
			while($predata20=mysql_fetch_array($data22310)){
			return $predata20['type'];
			}
			}





			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////

			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////


			public function getTotal($course, $std, $type, $acy)
			{
			$quegetcodept="select department,level from  courseunit where code='$course'";
			$qugetcodept=mysql_query($quegetcodept);
			while($qgetcodept=mysql_fetch_array($qugetcodept)){
					$getcodept=$qgetcodept['department'];
					$getcolv=$qgetcodept['level'];
											}
//edited....................................pppppppp.......................................................
			if($getcodept=="english"){
			$query2322="select sum(l.hours) as count from participation p, lecture l where p.lect_id = l.lecture_id and
 p.student = '$std' and l.type = '$type' and l.acc_year='$acy' and l.course in (select code as course from courseunit where department='$getcodept' and level='$getcolv')";
							}
			else{
			$query2322="select sum(l.hours) as count from participation p, lecture l where p.lect_id = l.lecture_id and l.course= '$course' and p.student = '$std' and l.type = '$type' and l.acc_year='$acy'";
					}


			$data22322=mysql_query($query2322);
			while($predata=mysql_fetch_array($data22322)){
			$c=$predata['count'];
			if($c>0)
			return $c;
			else
			return 0;
			}
			}


			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////


			public function getMax($course, $type, $acc_year)
			{
			$query2322="select max from maxatt where acc_year = '$acc_year' and cource= '$course' and type = '$type'";
			$data22322=mysql_query($query2322);
			if(mysql_num_rows($data22322)!=0){
				while($predata=mysql_fetch_array($data22322)){
				$c=$predata['max'];
				return $c;
							}


			}
			else{
			return "nd";
				}
			}


			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////




			public function getSubTotal($course, $type, $acy,$stgp)
			{
				$exa=0;
				$total=0;
				$exptnew="nill";
				$expnmar= array();
				$quegetcodept="select department,level from  courseunit where code='$course'";
				$qugetcodept=mysql_query($quegetcodept);
					while($qgetcodept=mysql_fetch_array($qugetcodept)){
						$getcodept=$qgetcodept['department'];
						$getcolv=$qgetcodept['level'];
											}
					if($getcodept=="english"){
                       // ppp $total=52;
                       // return $total;
                       $quegetatgp="select sum(hours) from lecture where type = 'practical' and att_group like '%$stgp' and acc_year='$acy' and course in (select code as course from courseunit where department='$getcodept' and level='$getcolv')";
                        $qugetatgp=mysql_query($quegetatgp);
                        if(mysql_num_rows($qugetatgp)!=0){
                            $row = mysql_fetch_row($qugetatgp);
                            $total=$row[0];
                        }
                        else{
                            $total=27;
                        }
                        return $total;
					/*$quegetatgp="select hours,att_group,course from lecture where type = '$type' and acc_year='$acy' and course in (select code as course from courseunit where department='$getcodept' and level='$getcolv' order by code)";*/
									}
					else{
					$quegetatgp="select hours,att_group,course from lecture where course= '$course' and type = '$type' and acc_year='$acy'";
						//}

					$qugetatgp=mysql_query($quegetatgp);

							if(mysql_num_rows($qugetatgp)!=0){
								while($qgetatgp=mysql_fetch_array($qugetatgp)){

										$hos=$qgetatgp['hours'];
										$atgp=$qgetatgp['att_group'];
										$cosnw2=trim($qgetatgp['course']);
										$cosnw=strtoupper($cosnw2);

											if($atgp=="nogrp"){
												$total=$total+$hos;
																}
											else{
													$expgetexptno=explode('-',$atgp);
													$getexptno=$expgetexptno[0]."-".$cosnw;
													$getexptgp=$expgetexptno[1];

													if($getexptgp==$stgp)
													{
													//	if($getexptno!=$exptnew){
														  if(!in_array($getexptno,$expnmar)){
															    $expnmar[$exa]=$getexptno;
															    $exa++;
															    $total=$total + $hos;
																		    }

																				//	}
															$exptnew=$getexptno;
													}


													}
																				}


									return $total;}



								else{
									return 0;
									}
                    }
			}

			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////




			public function getTotalAll($course, $std, $acy)
			{
			$quegetcodept="select department,level from  courseunit where code='$course'";
			$qugetcodept=mysql_query($quegetcodept);
				while($qgetcodept=mysql_fetch_array($qugetcodept)){
					$getcodept=$qgetcodept['department'];
					$getcolv=$qgetcodept['level'];
											}


			/*if($getcodept=="english"){
			$query2322="select sum(l.hours) as count from participation p, lecture l where p.lect_id = l.lecture_id and p.student = '$std' and l.acc_year='$acy' and  l.course in (select code as course from courseunit where department='$getcodept' and level='$getcolv' order by code)";
						}
			else{*/
			$query2322="select sum(l.hours) as count from participation p, lecture l where p.lect_id = l.lecture_id and l.course= '$course' and p.student = '$std' and l.acc_year='$acy'";
				//}

			$data22322=mysql_query($query2322);
			while($predata=mysql_fetch_array($data22322)){
			$c=$predata['count'];
			if($c>0)
			return $c;
			else
			return 0;
			}
			}


			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////


			public function getSubTotalAll($course, $acy,$stgp)
			{
			$exa=0;
			$total=0;
			$exptnew="nill";
			$expnmar= array();
			$quegetcodept="select department,level from  courseunit where code='$course'";
			$qugetcodept=mysql_query($quegetcodept);
				while($qgetcodept=mysql_fetch_array($qugetcodept)){
					$getcodept=$qgetcodept['department'];
					$getcolv=$qgetcodept['level'];
											}


			if($getcodept=="english"){
               $quegetatgp="select sum(hours) from lecture where type = 'practical' and att_group like '%$stgp' and acc_year='$acy' and course in (select code as course from courseunit where department='$getcodept' and level='$getcolv')";
                        $qugetatgp=mysql_query($quegetatgp);
                        if(mysql_num_rows($qugetatgp)!=0){
                            $row = mysql_fetch_row($qugetatgp);
                            $total=$row[0];
                        }
                        else{
                            $total=27;
                        }
                        return $total;
			//$total=52;
			//return $total;
				
					/*$quegetatgp="select hours,att_group,course from lecture where acc_year='$acy' and course  in (select code as course from courseunit where department='$getcodept' and level='$getcolv' order by code) "; */
				}
			else{
					$quegetatgp="select hours,att_group,course from lecture where course= '$course' and acc_year='$acy'";
				//}
					$qugetatgp=mysql_query($quegetatgp);

							if(mysql_num_rows($qugetatgp)!=0){
								while($qgetatgp=mysql_fetch_array($qugetatgp)){
										$hos=$qgetatgp['hours'];
										$atgp=$qgetatgp['att_group'];
										$cosnw2=trim($qgetatgp['course']);
										$cosnw=strtoupper($cosnw2);
											if($atgp=="nogrp"){
												$total=$total+$hos;
																}
											else{
													$expgetexptno=explode('-',$atgp);
													$getexptno=$expgetexptno[0]."-".$cosnw;
													$getexptgp=$expgetexptno[1];

													//if($getexptgp==$stgp)
													//{
														if($getexptno!=$exptnew){
														if(!in_array($getexptno,$expnmar)){
															    $expnmar[$exa]=$getexptno;
															    $exa++;
																$total=$total + $hos;
																			}
																	}

														$exptnew=$getexptno;
													//}
													}
																				}

									return $total;

																}

							else{
									return 0;
									}
                }
			}

			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////




			public function getNoStd($lid)
			{

                $fmviweque="rumisdb.fohssmisStudents fs";
			$query2325="select count(p.status) as co from participation p, $fmviweque where p.lect_id = '$lid' and concat('sc',p.student)=fs.user_name";
			$data22325=mysql_query($query2325);
			while($predata5=mysql_fetch_array($data22325)){
			$c9=$predata5['co'];
			if($c9>0)
			return $c9;
			else
			return 0;
			}
			}

			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////


			public function addPer($sub,$acc,$type,$max)
			{

			$query230="delete from maxatt where cource='$sub' and acc_year='$acc' and type='$type'";
			$data2230=mysql_query($query230);

			$query231="insert into maxatt values('$sub','$acc','$type','$max',now())";
			$data2231=mysql_query($query231);
			if($data2231){
				echo "<br />Successfully Added<br />";
			}
			}



			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////


			////////////////////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////get prct group////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////

			public function getprctgp($student,$subject,$accyear)
			{
			$quegetcodept="select department, level from courseunit where code='$subject'";
			$qugetcodept=mysql_query($quegetcodept);
				while($qgetcodept=mysql_fetch_array($qugetcodept)){
					$getcodept=$qgetcodept['department'];
					$getcolv=$qgetcodept['level'];
											}


			/*if($getcodept=="english"){
$quegtgp="select lecture_id,att_group from lecture where acc_year='$accyear' and att_group<>'nogrp' and  course in (select code as course from courseunit where department='$getcodept' and level='$getcolv' order by code) order by date,time";
							}
			else{*/
			$quegtgp="select lecture_id, att_group from lecture where course='$subject' and acc_year='$accyear' and att_group<>'nogrp' order by date,time";
				//}
				$qugtgp=mysql_query($quegtgp);
				if(mysql_num_rows($qugtgp)!=0){
				$ga=0;
				$gpar=array();
				$dupvlar=array();
					while($qgtgp=mysql_fetch_array($qugtgp)){
					$gtgplectid=$qgtgp['lecture_id'];
				//	$gtgpattgp=$qgtgp['att_group'];

						//$getstpggp=explode('-',$gtgpattgp);
						//$stpcgp=$getstpggp[1];


							$quegtsts="SELECT status FROM participation where lect_id='$gtgplectid' and student='$student'";
							$qugtsts=mysql_query($quegtsts);
							if(mysql_num_rows($qugtsts)!=0){
								$pracgp="select att_group from lecture where lecture_id='$gtgplectid' and course='$subject' and acc_year='$accyear'";
								$prac=mysql_query($pracgp);	
							//	while($qprac=mysql_fetch_array($prac)){
								$row = mysql_fetch_assoc($prac);

									$gtgpattgp=$row['att_group'];

									$getstpggp=explode('-',$gtgpattgp);
									$stpcgp=$getstpggp[1];
									$gpar[$ga]="$stpcgp";

														

															}


							$ga=$ga+1;
																}

					$dupvlar=array_count_values($gpar);
					$max=max($dupvlar);
					$maxgp=array_search("$max", $dupvlar);

				$pcgp=$maxgp;
												}
				else{
					$pcgp="ng";
					}


				return $pcgp;


			}

			/////////////////////////////////////////////////////////////////////////////////////////////
			/////////////////////////////////////////////////////////////////////////////////////////////
			/////////////////////////////////////////////////////////////////////////////////////////////







	}
?>
