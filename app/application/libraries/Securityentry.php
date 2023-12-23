<?php

class Securityentry {

    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    //******************* INSERT DETAILS */
    public function login_log($email,$username){

    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $os = $this->get_os($user_agent);
    $get_country=$this->get_datas($ip_address);

    $log_insert_data = array(
    "member_email" => $email,
    "user_agent" => $user_agent,
    "operating_system" => $os,
    "ip_address" => $ip_address,
    "country" => $get_country,
    "log_date" => date('Y-m-d H:i:s'),
    "staff" => $username,
    );

    $this->CI->db->insert('tbllogs_activity',$log_insert_data);

    }

    //******************* GET  USER  LOCATION */
    public function get_datas($ip)
    {
    
    $url = "http://ip-api.com/json/{$ip}";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if ($response === false) {
    return false;
    } else {
    $data = $response;
    if ($data) {
    return $data;
    } else {
    return false;
    }
    }
    curl_close($ch);
    }


    //******************* GET OS FROM USER */
    public  function get_os($user_agent) {
    $os_platform = "Unknown OS Platform";
    $os_array = array(
    '/windows nt 10/i'      =>  'Windows 10',
    '/windows nt 6.3/i'     =>  'Windows 8.1',
    '/windows nt 6.2/i'     =>  'Windows 8',
    '/windows nt 6.1/i'     =>  'Windows 7',
    '/windows nt 6.0/i'     =>  'Windows Vista',
    '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
    '/windows nt 5.1/i'     =>  'Windows XP',
    '/windows xp/i'         =>  'Windows XP',
    '/windows nt 5.0/i'     =>  'Windows 2000',
    '/windows me/i'         =>  'Windows ME',
    '/win98/i'              =>  'Windows 98',
    '/win95/i'              =>  'Windows 95',
    '/win16/i'              =>  'Windows 3.11',
    '/macintosh|mac os x/i' =>  'Mac OS X',
    '/mac_powerpc/i'        =>  'Mac OS 9',
    '/linux/i'              =>  'Linux',
    '/ubuntu/i'             =>  'Ubuntu',
    '/iphone/i'             =>  'iPhone',
    '/ipod/i'               =>  'iPod',
    '/ipad/i'               =>  'iPad',
    '/android/i'            =>  'Android',
    '/blackberry/i'         =>  'BlackBerry',
    '/webos/i'              =>  'Mobile'
    );

    foreach ($os_array as $regex => $value) {
    if (preg_match($regex, $user_agent)) {
    $os_platform = $value;
    }
    }
    return $os_platform;
    }
        


};
