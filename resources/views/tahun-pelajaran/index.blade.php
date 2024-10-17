<x-default-layout>
    @section('title', 'Tahun Pelajaran Management')

    @push('styles')
        <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    @endpush

    <div class="container mt-5">
        <div class="card shadow-sm rounded">
            <div class="card-body">
                <h2 class="mb-4">Tahun Pelajaran Management</h2>
                <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#createTahunModal">
                    <i class="fas fa-plus"></i> Add New Tahun Pelajaran
                </button>
                <table id="tahunTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kode Tahun</th>
                            <th>Tahun</th>
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

    <!-- Create Tahun Pelajaran Modal -->
    <div class="modal fade" id="createTahunModal" tabindex="-1" aria-labelledby="createTahunModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="tahunForm" action="{{ route('tahun-pelajarans.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createTahunModalLabel">Add New Tahun Pelajaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group mb-3">
                            <label for="kode_tahun">Kode Tahun</label>
                            <input type="text" class="form-control" id="kode_tahun" name="kode_tahun" maxlength="10" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tahun">Tahun</label>
                            <input type="text" class="form-control" id="tahun" name="tahun" maxlength="125" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <!-- Include jQuery and Bootstrap 5 JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Include DataTables and DataTables Bootstrap 5 JS -->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <!-- Include jQuery Validate -->
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
        <!-- Include SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.js"></script>
        <!-- Include Toastify -->
        <script src="https://cdn.jsdelivr.net/npm/toastify-js@1.11.2/src/toastify.min.js"></script>

        <script>
            $(document).ready(function() {
                // Initialize DataTables with Bootstrap 5 styling
                $('#tahunTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('tahun-pelajarans.data') }}',
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'kode_tahun', name: 'kode_tahun' },
                        { data: 'tahun', name: 'tahun' },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    responsive: true,
                    lengthMenu: [5, 10, 25, 50, 100],
                    pageLength: 10,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search records"
                    },
                    dom: '<"top"Bf>rt<"bottom"lp><"clear">',
                    buttons: [
                        { extend: 'copy', text: '<i class="fas fa-copy"></i> Copy', className: 'btn btn-sm btn-success' },
                        { extend: 'csv', text: '<i class="fas fa-file-csv"></i> CSV', className: 'btn btn-sm btn-info' },
                        { extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', className: 'btn btn-sm btn-success' },
                        { extend: 'pdf', text: '<i class="fas fa-file-pdf"></i> PDF', className: 'btn btn-sm btn-danger' },
                        { extend: 'print', text: '<i class="fas fa-print"></i> Print', className: 'btn btn-sm btn-primary' }
                    ],
                    order: [
                        [1, 'asc']
 ]
                });

                // Edit Tahun Pelajaran
                $(document).on('click', '.edit-tahun', function() {
                    var id = $(this).data('id');
                    $.ajax({
                        type: 'GET',
                        url: '/tahun-pelajarans/' + id + '/edit',
                        success: function(data) {
                            if (data.error) {
                                alert(data.error);
                            } else {
                                $('#tahunForm').attr('action', '/tahun-pelajarans/' + id);
                                $('#id').val(data.id);
                                $('#kode_tahun').val(data.kode_tahun);
                                $('#tahun').val(data.tahun);
                                $('#createTahunModal').modal('show');
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 404) {
                                alert('Tahun Pelajaran not found');
                            } else {
                                alert('An error occurred while fetching the data');
                            }
                        }
                    });
                });

                // Handle form submission
                $('#tahunForm').submit(function(event) {
                    event.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this action!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, submit it!',
                        cancelButtonText: 'No, keep it'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'POST',
                                url: '{{ route('tahun-pelajarans.store') }}',
                                data: $(this).serialize(),
                                success: function(response) {
                                    if (response.success) {
                                        Toastify({
                                            text: response.message,
                                            duration: 3000,
                                            gravity: 'top',
                                            position: 'right',
                                            backgroundColor: 'linear-gradient(to right, #00b09b, #96c93d)',
                                        }).showToast();
                                        $('#createTahunModal').modal('hide');
                                        $('#tahunTable').DataTable().ajax.reload();
                                    } else {
                                        Toastify({
                                            text: response.message,
                                            duration: 3000,
                                            gravity: 'top',
                                            position: 'right',
                                            backgroundColor: 'linear-gradient(to right, #FF69B4, #FFC0CB)',
                                        }).showToast();
                                    }
                                },
                                error: function(xhr, status, error) {
                                    Toastify({
                                        text: 'Failed to create Tahun Pelajaran.',
                                        duration: 3000,
                                        gravity: 'top',
                                        position: 'right',
                                        backgroundColor: 'linear-gradient(to right, #FF69B4, #FFC0CB)',
                                    }).showToast();
                                }
                            });
                        }
                    });
                });

                // Delete Tahun Pelajaran
                $(document).on('click', '.delete-tahun', function() {
                    var id = $(this).data('id');
                    var url = '/tahun-pelajarans/' + id;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'DELETE',
                                url: url,
                                data: { _token: '{{ csrf_token() }}' },
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire('Deleted!', 'Your record has been deleted.', 'success');
                                        $('#tahunTable').DataTable().ajax.reload();
                                    }
                                },
                                error: function(xhr, status, error) {
                                    Swal.fire('Failed', 'Tahun Pelajaran deletion failed!', 'error');
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
</x-default-layout>
