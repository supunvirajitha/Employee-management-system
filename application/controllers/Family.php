<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Family extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url() . 'login');
        }
        $this->load->model('Family_model');
    }

    public function index()
    {
        $data['get_staff'] = $this->Staff_model->get_staff();

        $this->load->view('admin/header');
        $this->load->view('admin/add-family', $data);
        $this->load->view('admin/footer');
    }

    public function manage_family()
    {
        $data['content'] = $this->Family_model->select_family();
        $data['get_staff'] = $this->Staff_model->get_staff();

        $this->load->view('admin/header');
        $this->load->view('admin/manage-family', $data);
        $this->load->view('admin/footer');
    }

    public function family_print()
    {
        $data['content'] = $this->Family_model->select_family();
        $this->load->view('admin/header');
        $this->load->view('admin/family-print', $data);
        $this->load->view('admin/footer');
    }

    public function insert()
    {
        $this->form_validation->set_rules('txtname', 'Name', 'required');
        $this->form_validation->set_rules('txtemployee_num', 'Employee Number', 'required');
        $this->form_validation->set_rules('txtrelationship', 'Relationship', 'required');
        $this->form_validation->set_rules('txtmname', 'Member Name', 'required');
        $this->form_validation->set_rules('txtbday', 'Birthday', 'required');
        $this->form_validation->set_rules('txtnic', 'NIC', 'required');

        if ($this->form_validation->run() !== false) {
            $id = $this->input->post('txtid');
            $employee_num = $this->input->post('txtemployee_num');
            $name = $this->input->post('txtname');
            $mname = $this->input->post('txtmname');
            $relationship = $this->input->post('txtrelationship');
            $bday = $this->input->post('txtbday');
            $nic = $this->input->post('txtnic');

            // Upload Birth Certificate Image
            $config['upload_path'] = 'uploads/family/birth-certificate/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('birce')) {
                $image_data = $this->upload->data();
                $birce = $image_data['file_name'];
            } else {
                $birce = 'default-pic.jpg'; // Default image if upload fails
            }

            // Upload Marriage Certificate Image
            $config['upload_path'] = 'uploads/family/marriage-certificate/';
            $this->upload->initialize($config);

            if ($this->upload->do_upload('mace')) {
                $image_data = $this->upload->data();
                $mace = $image_data['file_name'];
            } else {
                $mace = 'default-pic.jpg'; // Default image if upload fails
            }

            $data = $this->Family_model->insert_family(array(
                'id' => $id,
                'employee_num' => $employee_num,
                'name' => $name,
                'mname' => $mname,
                'relationship' => $relationship,
                'bday' => $bday,
                'nic' => $nic,
                'birce' => $birce,
                'mace' => $mace
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
        $mname = $this->input->post('txtmname');
        $relationship = $this->input->post('txtrelationship');
        $bday = $this->input->post('txtbday');
        $nic = $this->input->post('txtnic');

        $birce_file_available = false;
        $mace_file_available = false;

        if ($_FILES['birce']['name'] != '') {
            $birce_file_available = true;

            $config['upload_path'] = 'uploads/family/birth-certificate/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $this->load->library('upload', $config, 'birce_upload');

            if ($this->birce_upload->do_upload('birce')) {
                $image_data = $this->birce_upload->data();

                $existing_image = $this->Family_model->get_birth_certificate_by_id($id);
                if ($existing_image && file_exists($config['upload_path'] . $existing_image)) {
                    unlink($config['upload_path'] . $existing_image);
                }

                $birce = $image_data['file_name'];
            } else {
                $birce = 'default-pic.jpg';
            }
        } else {
            $birce_file_available = false;
        }


        if ($_FILES['mace']['name'] != '') {
            $mace_file_available = true;
            $config1['upload_path'] = 'uploads/family/marriage-certificate/';
            $config1['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $this->load->library('upload', $config1, 'mace_upload');

            if ($this->mace_upload->do_upload('mace')) {
                $mace_image_data = $this->mace_upload->data();

                $mace_existing_image = $this->Family_model->get_marriage_certificate_by_id($id);
                if ($mace_existing_image && file_exists($config1['upload_path'] . $mace_existing_image)) {
                    unlink($config1['upload_path'] . $existing_image);
                }

                $mace = $mace_image_data['file_name'];
            } else {
                $mace = 'default-pic.jpg';
            }
        } else {
            $mace_file_available = false;
        }

        if ($birce_file_available && $mace_file_available) {
            $data = $this->Family_model->update_family(array('name' => $name, 'employee_num' => $employee_num, 'mname' => $mname, 'relationship' => $relationship, 'bday' => $bday, 'nic' => $nic, 'birce' => $birce, 'mace' => $mace), $id);
        } 
        elseif ($birce_file_available) {
            $data = $this->Family_model->update_family(array('name' => $name, 'employee_num' => $employee_num, 'mname' => $mname, 'relationship' => $relationship, 'bday' => $bday, 'nic' => $nic, 'birce' => $birce), $id);
        } elseif ($mace_file_available) {
            $data = $this->Family_model->update_family(array('name' => $name, 'employee_num' => $employee_num, 'mname' => $mname, 'relationship' => $relationship, 'bday' => $bday, 'nic' => $nic, 'mace' => $mace), $id);
        } 
        else {
            $data = $this->Family_model->update_family(array('name' => $name, 'employee_num' => $employee_num, 'mname' => $mname, 'relationship' => $relationship, 'bday' => $bday, 'nic' => $nic), $id);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', "Member Updated Succesfully");
        } else {
            $this->session->set_flashdata('error', "Sorry, Member Update Failed.");
        }
        redirect(base_url() . "family/manage_family");
    }


    // public function update()
    // {
    //     $id = $this->input->post('txtid');
    //     $employee_num = $this->input->post('txtemployee_num');
    //     $name = $this->input->post('txtname');
    //     $mname = $this->input->post('txtmname');
    //     $relationship = $this->input->post('txtrelationship');
    //     $bday = $this->input->post('txtbday');
    //     $nic = $this->input->post('txtnic');

    //     $data = $this->Family_model->update_family(array('name' => $name, 'employee_num' => $employee_num, 'mname' => $mname, 'relationship' => $relationship, 'bday' => $bday, 'nic' => $nic), $id);

    //     if ($this->db->affected_rows() > 0) {
    //         $this->session->set_flashdata('success', "Member Updated Succesfully");
    //     } else {
    //         $this->session->set_flashdata('error', "Sorry, Member Update Failed.");
    //     }
    //     redirect(base_url() . "family/manage_family");
    // }


    function edit($id)
    {
        $data['content'] = $this->Family_model->select_family_byID($id);
        $this->load->view('admin/header');
        $this->load->view('admin/edit-family', $data);
        $this->load->view('admin/footer');
    }


    function delete($id)
    {
        $data = $this->Family_model->delete_family($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', "Family Deleted Succesfully");
        } else {
            $this->session->set_flashdata('error', "Sorry, Family Delete Failed.");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}
