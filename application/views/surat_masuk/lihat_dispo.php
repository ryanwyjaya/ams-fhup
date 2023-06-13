<?= $this->session->flashdata('message'); ?>
<div class="box">
	<div class="box-header bg-info"></div>
	<div class="box-body">
		<div class="table-responsive">
			<?php 
			$id = $edit['id'];
			$dispo = $this->db->select('surat_masuk.*,
				disposisi.tanggal_disposisi,disposisi.isi,disposisi.tindakan,disposisi.status as ds,disposisi.id as param

				');
			$dispo = $this->db->where('disposisi.id_surat_masuk',$id);
			$dispo = $this->db->join('surat_masuk','disposisi.id_surat_masuk = surat_masuk.id');
			$dispo = $this->db->order_by('surat_masuk.no_agenda');
			$dispo = $this->db->get('disposisi')->result_array();

			  ?>
		<table class="table table-sm table-hover table-stripped table-bordered">
			<thead class="alert-primary">
			<th>No Agenda</th>	
			<th>No Surat</th>
			<th>Asal Surat</th>
			<th>Tujuan Surat</th>
			<th>Tanggal Disposisi</th>
			<th>Isi Disposisi</th>
			<th>Tindakan</th>
			<th>Status</th>
			<th>Action</th>

			</thead>
			<?php if (empty($dispo)): ?>
				<td colspan="9"><b>DATA TIDAK ADA..!!</b></td>
			<?php else: ?>

			<?php
			foreach ($dispo as $d):?>
			<tbody>
			<td><?= $d['no_agenda']; ?></td>
			<td><?= $d['no_surat']; ?></td>
			<td><?= $d['asal_surat']; ?></td>
			<?php 
			$id = $d['tujuan_surat'];
			$r = $this->db->where('id',$id);
			$r = $this->db->get('user_role')->row_array();
		    ?>	
			<td><?= $r['role']; ?></td>
			<td><?= format_indo($d['tanggal_disposisi']); ?></td>
			<td><?= $d['isi']; ?></td>
			<td><?= $d['tindakan']; ?></td>
			<?php if ($d['ds']==0): ?>
			<td><b class="text-warning"> Waiting</b></td>
			<?php elseif ($d['ds']==1): ?>	
			<td><b class="text-primary"> Terproses</b></td>
			<?php else: ?>
			<td><b class="text-success"> Selesai</b></td>
			<?php endif ?>
			<td><a target="_blank" class="btn btn-sm btn-info" href="<?= base_url('disposisi/cetak/').$d['param']; ?>"><strong class="text-white"><i class="fa fa-print text-white"></i> Print</strong></a></td>
			</tbody>
			<?php endforeach; ?>
			
			<?php endif ?>
			
		</table>
		</div>
		<div class="form-group">
			<a class="btn btn-danger" href="<?= base_url('surat_masuk'); ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
		</div>
	</div>
</div>