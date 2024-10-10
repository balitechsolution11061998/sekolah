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
        .btn-primary, .btn-primary:hover {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-secondary, .btn-secondary:hover {
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
                                    <th>NIK</th>
                                    <th>NUPTK</th>
                                    <th>Phone Number</th>
                                    <th>Status</th>
                                    <th>Position</th>
                                    <th class="text-center">Profile Photo</th>
                                    <th class="text-center">Email</th>
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
                                    <div id="preview" class="mt-2"></div>
                                    <input type="hidden" id="profile_photo_url" name="profile_photo_url">

                                    <div id="progress-container" class="progress mt-2" style="display: none;">
                                        <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;"
                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <!-- Additional Fields for Teacher Details -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_lengkap" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                            required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="nik" class="form-label">NIK</label>
                                        <input type="text" class="form-control" id="nik" name="nik" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nuptk" class="form-label">NUPTK</label>
                                        <input type="text" class="form-control" id="nuptk" name="nuptk" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="status_kepegawaian" class="form-label">Employment Status</label>
                                        <input type="text" class="form-control" id="status_kepegawaian"
                                            name="status_kepegawaian" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_lahir" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                            required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="nomor_handphone" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" id="nomor_handphone"
                                            name="nomor_handphone" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="jenis_kelamin" class="form-label">Gender</label>
                                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="tugas" class="form-label">Position</label>
                                        <input type="text" class="form-control" id="tugas" name="tugas" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="penempatan" class="form-label">Placement</label>
                                        <input type="text" class="form-control" id="penempatan" name="penempatan"
                                            required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="email_madrasah" class="form-label">Madrasah Email</label>
                                        <input type="email" class="form-control" id="email_madrasah"
                                            name="email_madrasah">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="password_awal" class="form-label">Initial Password</label>
                                        <input type="password" class="form-control" id="password_awal" name="password_awal"
                                            required>
                                    </div>
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
                    // Show the progress bar container initially hidden
                    const progressContainer = document.getElementById('progress-container');
                    progressContainer.style.display = 'none'; // Hide initially
                    this.on("sending", function(file, xhr, formData) {
                        // Add CSRF token to the form data
                        const token = $('meta[name="csrf-token"]').attr('content');
                        formData.append('_token', token);
                    });
                    this.on("addedfile", function() {
                        // Show the progress bar when a file is added
                        progressContainer.style.display = 'block';
                    });

                    this.on("uploadprogress", function(file, progress) {
                        // Update the progress bar
                        const progressBar = document.getElementById('progress-bar');
                        progressBar.style.width = progress + '%';
                        progressBar.setAttribute('aria-valuenow', progress);
                    });

                    this.on("success", function(file, response) {
                        console.log("File uploaded successfully:", response);
                        $('#profile_photo_url').val(response.filePath);
                        // Display uploaded image in the preview area
                        const preview = document.getElementById('preview');
                        const img = document.createElement('img');
                        img.src = response.filePath; // Adjust according to your response
                        img.classList.add('img-thumbnail', 'mt-2');
                        img.style.maxWidth = '200px';
                        preview.innerHTML = ''; // Clear previous previews
                        preview.appendChild(img);

                        // Hide the progress bar and reset it
                        progressContainer.style.display = 'none';
                        const progressBar = document.getElementById('progress-bar');
                        progressBar.style.width = '0%';
                        progressBar.setAttribute('aria-valuenow', '0'); // Reset value
                    });

                    this.on("error", function(file, errorMessage) {
                        console.error("Error uploading file:", errorMessage);

                        // Show error toast notification
                        Toastify({
                            text: "Error uploading file: " + errorMessage,
                            duration: 3000,
                            gravity: "top",
                            position: 'right',
                            backgroundColor: "linear-gradient(to right, #FF5F6D, #FFC371)",
                        }).showToast();

                        // Hide the progress bar
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
                        nik: "required",
                        nuptk: "required",
                        status_kepegawaian: "required",
                        jenis_kelamin: "required",
                        tugas: "required",
                        penempatan: "required",
                        tanggal_lahir: "required",
                        nomor_handphone: "required",
                        email: {
                            required: true,
                            email: true
                        }
                    },
                    messages: {
                        nama_lengkap: "Please enter full name",
                        nik: "Please enter NIK",
                        nuptk: "Please enter Nuptk",
                        status_kepegawaian: "Please enter status kepegawaian",
                        jenis_kelamin: "Please select jenis kelamin",
                        tugas: "Please enter tugas",
                        penempatan: "Please enter penempatan",
                        tanggal_lahir: "Please select tanggal lahir",
                        nomor_handphone: "Please enter nomor handphone",
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
                            console.log(result);
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
                                        console.log("Teacher saved successfully:",
                                            response);
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
                                        console.error("Error saving teacher:", error);
                                        // Show error toast notification
                                        Toastify({
                                            text: "Error saving teacher: " +
                                                error,
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
                    ajax: "{{ route('teachers.data') }}",
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
                            data: 'nik',
                            name: 'nik'
                        },
                        {
                            data: 'nuptk',
                            name: 'nuptk'
                        },
                        {
                            data: 'nomor_handphone',
                            name: 'nomor_handphone'
                        },
                        {
                            data: 'status_kepegawaian',
                            name: 'status_kepegawaian'
                        },
                        {
                            data: 'tugas',
                            name: 'tugas'
                        },
                        {
                            data: 'foto_profile',
                            name: 'foto_profile',
                            className: 'text-center',
                            render: function(data, type, row) {
                                return `<a href="${data}" data-lightbox="foto-profile" data-title="${row.nama_lengkap}"><img src="${data}" width="50" height="50"></a>`;
                            }
                        },
                        {
                            data: 'email',
                            name: 'email',
                            className: 'text-center'
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

                    // Show a loading spinner while fetching data
                    Toastify({
                        text: 'Loading teacher data...',
                        duration: 2000,
                        gravity: 'top',
                        position: 'right',
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)"
                    }).showToast();

                    // Fetch the teacher data using AJAX
                    $.ajax({
                        url: '/teachers/' + teacherId +
                            '/edit', // Your API route to fetch the teacher data
                        type: 'GET',
                        success: function(response) {
                            // Check if response contains the data object and expected fields
                            if (response.data && response.data.id) {
                                // Populate the form with fetched data
                                $('#id').val(response.data.id);
                                $('#nama_lengkap').val(response.data.nama_lengkap);
                                $('#nik').val(response.data.nik);
                                $('#nuptk').val(response.data.nuptk);
                                $('#status_kepegawaian').val(response.data.status_kepegawaian);
                                $('#jenis_kelamin').val(response.data.jenis_kelamin);
                                $('#tugas').val(response.data.tugas);
                                $('#penempatan').val(response.data.penempatan);
                                $('#tanggal_lahir').val(response.data.tanggal_lahir);
                                $('#nomor_handphone').val(response.data.nomor_handphone);
                                $('#email').val(response.data.email);
                                $('#email_madrasah').val(response.data.email_madrasah);

                                // Add other form fields as needed...

                                // Show the modal with animation
                                $('#teacherModal').modal('show');

                                // Show success notification after data is loaded and modal is shown
                                Toastify({
                                    text: 'Teacher data loaded successfully!',
                                    duration: 3000,
                                    gravity: 'top',
                                    position: 'right',
                                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)"
                                }).showToast();

                            } else {
                                // If data is missing or undefined, show error notification
                                Toastify({
                                    text: 'Failed to load teacher data. Please try again.',
                                    duration: 3000,
                                    gravity: 'top',
                                    position: 'right',
                                    backgroundColor: "linear-gradient(to right, #FF5F6D, #FF6D6D)"
                                }).showToast();
                            }
                        },
                        error: function(xhr) {
                            // Show error notification with Toastify
                            Toastify({
                                text: 'Error fetching teacher data',
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
