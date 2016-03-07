
nima_cert =1;
strdate  = new Date();
var  weekday =strdate.getDay();

var time_hour = strdate.getHours();
var time_minutes= strdate.getMinutes()


if(weekday==6 || weekday==0 || (time_hour>=18 && time_minutes>=0  )|| time_hour<9){
	nima_cert=0;
}





