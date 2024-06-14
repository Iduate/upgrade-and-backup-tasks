<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('finance/finance_model');
        $this->load->model('appointment/appointment_model');
        $this->load->model('notice/notice_model');
        $this->load->model('home_model');
        $this->load->model('chat_model');
    }

    public function index() {
        if (!$this->ion_auth->in_group(array('superadmin'))) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            $data['sum'] = $this->home_model->getSum('gross_total', 'payment');
            $data['payments'] = $this->finance_model->getPayment();
            $data['notices'] = $this->notice_model->getNotice();
            $data['this_month'] = $this->finance_model->getThisMonth();
            $data['expenses'] = $this->finance_model->getExpense();
            if ($this->ion_auth->in_group(array('Doctor'))) {
                redirect('doctor/details');
            } else {
                $data['appointments'] = $this->appointment_model->getAppointment();
            }

            if ($this->ion_auth->in_group(array('Accountant', 'Receptionist'))) {
                redirect('finance/addPaymentView');
            }

            if ($this->ion_auth->in_group(array('Pharmacist'))) {
                redirect('finance/pharmacy/home');
            }

            if ($this->ion_auth->in_group(array('Patient'))) {
                redirect('patient/medicalHistory');
            }

            $data['this_month']['payment'] = $this->finance_model->thisMonthPayment();
            $data['this_month']['expense'] = $this->finance_model->thisMonthExpense();
            $data['this_month']['appointment'] = $this->finance_model->thisMonthAppointment();

            $data['this_day']['payment'] = $this->finance_model->thisDayPayment();
            $data['this_day']['expense'] = $this->finance_model->thisDayExpense();
            $data['this_day']['appointment'] = $this->finance_model->thisDayAppointment();

            $data['this_year']['payment'] = $this->finance_model->thisYearPayment();
            $data['this_year']['expense'] = $this->finance_model->thisYearExpense();
            $data['this_year']['appointment'] = $this->finance_model->thisYearAppointment();

            $data['this_month']['appointment'] = $this->finance_model->thisMonthAppointment();
            $data['this_month']['appointment_treated'] = $this->finance_model->thisMonthAppointmentTreated();
            $data['this_month']['appointment_cancelled'] = $this->finance_model->thisMonthAppointmentCancelled();

            $data['this_year']['payment_per_month'] = $this->finance_model->getPaymentPerMonthThisYear();


            $data['this_year']['expense_per_month'] = $this->finance_model->getExpensePerMonthThisYear();

            // echo "here";
            // die();
            // print_r($this->ion_auth->get_users_groups()->result());
            // echo $this->session->userdata('hospital_id');
            // die();

            $this->load->view('dashboard'); // just the header file
            $this->load->view('home', $data);
            $this->load->view('footer', $data);
            
        } else {
            $data['hospitals'] = $this->hospital_model->getHospital();
            $this->load->view('dashboard'); // just the header file
            $this->load->view('home', $data);
            $this->load->view('footer');
        }
    }

    public function permission() {
        $this->load->view('permission');
    }

    public function chat(){
        $data=array();
        $aConvo=array();
        $id=$this->input->get('id');
        if($this->chat_model->getConvoBy($id) != null){
            $convo=$this->chat_model->getConvoBy($id);
            //get thier conversation
            $user2=$this->chat_model->getOtherUser($id);
            $u2=$this->chat_model->getName($user2);
            $aConvo['message']=$this->chat_model->getMessage($id);
            $aConvo['name']=$u2;
            $aConvo['cid']=$id;
            $data['aConvo']=$aConvo;
        }

        
        $me = $this->ion_auth->get_user_id();
        $convos=$this->chat_model->getAllConvo($me);
        $msgs=array();
        $i=0;
        foreach($convos as $convo){
            $convo_id=$convo->id;            
            $chat=$this->chat_model->getLastMessage($convo_id);
            if($chat == null){
                continue;
            }
            $user2=$this->chat_model->getOtherUser($convo_id);
            $u2=$this->chat_model->getName($user2);
            $msgs[$i]=array("name"=>$u2, "chat"=>$chat,"usr"=>$user2);
            // print_r($msgs[$i]);
            // echo $u2;
            // echo "<br/>";
            $i++;
        }
        $data['convos']=$msgs;
        // echo json_encode($data);
        // die();
        $this->load->view('dashboard'); // just the header file
        $this->load->view('chat', $data);
        $this->load->view('footer');
    }

    public function getEveryone() {
        // Search term
        $searchTerm = $this->input->post('searchTerm');
        
        // Get users
        $response = $this->chat_model->getEveryone($searchTerm);
        
        echo json_encode($response);
    }

    public function startChat(){
        //get the reciever
        $data=array();
        $id = $this->input->get('id');
        $boom=explode("|",$id);
        $id=$boom[0];
        
        if(!$this->chat_model->isSame($id)){
            $this->permission();
        }


        //get their conversation id
        if($this->chat_model->getConvo($id) != null){
            $convo_id=$this->chat_model->getConvo($id)->id;
        }else{
            //create a new conversation
            $Userid = $this->ion_auth->get_user_id();
            $convo_id=$this->chat_model->createConvo($Userid,$id);
        }


        //get thier conversation
        $user2=$this->chat_model->getOtherUser($convo_id);
        $u2=$this->chat_model->getName($user2);
        $data['message']=$this->chat_model->getMessage($convo_id);
        $data['name']=$u2;
        $data['convo_id']=$user2;
        
        
        echo json_encode($data);
        die();
    }

    public function sendMessage(){
        $data=array();
        $id = $this->input->post('convo_id');
        $msg = $this->input->post('msg');
        //get conversation
        $convo=$this->chat_model->getConvo($id);
        $sender = $this->ion_auth->get_user_id();
        $reciever=$convo->user_1;
        if($convo->user_1 == $sender){
            $reciever=$convo->user_2;
        }
        $msg=htmlspecialchars($msg);
        $now=time();
        $cid=$convo->id;
        $data=array(
            'convo_id'=>$cid,
            'message' =>$msg,
            'sender' =>$sender,
            'reciever' =>$reciever,
            'status' =>'1',
            'delivered' => "0",
            'date' =>$now
        );

        // $data=array("convo_id" =>$cid);
        $status=array();
        if($this->chat_model->sendMessage($data,$cid)){
            $status['status']="true";
        }else{
            $status['status']="false";
        }
        echo json_encode($status);
    }

    public function getNewMsg(){
        $id = $this->input->post('id');
        $boom=explode("|",$id);
        $id=$boom[0];
        //get conversation
        // echo json_encode("hey");
        // return;
        $convo=$this->chat_model->getConvo($id);
        $cid=$convo->id;
        $me = $this->ion_auth->get_user_id();
        $you=$convo->user_1;
        if($convo->user_1 == $me){
            $you=$convo->user_2;
        }
        $newMsg=$this->chat_model->getUnreadMsg($cid,$you);
        $data=array();
        $data['msg']=$newMsg;
        $data['cid']=$id;
        $data['you']=$you;
        echo json_encode($data);
    }

    public function listen(){
        $data=array();
        $me = $this->ion_auth->get_user_id();
        $convos=$this->chat_model->getAllConvo($me);
        $msgs=array();
        $i=0;
        $yous=array();
        $i=0;
        foreach($convos as $convo){
            $convo_id=$convo->id;
            $you=$convo->user_1;
            if($convo->user_1 == $me){
                $you=$convo->user_2;
            }
            $yous[$i]=$you;
            $newMsg=$this->chat_model->getNewMsg($convo_id,$you);
            if($newMsg->id != null){
                $user2=$this->chat_model->getOtherUser($convo_id);
                $u2=$this->chat_model->getName($user2);
                $data["msg"]= $newMsg->message;
                $data["sender"]= $u2;
                $data["cid"]= $convo_id;
                echo json_encode($data);
            break;
            }
            $i++;
        }
    }

    function operations(){
        if (!$this->ion_auth->in_group(array('admin','Accountant'))) {
            redirect("home/permission");
        }
        $this->load->view('dashboard'); // just the header file
        $this->load->view('operations');
        $this->load->view('footer');
    }

    function addOperation(){
        $name=$this->input->post("name");
        $price=preg_replace('#[^0-9]#','',$this->input->post("price"));
        if(strlen($name) <1){   
            $this->session->set_flashdata('feedback', "Invalid Name");
            redirect('home/operations');
        }else{
            $data=array();
            $data=array(
                "name"=>$name,
                "price"=>$price
            );
            $opp_id=$this->home_model->addOperation($data);
            $data = array('category' => $name,
                'description' => "",
                'type' => "others",
                'c_price' => $price,
                'd_commission' => "",
                'operation_id'=>$opp_id
            );
            $this->finance_model->insertPaymentCategory($data);
            $this->session->set_flashdata('feedback', "Added");
            redirect('home/operations');
        }
    }

    function getOperations() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $data['operations'] = $this->home_model->getOperations();
	$num=1;

        foreach ($data['operations'] as $operation) {
            $options1 = ' <a type="button" class="btn editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $operation->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            // $options2 = '<a class="btn detailsbutton" title="' . lang('info') . '" style="color: #fff;" href="patient/patientDetails?id=' . $patient->id . '"><i class="fa fa-info"></i> ' . lang('info') . '</a>';
            $options3 = '<a class="btn delete_button" title="' . lang('delete') . '" href="home/deleteOperation?id=' . $operation->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
            
            
            $info[] = array(
                $num,
                $operation->name,
                $operation->price,
                $options1 . ' ' . $options3,
                    //  $options2
            );
	    $num++;
        }

        if (!empty($data['operations'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }


    function getOperationById(){
        $id=$this->input->get("id");
        $data["operation"]=$this->home_model->getOperationById($id);
        echo json_encode($data);
    }

    function editOperation(){
        $name=$this->input->post("name");
        $id=$this->input->post("id");
        $price=preg_replace('#[^0-9]#','',$this->input->post("price"));
        if(strlen($name) <1){   
            $this->session->set_flashdata('feedback', "Invalid Name");
            redirect('home/operations');
        }else{
            $data=array();
            $data=array(
                "name"=>$name,
                "price"=>$price
            );
            $this->home_model->updateOperation($id,$data);
            $data = array('category' => $name,
                'description' => "",
                'type' => "others",
                'c_price' => $price,
                'd_commission' => "",
                'operation_id'=>$id
            );
            $current_item = $this->finance_model->getPaymentCategoryByOperation($id);
            $this->finance_model->updatePaymentCategory($current_item->id, $data);
            
            $this->session->set_flashdata('feedback', "Updated");
            redirect('home/operations');
        }
    }

    function deleteOperation(){
        $id=$this->input->get("id");
        if (!$this->ion_auth->in_group(array('admin'))) {
            redirect("home/permission");
        }
        $this->home_model->delete($id);
        $current_item = $this->finance_model->getPaymentCategoryByOperation($id);
        $this->finance_model->deletePaymentCategory($current_item->id);
        $this->session->set_flashdata('feedback', "Deleted");
        redirect('home/operations');
    }
    

    public function addR(){
        $file_path="./uploads/operation.csv";
        $i=0;
        $e=1;
        if (($open = fopen($file_path, "r")) !== FALSE) {
            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {  
                $name=$data[0];
                $price=preg_replace('#[^0-9]#','',$data[1]);
                if(strlen($price) <1){
                    $price=0;
                }
                $data=array();
                $data=array(
                    "name"=>$name,
                    "price"=>$price
                );
                $opp_id=$this->home_model->addOperation($data);
                $data = array('category' => $name,
                    'description' => "",
                    'type' => "others",
                    'c_price' => $price,
                    'd_commission' => "",
                    'operation_id'=>$opp_id
                );
                $this->finance_model->insertPaymentCategory($data);
            }
        }else{
            echo "fail";
            die();
        }
        return;
    }

    

    function tutorials(){
        $group=$this->input->get("group");
        switch($group){
            case "admin":
                if (!$this->ion_auth->in_group(array('admin'))) {
                    redirect("home/permission");
                }
            break;
            case "doctor":
                if (!$this->ion_auth->in_group(array('Doctor','admin'))) {
                    redirect("home/permission");
                }
            break;
            case "nurse":
                if (!$this->ion_auth->in_group(array('Nurse','admin'))) {
                    redirect("home/permission");
                }
            break;
            case "front":
                if (!$this->ion_auth->in_group(array('Receptionist','admin'))) {
                    redirect("home/permission");
                }
            break;
            case "lab":
                if (!$this->ion_auth->in_group(array('Laboratorist','admin'))) {
                    redirect("home/permission");
                }
            break;
            case "pharmacists":
                if (!$this->ion_auth->in_group(array('Pharmacist','admin'))) {
                    redirect("home/permission");
                }
            break;
            case "account":
                if (!$this->ion_auth->in_group(array('Accountant','admin'))) {
                    redirect("home/permission");
                }
            break;
            default:
                    redirect("home/permission");
            break;

        }

        $data['tuts']=$this->home_model->getTutorials($group);
        $this->load->view('dashboard'); // just the header file
        $this->load->view('tutorials');
        $this->load->view('footer');

    }


    function getTutorials() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $group=$this->input->get("group");
        switch($group){
            case "admin":
                if (!$this->ion_auth->in_group(array('admin'))) {
                    redirect("home/permission");
                }
            break;
            case "doctor":
                if (!$this->ion_auth->in_group(array('Doctor','admin'))) {
                    redirect("home/permission");
                }
            break;
            case "nurse":
                if (!$this->ion_auth->in_group(array('Nurse','admin'))) {
                    redirect("home/permission");
                }
            break;
            case "front":
                if (!$this->ion_auth->in_group(array('Receptionist','admin'))) {
                    redirect("home/permission");
                }
            break;
            case "lab":
                if (!$this->ion_auth->in_group(array('Laboratorist','admin'))) {
                    redirect("home/permission");
                }
            break;
            case "pharmacists":
                if (!$this->ion_auth->in_group(array('Pharmacist','admin'))) {
                    redirect("home/permission");
                }
            break;
            case "account":
                if (!$this->ion_auth->in_group(array('Accountant','admin'))) {
                    redirect("home/permission");
                }
            break;
            default:
                    redirect("home/permission");
            break;

        }
        

        $data['tuts']=$this->home_model->getTutorials($group);
	$num=1;

        foreach ($data['tuts'] as $tut) {
            if($tut->type=="pdf"){
                $options1 = ' <a type="button" class="btn editbutton play" title="View" onclick="readpdf(\''.$tut->name.'\')" data-toggle = "modal" data-name="' . $tut->name . '"><i class="fa fa-eye"> </i> View</a>';
            }else{
                $options1 = ' <a type="button" class="btn editbutton viewpdf" title="Play" onclick="playvideo(\''.$tut->name.'\')" data-toggle = "modal" data-name="' . $tut->name . '"><i class="fa fa-video"> </i> Play</a>';
            }
            // $options2 = '<a class="btn detailsbutton" title="' . lang('info') . '" style="color: #fff;" href="patient/patientDetails?id=' . $patient->id . '"><i class="fa fa-info"></i> ' . lang('info') . '</a>';
            $options3 = '<a class="btn delete_button" title="' . lang('delete') . '" href="home/deleteOperation?id=' . $tut->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
            
            
            $info[] = array(
                $num,
                $tut->name,
                $tut->description,
                $options1,
                    //  $options2
            );
	    $num++;
        }

        if (!empty($data['tuts'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }
    

}


/* End of file home.php */
/* Location: ./application/controllers/home.php */
