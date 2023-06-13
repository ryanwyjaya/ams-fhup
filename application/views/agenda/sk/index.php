<?= $this->session->flashdata('message'); ?>
<div class="box">
	<div class="box-header"></div>
	<div class="box-body">
		
		<a target="_blank" href="<?= base_url('agenda_sk/cetak_all'); ?>" style="margin-bottom: 10px;" class="btn btn-primary"><strong class="text-white"><i class="fa fa-print text-white"></i> Cetak Semua</strong></a>

            <a href="<?= base_url('agenda_sk/cetak'); ?>" style="margin-bottom: 10px;" class="btn btn-danger"><strong class="text-white"><i class="fa fa-print text-white"></i> Cetak Berdasarkan Periode</strong></a>
		<div class="table-responsive">
		<table class="table table-sm table-hover table-bordered" id="dataCrud">
			<thead>
				<th class="text-uppercase">no agenda</th>
				<th class="text-uppercase">no surat</th>
				<th class="text-uppercase">sifat</th>
				<th class="text-uppercase">perihal</th>
				<th class="text-uppercase">tanggal surat</th>
				<th class="text-uppercase">tujuan surat</th>
				<th class="text-uppercase">asal surat</th>
				<th class="text-uppercase">isi</th>
				<th class="text-uppercase">jenis surat</th>
				<th class="text-uppercase">tanggal dibuat</th>
				<th class="text-uppercase">pemohon</th>
				<th class="text-uppercase">alamat</th>

				
			</thead>
			<tbody>
				
			</tbody>
		</table>
		</div>
		
	</div>
</div>

