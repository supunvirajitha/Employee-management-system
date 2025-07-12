<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect(base_url().'login');
        }
    }

    public function training_print()
    {
        $data['content']=$this->Training_model->select_training();
        $this->load->view('admin/header');
        $this->load->view('admin/training-print',$data);
        $this->load->view('admin/footer');
    }

    public function index()
    {
        $data['get_staff'] = $this->Staff_model->get_staff();
        $this->load->view('admin/header');
        $this->load->view('admin/add-Training',$data);
        $this->load->view('admin/footer');
    }

    public function manage_training()
    {
        $data['content']=$this->Training_model->select_training();
        $data['get_staff'] = $this->Staff_model->get_staff();
        $this->load->view('admin/header');
        $this->load->view('admin/manage-training',$data);
        $this->load->view('admin/footer');
    }

    public function insert()
    {
        $this->form_validation->set_rules('txtname', 'Name', 'required');
        $this->form_validation->set_rules('txttrainingfd', 'Start', 'required');
        $this->form_validation->set_rules('txtemployee_num', 'Employee Number', 'required');

        if ($this->form_validation->run() === false) {
            $this->index();
            return;
        }

       
        $id=$this->input->post('txtid');
        $employee_num=$this->input->post('txtemployee_num');
        $name=$this->input->post('txtname');
        $type=$this->input->post('txttype');
        $department_tid=$this->input->post('txtdepartment_tid');
        $sdivision=$this->input->post('txtsdivision');
        $trainingfd=$this->input->post('txttrainingfd');
        $trainingtd=$this->input->post('txttrainingtd');
        $dis=$this->input->post('txtdis');

        


        $data=$this->Training_model->insert_training(array('name'=>$name, 'employee_num' =>$employee_num,'id'=>$id,'ttype'=>$type,'department_tid'=>$department_tid,'sdivision'=>$sdivision,'trainingfd'=>$trainingfd,'trainingtd'=>$trainingtd,'dis'=>$dis));
        

        if ($data) {
            $this->session->set_flashdata('success', "Training Added Successfully");
        } else {
            $this->session->set_flashdata('error', "Sorry, Training Adding Failed.");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    function edit($id)
    {
        $data['content'] = $this->Training_model->select_training_byID($id); // Fetch the training data by ID
        $this->load->view('admin/header');
        $this->load->view('admin/edit-training', $data); // Pass data to the edit-training view
        $this->load->view('admin/footer');
    }

    public function update()
    {
        $id = $this->input->post('txtid');
        $employee_num = $this->input->post('txtemployee_num');
        $name = $this->input->post('txtname');
        $ttype = $this->input->post('txtttype');
        $department_tid = $this->input->post('txtdepartment_tid');
        $sdivision = $this->input->post('txtsdivision');
        $trainingfd = $this->input->post('txttrainingfd');
        $trainingtd = $this->input->post('txttrainingtd');
        $dis = $this->input->post('txtdis');

        $data = array(
            'name' => $name,
            'employee_num' => $employee_num,
            'ttype' => $ttype,
            'department_tid' => $department_tid,
            'sdivision' => $sdivision,
            'trainingfd' => $trainingfd,
            'trainingtd' => $trainingtd,
            'dis' => $dis
        );

        $result = $this->Training_model->update_training($data, $id);
        if ($result) {
            $this->session->set_flashdata('success', "Training Updated Successfully");
        } else {
            $this->session->set_flashdata('error', "Sorry, Training Update Failed.");
        }
        redirect(base_url()."training/manage_training");
    }

    public function delete($id)
    {
        $result = $this->Training_model->delete_training($id);

        if ($result) {
            $this->session->set_flashdata('success', "Training Deleted Successfully");
        } else {
            $this->session->set_flashdata('error', "Sorry, Training Delete Failed.");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

}
