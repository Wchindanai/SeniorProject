<?php
/**
 * Created by PhpStorm.
 * User: Dream
 * Date: 7/16/2016 AD
 * Time: 11:55 PM
 */
class Student extends CI_Model{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function delete($id){
        foreach ($id as $value) {
            $this->db->where('StudentID', $value);
            $this->db->delete('Student');
        }
    }
    function add($data){
        $query = $this->db->insert('Student',$data);
        if(!$query){
            return false;
        }
        else
            return true;
    }
    function get($data){
        $this->db->where('StudentID',$data);
        $query = $this->db->get('Student');
        $row = $query -> row();
        $student = array(
            'StudentID' => $row -> StudentID,
            'StudentFirstname' => $row -> StudentFirstname,
            'StudentLastname' => $row -> StudentLastname
        );
        return $student;
    }
    function edit($student){
        $this->db->where('StudentID',$student['StudentID']);
        $this->db->update('Student', $student);
    }

}


?>