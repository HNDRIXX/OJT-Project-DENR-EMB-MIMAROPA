<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller{

    public function __construct() {
        parent:: __construct();
        $this->load->model('ChartModel');
        $this->orgchart = $this->ChartModel->getOrgchart();
        $this->fr = $this->ChartModel->getFr();
    }

    public function index() { 
        if (!file_exists(APPPATH.'views/pages/index.php')){ show_404(); }
        $this->load->view('pages/index'); 
    }

    public function authenticate() {
        // $user = $this->ChartModel->get_authenticate($username);

        if($this->input->post('codeinput') == 1){ $is_admin = 1; }
        else { $is_admin = null; }

        $this->session->set_userdata('is_admin', $is_admin);
        redirect('home');
	}

    public function signctrl() {
        session_destroy();
        redirect('index');
	}

    // DONUT CONTROLLER
    public function donut() {
        $data['join'] = $this->ChartModel->getJoin();
        // $data['total'] = $counts->total;
        // $data['fr'] = $counts->fr;
        $this->load->view('pages/donut', $data);
    }
    
    // public function get_chart_data()
    // {
    //     $start_date = $this->input->post('start_date');
    //     $end_date = $this->input->post('end_date');
    //     $chart_data = $this->ChartModel->get_chart_data($start_date, $end_date);
    //     echo json_encode($chart_data);
    // }

    // public function get_orgchart_data()
    // {
    //     $this->db->select('name');
    //     $this->db->from('orgchart');
    //     $query = $this->db->get();
    //     $data = $query->result_array();
    //     echo json_encode($data);
    // }

    public function updatedonut() {
        $orgchart = $this->ChartModel->getOrgChart();
        echo json_encode($orgchart);
    }

    public function updateStatusFr() {
        $orgchart = $this->ChartModel->getFr();
        echo json_encode($orgchart);
    }

    public function home() { 
        $this->load->view('pages/home'); }

    public function floorplanpismu() {
        $this->ChartModel->deleteOld();
        $this->load->view('pages/floorplan-pismu', array('orgchart' => $this->orgchart, 'fr' => $this->fr));
        $this->load->view('template/modal-footer');
    }
    
    public function floorplantechnical() {
        $this->ChartModel->deleteOld();
        $this->load->view('pages/floorplan-technical', array('orgchart' => $this->orgchart, 'fr' => $this->fr));
        $this->load->view('template/modal-footer');
    }
    
    public function floorplanord() {
        $this->ChartModel->deleteOld();
        $this->load->view('pages/floorplan-ord', array('orgchart' => $this->orgchart, 'fr' => $this->fr));
        $this->load->view('template/modal-footer');
    }

    public function floorplanfad() {
        $this->ChartModel->deleteOld();
        $this->load->view('pages/floorplan-fad', array('orgchart' => $this->orgchart, 'fr' => $this->fr));
        $this->load->view('template/modal-footer');
    }

    public function floorplanrecords() {
        $this->ChartModel->deleteOld();
        $this->load->view('pages/floorplan-records', array('orgchart' => $this->orgchart, 'fr' => $this->fr));
        $this->load->view('template/modal-footer');
    }

    public function landscapechartv2() {
        $data['orgchart'] = $this->ChartModel->getOrgChart();
        $this->load->view('pages/landscape-chart-v2', $data);
    }

    public function floorplanlist() {
        $this->ChartModel->deleteOld();
        $this->load->view('pages/floorplan-list', array('orgchart' => $this->orgchart, 'fr' => $this->fr));
    }

    public function floorplanchief() {
        $this->ChartModel->deleteOld();
        $this->load->view('pages/floorplan-chief', array('orgchart' => $this->orgchart, 'fr' => $this->fr));
    }

    public function frlogs() {
        $this->load->view('pages/frlogs', array('fr' => $this->fr));
    }

    public function frdelete(){
        $this->ChartModel->delete_frdata();
        // $this->session->set_flashdata('post_delete', $data['name']. ' is successfully <b>DELETED.</b>');
        redirect(base_url().'floorplan-pismu');
    }

    public function landscapechart() {
        $data['orgchart'] = $this->ChartModel->getOrgChart();
        $this->load->view('pages/landscape-chart', $data);
    }

    public function edit($default = null){
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('embid', 'embid', 'required');
        
        $data['orgchart'] = $this->ChartModel->getDataEdit($default);
        $data['orgchartget'] = $this->ChartModel->getOrgChart();
        
        $data['id'] = $data['orgchart']['id'];
        $data['name'] = $data['orgchart']['name'];
        $data['division'] = $data['orgchart']['division'];
        $data['unit'] = $data['orgchart']['unit'];
        $data['embid'] = $data['orgchart']['embid'];
        $data['section'] = $data['orgchart']['section'];
        $data['role'] = $data['orgchart']['role'];
        $data['enmo'] = $data['orgchart']['enmo'];
        $data['emptitle'] = $data['orgchart']['emptitle'];
        $data['empstatus'] = $data['orgchart']['empstatus'];
        $data['img'] = $data['orgchart']['img'];


        if($data['orgchart']){
            if ($this->form_validation->run() == FALSE) {
                if (!file_exists(APPPATH.'views/pages/edit.php')){
                    show_404();
                }
    
                $this->load->view('pages/edit', $data);
            } else {
                $image_tmp = $_FILES['img']['tmp_name'];

                $this->ChartModel->update_swap();
                $this->ChartModel->update_data($image_tmp);
                $this->ChartModel->update_swaptwo();
                
                $this->session->set_flashdata('post_edit', $data['name']. ' is successfully <b>EDITED.</b>');
                
                redirect(base_url().'landscape-chart');
            }
        }else{
            show_404();
        }
    }

    public function delete($default = null){
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('embid', 'embid', 'required');
        
        $data['orgchart'] = $this->ChartModel->getDataEdit($default);
        
        $data['id'] = $data['orgchart']['id'];
        $data['name'] = $data['orgchart']['name'];
        $data['division'] = $data['orgchart']['division'];
        $data['unit'] = $data['orgchart']['unit'];
        $data['embid'] = $data['orgchart']['embid'];
        $data['section'] = $data['orgchart']['section'];
        $data['role'] = $data['orgchart']['role'];
        $data['enmo'] = $data['orgchart']['enmo'];
        $data['empstatus'] = $data['orgchart']['empstatus'];
        $data['showhide'] = $data['orgchart']['showhide'];


        if($data['orgchart']){
            if ($this->form_validation->run() == FALSE) {
                if (!file_exists(APPPATH.'views/pages/delete.php')){ show_404(); }
                $this->load->view('pages/delete', $data);
            } else {
                $this->ChartModel->delete_data();
                $this->session->set_flashdata('post_delete', $data['name']. ' is successfully <b>DELETED.</b>');
                redirect(base_url().'landscape-chart');
            }
        }else{
            show_404();
        }
    }

    public function control(){
        if(!file_exists(APPPATH.'views/pages/control.php')){ show_404(); }
        $data['orgchart'] = $this->ChartModel->getOrgChart();
        $this->load->view('pages/control', $data);
    }

    public function history(){
        if(!file_exists(APPPATH.'views/pages/history.php')){ show_404(); }
        $data['orgcharthis'] = $this->ChartModel->getOrgChartHistory();
        $this->load->view('pages/history', $data);
    }

    public function editblock($default = null){
        $name = $this->input->post('name');
        $block = $this->input->post('block');
        $id = $this->input->post('id');

        $this->form_validation->set_rules('block', 'block', 'required');

        if ($this->form_validation->run() == FALSE) {
            if (!file_exists(APPPATH.'views/pages/floorplan-pismu.php')){ show_404(); }

            $this->load->view('pages/floorplan-pismu');
        } else {
            $this->db->where('block', $block);
            $query = $this->db->get('orgchart');
        
            $default = $block;
            $data['existblock'] = $this->ChartModel->getSimilarBlock($default);

            if ($query->num_rows() > 0) {
                $data['block'] = $block;
                $data['id'] = $id;
                $data['name'] = $name;
                $data['existid'] = $data['existblock']['id'];
                $this->load->view('pages/promptblock', $data);
            } else {
                $this->ChartModel->update_block();
                $this->session->set_flashdata('post_block', $name. ' is successfully <b>TRANSFERED.</b>');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function insert_secblock() {
        $block = $this->input->post('block');
        $name = $this->input->post('name');
        $id = $this->input->post('id');
        $existid = $this->input->post('existid');

        $submit_value = $this->input->post('submit');

        if ($submit_value == "yes") {
            $this->ChartModel->update_existblock();
            $this->ChartModel->update_block();
            $this->session->set_flashdata('post_block', $name. ' is successfully <b>TRANSFERED.</b>');
            redirect(base_url().'floorplan-pismu');
        }else if ($submit_value == "no"){
            $this->session->set_flashdata('post_blockcancel', $name. '&lsquo;s &nbsp;transfer has been <b>CANCELLED.</b>');
            redirect(base_url().'floorplan-pismu');
        }
    }

    public function insert_secdata() {
        $division = $this->input->post('division');
        $section = $this->input->post('section');
        $unit = $this->input->post('unit');
        $name = $this->input->post('name');
        $role = $this->input->post('role');
        $enmo = $this->input->post('enmo');
        $empstatus = $this->input->post('empstatus');
        $embid = $this->input->post('embid');
        
        $submit_value = $this->input->post('submit');

        if ($submit_value == "yes") {
            $data = array(
                'embid' => $embid,
                'division' => $division,
                'section' => $section,
                'unit' => $unit,
                'name' => $name,
                'role' => $role,
                'enmo' => $enmo,
                'empstatus' => $empstatus,
                'primarywork' => "0"
            );    
        }else if ($submit_value == "no"){
            $data = array(
                'embid' => $embid,
                'division' => $division,
                'section' => $section,
                'unit' => $unit,
                'name' => $name,
                'role' => $role,
                'enmo' => $enmo,
                'empstatus' => $empstatus,
                'primarywork' => "1"
            );
        }

        $datahis = array(
            'name' => $this->input->post('name'),
            'embid' => $this->input->post('embid'),
            'action' => "Added",
            'date' => $this->input->post('date'),
            'remarks' => $this->input->post('remarks')
        );

        $this->db->insert('orgcharthis', $datahis);
        $this->db->insert('orgchart', $data);
        $pageChart = "chart";
        $dataChart['orgchart'] = $this->ChartModel->getOrgChart();
        $this->session->set_flashdata('post_added', $name. ' is successfully <b>ADDED.</b>');
        redirect(base_url().'control');
    }

    public function insert_data() {
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('embid', 'embid', 'required');

        if ($this->form_validation->run() == FALSE) {
            if (!file_exists(APPPATH.'views/pages/edit.php')){ show_404(); }

            $this->load->view('pages/edit');
        } else {
            $division = $this->input->post('division');
            $section = $this->input->post('section');
            $unit = $this->input->post('unit');
            $name = $this->input->post('name');
            $role = $this->input->post('role');
            $enmo = $this->input->post('enmo');
            $empstatus = $this->input->post('employeestatus');
            $embid = $this->input->post('embid');
            $date = $this->input->post('date');
            $remarks = $this->input->post('remarks');

            $this->db->where('name', $name);
            $query = $this->db->get('orgchart');

            if ($query->num_rows() > 0) {
                $data['division'] = $division;
                $data['section'] = $section;
                $data['unit'] = $unit;
                $data['name'] = $name;
                $data['role'] = $role;
                $data['enmo'] = $enmo;
                $data['empstatus'] = $empstatus;
                $data['embid'] = $embid;
                $data['date'] = $date;
                $data['remarks'] = $remarks;

                $this->load->view('pages/promptdouble', $data);
            } else {
                $data = array(
                    'embid' => $embid,
                    'division' => $division,
                    'section' => $section,
                    'unit' => $unit,
                    'name' => $name,
                    'role' => $role,
                    'enmo' => $enmo,
                    'empstatus' => $empstatus
                );
    
                $datahis = array(
                    'name' => $this->input->post('name'),
                    'embid' => $this->input->post('embid'),
                    'action' => "Added",
                    'date' => $date,
                    'remarks' => $remarks
                );
        
                $this->db->insert('orgcharthis', $datahis);
                $this->db->insert('orgchart', $data);
                $this->session->set_flashdata('post_added', $name. ' is successfully <b>ADDED.</b>');
        
                redirect(base_url().'control');
            }
        }
    }
}

