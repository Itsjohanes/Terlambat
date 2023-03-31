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
    $this->load->library('cetak_pdf');
  }

  public function index()
  {
    $data['title'] = "Dashboard";
    $data['tanggal'] = date('Y-m-d');
    $data['jumlahSiswa'] = $this->db->get('tb_siswa')->num_rows();
    //mendapatkan jumlahTerlambat hari ini
    $data['jumlahTerlambat'] = $this->db->get_where('tb_terlambat', ['date' => date('Y-m-d')])->num_rows();

    //mendapatkan jumlah user dari database
    $data['jumlahAdmin'] = $this->db->get_where('tb_akun', ['aktif' => 1])->num_rows();
    //mendapatkan siswa yang terlambat 
    $this->db->select('*');
    $this->db->from('tb_siswa');
    $this->db->join('tb_terlambat', 'tb_siswa.id_siswa = tb_terlambat.id_siswa');
    $data['terlambat'] = $this->db->get()->result_array();
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
  public function hapusSiswa($id)
  {
    if ($this->session->userdata('email') == '') {
      redirect('Auth');
    } else {
      $this->db->where('id_siswa', $id);
      $this->db->delete('tb_siswa');
      //set flashdata category success
      $this->session->set_flashdata('category_success', 'Data berhasil dihapus');
      redirect('Admin/siswa');
    }
  }
  public function editSiswa($id)
  {
    $data['title'] = "Edit Siswa";
    $data['siswa'] = $this->db->get_where('tb_siswa', ['id_siswa' => $id])->row_array();
    if ($this->session->userdata('email') == '') {
      redirect('Auth');
    } else {
      $this->load->view('admin/header', $data);
      $this->load->view('admin/sidebar');
      $this->load->view('admin/editsiswa');
      $this->load->view('admin/footer');
    }
  }
  public function runEditSiswa()
  {
    if ($this->session->userdata('email') == '') {
      redirect('Auth');
    } else {
      $id = $this->input->post('id_siswa');
      $nama = $this->input->post('nama_siswa');
      $kelas = $this->input->post('kelas_siswa');
      $data = [
        'nama_siswa' => $nama,
        'kelas_siswa' => $kelas
      ];
      $this->db->where('id_siswa', $id);
      $this->db->update('tb_siswa', $data);
      //set flashdata category success
      $this->session->set_flashdata('category_success', 'Data berhasil diubah');
      redirect('Admin/siswa');
    }
  }
  public  function terlambat()
  {
    $data['title'] = "Mencatat Keterlambatan";
    //mendapatkan data siswa dari database
    $data['siswa'] = $this->db->get('tb_siswa')->result_array();

    ///mendapatkan data terlambat dari database dengan menjoinkan table siswa dengan table terlambat
    $this->db->select('*');
    $this->db->from('tb_siswa');
    $this->db->join('tb_terlambat', 'tb_siswa.id_siswa = tb_terlambat.id_siswa');
    $data['terlambat'] = $this->db->get()->result_array();

    if ($this->session->userdata('email') == '') {
      redirect('Auth');
    } else {
      $this->load->view('admin/header', $data);
      $this->load->view('admin/sidebar');
      $this->load->view('admin/terlambat');
      $this->load->view('admin/footer');
    }
  }
  public function tambahTerlambat($id)
  {
    //mendapatkan tanggal hari ini
    $tanggal = date("Y-m-d");
    if ($this->session->userdata('email') == '') {
      redirect('Auth');
    } else {
      $id_siswa = $id;
      $data = [
        'id_siswa' => $id_siswa,
        'date' => $tanggal
      ];
      //masukan ke tb_siswa
      $this->db->insert('tb_terlambat', $data);
      //set flashdata category success
      $this->session->set_flashdata('category_success', 'Data berhasil ditambahkan');
      redirect('Admin/terlambat');
    }
  }
  public function hapusTerlambat($id)
  {
    if ($this->session->userdata('email') == '') {
      redirect('Auth');
    } else {
      $this->db->where('id_terlambat', $id);
      $this->db->delete('tb_terlambat');
      //set flashdata category success
      $this->session->set_flashdata('category_success', 'Data berhasil dihapus');
      redirect('Admin/terlambat');
    }
  }
  public function laporan()
  {
    $data['title'] = "Cetak Laporan";
    if ($this->session->userdata('email') == '') {
      redirect('Auth');
    } else {
      $this->load->view('admin/header', $data);
      $this->load->view('admin/sidebar');
      $this->load->view('admin/laporan');
      $this->load->view('admin/footer');
    }
  }
  public function cetakLaporan()
  {
    if ($this->session->userdata('email') == '') {
      redirect('Auth');
    } else {
      $date = $this->input->post('date');
      $judul = "Daftar Keterlambatan Siswa SMKN 1 CIMAHI " . $date;
      $pdf = new FPDF('P', 'mm', 'Letter');

      $pdf->AddPage();

      $pdf->SetFont('Arial', 'B', 16);
      $pdf->Cell(0, 7, $judul, 0, 1, 'C');
      $pdf->Cell(10, 7, '', 0, 1);
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->Cell(8, 6, 'No', 1, 0, 'C');
      $pdf->Cell(100, 6, 'Nama', 1, 0, 'C');
      $pdf->Cell(50, 6, 'Kelas', 1, 1, 'C');
      $pdf->SetFont('Arial', '', 10);
      $this->db->select('*');
      $this->db->from('tb_siswa');
      $this->db->join('tb_terlambat', 'tb_siswa.id_siswa = tb_terlambat.id_siswa');
      $keterlambatan = $this->db->get()->result();
      $no = 1;
      foreach ($keterlambatan as $data) {
        $pdf->Cell(8, 6, $no, 1, 0);
        $pdf->Cell(100, 6, $data->nama_siswa, 1, 0);
        $pdf->Cell(50, 6, $data->kelas_siswa, 1, 1);
        $no++;
      }
      $pdf->Output();
    }
  }
}


/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */