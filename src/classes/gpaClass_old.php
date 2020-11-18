<?php
	include_once("connect.php");
			
	class calculate
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
			
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            public function mainsubject($student)
            {
                 $get_subject="select distinct c.subject from student s,combination c where s.id='$student' and s.combination=c.id";
                 $result_subject=mysql_query("$get_subject");
                 $subjectA=array();
                        $s=0;
                        while($row=mysql_fetch_array($result_subject)){
                            $subjectA[$s]=$row['subject'];
                             $s++;
                                                }
                    
                    return $subjectA;
            }

            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            
			public function calcurrentgpa($student)
			{
				$gpavar=array();
					
			////get all courses from result//////////////////////////

			//$get_code="select distinct(cr.course),cu.credits from courseunit cu, registration cr, results re where cr.student='$student' and cr.course=cu.code and cr.degree='1' and cr.confirm=1 and cr.course=re.subject order by cu.level,cu.semister,cu.code";
			$get_code="select distinct(cr.course),cu.credits from courseunit cu, registration cr where cr.student='$student' and cr.course=cu.code and cr.degree='1' and cr.confirm=1 order by cu.level,cu.semister,cu.code";


			$result_code=mysql_query("$get_code");
			$sumcredit=0;
			$totcrdtvalue=0;
			while($row=mysql_fetch_array($result_code)){
				$code=$row['course'];
				$credit=$row['credits'];

			//////////////////////////////////////////////////////


			////get grades for above course/////////////////////////

	
								
					$get_grade="select grade from results where index_number='$student' and subject='$code' order by year";
					$result_grade=mysql_query("$get_grade");
					
					if(mysql_num_rows($result_grade)!=0){
					$maxvalue=0;
					while($row=mysql_fetch_array($result_grade)){
						$grade=$row['grade'];

			//set value for above grade////
			
						switch($grade){
							case "A+":
								$value=4;
								break;
							case "A":
								$value=4;
								break;
							case "A-":
								$value=3.7;
								break;
							case "B+":
								$value=3.3;
								break;
							case "B":
								$value=3;
								break;
							case "B-":
								$value=2.7;
								break;
							case "C+":
								$value=2.3;
								break;
							case "C":
								$value=2;
								break;
							case "C-":
								$value=1.7;
								break;
							case "D+":
								$value=1.3;
								break;
							case "D":
								$value=1;
								break;
							default:
								$value= "0";
									} 

							/////////////////////////////

						//check max grade////////////

						if($maxvalue<=$value){
						$maxvalue=$value;
								}

						///////////////////////////////
											}

					//////////////////////////////////////////////////

					/////cal gpa value///////////////////////////////

						$crdtvalue=$credit*$maxvalue;
						$totcrdtvalue=$totcrdtvalue+$crdtvalue;	
				
						$sumcredit=$sumcredit+$credit;	
									
											}//////////result num of rows not null if close
										}
		
						$crtgpa=$totcrdtvalue/$sumcredit;

					/////////////////////////////////////////////
						$gpavar[0]=$crtgpa;

						$gpavar[1]=$sumcredit;

						$gpavar[2]=$totcrdtvalue;

						return $gpavar;
						
			}		
			
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////

			
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////

			public function crrtotcredit($student)
			{
			$get_regcredit="select sum(cu.credits) as totcdt from registration cr, courseunit cu where cr.student='$student' and cr.degree='1' and cr.confirm='1' and cr.course=cu.code";
			$result_regcredit=mysql_query("$get_regcredit");
			while($row=mysql_fetch_array($result_regcredit)){
				$sumcredit=$row['totcdt'];
				return $sumcredit;
								}
				
			}
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////

			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			public function chkallresult($student)
			{
				////get all courses from result//////////////////////////
			$resltncdt=array();
			$totcredit=0;
			$reslt=0;
			$get_code="select distinct(cr.course), cu.credits from courseunit cu, registration cr where cr.student='$student' and  cr.course=cu.code and cr.degree='1' and cr.confirm=1 order by cr.course";
			$result_code=mysql_query("$get_code");
			if(mysql_num_rows($result_code)!=0){
			while($row=mysql_fetch_array($result_code)){
				$code=$row['course'];
				$credit=$row['credits'];

			//////////////////////////////////////////////////////


			////get grades for above course/////////////////////////
			
					$get_grade="select grade from results where index_number='$student' and subject='$code' order by year";
					$result_grade=mysql_query("$get_grade");
					
					if(mysql_num_rows($result_grade)==0){
						$reslt=$reslt+1;
										}
				$totcredit=$totcredit+$credit;
									}
									

								}
			else{
				$reslt=$reslt+1;
				}
			
				$resltncdt[0]=$reslt;
				$resltncdt[1]=$totcredit;
					
					return $resltncdt;
		
			}
            
           ////////////////////////////////////////////////////////////////////////
           ////////////////////////////////////////////////////////////////////////
           ////////////////////////////////////////////////////////////////////////
            
            
           ////////////////////////////////////////////////////////////////////////
           ////////////////////////////////////////////////////////////////////////
           ////////////////////////////////////////////////////////////////////////
	       public function allsubcocredit($subject)
            {
               ///////get total credit from course_unit table for above subject////
                $alscredit=0;
                $selectioncode=array();
                
                    $selectioncode[0]="MAT225b";
                    $selectioncode[1]="mat313b";
                    $selectioncode[2]="amt312b";
                    $selectioncode[3]="amt313b";
                    $selectioncode[4]="imt313b";
                   
                    
                    
                            $get_credit="select distinct(cu.code),cu.credits as cdt from courseunit cu, target_group tg, combination co where tg.subject='$subject' and tg.target_id=cu.target_group and co.subject='$subject' and cu.department=co.department and cu.core='co' and (cu.type='Theory' or cu.type='Th+Pr') and cu.availability=1";
                            $result_credit=mysql_query("$get_credit");
                            while($row=mysql_fetch_array($result_credit)){
                                $course=$row['code'];
                                $scredit=$row['cdt'];
                                if(!in_array($course,$selectioncode)){
                                    $alscredit=$alscredit+$scredit;
                                                                         }
                                                                             }
                   
                return $alscredit;
            }
                        
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
			
			
			  
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			public function chkcorbetter($student,$subject)
			{
				
                ////////get all courses from result//////////////
                            
                            //$get_course="select distinct(cr.course),cu.credits from courseunit cu, registration cr, combination co where cr.student='$student' and co.subject='$subject'and co.department=cu.department and cr.course=cu.code and cu.core='co' and (cu.type='Theory' or cu.type='Th+Pr') and cr.degree='1' and cr.confirm=1 order by cu.level,cu.semister,cu.code";
                            $get_course="select distinct(cr.course),cu.credits from courseunit cu, registration cr, combination co, target_group tg where cr.student='$student' and co.subject='$subject' and co.department=cu.department and cr.course=cu.code and tg.subject='$subject' and tg.target_id=cu.target_group and cu.core='co' and (cu.type='Theory' or cu.type='Th+Pr') and cr.degree='1' and cr.confirm=1 order by cu.level,cu.semister,cu.code";
                            
                            $sumcredit=0;
                            $result_course=mysql_query("$get_course");
                            if(mysql_num_rows($result_course)!=0){
                            while($row=mysql_fetch_array($result_course)){
                                $code=$row['course'];
                                $credit=$row['credits'];
                
                //////////////////////////////////////////////////
                
                ////get grades for above course/////////////////////
                                                
                                $get_grade="select grade from results where index_number='$student' and subject='$code' order by year";
                                $result_grade=mysql_query("$get_grade");
                                $maxvalue=0;
                                if(mysql_num_rows($result_grade)!=0){
                                while($row=mysql_fetch_array($result_grade)){
                                    $grade=$row['grade'];
                
                //set value for above grade////
                            
                                    switch($grade){
                                        case "A+":
                                            $value=4;
                                            break;
                                        case "A":
                                            $value=4;
                                            break;
                                        case "A-":
                                            $value=3.7;
                                            break;
                                        case "B+":
                                            $value=3.3;
                                            break;
                                        case "B":
                                            $value=3;
                                            break;
                                        case "B-":
                                            $value=2.7;
                                            break;
                                        case "C+":
                                            $value=2.3;
                                            break;
                                        case "C":
                                            $value=2;
                                            break;
                                        case "C-":
                                            $value=1.7;
                                            break;
                                        case "D+":
                                            $value=1.3;
                                            break;
                                        case "D":
                                            $value=1;
                                            break;
                                        default:
                                            $value=0;
                                            break;
                                                } 
                
                /////////////////////////////
                
                //check max grade////////////
                
                                    if($maxvalue<=$value){
                                        $maxvalue=$value;
                                                }
                
                ///////////////////////////////
                
                                                        }
                
                /////////////////////////////////////////////
                
                ////cal sum of credit for C or better course/////
                                                
                                if($maxvalue>=2){
                                    $sumcredit=$sumcredit+$credit;
                                        }
                                        }
                /////////////////////////////////////////////////
                            
                                                    }
                                                    }
                 
                            
                return $sumcredit;
                ///////////////////////////////////////////////////////////////
		
			}
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////





           
			////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
			public function allopcredit($student)
			{
                $get_regcrdt="select sum(cu.credits) from courseunit cu, registration cr where cr.student='$student' and cr.degree='1' and cr.confirm=1 and cr.course=cu.code and cu.core='op'";
                $result_regcrdt=mysql_query("$get_regcrdt");
                    while($row=mysql_fetch_array($result_regcrdt)){
                          $opsumcrd=$row['sum(cu.credits)'];
                                }
				
                return $opsumcrd;
			}
						
			////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
			
			
			
			
			
			
			////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            public function allopcorbetter($student)
			{
			 
			 ////get all op courses from result//////////////////////////
                    
                    //$get_code="select distinct r.code,cu.credit from result r,course_unit cu,course_registration cr where r.student_ID='$student_ID' and r.code=cu.code and cu.core='op' and r.code=cr.code and cr.degree_status='degree' order by year";
                    $get_code="select distinct(cr.course),cu.credits from courseunit cu, registration cr, combination co where cr.student='$student' and cr.course=cu.code and cu.core='op' and cr.degree='1' and cr.confirm=1 order by cu.level,cu.semister,cu.code";
                    
                            $sumcredit=0;
                            $result_course=mysql_query("$get_code");
                            if(mysql_num_rows($result_course)!=0){
                                
                            while($row=mysql_fetch_array($result_course)){
                                $code=$row['course'];
                                $credit=$row['credits'];
                 
                //////////////////////////////////////////////////
                
                ////get grades for above course/////////////////////
                                                
                                $get_grade="select grade from results where index_number='$student' and subject='$code' order by year";
                                $result_grade=mysql_query("$get_grade");
                                
                                if(mysql_num_rows($result_grade)!=0){
                                    $maxvalue=0;
                                while($row=mysql_fetch_array($result_grade)){
                                    $grade=$row['grade'];
               
                //set value for above grade////
                            
                                    switch($grade){
                                        case "A+":
                                            $value=4;
                                            break;
                                        case "A":
                                            $value=4;
                                            break;
                                        case "A-":
                                            $value=3.7;
                                            break;
                                        case "B+":
                                            $value=3.3;
                                            break;
                                        case "B":
                                            $value=3;
                                            break;
                                        case "B-":
                                            $value=2.7;
                                            break;
                                        case "C+":
                                            $value=2.3;
                                            break;
                                        case "C":
                                            $value=2;
                                            break;
                                        case "C-":
                                            $value=1.7;
                                            break;
                                        case "D+":
                                            $value=1.3;
                                            break;
                                        case "D":
                                            $value=1;
                                            break;
                                        default:
                                            $value=0;
                                            break;
                                                } 
                
                /////////////////////////////
                
                //check max grade////////////
                
                                    if($maxvalue<=$value){
                                        $maxvalue=$value;
                                                }
                
                ///////////////////////////////
                
                                                        }
                
                /////////////////////////////////////////////
                                    if($maxvalue>=1.3){
                                    $sumcredit=$sumcredit+$credit;
                                        }
                                }
                ////cal sum of credit for C or better course/////
                                                
                                
                                        
                /////////////////////////////////////////////////
                            
                                                    }
                                                    }
                
			return $sumcredit;
			
			}	
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////

			public function allpracticalunit($student)
			{
			    $subjectA=array();
                $subjectA=$this->mainsubject($student);
                $alprcrdt=0;
			         for($i=0;$i<count($subjectA);$i++){
                         $subject=$subjectA[$i];
                         $quegetalprctcode="select distinct(cu.code),cu.credits from courseunit cu, target_group tg, combination co where tg.subject='$subject' and tg.target_id=cu.target_group and co.subject='$subject' and cu.department=co.department and cu.core='co' and cu.type='Practical' and cu.availability=1";
                         $qugetalprctcode=mysql_query($quegetalprctcode);
                         if(mysql_num_rows($qugetalprctcode)!=0){
                             while($qgetalprctcode=mysql_fetch_array($qugetalprctcode)){
                                 $prcrdt=$qgetalprctcode['credits'];
                                 $alprcrdt=$alprcrdt+$prcrdt;
                             }
                         }
                         else {
                                 $alprcrdt=$alprcrdt;
                         }
                             
                             
                         }
                         
                        return  $alprcrdt;
                                                        
					
			}

			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////
			public function chkprcminorbetter($student,$subject)
            {
                
                ////////get all courses from result//////////////
                            
                            $get_course="select distinct(cr.course),cu.credits from courseunit cu, registration cr, combination co where cr.student='$student' and co.subject='$subject'and co.department=cu.department and cr.course=cu.code and cu.core='co' and cu.type='Practical' and cr.degree='1' and cr.confirm=1 order by cu.level,cu.semister,cu.code";
                            $sumcredit=0;
                            $result_course=mysql_query("$get_course");
                            if(mysql_num_rows($result_course)!=0){
                            while($row=mysql_fetch_array($result_course)){
                                $code=$row['course'];
                                $credit=$row['credits'];
                
                //////////////////////////////////////////////////
                
                ////get grades for above course/////////////////////
                                                
                                $get_grade="select grade from results where index_number='$student' and subject='$code' order by year";
                                $result_grade=mysql_query("$get_grade");
                                $maxvalue=0;
                                if(mysql_num_rows($result_grade)!=0){
                                while($row=mysql_fetch_array($result_grade)){
                                    $grade=$row['grade'];
                
                //set value for above grade////
                            
                                    switch($grade){
                                        case "A+":
                                            $value=4;
                                            break;
                                        case "A":
                                            $value=4;
                                            break;
                                        case "A-":
                                            $value=3.7;
                                            break;
                                        case "B+":
                                            $value=3.3;
                                            break;
                                        case "B":
                                            $value=3;
                                            break;
                                        case "B-":
                                            $value=2.7;
                                            break;
                                        case "C+":
                                            $value=2.3;
                                            break;
                                        case "C":
                                            $value=2;
                                            break;
                                        case "C-":
                                            $value=1.7;
                                            break;
                                        case "D+":
                                            $value=1.3;
                                            break;
                                        case "D":
                                            $value=1;
                                            break;
                                        default:
                                            $value=0;
                                            break;
                                                } 
                
                /////////////////////////////
                
                //check max grade////////////
                
                                    if($maxvalue<=$value){
                                        $maxvalue=$value;
                                                }
                
                ///////////////////////////////
                
                                                        }
                
                /////////////////////////////////////////////
                
                ////cal sum of credit for C- or better course/////
                                                
                                if($maxvalue>=1.7){
                                    $sumcredit=$sumcredit+$credit;
                                        }
                                        }
                /////////////////////////////////////////////////
                            
                                                    }
                                                    }
                 
                            
                return $sumcredit;
                ///////////////////////////////////////////////////////////////
        
            }
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            
			public function checkENGresult($student)
			{
			$get_grade="select subject,grade from results where index_number='$student' and (subject='ENG1201' || subject='ENG2201') order by year";
            //echo$get_grade;
            $result_grade=mysql_query("$get_grade");
            $codeA=array();
            $c=0;
            if(mysql_num_rows($result_grade)!=0){
            
            while($row=mysql_fetch_array($result_grade)){
                $code=$row['subject'];
                $grade=$row['grade'];
                
                if($grade=='Pass'){
                    $codeA[$c]=$code;
                    $c=$c+1;
                            }
                                }
            }
            return $codeA;

			}
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            
            
            
            
            
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            
            public function chkAorBcredit($student)
            {
            $AorBcdt=array();
            ////to first class//////////

            $getsum_amore="select sum(cu.credits) from results r, courseunit cu where r.index_number='$student' and (r.grade='A' || r.grade='A+') and r.subject=cu.code";
            $resultsum_amore=mysql_query("$getsum_amore");
            while($row=mysql_fetch_array($resultsum_amore)){
                $a_more=$row['sum(cu.credits)'];
                $AorBcdt[0]=$a_more;
                                    }

            ///////////////////////////

            ///to second class/////////

            $getsum_bmore="select sum(cu.credits) from results r,courseunit cu where r.index_number='$student' and (r.grade='A+' || r.grade='A' || r.grade='A-' || r.grade='B+' || r.grade='B') and r.subject=cu.code";
            $resultsum_bmore=mysql_query("$getsum_bmore");
            while($row=mysql_fetch_array($resultsum_bmore)){
                $b_more=$row['sum(cu.credits)'];
                $AorBcdt[1]=$b_more;
                                    }

            ///////////////////////////
            
            return $AorBcdt;

            }
            
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////

}    
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
?>
