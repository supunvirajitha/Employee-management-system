<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotion extends CI_Controller {

    function __construct()  
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect(base_url().'login');
        }
    }

    public function promotion_print()
    {
         // Check if date range filters are provided
    $from = $this->input->post('from');
    $to = $this->input->post('to');

    // Pass date range filters to the model method for retrieval
    $data['content'] = $this->Promotion_model->select_promotion($from, $to);
        $this->load->view('admin/header');
        $this->load->view('admin/promotion-print',$data);
        $this->load->view('admin/footer');
    }


    public function index()
    {
        //.
        //$data['departments']=$this->Department_model->select_departments();
        $data['get_staff'] = $this -> Staff_model -> get_staff();
        
        //$data['content']=$this->Staff_model->select_staff();
       
        //\.
        $this->load->view('admin/header');
        $this->load->view('admin/add-Promotion',$data);
        $this->load->view('admin/footer');
    }

    public function manage_promotion()
{
    // Check if date range filters are provided
    $from = $this->input->post('from');
    $to = $this->input->post('to');

    // Pass date range filters to the model method for retrieval
    $data['content'] = $this->Promotion_model->select_promotion($from, $to);

    // Load the view
    $this->load->view('admin/header');
    $this->load->view('admin/manage-promotion', $data);
    $this->load->view('admin/footer');
}
    

    // public function manage_Promotion()
    // {
    //     $data['content']=$this->Promotion_model->select_promotion();
    //     //$data['get_staff'] = $this -> Staff_model -> get_staff();
    //     //$data['data'] = $this->Promotion_model->sget_pname();
    //     // $data['sget_pname'] = $this -> Promotion_model-> sget_pname();
    //     //$data['content']=$this->Staff_model->select_staff();
    //     $this->load->view('admin/header');
    //     $this->load->view('admin/manage-promotion',$data);
    //     $this->load->view('admin/footer');
    // }

    public function insert()
    {
        $this->form_validation->set_rules('txtname', 'Name', 'required');
        $this->form_validation->set_rules('txtemployee_num', 'employee Number','required');
        $this->form_validation->set_rules('txtdesignation', 'Designation', 'required');
        $this->form_validation->set_rules('txtdesifd', 'Start', 'required');
        $this->form_validation->set_rules('txtstatus', 'Status', 'required');
       

        if ($this->form_validation->run() === false) {
            // Validation failed, reload the form with validation errors
            $this->index();
            return;
        }


        $id=$this->input->post('txtid');
        $employee_num=$this->input->post('txtemployee_num');
        $name=$this->input->post('txtname');
        $designation=$this->input->post('txtdesignation');
        $desiduration=$this->input->post('txtdesiduration');
        $desifd=$this->input->post('txtdesifd');
        $desitd=$this->input->post('txtdesitd');
        $status=$this->input->post('txtstatus');


        $data=$this->Promotion_model->insert_promotion(array('id'=>$id,'employee_num' =>$employee_num,'name'=>$name,'designation'=>$designation,'desiduration'=>$desiduration,'desifd'=>$desifd,'desitd'=>$desitd,'status'=>$status));

        if($name==true)
        {
            $this->session->set_flashdata('success', " Added Succesfully"); 
        }else{
            $this->session->set_flashdata('error', "Sorry, Adding Failed.");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update()
    {
        $id=$this->input->post('txtid');
        $employee_num=$this->input->post('txtemployee_num');
        $name=$this->input->post('txtname');
        $designation=$this->input->post('txtdesignation');
        $desiduration=$this->input->post('txtdesiduration');
        $desifd=$this->input->post('txtdesifd');
        $desitd=$this->input->post('txtdesitd');
        $status=$this->input->post('txtstatus');

        $data=$this->Promotion_model->update_promotion(array('name'=>$name, 'employee_num' =>$employee_num,'designation'=>$designation,'desiduration'=>$desiduration,'desifd'=>$desifd,'desitd'=>$desitd,'status'=>$status),$id);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('success', " Updated Succesfully"); 
        }else{
            $this->session->set_flashdata('error', "Sorry,  Update Failed.");
        }
        redirect(base_url()."promotion/manage_promotion");
    }


    function edit($id)
    {
        $data['content']=$this->Promotion_model->select_promotion_byID($id);
        $this->load->view('admin/header');
        $this->load->view('admin/edit-promotion',$data);
        $this->load->view('admin/footer');
    }


    function delete($id)
    {
        $data=$this->Promotion_model->delete_promotion($id);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('success', " Deleted Succesfully"); 
        }else{
            $this->session->set_flashdata('error', "Sorry, Delete Failed.");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }



}
