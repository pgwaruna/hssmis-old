var xmlHttp;

function cmbcnfm(stno)
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }

 
var cmb1=stno+"comb_sub01";
var c1 = document.getElementById(cmb1);
var cmbvl1 = c1.options[c1.selectedIndex].value;


var cmb2=stno+"comb_sub02";
var c2 = document.getElementById(cmb2);
var cmbvl2 = c2.options[c2.selectedIndex].value;


var cmb3=stno+"comb_sub03";
var c3 = document.getElementById(cmb3);
var cmbvl3 = c3.options[c3.selectedIndex].value;


 
if((cmbvl1==0)||(cmbvl2==0)||(cmbvl3==0)){
	alert("Please select the subject ! ");
return;
	}
else{
 
 
 
var loader="ldr"+stno;
document.getElementById(loader).src='../images/ajax-loader.gif';

document.getElementById(loader).style.visibility= 'visible';


var sty=stno+"year_6_6";
var a = document.getElementById(sty);
var byear = a.options[a.selectedIndex].value;







			var imgid="img"+stno;
			document.getElementById(imgid).src='images/submt.png';

			var imgsh="sho"+stno;
			document.getElementById(imgsh).src='../images/edit-undo.png';


			var divid="div"+stno;

			var url="../Ajax/confirm_cmb.php";
			url=url+"?task=cnfm"+"&stno="+stno+"&byear="+byear+"&cmbvl1="+cmbvl1+"&cmbvl2="+cmbvl2+"&cmbvl3="+cmbvl3;
			xmlHttp.onreadystatechange=stateChanged;
			xmlHttp.open("GET",url,true);
			xmlHttp.send(null);
	}
function stateChanged() 
	{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
	document.getElementById(divid).innerHTML=xmlHttp.responseText;
	document.getElementById(loader).style.visibility= 'hidden';
	document.getElementById(imgid).style.visibility= 'hidden';
	document.getElementById(imgsh).style.visibility= 'visible';
	} 
	}
		
}

////////////////confirmation undo function//////////////////////////////
var xmlHttp;

function cmbundo(stno,lname)
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }

var loader="ldr"+stno;
document.getElementById(loader).src='../images/ajax-loader.gif';

document.getElementById(loader).style.visibility= 'visible';

var imgid="img"+stno;
document.getElementById(imgid).src='../images/submt.png';

var imgsh="sho"+stno;
document.getElementById(imgsh).src='../images/edit-undo.png';


var divid="div"+stno;

var url="../Ajax/confirm_cmb.php";
url=url+"?task=undocf"+"&stno="+stno;
xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById(divid).innerHTML=xmlHttp.responseText;
document.getElementById(loader).style.visibility= 'hidden';
document.getElementById(imgsh).style.visibility= 'hidden';
document.getElementById(imgid).style.visibility= 'visible';
} 
}
}

/////////////////////////////////////////////////////////////
















//////////////////////special regi//////////////////////////
function spclsubrg(stno)
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }

 
var cmb1=stno+"spclstrm";
var c1 = document.getElementById(cmb1);
var cmbvl1 = c1.options[c1.selectedIndex].value;


 
if(cmbvl1==0){
	alert("Please select the subject ! ");
return;
	}
else{
 
 
 
var loader="ldr"+stno;
document.getElementById(loader).src='./images/ajax-loader.gif';

document.getElementById(loader).style.visibility= 'visible';









			var imgid="img"+stno;
			document.getElementById(imgid).src='./images/sbm.png';

			var imgsh="sho"+stno;
			document.getElementById(imgsh).src='./images/downps.png';


			var divid="div"+stno;

			var url="./Ajax/confirm_cmb.php";
			url=url+"?task=setnwspstm"+"&stno="+stno+"&cmbvl1="+cmbvl1;
			xmlHttp.onreadystatechange=stateChanged;
			xmlHttp.open("GET",url,true);
			xmlHttp.send(null);
	}
function stateChanged() 
	{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
	document.getElementById(divid).innerHTML=xmlHttp.responseText;
	document.getElementById(loader).style.visibility= 'hidden';
	document.getElementById(imgid).style.visibility= 'hidden';
	document.getElementById(imgsh).style.visibility= 'visible';
	} 
	}
		
}
/////////////////////////////////////////////////////////////////////






////////////////specil regi undo function//////////////////////////////


function spclsubrgundo(stno)
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }

var loader="ldr"+stno;
document.getElementById(loader).src='./images/ajax-loader.gif';

document.getElementById(loader).style.visibility= 'visible';

var imgid="img"+stno;
document.getElementById(imgid).src='./images/sbm.png';

var imgsh="sho"+stno;
document.getElementById(imgsh).src='./images/downps.png';


var divid="div"+stno;

var url="./Ajax/confirm_cmb.php";
url=url+"?task=undospreg"+"&stno="+stno;
xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById(divid).innerHTML=xmlHttp.responseText;
document.getElementById(loader).style.visibility= 'hidden';
document.getElementById(imgsh).style.visibility= 'hidden';
document.getElementById(imgid).style.visibility= 'visible';
} 
}
}

/////////////////////////////////////////////////////////////

























function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}

