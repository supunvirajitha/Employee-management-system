<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Appreciate extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url() . 'login');
        }
        $this->load->model('Appreciate_model');
    }

    public function index()
    {
        $data['get_staff'] = $this->Staff_model->get_staff();

        $this->load->view('admin/header');
        $this->load->view('admin/add-appreciate', $data);
        $this->load->view('admin/footer');
    }

    public function manage_appreciate()
    {
        $data['content'] = $this->Appreciate_model->select_appreciate();
        $data['get_staff'] = $this->Staff_model->get_staff();

        $this->load->view('admin/header');
        $this->load->view('admin/manage-appreciate', $data);
        $this->load->view('admin/footer');
    }

    public function appreciate_print()
    {
        $data['content'] = $this->Appreciate_model->select_appreciate();
        $this->load->view('admin/header');
        $this->load->view('admin/appreciate-print', $data);
        $this->load->view('admin/footer');
    }

    public function insert()
    {
        $this->form_validation->set_rules('txtname', 'Name', 'required');
        $this->form_validation->set_rules('txtemployee_num', 'Employee Number', 'required');
        // $this->form_validation->set_rules('txtappreciatenote', 'Appreciate Note', 'required');
        // $this->form_validation->set_rules('txtappreciatedate', 'Appreciate Date', 'required');
      

        if ($this->form_validation->run() !== false) {
            $id = $this->input->post('txtid');
            $employee_num = $this->input->post('txtemployee_num');
            $name = $this->input->post('txtname');
            $appreciatenote = $this->input->post('txtappreciatenote');
            $appreciatedate = $this->input->post('txtappreciatedate');
           
            // Upload Birth Certificate Image
            $config['upload_path'] = 'uploads/appreciate/appreciatedoc/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('appreciatedoc')) {
                $image_data = $this->upload->data();
                $appreciatedoc = $image_data['file_name'];
            } else {
                $appreciatedoc = 'default-pic.jpg'; // Default image if upload fails
            }

            // Upload Marriage Certificate Image
            $config['upload_path'] = 'uploads/appreciate/appreciatedoc/';
            $this->upload->initialize($config);

            if ($this->upload->do_upload('appreciatedoc')) {
                $image_data = $this->upload->data();
                $appreciatedoc = $image_data['file_name'];
            } else {
                $appreciatedoc = 'default-pic.jpg'; // Default image if upload fails
            }

            $data = $this->Appreciate_model->insert_appreciate(array(
                'id' => $id,
                'employee_num' => $employee_num,
                'name' => $name,
                'appreciatenote' => $appreciatenote,
                'appreciatedate' => $appreciatedate, 
                'appreciatedoc' => $appreciatedoc,
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
            $appreciatenote = $this->input->post('txtappreciatenote');
            $appreciatedate = $this->input->post('txtappreciatedate');
            
        $appreciatedoce_file_available = false;
        $appreciatedoc_file_available = false;

        if ($_FILES['appreciatedoc']['name'] != '') {
            $appreciatedoc_file_available = true;

            $config['upload_path'] = 'uploads/appreciate/birth-certificate/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $this->load->library('upload', $config, 'appreciatedoc_upload');

            if ($this->appreciatedoc_upload->do_upload('appreciatedoc')) {
                $image_data = $this->appreciatedoc_upload->data();

                $existing_image = $this->Appreciate_model->get_birth_certificate_by_id($id);
                if ($existing_image && file_exists($config['upload_path'] . $existing_image)) {
                    unlink($config['upload_path'] . $existing_image);
                }

                $appreciatedoc = $image_data['file_name'];
            } else {
                $appreciatedoc = 'default-pic.jpg';
            }
        } else {
            $appreciatedoc_file_available = false;
        }


        if ($_FILES['appreciatedoc']['name'] != '') {
            $appreciateedoc_file_available = true;
            $config1['upload_path'] = 'uploads/appreciate/appreciatedoc/';
            $config1['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $this->load->library('upload', $config1, 'appreciatedoc_upload');

            if ($this->appreciatedoc_upload->do_upload('appreciatedoc')) {
                $appreciatedoc_image_data = $this->appreciatedoc_upload->data();

                $appreciatedoc_existing_image = $this->Appreciate_model->get_marriage_certificate_by_id($id);
                if ($appreciatedoc_existing_image && file_exists($config1['upload_path'] . $appreciatedoc_existing_image)) {
                    unlink($config1['upload_path'] . $existing_image);
                }

                $appreciatedoc = $appreciatedoc_image_data['file_name'];
            } else {
                $appreciatedoc = 'default-pic.jpg';
            }
        } else {
            $appreciatedoc_file_available = false;
        }

        if ($appreciatedoc_file_available && $appreciatedoc_file_available) {
            $data = $this->Appreciate_model->update_appreciate(array('name' => $name, 'employee_num' => $employee_num, 'appreciatenote' => $appreciatenote,  'appreciatedate' => $appreciatedate, 'appreciatedoc' => $appreciatedoc, 'appreciatedoc' => $appreciatedoc), $id);
        } 
        elseif ($appreciatedoc_file_available) {
            $data = $this->Appreciate_model->update_appreciate(array('name' => $name, 'employee_num' => $employee_num, 'appreciatenote' => $appreciatenote,  'appreciatedate' => $appreciatedate,  'appreciatedoc' => $appreciatedoc), $id);
        } elseif ($appreciatedoc_file_available) {
            $data = $this->Appreciate_model->update_appreciate(array('name' => $name, 'employee_num' => $employee_num, 'appreciatenote' => $appreciatenote,  'appreciatedate' => $appreciatedate,  'appreciatedoc' => $appreciatedoc), $id);
        } 
        else {
            $data = $this->Appreciate_model->update_appreciate(array('name' => $name, 'employee_num' => $employee_num, 'appreciatenote' => $appreciatenote,  'appreciatedate' => $appreciatedate ), $id);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', "Member Updated Succesfully");
        } else {
            $this->session->set_flashdata('error', "Sorry, Member Update Failed.");
        }
        redirect(base_url() . "appreciate/manage_appreciate");
    }


   

    function edit($id)
    {
        $data['content'] = $this->Appreciate_model->select_appreciate_byID($id);
        $this->load->view('admin/header');
        $this->load->view('admin/edit-appreciate', $data);
        $this->load->view('admin/footer');
    }


    function delete($id)
    {
        $data = $this->Appreciate_model->delete_appreciate($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', "Appreciate Deleted Succesfully");
        } else {
            $this->session->set_flashdata('error', "Sorry, Appreciate Delete Failed.");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}
