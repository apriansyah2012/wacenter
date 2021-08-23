	<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/4.2.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-duallistbox.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-multiselect.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/select2.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo base_url();?>assets/js/ace-extra.min.js"></script>


<script >
function cek_karakter(form) {
maks =1500; // max character
if (form.pesan.value.length >= maks) {
var message = "0 Character Left ! "; //alert if character limit reacher
alert(message);
form.pesan.value = form.pesan.value.substring(0, maks); //trim the textarea
}
else {
form.total.value = maks - form.pesan.value.length;} //count the character
}

</script>



<div class="row">
		<div class="col-xs-12">
<form action="<?php echo site_url('c_wa/tbh'); ?>" method="post">
<input type="text" id="form-field-1" placeholder="Auto" class="col-xs-10 col-sm-2" name="action" value="aksi" hidden />
		
<table id="dynamic-table" class="table table-striped table-bordered table-hover" >
			
			
		<tr>
			<td width='200'>Judul</td>
			<td><input type="text" name="judul" /></td>
			
		</tr>
			<tr>
				<th><h5>Isi Pesan</H5></th>
				<th>
					
					<textarea onKeyPress=cek_karakter(this.form); onKeyDown=cek_karakter(this.form); name="pesan" rows=10 cols="100%"></textarea>
					<br> <br>
					<input size=1 value=0 name="total">
				</th>
			</tr>
			<tr>
			<th><h5>Kirim Tujuan Group</H5></th>
			<th>
			<table>
			<tr>
			
			<td width="120" valign="center" ><?php $nom=1;foreach ($group as $s){?>
			<label class="pos-rel">
				<input type="checkbox" name="id_group[]" value="<?php echo $s->id_group;?>" class="ace"/>
				<span class="lbl">
				</label><b> <?php echo $s->group_name;?></b><br><?php $nom++; }	?>
			</td>
			
			</tr>
			</table>
			</th>
			</tr>
			<tr>
				<th><h5>Kirim Tujuan Multiple</H5></th>
				<th>
					<div class="col-xs-12 col-sm-9">
						<select multiple="" id="state" name="msg[]" class="select2" data-placeholder="Cari nama kontak">
							<?php $no=1;foreach ($contact as $s){?>	
							<option value="<?php echo $s->contact_numb;?>"><?php echo $s->name;?></option>
							<?php $no++; }	?>
						</select>
					</div>
				</th>
			</tr>
</table>

<button class="btn btn-sm btn-primary" type="submit">
						<i class="ace-icon fa fa-floppy-o bigger-120"></i>
						Kirim
				</button>

		</div>
</div>

</form>

<!--======================================-->
						
		<script src="<?php echo base_url();?>assets/js/jquery.2.1.1.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="<?php echo base_url();?>assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="<?php echo base_url();?>assets/js/jquery.bootstrap-duallistbox.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.raty.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-multiselect.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/select2.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/typeahead.jquery.min.js"></script>

		<!-- ace scripts -->
		<script src="<?php echo base_url();?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($){
			    var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox({infoTextFiltered: '<span class="label label-purple label-lg">Filtered</span>'});
				var container1 = demo1.bootstrapDualListbox('getContainer');
				container1.find('.btn').addClass('btn-white btn-info btn-bold');
			
				/**var setRatingColors = function() {
					$(this).find('.star-on-png,.star-half-png').addClass('orange2').removeClass('grey');
					$(this).find('.star-off-png').removeClass('orange2').addClass('grey');
				}*/
				$('.rating').raty({
					'cancel' : true,
					'half': true,
					'starType' : 'i'
					/**,
					
					'click': function() {
						setRatingColors.call(this);
					},
					'mouseover': function() {
						setRatingColors.call(this);
					},
					'mouseout': function() {
						setRatingColors.call(this);
					}*/
				})//.find('i:not(.star-raty)').addClass('grey');
				
				
				
				//////////////////
				//select2
				$('.select2').css('width','200px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});
				
				//////////////////
				$('.multiselect').multiselect({
				 enableFiltering: true,
				 buttonClass: 'btn btn-white btn-primary',
				 templates: {
					button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown"></button>',
					ul: '<ul class="multiselect-container dropdown-menu"></ul>',
					filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
					filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default btn-white btn-grey multiselect-clear-filter" type="button"><i class="fa fa-times-circle red2"></i></button></span>',
					li: '<li><a href="<?php echo base_url();?>javascript:void(0);"><label></label></a></li>',
					divider: '<li class="multiselect-item divider"></li>',
					liGroup: '<li class="multiselect-item group"><label class="multiselect-group"></label></li>'
				 }
				});
				
				
				///////////////////
					
				//typeahead.js
				//example taken from plugin's page at: https://twitter.github.io/typeahead.js/examples/
				var substringMatcher = function(strs) {
					return function findMatches(q, cb) {
						var matches, substringRegex;
					 
						// an array that will be populated with substring matches
						matches = [];
					 
						// regex used to determine if a string contains the substring `q`
						substrRegex = new RegExp(q, 'i');
					 
						// iterate through the pool of strings and for any string that
						// contains the substring `q`, add it to the `matches` array
						$.each(strs, function(i, str) {
							if (substrRegex.test(str)) {
								// the typeahead jQuery plugin expects suggestions to a
								// JavaScript object, refer to typeahead docs for more info
								matches.push({ value: str });
							}
						});
			
						cb(matches);
					}
				 }
			
				 $('input.typeahead').typeahead({
					hint: true,
					highlight: true,
					minLength: 1
				 }, {
					name: 'states',
					displayKey: 'value',
					source: substringMatcher(ace.vars['US_STATES'])
				 });
					
					
				///////////////
				
				
				//in ajax mode, remove remaining elements before leaving page
				$(document).one('ajaxloadstart.page', function(e) {
					$('[class*=select2]').remove();
					$('select[name="duallistbox_demo1[]"]').bootstrapDualListbox('destroy');
					$('.rating').raty('destroy');
					$('.multiselect').multiselect('destroy');
				});
			
			});
		</script>
	</body>
</html>
		
				



 