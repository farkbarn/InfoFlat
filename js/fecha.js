var mydate=new Date()
var year=mydate.getYear()
if (year < 1000)
year+=1900
var day=mydate.getDay()
var month=mydate.getMonth()
var daym=mydate.getDate()
if (daym<10)
	daym="0"+daym 
	var dayarray=new Array("Domingo,","Lunes,","Martes,","Miércoles,","Jueves,","Viernes,","Sábado,")
	var montharray=new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre")
	document.write("<font color='white'>"+' | '+"<span class='dia'>"+dayarray[day]+"</span>"+"<span class='de'>"+" "+daym+" de "+"</span>"+montharray[month]+" de "+year+' | '+"</font>");
