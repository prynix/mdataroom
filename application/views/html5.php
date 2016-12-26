<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
        <script src="<?php echo $script_url;?>"> </script>
    </head>
        
    <body>
        <div class="astar_serve" id="<?php echo $real_placement_id?>">        
            <?php
                $click_request_url=$click_url."?pid=".$placement_id."&bid=".$banner_id."&target_url=".$target_url;
            ?>         
            
            <a id="adserve_click" href="<?php echo $click_request_url;?>" target="_blank" scrolling="no" style="position:relative; display:inline-block; color:white;">
                <div class="blocker" style="position:absolute; height:100%; width:100%; z-index:1; background:rgba(0,0,0,0);"></div>
                    <div style="position:absolute; height:100%; width:100%; z-index:2;"></div>
                        <iframe src="<?php echo $content_url; ?>" 
                            width="<?php echo $placement_width;?>" 
                            height="<?php echo $placement_height;?>"
                            border="0"
                            scrolling="no"
                            allowtransparency="true"
                            style="z-index:1;border:0">
                            <p>Your browser does not support iframes.</p>
                        </iframe>'
             </a>            
        </div>
    </body>
</html>
           