var myfont_face="Tahoma";var myfont_size="8";var myfont_color="white";var myback_color="";
var mypre_text="";var mywidth="";var my12_hour=0;var myupdate=1;var DisplayDate=0;
var ie4=document.all
var ns4=document.layers
var ns6=document.getElementById&&!document.all
var dn="";var mn="";var old="";var DaysOfWeek=new Array(7);DaysOfWeek[0]="Minggu";DaysOfWeek[1]="Senin";
DaysOfWeek[2]="Selasa";DaysOfWeek[3]="Rabu";DaysOfWeek[4]="Kamis";DaysOfWeek[5]="Jumat";DaysOfWeek[6]="Sabtu";
var MonthsOfYear=new Array(12);MonthsOfYear[0]="Januari";MonthsOfYear[1]="Februari";MonthsOfYear[2]="Maret";
MonthsOfYear[3]="April";MonthsOfYear[4]="Mei";MonthsOfYear[5]="Juni";MonthsOfYear[6]="Juli";MonthsOfYear[7]="Agustus";
MonthsOfYear[8]="September";MonthsOfYear[9]="Oktober";MonthsOfYear[10]="November";MonthsOfYear[11]="Desember";
var ClockUpdate=new Array(3);ClockUpdate[0]=0;ClockUpdate[1]=1000;ClockUpdate[2]=60000;
if (ie4||ns6) {document.write('<span id="LiveClockIE" style="width:'+mywidth+'px; background-color:'+myback_color+'"></span>');}
else if (document.layers) {document.write('<ilayer bgColor="'+myback_color+'" id="ClockPosNS" visibility="hide"><layer width="'+mywidth+'" id="LiveClockNS"></layer></ilayer>');}
else {old="true"; ShowClock();}
function ShowClock() {
if (old=="die") {return;}
if (ns4) document.ClockPosNS.visibility="show"
var Digital=new Date();var day=Digital.getDay();var mday=Digital.getDate();var month=Digital.getMonth();
var hours=Digital.getHours();var minutes=Digital.getMinutes();var seconds=Digital.getSeconds();
if (mday==1) {mn="";}
else if (mday==2) {mn="";}
else if (mday==3) {mn="";}
else if (mday==21) {mn="";}
else if (mday==22) {mn="";}
else if (mday==23) {mn="";}
else if (mday==31) {mn="";}
if (my12_hour) {dn="AM";if (hours > 12) {dn="PM"; hours=hours-12;} if (hours==0) {hours=12;}}
else {dn="";}
if (minutes<=9) {minutes="0"+minutes;}
if (seconds<=9) {seconds="0"+seconds;}
/*myclock='';myclock+='<font style="color:'+myfont_color+'; font-family:'+myfont_face+'; font-size:'+myfont_size+'pt;">';*/
myclock='';myclock+='<font>';
myclock+=mypre_text;myclock+=hours+':'+minutes;
if ((myupdate<2) || (myupdate==0)) {myclock+=':'+seconds;}
myclock+=' '+dn;
if (DisplayDate) {myclock+=' | '+DaysOfWeek[day]+', '+mday+mn+' '+MonthsOfYear[month];}
myclock+='</font>';
if (old=="true") {document.write(myclock);old="die";return;}
if (ns4) {clockpos=document.ClockPosNS;liveclock=clockpos.document.LiveClockNS;liveclock.document.write(myclock);liveclock.document.close();}
else if (ie4) {LiveClockIE.innerHTML = myclock;}
else if (ns6) {document.getElementById("LiveClockIE").innerHTML=myclock;}            
if (myupdate!=0) {setTimeout("ShowClock()",ClockUpdate[myupdate]);}}