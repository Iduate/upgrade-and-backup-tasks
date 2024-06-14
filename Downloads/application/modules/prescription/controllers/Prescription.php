<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prescription extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('prescription_model');
        $this->load->model('medicine/medicine_model');
        $this->load->model('medicine/medicine_model');
        $this->load->model('finance/pharmacy_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('patient/patient_model');
        if (!$this->ion_auth->in_group(array('admin', 'Pharmacist', 'Doctor', 'Patient', 'Nurse','Record_Officer','Receptionist'))) {
            redirect('home/permission');
        }
    }

    public function index() {

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }

        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        if ($this->ion_auth->in_group(array('Doctor'))) {
            $current_user = $this->ion_auth->get_user_id();
            $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
        }
        $data['prescriptions'] = $this->prescription_model->getPrescriptionByDoctorId($doctor_id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('prescription', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function all() {

        if (!$this->ion_auth->in_group(array('admin', 'Doctor', 'Pharmacist','Nurse'))) {
            redirect('home/permission');
        }

        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['prescriptions'] = $this->prescription_model->getPrescription();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('all_prescription', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function dispensed() {

        if (!$this->ion_auth->in_group(array('admin', 'Doctor', 'Pharmacist','Nurse'))) {
            redirect('home/permission');
        }

        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['prescriptions'] = $this->prescription_model->getPrescription();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('dispensed_prescription', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addPrescriptionView() {

        if (!$this->ion_auth->in_group(array('admin', 'Doctor'))) {
            redirect('home/permission');
        }

        $data = array();
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        if($this->input->get("cid")!= null){
            $data['case']=$this->patient_model->getMedicalHistoryById($this->input->get("cid"));
            $patient = $data['case']->patient_id;
            $data['patient'] = $this->patient_model->getPatientById($patient);
        }

        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_prescription_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewPrescription() {

        if (!$this->ion_auth->in_group(array('admin', 'Doctor','Pharmacist'))) {
            redirect('home/permission');
        }

        $id = $this->input->post('id');
        $tab = $this->input->post('tab');
        $date = $this->input->post('date');
        if (!empty($date)) {
            $date = strtotime($date);
        }

        $patient = $this->input->post('patient');
        $doctor = $this->input->post('doctor');
        $symptom = $this->input->post('symptom');
        $medicine = $this->input->post('medicine');
        $dosage = $this->input->post('dosage');
        $frequency = $this->input->post('frequency');
        $days = $this->input->post('days');
        $instruction = $this->input->post('instruction');
        $note = $this->input->post('note');
        $admin = $this->input->post('admin');


        $advice = $this->input->post('advice');

        $report = array();

        if (!empty($medicine)) {
            foreach ($medicine as $key => $value) {
                $report[$value] = array(
                    'dosage' => $dosage[$key],
                    'frequency' => $frequency[$key],
                    'days' => $days[$key],
                    'instruction' => $instruction[$key],
                );

                // }
            }

            foreach ($report as $key1 => $value1) {
                $final[] = $key1 . '***' . implode('***', $value1);
            }

            $final_report = implode('###', $final);
        } else {
            $final_report = '';
        }





        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Date Field
        $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Doctor Field
        $this->form_validation->set_rules('doctor', 'Doctor', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Advice Field
        $this->form_validation->set_rules('symptom', 'History', 'trim|min_length[1]|max_length[1000]|xss_clean');
        // Validating Do And Dont Name Field
        $this->form_validation->set_rules('note', 'Note', 'trim|min_length[1]|max_length[1000]|xss_clean');

        // Validating Advice Field
        $this->form_validation->set_rules('advice', 'Advice', 'trim|min_length[1]|max_length[1000]|xss_clean');

        // Validating Validity Field
        $this->form_validation->set_rules('validity', 'Validity', 'trim|min_length[1]|max_length[100]|xss_clean');



        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect('prescription/editPrescription?id=' . $id);
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['medicines'] = $this->medicine_model->getMedicine();
                $data['patients'] = $this->patient_model->getPatient();
                $data['doctors'] = $this->doctor_model->getDoctor();
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data); // just the header file
                $this->load->view('add_new_prescription_view', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $data = array();
            $patientname = $this->patient_model->getPatientById($patient)->name;
            $doctorname = $this->doctor_model->getDoctorById($doctor)->name;
            $data = array('date' => $date,
                'patient' => $patient,
                'doctor' => $doctor,
                'symptom' => $symptom,
                'medicine' => $final_report,
                'note' => $note,
                'advice' => $advice,
                'patientname' => $patientname,
                'doctorname' => $doctorname,
                'status' => "0",
                'edited_by'=>""
            );
            if (empty($id)) {
                $this->prescription_model->insertPrescription($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                if ($this->ion_auth->in_group(array('Pharmacist'))) {
                    $data = array('date' => $date,
                        'patient' => $patient,
                        'doctor' => $doctor,
                        'symptom' => $symptom,
                        'medicine' => $final_report,
                        'note' => $note,
                        'advice' => $advice,
                        'patientname' => $patientname,
                        'doctorname' => $doctorname,
                        'status' => "0",
                        'edited_by'=>$this->ion_auth->get_user_id()
                    );
                }
                $this->prescription_model->updatePrescription($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }

            if (!empty($admin)) {
                if ($this->ion_auth->in_group(array('Doctor'))) {
                    redirect('prescription');
                } else {
                    redirect('prescription/all');
                }
            } else {
                redirect('prescription');
            }
        }
    }

    function viewPrescription() {
        $id = $this->input->get('id');
        $data['prescription'] = $this->prescription_model->getPrescriptionById($id);

        if (!empty($data['prescription']->hospital_id)) {
            if ($data['prescription']->hospital_id != $this->session->userdata('hospital_id')) {
                $this->load->view('home/permission');
            } else {
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data); // just the header file
                $this->load->view('prescription_view_1', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $this->load->view('home/permission');
        }
    }

    function viewPrescriptionPrint() {
        $id = $this->input->get('id');
        $data['prescription'] = $this->prescription_model->getPrescriptionById($id);

        if (!empty($data['prescription']->hospital_id)) {
            if ($data['prescription']->hospital_id != $this->session->userdata('hospital_id')) {
                $this->load->view('home/permission');
            } else {
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data); // just the header file
                $this->load->view('prescription_view_print', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $this->load->view('home/permission');
        }
    }

    function editPrescription() {
        $data = array();
        $id = $this->input->get('id');
        // $data['patients'] = $this->patient_model->getPatient();
        // $data['doctors'] = $this->doctor_model->getDoctor();
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['prescription'] = $this->prescription_model->getPrescriptionById($id);
        if($data['prescription']->status == "1"){
            echo "YOU CANNOT EDIT THIS PRESCRIPTION AS IT HAS ALREADY BEEN DISPENSED";
            die();
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['patients'] = $this->patient_model->getPatientById($data['prescription']->patient);
        $data['doctors'] = $this->doctor_model->getDoctorById($data['prescription']->doctor);
        if (!empty($data['prescription']->hospital_id)) {
            if ($data['prescription']->hospital_id != $this->session->userdata('hospital_id')) {
                $this->load->view('home/permission');
            } else {
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data); // just the header file
                $this->load->view('add_new_prescription_view', $data);
                $this->load->view('home/footer'); // just the footer file 
            }
        } else {
            $this->load->view('home/permission');
        }
    }

    function editPrescriptionByJason() {
        $id = $this->input->get('id');
        $data['prescription'] = $this->prescription_model->getPrescriptionById($id);
        echo json_encode($data);
    }

    function getPrescriptionByPatientIdByJason() {
        $id = $this->input->get('id');
        $prescriptions = $this->prescription_model->getPrescriptionByPatientId($id);
        foreach ($prescriptions as $prescription) {
            $lists[] = ' <div class="pull-left prescription_box" style = "padding: 10px; background: #fff;"><div class="prescription_box_title">Prescription Date</div> <div>' . date('d-m-Y', $prescription->date) . '</div> <div class="prescription_box_title">Medicine</div> <div>' . $prescription->medicine . '</div> </div> ';
        }
        $data['prescription'] = $lists;
        $lists = NULL;
        echo json_encode($data);
    }

    function getPrescriptionById() {
        $id = $this->input->get('id');
        $prescription = $this->prescription_model->getPrescriptionById($id);
        $data['prescription'] = $prescription;
        $medicine = $prescription->medicine;
        $medicine = explode('###', $medicine);
        foreach ($medicine as $key => $value) {
            $single_medicine = explode('***', $value);
            $data['medicine'].="<tr>
            <td>".$this->medicine_model->getMedicineById($single_medicine[0])->name . ' - ' . $single_medicine[1]."</td>
            <td>". $single_medicine[3] . ' - ' . $single_medicine[4]  ."</td>
            <td class='text-right'>".$single_medicine[2] ."</td>
            </tr>";
        }
        $data['date']=date("d - m,Y",$prescription->date);
        $data['doctor']=$this->doctor_model->getDoctorById($prescription->doctor)->name;
        echo json_encode($data);
    }

    function delete() {
        $id = $this->input->get('id');
        $admin = $this->input->get('admin');
        $patient = $this->input->get('patient');
        $data['prescription'] = $this->prescription_model->getPrescriptionById($id);
        if (!empty($data['prescription']->hospital_id)) {
            if ($data['prescription']->hospital_id != $this->session->userdata('hospital_id')) {
                $this->load->view('home/permission');
            } else {
                $this->prescription_model->deletePrescription($id);
                $this->session->set_flashdata('feedback', lang('deleted'));
                if (!empty($patient)) {
                    redirect('patient/caseHistory?patient_id=' . $patient);
                } elseif (!empty($admin)) {
                    redirect('prescription/all');
                } else {
                    redirect('prescription');
                }
            }
        } else {
            $this->load->view('home/permission');
        }
    }


    public function prescriptionCategory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['categories'] = $this->prescription_model->getPrescriptionCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('prescription_category', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addCategoryView() {
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_category_view');
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewCategory() {
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
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_new_category_view');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array('category' => $category,
                'description' => $description
            );
            if (empty($id)) {
                $this->prescription_model->insertPrescriptionCategory($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->prescription_model->updatePrescriptionCategory($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('prescription/prescriptionCategory');
        }
    }

    function edit_category() {
        $data = array();
        $id = $this->input->get('id');
        $data['prescription'] = $this->prescription_model->getPrescriptionCategoryById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_category_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editPrescriptionCategoryByJason() {
        $id = $this->input->get('id');
        $data['prescriptioncategory'] = $this->prescription_model->getPrescriptionCategoryById($id);
        echo json_encode($data);
    }

    function deletePrescriptionCategory() {
        $id = $this->input->get('id');
        $this->prescription_model->deletePrescriptionCategory($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('prescription/prescriptionCategory');
    }

    function markDispense(){
        //get the list of all prescription first
        $query = $this->db->get('prescription')->result();
        foreach($query as $r){
            $pres_id=$r->id;
            $dispense_status=-1;
            $invoice=$this->pharmacy_model->getPaymentByPrescriptionId($pres_id);
            $category_name1 = explode(',', $invoice->category_name);
            foreach ($category_name1 as $category_name2) {
                $category_name3 = explode('*', $category_name2);
                if ($category_name3[1] > 0) {
                    $qty =$category_name3[2];
                    if($qty <1){
                        $dispense_status=0;
                        break;
                    }else if($qty >0){
                        $dispense_status=1;
                    }
                }
            }
            if($dispense_status == -1){
                //non dispensed
                $data = array(
                    'status' => "0"
                );
            }else {
                //dispensed
                $data = array(
                    'status' => "1"
                );
            }
            $this->prescription_model->updatePrescription($pres_id, $data);
        }
    }

    //FUNCTION FOR UPDATING PHARMACY TABLE STATUS
    //FUNCTION TO UPDATE THE STATUS IN PHARMACY TABLE
    

    function updatePrescriptionStatus(){
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('pharmacy_payment')->result();
        $list=array();
        foreach($query as $r){
            if($r->prescription_id ===null)
                continue;
            array_push($list,$r->prescription_id);
        }
        $feederslist=join("','",$list);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("id IN ('$feederslist')");
        $this->db->order_by('id', 'desc');
        $data=array("status"=>"1");
        $this->db->update('prescription', $data);
    }

    function getPrescriptionListByDoctor() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $doctor_ion_id = $this->ion_auth->get_user_id();
        $doctor = $this->db->get_where('doctor', array('ion_user_id' => $doctor_ion_id))->row()->id;
        if ($limit == -1) {
            if (!empty($search)) {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionBysearchByDoctor($doctor, $search);
            } else {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionByDoctor($doctor);
            }
        } else {
            if (!empty($search)) {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionByLimitBySearchByDoctor($doctor, $limit, $start, $search);
            } else {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionByLimitByDoctor($doctor, $limit, $start);
            }
        }


        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;
        $option1 = '';
        $option2 = '';
        $option3 = '';
        foreach ($data['prescriptions'] as $prescription) {
            //$i = $i + 1;
            $settings = $this->settings_model->getSettings();

            $option1 = '<a class="btn btn-info btn-xs btn_width" href="prescription/viewPrescription?id=' . $prescription->id . '"><i class="fa fa-eye">' . lang('view') . ' ' . lang('prescription') . ' </i></a>';
            $option3 = '<a class="btn btn-info btn-xs btn_width" href="prescription/editPrescription?id=' . $prescription->id . '" data-id="' . $prescription->id . '"><i class="fa fa-edit"></i> ' . lang('edit') . ' ' . lang('prescription') . '</a>';
            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="prescription/delete?id=' . $prescription->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';
            $options4 = '<a class="btn btn-info btn-xs invoicebutton" title="' . lang('print') . '" style="color: #fff;" href="prescription/viewPrescriptionPrint?id=' . $prescription->id . '"target="_blank"> <i class="fa fa-print"></i> ' . lang('print') . '</a>';
            
            if (!empty($prescription->medicine)) {
                $medicine = explode('###', $prescription->medicine);
                $medicinelist = '';
                foreach ($medicine as $key => $value) {
                    $medicine_id = explode('***', $value);
                    $medicine_name_with_dosage = $this->medicine_model->getMedicineById($medicine_id[0])->name . ' -' . $medicine_id[1];
                    $medicine_name_with_dosage = $medicine_name_with_dosage . ' | ' . $medicine_id[3] . '<br>';
                    rtrim($medicine_name_with_dosage, ',');
                    $medicinelist .= '<p>' . $medicine_name_with_dosage . '</p>';
                }
            } else {
                $medicinelist = '';
            }

            if($prescription->status =="1"){
                $option3 = '<a class="btn btn-info btn-xs btn_width" href="#" ><i class="fa fa-tick"></i> Dispensed</a>';
            }
            $patientdetails = $this->patient_model->getPatientById($prescription->patient);
            if (!empty($patientdetails)) {
                $patientname = $patientdetails->name;
            } else {
                $patientname = $prescription->patientname;
            }
            $info[] = array(
                $prescription->id,
                date('d-m-Y', $prescription->date),
                $patientname,
                $prescription->patient,
                $medicinelist,
                $option1 . ' ' . $option3 . ' ' . $option2 . ' ' . $options4
            );
            $i = $i + 1;
        }

        if ($data['prescriptions']) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $i,
                "recordsFiltered" => $i,
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

    function getPrescriptionList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionBysearch($search);
            } else {
                $data['prescriptions'] = $this->prescription_model->getPrescription();
            }
        } else {
            if (!empty($search)) {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionByLimitBySearch($limit, $start, $search);
                // echo "hexxxre";
            } else {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionByLimit($limit, $start);
                // echo "hewwwre";
            }
        }


        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;
        $option1 = '';
        $option2 = '';
        $option3 = '';
        foreach ($data['prescriptions'] as $prescription) {
            //$i = $i + 1;
            $settings = $this->settings_model->getSettings();

            $option1 = '<a title="' . lang('view') . ' ' . lang('prescription') . '" class="btn btn-info btn-xs btn_width" href="prescription/viewPrescription?id=' . $prescription->id . '"><i class="fa fa-eye"> ' . lang('view') . ' ' . lang('prescription') . ' </i></a>';
            $option3 = '<a class="btn btn-info btn-xs btn_width" href="prescription/editPrescription?id=' . $prescription->id . '" data-id="' . $prescription->id . '"><i class="fa fa-edit"></i> ' . lang('edit') . ' ' . lang('prescription') . '</a>';
            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="prescription/delete?id=' . $prescription->id . '&admin=' . $prescription->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';
            $options4 = '<a class="btn btn-info btn-xs invoicebutton" title="' . lang('print') . '" style="color: #fff;" href="prescription/viewPrescriptionPrint?id=' . $prescription->id . '"target="_blank"> <i class="fa fa-print"></i> ' . lang('print') . '</a>';
            $options5 = '<a class="btn btn-info btn-xs btn_width" title="Dispense Medicine" href="finance/pharmacy/addPaymentView?pid=' . $prescription->id . '"><i class="fas fa-capsules"> Dispense </i></a>';

            if (!empty($prescription->medicine)) {
                $medicine = explode('###', $prescription->medicine);
                $medicinelist = '';
                foreach ($medicine as $key => $value) {
                    $medicine_id = explode('***', $value);
                    $medicine_name_with_dosage = $this->medicine_model->getMedicineById($medicine_id[0])->name . ' -' . $medicine_id[1];
                    $medicine_name_with_dosage = $medicine_name_with_dosage . ' | ' . $medicine_id[3] . '<br>';
                    rtrim($medicine_name_with_dosage, ',');
                    $medicinelist .= '<p>' . $medicine_name_with_dosage . '</p>';
                }
            } else {
                $medicinelist = '';
            }
            $patientdetails = $this->patient_model->getPatientById($prescription->patient);
            if (!empty($patientdetails)) {
                $patientname = $patientdetails->name;
            } else {
                $patientname = $prescription->patientname;
            }
            $doctordetails = $this->doctor_model->getDoctorById($prescription->doctor);
            if (!empty($doctordetails)) {
                $doctorname = $doctordetails->name;
            } else {
                $doctorname = $prescription->doctorname;
            }

            if($prescription -> status == "1"){
                $option3 ="";
            }

            //checking the dispense status of prescription
            $pres_id=$prescription->id;
            $dispense_status=-1;
            $invoice=$this->pharmacy_model->getPaymentByPrescriptionId($pres_id);
            $category_name1 = explode(',', $invoice->category_name);
            foreach ($category_name1 as $category_name2) {
                $category_name3 = explode('*', $category_name2);
                if ($category_name3[1] > 0) {
                    $qty =$category_name3[2];
                    if($qty <1){
                        $dispense_status=0;
                        break;
                    }else if($qty >0){
                        $dispense_status=1;
                    }
                }
            }
            if($dispense_status == -1){
                $options5 = '<a style="background:orange" class="btn btn-info btn-xs btn_width" title="Dispense Medicine" href="finance/pharmacy/addPaymentView?pid=' . $prescription->id . '"><i class="fas fa-capsules"> Dispense </i></a>';
            }else if($dispense_status == 0){
                $options5 = '<a style="background:red" class="btn btn-info btn-xs btn_width" title="Incomplete Dispense" href="finance/pharmacy/invoice?id=' . $invoice->id . '"><i class="fas fa-capsules"> Dispense Incomplete </i></a>';
            }else{
                $options5 = '<a class="btn btn-info btn-xs btn_width" title="Medicine Dispensed" href="finance/pharmacy/invoice?id=' . $invoice->id . '"><i class="fas fa-capsules"> Dispensed</i></a>';
            }
            
            if ($this->ion_auth->in_group(array('Receptionist'))) {
                $option2 = '';
                $option3 = '';
            }
            
            if ($this->ion_auth->in_group(array('Pharmacist'))) {
                $option2 = '';
            }
            $edited_by="";
            if(!empty($prescription -> edited_by)){
                $eb= $this->db->get_where('users', array('id' => $prescription -> edited_by))->row()->username;
                $edited_by="<br/><b>Edited By: </b>".$eb;
            }

            $info[] = array(
                $prescription->id,
                date('d-m-Y', $prescription->date),
                $doctorname.$edited_by,
                $patientname,
                $medicinelist,
                $option1 . ' ' . $option3 . ' ' . $options4 . ' ' . $option2. ' ' . $options5,
            );
            $i = $i + 1;
        }
        

        if ($data['prescriptions']) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->prescription_model->getTotalPrescription(),
                "recordsFiltered" => $this->prescription_model->getTotalPrescription(),
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

    function getDispensedPrescriptionList(){
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['prescriptions'] = $this->prescription_model->getDispensedPrescriptionBysearch($search);
            } else {
                $data['prescriptions'] = $this->prescription_model->getDispensedPrescription();
            }
        } else {
            if (!empty($search)) {
                $data['prescriptions'] = $this->prescription_model->getDispensedPrescriptionByLimitBySearch($limit, $start, $search);
                
            } else {
                $data['prescriptions'] = $this->prescription_model->getDispensedPrescriptionByLimit($limit, $start);
                
            }
        }


        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;
        $option1 = '';
        $option2 = '';
        $option3 = '';
        foreach ($data['prescriptions'] as $prescription) {
            //$i = $i + 1;
            $settings = $this->settings_model->getSettings();

            $option1 = '<a title="' . lang('view') . ' ' . lang('prescription') . '" class="btn btn-info btn-xs btn_width" href="prescription/viewPrescription?id=' . $prescription->id . '"><i class="fa fa-eye"> ' . lang('view') . ' ' . lang('prescription') . ' </i></a>';
            $option3 = '<a class="btn btn-info btn-xs btn_width" href="prescription/editPrescription?id=' . $prescription->id . '" data-id="' . $prescription->id . '"><i class="fa fa-edit"></i> ' . lang('edit') . ' ' . lang('prescription') . '</a>';
            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="prescription/delete?id=' . $prescription->id . '&admin=' . $prescription->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';
            $options4 = '<a class="btn btn-info btn-xs invoicebutton" title="' . lang('print') . '" style="color: #fff;" href="prescription/viewPrescriptionPrint?id=' . $prescription->id . '"target="_blank"> <i class="fa fa-print"></i> ' . lang('print') . '</a>';
            $options5 = '<a class="btn btn-info btn-xs btn_width" title="Dispense Medicine" href="finance/pharmacy/addPaymentView?pid=' . $prescription->id . '"><i class="fas fa-capsules"> Dispense </i></a>';

            if (!empty($prescription->medicine)) {
                $medicine = explode('###', $prescription->medicine);
                $medicinelist = '';
                foreach ($medicine as $key => $value) {
                    $medicine_id = explode('***', $value);
                    $medicine_name_with_dosage = $this->medicine_model->getMedicineById($medicine_id[0])->name . ' -' . $medicine_id[1];
                    $medicine_name_with_dosage = $medicine_name_with_dosage . ' | ' . $medicine_id[3] . '<br>';
                    rtrim($medicine_name_with_dosage, ',');
                    $medicinelist .= '<p>' . $medicine_name_with_dosage . '</p>';
                }
            } else {
                $medicinelist = '';
            }
            $patientdetails = $this->patient_model->getPatientById($prescription->patient);
            if (!empty($patientdetails)) {
                $patientname = $patientdetails->name;
            } else {
                $patientname = $prescription->patientname;
            }
            $doctordetails = $this->doctor_model->getDoctorById($prescription->doctor);
            if (!empty($doctordetails)) {
                $doctorname = $doctordetails->name;
            } else {
                $doctorname = $prescription->doctorname;
            }

            //checking the dispense status of prescription
            $pres_id=$prescription->id;
            $dispense_status=-1;
            $invoice=$this->pharmacy_model->getPaymentByPrescriptionId($pres_id);
            $category_name1 = explode(',', $invoice->category_name);
            foreach ($category_name1 as $category_name2) {
                $category_name3 = explode('*', $category_name2);
                $qty =$category_name3[2];
                if($qty <1){
                    $dispense_status=0;
                    break;
                }else if($qty >0){
                    $dispense_status=1;
                }
            }
            if($dispense_status == -1){
                $options5 = '<a style="background:orange" class="btn btn-info btn-xs btn_width" title="Dispense Medicine" href="finance/pharmacy/addPaymentView?pid=' . $prescription->id . '"><i class="fas fa-capsules"> Dispense </i></a>';
            }else if($dispense_status == 0){
                $options5 = '<a style="background:red" class="btn btn-info btn-xs btn_width" title="Incomplete Dispense" href="finance/pharmacy/invoice?id=' . $invoice->id . '"><i class="fas fa-capsules"> Dispense Incomplete </i></a>';
            }else{
                $options5 = '<a class="btn btn-info btn-xs btn_width" title="Medicine Dispensed" href="finance/pharmacy/invoice?id=' . $invoice->id . '"><i class="fas fa-capsules"> Dispensed</i></a>';
            }
            
            if ($this->ion_auth->in_group(array('Pharmacist', 'Receptionist'))) {
                $option2 = '';
                $option3 = '';
            }

            $info[] = array(
                $prescription->id,
                date('d-m-Y', $prescription->date),
                $doctorname,
                $patientname,
                $medicinelist,
                $option1 . ' ' . $option3 . ' ' . $options4 . ' ' . $option2. ' ' . $options5,
            );
            $i = $i + 1;
        }
        

        if ($data['prescriptions']) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->prescription_model->getTotalDispensed(),
                "recordsFiltered" => $this->prescription_model->getTotalDispensed(),
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

    function getPrescriptionListByPatient() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $patient=$this->input->post('id');
        if ($limit == -1) {
            if (!empty($search)) {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionBysearchByPatient($patient, $search);
            } else {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionByPatient($patient);
            }
        } else {
            if (!empty($search)) {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionByLimitBySearchByPatient($patient, $limit, $start, $search);
            } else {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionByLimitByPatient($patient, $limit, $start);
            }
        }


        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;
        $option1 = '';
        $option2 = '';
        $option3 = '';
        foreach ($data['prescriptions'] as $prescription) {
            //$i = $i + 1;
            $settings = $this->settings_model->getSettings();

            $option1 = '<span class="btn btn-info btn-xs btn_width pxinfo" data-id="' . $prescription->id . '" ><i class="fa fa-eye">' . lang('view') . ' ' . lang('prescription') . ' </i></span>';
            $option3 = '<a class="btn btn-info btn-xs btn_width" href="prescription/editPrescription?id=' . $prescription->id . '" data-id="' . $prescription->id . '"><i class="fa fa-edit"></i> ' . lang('edit') . ' ' . lang('prescription') . '</a>';
            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="prescription/delete?id=' . $prescription->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';
            $options4 = '<a class="btn btn-info btn-xs invoicebutton" title="' . lang('print') . '" style="color: #fff;" href="prescription/viewPrescriptionPrint?id=' . $prescription->id . '"target="_blank"> <i class="fa fa-print"></i> ' . lang('print') . '</a>';

            if (!empty($prescription->medicine)) {
                $medicine = explode('###', $prescription->medicine);
                $medicinelist = '';
                foreach ($medicine as $key => $value) {
                    $medicine_id = explode('***', $value);
                    $medicine_name_with_dosage = $this->medicine_model->getMedicineById($medicine_id[0])->name . ' -' . $medicine_id[1];
                    $medicine_name_with_dosage = $medicine_name_with_dosage . ' | ' . $medicine_id[3] . '<br>';
                    rtrim($medicine_name_with_dosage, ',');
                    $medicinelist .= '<p>' . $medicine_name_with_dosage . '</p>';
                }
            } else {
                $medicinelist = '';
            }
            $patientdetails = $this->patient_model->getPatientById($prescription->patient);
            if (!empty($patientdetails)) {
                $patientname = $patientdetails->name;
            } else {
                $patientname = $prescription->patientname;
            }
            $info[] = array(
                $prescription->id,
                date('d-m-Y', $prescription->date),
                $patientname,
                $medicinelist,
                $option1,
            );
            $i = $i + 1;
        }

        if ($data['prescriptions']) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $i,
                "recordsFiltered" => $i,
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

    

    function pharmacyReport() {

        if (!$this->ion_auth->in_group(array('admin', 'Doctor', 'Pharmacist','Nurse'))) {
            // redirect('home/permission');
        }

        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['prescriptions'] = $this->prescription_model->getPrescription();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('prescription_record', $data);
        $this->load->view('home/footer'); // just the header file
    }


    function getPharmacyReport(){
        $dateFrom=$this->input->get("dateFrom");
        $dateTo=$this->input->get("dateTo");
        $_24=60*60*24;
        if (empty($dateFrom)) {
            $s=date("n/j/Y",time());
            $e=date("n/j/Y",time());
            $st=strtotime($s);
            $end=strtotime($e)+$_24;
        }else{
            $st=strtotime($dateFrom);
            $end=strtotime($dateTo)+$_24;
        }
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        
        if(empty($this->input->get("medicine"))){
            if ($limit == -1) {
                $data['prescriptions'] = $this->prescription_model->getPharmacyReport($st,$end);
            } else {
                    $data['prescriptions'] = $this->prescription_model->getPharmacyReportByLimit($st,$end,$limit, $start);
            }
            $recordFiltered=count($this->prescription_model->getPharmacyReport($st,$end));
        }else{
            $data['prescriptions'] = $this->prescription_model->getAllPharmacyReport($st,$end);
            $recordFiltered=0;
        }


        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;
        foreach ($data['prescriptions'] as $invoice) {
            //$i = $i + 1;
            $isMove=false;
            $settings = $this->settings_model->getSettings();
            if (!empty($invoice->category_name)) {
                $medicinelist = '';
                $category_name1 = explode(',', $invoice->category_name);
                foreach ($category_name1 as $category_name2) {
                    $med = explode('*', $category_name2);
                    $qty =$med[2];
                    $medicinelist .= '<p>' .$this->medicine_model->getMedicineById($med[0])->name;
                    $medicinelist.="<br/><b>Quantity: </b>".$med[2];

                }
            } else {
                $medicinelist = '';
            }
            $prescription=null;
            if(!is_null($invoice->prescription_id)){
                $prescription=$this->prescription_model->getPrescriptionById($invoice->prescription_id);
            }
            $patientdetails = $this->patient_model->getPatientById($prescription->patient);
            if(is_null($patientdetails)){
                $patientdetails = $this->patient_model->getPatientById($invoice->patient);
            }
            if (!empty($patientdetails)) {
                $patientname = $patientdetails->name;
                $birthDate = strtotime($patientdetails->birthdate);
                $birthDate = date('m/d/Y', $birthDate);
                $birthDate = explode("/", $birthDate);
                $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
                $patientname.="<br/><b>Age: </b>$age Years(s)";
                if($patientdetails->insurance_sponsor != null){
                    $sp = $this->db->get_where('hmo_sponsor', array('id' => $patientdetails->insurance_sponsor))->row();
                    $sponsor=$sp->name;
                    $hmo = $this->db->get_where('hmo', array('id' => $patientdetails->insurance_id))->row();
                    $insurance=$hmo->name;
                }else{
                    $insurance=$patientdetails->patient_type;
                    $sp = $this->db->get_where('hmo_sponsor', array('id' => $patientdetails->insurance_id))->row();
                    $sponsor=$sp->name;
                }
                $patientname.="<br/><b>Insurance: </b>$insurance";
                $patientname.="<br/><b>Sponsor: </b>$sponsor";
            } else {
                $patientname = $prescription->patientname;
            }
            $doctordetails = $this->doctor_model->getDoctorById($prescription->doctor);
            if (!empty($doctordetails)) {
                $doctorname = $doctordetails->name;
            } else {
                $doctorname = $prescription->doctorname;
            }

            $price=$invoice->amount;
            


            //if it is a each medicine
            if(!empty($this->input->get("medicine"))){
                $pp=$prescription;
                if(empty($invoice -> prescription_id)){
                    $patientname="Nil";
                    $doctorname="Nil";
                    if(!empty($invoice -> patient)){
                        $patientdetails = $this->patient_model->getPatientById($invoice->patient);
                        if (!empty($patientdetails)) {
                            $patientname = $patientdetails->name;
                            $birthDate = strtotime($patientdetails->birthdate);
                            $birthDate = date('m/d/Y', $birthDate);
                            $birthDate = explode("/", $birthDate);
                            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
                            $patientname.="<br/><b>Age: </b>$age Years(s)";
                            if($patientdetails->insurance_sponsor != null){
                                $sp = $this->db->get_where('hmo_sponsor', array('id' => $patientdetails->insurance_sponsor))->row();
                                $sponsor=$sp->name;
                                $hmo = $this->db->get_where('hmo', array('id' => $patientdetails->insurance_id))->row();
                                $insurance=$hmo->name;
                            }else{
                                $insurance=$patientdetails->patient_type;
                                $sp = $this->db->get_where('hmo_sponsor', array('id' => $patientdetails->insurance_id))->row();
                                $sponsor=$sp->name;
                            }
                            $patientname.="<br/><b>Insurance: </b>$insurance";
                            $patientname.="<br/><b>Sponsor: </b>$sponsor";
                        }
                    }
                }else{
                    $prescription=$this->prescription_model->getPrescriptionById($invoice -> prescription_id);
                    $patientdetails = $this->patient_model->getPatientById($prescription->patient);
                    if(is_null($patientdetails)){
                        $patientdetails = $this->patient_model->getPatientById($invoice->patient);
                    }
                    if (!empty($patientdetails)) {
                        $patientname = $patientdetails->name;
                        $birthDate = strtotime($patientdetails->birthdate);
                        $birthDate = date('m/d/Y', $birthDate);
                        $birthDate = explode("/", $birthDate);
                        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
                        $patientname.="<br/><b>Age: </b>$age Years(s)";
                        if($patientdetails->insurance_sponsor != null){
                            $sp = $this->db->get_where('hmo_sponsor', array('id' => $patientdetails->insurance_sponsor))->row();
                            $sponsor=$sp->name;
                            $hmo = $this->db->get_where('hmo', array('id' => $patientdetails->insurance_id))->row();
                            $insurance=$hmo->name;
                        }else{
                            $insurance=$patientdetails->patient_type;
                            $sp = $this->db->get_where('hmo_sponsor', array('id' => $patientdetails->insurance_id))->row();
                            $sponsor=$sp->name;
                        }
                        $patientname.="<br/><b>Insurance: </b>$insurance";
                        $patientname.="<br/><b>Sponsor: </b>$sponsor";
                    } else {
                        $patientname = $prescription->patientname;
                    }
                    $doctordetails = $this->doctor_model->getDoctorById($prescription->doctor);
                    if (!empty($doctordetails)) {
                        $doctorname = $doctordetails->name;
                    } else {
                        $doctorname = $prescription->doctorname;
                    }
                }
                $price="";
                if (!empty($invoice->category_name)) {
                    $medicine = explode(',', $invoice->category_name);
                    $qty="";
                    $medicinelist = '';
                    foreach ($medicine as $key => $value) {
                        $med = explode('*', $value);
                        if($med[0] != $this->input->get("medicine")){
                            continue;
                        }
                        $isMove=true;
                        $medicinelist .= '<p>' . $this->medicine_model->getMedicineById($med[0])->name . '</p>';   
                        $qty=$med[2];
                        $prc=$med[1];
                        $medicinelist .= "<b>Quantity</b>: ".$qty;
                        $medicinelist .= "<br/><b>Unit Price</b>: ".$prc;
                        $price=$qty * $prc;
                    }
                } else {
                    $medicinelist = '';
                    $price="0";
                }

                //work on the each medicine here
                if($isMove){
                    $recordFiltered++;
                }else{
                    continue;
                }


            }
         
            $info[] = array(
                date('d-m-Y', $invoice->date),
                $doctorname,
                $patientname,
                $medicinelist,
                $settings->currency.$price,
            );
            $i = $i + 1;
        }
        

        if ($data['prescriptions']) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $recordFiltered,
                "recordsFiltered" => $recordFiltered,
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

/* End of file prescription.php */
/* Location: ./application/modules/prescription/controllers/prescription.php */
