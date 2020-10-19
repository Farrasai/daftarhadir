<?php

class AbsenPages extends CI_Controller
{
  public function index($slug)
  {
    $data['pages'] = $this->M_page_absensi->getPageById($slug);

    if ($data['pages']) {
      $this->load->view('v_absen_pages', $data);
    } else {
      $this->load->view('v_404');
    }
  }

  public function absensi()
  {
    $this->form_validation->set_rules('nama', 'nama', 'required', array('required' => 'Form %s harus disi'));
    $this->form_validation->set_rules('email', 'email', 'required', array('required' => 'Form %s harus disi'));
    $this->form_validation->set_rules('nip', 'nip', 'required|integer|min_length[1]|max_length[18]', array(
      'required' => 'Form %s harus disi',
      'integer' => 'Nip harus berupa angka',
      'min_length' => 'Masukan NIP anda dengan benar',
      'max_length' => 'Masukan NIP anda dengan benar'
    ));
    $this->form_validation->set_rules('npwp', 'npwp', 'required', array('required' => 'Form %s harus disi'));
    $this->form_validation->set_rules('jabatan', 'jabatan', 'required', array('required' => 'Form %s harus disi'));
    $this->form_validation->set_rules('instansi', 'instansi', 'required', array('required' => 'Form %s harus disi'));
    $this->form_validation->set_rules('unit_kerja', 'unit kerja', 'required', array('required' => 'Form %s harus disi'));
    $this->form_validation->set_rules('alamat_unit_kerja', 'alamat unit kerja', 'required', array('required' => 'Form %s harus disi'));
    $this->form_validation->set_rules('pangkat', 'pangkat', 'required', array('required' => 'Form %s harus disi'));
    $this->form_validation->set_rules('tempat_lahir', 'tempat_lahir', 'required', array('required' => 'Form %s harus disi'));
    $this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahir', 'required', array('required' => 'Form %s harus disi'));
    $this->form_validation->set_rules('alamat_rumah', 'alamat_rumah', 'required', array('required' => 'Form %s harus disi'));
    $this->form_validation->set_rules('telepon_instansi', 'telepon_instansi', 'required', array('required' => 'Form %s harus disi'));
    $this->form_validation->set_rules('fax_instansi', 'fax_instansi', 'required', array('required' => 'Form %s harus disi'));
    $this->form_validation->set_rules('nomor_hp', 'nomor_hp', 'required', array('required' => 'Form %s harus disi'));
    $this->form_validation->set_rules('norek', 'norek', 'required', array('required' => 'Form %s harus disi'));
    $this->form_validation->set_rules('bank', 'bank', 'required', array('required' => 'Form %s harus disi'));
    $this->form_validation->set_rules('cabang', 'cabang', 'required', array('required' => 'Form %s harus disi'));
    $this->form_validation->set_rules('nama_rek', 'nama_rek', 'required', array('required' => 'Form %s harus disi'));
    $response = array();
    if ($this->form_validation->run() == false) {
      $response['status'] = 'error';
      $response['nama_error'] = form_error('nama');
      $response['email_error'] = form_error('email');
      $response['nip_error'] = form_error('nip');
      $response['npwp_error'] = form_error('npwp');
      $response['jabatan_error'] = form_error('jabatan');
      $response['instansi_error'] = form_error('instansi');
      $response['unit_kerja_error'] = form_error('unit_kerja');
      $response['alamat_unit_kerja_error'] = form_error('alamat_unit_kerja');
      $response['pangkat_error'] = form_error('pangkat');
      $response['tempat_lahir_error'] = form_error('tempat_lahir');
      $response['tanggal_lahir_error'] = form_error('tanggal_lahir');
      $response['alamat_rumah_error'] = form_error('alamat_rumah');
      $response['telepon_instansi_error'] = form_error('telepon_instansi');
      $response['fax_instansi_error'] = form_error('fax_instansi');
      $response['nomor_hp_error'] = form_error('nomor_hp');
      $response['norek_error'] = form_error('norek');
      $response['bank_error'] = form_error('bank');
      $response['cabang_error'] = form_error('cabang');
      $response['nama_rek_error'] = form_error('nama_rek');
      $response['class'] = 'is-invalid';
      echo json_encode($response);
    } else {

      $imagedata = base64_decode($_POST['img_data']);
      $filename = md5(date("dmYhisA"));
      //Location to where you want to created sign image
      $file_name = './assets/images/' . $filename . '.png';
      file_put_contents($file_name, $imagedata);
      $filenameReplace = str_replace("./", "", $file_name);
      $result['nama'] = $this->input->post('nama');
      $result['email'] = $this->input->post('email');
      $result['nip'] = $this->input->post('nip');
      $result['npwp'] = $this->input->post('npwp');
      $result['jabatan'] = $this->input->post('jabatan');
      $result['instansi'] = $this->input->post('instansi');
      $result['unit_kerja'] = $this->input->post('unit_kerja');
      $result['alamat_unit_kerja'] = $this->input->post('alamat_unit_kerja');
      $result['pangkat'] = $this->input->post('pangkat');
      $result['tempat_lahir'] = $this->input->post('tempat_lahir');
      $result['tanggal_lahir'] = $this->input->post('tanggal_lahir');
      $result['alamat_rumah'] = $this->input->post('alamat_rumah');
      $result['telepon_instansi'] = $this->input->post('telepon_instansi');
      $result['fax_instansi'] = $this->input->post('fax_instansi');
      $result['nomor_hp'] = $this->input->post('nomor_hp');
      $result['norek'] = $this->input->post('norek');
      $result['bank'] = $this->input->post('bank');
      $result['cabang'] = $this->input->post('cabang');
      $result['nama_rek'] = $this->input->post('nama_rek');
      $result['tanda_tangan'] = $filenameReplace;
      $result['kegiatan_id'] = $this->input->post('id_kegiatan');
      $addKehadiran = $this->M_absen->input_data($result, 'peserta');

      $response['status'] = 'success';
      $response['redirect'] = site_url('AbsenPages/success_absen');
      echo json_encode($response);
    }
  }

  public function success_absen()
  {
    $this->load->view('v_success_absen_page');
  }
}
