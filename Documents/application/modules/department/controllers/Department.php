<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department extends MX_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('department_model');
        $this->load->model('finance/finance_model');

        if (!$this->ion_auth->in_group('admin')) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['departments'] = $this->department_model->getDepartment();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('department', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new');
        $this->load->view('home/footer'); // just the header file
    }

    public function addForm() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $type = $this->input->post('type');
        $isgroup=false;
        $formId="";

        if (empty($id)) {     
            $this->session->set_flashdata('feedback', "No ID Found");
            redirect("department");
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Form name', 'trim|required|min_length[2]|max_length[100]|xss_clean');

        switch ($type) {
            case 'text': break;
            case 'date': break;
            case 'image': break;
            case 'polar': break;
            case 'group': $isgroup=true; break;
            default: $type="text"; break;
        }
        
        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('department', $data);
                $this->load->view('home/footer'); // just the footer file

            } else {
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('department', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'dept_id' => $id,
                'name' => $name,
                'type' => $type
            );
            if($formId == ""){ //adding new case form
                $newId= $this->department_model->InsertCaseForm($data);
                if($isgroup){
                    $count=$this->input->post('groupcount');
                    for($i=0; $i<$count; $i++){
                       $c=$i+1;
                        $n="Group_name_$c";
                        $t="Group_type_$c";
                       $subname=$this->input->post($n);
                       $subtype=$this->input->post($t);
                       switch ($subtype) {
                            case 'text': break;
                            case 'date': break;
                            case 'polar': break;
                            default: $type="text"; break;
                        }
                        $data = array();
                        $data = array(
                            'dept_id' => "f".$newId,
                            'name' => $subname,
                            'type' => $subtype
                        );
                        $this->department_model->InsertCaseForm($data);
                   }
               }
                
            }
            // Loading View
                $this->session->set_flashdata('feedback', lang('Added'));
            redirect('department');
        }
    }

    public function admin(){
        $data['admin'] = $this->department_model->getAdmin();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('admin', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function editAdminByJason() {
        $id = $this->input->get('id');
        $data['admin'] = $this->department_model->getAdminById($id);
        echo json_encode($data);
    }

    public function addAdmin() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[5]|max_length[50]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['admin'] = $this->department_model->getAdminById($id);
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_admin', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_admin', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $file_name = $_FILES['img_url']['name'];
            $file_name_pieces = explode('_', $file_name);
            $new_file_name = '';
            $count = 1;
            foreach ($file_name_pieces as $piece) {
                if ($count !== 1) {
                    $piece = ucfirst($piece);
                }
                $new_file_name .= $piece;
                $count++;
            }
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => False,
                'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "1768",
                'max_width' => "2024"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'img_url' => $img_url,
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone
                );
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone
                );
            }
            $username = $this->input->post('name');
            if (empty($id)) {     // Adding New Admin
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                    redirect('department/admin');
                } else {
                    $dfg = 11;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->department_model->insertAdmin($data);
                    $admin_user_id = $this->db->get_where('admin', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->department_model->updateAdmin($admin_user_id, $id_info);
                    $this->hospital_model->addHospitalIdToIonUser($ion_user_id, $this->hospital_id);
                    $this->session->set_flashdata('feedback', lang('added'));
                }
            } else { // Updating Admin
                $ion_user_id = $this->db->get_where('admin', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->department_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->department_model->updateAdmin($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('department/admin');
        }
    }

    

    function deleteAdmin() {

        if (!$this->ion_auth->in_group(array('admin'))) {
            redirect('home/permission');
        }

        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('admin', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->department_model->deleteAdmin($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('department/admin');
    }

    public function editForm() {
        $id = $this->input->post('id');
        $formcount = $this->input->post('formcount');
        $isgroup=false;
        $formId="";
        for($i=0; $i<$formcount; $i++){
            $pre="form_".$i."_";
            $fname=$pre."name";
            $fid=$pre."id";
            $formname=$this->input->post($fname);
            $formid=$this->input->post($fid);
            $thisForm=$this->department_model->getDepartmentCaseFormByID($formid);
            //change the name
            $data=array();
            $data=array(
                'name'=>$formname
            );
            // echo "form id: $formid; form name: $formname<br/>";
            $this->department_model->updateCaseFormById($formid,$data);
            if($thisForm->type == "group"){
                $fl="f".$formid;
                $groupCount=$this->department_model->getGroupCount($fl);
                for($e=0; $e< $groupCount; $e++){
                    $g=$pre."group_".$e."_";
                    $gname=$g."name";
                    $gid=$g."id";
                    $formname=$this->input->post($gname);
                    $formid=$this->input->post($gid);
                    $data=array();
                    $data=array(
                        "name"=>$formname
                    );
                    $this->department_model->updateCaseFormById($formid,$data);
                }
            }
            $newCode=$pre."new";
            $newCount=$this->input->post($newCode);
            if($newCount != null){
                if($newCount >0){
                    for($r=0; $r <$newCount; $r++){
                        $e=$r+1;
                        // echo $r." new count: $newCount<br/>";
                        $nn=$pre."newGroup_".$e;
                        $fn=$nn."_name";
                        $fv=$nn."_type";
                        $formname=$this->input->post($fn);
                        $formtype=$this->input->post($fv);
                        switch ($formtype) {
                            case 'text': break;
                            case 'date': break;
                            case 'polar': break;
                            default: $formtype="text"; break;
                        }
                        $data = array();
                        $data = array(
                            'dept_id' => "f".$thisForm->id,
                            'name' => $formname,
                            'type' => $formtype
                        );
                        $this->department_model->InsertCaseForm($data);
                        // // echo " <br/>form name: $formname and form type: $formtype";
                    }
                }
            }
        }
        
        $this->session->set_flashdata('feedback', "Updated");
        redirect('department');

    }

    public function getFormsByJSON(){
        $id = $this->input->get('id');
        if(empty($id)){
            redirect("department");
        }
        $data=array();
        $data['form'] = $this->department_model->getDepartmentCaseForms($id);
        $groups=array();
        foreach($data['form'] as $form){
            if($form->type == "group"){
                $dId="f".$form->id;
                $groups[$form->id]=$this->department_model->getDepartmentCaseForms($dId);
            }
        }
        $data['groups']=$groups;
        echo json_encode($data);

    }

    public function addNew() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Password Field    
        // Validating Email Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[2]|max_length[1000]|xss_clean');
        // Validating Address Field   
        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['department'] = $this->department_model->getDepartmentById($id);
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'name' => $name,
                'description' => $description
            );
            if (empty($id)) {     // Adding New department
                $this->department_model->insertDepartment($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating department
                $this->department_model->updateDepartment($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('department');
        }
    }

    function getDepartment() {
        $data['departments'] = $this->department_model->getDepartment();
        $this->load->view('department', $data);
    }

    function editDepartment() {
        $data = array();
        $id = $this->input->get('id');
        $data['department'] = $this->department_model->getDepartmentById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editDepartmentByJason() {
        $id = $this->input->get('id');
        $data['department'] = $this->department_model->getDepartmentById($id);
        echo json_encode($data);
    }

    function delete() {
        $id = $this->input->get('id');
        $this->department_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('department');
    }

    function consultfee(){
        $dept_id=$this->input->get("id");
        $data['department'] = $this->department_model->getDepartmentById($dept_id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('consult_fee', $data);
        $this->load->view('home/footer'); // just the header file
    }
    
    function addFee(){
        $dept_id=$this->input->post("dept_id");
        $item=$this->input->post("item");
        $price=preg_replace('#[^0-9]#','',$this->input->post("price"));
        //get category id
        $dept=$this->department_model->getDepartmentById($dept_id);
        if($item== "first_visit"){
            $pay_id=$dept->first_visit;
            $category=$dept->name." (First Visit)";
        }else{
            $pay_id=$dept->follow_up;
            $category=$dept->name." (Follow Up)";
        }
        if($pay_id =="" || $pay_id==null){
            $data = array('category' => $category,
                'description' => "",
                'type' => "others",
                'c_price' => $price,
                'd_commission' => "",
                'operation_id'=>""
            );
            $pay_id=$this->finance_model->insertPaymentCategory($data);
            if($item== "first_visit"){
                $data = array(
                    'first_visit' => $pay_id
                );
            }else{
                $data = array(
                    'follow_up' => $pay_id
                );
            }
            $this->department_model->updateDepartment($dept_id, $data);
        }else{
            //update the price
            $data = array(
                'c_price' => $price
            );
            $this->finance_model->updatePaymentCategory($pay_id, $data);
        }
        //redirect
        $this->session->set_flashdata('feedback', "Updated");
        redirect("department/consultfee?id=".$dept_id);
    }

}

/* End of file department.php */
/* Location: ./application/modules/department/controllers/department.php */
