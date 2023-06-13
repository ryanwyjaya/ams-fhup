<?php 
$sc = $this->db->get('site_config')->row_array();
  ?>

 <div class="container">
 	<table>
 		<td width="1000"><?= $sc['header']; ?></td>
 	</table>
 	
 	<?php 
 	$where = $edit['id_surat_masuk'];
 	$sm = $this->db->where('id',$where);
 	$sm = $this->db->get('surat_masuk')->row_array();
 	  ?>
 	<?php if (empty($sm)): ?>
 	<h3 align="center"><b>DATA TIDAK ADA..!!</b></h3>
 	<?php else: ?>	
 	<table class="text-center" style="margin-top: -100px;">
 		<td width="1000"><u><h5 class="text-uppercase"><b>lembar disposisi</b></h5></u></td></table>
 	<table border="2">
 		<td width="250"><b style="font-family: Times New Roman; margin-left: 20px;">Surat Dari</b></td>
 		<td width="250">&nbsp;<b>:</b><font style="font-family: Times New Roman; margin-left: 20px;"><?= $sm['asal_surat']; ?></font></td>
 		<td width="250"><b style="font-family: Times New Roman; margin-left: 20px;">Diterima Tanggal</b></td>
 		<td width="250">&nbsp;<b>:</b><font style="font-family: Times New Roman; margin-left: 20px;"><?= format_indo($sm['tanggal_diterima']); ?></font></td>
 		
 	</table>
 	<table border="2" style="margin-top: -2px;">
 		<td width="250"><b style="font-family: Times New Roman; margin-left: 20px;">Tanggal Surat</b></td>
 		<td width="250">&nbsp;<b>:</b><font style="font-family: Times New Roman; margin-left: 20px;"><?= format_indo($sm['tanggal_surat']); ?></font></td>
 		<td width="250"><b style="font-family: Times New Roman; margin-left: 20px;">Nomor Agenda</b></td>
 		<td width="250">&nbsp;<b>:</b><font style="font-family: Times New Roman; margin-left: 20px;"><?= $sm['no_agenda']; ?></font></td>
 		
 	</table>
 	<table border="2" style="margin-top: -2px;">
 		<td width="250"><b style="font-family: Times New Roman; margin-left: 20px;">Nomor Surat</b></td>
 		<td width="250">&nbsp;<b>:</b><font style="font-family: Times New Roman; margin-left: 20px;"><?= $sm['no_surat']; ?></font></td>
 		<td width="250"><b style="font-family: Times New Roman; margin-left: 20px;">Disposisi Oleh</b></td>
 		<?php 
 		$id = $sm['tujuan_surat'];
 		$r = $this->db->where('id',$id);
 		$r = $this->db->get('user_role')->row_array();
 		  ?>
 		<td width="250">&nbsp;<b>:</b><font style="font-family: Times New Roman; margin-left: 20px;"><?= $r['role']; ?></font></td>
 		
 	</table>
 	<table border="2" style="margin-top: -2px;">
 		<td width="250"><b style="font-family: Times New Roman; margin-left: 20px;">Perihal</b></td>
 		<td width="250">&nbsp;<b>:</b><font style="font-family: Times New Roman; margin-left: 20px;"><?= $sm['perihal']; ?></font></td>
 		<td width="250"><b style="font-family: Times New Roman; margin-left: 20px;">Tanggal Disposisi</b></td>
 		<td width="250">&nbsp;<b>:</b><font style="font-family: Times New Roman; margin-left: 20px;"><?= format_indo($edit['tanggal_disposisi']); ?></font></td>
 		
 	</table>
 	<table class="text-center" style="margin-top: 10px;">
 		<td width="1000"><u><h5 class="text-uppercase"><b>ISI disposisi</b></h5></u></td></table>
 	<table border="2">
 		<td width="1000"><div class="box" style="margin-left: 20px;"><?= $edit['isi']; ?></div></td>
 		
 	</table>
 	<table style="margin-top: 30px;">
 		<td width="1000"><b class="text-uppercase">setelah digunakan mohon di kembalikan ke <?= $edit['dikembalikan']; ?> Untuk di arsipkan.</b></td>
 		
 	</table>
 	<?php endif ?>
 	
 </div>


 <script type="text/javascript">
 	window.print();
 </script>