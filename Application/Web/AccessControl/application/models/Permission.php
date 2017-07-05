<?php
/**
 * Created by PhpStorm.
 * User: Dream
 * Date: 7/25/16
 * Time: 00:24
 */
class Permission extends CI_Model
{
    function __construct()
    {
        $this->load->database();
    }

    function add_per($data, $sid, $ip)
    {
        $this->db->select_max('RecordID');
        $query = $this->db->get('Permission');
        $row = $query -> row();
        $data['RecordID'] = (int)($row->RecordID) + 1 ;
        $this->db->insert('Permission', $data);
        print_r($this->db->error());
        foreach ($sid as $value){
            $srec = array(
                'StudentID' => $value,
                'RecordID' => $data['RecordID'],
                'deviceIP' => $ip
            );
            $this->db->insert('StudentRecord', $srec);
        };
    }
    function del_per($id){
        $this->db->where('RecordID',$id);
        $this->db->delete('StudentRecord');
        $this->db->where('RecordID',$id);
        $this->db->delete('Permission');

    }
    function del_student($sid, $pid){
        foreach ($sid as $id){
            $this->db->where('StudentID',$id);
            $this->db->where('RecordID', $pid);
            $this->db->delete('StudentRecord');
        }
    }
    function astudent($sid, $pid, $ip){
        foreach ($sid as $id){
            $data = array(
                'StudentID' => $id,
                'RecordID' => $pid,
                'deviceIP' => $ip
            );
            $this->db->insert('StudentRecord',$data);
        }
    }
    function edit_per($data,$pid, $ip){
        $this->db->where('RecordID', $pid);
        $this->db->update('Permission', $data);
        $data2 = array(
          'deviceIP' => $ip,

         );
        $this->db->where('RecordID', $pid);
        $this->db->update('StudentRecord',$data2);

    }
}
?>