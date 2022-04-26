<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('profile_model');
        $this->load->model('doctor/doctor_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index() {
        $ion_user_id = $this->ion_auth->get_user_id();
        $group_id = $this->profile_model->getUsersGroups($ion_user_id)->row()->group_id;
        $group_name = $this->profile_model->getGroups($group_id)->row()->name;
        $group_name = strtolower($group_name);

        $data = array();
        $id = $this->ion_auth->get_user_id();
        $data['profile'] = $this->profile_model->getProfileById($id);
        $data['doctor'] = $this->doctor_model->getDoctorByIonUserId($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('profile', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    public function addNew() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $cpf = $this->input->post('cpf');
        $postal_code = $this->input->post('postal_code');
        $country = $this->input->post('country');
        $state = $this->input->post('state');
        $city = $this->input->post('city');
        $district = $this->input->post('district');
        $complement = $this->input->post('complement');
        $number = $this->input->post('number');
        $date_of_birth = $this->input->post('date_of_birth');
        $biography = $this->input->post('biography');
        $crp = $this->input->post('crp');
        $specialties = $this->input->post('specialties');
        $facebook = $this->input->post('facebook');
        $instagram = $this->input->post('instagram');
        $amount_to_pay = $this->input->post('amount_to_pay');

        $data['profile'] = $this->profile_model->getProfileById($id);
        if ($data['profile']->email != $email) {
            if ($this->ion_auth->email_check($email)) {
                $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                redirect('profile');
            }
        }

        $ion_user_id = $this->ion_auth->get_user_id();
            $group_id = $this->profile_model->getUsersGroups($ion_user_id)->row()->group_id;
            $group_name = $this->profile_model->getGroups($group_id)->row()->name;
            $group_name = strtolower($group_name);



        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Password Field
        if (!empty($password)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
       
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $id = $this->ion_auth->get_user_id();
            $data['profile'] = $this->profile_model->getProfileById($id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('profile', $data);
            $this->load->view('home/footer'); // just the footer file
        } else {
            $data = array();
            $data = array(
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'phone' => $phone,
                'cpf' => $cpf,
                'postal_code' => $postal_code,
                'country' => $country,
                'state' => $state,
                'city' => $city,
                'district' => $district,
                'complement' => $complement,
                'date_of_birth' => $date_of_birth,
                'number' => $number,
                'biography' => $biography,
                'crp' => $crp,
                'specialties' => $specialties,
                'facebook' => $facebook,
                'instagram' => $instagram,
                'amount_to_pay' => $amount_to_pay,

            );


            $username = $this->input->post('name');
            
            //var_dump($group_name);die;
            if (empty($password)) {
                $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
            } else {
                $password = $this->ion_auth_model->hash_password($password);
            }
            $this->profile_model->updateIonUser($username, $email, $password, $ion_user_id);
            if (!$this->ion_auth->in_group('admin')) {
                $this->profile_model->updateProfile($ion_user_id, $data, $group_name);
            }
            $this->session->set_flashdata('feedback', lang('updated'));

            // Loading View
            redirect('profile');
        }
    }

}

/* End of file profile.php */
/* Location: ./application/modules/profile/controllers/profile.php */
