<?php
if (! function_exists('time_date_diff')) {
    function time_date_diff($prev_time) {
        $now=strtotime(date("Y-m-d h:i:sa"));
        $then=strtotime($prev_time);
        $sec_diff=$now-$then;
        if($sec_diff<60){
        if($sec_diff<2)
          echo $sec_diff ." sec ago";
        else  
          echo $sec_diff ." secs ago";
        }
        
        else if($sec_diff<3600)
        {
            if($sec_diff/60<2)
            echo round($sec_diff/60) ." min ago";
            else  
            echo round($sec_diff/60) ." mins ago";
        }
        
        else if($sec_diff<86400)
        {
            if($sec_diff/3600<2)
            echo round($sec_diff/3600) ." hour ago";
            else  
            echo round($sec_diff/3600) ." hours ago";
        }
        
        else if($sec_diff<2592000)
        {
            if($sec_diff/86400<2)
            echo round($sec_diff/86400) ." day ago";
            else  
            echo round($sec_diff/86400) ." days ago";
        }
        
        else if($sec_diff<31104000)
        {
            if($sec_diff/2592000<2)
            echo round($sec_diff/2592000) ." month ago";
            else  
            echo round($sec_diff/2592000) ." months ago";
        }
        
        else 
        {
            if($sec_diff/31104000<2)
            echo round($sec_diff/31104000) ." year ago";
            else  
            echo round($sec_diff/31104000) ." years ago";  
        }
         
    }
}
if (! function_exists('print_hello')) {
    function print_hello() {
        return "Hello";
    }
}