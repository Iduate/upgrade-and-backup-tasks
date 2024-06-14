<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Chat_model extends CI_model { 

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    // $this->db->join('comments', 'comments.id = blogs.id');

    function getEveryone($searchTerm) {
        $Userid = $this->ion_auth->get_user_id();
        if (!empty($searchTerm)) {
            //doctor
            $query = $this->db->select('*')
                    ->from('doctor')
                    ->where('ion_user_id !=', $Userid)
                    ->where('hospital_id', $this->session->userdata('hospital_id'))
                    ->where("(id LIKE '%" . $searchTerm . "%' OR name LIKE '%" . $searchTerm . "%')", NULL, FALSE)
                    ->get();
            $users1 = $query->result_array();
            //accountant
            $query = $this->db->select('*')
                    ->from('accountant')
                    ->where('ion_user_id !=', $Userid)
                    ->where('hospital_id', $this->session->userdata('hospital_id'))
                    ->where("(id LIKE '%" . $searchTerm . "%' OR name LIKE '%" . $searchTerm . "%')", NULL, FALSE)
                    ->where("id !=",$Userid)
                    ->get();
            $users2 = $query->result_array();
            //nurse
            $query = $this->db->select('*')
                    ->from('nurse')
                    ->where('ion_user_id !=', $Userid)
                    ->where('hospital_id', $this->session->userdata('hospital_id'))
                    ->where("(id LIKE '%" . $searchTerm . "%' OR name LIKE '%" . $searchTerm . "%')", NULL, FALSE)
                    ->where("id !=",$Userid)
                    ->get();
            $users3 = $query->result_array();
            //pharmacist
            $query = $this->db->select('*')
                    ->from('pharmacist')
                    ->where('ion_user_id !=', $Userid)
                    ->where('hospital_id', $this->session->userdata('hospital_id'))
                    ->where("(id LIKE '%" . $searchTerm . "%' OR name LIKE '%" . $searchTerm . "%')", NULL, FALSE)
                    ->where("id !=",$Userid)
                    ->get();
            $users4 = $query->result_array();
            //laboratorist
            $query = $this->db->select('*')
                    ->from('laboratorist')
                    ->where('ion_user_id !=', $Userid)
                    ->where('hospital_id', $this->session->userdata('hospital_id'))
                    ->where("(id LIKE '%" . $searchTerm . "%' OR name LIKE '%" . $searchTerm . "%')", NULL, FALSE)
                    ->where("id !=",$Userid)
                    ->get();
            $users5 = $query->result_array();
            //receptionist
            $query = $this->db->select('*')
                    ->from('receptionist')
                    ->where('ion_user_id !=', $Userid)
                    ->where('hospital_id', $this->session->userdata('hospital_id'))
                    ->where("(id LIKE '%" . $searchTerm . "%' OR name LIKE '%" . $searchTerm . "%')", NULL, FALSE)
                    ->where("id !=",$Userid)
                    ->get();
            $users6 = $query->result_array();
            //admin
            $query = $this->db->select('*')
                    ->from('hospital')
                    ->where('ion_user_id !=', $Userid)
                    ->where('id', $this->session->userdata('hospital_id'))
                    ->where("(id LIKE '%" . $searchTerm . "%' OR name LIKE '%" . $searchTerm . "%')", NULL, FALSE)
                    ->where("id !=",$Userid)
                    ->get();
            $users7 = $query->result_array();
        } else {
            //doctor
            $this->db->select('*');
            $this->db->where('ion_user_id !=', $Userid);
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->limit(1);
            $fetched_records = $this->db->get('doctor');
            $users1 = $fetched_records->result_array();
            // //accountant
            $this->db->select('*');
            $this->db->where('ion_user_id !=', $Userid);
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->limit(1);
            $fetched_records = $this->db->get('accountant');
            $users2 = $fetched_records->result_array();
            // //nurse
            $this->db->select('*');
            $this->db->where('ion_user_id !=', $Userid);
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->limit(1);
            $fetched_records = $this->db->get('nurse');
            $users3 = $fetched_records->result_array();
            // //pharmacist
            $this->db->select('*');
            $this->db->where('ion_user_id !=', $Userid);
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->limit(1);
            $fetched_records = $this->db->get('pharmacist');
            $users4 = $fetched_records->result_array();
            // //laboratorist
            $this->db->select('*');
            $this->db->where('ion_user_id !=', $Userid);
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->limit(1);
            $fetched_records = $this->db->get('laboratorist');
            $users5 = $fetched_records->result_array();
            // //receptionist
            $this->db->select('*');
            $this->db->where('ion_user_id !=', $Userid);
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->limit(1);
            $fetched_records = $this->db->get('receptionist');
            $users6 = $fetched_records->result_array();
            // //admin
            $this->db->select('*');
            $this->db->where('ion_user_id !=', $Userid);
            $this->db->where('id', $this->session->userdata('hospital_id'));
            $this->db->limit(1);
            $fetched_records = $this->db->get('hospital');
            $users7 = $fetched_records->result_array();
        }




        // Initialize Array with fetched data
        $data = array();
        foreach ($users1 as $user) {
            $data[] = array("id" => $user['ion_user_id']."|doctor", "text" => $user['name']);
        }
        foreach ($users2 as $user) {
            $data[] = array("id" => $user['ion_user_id']."|accountant", "text" => $user['name']);
        }
        foreach ($users3 as $user) {
            $data[] = array("id" => $user['ion_user_id']."|nurse", "text" => $user['name']);
        }
        foreach ($users4 as $user) {
            $data[] = array("id" => $user['ion_user_id']."|pharmacist", "text" => $user['name']);
        }
        foreach ($users5 as $user) {
            $data[] = array("id" => $user['ion_user_id']."|laboratorist", "text" => $user['name']);
        }
        foreach ($users6 as $user) {
            $data[] = array("id" => $user['ion_user_id']."|receptionist", "text" => $user['name']);
        }
        foreach ($users7 as $user) {
            $data[] = array("id" => $user['ion_user_id']."|admin", "text" => $user['name']);
        }
        return $data;
    }

    public function isSame($id){
        $h=$this->session->userdata('hospital_id');
        $this->db->where('id', $h);
        $query = $this->db->get('hospital');
        $hospital= $query->row()->ion_user_id;

        $this->db->where('id', $id);
        $this->db->where('hospital_ion_id', $hospital );
        $query = $this->db->get('users');
        return $query->num_rows()>0;
    }

    public function getConvo($id){
        $h=$this->session->userdata('hospital_id');
        $this->db->where('user_2', $id);
        $this->db->or_where('user_1', $id);
        $query = $this->db->get('conversation');
        return $query->row();
    }

    public function getConvoBy($id){
        $h=$this->session->userdata('hospital_id');
        $this->db->where('id', $id);
        $query = $this->db->get('conversation');
        return $query->row();
    }

    function createConvo($usr1,$usr2) {
        $now=time();
        $data=array(
            "hospital_id" =>$this->session->userdata('hospital_id'),
            "user_1" =>$usr1,
            "user_2" =>$usr2,
            "date" => $now
        );
        $this->db->insert('conversation', $data);
        return $this->db->insert_id();
    }

    function getMessage($convo){
        $this->db->where('convo_id', $convo);
        $this->db->limit(20);
        $this->db->order_by("date");
        $query = $this->db->get('message');
        return $query->result();
    }

    function getUser($id){
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }

    function sendMessage($data,$cid) {
        $now=time();
        $this->db->insert('message', $data);
        $returnId= $this->db->insert_id();
        $d=array("date" => $now);
        $this->db->where('id',$cid);
        $this->db->update("conversation",$d);
        return $returnId;
    }

    function getNewMsg($convo,$sender){
        $this->db->where('convo_id', $convo);
        $this->db->where('sender', $sender);
        $this->db->where('delivered', "0");
        $this->db->order_by("date");
        $query = $this->db->get('message');

        $res= $query->row();
        $data=array("delivered" => "1");
        $this->db->where('convo_id', $convo);
        $this->db->where('sender', $sender);
        $this->db->where('id', $res->id);
        $this->db->update("message",$data);
        return $res;
    }

    function getUnreadMsg($convo,$sender){
        $this->db->where('convo_id', $convo);
        $this->db->where('sender', $sender);
        $this->db->where('status', "1");
        $this->db->order_by("date");
        $query = $this->db->get('message');

        $res= $query->row();
        $data=array("status" => "0");
        $this->db->where('convo_id', $convo);
        $this->db->where('sender', $sender);
        $this->db->where('id', $res->id);
        $this->db->update("message",$data);
        return $res;
    }

    function getAllConvo($me){
        $this->db->where('user_1', $me);
        $this->db->or_where('user_2', $me);
        $this->db->limit(7);
        $this->db->order_by("date", "DESC");
        $query = $this->db->get('conversation');
        return $query->result();
    }

    function getLastMessage($convo){
        $this->db->where('convo_id', $convo);
        $this->db->limit(1);
        $this->db->order_by("date","DESC");
        $query = $this->db->get('message');

        return $query->row();
    }

    function getOtherUser($convo){
        $this->db->where("id", $convo);
        $query = $this->db->get('conversation');
        $row= $query->row();
        $Userid = $this->ion_auth->get_user_id();
        if($Userid == $row->user_1){
            return $row->user_2;
        }else{
            return $row->user_1;
        }
    }

    function getName($id){
        $this->db->where("id", $id);
        $query = $this->db->get('users');
        return $query->row()->username;
    }
}
?>