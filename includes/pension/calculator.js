<!--
var DOB=""
function getPos(el,sProp) {
	var iPos = 0
	while (el!=null) {
		iPos+=el["offset" + sProp]
		el = el.offsetParent
	}
	return iPos
}
//////////////////////////////////////////////
//	Validate Form Function
///////////////////////////////////////

function ValidateForm(validationFlag) 		//validationFlag values are 'full' and 'half'
{
//	formObj = document.forms(0);
	formObj = document.Form1;
	
        if (validationFlag=='full')  
	 {

///*		if (trim(formObj.dt_birth.value)=="")    {
// 			      alert("Date of Birth Must be Entered.");
//			      formObj.dt_birth.select();	
//		      	     return (false);  } 
//*/

		if ((formObj.bdate.value=="") || (formObj.bmonth.value=="") || (formObj.byear.value==""))
			{
				alert("Please Enter Date of Birth");
				if(formObj.bdate.value=="")
					formObj.bdate.focus();
				else if(formObj.bmonth.value=="")
					formObj.bmonth.focus();
				else
					formObj.byear.focus();		
				return false;
				
			}
		else
			{
				var day=formObj.bdate.value;  var month=formObj.bmonth.value; var year=formObj.byear.value;
						
				 if ((month == 4 || month == 6 || month == 9 || month == 11) && (day > 30))
				 {
				  alert("Date of Birth : " + day + " is not a valid day for month " + month);
				  formObj.bdate.focus();
				  return(false);
				 } 
				
				 if (month == 2)
				 {
				  //---- check for leap year -----
				  if ((day > 28) && (year%4 != 0)) 
				  {
				   alert("Date of Birth : " + day + " is not a valid day for month " + month  + " of year " + year);
				   formObj.bdate.focus();      
				   return(false);
				  }
				
				  if ((day > 29) && (year%4 == 0)) 
				  {
				    alert("Date of Birth : " + day + " is not a valid day for month " + month + " of year " + year);
				    formObj.bdate.focus();
				    return(false);
				  }
				
			 }

						
		}	
		
		if (trim(formObj.dt_retire.value)=="")   {
 			      alert("Date of Retirement Must be Entered.");
			      formObj.dt_retire.select();	
		      	     return (false);  } 
			
		DOB = formObj.bdate.value +"/"+ formObj.bmonth.value +"/" + formObj.byear.value;


		if (!isCompleteDate(formObj.dt_retire, "Date of Retirement ")){
			formObj.dt_retire.select();	
			return false;}
	}

// ********* Qualifying Service Validation starts ************
	valid=true;
//	today = new Date();	

// ***** Year Validation Starts *****
	year=trim(formObj.QualifyingServiceYr.value);
	      if (year!='' )
			{
		  	if (!isNumeric(year)) 
		        		valid=false;				 
			}
	            else
		     valid=false;	   		    
		

		  if (!valid )		  {			
 		      alert("Invalid or Blank Qualifying Service Years" + " = " + year);
		      formObj.QualifyingServiceYr.select();
		      return (false);  } 
									
		// ***** Year Validation Ends Here

// ***** Month  Validation Starts *****
	month=trim(formObj.QualifyingServiceMonth.value);
	           if (month!='' )
			{
		  		if (!isNumeric(month)) {
		        			valid=false; msg="Invalid Qualifying Service Month" + " = " + month ;}
				else
				      if (month > 11) {					 
					valid=false; msg="Qualifying Service month must be less than 12 "; }
			}
	   		    
		

		  if (!valid )		  {			
 		      alert(msg);
		      formObj.QualifyingServiceMonth.select();
		      return (false);  } 
									
		// ***** Month Validation Ends Here

// ***** Last 10 Months Basic   Validation Starts *****

	LastBasicPay=trim(formObj.BasicPayTotal.value);
	           if (LastBasicPay!='' )
			{
		  		if (!isNumeric(LastBasicPay)) 
		        			valid=false;
			}
		else
			valid=false;		
	   		    
		  if (!valid )		  {			
     		      alert("Invalid or Blank Sum of Last Month Basic Pay" + " = " + LastBasicPay);
		      formObj.BasicPayTotal.select();
		      return (false);  } 
									
		// ***** Month Validation Ends Here

	return true;
}

/////////////////////////////////////////////////////////////////////////////////////////
  //The JavaScript function isCompleteDate checks whether the text entered in a field has 
  //the date format DD/MM/YYYY and appropriate values for month/day/year, displaying an 
  //error message and returning a value of 'false' if it does not.
/////////////////////////////////////////////////////////////////////////////////////////
function isCompleteDate(theElement, theName)
{

 // This function checks if the text entered in a field 
 // has the format DD/MM/YYYY. 
 // It also checks if the days and months are valid and
 // if the year is 1500 or later

 var objectName = theName;
 
 //---- since we need the same functionality for errors ----
 //---- we create a function to simplify error display  ----
 
 function showError(message)
 {
  alert(objectName + ": " + message);
  theElement.focus();
 }
 
 function isEmpty(str1)
 {
	cnt = 0;
	for(i=0; i < (str1.length); i++)
		{
			ch=str1.charAt(i);
			if (!(ch == " "))
				return(false);
		}
	return(true);
}

 var date_regex = /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/;
 
 var date_str = theElement.value;


 //if ((date_str.length) > 10)
//	date_str=date_str.substring(0,date_str.length-1);
	
 date_str=trim(date_str);
 
//alert(date_str);
// alert(date_str.length);

 // ^ indicates start of expression
 // \d{1,2} - the \d means digits and {1,2} means 1 or 2 digits
 // $ indicates end of expression

 if(isEmpty(date_str))
 	return(true);



 if (!date_regex.test(date_str)) 
 {
  showError(theElement.value + " is NOT a valid date");
  theElement.focus();
  return(false);
 }


 //---- separate the month, day and year ----
 
 var day	= RegExp.$1;
 var month	= RegExp.$2; 
 var year	= RegExp.$3;

 if (year < 1910 ||  year>2050 )
 {
  showError(year + " is not a valid year");
  return(false);
 }

 if (month < 1 || month > 12)
 {
  showError(month + " is not a valid month");
  return(false);
 }

 if (day == 0)
 { 
  showError(day + " is not a valid day");
  return(false);
 }

 if ((month == 1 || month == 3 || month == 5 || month == 7 ||
    month == 8 || month == 10 || month == 12) && (day > 31))
 {
  showError(day + " is not a valid day for month " + month);
  return (false) ;
 }

 if ((month == 4 || month == 6 || month == 9 || month == 11) && (day > 30))
 {
  showError(day + " is not a valid day for month " + month);
  return(false);
 } 

 if (month == 2)
 {
  //---- check for leap year -----
  if ((day > 28) && (year%4 != 0)) 
  {
   showError(day + " is not a valid day for month " + month 
         + " of year " + year);
   return(false);
  }

  if ((day > 29) && (year%4 == 0)) 
  {
    showError(day + " is not a valid day for month " + month 
         + " of year " + year);
    return(false);
  }

 }

 return(true);
}


//////////////////////////////////////////////
//	Trim Function
///////////////////////////////////////
function trim(thisvalue)
{
 var result;
 var i=0;
 var j=thisvalue.length-1;
 while ((thisvalue.charCodeAt(i) == 32) && (i<thisvalue.length))
  i++;
 while ((thisvalue.charCodeAt(j) == 32) && (j>0))
  j--;
 j++;
 result=thisvalue.substring(i,j);
 return(result);
}

//////////////////////////////////////////////////////////////////////////
//               isNumeric Function
//////////////////////////////////////////////////////////////////////////
 function isNumeric(checkvalue)
{ 
  var checkOK = "0123456789";
  var checkStr = checkvalue;
  var allValid = true;  

  if (checkStr=="")
	return true;

  for (i = 0;  i < checkStr.length;  i++) {
    ch = checkStr.charAt(i);
    for (j = 0;  j < checkOK.length;  j++)
      if (ch == checkOK.charAt(j))
        break;
    if (j == checkOK.length) {
      allValid = false;
      break;			     }
										 }
  if (!allValid)
    return (false);

  return true
}

//////////////isNumeric Function Ends Here

//////////////////////////////////////////////////////////////////////////
//	Calculation of Qualifying Service  
//////////////////////////////////////////////////////////////////////////
function CalculateQualifyingService(retirement_type)
{
	formObj = document.Form1;
	
	QS_Yrs=parseInt(formObj.QualifyingServiceYr.value);
	QS_Months=parseInt(formObj.QualifyingServiceMonth.value);
	QS_Months_Original = QS_Months
	
	if (QS_Months >= 9 )
		QS_Months = 12;
	else if (QS_Months >= 3 )
		        QS_Months = 6; 
	       else
		        QS_Months = 0; 
	

	HalfYears = (QS_Yrs*2) + (QS_Months/6);  // Calculating on Half Yearly basis.
	HalfYear_Original = HalfYears;
			
//	retirement_type = formObj.retirement_type.value;
	
	var dt_birth = DOB; //formObj.dt_birth.value;
	var dt_retire = formObj.dt_retire.value;
	
	if (retirement_type=='V')	
			HalfYears = CalculateQualServiceforVR(dt_birth,dt_retire,QS_Yrs,QS_Months_Original,HalfYears);
	 
	 
	if (HalfYears > 66 )
		HalfYears = 66;	
		
	return HalfYears;

}
/////////////////End of Calculation of Qualifying Service  ////

//////////////Calculation of Qualifying Service for Voluntary Retirement 

function CalculateQualServiceforVR(dt_birth,dt_retire,QS_Yrs,QS_Months_Original,HalfYears)
{

			 var date_regex = /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/;
			 var date_str = dt_birth; //formObj.dt_birth.value;

			 //---- separate the month, day and year ----			 
			 Valid=date_regex.test(date_str);

			var day		= parseInt(RegExp.$1,10);
			var month	= parseInt(RegExp.$2,10); 
			var year	= parseInt(RegExp.$3,10);
			
		    if (day == 1 && month == 1) 
				Year_S = year + 59;
			else
				Year_S = year + 60;

		    if (day == 1 )
				{Month_S = month - 1;
				 if (Month_S == 0 )
					Month_S = 12; }
			else
				Month_S = month;

			
//   		 var date_regex_V = /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/;
		 date_str = dt_retire; // formObj.dt_retire.value;

		 //---- separate the month, day and year ----
		 		 
 	    Valid=date_regex.test(date_str);
	 
		var Day_V	= parseInt(RegExp.$1,10);
		var Month_V	= parseInt(RegExp.$2,10);  
		var Year_V	= parseInt(RegExp.$3,10);
		
		var YearDiffNegative=false;

		YearDiff = Year_S - Year_V;

		if (YearDiff < 0 ){ 
			YearDiffNegative=true;
			YearDiff = Year_V - Year_S;}

	
	//	MonthDiff = (12-Month_V) + Month_S;
	
		
		MonthDiff = Month_S - Month_V;
		if (YearDiffNegative)
			MonthDiff = Month_V - Month_S;
			

		
		if (MonthDiff < 0) {
				YearDiff = YearDiff - 1 ;
				MonthDiff = 12 + MonthDiff ;
				}
		if (Day_V==1)				
			MonthDiff = MonthDiff + 1;
			
			

	//	MonthDiff=QS_Months_Original + MonthDiff
		
		if (MonthDiff > 11 ){
			YearDiff = YearDiff + 1;
			MonthDiff =MonthDiff - 12; }
			
	if (YearDiff < 5)  {		
		var Months	= MonthDiff + QS_Months_Original;
		var Years = QS_Yrs + YearDiff;
		if (Months > 11 ){
			Years = Years + 1;
			Months = Months - 12;}
		
		if (Months >= 9 )
			Months = 12; 	

		if (Months >= 3 )
			Months =6; 
		else
			Months =0; 
		
		HalfYears = (Years * 2)  + (Months/6);
		}		

	else // if YearDiff >= 5
		HalfYears  = HalfYears + (5 * 2); // Half Yearly Basis
	
	return HalfYears;
}
//End of  Calculation of Qualifying Service in Case of V.R. 
///////////////////////////////////////


/////////////////////////////////////////
// Get the Age on Next BirthDay
/////////////////////////////////////
function GetAgeOnNextBirthday(dt_birth,dt_retire,retirement_type)
{
			 var AgeOnNextBday;
			 var date_regex = /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/;
	
			 var date_str = dt_birth; 

			 //---- separate the month, day and year ----			 
			 Valid=date_regex.test(date_str);

			var day_b	= parseInt(RegExp.$1,10);
			var month_b	= parseInt(RegExp.$2,10); 
			var year_b	= parseInt(RegExp.$3,10);
			
			 var date_str = dt_retire; 

			 //---- separate the month, day and year for Retirement Date ----			 
			 Valid=date_regex.test(date_str);

			var day_r	= parseInt(RegExp.$1,10);
			var month_r	= parseInt(RegExp.$2,10); 
			var year_r	= parseInt(RegExp.$3,10);
			
			AgeOnNextBday = parseInt(year_r - year_b);
			
			if (retirement_type=='S')
				{
					AgeOnNextBday = AgeOnNextBday + 1;
					if ((month_b == 1) && (day_b == 1))
						 AgeOnNextBday = AgeOnNextBday + 1;
						 
				}
			else
				{
					formObj = document.Form1;
					var LastDayRetire = formObj.com_LastDay.value;
					
					if (month_r < month_b)
						{
							var monthDiff =  month_b - month_r;
							if (monthDiff == 1)
							{
								if (day_b == 1)
									if (LastDayRetire=='Y' )
										 AgeOnNextBday = AgeOnNextBday + 1;
							}
						}
					else
						{
							

							if (month_r == month_b)
							{	
								if ((day_r >= (day_b-1)))
									AgeOnNextBday = AgeOnNextBday + 1;
								else
									{
									if (LastDayRetire=='Y')
										AgeOnNextBday = AgeOnNextBday + 1;
									}
							}
							else
								{
									AgeOnNextBday = AgeOnNextBday + 1;	
									if ((month_r==12) && (month_b==1))
										if (day_b==1)
											{
												if (LastDayRetire=='Y')
													AgeOnNextBday = AgeOnNextBday + 1;
											}
								}
						}
					
				}  //else part of condition "if (retirement_type=='S')"

	return AgeOnNextBday ;		
}
/////////////////////////////////////////
//End of Get the Age on Next BirthDay
/////////////////////////////////////



/////////////////////////////////////////
//Get the Commutation Factor
/////////////////////////////////////
function GetCommutationFactor(age)
{
	var factor;
	switch (age) {
	
		case 57:		
		   factor="11.10";
		   break;
		case 58:		
		   factor="10.78";
		   break;
		case 59:		
		   factor="10.46";
		   break;	
		case 60:
		   factor="10.13";
		   break;
		case 61:
		   factor="9.81";
		   break;
		case 62:
		   factor="9.48";
		   break;
		case 63:
		   factor="9.15";
		   break;
		case 64:
		   factor="8.82";
		   break;
		case 65:
		   factor="8.5";
		   break;
		case 66:
		   factor="8.17";
		   break;
		case 67:
		   factor="7.85";
		   break;
		case 68:
		   factor="7.53";
		   break;
		case 69:
		   factor="7.22";
		   break;
		case 70:
		   factor="6.91";
		   break;
		
		case 50:		
		   factor="13.25";
		   break;
		case 51:		
		   factor="12.95";
		   break;
		case 52:		
		   factor="12.66";
		   break;
		case 53:		
		   factor="12.35";
		   break;
		case 54:		
		   factor="12.05";
		   break;
		case 55:		
		   factor="11.73";
		   break;
		case 56:		
		   factor="11.42";
		   break;

		case 71:
		   factor="6.6";
		   break;
		case 72:
		   factor="6.3";
		   break;
		case 73:
		   factor="6.01";
		   break;		   		   

		case 74:
		   factor="5.72";
		   break;
		case 75:
		   factor="5.44";
		   break;
		case 76:
		   factor="5.17";
		   break;		   		   
		case 77:
		   factor="4.9";
		   break;
		case 78:
		   factor="4.65";
		   break;
		case 79:
		   factor="4.4";
		   break;		   		   

		case 80:
		   factor="4.17";
		   break;   
		case 81:
		   factor="3.94";
		   break;		   		   
		case 82:
		   factor="3.72";
		   break;		   		   
		case 83:
		   factor="3.52";
		   break;		   		   
		case 84:
		   factor="3.32";
		   break;		   		   
		case 85:
		   factor="3.13";
		   break;		   		   

		case 17:
		   factor="19.28";
		   break;		   		   
		case 18:
		   factor="19.2";
		   break;	   		   
		case 19:
		   factor="19.11";
		   break;		   		   
		case 20:
		   factor="19.01";
		   break;		   		   
		case 21:
		   factor="18.91";
		   break;		   		   
		case 22:
		   factor="18.81";
		   break;		   		   
		case 23:
		   factor="18.7";
		   break;		   		   
		case 24:
		   factor="18.59";
		   break;		   		   
		case 25:
		   factor="18.47";
		   break;		   		   
		case 26:
		   factor="18.34";
		   break;		   		   
		case 27:
		   factor="18.21";
		   break;		   		   
		case 28:
		   factor="18.07";
		   break;		
		   
		case 29:
		   factor="17.93";
		   break;		   		   
		case 30:
		   factor="17.78";
		   break;		   		   
		      		   
		case 31:
		   factor="17.62";
		   break;		   		   
		case 32:
		   factor="17.46";
		   break;		   		   
		case 33:
		   factor="17.29";
		   break;		   		   
		case 34:
		   factor="17.11";
		   break;		   		   
		case 35:
		   factor="16.92";
		   break;		   		   

		case 36:
		   factor="16.72";
		   break;		   		   
		case 37:
		   factor="16.52";
		   break;		   		   
		case 38:
		   factor="16.31";
		   break;		   		   
		case 39:
		   factor="16.09";
		   break;		   		   
		case 40:
		   factor="15.87";
		   break;		   		   

		case 41:
		   factor="15.64";
		   break;		   		   
		case 42:
		   factor="15.4";
		   break;		   		   
		case 43:
		   factor="15.15";
		   break;		   		   
		case 44:
		   factor="14.9";
		   break;		   		   
		case 45:
		   factor="14.64";
		   break;		   		   

		case 46:
		   factor="14.37";
		   break;		   		   
		case 47:
		   factor="14.1";
		   break;		   		   
		case 48:
		   factor="13.82";
		   break;		   		   
		case 49:
		   factor="13.54";
		   break;		   		   

    }  
	return factor;
}

function GetRetireDate()
{
	
 if (document.Form1.retirement_type.value=="S")
   {

	if (document.Form1.bdate.value!="")
	{
	//alert(document.Form1.bmonth.value)
	if (document.Form1.bmonth.value!="")
	{
		//alert("2")
	if (document.Form1.byear.value!="")
	{
		//alert("3")
	yDate=document.Form1.bdate.value;
	yMonth=document.Form1.bmonth.value;
	yYear=document.Form1.byear.value;
	yYear= 60 + eval(yYear);
	actDate = yMonth + "/" + yDate + "/" + yYear ;
	
	
	newDOR=new Date(actDate);

	
	if (eval(newDOR.getDate())==1)
	{
	
	newDOR=newDOR.setDate(newDOR.getDate() - 1)
	newDOR=new Date(newDOR)
	dor60= newDOR.getDate() + "/" + (eval(newDOR.getMonth()) + 1) + "/" + newDOR.getFullYear();
	document.Form1.dt_retire.value= dor60;
	}
	else
	{
	dor60= newDOR.getDate() + "/" + (eval(newDOR.getMonth()) + 1) + "/" + newDOR.getFullYear();

		three1=31; three0=30; feb=28;
		m=eval(newDOR.getMonth() + 1)
		y=newDOR.getFullYear()
		
		if(m==2)
		{
			if ((y%4)==0)
			{
			 feb=29;
             actDate = m + "/" + feb + "/" + y ;
			newDOR= new Date(actDate)
			dor60= newDOR.getDate() + "/" + (eval(newDOR.getMonth()) + 1) + "/" + newDOR.getFullYear();
		 	document.Form1.dt_retire.value= dor60;
			}
			else
			{		
			feb=28;
            actDate = m + "/" + feb + "/" + y ;
			newDOR= new Date(actDate)
			dor60= newDOR.getDate() + "/" + (eval(newDOR.getMonth()) + 1) + "/" + newDOR.getFullYear();
		 	document.Form1.dt_retire.value= dor60;
			}
		}
		else
		{
			if(m==1 || m==3 || m==5 || m==7 || m==8 || m==10 || m==12)
			{
			actDate = m + "/" + three1 + "/" + y ;
				newDOR= new Date(actDate)
				dor60= newDOR.getDate() + "/" + (eval(newDOR.getMonth()) + 1) + "/" + newDOR.getFullYear();
				document.Form1.dt_retire.value= dor60;
			}
			else
			{
			actDate = m + "/" + three0 + "/" + y ;
				newDOR= new Date(actDate)
				dor60= newDOR.getDate() + "/" + (eval(newDOR.getMonth()) + 1) + "/" + newDOR.getFullYear();
				document.Form1.dt_retire.value= dor60;
			}
											
		} 
	
	  }
			
	 } //year
      }	//month
   } //day
 } //retirement type
}


//===========================================
// Trapping Key strokes in Various Fields
//===========================================
function CheckNumeric() {
// Allowed 0-9 
if (event.keyCode < 48 || event.keyCode >57) 
   event.returnValue =false;
}

function CheckDate() {
// Allowed 0-9 and / (keycode 47)
if (event.keyCode < 47 || event.keyCode >57) 
   event.returnValue =false;

}
//-->


