<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bed extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('bed_model');
        $this->load->model('patient/patient_model');
        $this->load->model('finance/finance_model');
        if (!$this->ion_auth->in_group(array('admin', 'Nurse', 'Doctor', 'Accountant'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['beds'] = $this->bed_model->getBed();
        $data['categories'] = $this->bed_model->getBedCategory();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('bed', $data);
        $this->load->view('home/footer'); // just the header file  
    }

    public function addBedView() {
        $data = array();
        $data['categories'] = $this->bed_model->getBedCategory();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_bed_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addBed() {
        $id = $this->input->post('id');
        $number = $this->input->post('number');
        $description = $this->input->post('description');
        $status = $this->input->post('status');
        $category = $this->input->post('category');
        $price = preg_replace('#[^0-9]#','',$this->input->post('price'));

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Price Field
        $this->form_validation->set_rules('number', 'Bed Number', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Generic Name Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        $this->form_validation->set_rules('price', 'price', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Company Name Field

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['categories'] = $this->bed_model->getBedCategory();
                $data['bed'] = $this->bed_model->getBedById($id);
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_bed_view', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['categories'] = $this->bed_model->getBedCategory();
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_bed_view', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $bed_id = implode('-', array($category, $number));
            $data = array();
            $data = array(
                'category' => $category,
                'number' => $number,
                'description' => $description,
                'bed_id' => $bed_id,
                'price' => $price
            );
            if (empty($id)) {
                $id= $this->bed_model->insertBed($data);
                $data = array('category' => $bed_id,
                    'description' => "",
                    'type' => "others",
                    'c_price' => $price,
                    'd_commission' => "",
                    'operation_id'=>"bed_".$id
                );
                $this->finance_model->insertPaymentCategory($data); 
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->bed_model->updateBed($id, $data);
                $current_item = $this->finance_model->getPaymentCategoryByOperation('bed_'.$id);
                $data = array('category' => $bed_id,
                    'description' => "",
                    'type' => "others",
                    'c_price' => $price,
                    'd_commission' => "",
                    'operation_id'=>"bed_".$id
                );
                $this->finance_model->updatePaymentCategory($current_item->id,$data); 
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('bed');
        }
    }

    function editBed() {
        $data = array();
        $data['categories'] = $this->bed_model->getBedCategory();
        $id = $this->input->get('id');
        $data['bed'] = $this->bed_model->getBedById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_bed_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editBedByJason() {
        $id = $this->input->get('id');
        $data['bed'] = $this->bed_model->getBedById($id);
        echo json_encode($data);
    }

    function delete() {
        $id = $this->input->get('id');
        $this->bed_model->deleteBed($id);
        redirect('bed');
    }

    public function bedCategory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['categories'] = $this->bed_model->getBedCategory();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('bed_category', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addCategoryView() {
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_category_view');
        $this->load->view('home/footer'); // just the header file
    }

    public function addCategory() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['bed'] = $this->bed_model->getBedCategoryById($id);
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_category_view', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_category_view', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $data = array();
            $data = array('category' => $category,
                'description' => $description
            );
            if (empty($id)) {
                $this->bed_model->insertBedCategory($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->bed_model->updateBedCategory($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('bed/bedCategory');
        }
    }

    function editCategory() {
        $data = array();
        $id = $this->input->get('id');
        $data['bed'] = $this->bed_model->getBedCategoryById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_category_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editBedCategoryByJason() {
        $id = $this->input->get('id');
        $data['bedcategory'] = $this->bed_model->getBedCategoryById($id);
        echo json_encode($data);
    }

    function deleteBedCategory() {
        $id = $this->input->get('id');
        $this->bed_model->deleteBedCategory($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('bed/bedCategory');
    }

    function bedAllotment() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['beds'] = $this->bed_model->getBed();
        $data['patients'] = $this->patient_model->getPatient();
        $data['alloted_beds'] = $this->bed_model->getAllotment();

        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('bed_allotment', $data);
        $this->load->view('home/footer'); // just 
    }

    function addAllotmentView() {
        $data = array();
        $data['beds'] = $this->bed_model->getBed();
        $data['patients'] = $this->patient_model->getPatient();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_allotment_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function addAllotment() {
        $id = $this->input->post('id');
        $patient = $this->input->post('patient');
        $a_time = $this->input->post('a_time');
        $d_time = $this->input->post('d_time');
        $status = $this->input->post('status');
        $bed_id = $this->input->post('bed_id');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Field
        $this->form_validation->set_rules('bed_id', 'Bed', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Alloted Time Field
        $this->form_validation->set_rules('a_time', 'Alloted Time', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Discharge Time Field
        $this->form_validation->set_rules('d_time', 'Discharge Time', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Status Field
        $this->form_validation->set_rules('status', 'Status', 'trim|min_length[1]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['beds'] = $this->bed_model->getBed();
            $data['patients'] = $this->patient_model->getPatient();
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('add_allotment_view', $data);
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $patientname = $this->patient_model->getPatientById($patient)->name;
            if (!empty($patient)) {
                $patient_details = $this->patient_model->getPatientById($patient);
                $patient_name = $patient_details->name;
                $patient_phone = $patient_details->phone;
                $patient_address = $patient_details->address;
            } else {
                $patient_name = 0;
                $patient_phone = 0;
                $patient_address = 0;
            }
            $bedInfo=$this->bed_model->getBedByBedId($bed_id);
            $bed_id=$bedInfo->id;
            $dis="none";
            

            //if d_time is not null add the payment
            $last_d_time = explode('-', $d_time);
            $al_time = explode('-', $a_time);
            if (!empty($al_time[1])) {
                $atime = explode(' ', $al_time[1]);
                $last_d_h = explode(':', $atime[1]);
                if ($atime[2] == 'AM') {
                    $last_d_m = ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
                } else {
                    $last_d_m = (12 * 60 * 60) + ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
                }
                $al_time = strtotime($al_time[0]) + $last_d_m;
		        $d=1;
            }
            if (!empty($last_d_time[1])) {
                $last_d_h_am_pm = explode(' ', $last_d_time[1]);
                $last_d_h = explode(':', $last_d_h_am_pm[1]);
                if ($last_d_h_am_pm[2] == 'AM') {
                    $last_d_m = ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
                } else {
                    $last_d_m = (12 * 60 * 60) + ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
                }
                $last_d_time = strtotime($last_d_time[0]) + $last_d_m;
                $dis=$last_d_time;
                $diff=$last_d_time -$al_time;
                $_24=60*60;
                $tH=round($diff/$_24);
                $rm=$tH % 24;
                $d=round($tH / 24);
                if($rm >  6){
                    $d=$d+1;
                }
            }
            $data = array(
                'bed_id' => $bedInfo->id,
                'bed_name'=>$bedInfo->bed_id,
                'patient' => $patient,
                'a_time' => $a_time,
                'd_time' => $d_time,
                'discharge' => $dis,
                'status' => $status,
                'patientname' => $patientname
            );
            $data1 = array(
                'last_a_time' => $a_time,
                'last_d_time' => $d_time,
            );
            $update=false;
            if (empty($id)) {
                $id=$this->bed_model->insertAllotment($data);
                $this->bed_model->updateBedById($bed_id, $data1);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->bed_model->updateAllotment($id, $data);
                $this->bed_model->updateBedById($bed_id, $data1);
                $this->session->set_flashdata('feedback', lang('updated'));
                $update=true;
            }
                //get the price of the bed
                $current_item = $this->finance_model->getPaymentCategoryByOperation('bed_'.$bed_id);
                if($patient_details->patient_type != "Private Patient") {
                    $hmo_id=$patient_details->insurance_id;
                    $hmo=$this->finance_model->getHMOCategoryPrice($hmo_id,$current_item->id);
                    if($hmo != null){
                        $price=$hmo->price;
                    }else{
                        $price=$current_item->c_price;
                    }
                }else{
                    $price=$current_item->c_price;
                }

                $category_price = $price;
                $category_type = $current_item->type;
                $qty = $d;
                $key=$current_item->id;
                $category_name=array();
                unset($category_name);
                unset($cat_and_price);
                $cat_and_price[] = $key . '*' . $category_price . '*' . $category_type . '*' . $qty;
                $category_name = implode(',', $cat_and_price);
                //add the bill 
                $amount=$price;
                $pay_data = array(
                    'category_name' => $category_name,
                    'patient' => $patient,
                    'date' => time(),
                    'amount' => $amount,
                    'doctor' => "",
                    'discount' => '0',
                    'flat_discount' => '0',
                    'gross_total' => $amount,
                    'status' => 'unpaid',
                    'hospital_amount' => $amount,
                    'doctor_amount' => '0',
                    'user' => $this->ion_auth->get_user_id(),
                    'patient_name' => $patient_name,
                    'patient_phone' => $patient_phone,
                    'patient_address' => $patient_address,
                    'doctor_name' => "",
                    'date_string' => date('d-m-Y',time()),
                    'remarks' => ""
                );
                if($update){
                    //get the payment id
                    $allot=$this->bed_model->getAllotmentById($id);
                    $pay_id=$allot->payment_id;
                    $this->finance_model->updatePayment($pay_id, $pay_data);
                }else{
                    $pay_id=$this->finance_model->insertPayment($pay_data);
                    $data2 = array(
                        'payment_id' => $pay_id,
                    );
                    $this->bed_model->updateAllotment($id, $data2);
                }
        }
        
        redirect('bed/bedAllotment');
    }

    function editAllotment() {
        $data = array();
        $data['beds'] = $this->bed_model->getBed();
        $data['patients'] = $this->patient_model->getPatient();
        $id = $this->input->get('id');
        $data['allotment'] = $this->bed_model->getAllotmentById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_allotment_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editAllotmentByJason() {
        $id = $this->input->get('id');
        $data['allotment'] = $this->bed_model->getAllotmentById($id);
        $data['patient'] = $this->patient_model->getPatientById($data['allotment']->patient);
        echo json_encode($data);
    }

    function deleteAllotment() {
        $id = $this->input->get('id');
        $this->bed_model->deleteBedAllotment($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('bed/bedAllotment');
    }

    function getBedList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['beds'] = $this->bed_model->getBedBysearch($search);
            } else {
                $data['beds'] = $this->bed_model->getBed();
            }
        } else {
            if (!empty($search)) {
                $data['beds'] = $this->bed_model->getBedByLimitBySearch($limit, $start, $search);
            } else {
                $data['beds'] = $this->bed_model->getBedByLimit($limit, $start);
            }
        }


        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;
        foreach ($data['beds'] as $bed) {
            $i = $i + 1;

            $option1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="' . $bed->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</button>';

            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="bed/delete?id=' . $bed->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i> ' . lang('delete') . '</a>';
            $last_a_time = explode('-', $bed->last_a_time);
            $last_d_time = explode('-', $bed->last_d_time);
            if (!empty($last_d_time[1])) {
                $last_d_h_am_pm = explode(' ', $last_d_time[1]);
                $last_d_h = explode(':', $last_d_h_am_pm[1]);
                if ($last_d_h_am_pm[2] == 'AM') {
                    $last_d_m = ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
                } else {
                    $last_d_m = (12 * 60 * 60) + ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
                }
                $last_d_time = strtotime($last_d_time[0]) + $last_d_m;
            }
            if (!empty($bed->last_a_time)) {
                if (empty($bed->last_d_time)) {
                    $bedstatus = '<button type="button" class="btn btn-primary">' . lang('alloted') . '</button>';
                } elseif ((time() > $last_d_time)) {
                    $bedstatus = '<button type="button" class="btn btn-success">' . lang('available') . '</button>';
                } elseif ((time() < $last_d_time)) {
                    $bedstatus = '<button type="button" class="btn btn-primary">' . lang('alloted') . '</button>';
                }
            } else {
                $bedstatus = '<button type="button" class="btn btn-success">' . lang('available') . '</button>';
            }

            $settings = $this->settings_model->getSettings();
            $info[] = array(
                $bed->bed_id,
                $bed->description,
                $settings->currency.$bed->price,
                $bedstatus,
                $option1 . ' ' . $option2
            );
        }

        if (!empty($data['beds'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('bed')->num_rows(),
                "recordsFiltered" => $this->db->get('bed')->num_rows(),
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

    function getBedAllotmentList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['beds'] = $this->bed_model->getBedAllotmentBysearch($search);
            } else {
                $data['beds'] = $this->bed_model->getAllotment();
            }
        } else {
            if (!empty($search)) {
                $data['beds'] = $this->bed_model->getBedAllotmentByLimitBySearch($limit, $start, $search);
            } else {
                $data['beds'] = $this->bed_model->getBedAllotmentByLimit($limit, $start);
            }
        }


        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;
        foreach ($data['beds'] as $bed) {
            $i = $i + 1;

            $option1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="' . $bed->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</button>';

            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="bed/deleteAllotment?id=' . $bed->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i> ' . lang('delete') . '</a>';

            $patientdetails = $this->patient_model->getPatientById($bed->patient);
            if (!empty($patientdetails)) {
                $patientname = $patientdetails->name;
            } else {
                $patientname = $bed->patientname;
            }

            $info[] = array(
                $bed->bed_id,
                $patientname,
                $bed->a_time,
                $bed->d_time,
                $option1 . ' ' . $option2
            );
        }

        if (!empty($data['beds'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('alloted_bed')->num_rows(),
                "recordsFiltered" => $this->db->get('alloted_bed')->num_rows(),
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

/* End of file bed.php */
/* Location: ./application/modules/bed/controllers/bed.php */
