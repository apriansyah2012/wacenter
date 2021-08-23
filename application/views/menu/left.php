<?php 
$sess_level=$this->session->userdata('level');
$sess_nip=$this->session->userdata('nip');
?>

<ul class="nav nav-list">
					
					<li class="active">
						<a href="<?php echo site_url();?>dashboard">
							<i class="menu-icon fa fa-home" style="color:green"></i>
							<span class="menu-text"> Server </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon ace-icon fa fa-comments" style="color:green"></i>
							<span class="menu-text"> WhatsApp </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>
						
						<ul class="submenu">
							<li class="">
								<a href="<?php echo site_url();?>c_wa">
									<i class="menu-icon fa fa-caret-right"></i>
									Pesan Terkirim
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
						<ul class="submenu">
							<li class="">
								<a href="<?php echo site_url();?>c_inwa">
									<i class="menu-icon fa fa-caret-right"></i>
									Pesan Masuk
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-cog" style="color:green"></i>
							<span class="menu-text">
								Pengaturan
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>
						
						
						<ul class="submenu">
							<li class="">
								<a href="<?php echo site_url();?>group">
									<i class="menu-icon fa fa-caret-right" style="color:green"></i> Group
								</a>
							</li>
						</ul>
						<ul class="submenu">
							<li class="">
								<a href="<?php echo site_url();?>kontak">
									<i class="menu-icon fa fa-caret-right" style="color:green"></i> Kontak
								</a>
							</li>
						</ul>
						<ul class="submenu">
							<li class="">
								<a href="<?php echo site_url();?>gateway">
									<i class="menu-icon fa fa-caret-right" style="color:green"></i> Auto Respon
								</a>
							</li>
						</ul>

						
					</li>
					
					
					
					
					<li class="">
						<a href="<?php echo base_url();?>login/user/logout">
							<i class="menu-icon glyphicon glyphicon-off" style="color:green"></i>

							<span class="menu-text">Keluar Aplikasi
								<span class="badge badge-transparent tooltip-error" title="2 Important Events">
									
								</span>
							</span>
						</a>

						<b class="arrow"></b>
					</li>
</ul>