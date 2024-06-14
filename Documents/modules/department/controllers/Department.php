<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department extends MX_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('department_model');

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
                   $n="Group_name_$i";
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

}

/* End of file department.php */
/* Location: ./application/modules/department/controllers/department.php */
