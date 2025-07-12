<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Grade_model extends CI_Model
{


    function insert_grade($data)
    {
        $this->db->insert("grade_tbl", $data);
        return $this->db->insert_id();
    }

    function select_grade()
    {
        $this->db->order_by('grade_tbl.name', 'DESC');
        $this->db->select("grade_tbl.*,staff_tbl.staff_name");
        $this->db->from("grade_tbl");
        $this->db->join("staff_tbl", 'staff_tbl.id=grade_tbl.name');
        $qry = $this->db->get();
        if ($qry->num_rows() > 0) {
            $result = $qry->result_array();
            return $result;
        }
    }

    function select_grade_byID($id)
    {

        $this->db->where('id', $id);
        $qry = $this->db->get('grade_tbl');
        if ($qry->num_rows() > 0) {
            $result = $qry->result_array();
            return $result;
        }
    }

    public function get_ebexamcertificate_by_id($id)
    {
        $this->db->select('ebexamcertificate');
        $this->db->where('id', $id);
        $query = $this->db->get('grade_tbl');
        $row = $query->row();
        if ($row) {
            return $row->ebexamcertificate;
        } else {
            return false;
        }
    }

    function delete_grade($id)
    {
        $this->db->where('id', $id);
        $this->db->delete("grade_tbl");
        $this->db->affected_rows();
    }

    function update_grade($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('grade_tbl', $data);
        $this->db->affected_rows();
    }
}
