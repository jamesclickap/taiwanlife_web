/**
 * Javascript for loading swf widgets , espec flowplayer for PoodLL
 *
 * @copyright &copy; 2012 Justin Hunt
 * @author poodllsupport@gmail.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package filter_poodll
 */

M.filter_poodll = {}
M.filter_poodll.getwhiteboardcanvas=null;
M.filter_poodll.timeouthandle=null;
M.filter_poodll.opts =Array();

// Called by PoodLL recorders to update filename field on page
M.filter_poodll.updatepage = function(args) {
		//record the url on the html page,							
		var filenamecontrol = document.getElementById(args[3]);
		if(filenamecontrol==null){ filenamecontrol = parent.document.getElementById(args[3]);} 			
		if(filenamecontrol){
			filenamecontrol.value = args[2];
		}
		console.log("just  updated: " + args[3] + ' with ' + args[2]);
}


// Replace poodll_flowplayer divs with flowplayers
M.filter_poodll.loadflowplayer = function(Y,opts) {

//the standard config. change backgroundcolor to go from blue to something else	
theconfig = { plugins:
                                { controls:
                                        { fullscreen: false,
                                                height: 40,
                                                autoHide: false,
                                                buttonColor: '#ffffff',
                                                backgroundColor: opts['bgcolor'],
                                                disabledWidgetColor: '#555555',
                                                bufferGradient: 'none',
                                                timeSeparator: ' ',
                                                volumeSliderColor: '#ffffff',
                                                sliderGradient: 'none',
                                                volumeBorder: '1px solid rgba(128, 128, 128, 0.7)',
                                                volumeColor: '#ffffff',
                                                tooltipTextColor: '#ffffff',
                                                timeBorder: '0px solid rgba(0, 0, 0, 0.3)',
                                                buttonOverColor: '#ffffff',
                                                buttonOffColor: 'rgba(130,130,130,1)',
                                                timeColor: '#ffffff',
                                                progressGradient: 'none',
                                                sliderBorder: '1px solid rgba(128, 128, 128, 0.7)',
                                                volumeSliderGradient: 'none',
                                                durationColor: '#a3a3a3',
                                                backgroundGradient: [0.5,0,0.3],
                                                sliderColor: '#000000',
                                                progressColor: '#5aed38',
                                                bufferColor: '#445566',
                                                tooltipColor: '#000000',
                                                borderRadius: '0px',
                                                timeBgColor: 'rgb(0, 0, 0, 0)',
                                                opacity: 1.0 },
                                       
                                audio:
                                        { url: opts['audiocontrolsurl'] }
                                },
                playlist: opts['playlisturl'] ,
                clip:
                        { autoPlay: true }
        } ;
		
	var splash=false;

	//the params are different depending on the playertype
	//we need to specify provider for audio if the clips are not MP3 or mp3
	//jqueryseems unavoidable even if not using it for playlists
	switch(opts['playertype']){
		case "audio":
			if (opts['jscontrols']){
					theconfig.plugins.controls = null;
					//we don't need to see the flowplayer video/audio at all if we are using js 
					opts["height"]=1;
			}else{

				theconfig.plugins.controls.fullscreen =false;
				theconfig.plugins.controls.height = opts['height'];
				theconfig.plugins.controls.autoHide= false;
			}
			
			//We need to tell flowplayer if we have mp3 to play.
			//if it is FLV, we should not pass in a provider flag
			var ext = opts['path'].substr(opts['path'].lastIndexOf('.') + 1);
			if(ext==".mp3" || ext==".MP3"){
				theconfig.clip.provider='audio';			
			}
	
						
			//If we have a splash screen show it and enable autoplay(user only clicks once)
			//best to have a splash screen to prevent browser hangs on many flashplayers in a forum etc
			if(opts['poodll_audiosplash']){
				theconfig.clip.autoPlay=true;
				splash=true;
			}else{
				theconfig.clip.autoPlay=false;
			}
			break;
		
		case "audiolist":
			if (opts['jscontrols']){
					theconfig.plugins.controls = null;
					//we don't need to see the flowplayer video/audio at all if we are using js 
					opts["height"]=1;
			}else{
				theconfig.plugins.controls.fullscreen = false;
				theconfig.plugins.controls.height = opts['defaultcontrolsheight'];
				theconfig.plugins.controls.autoHide= false;
				theconfig.plugins.controls.playlist = true;
			}
			
			//without looking inside the playlist we don't know if the audios are flv or mp3.
			//here we assume that audio playlists are mp3. If not we need to remove the provider element
			if (opts['loop']=='true'){
				theconfig.clip.autoPlay=true;
			}else{
				theconfig.clip.autoPlay=false;
			}
			theconfig.clip.provider='audio';
			break;
		
		case "video":
			//theconfig.plugins.audio= null;
			
			if (opts['jscontrols']){
				theconfig.plugins.controls =null;
			}else{
				theconfig.plugins.controls.fullscreen = true;
				theconfig.plugins.controls.height = opts['defaultcontrolsheight'];
				theconfig.plugins.controls.autoHide= true;
			}
			//set the color to black on video screens
			theconfig.plugins.controls.backgroundColor = '#0';

			
			//If we have a splash screen show it and enable autoplay(user only clicks once)
			//best to have a splash screen to prevent browser hangs on many flashplayers in a forum etc
			if(opts['poodll_videosplash']){
				theconfig.clip.autoPlay=true;
				splash=true;
			}else{
				theconfig.clip.autoPlay=false;
			}
			break;
		
		case "videolist":
			theconfig.plugins.controls.fullscreen = false;
			theconfig.plugins.controls.height = opts['defaultcontrolsheight'];
			theconfig.plugins.controls.autoHide= true;
			theconfig.plugins.controls.playlist = true;
			theconfig.clip.autoPlay=false;
			//set the color to black on video screens
			theconfig.plugins.controls.backgroundColor = '#0';
			break;
		
	}
	
	
	//Get our element to replace
	var playerel= document.getElementById(opts['playerid']);
	if(!playerel){return;}
	
	//should there be a problem with standard embedding, we can try this simpler
	//way
	if(opts['embedtype']=='flashembed'){
       theconfig.clip.url= opts['path'];
		//we should not have to specify this, but we do ...?
		var uniqconfig = theconfig;
		if(splash){
			playerel.onclick = function() {
				flashembed(opts['playerid'], opts['playerpath'], {config: uniqconfig});
			}
		}else{
			flashembed(opts['playerid'], opts['playerpath'], {config: uniqconfig});
		}
		//console.log("flashembed embedded");
	
	//embed via swf object
	}else if(opts['embedtype']=='swfobject'){

       //we should not have to specify this, but we do ...?
       theconfig.clip.url= opts['path'];
       //we declare this here so that when called from click it refers to this config, and not a later one (object referecnes ...)
       var configstring=Y.JSON.stringify(theconfig);
	   //we need to convert double to single quotes, for IE's benefit
	   configstring= configstring.replace(/"/g,"'");
	   if(splash){
			//console.log("playerid:" + opts['playerid']);
			// get flash container and assign click handler for it
			playerel.onclick = function() {
				swfobject.embedSWF(opts['playerpath'],
						opts['playerid'], opts['width'], 
						opts['height'] , 
						"9.0.0", 
						null, 
						{config: configstring}
					);
			}
			
		}else{
			swfobject.embedSWF(opts['playerpath'],
    				opts['playerid'], opts['width'], 
    				opts['height'] , 
    				"9.0.0", 
    				null, 
    				{config: configstring}
    			);
		}

	
	//we default to flowplayer embed method
	}else{
	
		/* output the flowplayer */
		var playerid= opts['playerid'];		
		var playerpath = opts['playerpath'];
		$fp = flowplayer(playerid,playerpath,theconfig);
		//output any other bits and pieces required
		if(opts['controls']!="0"){$fp = $fp.controls(opts['controls']);}
		if(opts['ipad']){$fp=$fp.ipad();}
		if(opts['playlist']){$fp=$fp.playlist("div.poodllplaylist", {loop: opts["loop"]});}
	}

	//for debugging
//	console.log(theconfig);
}

// load drawingboard whiteboard for Moodle
M.filter_poodll.loaddrawingboard = function(Y,opts) {
	//stash our opts array
	M.filter_poodll.opts = opts;

		if(opts['bgimage'] ){
			var erasercolor = 'transparent';
		}else{
			var erasercolor = 'background';
			opts['bgimage'] = '#FFF';
		}

       // load the whiteboard and save the canvas reference
       var db = new DrawingBoard.Board('drawing-board-id',{
				size: 3,
				background: opts['bgimage'],
				controls: ['Color',
							{ Size: { type: 'auto' } },
							{ DrawingMode: { filler: false,eraser: false,pencil: false } },
							'Navigation'
						],
				webStorage: false,
				enlargeYourContainer: true,
				eraserColor: erasercolor
			});
			
			
		if(opts['autosave']){		
				//autosave, clear messages and save callbacks on start drawing
				db.ev.bind('board:startDrawing', function(e) {
						//kill all pending save timeouts
						stopSaveCountdown();
					});
					
				//autosave, clear previous callbacks,set new save callbacks on stop drawing
				db.ev.bind('board:stopDrawing', function(e) {
						startSaveCountdown();
					});
					
				//set up the upload/save button
			   var uploadbutton = $id('p_btn_upload_whiteboard');
				if(uploadbutton){
					uploadbutton.addEventListener("click", WhiteboardUploadHandler, false);
					M.filter_poodll.getwhiteboardcanvas = function(){ return db.canvas;};
				}
		
		}else{
			db.ev.bind('board:startDrawing', function(e) {
						 setUnsavedWarning();
			});
			
			//set up the upload/save button
		   var uploadbutton = $id('p_btn_upload_whiteboard');
			if(uploadbutton){
				uploadbutton.addEventListener("click", CallFileUpload, false);
				M.filter_poodll.getwhiteboardcanvas = function(){ return db.canvas;};
			}
		}
			
			
		
}

// handle literallycanvas whiteboard saves for Moodle
M.filter_poodll.loadliterallycanvas = function(Y,opts) {
	//stash our opts array
	M.filter_poodll.opts = opts;

		// disable scrolling on touch devices so we can actually draw
		/*
        $(document).bind('touchmove', function(e) {
          if (e.target === document.documentElement) {
            return e.preventDefault();
          }
        });
        */
        

        // load the whiteboard and save the canvas reference
    	//logic a bit diff if we have a background image
    	if(opts['bgimage']){
    		var bgimg = new Image();
			bgimg.src = opts['bgimage'];
		}else{
			var bgimg = null;
		}
		
		//init the whiteboard	
		var lc =  $('.literally').literallycanvas({imageURLPrefix: opts['imageurlprefix'], 
		backgroundColor: 'whiteSmoke', 
		watermarkImage: bgimg,
		 onInit: function(lc) {
				M.filter_poodll.getwhiteboardcanvas = function(){ return lc.canvasForExport();};
				if(opts['autosave']){
					lc.on('drawStart',stopSaveCountdown);
					lc.on('drawingChange',startSaveCountdown);
				}else{
					lc.on('drawingChange',setUnsavedWarning);
				}
			}
		});

	//set up the upload/save button
	var uploadbutton = $id('p_btn_upload_whiteboard');
	if(uploadbutton){
		if(opts['autosave']){
			uploadbutton.addEventListener("click", WhiteboardUploadHandler, false);
		}else{
			uploadbutton.addEventListener("click", CallFileUpload, false);
		}
	}
	
}

	function setUnsavedWarning(){
		var m = $id('p_messages');
		if(m){
			m.innerHTML = 'File has not been saved.';
		}
	}
	
	function stopSaveCountdown(){
		// update messages
		var m = $id('p_messages');
		if(m){
			m.innerHTML = 'File has not been saved.';
		
			var savebutton = $id('p_btn_upload_whiteboard');
			savebutton.disabled=false;
		
			clearTimeout(M.filter_poodll.timeouthandle);
		}
	
	}
	
	function startSaveCountdown(){
		// we use the presence of p_messages to check if this is a 
		//submittable whiteboard, or just a static one.
		var m = $id('p_messages');
		if(m){
			clearTimeout(M.filter_poodll.timeouthandle);
			M.filter_poodll.timeouthandle = setTimeout(WhiteboardUploadHandler,M.filter_poodll.opts['autosave']);
		}
	}

/*
	 * Image methods: To download an image to desktop
	 */
	function getCanvasBackgroundImage() {
		var cvs = M.filter_poodll.getwhiteboardcanvas();
		return cvs.toDataURL("image/png");
	}

	function downloadCanvasBackgroundImage() {
		var img = this.getImg();
		img = img.replace("image/png", "image/octet-stream");
		window.location.href = img;
	}


// Call Upload file from literallycanvas, 
function WhiteboardUploadHandlerLC(e) {
		//clear the saved message
		setTimeout(function(){
			Output('')
		},3000);
		//call the file upload
		CallFileUpload(e);
}//end of WhiteboardUploadHandler

// Call Upload file from drawingboard a, first handle autosave bits and pieces
function WhiteboardUploadHandler(e) {
		// Save button disabling a little risky db perm. fails publish "startdrawing" after mode change
		var savebutton = $id('p_btn_upload_whiteboard');
		savebutton.disabled=true;
		clearTimeout(M.filter_poodll.timeouthandle);
		//call the file upload
		CallFileUpload(e);

}//end of WhiteboardUploadHandler

// Cal Upload file from whiteboard canvas
function CallFileUpload(e) {
		var cvs = M.filter_poodll.getwhiteboardcanvas();
		var filedata =  cvs.toDataURL().split(',')[1];
		var file = {type:  'image/png'};
		UploadFile(file, filedata,M.filter_poodll.opts);
}//end of WhiteboardUploadHandler

// handle audio/video/image file uploads for Mobile
M.filter_poodll.loadmobileupload = function(Y,opts) {
	
	//stash our opts array
	M.filter_poodll.opts = opts;

	var fileselect = $id('poodllfileselect');
	if(fileselect){
		fileselect.addEventListener("change", function(theopts) {
				return function(e) {FileSelectHandler(e, theopts); };
				} (opts) , false);
	}
}

	// file selection
	function FileSelectHandler(e,opts) {

		// fetch FileList object
		var files = e.target.files || e.dataTransfer.files;

		// process all File objects
		for (var i = 0, f; f = files[i]; i++) {
			ParseFile(f,opts);
			//UploadFile(f);
		}

	}//end of FileSelectHandler
	
	// output file information
	function ParseFile(file,opts) {
			
			// start upload
			var filedata ="";
			var reader = new FileReader();
			//reader.onloadend = UploadFile;
			reader.onloadend = function(e) {
						filedata = e.target.result;
						UploadFile(file, filedata, opts);
			}
			reader.readAsDataURL(file);

	}//end of ParseFile


// output information
	function Output(msg) {
		var m = $id('p_messages');
		//m.innerHTML = msg + m.innerHTML;
		m.innerHTML = msg;
	}
	
	// getElementById
	function $id(id) {
		return document.getElementById(id);
	}
	// getElementById
	function $parentid(id) {
		return parent.document.getElementById(id);
	}

	// upload Media files
	function UploadFile(file, filedata,opts) {


		var xhr = new XMLHttpRequest();
		//if (xhr.upload && file.type == "image/jpeg" && file.size <= $id("MAX_FILE_SIZE").value) {

		//Might need more mimetypes than this, and 3gpp maynot work
		var ext="";
		switch(file.type){
			case "image/jpeg": ext = "jpg";break;
			case "image/png": ext = "png";break;
			case "video/quicktime": ext = "mov";break;
			case "audio/mpeg3": ext = "mp3";break;
			case "audio/x-mpeg-3": ext = "mp3";break;
			case "audio/mpeg3": ext = "mp3";break;
			case "audio/3gpp": ext = "3gpp";break;
			case "video/mpeg3": ext = "3gpp";break;
			case "video/mp4": ext = "mp4";break;	
		}
		
		if(true){
			// create progress bar if we have a container for it
			var o = $id("p_progress");
			if(o!=null){
				var progress = o.firstChild;
				if(progress==null){
					progress = o.appendChild(document.createElement("p"));
				}
				//reset/set background position to 0, and label to "uploading
				progress.className="";
				progress.style.display = "block";
				progress.style.backgroundPosition = "100% 0";
				
				// progress bar
				xhr.upload.addEventListener("progress", function(e) {
					var pc = parseInt(100 - (e.loaded / e.total * 100));
					progress.style.backgroundPosition = pc + "% 0";
				}, false);
			}else{
				var progress=false;
			}
			Output("Uploading.");


			// file received/failed
			xhr.onreadystatechange = function(e) {
				
				if (xhr.readyState == 4 ) {
					if(progress){
						progress.className = (xhr.status == 200 ? "success" : "failure");
					}
					if(xhr.status==200){
						var resp = xhr.responseText;
						var start= resp.indexOf("success<error>");
						if (start<1){return;}
						var end = resp.indexOf("</error>");
						var filename= resp.substring(start+14,end);
						
						//invoke callbackjs if we have one, otherwise just update the control(default behav.)
						if(opts['callbackjs'] && opts['callbackjs']!=''){ 
							var callbackargs  = new Array();
							callbackargs[0]=opts['recorderid'];
							callbackargs[1]='filesubmitted';
							callbackargs[2]=filename;
							callbackargs[3]=opts['updatecontrol'];
							//window[opts['callbackjs']](callbackargs);
							Output("File saved successfully.");
							M.filter_poodll.executeFunctionByName(opts['callbackjs'],window,callbackargs);
							
						}else{
							Output("File saved successfully.");
							var upc = $id($id("p_updatecontrol").value);
							if(!upc){upc = $parentid($id("p_updatecontrol").value);}
							upc.value=filename;
						}
					}else{
						Output("File could not be uploaded.");
					}
				}
			};

			var params = "datatype=uploadfile";
			//We must URI encode the base64 filedata, because otherwise the "+" characters get turned into spaces
			//spent hours tracking that down ...justin 20121012
			params += "&paramone=" + encodeURIComponent(filedata);
			params += "&paramtwo=" + ext;
			params += "&paramthree=" + $id("p_mediatype").value;
			params += "&requestid=12345";
			params += "&contextid=" + $id("p_contextid").value;
			params += "&component=" + $id("p_component").value;
			params += "&filearea=" + $id("p_filearea").value;
			params += "&itemid=" + $id("p_itemid").value;
			
			
			xhr.open("POST", $id("p_fileliburl").value, true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.setRequestHeader("Cache-Control", "no-cache");
			xhr.setRequestHeader("Content-length", params.length);
			xhr.setRequestHeader("Connection", "close");

			xhr.send(params);
			

		}

	}//end of upload file
	
//function to call the callback function with arguments	
M.filter_poodll.executeFunctionByName = function(functionName, context , args ) {
  //var args = Array.prototype.slice.call(arguments).splice(2);
  var namespaces = functionName.split(".");
  var func = namespaces.pop();
  for(var i = 0; i < namespaces.length; i++) {
    context = context[namespaces[i]];
  }
  return context[func].call(this, args);
}
	
	
	//===============================
	// Start of text scroller
M.filter_poodll.loadscroller = function(Y,opts) {
	
	if(typeof window.scrollopts== 'undefined'){
			window.scrollopts = new Array();
		}
	window.scrollopts[opts['scrollerid']] = opts;
}
	 
	function KickOff(scrollerid){
		if(typeof AreaHeight == 'undefined'){
			AreaHeight = new Array();
			AreaWidth = new Array();
		}
		AreaHeight[scrollerid]=dataobj[scrollerid].offsetHeight;
		AreaWidth[scrollerid]=dataobj[scrollerid].offsetWidth;
		
		if(scrollopts[scrollerid]['axis']=="y"){
			DoScrollAxisY(scrollerid);
		}else{
			DoScrollAxisX(scrollerid);
		}
	
	}
	 
	function ScrollBoxStart(scrollerid){
		if(typeof dataobj == 'undefined'){
			dataobj = new Array();
		}
		dataobj[scrollerid]= document.getElementById("p_scrollbox" + scrollerid );
		dataobj[scrollerid].style.top=scrollopts[scrollerid]['topspace'];
		dataobj[scrollerid].style.left=scrollopts[scrollerid]['leftspace'];
		var startbutton = document.getElementById("p_scrollstartbutton" + scrollerid );
		startbutton.style.display='none';
		KickOff(scrollerid);

	}
	 
	function DoScrollAxisY(scrollerid){
		var scroller = dataobj[scrollerid];
		var opts = scrollopts[scrollerid];
		scroller.style.top=(parseInt(scroller.style.top)- opts['pixelshift']) + "px";
		if (parseInt(scroller.style.top)<AreaHeight[scrollerid]*(-1)) {
			scroller.style.top=opts['framesize'];
			if(opts['repeat']=='yes'){
				var startbutton = document.getElementById("p_scrollstartbutton" + scrollerid );
				startbutton.style.display='';
			}
		}else {
			//setTimeout("DoScrollAxisY()",scrollopts['scrollspeed']);
			setTimeout(function() {DoScrollAxisY(scrollerid);},opts['scrollspeed']);
		}
	}
	
	function DoScrollAxisX(scrollerid){
		var scroller = dataobj[scrollerid];
		var opts = scrollopts[scrollerid];
		scroller.style.left=(parseInt(scroller.style.left)- opts['pixelshift']) + "px";
		if (parseInt(scroller.style.left)<AreaWidth[scrollerid]*(-1)) {
			scroller.style.left=opts['framesize'];
			if(opts['repeat']=='yes'){
				var startbutton = document.getElementById("p_scrollstartbutton" + scrollerid);
				startbutton.style.display='';
			}
		}else {
			//setTimeout("DoScrollAxisX()",scrollopts['scrollspeed']);
			setTimeout(function() {DoScrollAxisX(scrollerid);},opts['scrollspeed']);
		}
	}
	 
 
