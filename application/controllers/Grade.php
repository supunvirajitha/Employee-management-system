<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Grade extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url() . 'login');
        }
        $this->load->model('Grade_model');
        $this->load->model('grade_model');
    }

    public function index()
    {
        $data['get_staff'] = $this->Staff_model->get_staff();
        $this->load->view('admin/header');
        $this->load->view('admin/add-grade', $data);
        $this->load->view('admin/footer');
    }

    public function manage_grade()
    {
        $data['content'] = $this->Grade_model->select_grade();
        $data['get_staff'] = $this->Staff_model->get_staff();
        //$data['get_staff'] = $this -> Staff_model -> get_staff();
        //$data['select_staff_byGID']=$this->Staff_model->select_staff_byGID(21);  
        //$data['get_staff_by_grade']=$this->Staff_model->get_staff_by_grade();
        $this->load->view('admin/header');
        $this->load->view('admin/manage-grade', $data);
        $this->load->view('admin/footer');
    }


    public function grade_print()
    {
        $data['content'] = $this->Grade_model->select_grade();
        $this->load->view('admin/header');
        $this->load->view('admin/grade-print', $data);
        $this->load->view('admin/footer');
    }

    public function insert()
    {
        $this->form_validation->set_rules('txtname', 'Name', 'required');
        $this->form_validation->set_rules('txtgrade', 'Grade', 'required');
        $this->form_validation->set_rules('txtgfd', 'From', 'required');
        $this->form_validation->set_rules('txtgtd', 'To', 'required');
        $this->form_validation->set_rules('txtexam', 'Exam', 'required');
        $this->form_validation->set_rules('txtemployee_num', 'Employee Number', 'required');

        $id = $this->input->post('txtid');
        $employee_num = $this->input->post('txtemployee_num');
        $name = $this->input->post('txtname');
        $grade = $this->input->post('txtgrade');
        $gfd = $this->input->post('txtgfd');
        $gtd = $this->input->post('txtgtd');
        $exam = $this->input->post('txtexam');
        $ebexamdate = $this->input->post('txtebexamdate');

        if ($this->form_validation->run() === false) {
            // Validation failed, reload the form with validation errors
            $this->index();
            return;
        }
        $this->load->library('image_lib');
        $config13['upload_path'] = 'uploads/grade/ebexamcertificate/';
        $config13['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $this->load->library('upload', $config13, 'ebexamcertificate_upload'); // Load upload library for idpimage with a different instance name 

        if (!$this->ebexamcertificate_upload->do_upload('ebexamcertificate'))   //txtidp
        {
            $image13 = 'default-pic.jpg';
        } else {
            $image_data13 =   $this->ebexamcertificate_upload->data();

            $configer13 =  array(
                'image_library'   => 'gd2',
                'source_image'    =>  $image_data13['full_path'],
                'maintain_ratio'  =>  TRUE,
                'width'           =>  150,
                'height'          =>  150,
                'quality'         =>  50
            );
            $this->image_lib->clear();
            $this->image_lib->initialize($configer13);
            $this->image_lib->resize();

            $image13 = $image_data13['file_name'];
        }

        $data = $this->Grade_model->insert_grade(array(
            'id' => $id,
            'employee_num' => $employee_num,
            'name' => $name,
            'grade' => $grade,
            'gfd' => $gfd,
            'gtd' => $gtd,
            'exam' => $exam,
            'ebexamdate' => $ebexamdate,
            'ebexamcertificate' => $image13
        ));

        if ($data == true) {
            $this->session->set_flashdata('success', "Grade Added Successfully");
        } else {
            $this->session->set_flashdata('error', "Sorry, Grade Adding Failed.");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update()
    {
        $id = $this->input->post('txtid');
        $employee_num = $this->input->post('txtemployee_num');
        $name = $this->input->post('txtname');
        $grade = $this->input->post('txtgrade');
        $gfd = $this->input->post('txtgfd');
        $gtd = $this->input->post('txtgtd');
        $exam = $this->input->post('txtexam');
        $ebexamdate = $this->input->post('txtebexamdate');

        $file_available  = false;

        if ($_FILES['ebexamcertificate']['name'] != '') {

            $file_available = true;
            $this->load->library('image_lib');
            $config13['upload_path'] = 'uploads/grade/ebexamcertificate/';
            $config13['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $this->load->library('upload', $config13, 'ebexamcertificate_upload'); 

            if ($this->ebexamcertificate_upload->do_upload('ebexamcertificate')) {
                $image_data13 = $this->ebexamcertificate_upload->data();

                $existing_image = $this->Grade_model->get_ebexamcertificate_by_id($id);
                // echo "Upload Path: " . $existing_image . "<br>";

                if ($existing_image && file_exists($config13['upload_path'] . $existing_image)) {
                    unlink($config13['upload_path'] . $existing_image);
                }

                $configer13 = array(
                    'image_library' => 'gd2',
                    'source_image' => $image_data13['full_path'],
                    'maintain_ratio' => TRUE,
                    'width' => 150,
                    'height' => 150,
                    'quality' => 50
                );

                $this->image_lib->clear();
                $this->image_lib->initialize($configer13);
                $this->image_lib->resize();

                $image13 = $image_data13['file_name'];
            } else {
                $image13 = 'default-pic.jpg';
            }
        } else {
            $file_available = false;
        }
        if ($file_available) {
            $data = $this->Grade_model->update_grade(array('name' => $name, 'employee_num' => $employee_num, 'grade' => $grade, 'gfd' => $gfd, 'gtd' => $gtd, 'exam' => $exam, 'ebexamdate' => $ebexamdate, 'ebexamcertificate' => $image13), $id);
        } else {
            $data = $this->Grade_model->update_grade(array('name' => $name, 'employee_num' => $employee_num, 'grade' => $grade, 'gfd' => $gfd, 'gtd' => $gtd, 'exam' => $exam, 'ebexamdate' => $ebexamdate,), $id);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', "Grade Updated Succesfully");
        } else {
            $this->session->set_flashdata('error', "Sorry, Grade Update Failed.");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }



    function edit($id)
    {
        // $data['staff_name']=$this->Grade_model->select_staff();
        $data['content'] = $this->Grade_model->select_Grade_byID($id);
        $this->load->view('admin/header');
        $this->load->view('admin/edit-grade', $data);
        $this->load->view('admin/footer');
    }


    function delete($id)
    {
        $data = $this->Grade_model->delete_Grade($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', "Grade Deleted Succesfully");
        } else {
            $this->session->set_flashdata('error', "Sorry, Grade Delete Failed.");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}
