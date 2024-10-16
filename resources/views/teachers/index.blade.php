<x-default-layout>
    @section('title')
        Teacher Management
    @endsection
    <style>
        /* Custom styles for Dropzone */
        #my-dropzone {
            border: 2px dashed #007bff;
            /* Bootstrap primary color */
            border-radius: 0.5rem;
            background: #f9f9f9;
            /* Light background for the dropzone */
            padding: 20px;
            text-align: center;
        }

        #my-dropzone .dz-message {
            font-weight: bold;
            color: #007bff;
        }

        /* Progress bar styling */
        .progress {
            height: 20px;
        }

        .badge {
            padding: 0.5em 1em;
            /* Add padding for better appearance */
            border-radius: 0.25rem;
            /* Rounded corners */
            font-size: 0.875rem;
            /* Adjust font size */
            font-weight: 600;
            /* Make text bold */
            text-transform: uppercase;
            /* Uppercase text */
        }

        .badge.bg-success {
            background-color: #28a745;
            /* Green for active */
            color: #fff;
            /* White text */
        }

        .badge.bg-danger {
            background-color: #dc3545;
            /* Red for inactive */
            color: #fff;
            /* White text */
        }

        .card-header {
            background-color: #007bff;
            color: white;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 123, 255, 0.05);
        }

        .btn-primary,
        .btn-primary:hover {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-secondary,
        .btn-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        #my-dropzone {
            border: 2px dashed #007bff;
            border-radius: 5px;
            background: #f9f9f9;
            padding: 20px;
            text-align: center;
            color: #007bff;
        }

        .progress-bar {
            background-color: #007bff;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/css/lightbox.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.css"
        integrity="sha512-VSD3lcSci0foeRFRHWdYX4FaLvec89irh5+QAGc00j5AOdow2r5MFPhoPEYBUQdyarXwbzyJEO7Iko7+PnPuBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="container my-5">
        <div class="card my-4 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Teachers</h4>
                <button type="button" class="btn btn-primary btn-sm" onclick="showCreateTeacherModal()">
                    <i class="fas fa-plus"></i> Add Teacher
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered align-middle" id="teachers_table">
                        <thead class="bg-light">
                            <tr class="text-muted fw-bold text-uppercase">
                                <th class="text-center">#</th>
                                <th>Name</th>
                                <th>Title</th>
                                <th>NIP</th>
                                <th>Gender</th>
                                <th>Birth Place</th>
                                <th>Birth Date</th>
                                <th>NUPTK</th>
                                <th>Address</th>

                                <th class="text-center">Profile Photo</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Populated by DataTables -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Teacher Modal for Create/Edit -->
        <div class="modal fade" id="teacherModal" tabindex="-1" aria-labelledby="teacherModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="teacherModalLabel">Add Teacher</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="teacherForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" id="id" name="id">

                            <!-- Profile Photo Upload -->
                            <div class="mb-3">
                                <label for="profile_photo" class="form-label">Profile Photo</label>
                                <div id="my-dropzone" class="dropzone">Drag and drop a file here or click</div>
                                <div id="progress-container" style="display: none;">
                                    <div class="progress">
                                        <div id="progress-bar" class="progress-bar" role="progressbar" aria-valuenow="0"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div id="preview" class="mt-2"></div>
                                <input type="hidden" id="profile_photo_url" name="profile_photo_url">
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="nama_lengkap" class="form-label">Full Name</label>
                                    <div class="input-group">
                                        <select id="user_id" name="user_id" class="form-select">
                                            <option value="">Select Guru...</option>
                                            @foreach ($gurus as $guru)
                                                <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                </div>


                            </div>

                            <!-- Full Name -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_lengkap" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                        required>
                                </div>

                                <!-- Degree/Title -->
                                <div class="col-md-6 mb-3">
                                    <label for="gelar" class="form-label">Degree/Title</label>
                                    <input type="text" class="form-control" id="gelar" name="gelar"
                                        maxlength="10">
                                </div>
                            </div>

                            <!-- NIP -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nip" class="form-label">NIP</label>
                                    <input type="text" class="form-control" id="nip" name="nip"
                                        maxlength="18">
                                </div>

                                <!-- NUPTK -->
                                <div class="col-md-6 mb-3">
                                    <label for="nuptk" class="form-label">NUPTK</label>
                                    <input type="text" class="form-control" id="nuptk" name="nuptk"
                                        maxlength="16">
                                </div>
                            </div>

                            <!-- Place and Date of Birth -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tempat_lahir" class="form-label">Place of Birth</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                        maxlength="30" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_lahir" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="tanggal_lahir"
                                        name="tanggal_lahir" required>
                                </div>
                            </div>

                            <!-- Gender -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="jenis_kelamin" class="form-label">Gender</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="">Select Gender...</option>
                                        <option value="L">Male</option>
                                        <option value="P">Female</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Address</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <!-- DataTables & Bootstrap Integration -->
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/js/lightbox.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.js"
            integrity="sha512-MnKz2SbnWiXJ/e0lSfSzjaz9JjJXQNb2iykcZkEY2WOzgJIWVqJBFIIPidlCjak0iTH2bt2u1fHQ4pvKvBYy6Q=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            // Set up CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Initialize Dropzone
            Dropzone.options.myDropzone = {
                url: "/upload", // Replace with your upload URL
                maxFilesize: 2, // Maximum file size in MB
                acceptedFiles: "image/*", // Accept only images
                init: function() {
                    const progressContainer = document.getElementById('progress-container');
                    this.on("sending", function(file, xhr, formData) {
                        const token = $('meta[name="csrf-token"]').attr('content');
                        formData.append('_token', token);
                    });
                    this.on("addedfile", function() {
                        progressContainer.style.display = 'block';
                    });

                    this.on("uploadprogress", function(file, progress) {
                        const progressBar = document.getElementById('progress-bar');
                        progressBar.style.width = progress + '%';
                        progressBar.setAttribute('aria-valuenow', progress);
                    });

                    this.on("success", function(file, response) {
                        console.log("File uploaded successfully:", response);
                        $('#profile_photo_url').val(response.filePath);
                        const preview = document.getElementById('preview');
                        const img = document.createElement('img');
                        img.src = response.filePath; // Adjust according to your response
                        img.classList.add('img-thumbnail', 'mt-2');
                        img.style.maxWidth = '200px';
                        preview.innerHTML = ''; // Clear previous previews
                        preview.appendChild(img);

                        progressContainer.style.display = 'none';
                        const progressBar = document.getElementById('progress-bar');
                        progressBar.style.width = '0%';
                        progressBar.setAttribute('aria-valuenow', '0'); // Reset value
                    });

                    this.on("error", function(file, errorMessage) {
                        console.error("Error uploading file:", errorMessage);

                        Toastify({
                            text: "Error uploading file: " + errorMessage,
                            duration: 3000,
                            gravity: "top",
                            position: 'right',
                            backgroundColor: "linear-gradient(to right, #FF5F6D, #FFC371)",
                        }).showToast();

                        progressContainer.style.display = 'none';
                        const progressBar = document.getElementById('progress-bar');
                        progressBar.style.width = '0%'; // Reset progress bar
                        progressBar.setAttribute('aria-valuenow', '0'); // Reset value
                    });
                }
            };

            function showCreateTeacherModal() {
                $('#teacherModalLabel').text('Add Teacher');
                $('#teacherForm').trigger('reset'); // Reset the form
                $('#teacherModal').modal('show');
            }

            $(document).ready(function() {




                $("#teacherForm").validate({
                    rules: {
                        nama_lengkap: "required",
                        gelar: "required",
                        nip: "required",
                        nuptk: "required",
                        jenis_kelamin: "required",
                        tempat_lahir: "required",
                        tanggal_lahir: "required",
                        alamat: "required",
                        nomor_handphone: "required",
                        email: {
                            required: true,
                            email: true
                        }
                    },
                    messages: {
                        nama_lengkap: "Please enter full name",
                        gelar: "Please enter title (Gelar)",
                        nip: "Please enter NIP",
                        nuptk: "Please enter NUPTK",
                        jenis_kelamin: "Please select gender",
                        tempat_lahir: "Please enter place of birth",
                        tanggal_lahir: "Please select date of birth",
                        alamat: "Please enter address",
                        nomor_handphone: "Please enter phone number",
                        email: {
                            required: "Please enter email",
                            email: "Please enter a valid email"
                        }
                    },
                    highlight: function(element) {
                        $(element).css("border-color", "red"); // Set border color to red for invalid fields
                    },
                    unhighlight: function(element) {
                        $(element).css("border-color", ""); // Reset border color for valid fields
                    },
                    submitHandler: function(form) {
                        // Prevent default form submission

                        // Trigger Swal confirmation dialog
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "Do you want to save this teacher's information?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, save it!',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Form is valid, now submit via AJAX
                                var formData = new FormData(form); // Create FormData object
                                formData.append('_token', '{{ csrf_token() }}');

                                $.ajax({
                                    type: 'POST',
                                    url: '{{ route('teachers.store') }}', // Use the route name
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    success: function(response) {
                                        // Show success toast notification
                                        Toastify({
                                            text: "Teacher saved successfully!",
                                            duration: 3000,
                                            gravity: "top",
                                            position: 'right',
                                            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                                        }).showToast();

                                        // Close the modal
                                        $('#teacherModal').modal('hide');

                                        // Reload the teachers table
                                        $('#teachers_table').DataTable().ajax.reload();
                                    },
                                    error: function(xhr, status, error) {
                                        // Show error toast notification
                                        Toastify({
                                            text: "Error saving teacher: " + xhr
                                                .responseText,
                                            duration: 3000,
                                            gravity: "top",
                                            position: 'right',
                                            backgroundColor: "linear-gradient(to right, #FF5F6D, #FFC371)",
                                        }).showToast();
                                    }
                                });
                            }
                        });
                    }
                });


                // Initialize DataTable with Bootstrap integration and buttons
                // Initialize DataTable with Bootstrap integration and buttons
                var table = $('#teachers_table').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: "{{ route('teachers.data') }}", // Adjust your route here as needed
                    columns: [{
                            data: 'id',
                            name: 'id',
                            className: 'text-center'
                        },
                        {
                            data: 'nama_lengkap',
                            name: 'nama_lengkap'
                        },
                        {
                            data: 'gelar',
                            name: 'gelar'
                        },
                        {
                            data: 'nip',
                            name: 'nip'
                        },
                        {
                            data: 'jenis_kelamin',
                            name: 'jenis_kelamin',
                            render: function(data, type, row) {
                                // Display L for 'Laki-laki' and P for 'Perempuan'
                                return data === 'L' ? 'Laki-laki' : 'Perempuan';
                            }
                        },
                        {
                            data: 'tempat_lahir',
                            name: 'tempat_lahir'
                        },
                        {
                            data: 'tanggal_lahir',
                            name: 'tanggal_lahir',
                            render: function(data) {
                                // Format the date (if needed)
                                var date = new Date(data);
                                return date.toLocaleDateString(); // Change formatting as needed
                            }
                        },
                        {
                            data: 'nuptk',
                            name: 'nuptk'
                        },
                        {
                            data: 'alamat',
                            name: 'alamat'
                        },
                        {
                            data: 'avatar',
                            name: 'avatar',
                            className: 'text-center',
                            render: function(data, type, row) {
                                return `<a href="${data}" data-lightbox="avatar" data-title="${row.nama_lengkap}"><img src="${data}" width="50" height="50"></a>`;
                            }
                        },
                        {
                            data: 'id',
                            name: 'actions',
                            orderable: false,
                            searchable: false,
                            className: 'text-center',
                            render: function(data, type, row) {
                                return `
                    <button class="btn btn-sm btn-warning edit-btn" data-id="${row.id}" title="Edit"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}" title="Delete"><i class="fas fa-trash"></i></button>
                `;
                            }
                        }
                    ],
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'copy',
                            className: 'btn btn-outline-secondary btn-sm',
                            text: '<i class="fas fa-copy"></i> Copy',
                            titleAttr: 'Copy to clipboard'
                        },
                        {
                            extend: 'csv',
                            className: 'btn btn-outline-success btn-sm',
                            text: '<i class="fas fa-file-csv"></i> CSV',
                            titleAttr: 'Download as CSV'
                        },
                        {
                            extend: 'excel',
                            className: 'btn btn-outline-info btn-sm',
                            text: '<i class="fas fa-file-excel"></i> Excel',
                            titleAttr: 'Download as Excel'
                        },
                        {
                            extend: 'pdf',
                            className: 'btn btn-outline-danger btn-sm',
                            text: '<i class="fas fa-file-pdf"></i> PDF',
                            titleAttr: 'Download as PDF'
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-outline-primary btn-sm',
                            text: '<i class="fas fa-print"></i> Print',
                            titleAttr: 'Print this table'
                        }
                    ],
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search Teachers...",
                        lengthMenu: "Show _MENU_ teachers",
                        info: "Showing _START_ to _END_ of _TOTAL_ teachers",
                    },
                    order: [
                        [0, 'asc']
                    ],
                    initComplete: function() {
                        // Wrap the table in a responsive div
                        $('#teachers_table').wrap('<div class="table-responsive"></div>');
                    }
                });


                // Handle delete button click
                $('#teachers_table').on('click', '.delete-btn', function() {
                    var teacherId = $(this).data('id');

                    // Show SweetAlert confirmation
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Perform the AJAX delete request
                            $.ajax({
                                url: '{{ route('teachers.destroy', '') }}/' + teacherId,
                                type: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                },
                                success: function(response) {
                                    // Refresh the DataTable
                                    table.ajax.reload();

                                    // Show success notification with Toastify
                                    Toastify({
                                        text: response.message ||
                                            "Teacher deleted successfully",
                                        duration: 3000,
                                        gravity: "top",
                                        position: "right",
                                        backgroundColor: "#28a745",
                                        stopOnFocus: true,
                                    }).showToast();
                                    $('#teachers_table').DataTable().ajax.reload();
                                },
                                error: function(xhr) {
                                    // Show error notification
                                    Toastify({
                                        text: "An error occurred. Please try again.",
                                        duration: 3000,
                                        gravity: "top",
                                        position: "right",
                                        backgroundColor: "#dc3545",
                                        stopOnFocus: true,
                                    }).showToast();
                                }
                            });
                        }
                    });
                });
                // Handle the edit button click
                $('#teachers_table').on('click', '.edit-btn', function() {
                    var teacherId = $(this).data('id');

                    // Show a loading notification while fetching the data
                    Toastify({
                        text: 'Loading teacher data...',
                        duration: 2000,
                        gravity: 'top',
                        position: 'right',
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)"
                    }).showToast();

                    // Fetch the teacher data using AJAX
                    $.ajax({
                        url: '/teachers/' + teacherId + '/edit', // API route to fetch teacher data
                        type: 'GET',
                        success: function(response) {
                            if (response.success && response.data) {
                                // Populate the form with the fetched teacher data
                                $('#id').val(response.data.id);
                                $('#nama_lengkap').val(response.data.nama_lengkap);
                                $('#gelar').val(response.data.gelar);
                                $('#nip').val(response.data.nip);
                                $('#jenis_kelamin').val(response.data.jenis_kelamin);
                                $('#tempat_lahir').val(response.data.tempat_lahir);
                                $('#tanggal_lahir').val(response.data.tanggal_lahir);
                                $('#nuptk').val(response.data.nuptk);
                                $('#alamat').val(response.data.alamat);
                                $('#profile_photo_url').val(response.data.avatar);
                                $('#user_id').val(response.data.user_id);

                                // Show the modal with the populated data
                                $('#teacherModal').modal('show');

                                // Show success notification
                                Toastify({
                                    text: 'Teacher data loaded successfully!',
                                    duration: 3000,
                                    gravity: 'top',
                                    position: 'right',
                                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)"
                                }).showToast();
                            } else {
                                // If the response does not contain data, show an error message
                                Toastify({
                                    text: 'Failed to load teacher data. Please try again.',
                                    duration: 3000,
                                    gravity: 'top',
                                    position: 'right',
                                    backgroundColor: "linear-gradient(to right, #FF5F6D, #FF6D6D)"
                                }).showToast();
                            }
                        },
                        error: function(xhr, status, error) {
                            // Log the error to the console for debugging (optional)
                            console.error('Error fetching teacher data:', xhr, status, error);

                            // Show error notification with Toastify
                            Toastify({
                                text: 'Error fetching teacher data. Please try again later.',
                                duration: 3000,
                                gravity: 'top',
                                position: 'right',
                                backgroundColor: "linear-gradient(to right, #FF5F6D, #FF6D6D)"
                            }).showToast();
                        }
                    });
                });


            });
        </script>
    @endpush
</x-default-layout>
