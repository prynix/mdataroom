var astarserve_namesp = {}; 
astarserve_namesp.lib_loaded;
astarserve_namesp.elements;
astarserve_namesp.all_seen;
astarserve_namesp.uuid;
astarserve_namesp.jq;
//public urls and other


//astarserve_namesp.impression_process_url = "http://localhost/astarserve/as/index.php/azadtest2/process_impression_request";
//astarserve_namesp.impression_process_url = "http://localhost/astarserve/as/index.php/ServiceController2/process_impression_request";
//astarserve_namesp.impression_process_url = "http://mdataroom.com/adserver/as/index.php/ServiceController2/process_impression_request";
astarserve_namesp.impression_process_url = "http://localhost/mdataroom.com/index.php/ServiceController2/process_impression_request";

astarserve_namesp.class_name=".ot_astar_serve";
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
  
    //var ci_session_data = astarserve_namesp.jq$.cookie("ci_session");
    //jsonData["session_id" ] = ci_session_data;
  
//    alert(astarserve_namesp.jq.cookie("ci_session"));
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
    var placement_seen_map = astarserve_namesp.jq.cookie("placement_seen_map");
    placement_seen_map = astarserve_namesp.jq.parseJSON(placement_seen_map);
    var placement_banner_map = astarserve_namesp.jq.cookie("placement_banner_map");
    placement_banner_map = astarserve_namesp.jq.parseJSON(placement_banner_map);
    
    var remaining = 0;
    for(var i=0;i<astarserve_namesp.elements.length;i++)
    {
        //alert("Lupin");
        var placement_id = astarserve_namesp.elements[i].id;
        
        var trimmed_placement_id = placement_id.substring(2,placement_id.length);
        if(placement_seen_map[placement_id]===true)continue;
        remaining++;
        
        if(placement_banner_map[trimmed_placement_id]===null)continue;
        //alert(trimmed_placement_id +" " +placement_banner_map[trimmed_placement_id]);

        var viewport_width = astarserve_namesp.jq(window).width();
        var viewport_height = astarserve_namesp.jq(window).height(); // DOCTYPE Must be declared !!!!
        var elem = document.getElementById(placement_id);
        var rect = elem.getBoundingClientRect();

        var covered_width = Math.min(rect.right, viewport_width) - Math.max(0, rect.left);
        if(covered_width<=0) continue;
        var covered_height = Math.min(rect.bottom, viewport_height) - Math.max(rect.top, 0); 
        if(covered_height<=0) continue;
        var covered_area =  covered_height*covered_width;

        var content_width = astarserve_namesp.jq("#"+placement_id).width();
        var content_height = astarserve_namesp.jq("#"+placement_id).height();
        var content_area = content_width*content_height;

        var percentage_covered = (covered_area)*100/content_area;    
        //alert(placement_id+ " " + rect.top+ " " +rect.bottom + " "+ + viewport_height+ " " +viewport_width+" "
        //       + content_area+" "+covered_area+" "+percentage_covered);

        if(percentage_covered>50)//seen
        {
            remaining--;
            placement_seen_map[placement_id] = true;
            astarserve_namesp.jq.cookie("placement_seen_map", JSON.stringify(placement_seen_map));

            //make call to server for impression
            var sdata = {};
            var banner_id = placement_banner_map[trimmed_placement_id];

           // alert(placement_id + " " + banner_id);
            sdata["placement_id"] = placement_id.substring(2,placement_id.length);
            sdata["banner_id"] = banner_id;
            sdata["uuid"] = astarserve_namesp.getUUID();
            sdata["device_type"] = astarserve_namesp.getDeviceType();
            //sdata["cookie_age"] = astarserve_namesp.getCookieAge();          
            //alert("Clicked: "+ JSON.stringify(sdata));

            //var url="http://localhost/astarserve/as/index.php/ServiceController/process_click_request";

            sdata = astarserve_namesp.addBrowserInfo(sdata);
            astarserve_namesp.jq.ajax({
              type: "POST",
              url: astarserve_namesp.impression_process_url,
              data: sdata,
              dataType: "json",              
            });
            //alert("Seen "+placement_id);

        }

    }        
    if(remaining===0) astarserve_namesp.all_seen = true;

}


//jquery here 
astarserve_namesp.initMaps = function()
{   
    var placement_banner_map={};
    var placement_seen_map={}; // keeps track of which placements/ads are already viewed
    astarserve_namesp.all_seen = false;
    astarserve_namesp.elements = astarserve_namesp.jq(astarserve_namesp.class_name);
    for(var i=0;i<astarserve_namesp.elements.length;i++)
    {
        var element=astarserve_namesp.elements[i];
        var id=element.id;
        id = id.substring(2,id.length);
        //alert(id);
        var banner_id = null;
        
        placement_banner_map[id] = banner_id;     
        placement_seen_map[id] = false;
        
    }

    astarserve_namesp.jq.cookie("placement_banner_map", JSON.stringify(placement_banner_map));
    astarserve_namesp.jq.cookie("placement_seen_map", JSON.stringify(placement_seen_map));
    
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


astarserve_namesp.getUUID = function()
{
    var uuid = astarserve_namesp.uuid;
    if(uuid===undefined) uuid=null;
    return uuid;
}


//done
astarserve_namesp.entry_point = function()
{
    
    jQuery.support.cors = true;
    astarserve_namesp.jq = $.noConflict();

    astarserve_namesp.jq( document ).ready(function() 
    {
        if(astarserve_namesp.lib_loaded === true) return;
        astarserve_namesp.lib_loaded = true; 

        astarserve_namesp.initMaps();
    });
}

astarserve_namesp.entry_point();
//done
window.addEventListener('message', function(event) 
{
    
    //alert('Received message: ' + event.data.pid + " "+ event.data.bid);
    var pid = event.data.pid;
    var bid = event.data.bid;
    astarserve_namesp.uuid = event.data.uuid;
    var placement_banner_map = astarserve_namesp.jq.cookie("placement_banner_map");
    placement_banner_map = astarserve_namesp.jq.parseJSON(placement_banner_map);
     
    //if(isset(placement_banner_map[pid]))
    {
        placement_banner_map[pid] = bid;
       // alert(pid + ' '+ placement_banner_map[pid]);
        astarserve_namesp.jq.cookie("placement_banner_map", JSON.stringify(placement_banner_map));

    }


  //   
    //GET UUID
}, false);