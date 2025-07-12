<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect(base_url().'login');
        }
    }


    public function transfer_print()
    {
        $data['content']=$this->Transfer_model->select_transfer();
        $this->load->view('admin/header');
        $this->load->view('admin/transfer-print',$data);
        $this->load->view('admin/footer');
    }

    
    public function index()
    {
        //.
        //$data['departments']=$this->Department_model->select_departments();
        $data['get_staff'] = $this -> Staff_model -> get_staff();
        //$data['get_dep'] = $this -> Department_model -> get_dep();
        //\.
        $this->load->view('admin/header');
        $this->load->view('admin/add-Transfer',$data);
        $this->load->view('admin/footer');

    }

    public function manage_transfer()
    {
        $data['content']=$this->Transfer_model->select_transfer();
        $data['get_staff'] = $this -> Staff_model -> get_staff();
        
        $this->load->view('admin/header');
        $this->load->view('admin/manage-transfer',$data);
        $this->load->view('admin/footer');
    }

    public function insert()
    {



        $this->form_validation->set_rules('txtname', 'Name', 'required');
        //  $this->form_validation->set_rules('txtdepartment_tid', 'Division', 'required');
        $this->form_validation->set_rules('txttransferfd', 'Start', 'required');
        // $this->form_validation->set_rules('txtsdivision', 'Sub Division', 'required');
        $this->form_validation->set_rules('txtemployee_num', 'employee Number','required');

        if ($this->form_validation->run() === false) {
            // Validation failed, reload the form with validation errors
            $this->index();
            return;
        }



        $id=$this->input->post('txtid');
        $employee_num=$this->input->post('txtemployee_num');
        $name=$this->input->post('txtname');
        $type=$this->input->post('txttype');
        $department_tid=$this->input->post('txtdepartment_tid');
        $sdivision=$this->input->post('txtsdivision');
        $transferfd=$this->input->post('txttransferfd');
        $transfertd=$this->input->post('txttransfertd');
        $dis=$this->input->post('txtdis');

        


        $data=$this->Transfer_model->insert_transfer(array('name'=>$name, 'employee_num' =>$employee_num,'id'=>$id,'ttype'=>$type,'department_tid'=>$department_tid,'sdivision'=>$sdivision,'transferfd'=>$transferfd,'transfertd'=>$transfertd,'dis'=>$dis));
        
        
        if($name==true)
        {
            $this->session->set_flashdata('success', "Transfer Added Succesfully"); 
        }else{
            $this->session->set_flashdata('error', "Sorry, Transfer Adding Failed.");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    function edit($id)
    {
        $data['content'] = $this->Transfer_model->select_transfer_byID($id); // Fetch the transfer data by ID
        $this->load->view('admin/header');
        $this->load->view('admin/edit-transfer', $data); // Pass data to the edit-transfer view
        $this->load->view('admin/footer');
    }

    function update()
    {
        $id = $this->input->post('txtid');
        $employee_num = $this->input->post('txtemployee_num');
        $name = $this->input->post('txtname');
        $ttype = $this->input->post('txtttype');
        $department_tid = $this->input->post('txtdepartment_tid');
        $sdivision = $this->input->post('txtsdivision');
        $transferfd = $this->input->post('txttransferfd');
        $transfertd = $this->input->post('txttransfertd');
        $dis = $this->input->post('txtdis');

        $data = array(
            'name' => $name,
            'employee_num' => $employee_num,
            'ttype' => $ttype,
            'department_tid' => $department_tid,
            'sdivision' => $sdivision,
            'transferfd' => $transferfd,
            'transfertd' => $transfertd,
            'dis' => $dis
        );

        $result = $this->Transfer_model->update_transfer($data, $id);
        if ($result) {
            $this->session->set_flashdata('success', "Transfer Updated Successfully");
        } else {
            $this->session->set_flashdata('error', "Sorry, Transfer Update Failed.");
        }
        redirect(base_url()."transfer/manage_transfer");
    }




    function delete($id)
    {
        $data=$this->Transfer_model->delete_transfer($id);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('success', "Transfer Deleted Succesfully"); 
        }else{
            $this->session->set_flashdata('error', "Sorry, Transfer Delete Failed.");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }



}
