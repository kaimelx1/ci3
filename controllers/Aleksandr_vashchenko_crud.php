<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aleksandr_vashchenko_crud extends Controller_Base
{
    public $__load_default = true;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        //if (!$this->ion_auth->is_admin()) exit();
        $this->data['seo_title'] = $_SERVER['REQUEST_URI'];
        $this->data['seo_description'] = $_SERVER['REQUEST_URI'];
        $this->data['seo_keywords'] = $_SERVER['REQUEST_URI'];
        
        // Load model
        $this->load->model('Aleksandr_vashchenko_crud_model');
    }

    /**
     * Generates page
     */
    public function index()
    {
        // Redirect if not logged in
        if (!isset($_SESSION['alek_username'])) {
            redirect('/aleksandr_vashchenko_crud/login');
        }

        // Number of users
        $this->data['count'] = $this->db->count_all('alek_users');
        // Render layout + page content
        $this->data['page_center'] = 'aleksandr_vashchenko_crud/index';
        $this->__render('outside/main_template_alek');
    }

    /**
     * Generates table
     */
    public function table()
    {
        // Count all users
        $count_all = $this->db->count_all('alek_users');

        // Per page count
        $per_page = $count_all;
        if (isset($_GET['per_page']) AND $_GET['per_page'] != 'all') {
            $per_page = intval($_GET['per_page']);
        }

        // Limit clause
        $limit = 'LIMIT ' . $per_page;
        if (isset($_GET['page'])) {
            $page = intval($_GET['page']);
            $limit = ' LIMIT ' . (($page - 1) * $per_page) . ',' . $per_page . '';
        }

        // Where clause for search
        $where = '';
        if (isset($_GET['search']) AND $_GET['search'] != '') {
            $where .= " AND (
                        alek_users.email LIKE '%" . $this->db->escape_like_str($_GET['search']) . "%'
                        OR alek_groups.name LIKE '%" . $this->db->escape_like_str($_GET['search']) . "%'
                        OR alek_users.id LIKE '%" . $this->db->escape_like_str($_GET['search']) . "%'
                        OR alek_users.surname LIKE '%" . $this->db->escape_like_str($_GET['search']) . "%'
                        OR alek_users.name LIKE '%" . $this->db->escape_like_str($_GET['search']) . "%'
                        )";
        }

        // Getting info
        $this->data['result'] = $this->Aleksandr_vashchenko_crud_model->table($where, $limit);
        // Load view
        $this->load->view('outside/pages/aleksandr_vashchenko_crud/table', $this->data);
    }

    /**
     * Generates add-page
     */
    public function add()
    {
        // Getting groups info
        $this->data['groups'] = $this->Aleksandr_vashchenko_crud_model->groups_info();
        // Rendering page
        $this->data['page_center'] = 'aleksandr_vashchenko_crud/add';
        $this->__render('outside/main_template_alek');
    }

    /**
     * Generates edit-page
     */
    public function edit($id)
    {
        // Validation
        if (!intval($this->uri->segment(3))) {
            redirect('/aleksandr_vashchenko_crud');
        }

        // Getting user's info
        $result = $this->Aleksandr_vashchenko_crud_model->user_info(intval($id));

        // Validation
        if (!$result) {
            redirect('/aleksandr_vashchenko_crud');
        }

        $this->data['row'] = $result[0];

        // Getting groups info
        $this->data['groups'] = $this->data['groups'] = $this->Aleksandr_vashchenko_crud_model->groups_info();
        $this->data['page_center'] = 'aleksandr_vashchenko_crud/edit';
        $this->__render('outside/main_template_alek');
    }

    /**
     * Adds new user
     */
    public function add_request()
    {
        // Validations
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('surname', 'Surname', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[alek_users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('groups[]', 'Groups', 'required');

        if ($this->form_validation->run() === false) {
            echo "<span class='echo-message'>" . validation_errors() . "</span>";
            die();
        }

        // Inserting new user
        $this->db->insert('alek_users', Array(
            'name' => $this->db->escape($this->input->post('name', true)),
            'surname' => $this->db->escape($this->input->post('surname', true)),
            'email' => $this->input->post('email', true),
            'password' => md5($this->input->post('password', true)),
        ));

        // Getting last inserted id
        $user_id = $this->db->insert_id();

        // Inserting groups for user
        foreach ($_POST['groups'] as $group_id) {
            $this->db->insert('alek_users_groups', Array(
                'user_id' => $user_id,
                'group_id' => $group_id,
            ));
        }

        echo "<span class='echo-message' style='color: #" . rand(555555, 999999) . "'>New user was added!</span>";
    }

    /**
     * Edits user's information
     */
    public function edit_request($id = 0)
    {
        // Validations
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('surname', 'Surname', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->input->post('password', true) != '') {
            $this->form_validation->set_rules('password', 'Password', 'required');
        }

        if ($this->form_validation->run() === false) {
            echo "<span class='echo-message'>" . validation_errors() . "</span>";
            die();
        }

        // Getting password from field
        if ($this->input->post('password', true) != '') {
            $data['password'] = md5($this->input->post('password', true));
        }

        // Escaping
        $data['name'] = $this->db->escape($this->input->post('name', true));
        $data['surname'] = $this->db->escape($this->input->post('surname', true));
        $data['email'] = $this->input->post('email', true);

        // Updating
        $this->db->where('id', $id);
        $this->db->update('alek_users', $data);

        // Deleting old group info
        $this->db->delete('alek_users_groups', array('user_id' => intval($id)));

        // Inserting new group info
        foreach ($_POST['groups'] as $group_id) {
            $this->db->insert('alek_users_groups', array(
                'user_id' => $id,
                'group_id' => $group_id
            ));
        }

        echo "<span class='echo-message' style='color: #" . rand(555555, 999999) . "'>User's information was updated!</span>";
    }

    /**
     * Deletes user
     */
    public function del_request()
    {
        // Deleting users
        foreach ($_GET['del'] as $del_id) {
            $this->db->delete('alek_users', array('id' => intval($del_id)));
        }
    }

    /**
     * Login
     */
    public function login()
    {
        // Validations
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        // If there are no errors
        if ($this->form_validation->run() !== false) {

            // Logging in
            $result = $this->
            Aleksandr_vashchenko_crud_model
                ->verify_user(
                    $this->input->post('email'),
                    $this->input->post('password')
                );

            // If OK
            if ($result !== false) {
                // Set session & redirect
                $_SESSION['alek_username'] = $this->input->post('email');
                redirect('/aleksandr_vashchenko_crud/');
            } else {
                // Set message
                $this->data['credentials'] = 'Wrong credentials';
            }
        }

        // Load html
        $this->load->view('outside/pages/aleksandr_vashchenko_crud/login', $this->data);
    }

    /**
     * Logout
     */
    public function logout()
    {
        unset($_SESSION['alek_username']);
        redirect('/aleksandr_vashchenko_crud/login');
    }
}