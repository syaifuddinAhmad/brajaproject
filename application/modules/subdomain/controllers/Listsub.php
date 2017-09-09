<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Listsub extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('members')) {//cek admin ga?
                redirect('login','refresh');
            }
        }
        $this->load->model('Subdomain_model');
        $this->load->model('users/Modeluser');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $isi['aktif']       ='subdomain/listsub';
        $isi['title']       ='Admin Panel';
        $isi['judul_menu']  ='Braja Marketindo';
        $isi['nama_jln']    ='Jl.Lotus Timur, Jakasetia, Jawa Barat';
        $isi['content']     ='content';
        $this->load->view('listsubdomain', $isi);
    }

    public function read($id) 
    {
        $row = $this->Subdomain_model->get_by_id($id);
        if ($row) {
            $data = array(
        'idsubdomain' => $row->idsubdomain,
        'subdomain' => $row->subdomain,
        'username' => $row->username,
        );
            $this->load->view('subdomain/subdomain_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('subdomain'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('subdomain/create_action'),
        'idsubdomain' => set_value('idsubdomain'),
        'subdomain' => set_value('subdomain'),
        'username' => set_value('username'),
    );
        $this->load->view('subdomain/subdomain_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        'subdomain' => $this->input->post('subdomain',TRUE),
        'username' => $this->input->post('username',TRUE),
        );

            $this->Subdomain_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('subdomain'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Subdomain_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('subdomain/update_action'),
        'idsubdomain' => set_value('idsubdomain', $row->idsubdomain),
        'subdomain' => set_value('subdomain', $row->subdomain),
        'username' => set_value('username', $row->username),
        );
            $this->load->view('subdomain/subdomain_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('subdomain'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idsubdomain', TRUE));
        } else {
            $data = array(
        'subdomain' => $this->input->post('subdomain',TRUE),
        'username' => $this->input->post('username',TRUE),
        );

            $this->Subdomain_model->update($this->input->post('idsubdomain', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('subdomain'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Subdomain_model->get_by_id($id);

        if ($row) {
            $this->Subdomain_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('subdomain'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('subdomain'));
        }
    }

    public function _rules() 
    {
    $this->form_validation->set_rules('subdomain', 'subdomain', 'trim|required');
    $this->form_validation->set_rules('username', 'username', 'trim|required');

    $this->form_validation->set_rules('idsubdomain', 'idsubdomain', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Subdomain.php */
/* Location: ./application/controllers/Subdomain.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-09-07 05:52:18 */
/* http://harviacode.com */