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
//astarserve_namesp.impression_process_url = "http://localhost/astarserve/as/index.php/ServiceController/process_impression_request";
//astarserve_namesp.load_process_url = "http://localhost/astarserve/as/index.php/ServiceController/process_load_request";


//astarserve_namesp.request_banner_url="http://localhost/astarserve/as/index.php/ServiceController/process_banner_request";
//astarserve_namesp.click_process_url = "http://localhost/astarserve/as/index.php/ServiceController/process_click_request";
//astarserve_namesp.impression_process_url = "http://localhost/astarserve/as/index.php/ServiceController/process_impression_request";
//astarserve_namesp.load_process_url = "http://localhost/astarserve/as/index.php/ServiceController/process_load_request";

//astarserve_namesp.request_banner_url="http://mdataroom.com/adserver/as/index.php/ServiceController/process_banner_request";
//astarserve_namesp.click_process_url = "http://mdataroom.com/adserver/as/index.php/ServiceController/process_click_request";
astarserve_namesp.impression_process_url = "http://mdataroom.com/adserver/as/index.php/ServiceController/process_impression_request";
astarserve_namesp.load_process_url = "http://mdataroom.com/adserver/as/index.php/ServiceController/process_load_request";



//astarserve_namesp.client_IP = "0.0.0.0";
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


astarserve_namesp.sendBannerLoadNotification = function()
{
    var sdata = {};
     var elements=$(astarserve_namesp.class_name);

   var elem = elements[0];
   
//    alert(elements.length+" "+ elem.id);
    sdata["placement_id"] = elem.id;
//    sdata["banner_id"] = banner_id;
//    sdata["uuid"] = astarserve_namesp.getUUID();
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


astarserve_namesp.entry_point = function()
{
   astarserve_namesp.lib_loaded = true;  
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
        
    });
}
/*
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
    astarserve_namesp.entry_point();

});
*/
astarserve_namesp.readyStateCheckInterval = setInterval(function() {
    if (document.readyState === "complete") {
        clearInterval(astarserve_namesp.readyStateCheckInterval);
        astarserve_namesp.sendBannerLoadNotification();
    }
}, 500);


$(document).ready(function (){
                
    $("#adserve_click" ).click(function() {

       var url=$(this).attr("href");
       //alert(url);

       var browser_data = astarserve_namesp.browserInfo();

       var extra=
                 "&browser_width="+browser_data.width+
                 "&browser_height="+browser_data.height+
                 "&browser_name="+browser_data.browser+
                 "&browser_version="+browser_data.browserVersion+
                 "&browser_language="+navigator.language+
                 "&os_name="+browser_data.os+
                 "&os_version="+browser_data.osVersion+
                 "&cookie_enabled="+browser_data.cookies+
                 "&full_user_agent="+navigator.userAgent;


      //  alert(extra);

        window.open(url+extra);


        return false;                    
     });                
 });