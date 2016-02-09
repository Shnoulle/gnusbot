<?php
/*
 * Gnusbot class
 */

class gnusbot{

    var $feed_data = Array(
        "timestamp"=>0,
        "feedname"=>"untitled",
        "path_control_files" => ""
    );
    
    function __construct($p_feed_data){
        $this->feed_data = array_merge($this->feed_data, $p_feed_data);
    }

    /**
     * Simple function to build the control file filename 
     **/
    function build_filename(){
        $filename = str_replace(" ", "", $this->feed_data["feedname"]);
        $filename = str_replace(Array("http", "https", "://", "www."), "", $filename);
        $filename = preg_replace('/[^A-Za-z0-9\-]/', '', $filename);
        $filename .= ".feeds";

        return $filename;
    }
    
    /**
      * Main function to decide if publish or not to publish a post
      */
    function need_to_publish(){
        $ret = false;

        // build the expected filename
        $filename = $this->build_filename();

        // build expected post-id
        $post_id = $this->feed_data["timestamp"];
        

        // if file does not exists then create the file with the post-id
        if ( ! file_exists($this->feed_data["path_control_files"].$filename)){
            $fh = fopen($this->feed_data["path_control_files"].$filename, "w");
            fwrite($fh, "\r\n");
            fclose($fh);
            // as the file does not exists, then any post needs to be published
            $ret = true;
            
        }else{

            // open and check for the post id
            $fh = fopen($this->feed_data["path_control_files"].$filename, "r");
            $control_contents = fread($fh, filesize($this->feed_data["path_control_files"].$filename));
            fclose($fh);
            // check for the post-id in the content
            if(FALSE === stristr($control_contents, $post_id)) {
                $ret = true;                
            }            
            
        }

        return $ret;
    }
    
    function publish($a_data){
        $ret = false;
        $a_update = Array(
            "status"=>"",
            "username"=>"",
            "password"=>"",
            "api_uri" => ""
        );
        $a_update = array_merge($a_update, $a_data);
        
        if (!empty($a_update["status"])){
            $ch = curl_init();

            curl_setopt_array($ch, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $a_update["api_uri"],
                CURLOPT_USERAGENT => 'gnusbot 0.0.1',
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => array(
                    'status' => $a_update["status"]
                ),
                CURLOPT_USERPWD => $a_update["username"].":".$a_update["password"],
                CURLOPT_VERBOSE => 1
            ));

            //curl_setopt($ch,CURLOPT_URL, $url);
            //curl_setopt($ch, CURLOPT_POSTFIELDS, $json_fields );
            //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
            //curl_setopt($ch,CURLOPT_TIMEOUT, 20);
            //curl_setopt($ch, CURLOPT_VERBOSE, 1);

            //execute publish
            $curl_result = curl_exec($ch);

            // insted of just returing true, check the returned values
            $ret = true;

            
        }     
        return $ret;
    }


    function log_publish(){
        $filename = $this->build_filename();

        $fh = fopen($this->feed_data["path_control_files"].$filename, "a");
        $ret = fwrite($fh, $this->feed_data["timestamp"]."\r\n");
        fclose($fh);

        return $ret;        
    }

    
}


?>
