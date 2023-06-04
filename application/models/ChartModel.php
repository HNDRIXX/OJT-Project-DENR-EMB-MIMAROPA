<?php

class ChartModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    // // DONUT MODEL
    // public function getTotalChartData()
    // {
    //     $this->db->select('status, count(*) as total');
    //     $this->db->from('graphchart');
    //     $this->db->group_by('status');
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    public function getJoin() {
        // $this->db->select('COUNT(id) as totalid');
        // $this->db->from('embfr');
        // $query = $this->db->get();
// 143 54
        $this->db->select('id');
        $this->db->from('embfr');
        $query = $this->db->get();
        return $query->result_array();
    }

    // public function get_chart_data($start_date, $end_date)
    // {
    //     $this->db->select('status, count(*) as total');
    //     $this->db->from('graphchart');
    //     $this->db->where('date >=', $start_date);
    //     $this->db->where('date <=', $end_date);
    //     $this->db->group_by('status');
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    // public function get_authenticate($username) {
	// 	$query = $this->db->get_where('orgchart', array('name' => $username, 'admin' => 1));
    //     return $query->row();
	// }

    public function getOrgChart(){
        $query = $this->db->get('orgchart');
        return $query->result_array();
    }

    public function getFr(){
        $query = $this->db->get('embfr');
        return $query->result_array();
    }

    public function getOrgChartHistory(){
        $query = $this->db->get('orgcharthis');
        return $query->result_array();
    }

    public function getDataEdit($default){
        $this->db->where('id', $default);
        $result = $this->db->get('orgchart');
        return $result->row_array();
    }

    public function getSimilarBlock($default){
        $this->db->where('block', $default);
        $query = $this->db->get('orgchart');
        return $query->row_array();
    }

    // EXPRMNT DELETE OLD DATA
    // public function deleteOld() {
    //     $now = time();
    //     $two_days_ago = strtotime('-2 days', $now);
    //     $this->db->where('STR_TO_DATE(authDate, "%Y-%m-%d") <', date('Y-m-d', $two_days_ago));
    //     $this->db->delete('embfr');
    //     return $this->db->affected_rows();
    // }
    public function deleteOld() {
        // $date = '2023-05-16';
        $now = time();
        $yesterday = strtotime('-1 day', $now);
        $date = date('Y-m-d', $yesterday);
        
        $this->db->where('STR_TO_DATE(authDate, "%Y-%m-%d") <=', $date);
        $this->db->delete('embfr');
        
        return $this->db->affected_rows();
    }

    public function update_block() {
        $id = $this->input->post('id');
        $data = array( 'block' => $this->input->post('block'), );
        $this->db->where('id', $id);
        return $this->db->update('orgchart', $data);
    }

    public function update_existblock(){
        $existid = $this->input->post('existid');
        $data = array( 'block' => "noblock" );
        $this->db->where('id', $existid);
        return $this->db->update('orgchart', $data);
    }

    public function update_data($image_tmp) {
        $id = $this->input->post('id');
        $swapid = $this->input->post('swap');

        if (empty($image_tmp)){
            if (!empty($this->input->post('swap'))){
                $data = array (
                    'id' => $this->input->post('swap'),
                    'name' => $this->input->post('name'),
                    'embid' => $this->input->post('embid'),
                    'division' => $this->input->post('division'),
                    'section' => $this->input->post('section'),
                    'unit' => $this->input->post('unit'),
                    'empstatus' => $this->input->post('empstatus'),
                    'role' => $this->input->post('role'),
                    'enmo' => $this->input->post('enmo'),
                    'emptitle' => $this->input->post('emptitle')
                );
            }else
                $data = array(
                    'name' => $this->input->post('name'),
                    'embid' => $this->input->post('embid'),
                    'division' => $this->input->post('division'),
                    'section' => $this->input->post('section'),
                    'unit' => $this->input->post('unit'),
                    'empstatus' => $this->input->post('empstatus'),
                    'role' => $this->input->post('role'),
                    'enmo' => $this->input->post('enmo'),
                    'emptitle' => $this->input->post('emptitle')
                );
        }else{
            $img_data = file_get_contents($image_tmp);
            $img_data = base64_encode($img_data);

            if (!empty($this->input->post('swap'))){
                $data = array(
                    'id' => $this->input->post('swap'),
                    'name' => $this->input->post('name'),
                    'embid' => $this->input->post('embid'),
                    'division' => $this->input->post('division'),
                    'section' => $this->input->post('section'),
                    'unit' => $this->input->post('unit'),
                    'empstatus' => $this->input->post('empstatus'),
                    'role' => $this->input->post('role'),
                    'enmo' => $this->input->post('enmo'),
                    'emptitle' => $this->input->post('emptitle'),
                    'img' => $img_data
                );
            }else
                $data = array(
                    'name' => $this->input->post('name'),
                    'embid' => $this->input->post('embid'),
                    'division' => $this->input->post('division'),
                    'section' => $this->input->post('section'),
                    'unit' => $this->input->post('unit'),
                    'empstatus' => $this->input->post('empstatus'),
                    'role' => $this->input->post('role'),
                    'enmo' => $this->input->post('enmo'),
                    'emptitle' => $this->input->post('emptitle'),
                    'img' => $img_data
                );
        }

        $datahis = array(
            'name' => $this->input->post('name'),
            'embid' => $this->input->post('embid'),
            'action' => "Update",
            'date' => $this->input->post('date'),
            'remarks' => $this->input->post('remarks')
        );

        $this->db->insert('orgcharthis', $datahis);
        $this->db->where('id', $id);
        return $this->db->update('orgchart', $data);
    }

    public function update_swap() {
        $data = array( 'id' => "9999" );
        $this->db->where('id', $this->input->post('swap'));
        return $this->db->update('orgchart', $data);
    }

    public function update_swaptwo(){
        $idswap = $this->input->post('id');
        $data = array( 'id' => $idswap );
        $this->db->where('id', "9999");
        return $this->db->update('orgchart', $data);
    }

    public function delete_frdata() {
        $id = $this->input->post('id');
        
        $this->db->where('id', $id);
        $this->db->delete('embfr');
        
        return $this->db->affected_rows();
    }
    
    public function delete_data() {
        $id = $this->input->post('id');

        $data = array(
            'name' => $this->input->post('name'),
            'embid' => $this->input->post('embid'),
            'division' => $this->input->post('division'),
            'section' => $this->input->post('section'),
            'unit' => $this->input->post('unit'),
            'empstatus' => $this->input->post('empstatus'),
            'role' => $this->input->post('role'),
            'enmo' => $this->input->post('enmo'),
            'block' => "noblock",
            'showhide'=> "0"
        );

        $datahis = array(
            'name' => $this->input->post('name'),
            'embid' => $this->input->post('embid'),
            'action' => "Delete",
            'date' => $this->input->post('date'),
            'remarks' => $this->input->post('remarks')
        );

        $this->db->insert('orgcharthis', $datahis);
        $this->db->where('id', $id);
        return $this->db->update('orgchart', $data);
    }

    public function check_name($name) {
        $this->db->where('name', $name);
        $query = $this->db->get('orgchart');
        return $query->num_rows() > 0;
    }
}