if (!window.jQuery) {
  var jq = document.createElement('script'); 
  jq.type = 'text/javascript';
  // Path to jquery.js file, eg. Google hosted version
  jq.src = 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js';
  //jq.src="http://localhost/astarServe/as/clientAPI/jquery-1.11.3.min.js";
  document.getElementsByTagName('head')[0].appendChild(jq);
  
  jq.src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js';
  document.getElementsByTagName('head')[0].appendChild(jq);
}

function handleClick(element) 
{
  
    while(element.id=='')element = element.parentNode;
    var id = element.id;
    var msg;
    if(event==1)msg = 'click';
    else msg = 'hover';
    msg+= ' '+id;
    $('#msg').html(msg);
}
function addHandlerForClick()
{
    var elements = $('.my_class');

    elements.click( function(e)
        {
            //alert(e.target);
            handleClick(e.target);
        }
    );
/*    elements.mouseover( function(e)
        {
            handleHoverClick(e.target, 0);
        }
    );
*/
}

function updateCookie()
{
    var cookieData = $.cookie("astarserve");
    cookieData = $.parseJSON(cookieData);
    
    
    
    alert(JSON.stringify(cookieData));    
    $.cookie("astarserve", JSON.stringify(cookieData), {expires: 1});     
}

function createCookie()
{
    var elements=$('.my_class');    
    jsonObj={};
    jsonObj["id_info"] = [];
    for(var i=0;i<elements.length;i++)
    {
        var element=elements[i];
        var id=element.id;
        
        var id_info_tuple = {};
        var info = [];
        
        //dummy_for_now
        var banner_count_tuple = {};
        info.push(banner_count_tuple);
       //info.push(banner_count_tuple);
       //dummy upto this
        id_info_tuple["placement_id"] = id;
        id_info_tuple["info"] = info;
        jsonObj["id_info"].push(id_info_tuple);
        
    }
     
    $jsonObj(); 
    $.cookie("astarserve", JSON.stringify(jsonObj), {expires: 1}); 
    
}

function handleResponse(elements, responseData)
{
  
    for(var i=0;i<elements.length;i++)
    {
        var element=elements[i];
        var id=element.id;
        var content_url =  responseData[id]['content_url'];
        var caption = responseData[id]['caption'];
        var target_url = responseData[id]['target_url'];
        var type = responseData[id]['type'];
        var urlTag = "";
        var contentTag = "";
        var element = $("#"+id);
        var width = element.width();
        var height = element.height();
        
        //alert(width+" "+height);
        if(type == 'image')
        {    
            contentTag = "<img width=\""+ width +"\" height=\""+ height+"\" src=\""+ content_url+"\" alt= \""+caption+"\"></img>";
            urlTag =  "<a target=\"blank\"href=\""+target_url+"\">"+ contentTag +"</a>";
            element.html(urlTag);
            
        }
        else if(type == 'flash')
        {
            var htmltag = '<div style="position:absolute;">';
            htmltag += '<div style="position:absolute;">';
	    htmltag += '<a href="'+ target_url +'" target="_blank"><img src="http://localhost/astarserve/_FILES/Transparent.gif" width="'+width+'" height="'+height+'"></a>'
            htmltag += '</div><div>';	
            htmltag += '<object type="application/x-shockwave-flash" data="'+ content_url +'" width="'+width+'" height="'+height+'">';
	    htmltag += '<param name="flashvars" value="clickTag=&clickTarget=_self" />';
            htmltag += '<param name="allowScriptAccess" value="always" />';
	    htmltag += '<param name="movie" value="'+ content_url +'" />';
            htmltag += '<param name="wmode" value="transparent">';
            htmltag += '</object>';
            htmltag += '</div>';
            element.html(htmltag);
        }
        
        //update cookie, with the id(placement_id) and 
    }
    
    //update cookie
    updateCookie();
    addHandlerForClick();
}



function requestImageByData(elements,jsonData)
{
    var url="http://localhost/astarserve/as/index.php/azadtest/process_request";

    $.ajax({
      type: "POST",
      url: url,
      data: jsonData,
      success: function(data) 
      {
        handleResponse(elements,data);
      },
      dataType: "json"
    });

}

function buildJSONData(elements)
{
    /*
    jsonObj={};
    
    
    jsonObj["id_info"] = [];
    
    for(var i=0;i<elements.length;i++)
    {
        var element=elements[i];
        var id=element.id;
        
        var id_info_tuple = {};
        var info = [];
        
        //dummy_for_now
        var banner_count_tuple = {};
        banner_count_tuple["banner_id"] = "bannerdummy1";
        banner_count_tuple["count"] = 5;
        info.push(banner_count_tuple);
        
        banner_count_tuple = {};
        banner_count_tuple["banner_id"] = "bannerdummy2";
        banner_count_tuple["count"] = 3;
        info.push(banner_count_tuple);
       //dummy upto this
        
        id_info_tuple["placement_id"] = id;
        id_info_tuple["info"] = info;
        jsonObj["id_info"].push(id_info_tuple);
        
//        item={};
//        item ["id"] = id;
//        jsonObj["ids"].push(item);
    }
    */
    //dummy now
    //jsonObj["IP"]="192.168.0.0";

    jsonObj  = $.parseJSON($.cookie("astarserve"));
    //alert(JSON.stringify(jsonObj));
    return jsonObj;
}

function handleRequest()
{   
   var elements=$('.my_class');
   var jsonData=buildJSONData(elements);
   requestImageByData(elements,jsonData);
}

function handleImpression()
{
    alert("I AM FUCKING READY!!!");
}

$( document ).ready(function() 
{
    if ($.cookie("astarserve") == null )
    {
        createCookie();
    }
    handleRequest();
    //handleImpression();
  // Handler for .ready() called.
});