<?php
class Stat extends CI_Model{
    function __construct()
    {
        $this->load->database();
    }
    function logData($type, $data){
        $dateChart = array(24);
        if($type == 'Day'){
            $data = str_replace("/","-",$data);
//            echo $data;
            for ($i=0 ; $i<24; $i++){
                $hour = $i;
                    if($i < 10){
                        $hour = "0$i";
                    }
                $this->db->where("LogTime LIKE '$data $hour%'");
                $query = $this->db->get('Log');
                $result = $query->num_rows();
                $dateChart[$i] = $result;
            }
        }
        else if($type == 'Month'){
            for ($i=1 ; $i<=31 ; $i++){
                $day = $i;
                if($i < 10){
                    $day = "0".$i;
                }
                $this->db->where("LogTime LIKE '$data-$day%'");
                $query = $this->db->get('Log');
                $result = $query->num_rows();
                $dateChart[$i-1] = $result;
            }
        }
        else if($type == 'Year'){
            for ($i=1 ; $i<=12 ;$i++){
                $month = $i;
                if($i < 10){
                    $month = "0".$i;
                }
                $this->db->where("LogTime LIKE '$data-$month%'");
                $query = $this->db->get('Log');
                $result = $query->num_rows();
                $dateChart[$i-1] = $result;
            }
        }
        return $dateChart;
    }



}
?>