/*if (!window.jQuery) {
  var jq = document.createElement('script'); 
  jq.type = 'text/javascript';
  // Path to jquery.js file, eg. Google hosted version
  jq.src = 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js';
  //jq.src="http://localhost/astarServe/as/clientAPI/jquery-1.11.3.min.js";
  document.getElementsByTagName('head')[0].appendChild(jq);
  
  jq.src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js';
  document.getElementsByTagName('head')[0].appendChild(jq);
}*/
    
var astarserve_namesp = {}; 
astarserve_namesp.lib_loaded;
astarserve_namesp.elements;
astarserve_namesp.all_seen;
//public urls and other
//astarserve_namesp.request_banner_url="http://localhost/astarserve/as/index.php/azadtest/process_banner_request";
//astarserve_namesp.click_process_url = "http://localhost/astarserve/as/index.php/azadtest/process_click_request";
//astarserve_namesp.impression_process_url = "http://localhost/astarserve/as/index.php/azadtest/process_impression_request";
//astarserve_namesp.load_process_url = "http://localhost/astarserve/as/index.php/azadtest/process_load_request";


//astarserve_namesp.request_banner_url="http://localhost/astarserve/as/index.php/ServiceController/process_banner_request";
//astarserve_namesp.click_process_url = "http://localhost/astarserve/as/index.php/ServiceController/process_click_request";
//astarserve_namesp.impression_process_url = "http://localhost/astarserve/as/index.php/ServiceController/process_impression_request";
//astarserve_namesp.load_process_url = "http://localhost/astarserve/as/index.php/ServiceController/process_load_request";

astarserve_namesp.request_banner_url="http://mdataroom.com/adserver/as/index.php/ServiceController/process_banner_request";
astarserve_namesp.click_process_url = "http://mdataroom.com/adserver/as/index.php/ServiceController/process_click_request";
astarserve_namesp.impression_process_url = "http://mdataroom.com/adserver/as/index.php/ServiceController/process_impression_request";
astarserve_namesp.load_process_url = "http://mdataroom.com/adserver/as/index.php/ServiceController/process_load_request";



astarserve_namesp.client_IP = "0.0.0.0";
astarserve_namesp.class_name=".astar_serve";
//utility functions

astarserve_namesp.mobileCheck = function() 
{
  var check = false;
  (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true;})(navigator.userAgent||navigator.vendor||window.opera);
  return check;
};

astarserve_namesp.getDeviceType = function()
{
    if(astarserve_namesp.mobileCheck() == true)
    {
        return 1;
        //alert('mobile');
    }
    return  0;


}

astarserve_namesp.browserInfo=  function() {
    {
        var unknown = '-';

        // screen
        var myWidth = 0, myHeight = 0;
        if( typeof( window.innerWidth ) == 'number' ) {
          //Non-IE
          myWidth = window.innerWidth;
          myHeight = window.innerHeight;
        } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
          //IE 6+ in 'standards compliant mode'
          myWidth = document.documentElement.clientWidth;
          myHeight = document.documentElement.clientHeight;
        } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
          //IE 4 compatible
          myWidth = document.body.clientWidth;
          myHeight = document.body.clientHeight;
        }
        // browser
        var nVer = navigator.appVersion;
        var nAgt = navigator.userAgent;
        var browser = navigator.appName;
        var version = '' + parseFloat(navigator.appVersion);
        var nameOffset, verOffset, ix;

        // Opera
        if ((verOffset = nAgt.indexOf('Opera')) != -1) {
            browser = 'Opera';
            version = nAgt.substring(verOffset + 6);
            if ((verOffset = nAgt.indexOf('Version')) != -1) {
                version = nAgt.substring(verOffset + 8);
            }
        }
        // Opera Next
        if ((verOffset = nAgt.indexOf('OPR')) != -1) {
            browser = 'Opera';
            version = nAgt.substring(verOffset + 4);
        }
        // MSIE
        else if ((verOffset = nAgt.indexOf('MSIE')) != -1) {
            browser = 'Microsoft Internet Explorer';
            version = nAgt.substring(verOffset + 5);
        }
        // Chrome
        else if ((verOffset = nAgt.indexOf('Chrome')) != -1) {
            browser = 'Chrome';
            version = nAgt.substring(verOffset + 7);
        }
        // Safari
        else if ((verOffset = nAgt.indexOf('Safari')) != -1) {
            browser = 'Safari';
            version = nAgt.substring(verOffset + 7);
            if ((verOffset = nAgt.indexOf('Version')) != -1) {
                version = nAgt.substring(verOffset + 8);
            }
        }
        // Firefox
        else if ((verOffset = nAgt.indexOf('Firefox')) != -1) {
            browser = 'Firefox';
            version = nAgt.substring(verOffset + 8);
        }
        // MSIE 11+
        else if (nAgt.indexOf('Trident/') != -1) {
            browser = 'Microsoft Internet Explorer';
            version = nAgt.substring(nAgt.indexOf('rv:') + 3);
        }
        // Other browsers
        else if ((nameOffset = nAgt.lastIndexOf(' ') + 1) < (verOffset = nAgt.lastIndexOf('/'))) {
            browser = nAgt.substring(nameOffset, verOffset);
            version = nAgt.substring(verOffset + 1);
            if (browser.toLowerCase() == browser.toUpperCase()) {
                browser = navigator.appName;
            }
        }
        // trim the version string
        if ((ix = version.indexOf(';')) != -1) version = version.substring(0, ix);
        if ((ix = version.indexOf(' ')) != -1) version = version.substring(0, ix);
        if ((ix = version.indexOf(')')) != -1) version = version.substring(0, ix);

        
        // cookie
        var cookieEnabled = (navigator.cookieEnabled) ? true : false;

        if (typeof navigator.cookieEnabled == 'undefined' && !cookieEnabled) {
            document.cookie = 'testcookieastar';
            cookieEnabled = (document.cookie.indexOf('testcookieastar') != -1) ? true : false;
        }

        // system
        var os = unknown;
        var clientStrings = [
            {s:'Windows 10', r:/(Windows 10.0|Windows NT 10.0)/},
            {s:'Windows 8.1', r:/(Windows 8.1|Windows NT 6.3)/},
            {s:'Windows 8', r:/(Windows 8|Windows NT 6.2)/},
            {s:'Windows 7', r:/(Windows 7|Windows NT 6.1)/},
            {s:'Windows Vista', r:/Windows NT 6.0/},
            {s:'Windows Server 2003', r:/Windows NT 5.2/},
            {s:'Windows XP', r:/(Windows NT 5.1|Windows XP)/},
            {s:'Windows 2000', r:/(Windows NT 5.0|Windows 2000)/},
            {s:'Windows ME', r:/(Win 9x 4.90|Windows ME)/},
            {s:'Windows 98', r:/(Windows 98|Win98)/},
            {s:'Windows 95', r:/(Windows 95|Win95|Windows_95)/},
            {s:'Windows NT 4.0', r:/(Windows NT 4.0|WinNT4.0|WinNT|Windows NT)/},
            {s:'Windows CE', r:/Windows CE/},
            {s:'Windows 3.11', r:/Win16/},
            {s:'Android', r:/Android/},
            {s:'Open BSD', r:/OpenBSD/},
            {s:'Sun OS', r:/SunOS/},
            {s:'Linux', r:/(Linux|X11)/},
            {s:'iOS', r:/(iPhone|iPad|iPod)/},
            {s:'Mac OS X', r:/Mac OS X/},
            {s:'Mac OS', r:/(MacPPC|MacIntel|Mac_PowerPC|Macintosh)/},
            {s:'QNX', r:/QNX/},
            {s:'UNIX', r:/UNIX/},
            {s:'BeOS', r:/BeOS/},
            {s:'OS/2', r:/OS\/2/},
            {s:'Search Bot', r:/(nuhk|Googlebot|Yammybot|Openbot|Slurp|MSNBot|Ask Jeeves\/Teoma|ia_archiver)/}
        ];
        
        for (var id in clientStrings) {
            var cs = clientStrings[id];
            if (cs.r.test(nAgt)) {
                os = cs.s;
                break;
            }
        }

        var osVersion = unknown;

        if (/Windows/.test(os)) {
            osVersion = /Windows (.*)/.exec(os)[1];
            os = 'Windows';
        }

        switch (os) {
            case 'Mac OS X':
                osVersion = /Mac OS X (10[\.\_\d]+)/.exec(nAgt)[1];
                break;

            case 'Android':
                osVersion = /Android ([\.\_\d]+)/.exec(nAgt)[1];
                break;

            case 'iOS':
                osVersion = /OS (\d+)_(\d+)_?(\d+)?/.exec(nVer);
                osVersion = osVersion[1] + '.' + osVersion[2] + '.' + (osVersion[3] | 0);
                break;
        }
        
        
    }

    var ret = {
        width: myWidth,
        height:myHeight,
        browser: browser,
        browserVersion: version,
        os: os,
        osVersion: osVersion,
        cookies: cookieEnabled
    };
    return ret;
};

astarserve_namesp.addBrowserInfo = function(jsonData)
{
    var browser_data = astarserve_namesp.browserInfo();
    jsonData["browser_width" ]= browser_data.width;
    jsonData["browser_height" ]= browser_data.height;
    jsonData["browser_name" ]= browser_data.browser;
    jsonData["browser_version" ]= browser_data.browserVersion;
    jsonData["browser_language" ]= navigator.language;
    jsonData["os_name" ]= browser_data.os;
    jsonData["os_version" ]= browser_data.osVersion;     
    jsonData["cookie_enabled" ]= browser_data.cookies;
    jsonData["full_user_agent" ]= navigator.userAgent;
  
    //var ci_session_data = $.cookie("ci_session");
    //jsonData["session_id" ] = ci_session_data;
  
//    alert($.cookie("ci_session"));
    return jsonData;

};

//end utility functions


astarserve_namesp.logic_for_seen = function()
{
 
    window.setInterval(function(){
        astarserve_namesp.checkIfSeen();
  }, 500);

    
};

astarserve_namesp.checkIfSeen = function()
{
    if(astarserve_namesp.all_seen===true)return;
    var placement_seen_map = $.cookie("placement_seen_map");
    placement_seen_map = $.parseJSON(placement_seen_map);
    var remaining = 0;
    for(var i=0;i<astarserve_namesp.elements.length;i++)
    {
        //alert("Lupin");
        var placement_id = astarserve_namesp.elements[i].id;
        if(placement_seen_map[placement_id]===true)continue;
        remaining++;
        var viewport_width = $(window).width();
        var viewport_height = $(window).height(); // DOCTYPE Must be declared !!!!
        var elem = document.getElementById(placement_id);
        var rect = elem.getBoundingClientRect();

        var covered_width = Math.min(rect.right, viewport_width) - Math.max(0, rect.left);
        if(covered_width<=0) continue;
        var covered_height = Math.min(rect.bottom, viewport_height) - Math.max(rect.top, 0); 
        if(covered_height<=0) continue;
        var covered_area =  covered_height*covered_width;

        var content_width = $("#"+placement_id).width();
        var content_height = $("#"+placement_id).height();
        var content_area = content_width*content_height;

        var percentage_covered = (covered_area)*100/content_area;    
        //alert(placement_id+ " " + rect.top+ " " +rect.bottom + " "+ + viewport_height+ " " +viewport_width+" "
        //       + content_area+" "+covered_area+" "+percentage_covered);

        if(percentage_covered>50)//seen
        {
            remaining--;
            placement_seen_map[placement_id] = true;
            $.cookie("placement_seen_map", JSON.stringify(placement_seen_map));

            //make call to server for impression
            var sdata = {};
            var placement_banner_map = $.cookie("placement_banner_map");
            placement_banner_map = $.parseJSON(placement_banner_map);
            var banner_id = placement_banner_map[placement_id];

            sdata["placement_id"] = placement_id;
            sdata["banner_id"] = banner_id;
            sdata["uuid"] = astarserve_namesp.getUUID();
            sdata["device_type"] = astarserve_namesp.getDeviceType();
            //sdata["cookie_age"] = astarserve_namesp.getCookieAge();          
            //alert("Clicked: "+ JSON.stringify(sdata));

            //var url="http://localhost/astarserve/as/index.php/ServiceController/process_click_request";

            sdata = astarserve_namesp.addBrowserInfo(sdata);
            $.ajax({
              type: "POST",
              url: astarserve_namesp.impression_process_url,
              data: sdata,
              dataType: "json",              
            });
            //alert("Seen "+placement_id);

        }

    }        
    if(remaining===0) astarserve_namesp.all_seen = true;
    //alert(remaining+" "+astarserve_namesp.all_seen);
    //$("#msg").html( remaining+ " " +JSON.stringify(placement_seen_map));

}
astarserve_namesp.handleClick = function(element) 
{
    while(element.id=='')element = element.parentNode;
    var id = element.id;
    //var msg = 'click';
    //msg+= ' '+id;
    var placement_banner_map = $.cookie("placement_banner_map");
    placement_banner_map = $.parseJSON(placement_banner_map);
    var banner_id = placement_banner_map[id];
    //msg += ' ' + banner_id;
    
    var sdata = {};
    sdata["placement_id"] = id;
    sdata["banner_id"] = banner_id;
    sdata["uuid"] = astarserve_namesp.getUUID();    
    sdata["device_type"] = astarserve_namesp.getDeviceType();
    //sdata["cookie_age"] = astarserve_namesp.getCookieAge();
    sdata  = astarserve_namesp.addBrowserInfo(sdata);

    //alert("Clicked: "+ JSON.stringify(sdata));
    
    //var url="http://localhost/astarserve/as/index.php/ServiceController/process_click_request";
        
    $.ajax({
      type: "POST",
      url: astarserve_namesp.click_process_url,
      data: sdata,
      dataType: "json"
    });
    
    //$('#msg').html(JSON.stringify(sdata));
};

astarserve_namesp.addHandlerForClick = function()
{
    var elements = $(astarserve_namesp.class_name);

    elements.click( function(e)
        {
            //alert(e.target);
            astarserve_namesp.handleClick(e.target);
        }
    );
      
};





/*
function updateCookie()
{
    var cookieData = $.cookie("astarserve");
    cookieData = $.parseJSON(cookieData);
    
   
    //alert(JSON.stringify(cookieData));    
    $.cookie("astarserve", JSON.stringify(cookieData), {expires: 1});     
}

function createCookie()
{
    $.cookie("astarserve", JSON.stringify({}), {expires: 1});    
}

*/

astarserve_namesp.sendBannerLoadNotification = function(placement_id, banner_id)
{
    var sdata = {};
    sdata["placement_id"] = placement_id;
    sdata["banner_id"] = banner_id;
    sdata["uuid"] = astarserve_namesp.getUUID();
    sdata["device_type"] = astarserve_namesp.getDeviceType();
    //sdata["cookie_age"] = astarserve_namesp.getCookieAge();
    sdata = astarserve_namesp.addBrowserInfo(sdata);
    

    //alert("Clicked: "+ JSON.stringify(sdata));

    //var url="http://localhost/astarserve/as/index.php/ServiceController/process_click_request";

    $.ajax({
      type: "POST",
      url: astarserve_namesp.load_process_url,
      data: sdata,
      dataType: "json"
    });    
};

astarserve_namesp.handleBannerRequestResponse = function(elements, responseData)
{
        
    var placement_banner_map={};
    var placement_seen_map={}; // keeps track of which placements/ads are already viewed
    astarserve_namesp.all_seen = false;
    astarserve_namesp.elements = elements; 
    for(var i=0;i<elements.length;i++)
    {
        var element=elements[i];
        var id=element.id;
        var content_url =  responseData[id]['content_url'];
        var caption = responseData[id]['caption'];
        var target_url = responseData[id]['target_url'];
        var type = responseData[id]['type'];
        var banner_id = responseData[id]['banner_id'];
        var content_width = responseData[id]['content_width'];
        var content_height = responseData[id]['content_height'];
        var placement_width = responseData[id]['placement_width'];
        var placement_height = responseData[id]['placement_height'];
        
        if(i===0)
        {
            var uuid = responseData[id]['uuid'];
            astarserve_namesp.setUUID(uuid);
        }
        
        var element = $("#"+id);        
        placement_banner_map[id] = banner_id;     
        placement_seen_map[id] = false;
        
        //alert("placing: " +banner_id);
        element.height(placement_height);
        element.width(placement_width);
        
        //alert(width+" "+height);
        if(type == 1) // image
        {    
            var contentTag = "<img width=\""+ placement_width +"\" height=\""+ placement_height+"\" src=\""+ content_url+"\" alt= \""+caption+"\"></img>";
            var urlTag =  "<a target=\"blank\"href=\""+target_url+"\">"+ contentTag +"</a>";
            element.html(urlTag);
        }
        else if(type == 2) //flash
        {
            var htmltag = '<div style="position:absolute;">';
            htmltag += '<div style="position:absolute;">';
	    htmltag += '<a href="'+ target_url +'" target="_blank"><img src="http://localhost/astarserve/_FILES/Transparent.gif" width="'+placement_width+'" height="'+placement_height+'"></a>'
            htmltag += '</div><div>';	
            htmltag += '<object type="application/x-shockwave-flash" data="'+ content_url +'" width="'+placement_width+'" height="'+placement_height+'">';
	    htmltag += '<param name="flashvars" value="clickTag=&clickTarget=_self" />';
            htmltag += '<param name="allowScriptAccess" value="always" />';
	    htmltag += '<param name="movie" value="'+ content_url +'" />';
            htmltag += '<param name="wmode" value="transparent">';
            htmltag += '</object>';
            htmltag += '</div>';
            element.html(htmltag);

        }
        else if(type==3) //html5
        {
            var htmltag="";
            htmltag +='<a href="'+target_url+'" target="_blank" scrolling="no" style="position:relative; display:inline-block; color:white;">';        
            //For testing, overlay with color: htmltag +='<div class="blocker" style="position:absolute; height:100%; width:100%; z-index:1; background:rgba(255,0,0,0.5);"></div>';
            htmltag +='<div style="position:absolute; height:100%; width:100%; z-index:2;"></div>';
            htmltag += '<iframe src="'+ content_url +'"';
            htmltag += 'width="' +placement_width+ '"' ; 
            htmltag += 'height="' +placement_height+ '"' ;
            htmltag +=  'style="z-index:1;"';
            htmltag += '>';
            htmltag += '<p>Your browser does not support iframes.</p></iframe>';
            htmltag += '</a>';
            element.html(htmltag);
        }
            
        astarserve_namesp.sendBannerLoadNotification(id,banner_id);            
    }
    
//    alert(JSON.stringify(placement_seen_map));
    $.cookie("placement_banner_map", JSON.stringify(placement_banner_map));
    $.cookie("placement_seen_map", JSON.stringify(placement_seen_map));
    //update cookie
    //updateCookie();
    //sendImpressionRequest(elements,responseData);
    
    //var uuid  = 
    astarserve_namesp.addHandlerForClick();
    astarserve_namesp.logic_for_seen();  

};

astarserve_namesp.getCookieAge = function()
{
    //var cct = $.cookie("astar_cct") ;
    //if(cct===undefined) 
    //{
        cct = jQuery.now();
        //$.cookie("astar_cct",cct);
//        $cookie("astar_cct")
    //}
    
//    alert(($.now()-cct)/1000);
    //return (jQuery.now()-cct);

};

astarserve_namesp.requestBanner = function()
{   
   astarserve_namesp.lib_loaded = true; 
   
   var elements=$(astarserve_namesp.class_name);
   var jsonData=astarserve_namesp.buildJSONDataForBannerRequest(elements);
   
   jsonData = astarserve_namesp.addBrowserInfo(jsonData);
   //alert("SENDING BANNER REQUEST");
   $.ajax({
      type: "POST",
      url: astarserve_namesp.request_banner_url,
      data: jsonData,
      success: function(data) 
      {
        astarserve_namesp.handleBannerRequestResponse(elements,data);
      },
      dataType: "json"
    });
};


astarserve_namesp.buildJSONDataForBannerRequest = function(elements)
{
//    $.get('http://jsonip.com/', function(r){ $IP = r.ip; });
    
/*    $.ajax({
    url:   "http://jsonip.com/",
    success: function(r){ astarserve_namesp.client_IP = r.ip; },
    async: false // set to false for asynchronous call 
    //timeout: 200
    });
*/    
//    alert(astarserve_namesp.client_IP);
    
    jsonObj={};    
    jsonObj["id_info"] = [];
    
    for(var i=0;i<elements.length;i++)
    {
        var element=elements[i];
        var id=element.id;
       
        var id_info_tuple = {};
        var info = [];
        
        id_info_tuple["placement_id"] = id;
        id_info_tuple["info"] = info;
        jsonObj["id_info"].push(id_info_tuple);      
    }
    //dummy now
    jsonObj["IP"]=astarserve_namesp.client_IP;
    
    jsonObj["device_type"] = astarserve_namesp.getDeviceType();
    //jsonObj["cookie_age"] = astarserve_namesp.getCookieAge();
    
    //alert(JSON.stringify(jsonObj));
    
    //alert(uuid);
    jsonObj["uuid"] = astarserve_namesp.getUUID(); 
    
    return jsonObj;
};

astarserve_namesp.getUUID = function()
{
    var uuid = $.cookie("uuid");
    if(uuid===undefined) uuid=null;
    return uuid;
}

astarserve_namesp.setUUID = function(uuid)
{
    $.cookie("uuid",uuid);
}

astarserve_namesp.entry_point = function()
{
    
    jQuery.support.cors = true;
    
    $( document ).ready(function() 
    {
//        alert(astarserve_namesp.browserInfo());
        /*
        if ($.cookie("astarserve") == null )
        {
            createCookie();
        }
        */
        //alert(astarserve_namesp.lib_loaded);
        if(astarserve_namesp.lib_loaded == true) return;
        
    
        astarserve_namesp.requestBanner();  //handleRequest()  is renamed to requestBanner
    });
}

function addLoadEvent(func) { 
      var oldonload = window.onload; 
      if (typeof window.onload != 'function') { 
        window.onload = func; 
      } else { 
        window.onload = function() { 
          if (oldonload) { 
            oldonload(); 
          } 
          func(); 
        } 
    } 
} 
addLoadEvent( function() {
    
    if(!window.jQuery){
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js';
        document.body.appendChild(script);
        
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js';
        document.body.appendChild(script);        
        script.onload=astarserve_namesp.entry_point;
        //jQuery();
    }
    else if(!$.cookie){
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js';
        document.body.appendChild(script);
        script.onload=astarserve_namesp.entry_point;
        
    }
    else
    {
        astarserve_namesp.entry_point();
    }
    
});



/*
if(!window.jQuery) 
{
    var jq = document.createElement('script');
    jq.type = 'text/javascript';
    jq.src = 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js';
    //jq.src="http://localhost/astarServe/as/clientAPI/jquery-1.11.3.min.js";
    document.getElementsByTagName('head')[0].appendChild(jq);
    jq = document.createElement('script');
    jq.type = 'text/javascript';
    jq.src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js';
    document.getElementsByTagName('head')[0].appendChild(jq);
    jq.onload=astarserve_namesp.entry_point;
}
else if(!$.cookie)
{
    var jq = document.createElement('script');
    jq.type = 'text/javascript';
    jq.src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js';
    document.getElementsByTagName('head')[0].appendChild(jq);
    jq.onload=astarserve_namesp.entry_point;
}

else
{
    astarserve_namesp.entry_point();
}

*/
