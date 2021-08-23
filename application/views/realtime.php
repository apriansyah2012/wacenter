<h4>Status Whatsapp Gateway </h4>



<?php 

$result = $this->db->query("SELECT * FROM device");
		foreach ($result->result_array() as $id)
		$token=$id['token'];
		$server=$id['server'];
        $encode=base64_encode($server);

 $url="$server/?token=$token";
 $get_url = file_get_contents($url);
 $data = json_decode($get_url, true);
?>

<div class="col-lg-12">
        <div class="panel no-border ">
            <div class="panel-title bg-white no-border">
                <div class="panel-head"></div>
            </div>
            <div class="panel-body no-padding-top bg-white">
                
                <p class="text-light margin-bottom-30"></p>
               
                <?php echo '<div class="pesan">'.$this->session->flashdata('message').'</div>';?>
                <div class="table-responsive">
                    <table class="table table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="vertical-middle">No</th>
                                <th class="vertical-middle">Nomor HP</th>
                                <th class="vertical-middle">Server</th>
                                <th class="vertical-middle" colspan="5">Token</th>
                                <th class="vertical-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <form action="<?php echo site_url('dashboard/ubah/'.$device->id_device.''); ?>" method="post">
                            <tr>
                                <td class="vertical-left">1</td>
                                <td class="vertical-left"><input type="text"  name="no_hp" placeholder="" value="<?php echo $device->no_hp;?>" class="col-xs-12 col-sm-12" /></td>
                                <td class="vertical-left"><b><input type="text"  name="server" placeholder="" value="<?php echo $device->server;?>" class="col-xs-12 col-sm-12" /></b></td>
                                <td class="vertical-left" colspan="5" ><input type="text"  name="token" placeholder="" value="<?php echo $device->token;?>" class="col-xs-12 col-sm-12" /></td>
                                <td class="vertical-middle"><button class="btn btn-sm btn-primary" type="submit">
						<i class="ace-icon fa fa-floppy-o bigger-120"></i>
						UBAH NOMOR SENDER
				        </button></td>
                            </tr>
                        </form>
                        </tbody>
                        <thead>
                            <tr>
                                <th class="vertical-left">No</th>
                                <th class="vertical-middle">Device ID</th>
                                <th class="vertical-middle">Sender Phone</th>
                                <th class="vertical-middle">Package</th>
                                <th class="vertical-middle">Quota</th>
                                <!-- <th class="vertical-middle">Limit Daily</th> -->
                                <th class="vertical-middle">Expired Date</th>
                                <th class="vertical-middle">Status</th>
                                <th class="vertical-middle" colspan="2" width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="vertical-left">2</td>
                                <td class="vertical-middle"><b><?php echo $data['data']['project_id'];?></b></td>
                                <td class="vertical-middle"><b><?php echo $data['data']['sender'];?></b></td>
                                <td class="vertical-middle">Quota WA 1</td>
                                <td class="vertical-middle"><b><?php echo $data['data']['whatsapp']['quota'];?></b></td>
                                <td class="vertical-middle"><b><?php echo $data['data']['whatsapp']['expired'];?></b></td>
                                <td class="vertical-middle"><b><?php echo $data['data']['whatsapp']['status'];?></b></td>
                                <td colspan="2"><a href="javascript: void(0)" onclick="popup('<?php echo $server;?>/?token=<?php echo $token;?>&url=<?php echo $encode;?>')">
                                <button class="btn btn-xs btn-warning" type="button">
                                <i class="fa fa-qrcode" aria-hidden="true"></i>  SCAN QR CODE</button></a>
                                <a href="<?php echo base_url();?>dashboard/restart"><button class="btn btn-xs btn-danger" type="button">
                                <i class="ace-icon fa fa-refresh bigger-110"></i>RESTART SERVER</button></a>
                                </td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div><!-- /.col -->
    </div>
</div>

<!--untuk memanggil js blink di asset-->						
<script src="<?php echo base_url();?>assets/blink/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo base_url();?>assets/blink/js/smart.js"></script>
<style>
.pesan{
display: none;
width: 100%;
}
</style>
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script>
	//angka 500 dibawah ini artinya pesan akan muncul dalam 0,5 detik setelah document ready
			$(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
	//angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
		setTimeout(function(){$(".pesan").fadeOut('slow');}, 3000);
</script>

<script type="text/javascript">
<!--
function popup(url) 
{
 var width  = 600;
 var height = 600;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=no';
 params += ', scrollbars=no';
 params += ', status=no';
 params += ', toolbar=no';
 newwin=window.open(url,'windowname5', params);
 if (window.focus) {newwin.focus()}
 return false;
}
// -->
</script>