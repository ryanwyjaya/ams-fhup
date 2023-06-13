<?= $this->session->flashdata('message'); ?>
<div class="box">
	<div class="box-header bg-info"></div>
	<div class="box-body">
			<a target="_blank" href="<?= base_url('agenda_sm/cetak_all'); ?>" style="margin-bottom: 10px;" class="btn btn-primary"><strong class="text-white"><i class="fa fa-print text-white"></i> Cetak Semua</strong></a>

            <a href="<?= base_url('agenda_sm/cetak'); ?>" style="margin-bottom: 10px;" class="btn btn-danger"><strong class="text-white"><i class="fa fa-print text-white"></i> Cetak Berdasarkan Periode</strong></a>
            <div class="table-responsive">
		<table class="table table-sm table-hover table-bordered" id="dataCrud">
			<thead class="alert-primary">
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
			<tbody>
				
			</tbody>
		</table>
		</div>
	</div>
</div>

