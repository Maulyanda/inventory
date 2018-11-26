<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang extends CI_Controller {

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
		$data['content'] = 'dashboard';
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
	  $data['content'] = 'gudang/cyclecount/cyclecount_v';
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
	              header('location:'.base_url().'gudang/cyclecount');
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
	                header('location:'.base_url().'gudang/cyclecount');
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
	                header('location:'.base_url().'gudang/cyclecount');
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

	    header('location:'.base_url().'gudang/cyclecount');
	  }else $this->error();
	}

	//Hapus Semua CycleCount
	public function deleteall_cyclecount($kd)
	{
	$this->db->empty_table('tb_cyclecount');

	header('location:'.base_url().'gudang/cyclecount');
	}

	// Export Cycle Count
	public function excel_cyclecount()
	{
			$select = $this->db->get('tb_cyclecount')->result();
			$this->load->library("PHPExcel");

			$objPHPExcel    = new PHPExcel();
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(17);

			$objPHPExcel->getActiveSheet()->getStyle(1)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle(2)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle(3)->getFont()->setBold(true);

			$header = array(
					'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					),
					'font' => array(
							'bold' => true,
							'color' => array('rgb' => 'FF0000'),
							'name' => 'Verdana'
					)
			);
			$objPHPExcel->getActiveSheet()->getStyle("A1:D2")
							->applyFromArray($header)
							->getFont()->setSize(16);
			$objPHPExcel->getActiveSheet()->mergeCells('A1:D2');
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1', 'Data Cycle Count')
					->setCellValue('A3', 'No.')
					->setCellValue('B3', 'Part Case')
					->setCellValue('C3', 'Location')
					->setCellValue('D3', 'QTY');

			$ex = $objPHPExcel->setActiveSheetIndex(0);
			$no = 1;
			$counter = 4;
			foreach ($select as $row):
					$ex->setCellValue('A'.$counter, $no++);
					$ex->setCellValue('B'.$counter, $row->part_case);
					$ex->setCellValue('C'.$counter, $row->location);
					$ex->setCellValue('D'.$counter, $row->qty);

					$counter = $counter+1;
			endforeach;

			$objPHPExcel->getActiveSheet()->setTitle('Data Cycle Count');

					//mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

					//sesuaikan headernya
					header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
					header("Cache-Control: no-store, no-cache, must-revalidate");
					header("Cache-Control: post-check=0, pre-check=0", false);
					header("Pragma: no-cache");
					header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
					//ubah nama file saat diunduh
					header('Content-Disposition: attachment;filename="data_cyclecount.xlsx"');
					//unduh file
					$objWriter->save("php://output");
	}
// Cycle Count

// Outbound
	public function outbound()
	{
		$data['title'] = 'Data Outbound | Sistem Inventory';
		$data['outbound'] = $this->db->query("SELECT * FROM tb_outbound ORDER BY kd_outbound");
		//$data['count_barang'] = $this->db->query("SELECT * FROM tb_barang ORDER BY kd_barang DESC LIMIT 1");
		$data['content'] = 'gudang/outbound/outbound_v';
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
								header('location:'.base_url().'gudang/outbound');
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
									header('location:'.base_url().'gudang/outbound');
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
									header('location:'.base_url().'gudang/outbound');
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

			header('location:'.base_url().'gudang/outbound');
		}else $this->error();
	}

	// Hapus Semua Outbound
	public function deleteall_outbound($kd)
	{
	$this->db->empty_table('tb_outbound');

	header('location:'.base_url().'gudang/outbound');
	}

	// Export Outbound
	public function excel_outbound()
	{
			$select = $this->db->get('tb_outbound')->result();
			$this->load->library("PHPExcel");

			$objPHPExcel    = new PHPExcel();
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);

			$objPHPExcel->getActiveSheet()->getStyle(1)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle(2)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle(3)->getFont()->setBold(true);

			$header = array(
					'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					),
					'font' => array(
							'bold' => true,
							'color' => array('rgb' => 'FF0000'),
							'name' => 'Verdana'
					)
			);
			$objPHPExcel->getActiveSheet()->getStyle("A1:B2")
							->applyFromArray($header)
							->getFont()->setSize(16);
			$objPHPExcel->getActiveSheet()->mergeCells('A1:B2');
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1', 'Data Outbound')
					->setCellValue('A3', 'No.')
					->setCellValue('B3', 'Part Number');

			$ex = $objPHPExcel->setActiveSheetIndex(0);
			$no = 1;
			$counter = 4;
			foreach ($select as $row):
					$ex->setCellValue('A'.$counter, $no++);
					$ex->setCellValue('B'.$counter, $row->part_number);

					$counter = $counter+1;
			endforeach;

			$objPHPExcel->getActiveSheet()->setTitle('Data Outbound');

					//mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

					//sesuaikan headernya
					header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
					header("Cache-Control: no-store, no-cache, must-revalidate");
					header("Cache-Control: post-check=0, pre-check=0", false);
					header("Pragma: no-cache");
					header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
					//ubah nama file saat diunduh
					header('Content-Disposition: attachment;filename="data_outbound.xlsx"');
					//unduh file
					$objWriter->save("php://output");
	}
// Outbound

// Putaway
	public function putaway()
	{
	  $data['title'] = 'Data Putaway | Sistem Inventory';
	  $data['putaway'] = $this->db->query("SELECT * FROM tb_putaway ORDER BY kd_putaway");
	  $data['content'] = 'gudang/putaway/putaway_v';
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
	              header('location:'.base_url().'gudang/putaway');
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
	                header('location:'.base_url().'gudang/putaway');
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
	                header('location:'.base_url().'gudang/putaway');
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

	    header('location:'.base_url().'gudang/putaway');
	  }else $this->error();
	}

	// Hapus Semua Putaway
	public function deleteall_putaway($kd)
	{
	$this->db->empty_table('tb_putaway');

	header('location:'.base_url().'gudang/putaway');
	}

	// Export Putaway
	public function excel_putaway()
	{
			$select = $this->db->get('tb_putaway')->result();
			$this->load->library("PHPExcel");

			$objPHPExcel    = new PHPExcel();
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
      $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);

			$objPHPExcel->getActiveSheet()->getStyle(1)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle(2)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle(3)->getFont()->setBold(true);

			$header = array(
					'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					),
					'font' => array(
							'bold' => true,
							'color' => array('rgb' => 'FF0000'),
							'name' => 'Verdana'
					)
			);
			$objPHPExcel->getActiveSheet()->getStyle("A1:E2")
							->applyFromArray($header)
							->getFont()->setSize(16);
			$objPHPExcel->getActiveSheet()->mergeCells('A1:E2');
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1', 'Data Putaway')
					->setCellValue('A3', 'No.')
					->setCellValue('B3', 'Part Case')
					->setCellValue('C3', 'Old Location')
          ->setCellValue('D3', 'New Location')
          ->setCellValue('E3', 'QTY');

			$ex = $objPHPExcel->setActiveSheetIndex(0);
			$no = 1;
			$counter = 4;
			foreach ($select as $row):
					$ex->setCellValue('A'.$counter, $no++);
					$ex->setCellValue('B'.$counter, $row->part_case);
					$ex->setCellValue('C'.$counter, $row->old_loc);
          $ex->setCellValue('D'.$counter, $row->new_loc);
					$ex->setCellValue('E'.$counter, $row->qty);

					$counter = $counter+1;
			endforeach;

			$objPHPExcel->getActiveSheet()->setTitle('Data Putaway');

					//mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

					//sesuaikan headernya
					header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
					header("Cache-Control: no-store, no-cache, must-revalidate");
					header("Cache-Control: post-check=0, pre-check=0", false);
					header("Pragma: no-cache");
					header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
					//ubah nama file saat diunduh
					header('Content-Disposition: attachment;filename="data_putaway.xlsx"');
					//unduh file
					$objWriter->save("php://output");
	}
// Putaway

// Receiving KD
	public function receivingkd()
	{
	  $data['title'] = 'Data Receiving KD | Sistem Inventory';
	  $data['receivingkd'] = $this->db->query("SELECT * FROM tb_receivingkd ORDER BY kd_receivingkd");
	  //$data['count_barang'] = $this->db->query("SELECT * FROM tb_barang ORDER BY kd_barang DESC LIMIT 1");
	  $data['content'] = 'gudang/receivingkd/receivingkd_v';
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
	              header('location:'.base_url().'gudang/receivingkd');
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
	                header('location:'.base_url().'gudang/receivingkd');
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
	                header('location:'.base_url().'gudang/receivingkd');
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

	    header('location:'.base_url().'gudang/receivingkd');
	  }else $this->error();
	}

	// Hapus Semua Receiving KD
	public function deleteall_receivingkd($kd)
	{
	$this->db->empty_table('tb_receivingkd');

	header('location:'.base_url().'gudang/receivingkd');
	}

	// Export Receiving KD
	public function excel_receivingkd()
	{
			$select = $this->db->get('tb_receivingkd')->result();
			$this->load->library("PHPExcel");

			$objPHPExcel    = new PHPExcel();
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);

			$objPHPExcel->getActiveSheet()->getStyle(1)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle(2)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle(3)->getFont()->setBold(true);

			$header = array(
					'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					),
					'font' => array(
							'bold' => true,
							'color' => array('rgb' => 'FF0000'),
							'name' => 'Verdana'
					)
			);
			$objPHPExcel->getActiveSheet()->getStyle("A1:C2")
							->applyFromArray($header)
							->getFont()->setSize(16);
			$objPHPExcel->getActiveSheet()->mergeCells('A1:C2');
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1', 'Data Receiving KD')
					->setCellValue('A3', 'No.')
					->setCellValue('B3', 'Case No')
					->setCellValue('C3', 'Location');

			$ex = $objPHPExcel->setActiveSheetIndex(0);
			$no = 1;
			$counter = 4;
			foreach ($select as $row):
					$ex->setCellValue('A'.$counter, $no++);
					$ex->setCellValue('B'.$counter, $row->case_no);
					$ex->setCellValue('C'.$counter, $row->location);

					$counter = $counter+1;
			endforeach;

			$objPHPExcel->getActiveSheet()->setTitle('Data Receiving KD');

					//mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

					//sesuaikan headernya
					header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
					header("Cache-Control: no-store, no-cache, must-revalidate");
					header("Cache-Control: post-check=0, pre-check=0", false);
					header("Pragma: no-cache");
					header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
					//ubah nama file saat diunduh
					header('Content-Disposition: attachment;filename="data_receivingkd.xlsx"');
					//unduh file
					$objWriter->save("php://output");
	}
// Receiving KD

// Receiving Local
	public function receivinglocal()
	{
	  $data['title'] = 'Data Receiving Local | Sistem Inventory';
	  $data['receivinglocal'] = $this->db->query("SELECT * FROM tb_receivinglocal ORDER BY kd_receivinglocal");
	  $data['content'] = 'gudang/receivinglocal/receivinglocal_v';
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
	              header('location:'.base_url().'gudang/receivinglocal');
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
	                header('location:'.base_url().'gudang/receivinglocal');
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
	                header('location:'.base_url().'gudang/receivinglocal');
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

	    header('location:'.base_url().'gudang/receivinglocal');
	  }else $this->error();
	}

	// Hapus Semua Receiving Local
	public function deleteall_receivinglocal($kd)
	{
	$this->db->empty_table('tb_receivinglocal');

	header('location:'.base_url().'gudang/receivinglocal');
	}

	// Export Receiving Local
	public function excel_receivinglocal()
	{
			$select = $this->db->get('tb_receivinglocal')->result();
			$this->load->library("PHPExcel");

			$objPHPExcel    = new PHPExcel();
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);

			$objPHPExcel->getActiveSheet()->getStyle(1)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle(2)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle(3)->getFont()->setBold(true);

			$header = array(
					'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					),
					'font' => array(
							'bold' => true,
							'color' => array('rgb' => 'FF0000'),
							'name' => 'Verdana'
					)
			);
			$objPHPExcel->getActiveSheet()->getStyle("A1:B2")
							->applyFromArray($header)
							->getFont()->setSize(16);
			$objPHPExcel->getActiveSheet()->mergeCells('A1:B2');
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1', 'Data Receiving Local')
					->setCellValue('A3', 'No.')
					->setCellValue('B3', 'Part Number');

			$ex = $objPHPExcel->setActiveSheetIndex(0);
			$no = 1;
			$counter = 4;
			foreach ($select as $row):
					$ex->setCellValue('A'.$counter, $no++);
					$ex->setCellValue('B'.$counter, $row->part_number);

					$counter = $counter+1;
			endforeach;

			$objPHPExcel->getActiveSheet()->setTitle('Data Receiving Local');

					//mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

					//sesuaikan headernya
					header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
					header("Cache-Control: no-store, no-cache, must-revalidate");
					header("Cache-Control: post-check=0, pre-check=0", false);
					header("Pragma: no-cache");
					header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
					//ubah nama file saat diunduh
					header('Content-Disposition: attachment;filename="data_receivinglocal.xlsx"');
					//unduh file
					$objWriter->save("php://output");
	}
// Receiving Local

// User
	public function manage_user()
	{
		$data['title'] = 'Data Pengguna | Sistem Inventory';
		$data['pengguna'] = $this->db->query("SELECT * FROM users");
		//$data['count_barang'] = $this->db->query("SELECT * FROM tb_barang ORDER BY kd_barang DESC LIMIT 1");
		$data['content'] = 'user/user_v';
		$this->load->view('layouts/main_v',$data);
	}

	public function inc_pengguna()
	{
		if (isset($_POST) && !empty($_POST)) {
            $this->form_validation->set_rules('usr_txt', 'Username', 'trim|required');
            $this->form_validation->set_rules('nm_txt', 'Nama', 'trim|required');
            $this->form_validation->set_rules('pw_txt', 'Password', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');

            if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata("msg","
                        <div class='alert alert-warning fade in'>
                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
                            <strong>Gagal !</strong> Isi Data dengan Lengkap !
                        </div>");
                header('location:'.base_url().'Gudang/manage_user');
            }else{
            	$act = $this->input->post('act');
            	$usr = $this->input->post('usr_txt');
            	$nm = $this->input->post('nm_txt');
            	$pw = $this->input->post('pw_txt');
            	$status = $this->input->post('status');

            	if($act=='edit'){
            		$edit = $this->db->query("UPDATE users SET nama='$nm', password=md5('$pw'), level='$status' WHERE username='$usr' ");
            		if($edit){
	            		$this->session->set_flashdata("msg","
	                        <div class='alert alert-success fade in'>
	                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                            <strong>Success !</strong> Berhasil Mengubah Data Pengguna !
	                        </div>");
	            	}else{
	            		$this->session->set_flashdata("msg","
	                        <div class='alert alert-warning fade in'>
	                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                            <strong>Failed !</strong> Terjadi Kesalahan mengubah data Pengguna!
	                        </div>");
	            	}
                	header('location:'.base_url().'Gudang/manage_user');
            	}else{
            		$add = $this->db->query("INSERT INTO users (username,nama,password,level) VALUES ('$usr','$nm',md5('$pw'),'$status') ");
            		if($add){
	            		$this->session->set_flashdata("msg","
	                        <div class='alert alert-success fade in'>
	                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                            <strong>Success !</strong> Berhasil Menambah Data Pengguna !
	                        </div>");
	            	}else{
	            		$this->session->set_flashdata("msg","
	                        <div class='alert alert-warning fade in'>
	                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
	                            <strong>Failed !</strong> Terjadi Kesalahan menambah data Pengguna!
	                        </div>");
	            	}
                	header('location:'.base_url().'Gudang/manage_user');
            	}
            }
        }else{
        	$this->error();
        }
	}

	//Hapus Pengguna
	public function hapus_pengguna($kd)
	{
		if (isset($kd) && !empty($kd)) {
			$hapus = $this->db->query("DELETE FROM users WHERE username='$kd' ");
			if($hapus){
				$this->session->set_flashdata("msg","<div class='alert alert-success fade in'>
					<a href='#' class='close' data-dismiss='alert'>&times;</a>
					<strong>Success !</strong> Berhasi mengahapus data Pengguna!
				</div>");
			}else{
				$this->session->set_flashdata("msg","<div class='alert alert-danger fade in'>
					<a href='#' class='close' data-dismiss='alert'>&times;</a>
					<strong>Failed !</strong> Terjadi Kesalahan penghapusan data Penguna!
				</div>");
			}

			header('location:'.base_url().'Gudang/manage_user');
		}else $this->error();
	}
// User
}
