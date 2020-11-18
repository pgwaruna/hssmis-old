var xmlHttp;
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////regster fucn////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
function spregister(stno,spcourse,acyear)
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }
 

 //alert(spcourse+"-"+stno+"="+acyear);
 
var loader="ldr"+spcourse;
document.getElementById(loader).src='./images/ajax-loader.gif';
document.getElementById(loader).style.visibility= 'visible';
 
var divid="did"+spcourse;

var dgst="spdg"+spcourse;
var c = document.getElementById(dgst);
var dgstvl = c.options[c.selectedIndex].value;

 
var url="./Ajax/sp_cu_reg.php";

            url=url+"?task=regis"+"&stno="+stno+"&spcourse="+spcourse+"&acyear="+acyear+"&spdgst="+dgstvl;
            xmlHttp.onreadystatechange=stateChanged;
            xmlHttp.open("GET",url,true);
            xmlHttp.send(null);
    
function stateChanged() 
    { 
    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
    { 
    document.getElementById(divid).innerHTML=xmlHttp.responseText;
    document.getElementById(loader).style.visibility= 'hidden';
        //////////////////////call counter////////////////
            spregcount(stno,acyear);
        //////////////////////////////////////////////////
        
        /////////////////////call all counter/////////////
            allregcount(stno);
        //////////////////////////////////////////////////
    } 
    }
    
        

}
////////////////////////////////////////////////////////////////////////////////////
///////////////////////////// end regster fucn /////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

    
    

/////////////////////////////////////////////////////////////////////////////
////////////////reg cancel function//////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
var xmlHttp;

function spregcnl(id,stno2,spcourse2,acyear2)
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 } 

var loader="ldr"+spcourse2;
document.getElementById(loader).src='./images/ajax-loader.gif';
document.getElementById(loader).style.visibility= 'visible';
 
var divid="did"+spcourse2;



 
var url="./Ajax/sp_cu_reg.php";

            url=url+"?task=cncl"+"&spcuregid="+id+"&stno="+stno2+"&spcourse="+spcourse2+"&acyear="+acyear2;
            xmlHttp.onreadystatechange=stateChanged;
            xmlHttp.open("GET",url,true);
            xmlHttp.send(null);
    
function stateChanged() 
    { 
    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
    { 
    document.getElementById(divid).innerHTML=xmlHttp.responseText;
    document.getElementById(loader).style.visibility= 'hidden';
        //////////////////////call counter////////////////
            spregcount(stno2,acyear2);
        //////////////////////////////////////////////////
        
        /////////////////////call all counter/////////////
            allregcount(stno2);
        //////////////////////////////////////////////////

    } 
    }
     

}
/////////////////////////////////////////////////////////////////////////////
////////////////end reg cancel function//////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////





//////////////////////////////////////////////////////////////////////////////
////////////////////////////cdt counter //////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
function spregcount(stno3,acyear3)
{ 
var xmlHttp;
xmlHttp=GetXmlHttpObject();


var ctdivid="spcdcut";

var url="./Ajax/sp_cu_reg.php";

            url=url+"?task=cdtcunt"+"&stno="+stno3+"&acyear="+acyear3;
            xmlHttp.onreadystatechange=stateChanged;
            xmlHttp.open("GET",url,true);
            xmlHttp.send(null);
    
function stateChanged() 
    { 
    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
        { 
        document.getElementById(ctdivid).innerHTML=xmlHttp.responseText;
        
        } 
        }
       
  
    }    
    
    
/////////////////////////////////////////////////////////////////////////////
/////////////////////////end cdt counter ////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////







//////////////////////////////////////////////////////////////////////////////
///////////////////////// all cdt counter ////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
function allregcount(stno4)
{ 
var xmlHttp;
xmlHttp=GetXmlHttpObject();


var ctdivid="allcdcut";

var url="./Ajax/sp_cu_reg.php";

            url=url+"?task=allcdtcunt"+"&stno="+stno4;
            xmlHttp.onreadystatechange=stateChanged;
            xmlHttp.open("GET",url,true);
            xmlHttp.send(null);
    
function stateChanged() 
    { 
    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
        { 
        document.getElementById(ctdivid).innerHTML=xmlHttp.responseText;
        
        } 
        }
       
  
    }


//////////////////////////////////////////////////////////////////////////////
////////////////////////end all cdt counter///////////////////////////////////
//////////////////////////////////////////////////////////////////////////////




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


