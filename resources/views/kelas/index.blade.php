<x-default-layout>
    @section('title', 'Kelas Management')

    @push('styles')
        <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    @endpush

    <div class="container mt-5">
        <div class="card shadow-sm rounded">
            <div class="card-body">
                <h2 class="mb-4">Kelas Management</h2>
                <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#createKelasModal">
                    <i class="fas fa-plus"></i> Add New Kelas
                </button>
                <table id="kelasTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kode Kelas</th>
                            <th>Kelas</th>
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

    <!-- Create Kelas Modal -->
    <div class="modal fade" id="createKelasModal" tabindex="-1" aria-labelledby="createKelasModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="kelasForm" action="{{ route('kelas.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createKelasModalLabel">Add New Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group mb-3">
                            <label for="kode_kelas">Kode Kelas</label>
                            <input type="text" class="form-control" id="kode_kelas" name="kode_kelas" maxlength="10" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="kelas">Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas" maxlength="125" required>
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
                $('#kelasTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('kelas.data') }}',
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'kode_kelas', name: 'kode_kelas' },
                        { data: 'kelas', name: 'kelas' },
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

                // Edit Kelas
                $(document).on('click', '.edit-kelas', function() {
                    var id = $(this).data('id');
                    $.ajax({
                        type: 'GET',
                        url: '/kelas/' + id + '/edit',
                        success: function(data) {
                            if (data.error) {
                                alert(data.error);
                            } else {
                                $('#kelasForm').attr('action', '/kelas/' + id);
                                $('#id').val(data.id);
                                $('#kode_kelas').val(data.kode_kelas);
                                $('#kelas').val(data.kelas);
                                $('#createKelasModal').modal('show');
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 404) {
                                alert('Kelas not found');
                            } else {
                                alert('An error occurred while fetching the data');
                            }
                        }
                    });
                });

                // Handle form submission
                $('#kelasForm').submit(function(event) {
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
                                url: '{{ route('kelas.store') }}',
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
                                        $('#createKelasModal').modal('hide');
                                        $('#kelasTable').DataTable().ajax.reload();
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
                                        text: 'Failed to create Kelas.',
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

                // Delete Kelas
                $(document).on('click', '.delete-kelas', function() {
                    var id = $(this).data('id');
                    var url = '/kelas/' + id;

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
                                        $('#kelasTable').DataTable().ajax.reload();
                                    }
                                },
                                error: function(xhr, status, error) {
                                    Swal.fire('Failed', 'Kelas deletion failed!', 'error');
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
</x-default-layout>
