<!-- PAGE CONTENT BEGINS -->
								<div class="row">
								<?php echo '<div class="pesan">'.$this->session->flashdata('message').'</div>';?>
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue"><?php if (isset($subheader)){ echo $subheader; }?></h3>
										<form action="<?php echo base_url();?>excel/upload/" method="post" enctype="multipart/form-data">
											<table>
											<tr><td><input type="file" name="file"/></td>
											<td><input type="submit" value="Upload file"/></td>
											</tr>
											</table>
										</form>
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
											<!--<?php echo'<a href="'.base_url().'kontak/clean" onclick="return confirm(\'Anda yakin mengosongkan tabel ?\')">
											<button class="btn btn-xs btn-danger" type="button">
												<i class="ace-icon glyphicon glyphicon-trash bigger-110"></i>
												Hapus Seluruh Data Kontak
											</button>
											</a>';?>-->
											
										<?php echo'<a href="'.base_url().'format/exel.xlsx" onclick="return confirm(\'Download format exel ?\')">
											<button class="btn btn-xs btn-success" type="button">
												<i class="ace-icon glyphicon glyphicon-exit bigger-110"></i>
												Format Data Exel untuk Upload
											</button>
											</a>';?>
											<a href="<?php echo base_url();?>kontak/tbh" data-action="collapse"><button class="btn btn-xs btn-primary" type="button">
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
														<th>Nama</th>
														<th class="hidden-480">No Whatshap</th>
														<th class="hidden-480">Group</th>
														<th colspan="2">Tindakan</th>
													</tr>
												</thead>

												<tbody>
												<?php $no=$num+1; foreach($user as $s){?>
													<tr>
														<td class="center" width="50">
															<?php echo $no;?>
														</td>

														<td>
															<a href="#"><?php echo $s->name; ?></a><br>
															<label data-toggle="modal" data-target="#modal-default_<?php echo $s->id_contact;?>">
														<button class="btn btn-xs btn-primary" type="button"><i class="ace-icon fa fa-plus-square bigger-130"></i> TAMBAH GROUP
														</button></label><br>

															
														</td>
														<td class="hidden-480"><?php echo $s->contact_numb; ?></td>
														<td class="hidden-480">
														
														<?php 
															$result = $this->db->query("SELECT * FROM group_acess 
															INNER JOIN `groups`  ON (`groups`.`id_group` = `group_acess`.`id_group`)
															WHERE group_acess.id_contact=$s->id_contact  ");
															foreach ($result->result_array() as $id){
															$nama_group=$id['group_name'];
															echo '<i class="fa fa-fw fa-check-square"></i>';echo $nama_group;echo '<a class="green" href="'.base_url().'kontak/hapus_acess/'.$id['id_acess'].'" onclick="return confirm(\'Anda yakin menghapus data ini ?\')">
																<i class="fa fa-fw fa-trash-o"></i></a>';
															
															echo '<br>';
															}
														?>
														<hr>



														
															<div class="modal fade" id="modal-default_<?php echo $s->id_contact;?>">
																<div class="modal-dialog">
																	<div class="modal-content">
																	<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span></button>
																	<h4 class="modal-title">Tambah Group</h4>
																	</div>
																	<?php echo form_open_multipart('kontak/tbh_acess/'.$s->id_contact); ?>
																	<div class="modal-body">
																	<div class="form-group">
																	<label>Topik</label>
																	<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-tag"></i></span>
																	<select class="form-control" name="id_group" required>
																	<?php  foreach($group as $x){?>
																	<option value="<?php echo $x->id_group;?>"><?php echo $x->group_name;?></option>
																	<?php } ?>
																	</select>
																	</div>
																	</div>
																	</div>
																	<div class="modal-footer">
																	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
																	<button type="submit" class="btn btn-primary">Simpan</button>
																	</div>
																	</form>
																	</div>
																</div>
															</div>
													
													</td>
														<?php echo'
														<td class="center" width="50" ><a class="green" href="'.base_url().'kontak/ubah/'.$s->id_contact.'">
															<i class="ace-icon fa fa-pencil bigger-130"></i>
														</a></td>';?>
														<?php echo'
														<td class="center" width="50" ><a class="green" href="'.base_url().'kontak/hapus/'.$s->id_contact.'" onclick="return confirm(\'Anda yakin menghapus ' .$s->name.' ?\')">
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
								
								