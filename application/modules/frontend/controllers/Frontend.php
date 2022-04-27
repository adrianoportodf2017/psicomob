<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frontend extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('frontend_model');
        $this->load->model('payment/payment_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('schedule/schedule_model');
        $this->load->model('patient/patient_model');
        $this->load->model('slide/slide_model');
        $this->load->model('service/service_model');
        $this->load->model('email/email_model');
        $this->load->model('featured/featured_model');
        $this->load->model('review/review_model');
        $this->load->model('gallery/gallery_model');
        $this->load->model('gridsection/gridsection_model');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
    }

    public function index()
    {
        $data = array();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['slides'] = $this->slide_model->getActiveSlide();
        $data['services'] = $this->service_model->getService();
        $data['featureds'] = $this->featured_model->getFeatured();
        $data['reviews'] = $this->review_model->getActiveReview();
        $data['images'] = $this->gallery_model->getActiveImages();
        $data['gridsections'] = $this->gridsection_model->getActiveGrids();
        $this->load->view('frontend2', $data);
    }

    public function search($search = NULL, $order = NULL, $dir = NULL)
    {
        $data = array();
        $data['doctors'] = $this->doctor_model->getDoctorBySearch($search, $order, $dir);
        $this->load->view('search', $data);
        $this->load->view('home/footer'); // just the footer file        //$this->load->view('frontend2', $data);
    }

    public function checkout($payment_request = "only_for_mobile")
    {

        $paytm = $this->db->get_where('paymentgateway', array('name =' => 'pagarme'))->row();
        //var_dump( $paytm);
        if ($this->ion_auth->user()->row()) {
            $page_data['user'] =  $this->ion_auth->user()->row();
            $patient = $this->patient_model->getPatientWithDoctor($page_data['user']->id, $_GET['id']);
            if ($patient != NULL) {
                $patient = $patient->row();
            }
        } else {
            $patient = NULL;
        }
        $doctor = $this->db->get_where('doctor', array('id =' =>  $_GET['id']))->row();
        $page_data['payment_request'] = $payment_request;
        $page_data['amount_to_pay'] =  $doctor->amount_to_pay;
        $page_data['discounted'] = null;
        $page_data['profile_details'] =  $paytm;
        $page_data['doctor'] =  $doctor;
        $page_data['date'] =   $_GET['date'];
        $page_data['hour'] =   $_GET['hour'];

        $this->load->view('checkout', $page_data);
        $this->load->view('home/footer');
    }

    public function pagarme_payment()
    
    {
        $post = $this->input->post();
       // var_dump($post);
        $doctor = $this->db->get_where('doctor', array('id =' =>  $post['doctor']))->row();
        $patient_id = '';
       
        $profile_details =  $this->db->get_where('paymentgateway', array('name =' => 'pagarme'))->row();
        if ($profile_details->status == 'test') {
            $public_key = $profile_details->test_api_key;
            $secret_key = $profile_details->encrypted_test_key;
        } else {
            $public_key = $profile_details->public_api_key;
            $secret_key = $profile_details->encrypted_public_key;
        }

        $user =  $this->db->get_where('users', array('email =' =>  $post['email']))->row();
        if ($user != NULL) {
            $ion_user_id = $user->id;
            $patient =  $this->db->get_where('patient', array('ion_user_id =' =>  $ion_user_id))->row();
            if ($patient != NULL) {
                $patient_id = $patient->patient_id;
                $patient_add_date = $patient->add_date;
                $patient_registration_time = $patient->registration_time;
            }
        } else {

            $add_date = date('m/d/y');
            $registration_time = time();
            $patient_add_date = $add_date;
            $patient_registration_time = $registration_time;
            $patient_id = rand(10000, 1000000);

        }
        $p_name = $this->input->post('first_name').' '.$this->input->post('last_name');
        $p_email = $this->input->post('email');
        $p_phone = $this->input->post('phone');
        //$p_age = $this->input->post('p_age');
       // $p_gender = $this->input->post('p_gender');
        $username = $this->input->post('email');


        if (empty($p_email)) {
            $p_email = $p_name . '-' . rand(1, 1000) . '-' . $p_name . '-' . rand(1, 1000) . '@example.com';
        }
        if (!empty($p_name)) {
            $password = $this->input->post('cpf');
        }

        $data_p = array(
            'patient_id' => $patient_id,
            'name' => $p_name,
            'email' => $p_email,
            'phone' => $p_phone,
            //'sex' => $p_gender,
            //'age' => $p_age,
            'add_date' => $patient_add_date,
            'registration_time' => $patient_registration_time,
            'how_added' => 'from_appointment'
        );
        if ($this->ion_auth->email_check($p_email)) {
            $this->patient_model->updatePatient($patient->id, $data_p);
            $patient_user_id = $this->db->get_where('patient', array('email' => $p_email))->row()->id;

           // echo 'teste cadastro'; 

           // $this->session->set_flashdata('warning', lang('this_email_address_is_already_registered'));
           // redirect($redirect);
        } else {
            $dfg = 5;
            $this->ion_auth->register($username, $password, $p_email, $dfg);
            $ion_user_id = $this->db->get_where('users', array('email' => $p_email))->row()->id;
            $this->patient_model->insertPatient($data_p);
            $patient_user_id = $this->db->get_where('patient', array('email' => $p_email))->row()->id;
            $id_info = array('ion_user_id' => $ion_user_id);
            $this->patient_model->updatePatient($patient_user_id, $id_info);
        }
        $patient = $patient_user_id;

        $mail_provider = $this->settings_model->getSettings()->emailtype;
                $email_settings = $this->email_model->getEmailSettingsByType($mail_provider);
                $settngsname = $this->settings_model->getSettings()->system_vendor;
                $base_url = str_replace(array('http://', 'https://', '/'), '', base_url());
                $subject = $base_url . ' - Detalhes do registro';
                $message = 'Olá ' . $p_name . ',<br> Seja bem vindo a Psicomob. <br><br> Aqui estão os detalhes do seu login .<br>  Link: ' . base_url() . 'auth/login <br> Username: ' . $p_email . ' <br> Password: ' . $password . '<br><br> Obrigado, <br>' . $this->settings->title;
                if ($mail_provider == 'Domain Email') {
                    $this->email->from($email_settings->admin_email, $settngsname);
                }
                if ($mail_provider == 'Smtp') {
                    $this->email->from($email_settings->user, $settngsname);
                }
                $this->email->to($p_email);
                $this->email->subject($subject);
                $this->email->message($message);
                $this->email->send(); 

        //THIS IS HOW I CHECKED THE STRIPE PAYMENT STATUS
        $payment = $this->payment_model->pagarme_payment($post, $public_key, isset($post['boleto']) ? 'boleto' : 'credit_card', $doctor);
        if ($payment['status'] == 'paid') {
          
            $redirect = base_url() . 'home/checkout_success/' . $post['course_id'] . '/' . $post['user_id'];
            echo 'deu certo';
            echo json_encode(array('html' => $redirect, 'redirect' => true)); die;
        } elseif ($payment['status'] == 'waiting_payment') {
            $dadosBoleto = $this->session->userdata('transaction');
            $this->crud_model->insert_log_payment($post, 'processando', 'aguardando pagamento boleto');
            $msg = $this->email_model->purchase_notification_pagarme_boleto($payment['amount'], $post, $dadosBoleto);
            $htmlContent = $this->load->view('email/template', $msg, TRUE);
            echo json_encode(array('html' => $htmlContent, 'situacao' => true));
        } else {
            if (strpos($payment['erro'], 'action_forbidden') !== false) {
                $payment['message'] = 'Ocorreu um erro durante o pagamento. Verifique os dados do cartão, caso de falha no sistema por favor entrar em contato com nossa equipe.';
            }
            if (strpos($payment['erro'], 'internal_error' !== false)) {
                $payment['message'] = 'Ocorreu um erro durante o pagamento. Erro interno do servidor, por favor entre em contato com a nossa equipe.';
            }
            $error = explode(".", $payment['erro']);
            $msg['error_message'] = $payment['erro'];
            $this->session->set_flashdata('error_message', $payment['message']);
            echo json_encode(array('mensagem' => $payment['message'], 'situacao' => false));
        }
    }




    public function list_hour_doctor()
    {
        $date = $_POST['start'];
        $id_doctor = $_POST['id'];
        $day_week = strval(substr($date, 0, 1));
        $today = str_replace(' ', '', strval(substr($date, 3)));
        $date_compare = strval(date('Y-m-d'));
        // var_dump($dataCompare);
        //var_dump(str_replace(' ', '', $data));

        $data = "";
        //  $doctor_ion_id = $this->ion_auth->get_user_id();
        // $user_id = 1;
        $event_data = $this->db->get_where('doctor', array('id' => $id_doctor))->row();
        // var_dump($event_data->hours_available);
        if ($event_data->hours_available == NULL || $event_data->hours_available == "") {

            echo die(die(("error")));
        }
        $hours_available =  unserialize($event_data->hours_available);
        //var_dump($day_week);die;
        foreach ($hours_available[$day_week] as $hours => $k) {
            if ($date_compare == $today) {
                $current_time = strval(date('H', strtotime('+1 hours')));
                //echo $current_time;
                if ($k == '1' && $current_time < $hours) {
                    // echo str_replace(' ', '', substr($date, 3)).' '.$hours.':00';
                    $liberado =  $this->schedule_model->hour_compare(str_replace(' ', '', substr($date, 3)) . ' ' . $hours . ':00', $id_doctor);
                    var_dump($liberado);
                    if (!$liberado) {
                        md5(str_replace(' ', '', $id_doctor) . '&date=' . str_replace(' ', '', substr($date, 3)));
                        $data = $data . '<div><a href="' . base_url('frontend/checkout?id=' . str_replace(' ', '', $id_doctor) . '&date=' . str_replace(' ', '', substr($date, 3))) . '&hour=' . $hours . '" class="btn btn-info round buttonhours">' . $hours . '</button>
                        </div>';
                    } else {
                        $data = $data . '<div><button class="btn btn round buttonhours" disabled>' . $hours . '</button>
                  </div>';
                    }
                } else {
                    if ($k == '1') {
                        $data = $data . '<div><button class="btn btn round buttonhours" disabled>' . $hours . '</button>
                    </div>';
                    }
                }
                //echo $datahoje;die;

            } else if ($k == '1') {
                // echo str_replace(' ', '', substr($date, 3)).' '.$hours.':00';
                $liberado =  $this->schedule_model->hour_compare(str_replace(' ', '', substr($date, 3)) . ' ' . $hours . ':00', $id_doctor);
                if (!$liberado) {
                    $data = $data . '<div><a href="' . base_url('frontend/checkout?id=' . str_replace(' ', '', $id_doctor) . '&date=' . str_replace(' ', '', substr($date, 3))) . '&hour=' . $hours . '" class="btn btn-info round buttonhours">' . $hours . '</button>
          </div>';
                } else {
                    $data = $data . '<div><button class="btn btn round buttonhours" disabled>' . $hours . '</button>
              </div>';
                }
            }
        }

        echo die(die(($data)));
    }





    public function two()
    {
        $data = array();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['slides'] = $this->slide_model->getSlide();
        $data['services'] = $this->service_model->getService();
        $data['featureds'] = $this->featured_model->getFeatured();
        $this->load->view('frontendold', $data);
    }

    public function addNew()
    {
        $id = $this->input->post('id');

        $patient = $this->input->post('patient');

        $doctor = $this->input->post('doctor');
        $date = $this->input->post('date');
        if (!empty($date)) {
            $date = strtotime($date);
        }


        $time_slot = $this->input->post('time_slot');

        $time_slot_explode = explode('To', $time_slot);

        $s_time = trim($time_slot_explode[0]);
        $e_time = trim($time_slot_explode[1]);


        $remarks = $this->input->post('remarks');

        $sms = $this->input->post('sms');

        $status = 'Requested';

        $redirect = 'frontend';

        $request = 'Yes';




        $user = '';




        if ((empty($id))) {
            $add_date = date('m/d/y');
            $registration_time = time();
            $patient_add_date = $add_date;
            $patient_registration_time = $registration_time;
        }

        $s_time_key = $this->getArrayKey($s_time);


        $p_name = $this->input->post('p_name');
        $p_email = $this->input->post('p_email');
        if (empty($p_email)) {
            $p_email = $p_name . '-' . rand(1, 1000) . '-' . $p_name . '-' . rand(1, 1000) . '@example.com';
        }
        if (!empty($p_name)) {
            $password = $p_name . '-' . rand(1, 100000000);
        }
        $p_phone = $this->input->post('p_phone');
        $p_age = $this->input->post('p_age');
        $p_gender = $this->input->post('p_gender');
        $patient_id = rand(10000, 1000000);


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');


        if ($patient == 'add_new') {
            $this->form_validation->set_rules('p_name', 'Patient Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            $this->form_validation->set_rules('p_phone', 'Patient Phone', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        }

        if ($patient == 'patient_id') {
            $this->form_validation->set_rules('patient_id', 'Patient Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        }


        // Validating Name Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Doctor Field
        $this->form_validation->set_rules('doctor', 'Doctor', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Date Field
        $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|min_length[1]|max_length[1000]|xss_clean');

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('warning', lang('form_validation_error'));
            redirect("frontend");
        } else {


            if ($patient == 'patient_id') {
                $patient = $this->input->post('patient_id');

                if (!empty($patient)) {
                    $patient_exist = $this->patient_model->getPatientById($patient)->id;
                }

                if (empty($patient_exist)) {
                    $this->session->set_flashdata('warning', lang('invalid_patient_id'));
                    redirect("frontend");
                }
            }

            if ($patient == 'add_new') {
                $data_p = array(
                    'patient_id' => $patient_id,
                    'name' => $p_name,
                    'email' => $p_email,
                    'phone' => $p_phone,
                    'sex' => $p_gender,
                    'age' => $p_age,
                    'add_date' => $patient_add_date,
                    'registration_time' => $patient_registration_time,
                    'how_added' => 'from_appointment'
                );
                $username = $this->input->post('p_name');
                // Adding New Patient
                if ($this->ion_auth->email_check($p_email)) {
                    $this->session->set_flashdata('warning', lang('this_email_address_is_already_registered'));
                    redirect($redirect);
                } else {
                    $dfg = 5;
                    $this->ion_auth->register($username, $password, $p_email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $p_email))->row()->id;
                    $this->patient_model->insertPatient($data_p);
                    $patient_user_id = $this->db->get_where('patient', array('email' => $p_email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->patient_model->updatePatient($patient_user_id, $id_info);
                }

                $patient = $patient_user_id;


                $mail_provider = $this->settings_model->getSettings()->emailtype;
                $email_settings = $this->email_model->getEmailSettingsByType($mail_provider);
                $settngsname = $this->settings_model->getSettings()->system_vendor;
                $base_url = str_replace(array('http://', 'https://', '/'), '', base_url());
                $subject = $base_url . ' - Patient Registration Details';
                $message = 'Dear ' . $p_name . ',<br> Thank you for the registration. <br><br> Here is your login details.<br>  Link: ' . base_url() . 'auth/login <br> Username: ' . $p_email . ' <br> Password: ' . $password . '<br><br> Thank You, <br>' . $this->settings->title;
                if ($mail_provider == 'Domain Email') {
                    $this->email->from($email_settings->admin_email, $settngsname);
                }
                if ($mail_provider == 'Smtp') {
                    $this->email->from($email_settings->user, $settngsname);
                }
                $this->email->to($p_email);
                $this->email->subject($subject);
                $this->email->message($message);


                $this->email->send();




                //    }
            }
            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $patientname = $this->patient_model->getPatientById($patient)->name;
            $patient_phone = $this->patient_model->getPatientById($patient)->phone;
            $doctorname = $this->doctor_model->getDoctorById($doctor)->name;
            $room_id = 'hms-meeting-' . $patient_phone . '-' . rand(10000, 1000000);
            $live_meeting_link = 'https://meet.jit.si/' . $room_id;
            $app_time = strtotime(date('d-m-Y', $date) . ' ' . $s_time);
            $app_time_full_format = date('d-m-Y', $date) . ' ' . $s_time . '-' . $e_time;
            $data = array(
                'patient' => $patient,
                'patientname' => $patientname,
                'doctor' => $doctor,
                'doctorname' => $doctorname,
                'date' => $date,
                's_time' => $s_time,
                'e_time' => $e_time,
                'time_slot' => $time_slot,
                'remarks' => $remarks,
                'add_date' => $add_date,
                'registration_time' => $registration_time,
                'status' => $status,
                's_time_key' => $s_time_key,
                'user' => $user,
                'request' => $request,
                'room_id' => $room_id,
                'live_meeting_link' => $live_meeting_link,
                'app_time' => $app_time,
                'app_time_full_format' => $app_time_full_format,
            );
            $username = $this->input->post('name');

            if (empty($id)) {     // Adding New department
                $this->frontend_model->insertAppointment($data);

                if (!empty($sms)) {
                    $this->sms->sendSmsDuringAppointment($patient, $doctor, $date, $s_time, $e_time);
                }

                $patient_doctor = $this->patient_model->getPatientById($patient)->doctor;

                $patient_doctors = explode(',', $patient_doctor);



                if (!in_array($doctor, $patient_doctors)) {
                    $patient_doctors[] = $doctor;
                    $doctorss = implode(',', $patient_doctors);
                    $data_d = array();
                    $data_d = array('doctor' => $doctorss);
                    $this->patient_model->updatePatient($patient, $data_d);
                }

                $this->session->set_flashdata('success', lang('appointment_added_successfully_please_wait_you_will_get_a_confirmation_sms'));
            }
            // echo'<link rel="stylesheet" href="common/toastr/toastr.css" />';
            //echo'<script src="common/toastr/toastr.js"></script>';
            //echo '<script type="text/javascript">toastr.success("Have Fun")</script>';
            if (!empty($redirect)) {
                redirect($redirect);
            } else {
                redirect('appointment');
            }
        }
    }

    function getArrayKey($s_time)
    {
        $all_slot = array(
            0 => '12:00 PM',
            1 => '12:05 AM',
            2 => '12:10 AM',
            3 => '12:15 AM',
            4 => '12:20 AM',
            5 => '12:25 AM',
            6 => '12:30 AM',
            7 => '12:35 AM',
            8 => '12:40 PM',
            9 => '12:45 AM',
            10 => '12:50 AM',
            11 => '12:55 AM',
            12 => '01:00 AM',
            13 => '01:05 AM',
            14 => '01:10 AM',
            15 => '01:15 AM',
            16 => '01:20 AM',
            17 => '01:25 AM',
            18 => '01:30 AM',
            19 => '01:35 AM',
            20 => '01:40 AM',
            21 => '01:45 AM',
            22 => '01:50 AM',
            23 => '01:55 AM',
            24 => '02:00 AM',
            25 => '02:05 AM',
            26 => '02:10 AM',
            27 => '02:15 AM',
            28 => '02:20 AM',
            29 => '02:25 AM',
            30 => '02:30 AM',
            31 => '02:35 AM',
            32 => '02:40 AM',
            33 => '02:45 AM',
            34 => '02:50 AM',
            35 => '02:55 AM',
            36 => '03:00 AM',
            37 => '03:05 AM',
            38 => '03:10 AM',
            39 => '03:15 AM',
            40 => '03:20 AM',
            41 => '03:25 AM',
            42 => '03:30 AM',
            43 => '03:35 AM',
            44 => '03:40 AM',
            45 => '03:45 AM',
            46 => '03:50 AM',
            47 => '03:55 AM',
            48 => '04:00 AM',
            49 => '04:05 AM',
            50 => '04:10 AM',
            51 => '04:15 AM',
            52 => '04:20 AM',
            53 => '04:25 AM',
            54 => '04:30 AM',
            55 => '04:35 AM',
            56 => '04:40 AM',
            57 => '04:45 AM',
            58 => '04:50 AM',
            59 => '04:55 AM',
            60 => '05:00 AM',
            61 => '05:05 AM',
            62 => '05:10 AM',
            63 => '05:15 AM',
            64 => '05:20 AM',
            65 => '05:25 AM',
            66 => '05:30 AM',
            67 => '05:35 AM',
            68 => '05:40 AM',
            69 => '05:45 AM',
            70 => '05:50 AM',
            71 => '05:55 AM',
            72 => '06:00 AM',
            73 => '06:05 AM',
            74 => '06:10 AM',
            75 => '06:15 AM',
            76 => '06:20 AM',
            77 => '06:25 AM',
            78 => '06:30 AM',
            79 => '06:35 AM',
            80 => '06:40 AM',
            81 => '06:45 AM',
            82 => '06:50 AM',
            83 => '06:55 AM',
            84 => '07:00 AM',
            85 => '07:05 AM',
            86 => '07:10 AM',
            87 => '07:15 AM',
            88 => '07:20 AM',
            89 => '07:25 AM',
            90 => '07:30 AM',
            91 => '07:35 AM',
            92 => '07:40 AM',
            93 => '07:45 AM',
            94 => '07:50 AM',
            95 => '07:55 AM',
            96 => '08:00 AM',
            97 => '08:05 AM',
            98 => '08:10 AM',
            99 => '08:15 AM',
            100 => '08:20 AM',
            101 => '08:25 AM',
            102 => '08:30 AM',
            103 => '08:35 AM',
            104 => '08:40 AM',
            105 => '08:45 AM',
            106 => '08:50 AM',
            107 => '08:55 AM',
            108 => '09:00 AM',
            109 => '09:05 AM',
            110 => '09:10 AM',
            111 => '09:15 AM',
            112 => '09:20 AM',
            113 => '09:25 AM',
            114 => '09:30 AM',
            115 => '09:35 AM',
            116 => '09:40 AM',
            117 => '09:45 AM',
            118 => '09:50 AM',
            119 => '09:55 AM',
            120 => '10:00 AM',
            121 => '10:05 AM',
            122 => '10:10 AM',
            123 => '10:15 AM',
            124 => '10:20 AM',
            125 => '10:25 AM',
            126 => '10:30 AM',
            127 => '10:35 AM',
            128 => '10:40 AM',
            129 => '10:45 AM',
            130 => '10:50 AM',
            131 => '10:55 AM',
            132 => '11:00 AM',
            133 => '11:05 AM',
            134 => '11:10 AM',
            135 => '11:15 AM',
            136 => '11:20 AM',
            137 => '11:25 AM',
            138 => '11:30 AM',
            139 => '11:35 AM',
            140 => '11:40 AM',
            141 => '11:45 AM',
            142 => '11:50 AM',
            143 => '11:55 AM',
            144 => '12:00 AM',
            145 => '12:05 PM',
            146 => '12:10 PM',
            147 => '12:15 PM',
            148 => '12:20 PM',
            149 => '12:25 PM',
            150 => '12:30 PM',
            151 => '12:35 PM',
            152 => '12:40 PM',
            153 => '12:45 PM',
            154 => '12:50 PM',
            155 => '12:55 PM',
            156 => '01:00 PM',
            157 => '01:05 PM',
            158 => '01:10 PM',
            159 => '01:15 PM',
            160 => '01:20 PM',
            161 => '01:25 PM',
            162 => '01:30 PM',
            163 => '01:35 PM',
            164 => '01:40 PM',
            165 => '01:45 PM',
            166 => '01:50 PM',
            167 => '01:55 PM',
            168 => '02:00 PM',
            169 => '02:05 PM',
            170 => '02:10 PM',
            171 => '02:15 PM',
            172 => '02:20 PM',
            173 => '02:25 PM',
            174 => '02:30 PM',
            175 => '02:35 PM',
            176 => '02:40 PM',
            177 => '02:45 PM',
            178 => '02:50 PM',
            179 => '02:55 PM',
            180 => '03:00 PM',
            181 => '03:05 PM',
            182 => '03:10 PM',
            183 => '03:15 PM',
            184 => '03:20 PM',
            185 => '03:25 PM',
            186 => '03:30 PM',
            187 => '03:35 PM',
            188 => '03:40 PM',
            189 => '03:45 PM',
            190 => '03:50 PM',
            191 => '03:55 PM',
            192 => '04:00 PM',
            193 => '04:05 PM',
            194 => '04:10 PM',
            195 => '04:15 PM',
            196 => '04:20 PM',
            197 => '04:25 PM',
            198 => '04:30 PM',
            199 => '04:35 PM',
            200 => '04:40 PM',
            201 => '04:45 PM',
            202 => '04:50 PM',
            203 => '04:55 PM',
            204 => '05:00 PM',
            205 => '05:05 PM',
            206 => '05:10 PM',
            207 => '05:15 PM',
            208 => '05:20 PM',
            209 => '05:25 PM',
            210 => '05:30 PM',
            211 => '05:35 PM',
            212 => '05:40 PM',
            213 => '05:45 PM',
            214 => '05:50 PM',
            215 => '05:55 PM',
            216 => '06:00 PM',
            217 => '06:05 PM',
            218 => '06:10 PM',
            219 => '06:15 PM',
            220 => '06:20 PM',
            221 => '06:25 PM',
            222 => '06:30 PM',
            223 => '06:35 PM',
            224 => '06:40 PM',
            225 => '06:45 PM',
            226 => '06:50 PM',
            227 => '06:55 PM',
            228 => '07:00 PM',
            229 => '07:05 PM',
            230 => '07:10 PM',
            231 => '07:15 PM',
            232 => '07:20 PM',
            233 => '07:25 PM',
            234 => '07:30 PM',
            235 => '07:35 PM',
            236 => '07:40 PM',
            237 => '07:45 PM',
            238 => '07:50 PM',
            239 => '07:55 PM',
            240 => '08:00 PM',
            241 => '08:05 PM',
            242 => '08:10 PM',
            243 => '08:15 PM',
            244 => '08:20 PM',
            245 => '08:25 PM',
            246 => '08:30 PM',
            247 => '08:35 PM',
            248 => '08:40 PM',
            249 => '08:45 PM',
            250 => '08:50 PM',
            251 => '08:55 PM',
            252 => '09:00 PM',
            253 => '09:05 PM',
            254 => '09:10 PM',
            255 => '09:15 PM',
            256 => '09:20 PM',
            257 => '09:25 PM',
            258 => '09:30 PM',
            259 => '09:35 PM',
            260 => '09:40 PM',
            261 => '09:45 PM',
            262 => '09:50 PM',
            263 => '09:55 PM',
            264 => '10:00 PM',
            265 => '10:05 PM',
            266 => '10:10 PM',
            267 => '10:15 PM',
            268 => '10:20 PM',
            269 => '10:25 PM',
            270 => '10:30 PM',
            271 => '10:35 PM',
            272 => '10:40 PM',
            273 => '10:45 PM',
            274 => '10:50 PM',
            275 => '10:55 PM',
            276 => '11:00 PM',
            277 => '11:05 PM',
            278 => '11:10 PM',
            279 => '11:15 PM',
            280 => '11:20 PM',
            281 => '11:25 PM',
            282 => '11:30 PM',
            283 => '11:35 PM',
            284 => '11:40 PM',
            285 => '11:45 PM',
            286 => '11:50 PM',
            287 => '11:55 PM',
        );

        $key = array_search($s_time, $all_slot);
        return $key;
    }

    public function settings()
    {
        $data = array();
        $data['settings'] = $this->frontend_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('settings', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    public function update()
    {
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $emergency = $this->input->post('emergency');
        $support = $this->input->post('support');
        $currency = $this->input->post('currency');
        $logo = $this->input->post('logo');
        $twitter_username = $this->input->post('twitter_username');

        $block_1_text_under_title = $this->input->post('block_1_text_under_title');
        $service_block_text_under_title = $this->input->post('service_block__text_under_title');
        $doctor_block_text_under_title = $this->input->post('doctor_block__text_under_title');

        $facebook_id = $this->input->post('facebook_id');
        $twitter_id = $this->input->post('twitter_id');
        $google_id = $this->input->post('google_id');
        $youtube_id = $this->input->post('youtube_id');
        $skype_id = $this->input->post('skype_id');

        $appointment_title = $this->input->post('appointment_title');
        $appointment_subtitle = $this->input->post('appointment_subtitle');
        $appointment_description = $this->input->post('appointment_description');



        if (!empty($email)) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            // Validating Title Field
            $this->form_validation->set_rules('title', 'Title', 'rtrim|required|min_length[1]|max_length[100]|xss_clean');
            // Validating Email Field
            $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            // Validating Address Field   
            $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[1]|max_length[1000]|xss_clean');
            // Validating Phone Field           
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            // Validating Currency Field   
            $this->form_validation->set_rules('currency', 'Currency', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            // Validating Currency Field   
            $this->form_validation->set_rules('logo', 'Logo', 'trim|min_length[1]|max_length[1000]|xss_clean');

            $this->form_validation->set_rules('description', 'Footer Description', 'required|trim|min_length[1]|max_length[1000]|xss_clean');

            // Validating Currency Field   
            $this->form_validation->set_rules('emergency', 'Emergency', 'trim|min_length[1]|max_length[100]|xss_clean');
            // Validating Currency Field   
            $this->form_validation->set_rules('support', 'Support', 'trim|min_length[1]|max_length[100]|xss_clean');
            // Validating Currency Field   
            $this->form_validation->set_rules('block_1_text_under_title', 'Block 1 Text Under Title', 'trim|min_length[1]|max_length[500]|xss_clean');
            // Validating Currency Field   
            $this->form_validation->set_rules('service_block__text_under_title', 'Service Block Text Under Title', 'trim|min_length[1]|max_length[500]|xss_clean');
            // Validating Currency Field   
            $this->form_validation->set_rules('doctor_block__text_under_title', 'Doctor Block Text Under Title', 'trim|min_length[1]|max_length[500]|xss_clean');
            // Validating Currency Field   
            $this->form_validation->set_rules('facebook_id', 'Facebook Id', 'trim|min_length[1]|max_length[1000]|xss_clean');
            // Validating Currency Field   
            $this->form_validation->set_rules('twitter_id', 'Twitter Id', 'trim|min_length[1]|max_length[1000]|xss_clean');
            // Validating Currency Field   
            $this->form_validation->set_rules('google_id', 'Google Id', 'trim|min_length[1]|max_length[1000]|xss_clean');
            // Validating Currency Field   
            $this->form_validation->set_rules('youtube_id', 'Youtube Id', 'trim|min_length[1]|max_length[1000]|xss_clean');
            // Validating Currency Field   
            $this->form_validation->set_rules('skype_id', 'Skype Id', 'trim|min_length[1]|max_length[1000]|xss_clean');
            $this->form_validation->set_rules('twitter_username', 'Twitter Username', 'trim|min_length[1]|max_length[100]|xss_clean');

            $this->form_validation->set_rules('appointment_title', 'Appointment Title', 'trim|required|min_length[1]|max_length[1000]|xss_clean');
            $this->form_validation->set_rules('appointment_subtitle', 'Appointment Subtitle', 'trim|required|min_length[1]|max_length[1000]|xss_clean');
            $this->form_validation->set_rules('appointment_description', 'Appointment Description', 'trim|required|min_length[1]|max_length[1000]|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $data = array();
                $data['settings'] = $this->frontend_model->getSettings();
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('settings', $data);
                $this->load->view('home/footer'); // just the footer file
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
                    'max_height' => "10000",
                    'max_width' => "10000"
                );
                $this->load->library('Upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('img_url')) {
                    $path = $this->upload->data();
                    $img_url = "uploads/" . $path['file_name'];
                    $data = array();
                    $data = array(
                        'title' => $title,
                        'description' => $description,
                        'address' => $address,
                        'phone' => $phone,
                        'email' => $email,
                        'currency' => $currency,
                        'emergency' => $emergency,
                        'support' => $support,
                        'block_1_text_under_title' => $block_1_text_under_title,
                        'service_block__text_under_title' => $service_block_text_under_title,
                        'doctor_block__text_under_title' => $doctor_block_text_under_title,
                        'facebook_id' => $facebook_id,
                        'twitter_id' => $twitter_id,
                        'google_id' => $google_id,
                        'youtube_id' => $youtube_id,
                        'skype_id' => $skype_id,
                        'logo' => $img_url,
                        'twitter_username' => $twitter_username,
                        'appointment_title' => $appointment_title,
                        'appointment_subtitle' => $appointment_subtitle,
                        'appointment_description' => $appointment_description
                    );
                } else {
                    $data = array();
                    $data = array(
                        'title' => $title,
                        'description' => $description,
                        'address' => $address,
                        'phone' => $phone,
                        'email' => $email,
                        'currency' => $currency,
                        'emergency' => $emergency,
                        'support' => $support,
                        'block_1_text_under_title' => $block_1_text_under_title,
                        'service_block__text_under_title' => $service_block_text_under_title,
                        'doctor_block__text_under_title' => $doctor_block_text_under_title,
                        'facebook_id' => $facebook_id,
                        'twitter_id' => $twitter_id,
                        'google_id' => $google_id,
                        'youtube_id' => $youtube_id,
                        'skype_id' => $skype_id,
                        'twitter_username' => $twitter_username,
                        'appointment_title' => $appointment_title,
                        'appointment_subtitle' => $appointment_subtitle,
                        'appointment_description' => $appointment_description
                    );
                }
                //                print_r($data);
                //                die();
                //$error = array('error' => $this->upload->display_errors());
                $this->frontend_model->updateSettings($id, $data);
                $data2 = array();
                $file_name = $_FILES['appointment_img_url']['name'];
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
                    'max_height' => "10000",
                    'max_width' => "10000"
                );

                $this->load->library('Upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('appointment_img_url')) {
                    $path = $this->upload->data();
                    $img_url = "uploads/" . $path['file_name'];

                    $data2 = array(
                        'appointment_img_url' => $img_url
                    );
                    $this->frontend_model->updateSettings($id, $data2);
                }


                $this->session->set_flashdata('feedback', lang('updated'));
                // Loading View
                redirect('frontend/settings');
            }
        } else {
            $this->session->set_flashdata('feedback', lang('email_required'));
            redirect('frontend/settings', 'refresh');
        }
    }

    function getAvailableSlotByDoctorByDateByJason()
    {
        $data = array();
        $date = $this->input->get('date');
        if (!empty($date)) {
            $date = strtotime($date);
        }
        $doctor = $this->input->get('doctor');
        if (!empty($date) && !empty($doctor)) {
            $data['aslots'] = $this->frontend_model->getAvailableSlotByDoctorByDate($date, $doctor);
        }
        echo json_encode($data);
    }
}

/* End of file appointment.php */
    /* Location: ./application/modules/appointment/controllers/appointment.php */
