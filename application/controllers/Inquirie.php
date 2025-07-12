<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inquirie extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url() . 'login');
        }
        $this->load->model('Inquirie_model');
    }

    public function index()
    {
        $data['get_staff'] = $this->Staff_model->get_staff();

        $this->load->view('admin/header');
        $this->load->view('admin/add-inquirie', $data);
        $this->load->view('admin/footer');
    }

    public function manage_inquirie()
    {
        $data['content'] = $this->Inquirie_model->select_inquirie();
        $data['get_staff'] = $this->Staff_model->get_staff();

        $this->load->view('admin/header');
        $this->load->view('admin/manage-inquirie', $data);
        $this->load->view('admin/footer');
    }

    public function inquirie_print()
    {
        $data['content'] = $this->Inquirie_model->select_inquirie();
        $this->load->view('admin/header');
        $this->load->view('admin/inquirie-print', $data);
        $this->load->view('admin/footer');
    }

    public function insert()
    {
        $this->form_validation->set_rules('txtname', 'Name', 'required');
        $this->form_validation->set_rules('txtemployee_num', 'Employee Number', 'required');
        // $this->form_validation->set_rules('txtinquirienote', 'Inquirie Note', 'required');
        // $this->form_validation->set_rules('txtinquiriedate', 'Inquirie Date', 'required');
      

        if ($this->form_validation->run() !== false) {
            $id = $this->input->post('txtid');
            $employee_num = $this->input->post('txtemployee_num');
            $name = $this->input->post('txtname');
            $inquirienote = $this->input->post('txtinquirienote');
            $inquiriedate = $this->input->post('txtinquiriedate');
           
            // Upload Birth Certificate Image
            $config['upload_path'] = 'uploads/inquirie/inquiriedoc/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('inquiriedoc')) {
                $image_data = $this->upload->data();
                $inquiriedoc = $image_data['file_name'];
            } else {
                $inquiriedoc = 'default-pic.jpg'; // Default image if upload fails
            }

            // Upload Marriage Certificate Image
            $config['upload_path'] = 'uploads/inquirie/inquiriedoc/';
            $this->upload->initialize($config);

            if ($this->upload->do_upload('inquiriedoc')) {
                $image_data = $this->upload->data();
                $inquiriedoc = $image_data['file_name'];
            } else {
                $inquiriedoc = 'default-pic.jpg'; // Default image if upload fails
            }

            $data = $this->Inquirie_model->insert_inquirie(array(
                'id' => $id,
                'employee_num' => $employee_num,
                'name' => $name,
                'inquirienote' => $inquirienote,
                'inquiriedate' => $inquiriedate, 
                'inquiriedoc' => $inquiriedoc,
            ));

            if ($data == true) {
                $this->session->set_flashdata('success', "Member Added Successfully");
            } else {
                $this->session->set_flashdata('error', "Sorry, Member Adding Failed.");
            }
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->index();
            return false;
        }
    }

    public function update()
    {
        $id = $this->input->post('txtid');
            $employee_num = $this->input->post('txtemployee_num');
            $name = $this->input->post('txtname');
            $inquirienote = $this->input->post('txtinquirienote');
            $inquiriedate = $this->input->post('txtinquiriedate');
            
        // $inquiriedoce_file_available = false;
        $inquiriedoc_file_available = false;

        // if ($_FILES['inquiriedoc']['name'] != '') {
        //     $inquiriedoc_file_available = true;

        //     $config['upload_path'] = 'uploads/inquirie/birth-certificate/';
        //     $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        //     $this->load->library('upload', $config, 'inquiriedoc_upload');

        //     if ($this->inquiriedoc_upload->do_upload('inquiriedoc')) {
        //         $image_data = $this->inquiriedoc_upload->data();

        //         $existing_image = $this->Inquirie_model->get_birth_certificate_by_id($id);
        //         if ($existing_image && file_exists($config['upload_path'] . $existing_image)) {
        //             unlink($config['upload_path'] . $existing_image);
        //         }

        //         $inquiriedoc = $image_data['file_name'];
        //     } else {
        //         $inquiriedoc = 'default-pic.jpg';
        //     }
        // } else {
        //     $inquiriedoc_file_available = false;
        // }


        if ($_FILES['inquiriedoc']['name'] != '') {
            $inquiriedoc_file_available = true;
            $config1['upload_path'] = 'uploads/inquirie/inquiriedoc/';
            $config1['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $this->load->library('upload', $config1, 'inquiriedoc_upload');

            if ($this->inquiriedoc_upload->do_upload('inquiriedoc')) {
                $inquiriedoc_image_data = $this->inquiriedoc_upload->data();

                $inquiriedoc_existing_image = $this->Inquirie_model->get_inquirie_doc_by_id($id);
                if ($inquiriedoc_existing_image && file_exists($config1['upload_path'] . $inquiriedoc_existing_image)) {
                    unlink($config1['upload_path'] . $existing_image);
                }

                $inquiriedoc = $inquiriedoc_image_data['file_name'];
            } else {
                $inquiriedoc = 'default-pic.jpg';
            }
        } else {
            $inquiriedoc_file_available = false;
        }

        // $data = $this->Inquirie_model->update_inquirie(array('name' => $name, 'employee_num' => $employee_num, 'inquirienote' => $inquirienote,  'inquiriedate' => $inquiriedate, 'inquiriedoc' => $inquiriedoc, 'inquiriedoc' => $inquiriedoc), $id);


        if ($inquiriedoc_file_available) {
            $data = $this->Inquirie_model->update_inquirie(array('name' => $name, 'employee_num' => $employee_num, 'inquirienote' => $inquirienote,  'inquiriedate' => $inquiriedate, 'inquiriedoc' => $inquiriedoc, 'inquiriedoc' => $inquiriedoc), $id);
        } 
        // elseif ($inquiriedoc_file_available) {
        //     $data = $this->Inquirie_model->update_inquirie(array('name' => $name, 'employee_num' => $employee_num, 'inquirienote' => $inquirienote,  'inquiriedate' => $inquiriedate,  'inquiriedoc' => $inquiriedoc), $id);
        // } elseif ($inquiriedoc_file_available) {
        //     $data = $this->Inquirie_model->update_inquirie(array('name' => $name, 'employee_num' => $employee_num, 'inquirienote' => $inquirienote,  'inquiriedate' => $inquiriedate,  'inquiriedoc' => $inquiriedoc), $id);
        // } 
        else {
            $data = $this->Inquirie_model->update_inquirie(array('name' => $name, 'employee_num' => $employee_num, 'inquirienote' => $inquirienote,  'inquiriedate' => $inquiriedate ), $id);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', "Member Updated Succesfully");
        } else {
            $this->session->set_flashdata('error', "Sorry, Member Update Failed.");
        }
        redirect(base_url() . "inquirie/manage_inquirie");
    }


   

    function edit($id)
    {
        $data['content'] = $this->Inquirie_model->select_inquirie_byID($id);
        $this->load->view('admin/header');
        $this->load->view('admin/edit-inquirie', $data);
        $this->load->view('admin/footer');
    }


    function delete($id)
    {
        $data = $this->Inquirie_model->delete_inquirie($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', "Inquirie Deleted Succesfully");
        } else {
            $this->session->set_flashdata('error', "Sorry, Inquirie Delete Failed.");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}
