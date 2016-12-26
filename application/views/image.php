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
            <a id="adserve_click" target="blank" href="<?php echo $click_request_url?>">
                <img width="<?php echo $placement_width;?>" height="<?php echo $placement_height;?>" src="<?php echo $content_url?>" alt="<?php $caption?>">
            </a>
        </div>
    </body>
</html>
                