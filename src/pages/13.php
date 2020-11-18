<?php
echo "View Students Results in <hr class=bar>";
	include 'forms/form_13.php';
						
	echo "<hr class=bar><br>";


	if(($task=='allrslt')&&(isset($_POST['submit']))){
		$level_13=$_POST['level_13'];
		$sub_13=$_POST['sub_13'];
//////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
            $coursegetchr=trim($sub_13);
            $ccdwoutcrd=substr("$coursegetchr", 0, -1);
            $getchar = preg_split('//', $coursegetchr, -1);

                    $credit=$getchar[7];
                    if(($credit=="a")||($credit=="A")){
                        $credit="&#945;";
                            }
                    elseif(($credit=="b")||($credit=="B")){
                        $credit="&#946;";
                                }
                    elseif(($credit=="d")||($credit=="D")){
                        $credit="&#948;";
                                }
                    else{
                        $credit=$credit;
                        }

            $allcose2=$ccdwoutcrd.$credit;
////////////////////////////////////////////////////////////////////////////////////////
                            ////////////////////////////////////////////////////////
                                $getchar = preg_split('//', $allcose2, -1);

                                $midcredit=$getchar[5];
                                if($midcredit=="b"){
                                    $getlob=explode('b',$allcose2);
                                        $fistprt=$getlob[0];
                                        $sectprt=$getlob[1];
                                        $fulcode3=strtoupper($fistprt)."b".$sectprt;
                                                        }

                                elseif($midcredit=="B"){
                                    $getlob=explode('B',$allcose2);
                                        $fistprt=$getlob[0];
                                        $sectprt=$getlob[1];
                                        $fulcode3=strtoupper($fistprt)."b".$sectprt;
                                                        }
                                else{
                                $fulcode3=strtoupper($allcose2);
                                }
                            ////////////////////////////////////////////////////

	                  
	                  
///////////////////////////////////////////////////////////
		// view Results
		//edit by iranga
		echo "Results of ".$fulcode3." currently in Level ".$level_13." Students<br>";
		$query_13_2="select r.index_number, s.batch, r.grade, r.year as exyear from results r, student s, level l where r.index_number=s.id and l.level='$level_13' and r.subject='$sub_13' and s.year=l.year order by r.index_number,r.id";
		$res_vw3=mysql_query($query_13_2);
		if(mysql_num_rows($res_vw3)!=0){
		
		echo '<table border="0" width="60%"><tr><th>Student<th>Year<th>Grade</tr>';
				
				$stindxdup="nil";
				while($data=mysql_fetch_array($res_vw3)){
					$byear=$data['batch'];
					$indx=$data['index_number'];
					$stindxck="SC/".$byear."/".$indx;
					$stindx=trim($stindxck);
				if($stindx==$stindxdup){
				echo "<tr class=selectbg><td align='right'>".$stindx." [Repate Attempt]<td align='center'>".$data['exyear']."<td align='center'>".$data['grade']."</tr>";
							}
				else{
				echo "<tr class=trbgc><td align='center'>".$stindx."<td align='center'>".$data['exyear']."<td align='center'>".$data['grade']."</tr>";
					}
				$stindxdup=$stindx;				

									}
		echo "</table>";
										}
		else{
			echo"<br><font color='red'>Sorry ! Cannot find Results.</font>";
		
				}
		
							}

?>
