<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frontend extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('frontend_model');
        $this->load->model('finance/finance_model');
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
        $this->load->view('header', $data);
        $this->load->view('frontend2');
        $this->load->view('footer'); 

    }

    public function search($search = NULL, $order = NULL, $dir = NULL)
    {
        $data = array();
        $data['doctors'] = $this->doctor_model->getDoctorBySearch($search, $order, $dir);
        $this->load->view('header', $data);
        $this->load->view('search'); 
        $this->load->view('footer'); 
    }

    public function checkout_sucess()
    { 
        $data['doctors'] = $this->doctor_model->getDoctorBySearch($search, $order, $dir);

        $this->load->view('header', $data);
        $this->load->view('checkout_sucess');
        $this->load->view('footer'); 
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
        $paytm = $this->db->get_where('paymentgateway', array('name =' => 'pagarme'))->row();


       // var_dump($post);die;
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
      
            $password = preg_replace('/[-\@\.\;\" "]+/', '', $this->input->post('cpf'));
    

      //  var_dump($password);

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
        if ($this->ion_auth->email_check($p_email) != NULL) {
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
        }
        $patient = $patient_user_id;

      

        //THIS IS HOW I CHECKED THE STRIPE PAYMENT STATUS
        $payment = $this->payment_model->pagarme_payment($post, $public_key, isset($post['boleto']) ? 'boleto' : 'credit_card', $doctor);
        if ($payment['status'] == 'paid') {

        $date = time();
        $date_string = date('d-m-y', $date);
        $amount = $post['amount']/100;
        $data = array(
            'category_name' => 'Atendimento',
            'patient' => $patient,
            'date' => $date,
            'amount' => $amount,
            'doctor' => $doctor->id,
            //'discount' => $discount,
           // 'flat_discount' => $flat_discount,
            'gross_total' => $post['amount']/100,
            'status' => 'paid',
            'hospital_amount' =>  ($amount/100)* $paytm->percentage,
            'doctor_amount' => ($amount/100)* $paytm->percentage_doctor,
            'user' => $user->id,
            'patient_name' => $post['first_name'],
            'patient_phone' => $post['phone'],
            'patient_address' => $post['adress'],
            'doctor_name' => $doctor->name,
            'date_string' => $date_string,
            'deposit_type' => 'cred_card'
           // 'remarks' => $remarks
        );


        $this->finance_model->insertPayment($data);
        $inserted_id = $this->db->insert_id();
        $data1 = array(
            'date' => $date,
            'patient' => $patient,
            'deposited_amount' =>  $amount,
            'payment_id' => $inserted_id,
            'amount_received_id' => $inserted_id . '.' . 'R$',
            'deposit_type' => 'cred_card',
            'user' => $user->id
        );
        $this->finance_model->insertDeposit($data1);


        $data = array();
            $date = $post['date'];
            $s_time = $post['hour'];
            $e_time = date( 'H:i', strtotime( '+1 hour' , strtotime($s_time) ) );
            //$e_time = $post['hour'] + '1';
           // var_dump($e_time);die;

        
            $patientname = $this->patient_model->getPatientById($patient)->name;
            $patient_phone = $this->patient_model->getPatientById($patient)->phone;
            $doctorname = $this->doctor_model->getDoctorById($doctor->id)->name;
            $room_id = 'hms-meeting-' . $patient_phone . '-' . rand(10000, 1000000);
            $live_meeting_link = 'https://meet.jit.si/' . $room_id;
            $app_time = strtotime($date . ' ' . $s_time);
            //var_dump(date("Y-m-d H:i:s", $app_time));die;
            $app_time_full_format = date('d-m-Y', strtotime($date)) . ' ' . $s_time . ' AM-' . $e_time.' PM';
            $time_slot = date("h:i A", strtotime($s_time)).' To '.date("h:i A", strtotime($e_time));
            $add_date = date('m/d/y');
            $registration_time = time();
            $patient_add_date = $add_date;
            $patient_registration_time = $registration_time;
           
            $data = array(
                'patient' => $patient,
                'patientname' => $patientname,
                'doctor' => $doctor->id,
                'doctorname' => $doctorname,
                'date' => strtotime($date),
                's_time' => date("h:i A", strtotime($s_time)),
                'e_time' => date("h:i A", strtotime($e_time)),
                'time_slot' => $time_slot,
                //'remarks' => $remarks,
                'add_date' =>  $add_date,
                'registration_time' => $registration_time,
                'status' => 'Confirmed',
                's_time_key' => '120',
                'user' => $user->id,
                'request' => 'Yes',
                'room_id' => $room_id,
                'live_meeting_link' => $live_meeting_link,
                'app_time' => $app_time,
                'app_time_full_format' => $app_time_full_format,
            );
               $username = $this->input->post('first_name');
                // Adding New department
                $this->frontend_model->insertAppointment($data);

                if (!empty($sms)) {
                    $this->sms->sendSmsDuringAppointment($patient, $doctor, $date, $s_time, $e_time);
                }

                $patient_doctor = $this->patient_model->getPatientById($patient)->doctor;

                $patient_doctors = explode(',', $patient_doctor);



                if (!in_array($doctor->id, $patient_doctors)) {
                    $patient_doctors[] = $doctor->id;
                    $doctorss = implode(',', $patient_doctors);
                    $data_d = array();
                    $data_d = array('doctor' => $doctorss);
                    $this->patient_model->updatePatient($patient, $data_d);
                }

                $autoemail = $this->email_model->getAutoEmailByType('appoinment_confirmation');

                if ($autoemail->status == 'Active') {
                    $mail_provider = $this->settings_model->getSettings()->emailtype;
                    $settngs_name = $this->settings_model->getSettings()->system_vendor;
                    $email_Settings = $this->email_model->getEmailSettingsByType($mail_provider);
                    $data1 = array(
                        'firstname' => $this->input->post('first_name'),
                        'lastname' => $this->input->post('last_name'),
                        'name' => $patientname,
                        'doctorname' => $doctorname,
                        'appoinmentdate' => date('d-m-Y', $data['date']),
                        'meeting_link' =>  $live_meeting_link,
                        'time_slot' => $time_slot,
                        'hospital_name' => 'Psicomob'
                    );
                   
                    $message1 = $autoemail->message;
                    $messageprint1 = $this->parser->parse_string($message1, $data1);
                    if ($mail_provider == 'Domain Email') {
                        $this->email->from($email_Settings->admin_email);
                    }
                    if ($mail_provider == 'Smtp') {
                        $this->email->from($email_Settings->user, $settngs_name);
                    }
                    $this->email->to($post['email']);
                    $this->email->subject(lang('appointment'));
                    $this->email->message($messageprint1);
                    $this->email->send();
                }
                          //$this->session->set_flashdata('success', lang('appointment_added_successfully_please_wait_you_will_get_a_confirmation_sms'));
                  
            $redirect = base_url() . 'frontend/checkout_sucess/';
           // echo 'deu certo';
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





   
    

    public function settings()
    {
        $data = array();
        $data['settings'] = $this->frontend_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('settings', $data);
        $this->load->view('home/footer'); // just the footer file
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


    function sou_profissional(){
        $data = array();
        $data['settings'] = $this->frontend_model->getSettings();
        $this->load->view('header', $data); // just the header file
        $this->load->view('sou_profissional');
        $this->load->view('footer'); // just the footer file




    }
}

/* End of file appointment.php */
    /* Location: ./application/modules/appointment/controllers/appointment.php */
