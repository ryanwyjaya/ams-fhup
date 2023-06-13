<?php 
$sc = $this->db->get('site_config')->row_array();
  ?>

 <div class="container">
 	<table>
 		<td width="1000"><?= $sc['header']; ?></td>
 	</table>
 	<table style="margin-top: -110px; margin-bottom: 20px;">
 		<td width="1000" align="center"><b class="text-uppercase" style="margin-left: 40px;"><font size="4" style="font-family: Times New Roman;"><?= $title; ?> <br><?= $subtitle; ?></font></b></td>
 	</table>
 	<?php 
 	$sm = $this->db->order_by('no_agenda');
 	$sm = $this->db->get('surat_masuk')->result_array();
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
        <th>Tanggal Diterima</th>
        <th>Nama Pengirim</th>
        <th>Alamat Pengirim</th>
 		</thead>
 		
 		<?php if (empty($datafilter)): ?>
 			<tbody>
 				<td colspan="10"><b class="text-primary">Data Kosong</b></td>
 			</tbody>
 		
 		<?php else: ?>


 		<?php 
 		foreach ($datafilter as $s): ?>
 		<tbody>
 		<td><?= $s['no_agenda']; ?></td>
 		<td><?= $s['no_surat']; ?></td>
 		<td><?= $s['perihal']; ?></td>
 		<td><?= $s['sifat']; ?></td>
 		<td><?= format_indo($s['tanggal_surat']); ?></td>
 		<?php 
 		$id = $s['tujuan_surat'];
 		$role = $this->db->where('id',$id);
 		$role = $this->db->get('user_role')->row_array();
 		  ?>
 		<td><?= $role['role']; ?></td>
 		<td><?= $s['asal_surat']; ?></td>
 		<td><?= format_indo($s['tanggal_diterima']); ?></td>
 		<td><?= $s['nama_pengirim']; ?></td>
 		<td><?= $s['alamat_pengirim']; ?></td>
 				
 		<?php endforeach ?>	
 		<?php endif ?>
 		</tbody>
 	</table>
 	
 </div>
 <script type="text/javascript">
 	window.print();
 </script>