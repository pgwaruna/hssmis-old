<?php
	include_once("connect.php");
			
	class evaluation
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
			////////////////////////// get evl ids /////////////////////////////////
			////////////////////////////////////////////////////////////////////////

			public function getevlid($elvacyr,$evlcos)
			{
			$evlarr=array();
			$ean=0;
					
			$quegetevlinf="select peer_evl_id from peer_evaluation_session  where ac_year='$elvacyr' and course_unit='$evlcos'order by peer_evl_id";
			//echo$quegetevlinf;
			$qugetevlinf=mysql_query($quegetevlinf);
			if(mysql_num_rows($qugetevlinf)==0){
				$evlarr[0]=0;
								}
			else{
			while($qgetevlinf=mysql_fetch_array($qugetevlinf)){
				$evlarr[$ean]=$qgetevlinf['peer_evl_id'];
				$ean++;
			}
				}

				return $evlarr;
			}

			////////////////////////////////////////////////////////////////////////
			///////////////////////end get evl ids /////////////////////////////////
			////////////////////////////////////////////////////////////////////////



			
	
			////////////////////////////////////////////////////////////////////////
			////////////////////// get tot num of forms/////////////////////////////
			////////////////////////////////////////////////////////////////////////

			public function totevlidcunt($elvacyr,$evlcos)
			{
			$quegettotevlinf="select count(peer_evl_id) as tocont from peer_evaluation_session  where ac_year='$elvacyr' and course_unit='$evlcos'";
			$qugettotevlinf=mysql_query($quegettotevlinf);
				$qgettotevlinf=mysql_fetch_array($qugettotevlinf);

					$gettotevlinf=$qgettotevlinf['tocont'];

				return $gettotevlinf;


			}

			////////////////////////////////////////////////////////////////////////
			/////////////////// end get tot num of forms////////////////////////////
			////////////////////////////////////////////////////////////////////////






			////////////////////////////////////////////////////////////////////////
			//////////////////////////get ans ptg by ///////////////////////////////
			////////////////////////////////////////////////////////////////////////

			public function getansptg($queno,$ansno,$elvacyr,$evlcos)
			{
				$quegetanspecntg="select count(pe.peer_evl_id) as presentptg from peer_evaluation_status pe, peer_evaluation_session ps where ps.course_unit='$evlcos' and ps.ac_year='$elvacyr' and ps.peer_evl_id=pe.peer_evl_id and pe.que_no='$queno' and pe.answer='$ansno'";
				$qugetanspecntg=mysql_query($quegetanspecntg);
				$qgetanspecntg=mysql_fetch_array($qugetanspecntg);

					$getanspecntg=$qgetanspecntg['presentptg'];

				return $getanspecntg;
			}

			////////////////////////////////////////////////////////////////////////
			//////////////////////end get ans ptg by ///////////////////////////////
			////////////////////////////////////////////////////////////////////////






			////////////////////////////////////////////////////////////////////////
			////////////////////// get tot st num of forms//////////////////////////
			////////////////////////////////////////////////////////////////////////

			public function totstevlidcunt($elvacyr,$evlcos,$elvcostpy)
			{
			$quegettotstevlinf="select count(student_evl_id) as sttocont from  student_evaluation_session  where ac_year='$elvacyr' and course_unit='$evlcos' and course_type='$elvcostpy'";
			$qugettotstevlinf=mysql_query($quegettotstevlinf);
				$qgettotstevlinf=mysql_fetch_array($qugettotstevlinf);

					$gettotstevlinf=$qgettotstevlinf['sttocont'];

				return $gettotstevlinf;


			}

			////////////////////////////////////////////////////////////////////////
			/////////////////// end get tot st num of forms ////////////////////////
			////////////////////////////////////////////////////////////////////////






			////////////////////////////////////////////////////////////////////////
			//////////////////////////get st ans ptg by ////////////////////////////
			////////////////////////////////////////////////////////////////////////

			public function getstansptg($queno,$ansno,$elvacyr,$evlcos,$elvcostpy)
			{
				$quegetanspecntg="select count(ses.student_evl_id) as stpresentptg from student_evaluation_status ses, student_evaluation_session ss where ss.course_unit='$evlcos' and ss.ac_year='$elvacyr' and ss.course_type='$elvcostpy' and ss.student_evl_id=ses.student_evl_id and ses.que_no='$queno' and ses.answer='$ansno'";
				$qugetanspecntg=mysql_query($quegetanspecntg);
				$qgetanspecntg=mysql_fetch_array($qugetanspecntg);

					$getanspecntg=$qgetanspecntg['stpresentptg'];

				return $getanspecntg;
			}

			////////////////////////////////////////////////////////////////////////
			//////////////////////end get st ans ptg by ////////////////////////////
			////////////////////////////////////////////////////////////////////////




	}/////////////////class close if
?>
