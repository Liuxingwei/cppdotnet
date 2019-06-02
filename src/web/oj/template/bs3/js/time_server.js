
var diff=new Date("<?php echo date("Y/m/d H:i:s")?>").getTime()-new Date().getTime();
//alert(diff);
function clock()
{
var x,h,m,s,n,xingqi,y,mon,d;
var x = new Date(new Date().getTime()+diff);
y = x.getYear()+1900;
if (y>3000) y-=1900;
mon = x.getMonth()+1;
d = x.getDate();
xingqi = x.getDay();
h=x.getHours();
m=x.getMinutes();
s=x.getSeconds();
view_date=y+"-"+mon+"-"+d;
view_time="<span class='ticktock'>"+(h>=10?h:"0"+h)+"</span>:<span class='ticktock'>"+(m>=10?m:"0"+m)+"</span>:<span class='ticktock'>"+(s>=10?s:"0"+s)+"</span>";
//alert(n);
document.getElementById('nowtime').innerHTML=view_time;
document.getElementById('nowdate').innerHTML=view_date;
setTimeout("clock()",1000);
}
clock();