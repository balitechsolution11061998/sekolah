<x-default-layout>
    @section('title', 'Mapel Management')

    @push('styles')
        <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    @endpush
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.css"
        integrity="sha512-VSD3lcSci0foeRFRHWdYX4FaLvec89irh5+QAGc00j5AOdow2r5MFPhoPEYBUQdyarXwbzyJEO7Iko7+PnPuBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="container mt-5">
        <div class="card shadow-sm rounded">
            <div class="card-body">
                <h2 class="mb-4">Mapel Management</h2>
                <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#createMapelModal">
                    <i class="fas fa-plus"></i> Add New Mapel
                </button>
                <table id="mapelTable" class=" table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tahun Pelajaran</th>
                            <th>Nama Mapel</th>
                            <th>Ringkasan Mapel</th>
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

    <!-- Create Mapel Modal -->
    <div class="modal fade" id="createMapelModal" tabindex="-1" aria-labelledby="createMapelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="mapelForm" action="{{ route('mapels.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createMapelModalLabel">
                            <i class="fas fa-plus-circle"></i> Add New Mapel
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group mb-3">
                            <label for="tapel_id">
                                <i class="fas fa-calendar-alt"></i> Tapel ID
                            </label>
                            <select class="form-control" id="tapel_id" name="tapel_id" required>
                                <option value="">Select Tapel</option>
                                @foreach($tapels as $tapel)
                                    <option value="{{ $tapel->id }}">{{ $tapel->kode_tahun }} - {{ $tapel->tahun }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama_mapel">
                                <i class="fas fa-book"></i> Nama Mapel
                            </label>
                            <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="ringkasan_mapel">
                                <i class="fas fa-file-alt"></i> Ringkasan Mapel
                            </label>
                            <textarea class="form-control" id="ringkasan_mapel" name="ringkasan_mapel" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.js"
    integrity="sha512-MnKz2SbnWiXJ/e0lSfSzjaz9JjJXQNb2iykcZkEY2WOzgJIWVqJBFIIPidlCjak0iTH2bt2u1fHQ4pvKvBYy6Q=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function() {
                // Initialize DataTables with Bootstrap 5 styling
                $('#mapelTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('mapels.data') }}',
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'tapel', name: 'tapel.tahun' }, // Updated to show tapel details
                        { data: 'nama_mapel', name: 'nama_mapel' },
                        { data: 'ringkasan_mapel', name: 'ringkasan_mapel' },
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

                // Edit Mapel
                $(document).on('click', '.edit-mapel', function() {
                    var id = $(this).data('id');
                    $.ajax({
                        type: 'GET',
                        url: '/mapels/' + id + '/edit',
                        success: function(data) {
                            if (data.error) {
                                alert(data.error);
                            } else {
                                $('#mapelForm').attr('action', '/ mapels/' + id);
                                $('#id').val(data.id);
                                $('#tapel_id').val(data.tapel_id);
                                $('#nama_mapel').val(data.nama_mapel);
                                $('#ringkasan_mapel').val(data.ringkasan_mapel);
                                $('#createMapelModal').modal('show');
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 404) {
                                alert('Mapel not found');
                            } else {
                                alert('An error occurred while fetching the data');
                            }
                        }
                    });
                });

                // Handle form submission
                $('#mapelForm').submit(function(event) {
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
                                url: '{{ route('mapels.store') }}',
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
                                        $('#createMapelModal').modal('hide');
                                        $('#mapelTable').DataTable().ajax.reload();
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
                                        text: 'Failed to create Mapel.',
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

                // Delete Mapel
                $(document).on('click', '.delete-mapel', function() {
                    var id = $(this).data('id');
                    var url = '/mapels/' + id;

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
                                        $('#mapelTable').DataTable().ajax.reload();
                                    }
                                },
                                error: function(xhr, status, error) {
                                    Swal.fire('Failed', 'Mapel deletion failed!', 'error');
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
</x-default-layout>
