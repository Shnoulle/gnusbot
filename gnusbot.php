<?php
/**
 * Main GNU Social Bot (aka. GnuSBot or GSB)
 * @autor: @tuxxus
 * @url: http://www.tuxxus.com
 */

require_once("inc/gnusbot-config.inc.php");
require_once("inc/load-libs.inc.php");

$simple_feed = new SimplePie();


foreach ($gnusbot_feeds as $a_feed => $feed){

    
    $simple_feed->set_feed_url($feed["url"]);
    // Disable Cache
    $simple_feed->enable_cache(false);
    // Run SimplePie.
    $simple_feed->init();
    // This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).
    $simple_feed->handle_content_type();    

    echo $simple_feed->get_title()."<br />";
    echo $simple_feed->get_permalink()."<br />";
    echo "<hr />";
    // echo $simple_feed->get_description()."<hr />";

    foreach ($simple_feed->get_items(0, GSB_MAX_PUBLISH) as $item){
        // init the gnusbot class
        $gnusbot = new gnusbot(Array(
            'timestamp' => $item->get_date('YmdHis'),
            'feedname' => $simple_feed->get_permalink(),
            'path_control_files' => GSB_PATH_CONTROL_FILES
        ));

        
        // check if the item/post needs to be published (wasn't published earlier)
        if (TRUE == $gnusbot->need_to_publish()){

            // define status
            $status = $item->get_title();
            $status .= " ";
            $status .= $item->get_permalink();
            $status .= " ";
            $status .= $feed["ref"];

            // for each account to publish, do the job
            foreach ($gnusbot_api as $account){


                echo $status;
                $publish_result = $gnusbot->publish(Array(
                    "status" => $status,
                    "username" => $account['username'],
                    "password" => $account['password'],
                    "api_uri" => $account['api_uri']
                ));
                 

                $ret = $gnusbot->log_publish();
                if (FALSE != $ret && FALSE != $publish_result){
                    echo " - PUBLISHED<br />\r\n";
                }else{
                    echo " - ERROR<br />\r\n";
                }

                
                
            }
            
        }else{
            
            // DO NOTHIN'
            
        }
        


        /* echo $item->get_title()."<br />";
           echo $item->get_permalink()."<br />";
           echo $item->get_description()."<br />";
           echo $item->get_date('Y-m-d H:i:s')."<br />";
           echo "<hr />";
         */
        
    }
    
        
}



echo ">JOB DONE!";


?>
