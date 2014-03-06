function MostrarFecha()
{
    //FECHA ACTUAL EN FORMATO TEXTO
//
//Autor: Iván Nieto Pérez
//Este script y otros muchos pueden
//descarse on-line de forma gratuita
//en El Código: www.elcodigo.com

    var nombres_dias = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado")
    var nombres_meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre")

    var fecha_actual = new Date()

    dia_mes = fecha_actual.getDate()		//dia del mes
    dia_semana = fecha_actual.getDay()		//dia de la semana
    mes = fecha_actual.getMonth() + 1
    anio = fecha_actual.getFullYear()

    //escribe en pagina
    document.write(nombres_dias[dia_semana] + ", " + dia_mes + " de " + nombres_meses[mes - 1] + " de " + anio)
}

//RELOJ 24 HORAS
//
//Autor: Iván Nieto Pérez
//Este script y otros muchos pueden
//descarse on-line de forma gratuita
//en El Código: www.elcodigo.com

var RelojID24 = null
var RelojEjecutandose24 = false

function DetenerReloj24 (){
	if(RelojEjecutandose24)
		clearTimeout(RelojID24)
	RelojEjecutandose24 = false
}

function MostrarHora24 () {
	var ahora = new Date()
	var horas = ahora.getHours()
	var minutos = ahora.getMinutes()
	var segundos = ahora.getSeconds()
	var ValorHora

	//establece las horas
	if (horas < 10)
	     	ValorHora = "0" + horas;
	else
		ValorHora = "" + horas;

	//establece los minutos
	if (minutos < 10)
		ValorHora += ":0" + minutos;
	else
		ValorHora += ":" + minutos;

	//establece los segundos
	if (segundos < 10)
		ValorHora += ":0" + segundos;
	else
		ValorHora += ":" + segundos;
        
	document.reloj24.digitos.value = ValorHora;
	//si se desea tener el reloj en la barra de estado, reemplazar la anterior por esta
	//window.status = ValorHora

	RelojID24 = setTimeout("MostrarHora24()",1000);
	RelojEjecutandose24 = true;
}

function IniciarReloj24 () {
	DetenerReloj24();
	MostrarHora24();
}

window.onload = IniciarReloj24;

function MM_showHideLayers() { //v9.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) 
  with (document) if (getElementById && ((obj=getElementById(args[i]))!=null)) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
