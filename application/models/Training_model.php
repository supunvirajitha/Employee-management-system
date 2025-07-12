<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training_model extends CI_Model {


    function insert_training($data)
    {
        $this->db->insert("training_tbl",$data);
        return $this->db->insert_id();
    }

    function select_training()
    {
        $this->db->order_by('training_tbl.name','DESC');
        $this->db->select("training_tbl.*,staff_tbl.staff_name");
        $this->db->from("training_tbl");
        $this->db->join("staff_tbl",'staff_tbl.id=training_tbl.name');

        $qry=$this->db->get();
        if($qry->num_rows()>0)
        {
            $result=$qry->result_array();
            return $result;
        }
    }

    function select_training_byID($id)
    {

        $this->db->where('id',$id);
        $qry=$this->db->get('training_tbl');
        if($qry->num_rows()>0)
        {
            $result=$qry->result_array();
            return $result;
        }
    }

    function delete_training($id)
    {
        $this->db->where('id', $id);
        $this->db->delete("training_tbl");
        $this->db->affected_rows();
    }

    

    function update_training($data,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('training_tbl',$data);
        $this->db->affected_rows();
    }


}
