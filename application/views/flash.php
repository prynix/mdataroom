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
            <div style="position:absolute;"><div style="position:absolute;">
                    <a id="adserve_click" href="<?php echo $click_request_url;?>" target="_blank">
                        <img src="<?php echo dirname(base_url());?>/_FILES/Transparent.gif" width="<?php echo $placement_width?>" height="<?php echo $placement_height?>">
                    </a>
                </div>
                <div>
                    <object type="application/x-shockwave-flash" data="<?php echo $content_url?>" width="<?php echo $placement_width?>" height="<?php echo $placement_height?>">
                        <param name="flashvars" value="clickTag=&amp;clickTarget=_self">
                        <param name="allowScriptAccess" value="always">
                        <param name="movie" value="<?php echo $content_url?>">
                        <param name="wmode" value="transparent">
                    </object>
                </div>
            </div>
        </div>
    </body>
</html>
                