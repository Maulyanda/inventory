<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->library(array('form_validation'));
        date_default_timezone_set('Asia/Jakarta');
		if($this->session->userdata('username')==""){
            redirect('Log');
        }
	}

// Index
public function index()
{
	$data['title'] = 'Sistem Inventory';
	$cyclecount = $this->db->query("SELECT COUNT(*) as cyclecount FROM tb_cyclecount");
	foreach($cyclecount->result() as $cnt){
		$cyc = $cnt->cyclecount;
	}

	$data['title'] = 'Sistem Inventory';
	$outbound = $this->db->query("SELECT COUNT(*) as outbound FROM tb_outbound");
	foreach($outbound->result() as $bnd){
		$out = $bnd->outbound;
	}

	$data['title'] = 'Sistem Inventory';
	$putaway = $this->db->query("SELECT COUNT(*) as putaway FROM tb_putaway");
	foreach($putaway->result() as $awy){
		$put = $awy->putaway;
	}

	$data['title'] = 'Sistem Inventory';
	$receivingkd = $this->db->query("SELECT COUNT(*) as receivingkd FROM tb_receivingkd");
	foreach($receivingkd->result() as $ing){
		$rcv = $ing->receivingkd;
	}

	$data['title'] = 'Sistem Inventory';
	$receivinglocal = $this->db->query("SELECT COUNT(*) as receivinglocal FROM tb_receivinglocal");
	foreach($receivinglocal->result() as $lcl){
		$rci = $lcl->receivinglocal;
	}

	$data['cyclecount'] = $cyc;
	$data['putaway'] = $put;
	$data['outbound'] = $out;
	$data['receivingkd'] = $rcv;
	$data['receivinglocal'] = $rci;
	$data['content'] = 'dashboard2';
	$this->load->view('layouts/main_v',$data);
}
// Index

	public function error()
	{
		$this->load->view('index.html');
	}

// Cycle Count
	public function cyclecount()
	{
	  $data['title'] = 'Data cyclecount | Sistem Inventory';
	  $data['cyclecount'] = $this->db->query("SELECT * FROM tb_cyclecount ORDER BY kd_cyclecount");
	  $data['content'] = 'Staff/cyclecount/cyclecount_v';
	  $this->load->view('layouts/main_v',$data);
	}

	//Edit & Tambah Cycle Count
	public function inc_cyclecount()
	{
	  if (isset($_POST) && !empty($_POST)) {
	          $this->form_validation->set_rules('kd_txt', 'Kode', 'trim|required');
	          $this->form_validation->set_rules('pc_txt', 'Part Number', 'trim|required');
						$this->form_validation->set_rules('loc_txt', 'Location', 'trim|required');
	          $this->form_validation->set_rules('qty_txt', 'Qty', 'trim|required');

	          if ($this->form_validation->run() == FALSE){
	              $this->session->set_flashdata("msg","
	                      <div class='alert alert-warning fade in'>
	                          <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                          <strong>Gagal !</strong> Isi Data dengan Lengkap !
	                      </div>");
	              header('location:'.base_url().'Staff/cyclecount');
	          }else{
	            $act = $this->input->post('act');
	            $kd = $this->input->post('kd_txt');
	            $pc = $this->input->post('pc_txt');
	            $loc = $this->input->post('loc_txt');
	            $qty = $this->input->post('qty_txt');

	            if($act=='edit'){
	              $edit = $this->db->query("UPDATE tb_cyclecount SET part_case='$pc', location='$loc', qty='$qty' WHERE kd_cyclecount='$kd' ");
	              if($edit){
	                $this->session->set_flashdata("msg","
	                        <div class='alert alert-success fade in'>
	                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                            <strong>Success !</strong> Berhasil Mengubah Data Cycle Count!
	                        </div>");
	              }else{
	                $this->session->set_flashdata("msg","
	                        <div class='alert alert-warning fade in'>
	                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                            <strong>Failed !</strong> Terjadi Kesalahan mengubah data Cycle Count!
	                        </div>");
	              }
	                header('location:'.base_url().'Staff/cyclecount');
	            }else{
	              $add = $this->db->query("INSERT INTO tb_cyclecount (kd_cyclecount,part_case,location,qty) VALUES ('$kd','$pc','$loc','$qty') ");
	              if($add){
	                $this->session->set_flashdata("msg","
	                        <div class='alert alert-success fade in'>
	                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                            <strong>Success !</strong> Berhasil Menambah Data Cycle Count !
	                        </div>");
	              }else{
	                $this->session->set_flashdata("msg","
	                        <div class='alert alert-warning fade in'>
	                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                            <strong>Failed !</strong> Terjadi Kesalahan menambah data Cycle Count!
	                        </div>");
	              }
	                header('location:'.base_url().'Staff/cyclecount');
	            }
	          }
	      }else{
	        $this->error();
	      }
	}

	//Hapus cyclecount
	public function hapus_cyclecount($kd)
	{
	  if (isset($kd) && !empty($kd)) {
	    $hapus = $this->db->query("DELETE FROM tb_cyclecount WHERE kd_cyclecount='$kd' ");
	    if($hapus){
	      $this->session->set_flashdata("msg","<div class='alert alert-success fade in'>
	        <a href='#' class='close' data-dismiss='alert'>&times;</a>
	        <strong>Success !</strong> Berhasi mengahapus data Cycle Count!
	      </div>");
	    }else{
	      $this->session->set_flashdata("msg","<div class='alert alert-danger fade in'>
	        <a href='#' class='close' data-dismiss='alert'>&times;</a>
	        <strong>Failed !</strong> Terjadi Kesalahan penghapusan data Cycle Count!
	      </div>");
	    }

	    header('location:'.base_url().'Staff/cyclecount');
	  }else $this->error();
	}
// Cycle Count

// Outbound
	public function outbound()
	{
		$data['title'] = 'Data Outbound | Sistem Inventory';
		$data['outbound'] = $this->db->query("SELECT * FROM tb_outbound ORDER BY kd_outbound");
		//$data['count_barang'] = $this->db->query("SELECT * FROM tb_barang ORDER BY kd_barang DESC LIMIT 1");
		$data['content'] = 'Staff/outbound/outbound_v';
		$this->load->view('layouts/main_v',$data);
	}

	//Edit & Tambah Outbound
	public function inc_outbound()
	{
		if (isset($_POST) && !empty($_POST)) {
						$this->form_validation->set_rules('kd_txt', 'Kode', 'trim|required');
						$this->form_validation->set_rules('pn_txt', 'Part Number', 'trim|required');
						$this->form_validation->set_rules('qty_txt', 'Qty');

						if ($this->form_validation->run() == FALSE){
								$this->session->set_flashdata("msg","
												<div class='alert alert-warning fade in'>
														<a href='#' class='close' data-dismiss='alert'>&times;</a>
														<strong>Gagal !</strong> Isi Data dengan Lengkap !
												</div>");
								header('location:'.base_url().'Staff/outbound');
						}else{
							$act = $this->input->post('act');
							$kd = $this->input->post('kd_txt');
							$pn = $this->input->post('pn_txt');
							$qty = $this->input->post('qty_txt');

							if($act=='edit'){
								$edit = $this->db->query("UPDATE tb_outbound SET part_number='$pn', qty='$qty' WHERE kd_outbound='$kd' ");
								if($edit){
									$this->session->set_flashdata("msg","
													<div class='alert alert-success fade in'>
															<a href='#' class='close' data-dismiss='alert'>&times;</a>
															<strong>Success !</strong> Berhasil Mengubah Data Outbound !
													</div>");
								}else{
									$this->session->set_flashdata("msg","
													<div class='alert alert-warning fade in'>
															<a href='#' class='close' data-dismiss='alert'>&times;</a>
															<strong>Failed !</strong> Terjadi Kesalahan mengubah data Outbound!
													</div>");
								}
									header('location:'.base_url().'Staff/outbound');
							}else{
								$add = $this->db->query("INSERT INTO tb_outbound (kd_outbound,part_number,qty) VALUES ('$kd','$pn','$qty') ");
								if($add){
									$this->session->set_flashdata("msg","
													<div class='alert alert-success fade in'>
															<a href='#' class='close' data-dismiss='alert'>&times;</a>
															<strong>Success !</strong> Berhasil Menambah Data Outbound !
													</div>");
								}else{
									$this->session->set_flashdata("msg","
													<div class='alert alert-warning fade in'>
															<a href='#' class='close' data-dismiss='alert'>&times;</a>
															<strong>Failed !</strong> Terjadi Kesalahan menambah data Outbound!
													</div>");
								}
									header('location:'.base_url().'Staff/outbound');
							}
						}
				}else{
					$this->error();
				}
	}

	//Hapus Outbound
	public function hapus_outbound($kd)
	{
		if (isset($kd) && !empty($kd)) {
			$hapus = $this->db->query("DELETE FROM tb_outbound WHERE kd_outbound='$kd' ");
			if($hapus){
				$this->session->set_flashdata("msg","<div class='alert alert-success fade in'>
					<a href='#' class='close' data-dismiss='alert'>&times;</a>
					<strong>Success !</strong> Berhasi mengahapus data Outbound!
				</div>");
			}else{
				$this->session->set_flashdata("msg","<div class='alert alert-danger fade in'>
					<a href='#' class='close' data-dismiss='alert'>&times;</a>
					<strong>Failed !</strong> Terjadi Kesalahan penghapusan data Outbound!
				</div>");
			}

			header('location:'.base_url().'Staff/outbound');
		}else $this->error();
	}
// Outbound

// Putaway
	public function putaway()
	{
	  $data['title'] = 'Data Putaway | Sistem Inventory';
	  $data['putaway'] = $this->db->query("SELECT * FROM tb_putaway ORDER BY kd_putaway");
	  $data['content'] = 'Staff/putaway/putaway_v';
	  $this->load->view('layouts/main_v',$data);
	}

	//Edit & Tambah Putaway
	public function inc_putaway()
	{
	  if (isset($_POST) && !empty($_POST)) {
	          $this->form_validation->set_rules('kd_txt', 'Kode', 'trim|required');
	          $this->form_validation->set_rules('pc_txt', 'Part Case', 'trim|required');
	          $this->form_validation->set_rules('old_txt', 'Old Location', 'trim|required');
            $this->form_validation->set_rules('neloc_txt', 'New Location', 'trim|required');
            $this->form_validation->set_rules('qty_txt', 'QTY Location');

	          if ($this->form_validation->run() == FALSE){
	              $this->session->set_flashdata("msg","
	                      <div class='alert alert-warning fade in'>
	                          <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                          <strong>Gagal !</strong> Isi Data dengan Lengkap !
	                      </div>");
	              header('location:'.base_url().'Staff/putaway');
	          }else{
	            $act = $this->input->post('act');
	            $kd = $this->input->post('kd_txt');
	            $pc = $this->input->post('pc_txt');
	            $old = $this->input->post('old_txt');
              $neloc = $this->input->post('neloc_txt');
              $qty = $this->input->post('qty_txt');

	            if($act=='edit'){
	              $edit = $this->db->query("UPDATE tb_putaway SET part_case='$pc', old_loc='$old', new_loc='$neloc', qty='$qty' WHERE kd_putaway='$kd' ");
	              if($edit){
	                $this->session->set_flashdata("msg","
	                        <div class='alert alert-success fade in'>
	                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                            <strong>Success !</strong> Berhasil Mengubah Data Putaway !
	                        </div>");
	              }else{
	                $this->session->set_flashdata("msg","
	                        <div class='alert alert-warning fade in'>
	                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                            <strong>Failed !</strong> Terjadi Kesalahan mengubah data Putaway!
	                        </div>");
	              }
	                header('location:'.base_url().'Staff/putaway');
	            }else{
	              $add = $this->db->query("INSERT INTO tb_putaway (kd_putaway,part_case,old_loc,new_loc,qty) VALUES ('$kd','$pc','$old','$neloc','$qty') ");
	              if($add){
	                $this->session->set_flashdata("msg","
	                        <div class='alert alert-success fade in'>
	                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                            <strong>Success !</strong> Berhasil Menambah Data Putaway !
	                        </div>");
	              }else{
	                $this->session->set_flashdata("msg","
	                        <div class='alert alert-warning fade in'>
	                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                            <strong>Failed !</strong> Terjadi Kesalahan menambah data Putaway!
	                        </div>");
	              }
	                header('location:'.base_url().'Staff/putaway');
	            }
	          }
	      }else{
	        $this->error();
	      }
	}

	//Hapus Putaway
	public function hapus_putaway($kd)
	{
	  if (isset($kd) && !empty($kd)) {
	    $hapus = $this->db->query("DELETE FROM tb_putaway WHERE kd_putaway='$kd' ");
	    if($hapus){
	      $this->session->set_flashdata("msg","<div class='alert alert-success fade in'>
	        <a href='#' class='close' data-dismiss='alert'>&times;</a>
	        <strong>Success !</strong> Berhasi mengahapus data Putaway!
	      </div>");
	    }else{
	      $this->session->set_flashdata("msg","<div class='alert alert-danger fade in'>
	        <a href='#' class='close' data-dismiss='alert'>&times;</a>
	        <strong>Failed !</strong> Terjadi Kesalahan penghapusan data Putaway!
	      </div>");
	    }

	    header('location:'.base_url().'Staff/putaway');
	  }else $this->error();
	}
// Putaway

// Receiving KD
	public function receivingkd()
	{
	  $data['title'] = 'Data Receiving KD | Sistem Inventory';
	  $data['receivingkd'] = $this->db->query("SELECT * FROM tb_receivingkd ORDER BY kd_receivingkd");
	  //$data['count_barang'] = $this->db->query("SELECT * FROM tb_barang ORDER BY kd_barang DESC LIMIT 1");
	  $data['content'] = 'Staff/receivingkd/receivingkd_v';
	  $this->load->view('layouts/main_v',$data);
	}

	//Edit & Tambah receivingkd
	public function inc_receivingkd()
	{
	  if (isset($_POST) && !empty($_POST)) {
	          $this->form_validation->set_rules('kd_txt', 'Kode', 'trim|required');
	          $this->form_validation->set_rules('cn_txt', 'Case No', 'trim|required');
	          $this->form_validation->set_rules('loc_txt', 'Location', 'trim|required');

	          if ($this->form_validation->run() == FALSE){
	              $this->session->set_flashdata("msg","
	                      <div class='alert alert-warning fade in'>
	                          <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                          <strong>Gagal !</strong> Isi Data dengan Lengkap !
	                      </div>");
	              header('location:'.base_url().'Staff/receivingkd');
	          }else{
	            $act = $this->input->post('act');
	            $kd = $this->input->post('kd_txt');
	            $cn = $this->input->post('cn_txt');
	            $loc = $this->input->post('loc_txt');

	            if($act=='edit'){
	              $edit = $this->db->query("UPDATE tb_receivingkd SET case_no='$cn', location='$loc' WHERE kd_receivingkd='$kd' ");
	              if($edit){
	                $this->session->set_flashdata("msg","
	                        <div class='alert alert-success fade in'>
	                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                            <strong>Success !</strong> Berhasil Mengubah Data Receiving KD !
	                        </div>");
	              }else{
	                $this->session->set_flashdata("msg","
	                        <div class='alert alert-warning fade in'>
	                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                            <strong>Failed !</strong> Terjadi Kesalahan mengubah data Receiving KD!
	                        </div>");
	              }
	                header('location:'.base_url().'Staff/receivingkd');
	            }else{
	              $add = $this->db->query("INSERT INTO tb_receivingkd (kd_receivingkd,case_no,location) VALUES ('$kd','$cn','$loc') ");
	              if($add){
	                $this->session->set_flashdata("msg","
	                        <div class='alert alert-success fade in'>
	                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                            <strong>Success !</strong> Berhasil Menambah Data Receiving KD !
	                        </div>");
	              }else{
	                $this->session->set_flashdata("msg","
	                        <div class='alert alert-warning fade in'>
	                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                            <strong>Failed !</strong> Terjadi Kesalahan menambah data Receiving KD!
	                        </div>");
	              }
	                header('location:'.base_url().'Staff/receivingkd');
	            }
	          }
	      }else{
	        $this->error();
	      }
	}

	//Hapus receivingkd
	public function hapus_receivingkd($kd)
	{
	  if (isset($kd) && !empty($kd)) {
	    $hapus = $this->db->query("DELETE FROM tb_receivingkd WHERE kd_receivingkd='$kd' ");
	    if($hapus){
	      $this->session->set_flashdata("msg","<div class='alert alert-success fade in'>
	        <a href='#' class='close' data-dismiss='alert'>&times;</a>
	        <strong>Success !</strong> Berhasi mengahapus data Receiving KD!
	      </div>");
	    }else{
	      $this->session->set_flashdata("msg","<div class='alert alert-danger fade in'>
	        <a href='#' class='close' data-dismiss='alert'>&times;</a>
	        <strong>Failed !</strong> Terjadi Kesalahan penghapusan data Receiving KD!
	      </div>");
	    }

	    header('location:'.base_url().'Staff/receivingkd');
	  }else $this->error();
	}
// Receiving KD

// Receiving Local
	public function receivinglocal()
	{
	  $data['title'] = 'Data Receiving Local | Sistem Inventory';
	  $data['receivinglocal'] = $this->db->query("SELECT * FROM tb_receivinglocal ORDER BY kd_receivinglocal");
	  $data['content'] = 'Staff/receivinglocal/receivinglocal_v';
	  $this->load->view('layouts/main_v',$data);
	}

	//Edit & Tambah receivinglocal
	public function inc_receivinglocal()
	{
	  if (isset($_POST) && !empty($_POST)) {
	          $this->form_validation->set_rules('kd_txt', 'Kode', 'trim|required');
	          $this->form_validation->set_rules('pn_txt', 'Case No', 'trim|required');

	          if ($this->form_validation->run() == FALSE){
	              $this->session->set_flashdata("msg","
	                      <div class='alert alert-warning fade in'>
	                          <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                          <strong>Gagal !</strong> Isi Data dengan Lengkap !
	                      </div>");
	              header('location:'.base_url().'Staff/receivinglocal');
	          }else{
	            $act = $this->input->post('act');
	            $kd = $this->input->post('kd_txt');
	            $pn= $this->input->post('pn_txt');

	            if($act=='edit'){
	              $edit = $this->db->query("UPDATE tb_receivinglocal SET part_number='$pn' WHERE kd_receivinglocal='$kd' ");
	              if($edit){
	                $this->session->set_flashdata("msg","
	                        <div class='alert alert-success fade in'>
	                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                            <strong>Success !</strong> Berhasil Mengubah Data Receiving Local !
	                        </div>");
	              }else{
	                $this->session->set_flashdata("msg","
	                        <div class='alert alert-warning fade in'>
	                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                            <strong>Failed !</strong> Terjadi Kesalahan mengubah data Receiving Local!
	                        </div>");
	              }
	                header('location:'.base_url().'Staff/receivinglocal');
	            }else{
	              $add = $this->db->query("INSERT INTO tb_receivinglocal (kd_receivinglocal,part_number) VALUES ('$kd','$pn') ");
	              if($add){
	                $this->session->set_flashdata("msg","
	                        <div class='alert alert-success fade in'>
	                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                            <strong>Success !</strong> Berhasil Menambah Data Receiving Local !
	                        </div>");
	              }else{
	                $this->session->set_flashdata("msg","
	                        <div class='alert alert-warning fade in'>
	                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                            <strong>Failed !</strong> Terjadi Kesalahan menambah data Receiving Local!
	                        </div>");
	              }
	                header('location:'.base_url().'Staff/receivinglocal');
	            }
	          }
	      }else{
	        $this->error();
	      }
	}

	//Hapus receivinglocal
	public function hapus_receivinglocal($kd)
	{
	  if (isset($kd) && !empty($kd)) {
	    $hapus = $this->db->query("DELETE FROM tb_receivinglocal WHERE kd_receivinglocal='$kd' ");
	    if($hapus){
	      $this->session->set_flashdata("msg","<div class='alert alert-success fade in'>
	        <a href='#' class='close' data-dismiss='alert'>&times;</a>
	        <strong>Success !</strong> Berhasi mengahapus data Receiving Local!
	      </div>");
	    }else{
	      $this->session->set_flashdata("msg","<div class='alert alert-danger fade in'>
	        <a href='#' class='close' data-dismiss='alert'>&times;</a>
	        <strong>Failed !</strong> Terjadi Kesalahan penghapusan data Receiving Local!
	      </div>");
	    }

	    header('location:'.base_url().'Staff/receivinglocal');
	  }else $this->error();
	}
// Receiving Local
}
