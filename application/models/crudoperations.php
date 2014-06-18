<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//Create Read Update Delete
class CrudOperations extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function create($table, $data) {
        $result = 0;
        $result = $this->db->insert($table, $data);
        return $result;
    }

    public function read($table, $where = '', $join = '', $groupBy = '', $orderBy = '') {
        $this->db->from($table);
        if (trim($where) != '')
            $this->db->where($where, NULL, FALSE);
//        if (is_array($join))
//            $this->db->join($join[0], $join[1], $join[2]);
        if (!empty($join) && is_array($join)) {
            if (is_array($join[0]) && !empty($join[0])) {
                foreach ($join as $key => $val) {
                    if (is_array($val) && !empty($val))
                        $this->db->join($join[$key][0], $join[$key][1], $join[$key][2]);
                }
            }
            else
                $this->db->join($join[0], $join[1], $join[2]);
        }


        if (!empty($groupBy) != '')
            $this->db->group_by($groupBy);

        if (!empty($orderBy) != '')
            $this->db->order_by($orderBy);

        $query = $this->db->get();
        return $query;
    }

    public function update($table, $data, $where) {
        $this->db->where($where, NULL, FALSE);
        $this->db->update($table, $data);
    }

    public function delete($table, $where) {
        $this->db->where($where, NULL, FALSE);
        $this->db->delete($table);
    }

}

/* End of file crudoperations.php */
/* Location: ./application/models/crudoperations.php */