<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function index()
    {
        redirect('Welcome/login');
    }

    public function login()
    {
        $this->load->view('login');
    }
    public function checkLogin()
    {
        $this->load->database();
        $_SESSION['login']=true;
        $row = [];
        $username = $_POST["username"];
        $password = md5($_POST["password"]);
        $query = $this->db->query("SELECT * FROM Teacher WHERE TeacherID = '$username'");
        foreach ($query->result() as $row){
        }
        if(count($row) == 0)
        {
            //fail AUTH USERNAME
            $_SESSION['login']=false;
            $_SESSION['count']=1;
            redirect('Welcome/login');
        }
        else
        {
            //fail AUTH PASSWORD
            $query = $this->db->query("SELECT * FROM Teacher WHERE TeacherID = '$username' AND Password = '$password'");
            $row=[];
            foreach ($query->result() as $row){
                $name = ($row->TeacherFirstname)." ".($row->TeacherLastname);
            }
            if (count($row)==0)
            {
                //Wrong Password
                $_SESSION['username']= $username;
                $_SESSION['login']=false;
                $_SESSION['count']=2;
                redirect('Welcome/login');

            }
            else
            {

                //Success Password
                $_SESSION['name']=$name;
                $_SESSION['login']=true;
                redirect('Welcome/main');
            }
        }
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('Welcome/login');
    }
    function auth(){
        if(isset($_SESSION['login'])) {
            if ($_SESSION['login'] == false) {
                redirect('Welcome/login');
            }
        }
        else{
            redirect('Welcome/login');
        }
    }
    public function main()
    {
        $check = $this->auth();
        $this->load->model('main');
//        $this->load->database();
        $this->load->view('main');
    }
    public function device(){
        $check = $this->auth();
        $this->load->database();
        $this->load->view('device');

    }
    public function stat(){
        $check = $this->auth();
        $this->load->database();
        $this->load->view('stat');
    }
    public function student(){
        $check = $this->auth();
        $this->load->model('student');
        $this->load->view('student');
    }
    public function add_device()
    {
        $room_name = $_POST['room_name'];
        $ip = $_POST['ip_address'];
        $location = $_POST['location'];
        $this->load->model('Device');
        $result = $this->Device->add_device($room_name, $ip, $location);
        $_SESSION['add_device'] = $result;
        redirect('Welcome/device');
    }
    public function delete_device(){
        $deviceID = $_POST['delete'];
        $this->load->model('device');
        $this->device->delete($deviceID);
        redirect('Welcome/device');
    }
    public function ajax_edit_device(){
        $deviceId = $_POST['deviceId'];
        $this->load->model('Device');
        $this->db->where('deviceId',$deviceId);
        $query = $this->db->get('Device');
        $row = $query->row();
        $data = array(
            'deviceId' => $deviceId,
            'roomName' => ($row->roomName),
            'ip'       => ($row->ip),
            'location' => ($row->location)
        );
        $this->load->view('device/edit_device',$data);
    }
    public function edit_device(){
        $roomName = $_POST['room_name'];
        $ip = $_POST['ip_address'];
        $location = $_POST['location'];
        $deviceId = $_POST['deviceId'];
        $this->load->model('device');
        $this->device->update($roomName, $ip, $location, $deviceId);
        redirect('Welcome/device');
    }

    public function delte_student(){
        $student_id = $_POST['student'];
        $this->load->model('student');
        $this->student->delete($student_id);
        redirect('welcome/student');

    }
    public function add_student(){
        $student_id = $_POST['student_id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $student = array(
            'StudentID' => $student_id,
            'StudentFirstname' => $firstname,
            'StudentLastname' => $lastname
        );
        $this->load->model('student');
        $result = $this->student->add($student);
        $_SESSION['add_student'] = $result;
        redirect('welcome/student');
    }
    public function ajax_edit_student(){
        $studentID = $_POST['SID'];
        $this->load->model('student');
        $student = $this->student->get($studentID);
        $this->load->view('student/edit_student', $student);
    }
    public function edit_student(){
        $student = array(
            'StudentID' => $_POST['student_id'],
            'StudentFirstname' => $_POST['firstname'],
            'StudentLastname' => $_POST['lastname']
        );
        $this->load->model('student');
        $this->student->edit($student);
        redirect('welcome/student');
    }

    public function per_tabb(){
        $this->load->model('Permission');
        $this->load->view('student/permission');
    }

    public function add_per(){
        $sid = $_POST['sid'];
        $from_time = $_POST['from_time'];
        $to_time = $_POST['to_time'];
        $dow = $_POST['dow'];
        $sdate = $_POST['sdate'];
        $edate = $_POST['edate'];
        $deviceip = $_POST['deviceIP'];
        $data = array(
            'RecordID' => null,
            'RecordStartTime' => $from_time,
            'RecordEndTime' => $to_time,
            'RecordStartDate' => $sdate,
            'RecordEndDate' => $edate,
            'RecordDoW' => null,
        );
        foreach ($dow as $value){
            $data['RecordDoW'] = $data['RecordDoW'].$value."/" ;
        }
        $this->load->model('Permission');
        $result = $this->Permission->add_per($data, $sid, $deviceip);
        if($result){
            echo "Error Add Permission";
        }
        else{
            echo "Success";
        }
    }

    public function get_per(){
        $this->load->model('Permission');
        $this->load->view('student/ajax_permission');

    }
    public function del_per(){
        $id = $_POST['recordID'];
        $this->load->model('Permission');
        $bool = $this->Permission->del_per($id);
    }
    public function per_stu(){
        $PID = $_POST['PID'];
        $this->load->model('Permission');
        $data = array(
            'pid' => $PID,
        );
        $this->load->view('student/ajax_perStudent',$data);
    }
    public function delPerStudent(){
        $SID = $_POST['delStudent'];
        $PID = $_POST['PID'];
        $this->load->model('Permission');
        $this->Permission->del_student($SID,$PID);
    }
    public function addPerStu(){
        $this->load->model('Permission');
        $this->load->view('student/ajax_add_student');
    }
    public function add_stu_per(){
        $sid = $_POST['sid'];
        $pid = $_POST['pid'];

        $this->load->model('Permission');
        $this->db->where('RecordID =', $pid);
        $query = $this->db->get('StudentRecord');
        $row = $query->row();
        $ip = $row->deviceIP;

        $this->Permission->astudent($sid,$pid, $ip);
    }
    public function edit_permission(){
        $pid = $_POST['PID'];
        $data = array(
            'pid' => $pid
        );
        $this->load->model('Permission');
        $this->load->view('student/ajax_edit_permission', $data);
    }
    public function edit_per(){
        $pid = $_POST['id'];
        $time = $_POST['time'];
        $to_time = $_POST['to_time'];
        $sdate = $_POST['sdate'];
        $edate = $_POST['edate'];
        $dow = $_POST['dow'];
        $deviceip = $_POST['deviceIP'];
        $data = array(
            'RecordStartTime' => $time,
            'RecordEndTime' => $to_time,
            'RecordStartDate' => $sdate,
            'RecordEndDate' => $edate,
            'RecordDoW' => null,
        );
        foreach ($dow as $value){
            $data['RecordDoW'] = $data['RecordDoW'].$value."/" ;
        }
        $this->load->model('Permission');
        $this->Permission->edit_per($data,$pid,$deviceip);
    }
    public function clearNoti(){
        $this->load->database();
        $this->db->where("LogType !=", 0);
        $this->db->delete("Log");
        redirect('Welcome/main');
    }
    public function getDataChart(){
        $dateType = $_POST['type'];
        $dateLog = $_POST['data'];
        $this->load->model('Stat');
        $ChartData = '';
        if($dateType == 'Day'){
            $dayChartData = $this->Stat->logData($dateType, $dateLog);
            foreach ($dayChartData as $value){
                $ChartData .= $value.' ';
            }
        }
        else if($dateType == 'Month'){
            $monthChartData = $this->Stat->logData($dateType, $dateLog);
            foreach ($monthChartData as $value){
                $ChartData .= $value.' ';
            }
        }
        else if($dateType == 'Year'){
            $yearChartData = $this->Stat->logData($dateType, $dateLog);
            foreach ($yearChartData as $value){
                $ChartData .= $value.' ';
            }
        }
        echo $ChartData;
    }
}
