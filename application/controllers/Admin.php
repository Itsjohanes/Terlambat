<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller Admin
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Johannes Alexander Putra <johannesap@upi.edu>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Admin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data['title'] = "Dashboard";
    //mendapatkan jumlah user dari database
    $data['jumlahAdmin'] = $this->db->get_where('tb_akun', ['aktif' => 1])->num_rows();
    if ($this->session->userdata('email') == '') {
      redirect('Auth');
    } else {
      $this->load->view('admin/header', $data);
      $this->load->view('admin/sidebar');
      $this->load->view('admin/dashboard');
      $this->load->view('admin/footer');
    }
  }

  public function siswa()
  {
    $data['title'] = "Data Siswa";
    //mendapatkan data siswa dari database
    $data['siswa'] = $this->db->get('tb_siswa')->result_array();
    if ($this->session->userdata('email') == '') {
      redirect('Auth');
    } else {
      $this->load->view('admin/header', $data);
      $this->load->view('admin/sidebar');
      $this->load->view('admin/siswa');
      $this->load->view('admin/footer');
    }
  }
  public function tambahSiswa()
  {
    $data['title'] = "Tambah Siswa";
    if ($this->session->userdata('email') == '') {
      redirect('Auth');
    } else {
      //mendapatkan data dari form
      $nama = $this->input->post('nama');
      $kelas = $this->input->post('kelas');
      $data = [
        'nama_siswa' => $nama,
        'kelas_siswa' => $kelas
      ];
      //masukan ke tb_siswa
      $this->db->insert('tb_siswa', $data);
      //set flashdata category success
      $this->session->set_flashdata('category_success', 'Data berhasil ditambahkan');
      redirect('Admin/siswa');
    }
  }
}


/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */