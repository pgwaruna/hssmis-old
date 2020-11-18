<?php
require_once('./classes/globalClass.php');
$b=new settings();
echo "View Students Results<hr class=bar>";
						include 'forms/form_14.php';
						
						echo "<hr class=bar><br>";


		if(($task=='vwsrslt')&&(isset($_POST['submit']))){
						$stbyr=$_POST['year_14'];
						$level_14=$_POST['level_14'];
						$semister_14=$_POST['semister_14'];
						$_SESSION['std_id']=$_POST['index_14'];
						$id_14_2=$_SESSION['std_id'];

						
						$stbt=$b->getBatch($id_14_2);
				
				
					if($stbyr==$stbt){
						// view Results
						echo "Results of [ SC/$stbt/".$id_14_2." ] in Level ".$level_14." and Semester ".$semister_14."<br>";
						
						if($semister_14==1){
						$query_14_2="select r.subject, c.name, r.grade, r.year from results r, courseunit c where r.index_number='$id_14_2' and c.level='$level_14' and c.semister='$semister_14' and r.subject=c.code order by r.subject,r.year";
									}
						else{
						$query_14_2="select r.subject, c.name, r.grade, r.year from results r, courseunit c where r.index_number='$id_14_2' and c.level='$level_14' and (c.semister='$semister_14' or c.semister=3) and r.subject=c.code order by r.subject,r.year";

							}
						$res_vw=mysql_query($query_14_2);	
						if(mysql_num_rows($res_vw)!=0){
													
						echo '<table border="0" width="80%"><tr><th>Subject<th>Subject Name<th>Year<th>Grade</tr>';
						
						$dupsub="nil";
						while($data=mysql_fetch_array($res_vw)){
						$subject=$data['subject'];
						$subject2=trim($subject);
                        ////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
            $coursegetchr=trim($subject);
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
                        
                        /////////////////////////////////////////////////////////////////////////////
						$suname=$data['name'];
						$subgred=$data['grade'];
						$year=$data['year'];
						
						if($dupsub==$subject2)
							{echo "<tr class=selectbg><td colspan='2' align='center' >Repeat Attempt [ Results of $fulcode3 ]<td align='center' >$year<td align='center'>$subgred</tr>";
							}
						else{
							echo "<tr class=trbgc><td align='center' >$fulcode3<td>$suname<td align='center' >$year<td align='center'>$subgred</tr>";
						}
						$dupsub=$subject2;



						//echo "<tr><td>".$data['subject']."<td>".$data['name']."<td>".$data['grade']."</tr>";
						}
						echo "</table>";
														}
						else{
							echo"<br><font color='red'>Sorry ! Cannot find Results.</font>";
							}
						
						
						}
					else{
						echo"<br><font color='red'>( SC/$stbyr/$id_14_2 ) Invalid student number ! Recheck student number.</font>";
							}
						
						
						
						
						
						
						}

?>
