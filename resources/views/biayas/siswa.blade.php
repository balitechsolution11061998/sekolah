<x-default-layout>
    @section('title', 'Biaya Management for Siswa')

    @push('styles')
        <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <style>
            .card-custom {
                border: none;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            }

            .table-custom thead {
                background-color: #6c5ce7;
                color: #fff;
            }

            .badge-lunas {
                background-color: #00b894;
                color: white;
            }

            .badge-belum-lunas {
                background-color: #d63031;
                color: white;
            }

            .btn-animated {
                transition: transform 0.2s;
            }

            .btn-animated:hover {
                transform: scale(1.1);
            }
        </style>
    @endpush

    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
            <button id="tambahBiayaBtn" class="btn btn-sm btn-success btn-animated">
                <i class="fas fa-plus"></i> Tambah Biaya Siswa
            </button>

        </div>

        <div class="card card-custom rounded">
            <div class="card-body">
                <h2 class="mb-4 text-center text-primary">Siswa Biaya Management</h2>
                <table id="biayaTable" class="table table-striped table-custom table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th> <!-- Index column -->
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Kode Biaya</th>
                            <th>Nama Biaya</th>
                            <th>Jumlah</th>
                            <th>Periode</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be populated by DataTables -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal for adding biaya -->
    <div class="modal fade" id="biayaModal" tabindex="-1" aria-labelledby="biayaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="biayaModalLabel">Tambah Biaya Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formBiaya">
                        <div class="mb-3">
                            <label for="namaSiswa" class="form-label">Nama Siswa</label>
                            <input type="text" class="form-control" id="namaSiswa" placeholder="Masukkan nama siswa"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="kelasSiswa" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="kelasSiswa"
                                placeholder="Masukkan kelas siswa" required>
                        </div>
                        <div class="mb-3">
                            <label for="kodeBiaya" class="form-label">Kode Biaya</label>
                            <input type="text" class="form-control" id="kodeBiaya" placeholder="Masukkan kode biaya"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="namaBiaya" class="form-label">Nama Biaya</label>
                            <input type="text" class="form-control" id="namaBiaya" placeholder="Masukkan nama biaya"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlahBiaya" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="jumlahBiaya"
                                placeholder="Masukkan jumlah biaya" required>
                        </div>
                        <div class="mb-3">
                            <label for="periodeBiaya" class="form-label">Periode</label>
                            <select class="form-control" id="periodeBiaya" required>
                                <option value="bulanan">Bulanan</option>
                                <option value="tahunan">Tahunan</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveBiayaBtn">Simpan Biaya</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/toastify-js@1.11.2/src/toastify.min.js"></script>

        <script>
            $(document).ready(function() {
                function formatRupiah(angka, prefix) {
                    var number_string = angka.replace(/[^,\d]/g, '').toString(),
                        split = number_string.split(','),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }

                    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                    return prefix === undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
                }

                // Initialize DataTables with server-side processing
                $('#biayaTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('biayas.siswa.data') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'siswa_name',
                            name: 'siswa_name'
                        },
                        {
                            data: 'siswa_class',
                            name: 'siswa_class'
                        },
                        {
                            data: 'kode_biaya',
                            name: 'kode_biaya'
                        },
                        {
                            data: 'nama_biaya',
                            name: 'nama_biaya'
                        },
                        {
                            data: 'jumlah',
                            name: 'jumlah',
                            render: function(data) {
                                return formatRupiah(data.toString(), 'Rp.');
                            }
                        },
                        {
                            data: 'periode',
                            name: 'periode',
                            render: function(data) {
                                return data === 'bulanan' ? 'Bulanan' : 'Tahunan';
                            }
                        },
                        {
                            data: 'status',
                            name: 'status',
                            render: function(data) {
                                return data === 'lunas' ?
                                    '<span class="badge badge-lunas">Lunas</span>' :
                                    '<span class="badge badge-belum-lunas">Belum Lunas</span>';
                            }
                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return `
                                <button class="btn btn-sm btn-primary btn-proses" data-id="${row.id}">
                                    <i class="fas fa-sync-alt fa-spin"></i> Proses Biaya
                                </button>

                            `;
                            }
                        }
                    ],
                    responsive: true,
                    lengthMenu: [5, 10, 25, 50, 100],
                    pageLength: 10,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Cari siswa atau biaya"
                    },
                    dom: '<"top"Bf>rt<"bottom"lp><"clear">',
                    buttons: [{
                            extend: 'copy',
                            text: '<i class="fas fa-copy"></i> Salin',
                            className: 'btn btn-sm btn-success'
                        },
                        {
                            extend: 'csv',
                            text: '<i class="fas fa-file-csv"></i> CSV',
                            className: 'btn btn-sm btn-info'
                        },
                        {
                            extend: 'excel',
                            text: '<i class="fas fa-file-excel"></i> Excel',
                            className: 'btn btn-sm btn-success'
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fas fa-file-pdf"></i> PDF',
                            className: 'btn btn-sm btn-danger'
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print"></i> Cetak',
                            className: 'btn btn-sm btn-primary'
                        }
                    ],
                    order: [
                        [1, 'asc']
                    ]
                });

                // Example handling for "Proses Biaya" button click
                $('#biayaTable').on('click', '.btn-proses', function() {
                    var biayaId = $(this).data('id');
                    Toastify({
                        text: "Memproses biaya untuk siswa ID: " + biayaId,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#4caf50",
                    }).showToast();
                });

                // Example handling for "Tambah Biaya Siswa" button click
                $('#biayaTable').on('click', '.btn-tambah', function() {
                    var siswaId = $(this).data('id');
                    Toastify({
                        text: "Menambah biaya untuk siswa ID: " + siswaId,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#f39c12",
                    }).showToast();
                });
                // Show modal when 'Tambah Biaya Siswa' button is clicked
                $('#tambahBiayaBtn').on('click', function() {
                    $('#biayaModal').modal('show');
                });

                // Save biaya when 'Simpan Biaya' button is clicked
                $('#saveBiayaBtn').on('click', function() {
                    var formData = {
                        namaSiswa: $('#namaSiswa').val(),
                        kelasSiswa: $('#kelasSiswa').val(),
                        kodeBiaya: $('#kodeBiaya').val(),
                        namaBiaya: $('#namaBiaya').val(),
                        jumlahBiaya: $('#jumlahBiaya').val(),
                        periodeBiaya: $('#periodeBiaya').val()
                    };

                    // Example of showing Toast notification for success
                    Toastify({
                        text: "Biaya berhasil disimpan!",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#4caf50",
                    }).showToast();

                    // Close modal after saving
                    $('#biayaModal').modal('hide');

                    // Reset form
                    $('#formBiaya')[0].reset();

                    // Optionally, you can trigger an AJAX request here to save the data to the server
                    // $.ajax({
                    //     url: '/path/to/your/api',
                    //     type: 'POST',
                    //     data: formData,
                    //     success: function(response) {
                    //         // Do something with the response
                    //     },
                    // });
                });
            });
        </script>
    @endpush
</x-default-layout>
