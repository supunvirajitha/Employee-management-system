<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotion_model extends CI_Model {


    function insert_promotion($data)
    {
        $this->db->insert("promotion_tbl",$data);
        return $this->db->insert_id();
    }






    function select_promotion($from = null, $to = null)
{
    // Start building your query
    $this->db->select("promotion_tbl.*, staff_tbl.staff_name");
    $this->db->from("promotion_tbl");
    $this->db->join("staff_tbl", 'staff_tbl.id = promotion_tbl.name');

    // Apply date range filter if provided
    if ($from && $to) {
       
        $fromDate = date('Y-m-d', strtotime($from));
        $toDate = date('Y-m-d', strtotime($to));

        // Use query binding to prevent SQL injection
        $this->db->where("promotion_tbl.desifd BETWEEN '$fromDate' AND '$toDate'");
    }

    // Execute the query
    $qry = $this->db->get();

    // Check if there are results
    if ($qry->num_rows() > 0) {
        return $qry->result_array();
    } else {
        return array(); // Return an empty array if no results
    }
}

    











    // function select_promotion()
    // {
    //     $this->db->order_by('promotion_tbl.name','DESC');
    //     $this->db->select("promotion_tbl.*,staff_tbl.staff_name");
    //     $this->db->from("promotion_tbl");
    //     $this->db->join("staff_tbl",'staff_tbl.id=promotion_tbl.name');

    //     $qry=$this->db->get();
    //     if($qry->num_rows()>0)
    //     {
    //         $result=$qry->result_array();
    //         return $result;
    //     }
    // }

    function select_promotion_byID($id)
    {

        $this->db->where('id',$id);
        $qry=$this->db->get('promotion_tbl');
        if($qry->num_rows()>0)
        {
            $result=$qry->result_array();
            return $result;
        }
    }

    function delete_promotion($id)
    {
        $this->db->where('id', $id);
        $this->db->delete("promotion_tbl");
        $this->db->affected_rows();
    }

    

    function update_promotion($data,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('promotion_tbl',$data);
        $this->db->affected_rows();
    }

    // function sget_pname()
    // {
    //     // $this->db->select("promotion_tbl.*,staff_tbl.staff_name");
    //     // $this->db->from("promotion_tbl");
    //     // $this->db->join("staff_tbl",'promotion_tbl.name=staff_tbl.id');    

    //     // $this->db->where('promotion_tbl.name');
    //     // $this->db->select("promotion_tbl.*,staff_tbl.staff_name");
    //     // $this->db->from("promotion_tbl");
    //     // $this->db->join("staff_tbl",'staff_tbl.id=promotion_tbl.name');

    //     $qry=$this->db->get('staff_tbl');
    //     if($qry->num_rows()>0)
    //     {
    //         $result=$qry->result_array();
    //         return $result;
    //     }
    // }

}
