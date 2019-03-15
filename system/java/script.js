if (window.addEventListener)
window.addEventListener('DOMMouseScroll', handleWheel, false);
window.onmousewheel = document.onmousewheel = handleWheel;
if (window.attachEvent) 
window.attachEvent("onmousewheel", handleWheel);
function handleWheel(event){
	try {
		if(!window.document.FlexPaperViewer.hasFocus()){return true;}
		window.document.FlexPaperViewer.setViewerFocus(true);
		window.document.FlexPaperViewer.focus();
		if(navigator.appName == "Netscape"){
			if (event.detail)
				delta = 0;
			if (event.preventDefault){
				event.preventDefault();
				event.returnValue = false;
			}
		}
		return false;	
	}
	catch(err){return true;}
}
var swfVersionStr = "9.0.124";
var xiSwfUrlStr = "${expressInstallSwf}";
var params = {}
params.quality = "high";
params.bgcolor = "#ffffff";
params.allowscriptaccess = "always";
params.allowfullscreen = "true";
var attributes = {};
attributes.id = "FlexPaperViewer";
attributes.name = "FlexPaperViewer";
//swfobject.embedSWF("./lib/FlexPaperViewer.swf", "flashContent", "670", "600", swfVersionStr, xiSwfUrlStr, flashvars, params, attributes);
swfobject.createCSS("#flashContent", "display:block;text-align:left;");
