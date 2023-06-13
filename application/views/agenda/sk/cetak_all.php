<?php 
$sc = $this->db->get('site_config')->row_array();
  ?>

 <div class="container">
 	<table>
 		<td width="1000"><?= $sc['header']; ?></td>
 	</table>
 	<table style="margin-top: -110px;">
 		<td width="1000" align="center"><b style="margin-left: 40px;"><font size="5" style="font-family: Times New Roman;">DATA SEMUA AGENDA SURAT KELUAR</font></b></td>
 	</table>
 	<?php 
 	$sm = $this->db->order_by('no_agenda');
 	$sm = $this->db->get('surat_keluar')->result_array();
 	  ?>
 	<table class="table table-sm table-hover table-bordered">
 		<thead class="alert-dark">
 		<th width="1px">No Agenda</th>
		<th>No Surat</th>
        <th>Perihal</th>
        <th>Sifat</th>
        <th>Tanggal Surat</th>
        <th>Tujuan Surat</th>
        <th>Asal Surat</th>
        <th>Tanggal Dibuat</th>
        <th>Nama Pengirim</th>
        <th>Alamat Pengirim</th>
        <th>Pengelola</th>
 		</thead>
 		
 		<?php if (empty($sm)): ?>
 			<tbody>
 				<td colspan="10"><b class="text-primary">Data Kosong</b></td>
 			</tbody>
 		
 		<?php else: ?>


 		<?php 
 		foreach ($sm as $s): ?>
 		<tbody>
 		<td><?= $s['no_agenda']; ?></td>
 		<td><?= $s['no_surat']; ?></td>
 		<td><?= $s['perihal']; ?></td>
 		<td><?= $s['sifat']; ?></td>
 		<td><?= format_indo($s['tanggal_surat']); ?></td>
 		<td><?= $s['tujuan_surat']; ?></td>
 		<td><?= $s['asal_surat']; ?></td>
 		<td><?= format_indo($s['tanggal_dibuat']); ?></td>
 		<td><?= $s['pemohon']; ?></td>
 		<td><?= $s['alamat']; ?></td>
        <td><?= $s['pengelola']; ?></td>
 				
 		<?php endforeach ?>	
 		<?php endif ?>
 		</tbody>
 	</table>
 	
 </div>
 <script type="text/javascript">
     window.print();
 </script>
 