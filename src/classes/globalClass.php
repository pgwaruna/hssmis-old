<?php
	include_once("connect.php");
			
	class settings
	{
		var $getrmsdb="rumisdb";////////////////////////rumis database name///////////////
		var $getfacstvw="fohssmisStudentstb";////////////////////////faculty student view name///////////////
		var $getfacusrvw="fohssmistb";////////////////////////faculty user view name///////////////
//		var $getfacresltvw="fohssmisResult";////////////////////////faculty Result view name///////////////
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

			public function getSemister()
			{
					
			$query23="SELECT distinct semister FROM level";
			$data223=mysql_query($query23);
			while($predata=mysql_fetch_array($data223)){
			return $predata['semister'];

			}		
			}
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////

			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////

			public function getAcc()
			{
					
			$query23="SELECT acedemic_year FROM acc_year where current=1";
			$data223=mysql_query($query23);
			while($predata=mysql_fetch_array($data223)){
			return $predata['acedemic_year'];

			}		
			}
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////

			
			
			

			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			public function getStudentNumber($studentunm)
			{
				$rmsdb = $this->getrmsdb;
				$facstvw = $this->getfacstvw;
				$facusrvw = $this->getfacusrvw;

			$query23="SELECT PermanentNumber as stnum from $rmsdb.$facstvw where user_name ='$studentunm'";
			$data223=mysql_query($query23);
			//return $query23;
			while($predata=mysql_fetch_array($data223)){
			return $predata['stnum'];
				
			}		
			}

	
			
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////			
			
			
			
			
			
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			public function getName($student)
			{
					
				$rmsdb = $this->getrmsdb;
				$facstvw = $this->getfacstvw;
				$facusrvw = $this->getfacusrvw;

			$query23="SELECT concat(LastName,' ',Initials) as name from $rmsdb.$facstvw where user_name ='hs$student'";
			$data223=mysql_query($query23);
			//return $query23;
			if(mysql_num_rows($data223)!=0){
			while($predata=mysql_fetch_array($data223)){
			return $predata['name'];
				
			}	
			}
			else{
	
			$query23="SELECT concat(l_name,' ',initials) as name from student where id = 'hs$student'";
			$data223=mysql_query($query23);
			while($predata=mysql_fetch_array($data223)){
			return $predata['name'];

			}		
			}
			}
	
			
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			public function getLevel($student)
			{
			//$getsm=$this->getstream($student);

			//$ftchr= substr("$getsm",3,1);
			//if($ftchr!="("){
			$query23="SELECT distinct l.level from level l, student s where l.year = s.year and s.id = '$student'";
			$data223=mysql_query($query23);
			while($predata=mysql_fetch_array($data223)){
			return $predata['level'];
								}
			//		}
			/*else{

				$disspsub=explode("(",$getsm);
					$getspsub=$disspsub[1];
				$getspdept=explode("_sp",$getspsub);
					$spdept=$getspdept[0];

			$query23="SELECT distinct sl.level from sp_student_levels sl, student s where sl.reg_year = s.year and sl.department='$spdept' and s.id = '$student'";
			$data223=mysql_query($query23);
			while($predata=mysql_fetch_array($data223)){
			return $predata['level'];;
								}
				}	*/	
			}
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////

			public function getBatch($student)
			{
					
			$query23="SELECT batch from student where id = 'hs$student'";
			$data223=mysql_query($query23);
			while($predata=mysql_fetch_array($data223)){
			return $predata['batch'];

			}		
			}

			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
            
            public function getstream($student)
            {
              $quegetstrm="select stream from student where id='$student'" ;
              $qugetstrm=mysql_query($quegetstrm);
              $qgetstrm=mysql_fetch_array($qugetstrm);
                $ststrem=$qgetstrm['stream'];
                
                return $ststrem;
                
                
            }
                        
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
			 
			 
			 
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
            
            public function getmedium($student)
            {
              $quegetstrm="select medium from student where id='$student'" ;
              $qugetstrm=mysql_query($quegetstrm);
              $qgetstrm=mysql_fetch_array($qugetstrm);
                $stmedium2=$qgetstrm['medium'];
                
				if($stmedium2=="SI"){
					$stmedium="Sinhala";
				}
				elseif($stmedium2=="EN"){
					$stmedium="English";
				}
				elseif($stmedium2=="TA"){
					$stmedium="Tamil";
				}
				else{
					$stmedium=$stmedium2;
				}
				
				
                return $stmedium;
                
                
            }
                        
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
			 
			 
			 
			 
			 
            public function getcombination($student)
            {
              $quegetcmb="select combination from student where id='$student'" ;
              $qugetcmb=mysql_query($quegetcmb);
              $qgetcmb=mysql_fetch_array($qugetcmb);
                $combination=$qgetcmb['combination'];
                
                return $combination;
                
                
            }
                        
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////





			
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
			 

            public function getmenorsname($mentorID)
            {
              $quegetmntinf="select concat(title,' ',initials,' ',l_name) as mntnm from mentor where mentor_id='$mentorID'" ;
              $qugetmntinf=mysql_query($quegetmntinf);
              $qgetmntinf=mysql_fetch_array($qugetmntinf);
                $mentorname=$qgetmntinf['mntnm'];
                
                return $mentorname;
                
                
            }
                        
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////			


            
			
			
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
			 
            public function getmainsubject($subid)
            {
              $quegetcmb="select sub_name from main_subjects where sub_id='$subid'" ;
              $qugetcmb=mysql_query($quegetcmb);
              $qgetcmb=mysql_fetch_array($qugetcmb);
                $sub_name=$qgetcmb['sub_name'];
                
                return $sub_name;
                
                
            }
                        
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////			

			
			
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
			 
            public function getdeptname($dept)
            {
              $quegetdept="select dept_name from department where (dept_code='$dept' or dept_id='$dept')" ;
              $qugetdept=mysql_query($quegetdept);
              $qgetdept=mysql_fetch_array($qugetdept);
                $dept_name=$qgetdept['dept_name'];
                
                return $dept_name;
                
                
            }
                        
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////


            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
			 
            public function getcrntcryculmvle()
            {
              $quegetcrntcryculmvle="select cr_value from curriculum where status=1 order by cr_id" ;
              $qugetcrntcryculmvle=mysql_query($quegetcrntcryculmvle);
              $qgetcrntcryculmvle=mysql_fetch_array($qugetcrntcryculmvle);
                $getcrntcryculmvle=$qgetcrntcryculmvle['cr_value'];
                
                return $getcrntcryculmvle;
                
                
            }
                        
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////			
			
			
			
			
			
			public function getPer($role,$per)
			{
			$ststus_out=0;		
			$query23="SELECT id FROM permission where id='$per' and role_id='$role'";
			$data223=mysql_query($query23);
			while($predata22=mysql_fetch_array($data223)){
			
			if(isset($predata22['id']))
			$ststus_out=1;
			}
			
			return $ststus_out;
			
			}	
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////

			public function regsemesters($student)
			{
			
			$regsem=array();
			$acyear=array();
			$preacyer=array();
				$stlvl=$this->getLevel($student);
				$crsem=$this->getSemister();
				
				if($stlvl!=0){
				$quegtallreg="select acedemic_year from acc_year where (current=1 or current=0) order by acedemic_year DESC limit $stlvl";
				$qugtallreg=mysql_query($quegtallreg);
				$i=0;
				while($qgtallreg=mysql_fetch_array($qugtallreg)){
					$gtallreg=$qgtallreg['acedemic_year'];
					$acyear[$i]="$gtallreg";
					$i++;
								}

				$preacyer=array_reverse($acyear);

					for($j=0;$j<$stlvl;$j++){
						////////////////// semester 1 registation stat/////////////////////
						$fistac=$preacyer[$j];
						
						$quechkreg="select course from registration where student='$student' and acedemic_year='$fistac' and semister=1";
						$quchkreg=mysql_query($quechkreg);
							$k=2*$j;
							$s1=$k+1;
							if(mysql_num_rows($quchkreg)!=0){
							
								//$regsem[$k]=$fistac.$s1."semester 1 yes";
									$regsem[$k]="yes";

											}
							else{
								//$regsem[$k]=$fistac.$s1."semester 1 no";
									$regsem[$k]="no";
								}

				

						//////////////// semester 2 reg stat

						$quechkreg2="select course from registration where student='$student' and acedemic_year='$fistac' and semister=2";
						$quchkreg2=mysql_query($quechkreg2);
							$m=2*$j+1;
							$s2=$m+1;
							if(mysql_num_rows($quchkreg2)!=0){
								//$regsem[$m]=$fistac.$s2."semester 2 yes";
									$regsem[$m]="yes";

											}
							else{
								//$regsem[$m]=$fistac.$s2."semester 2 no";
									$regsem[$m]="no";
								}

					
									}

							}
				else{
					$regsem[0]="under developping";

					}
				
					
			
			return $regsem;

					
			}

			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			

			public function checkrepeat($student,$course)
			{
				$rmsdb = $this->getrmsdb;
				$facrsltvw = $this->getfacresltvw;	
				
				
				
			$quegtreslt="select grade from $rmsdb.$facrsltvw  where userName='$student' and subject_code='$course' order by Date";

			$qugtreslt=mysql_query($quegtreslt);
			if(mysql_num_rows($qugtreslt)!=0){
			while($qgtreslt=mysql_fetch_array($qugtreslt)){
				$gtreslt=$qgtreslt['grade'];
								}
								}
			else{
				$gtreslt="ND";
				}

				switch ($gtreslt){
						case "A+":
							$gpavl="4";
							break;
						case "A":
							$gpavl="4";
							break;
						case "A-":
							$gpavl="3.7";
							break;
						case "B+":
							$gpavl="3.3";
							break;
						case "B":
							$gpavl= "3";
							break;
						case "B-":
							$gpavl= "2.7";
							break;
						case "C+":
							$gpavl= "2.3";
							break;
						case "C":
							$gpavl= "2";
							break;
						case "C-":
							$gpavl= "1.7";
							break;
						case "D+":
							$gpavl= "1.3";
							break;
						case "D":
							$gpavl= "1";
							break;
						case "E":
							$gpavl="0";
							break;
						case "E*":
							$gpavl="0";
							break;
						case "MC":
							$gpavl="0";
							break;
						case "Pass":
							//echo "2";
							$gpavl="2";
							break;
						case "pass":
							//echo "2";
							$gpavl="2";
							break;	
						default:
							$gpavl= "0";
						}//endswitch;
				
							if($gpavl<2){
					
								return "yes";

									}
							else{
								return "no";
								}



			}


			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			public function chkspecial($student)
			{
					
			$quegetspsub="SELECT conf_subject FROM  special_registration where stno='$student'";
			$qugetspsub=mysql_query($quegetspsub);
			if(mysql_num_rows($qugetspsub)==0){
			    $queckspst="select stream from student where id='$student'";
                $quckspst=mysql_query($queckspst);
                if(mysql_num_rows($quckspst)==0){               
                				$sub="no_subject";
				}
                else{
                    while($qckspst=mysql_fetch_array($quckspst)){
                        $ckspst=trim($qckspst['stream']);
                        $lstch=substr("$ckspst", -1);
                       
                        if($lstch==")"){
                            
                            
                            $getspstm=explode("(",$ckspst);
                                 $getspstmlast=$getspstm[1];
                            
                            $getsubstm=explode("_",$getspstmlast);
                                $getsubstmfst=$getsubstm[0];
                                
                            $sub=$getsubstmfst;
                        }
                        else{
                           $sub="no_subject"; 
                        }
                        
                        
                        
                        
                    }
                    
                    
                }
            }
			else{
			while($qgetspsub=mysql_fetch_array($qugetspsub)){
				$spsub=$qgetspsub['conf_subject'];
						
				$sub=$spsub;
			
									}
				}




					if(($sub=="no_subject")||($sub=="Not Qualified")||($sub=="In Progress")){
							return "General Student";
						}
					else{
							return $sub;
						}



			}
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////

			
			
			
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////			
			
			
			
			
			
			public function getcostype($course_select,$regstlstnunm)
			{
					$course_fifix2=substr("$course_select",0,3);
						$course_fifix=strtoupper($course_fifix2);
					if($course_fifix=="FDN"){
						return "Foundation Course-(1)";
					}
					elseif($course_fifix=="SUP"){
						return "Supplementary Course-(5)";
					}
					else{
						$quegetCUpropts="select c.core,c.target_group,c.level,s.combination,s.stream 	 from courseunit c , student s where c.code='$course_select' and s.id='$regstlstnunm' and (s.stream=c.stream or c.stream='General') and s.curriculum=c.by_low_version";
						//return$quegetCUpropts;
						$qugetCUpropts=mysql_query($quegetCUpropts);
						if(mysql_num_rows($qugetCUpropts)==0){
							return "ND";
						}
						else{
							$tgtgpary=array();
							while($qgetCUpropts=mysql_fetch_array($qugetCUpropts)){
								$getCUproptsCO=$qgetCUpropts['core'];
								$getCUproptsTGP=$qgetCUpropts['target_group'];
									$divtgp=explode(",",$getCUproptsTGP);
									$flpvl=substr_count($getCUproptsTGP, ','); 
									
									for($tg4=0;$tg4<=$flpvl;$tg4++){
										$tgtgpary[$tg4]=$divtgp[$tg4];
									}
								$getCUproptsCMB=$qgetCUpropts['combination'];
								$getCUproptsSTRM=$qgetCUpropts['stream'];
								$getCUproptsLVL=$qgetCUpropts['level'];	
							}
							if($getCUproptsTGP=="All"){
								////////////////////////////////
								if($getCUproptsCO=="co"){
									return "Core Course-(2)";
	
								}
								elseif($getCUproptsCO=="op"){
									return "Core Optional Course-(3)";
								}
								else{
									return "*";
								}
								////////////////////////////////				
							}
							
							else{
								
								if($getCUproptsSTRM=="Special"){
									////////////////////////////////
									if($getCUproptsCO=="co"){
										//return "Core Course-(2)";
										if(in_array($getCUproptsCMB,$tgtgpary)){
											return "Core Course-(2)";
										}
										else{
											//////////////////////
											if($getCUproptsLVL==1){
												return "Core Course-(2)";
											}
											else{
												return "Extra optional Course-(4)";
											}
											/////////////////////
											
										}	
									}
									else{
										if(in_array($getCUproptsCMB,$tgtgpary)){
											return "Core Optional Course-(3)";
										}
										else{
											return "Extra optional Course-(4)";
										}									
									}
									////////////////////////////////	
								}
								else{
									//echo$getCUproptsCMB.$tgtgpary[0];
								////////////////////////////////
								
								$divtgpGENST=explode("+",$getCUproptsCMB);
									$relsub="no";
									for($gnsttg=0;$gnsttg<=2;$gnsttg++){
										if(in_array($divtgpGENST[$gnsttg],$tgtgpary)){
											$relsub="yes";
											break;
										}
										else{
											$relsub="no";
										}
									}
								
								
								
								
								
								if($getCUproptsCO=="co"){
									
									if($relsub=="yes"){
										return "Core Course-(2)";
									}
									else{
										return "Extra optional Course-(4)";
									}
									
									
								}
								else{

									if($relsub=="yes"){
										return "Core Optional Course-(3)";
									}
									else{
										return "Extra optional Course-(4)";
									}
									
									
								}
								////////////////////////////////					
								}	
								
							}
						
						}
						

					}			
			}	
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////			
			
			
			
			
			
			
			
			
			
			
			



			
}
?>
