<script>
    // DataTables
    $(document).ready(function() {
        $('#dataCrud').DataTable({
            responsive: true,
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?= base_url('agenda_sk/ambildata') ?>",
                "type": "POST"
            },
            
            // scrollY: '270px',

            // dom: 'Brftip',

            "columnDefs": [{
                "targets": [],
                "orderable": false,
                // "width": 5
            }],
        });
    });

    

    // Modal Ubah (pengaturan)
    

    $(document).on("click", "#ubah-role", function() {
        $(".modal-body #id").val($(this).data('id'));
        $(".modal-body #role").val($(this).data('role'));
    });

    // Modal Hapus
    $(document).on("click", "#hapus-pengguna", function() {
        $(".modal-body #id").val($(this).data('id'));
    });
    $(document).on("click", "#hapus-role", function() {
        $(".modal-body #id").val($(this).data('id'));
    });
    
    $(document).on("click", "#hapus-sm", function() {
        $(".modal-body #id").val($(this).data('id'));
    });
    $(document).on("click", "#hapus-sk", function() {
        $(".modal-body #id").val($(this).data('id'));
    });
</script>

