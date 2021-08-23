<!-- PAGE CONTENT BEGINS -->
								<div class="row">
								<?php echo '<div class="pesan">'.$this->session->flashdata('message').'</div>';?>
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue"><?php if (isset($subheader)){ echo $subheader; }?></h3>
										
										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
										<div class="table-header">
											<!--Results for "Latest Registered Domains"-->
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
										<th class="left" colspan="9">
										<form class="form-search" action="<?php echo base_url();?>kontak/cari" method=POST >
										<span class="input-icon">
										<input name="cari"type="text" placeholder="Cari......." class="nav-search-input" id="nav-search-input" autocomplete="on" />
											<i class="ace-icon fa fa-search nav-search-icon"></i>
											</span>
											<div class="widget-toolbar">
											
											<a href="<?php echo base_url();?>gateway/tbh" data-action="collapse"><button class="btn btn-xs btn-primary" type="button">
												<i class="ace-icon glyphicon glyphicon-plus bigger-110"></i>
												Tambah
											</button></a>
											<a href="javascript:history.back()" class="btn btn-xs btn-warning" type="reset" data-action="collapse">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Kembali
											</button></a>
											</div>
										</form>	
										
										<hr>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="center">
															No
														</th>
														<th>Kode</th>
														<th class="hidden-480">Topik</th>
														<th class="hidden-480">Isi Keterangan</th>
														<th colspan="2">Tindakan</th>
													</tr>
												</thead>

												<tbody>
												<?php $no=$num+1; foreach($gateway as $s){?>
													<tr>
														<td class="center" width="50">
															<?php echo $no;?>
														</td>

														<td>
															<a href="#"><?php echo $s->kode; ?></a></td>
														<td class="hidden-480"><?php echo $s->deskripsi_topik; ?></td>
														<td class="hidden-480"><?php echo $s->isi; ?></td>
														<?php echo'
														<td class="center" width="50" ><a class="green" href="'.base_url().'gateway/ubah/'.$s->id_topik.'">
															<i class="ace-icon fa fa-pencil bigger-130"></i>
														</a></td>';?>
														<?php echo'
														<td class="center" width="50" ><a class="green" href="'.base_url().'gateway/hapus/'.$s->id_topik.'" onclick="return confirm(\'Anda yakin menghapus ' .$s->deskripsi_topik.' ?\')">
															<i class="ace-icon fa fa-trash bigger-130" title="Hapus Data"></i>
														</a></td>';?>
													</tr>
													<?php $no++;}?>
												</tbody>
											</table><?php echo $this->pagination->create_links();?>
										</div>
									</div>
								</div>
								<!-- PAGE CONTENT ENDS -->
								
								