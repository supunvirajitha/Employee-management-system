<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inquirie_model extends CI_Model
{


    function insert_inquirie($data)
    {
        $this->db->insert("inquirie_tbl", $data);
        return $this->db->insert_id();
    }

    function select_inquirie()
    {
        $this->db->order_by('inquirie_tbl.name', 'DESC');
        $this->db->select("inquirie_tbl.*,staff_tbl.staff_name");
        $this->db->from("inquirie_tbl");
        $this->db->join("staff_tbl", 'staff_tbl.id=inquirie_tbl.name');

        $qry = $this->db->get();
        if ($qry->num_rows() > 0) {
            $result = $qry->result_array();
            return $result;
        }
    }

    function select_inquirie_byID($id)
    {

        $this->db->where('id', $id);
        $qry = $this->db->get('inquirie_tbl');
        if ($qry->num_rows() > 0) {
            $result = $qry->result_array();
            return $result;
        }
    }


    public function get_inquirie_doc_by_id($id)
    {
        $this->db->select('inquiriedoc');
        $this->db->where('id', $id);
        $query = $this->db->get('inquirie_tbl');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->inquiriedoc;
        } else {
            return false;
        }
    }

    function delete_inquirie($id)
    {
        $this->db->where('id', $id);
        $this->db->delete("inquirie_tbl");
        $this->db->affected_rows();
    }

    public function get_birth_certificate_by_id($id)
    {
        $this->db->select('birce');
        $this->db->where('id', $id);
        $query = $this->db->get('inquirie_tbl');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->birce;
        } else {
            return false;
        }
    }

    public function get_inquiriedoc_by_id($id)
    {
        $this->db->select('inquiriedoc');
        $this->db->where('id', $id);
        $query = $this->db->get('inquirie_tbl');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->inquiriedoc;
        } else {
            return false;
        }
    }

    function update_inquirie($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('inquirie_tbl', $data);
        $this->db->affected_rows();
    }
}
