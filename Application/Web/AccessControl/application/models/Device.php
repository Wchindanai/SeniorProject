<?php
/**
 * Created by PhpStorm.
 * User: Dream
 * Date: 7/16/2016 AD
 * Time: 11:55 PM
 */
class Device extends CI_Model{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function add_device($room_name, $ip_address, $location){
        $data = array(
            'roomName' => $room_name,
            'ip' => $ip_address,
            'location' => $location,
        );

        $query = $this->db->insert('Device',$data);
        if( !$query){
            return false;
        }
        else{
            return true;
        }

    }

    function delete($deviceId){
        $this->db->where('deviceId',$deviceId);
        $this->db->delete('Device');
    }
    function update($roomName, $ip, $location, $deviceId){
        $data = array(
            'roomName' => $roomName,
            'ip'       => $ip,
            'location' => $location
        );
        $this->db->where('deviceId',$deviceId);
        $this->db->update('Device',$data);

    }












}


?>