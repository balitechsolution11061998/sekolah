<x-default-layout>
    @section('title', 'Biaya Management for Siswa')

    @push('styles')
        <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

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
                <div class="table-responsive">
                    <table id="biayaTable" class="table table-striped table-bordered table-hover" style="width:100%">
                        <thead class="thead-light">
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
                        <!-- Nama Siswa -->
                        <div class="mb-3">
                            <label for="namaSiswa" class="form-label">Nama Siswa</label>
                            <select class="form-select" name="siswa_id" id="siswa_id" data-control="select2"
                                data-placeholder="Select a student" required>
                                <option></option>
                            </select>
                        </div>

                        <!-- Kode Biaya -->
                        <div class="mb-3">
                            <label for="kodeBiaya" class="form-label">Kode Biaya</label>
                            <select class="form-select" id="kodeBiaya" name="biaya_id" data-control="select2" required>
                                <option value="">Select Biaya</option>
                            </select>
                        </div>

                        <!-- Jumlah Biaya -->
                        <div class="mb-3">
                            <label for="jumlahBiaya" class="form-label">Jumlah Biaya</label>
                            <input type="number" class="form-control" id="jumlahBiaya" name="jumlah"
                                placeholder="Masukkan jumlah biaya" required>
                        </div>

                        <!-- Periode -->
                        <div class="mb-3">
                            <label for="periodeBiaya" class="form-label">Periode</label>
                            <select class="form-select" id="periodeBiaya" name="periode" required>
                                <option value="bulanan">Bulanan</option>
                                <option value="tahunan">Tahunan</option>
                            </select>
                        </div>

                        <!-- Tanggal Mulai -->
                        <div class="mb-3">
                            <label for="tanggalMulai" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggalMulai" name="tanggal_mulai" required>
                        </div>

                        <!-- Tanggal Akhir -->
                        <div class="mb-3">
                            <label for="tanggalAkhir" class="form-label">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="tanggalAkhir" name="tanggal_akhir">
                        </div>

                        <!-- Status Pembayaran -->
                        <div class="mb-3">
                            <label for="statusBiaya" class="form-label">Status Pembayaran</label>
                            <select class="form-select" id="statusBiaya" name="status" required>
                                <option value="belum_lunas">Belum Lunas</option>
                                <option value="lunas">Lunas</option>
                            </select>
                        </div>

                        <!-- Is Angsur -->
                        <div class="mb-3">
                            <label for="isAngsur" class="form-label">Apakah Pembayaran Angsur?</label>
                            <select class="form-select" id="isAngsur" name="is_angsur">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>

                        <!-- Jumlah Angsuran -->
                        <div class="mb-3" id="angsurFields" style="display:none;">
                            <div class="mb-3">
                                <label for="jumlahAngsuran" class="form-label">Jumlah per Angsuran</label>
                                <input type="number" class="form-control" id="jumlahAngsuran" name="jumlah_angsur"
                                    placeholder="Masukkan jumlah per angsuran">
                            </div>
                            <div class="mb-3">
                                <label for="totalAngsuran" class="form-label">Total Angsuran</label>
                                <input type="number" class="form-control" id="totalAngsuran"
                                    name="jumlah_angsuran_total" placeholder="Masukkan total angsuran">
                            </div>
                            <div class="mb-3">
                                <label for="angsuranTerbayar" class="form-label">Angsuran Terbayar</label>
                                <input type="number" class="form-control" id="angsuranTerbayar"
                                    name="angsuran_terbayar"
                                    placeholder="Masukkan jumlah angsuran yang telah terbayar">
                            </div>
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
        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function() {

                // Initialize Select2 for the siswa and biaya selects with server-side processing
                $('#isAngsur').on('change', function() {
                    if ($(this).val() == '1') {
                        $('#angsurFields').show(); // Show installment fields
                        $('#angsuranTerbayar').val(0);
                    } else {
                        $('#angsurFields').hide(); // Hide installment fields
                        $('#angsuranTerbayar').val(0);
                    }
                });

                $('#siswa_id').select2({
                    placeholder: "Select a student",
                    dropdownParent: $('#biayaModal'), // Ensure the dropdown stays inside the modal
                    allowClear: true,
                    ajax: {
                        url: '{{ route('students.select') }}', // Your route to fetch the siswa data
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term // Send the search term to the server
                            };
                        },
                        processResults: function(data) {
                            // Assuming your data is an array of objects with `id`, `nama_lengkap`, and `nisn`
                            return {
                                results: data.map(function(siswa) {
                                    return {
                                        id: siswa.id,
                                        text: siswa.nama_lengkap + ' (' + siswa.nisn +
                                            ')' // Format: "name (nisn)"
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                });




                $('#kodeBiaya').select2({
                    placeholder: "Select Biaya",
                    dropdownParent: $('#biayaModal'), // Keep it inside the modal
                    allowClear: true,
                    ajax: {
                        url: '{{ route('biayas.select') }}', // Your route to fetch the biaya data
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term // Send the search term to the server
                            };
                        },
                        processResults: function(data) {
                            // Assuming your data is an array of objects with `id` and `name` (or other properties)
                            return {
                                results: data.map(function(biaya) {
                                    return {
                                        id: biaya.id,
                                        text: biaya
                                            .text // Use the appropriate field for the display text
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                });



                // Format Rupiah function
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
                    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
                }

                // DataTable initialization
                $('#biayaTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
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
                                return `<button class="btn btn-sm btn-primary btn-proses" data-id="${row.id}">
                                    <i class="fas fa-sync-alt fa-spin"></i> Proses Biaya
                                </button>`

                                ;
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

                // Add Biaya button click event
                $('#tambahBiayaBtn').click(function() {
                    $('#biayaModal').modal('show');
                });

                // Save Biaya button click event
                $('#saveBiayaBtn').on('click', function() {
                    // Assuming you have validation checks here

                    // Show SweetAlert confirmation
                    Swal.fire({
                        title: 'Konfirmasi',
                        text: "Apakah Anda yakin ingin menyimpan biaya ini?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, simpan!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Here you can handle the form data submission
                            // For example, using AJAX to send data to the server

                            // Show Toastify notification
                            // Get form data
                            var formData = new FormData($('#formBiaya')[0]);

                            // Send data to server using AJAX
                            $.ajax({
                                type: 'POST',
                                url: '/biayas/siswa/store', // Replace with your URL
                                data: formData,
                                cache: false,
                                processData: false,
                                contentType: false,
                                success: function(data) {
                                    // Display Toastify notification on success
                                    Toastify({
                                        text: "Biaya berhasil disimpan!",
                                        duration: 3000,
                                        gravity: "top", // `top` or `bottom`
                                        position: 'right', // `left`, `center` or `right`
                                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                                    }).showToast();

                                    // Close the modal
                                    $('#biayaModal').modal('hide');
                                },
                                error: function(xhr, status, error) {
                                    console.log(xhr.responseText);
                                }
                            });

                            // Close the modal
                            $('#biayaModal').modal('hide');
                        }
                    });
                });
            });
        </script>
    @endpush
</x-default-layout>
