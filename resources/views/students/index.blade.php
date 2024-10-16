<x-default-layout>
    @section('title')
        Student Management
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
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/css/lightbox.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.css"
        integrity="sha512-VSD3lcSci0foeRFRHWdYX4FaLvec89irh5+QAGc00j5AOdow2r5MFPhoPEYBUQdyarXwbzyJEO7Iko7+PnPuBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="card my-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Students</h4>
            <button type="button" class="btn btn-primary btn-sm" onclick="showCreateStudentModal()">
                <i class="fas fa-plus"></i> Add Student
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered align-middle" id="students_table">
                    <thead class="bg-light">
                        <tr class="text-muted fw-bold text-uppercase">
                            <th class="text-center">#</th>
                            <th>Name</th>
                            <th>NISN</th>
                            <th>NIK</th>
                            <th>Phone</th>
                            <th>Class Level</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Foto Profile</th>
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

    <!-- Student Modal for Create/Edit -->
    <div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="studentModalLabel">Add Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="studentForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">

                        <!-- Profile Photo Upload -->
                        <!-- Dropzone and Progress Bar HTML -->
                        <div class="mb-3">
                            <label for="profile_photo" class="form-label">Profile Photo</label>
                            <div id="my-dropzone" class="dropzone"></div>
                            <div id="preview" class="mt-2"></div>
                            <input type="hidden" id="profile_photo_url" name="profile_photo_url">

                            <div id="progress-container" class="progress mt-2" style="display: none;">
                                <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <!-- Additional Fields for Student Details -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_lengkap" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="text" class="form-control" id="nisn" name="nisn" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tempat_lahir" class="form-label">Place of Birth</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_lahir" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="umur" class="form-label">Age</label>
                                <input type="number" class="form-control" id="umur" name="umur" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tingkat_rombel" class="form-label">Class Level</label>
                                <select class="form-select" id="tingkat_rombel" name="tingkat_rombel" required>
                                    <option value="">Select Class Level</option>
                                    <option value="Kelas 7">Kelas 7</option>
                                    <option value="Kelas 8">Kelas 8</option>
                                    <option value="Kelas 9">Kelas 9</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="jenis_kelamin" class="form-label">Gender</label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="alamat" class="form-label">Address</label>
                                <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="no_telepon" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="no_telepon" name="no_telepon"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kebutuhan_khusus" class="form-label">Special Needs</label>
                                <input type="text" class="form-control" id="kebutuhan_khusus"
                                    name="kebutuhan_khusus">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="disabilitas" class="form-label">Disabilities</label>
                                <input type="text" class="form-control" id="disabilitas" name="disabilitas">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nomor_kip_pip" class="form-label">KIP/PIP Number</label>
                                <input type="text" class="form-control" id="nomor_kip_pip" name="nomor_kip_pip">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="nama_ayah" class="form-label">Father's Name</label>
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nama_ibu" class="form-label">Mother's Name</label>
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nama_wali" class="form-label">Guardian's Name</label>
                                <input type="text" class="form-control" id="nama_wali" name="nama_wali">
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

            $(document).ready(function() {


                $("#studentForm").validate({
                    rules: {
                        nama_lengkap: "required",
                        nisn: "required",
                        nik: "required",
                        tempat_lahir: "required",
                        tanggal_lahir: "required",
                        umur: {
                            required: true,
                            digits: true
                        },
                        tingkat_rombel: "required",
                        jenis_kelamin: "required",
                        status: "required",
                        alamat: "required",
                        no_telepon: {
                            required: true,
                            digits: true
                        },
                    },
                    messages: {
                        nama_lengkap: "Please enter full name",
                        nisn: "Please enter NISN",
                        nik: "Please enter NIK",
                        tempat_lahir: "Please enter place of birth",
                        tanggal_lahir: "Please select date of birth",
                        umur: {
                            required: "Please enter age",
                            digits: "Please enter a valid age"
                        },
                        tingkat_rombel: "Please enter class level",
                        jenis_kelamin: "Please select gender",
                        status: "Please select status",
                        alamat: "Please enter address",
                        no_telepon: {
                            required: "Please enter phone number",
                            digits: "Please enter a valid phone number"
                        },
                    },
                    highlight: function(element) {
                        $(element).css("border-color", "red"); // Set border color to red for invalid fields
                    },
                    unhighlight: function(element) {
                        $(element).css("border-color", ""); // Reset border color for valid fields
                    },
                    submitHandler: function(form) {
                        // Trigger Swal confirmation dialog
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "Do you want to save this student's information?",
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

                                $.ajax({
                                    url: '/students/store', // Your store route
                                    type: 'POST',
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    success: function(response) {
                                        if (response.success) {
                                            // Show success message
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Success!',
                                                text: response.message,
                                                confirmButtonText: 'OK'
                                            });
                                            $('#studentModal').modal(
                                                'hide'); // Hide modal
                                            // Optionally reload data or update UI
                                            $('#students_table').DataTable().ajax
                                                .reload();
                                        }
                                    },
                                    error: function(xhr) {
                                        // Handle error (e.g., show an error message)
                                        if (xhr.status === 422) {
                                            // Handle validation errors
                                            var errors = xhr.responseJSON.errors;
                                            $.each(errors, function(key, value) {
                                                Toastify({
                                                    text: value[0],
                                                    duration: 3000,
                                                    gravity: "top",
                                                    position: 'right',
                                                    backgroundColor: "linear-gradient(to right, #FF5F6D, #FF6D6D)", // Change color to red
                                                }).showToast();
                                            });
                                        } else {
                                            // General error message
                                            Toastify({
                                                text: 'Error: ' + (xhr
                                                    .responseJSON.message ||
                                                    'Unknown error'),
                                                duration: 3000,
                                                gravity: "top",
                                                position: 'right',
                                                backgroundColor: "linear-gradient(to right, #FF5F6D, #FF6D6D)", // Change color to red
                                            }).showToast();
                                        }
                                    }
                                });
                            }
                        });

                        return false; // Prevent default form submission
                    }
                });




                // Initialize DataTable with Bootstrap integration and buttons
                var table = $('#students_table').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: "{{ route('students.data') }}",
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
                            data: 'nisn',
                            name: 'nisn'
                        },
                        {
                            data: 'nik',
                            name: 'nik'
                        },
                        {
                            data: 'no_telepon',
                            name: 'no_telepon'
                        },
                        {
                            data: 'tingkat_rombel',
                            name: 'tingkat_rombel'
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
                            data: 'status',
                            name: 'status',
                            className: 'text-center',
                            render: function(data) {
                                let icon = data === 'Active' ? 'fa-check-circle' : 'fa-times-circle';
                                let badgeClass = data === 'Active' ? 'badge bg-success' :
                                    'badge bg-danger';
                                return `<span class="${badgeClass}"><i class="fas ${icon}"></i> ${data}</span>`;
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
                        searchPlaceholder: "Search Students...",
                        lengthMenu: "Show _MENU_ students",
                        info: "Showing _START_ to _END_ of _TOTAL_ students",
                    },
                    order: [
                        [0, 'asc']
                    ],
                    initComplete: function() {
                        // Wrap the table in a responsive div
                        $('#students_table').wrap('<div class="table-responsive"></div>');
                    }
                });

                // Handle delete button click
                $('#students_table').on('click', '.delete-btn', function() {
                    var studentId = $(this).data('id');

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
                                url: '{{ route('students.destroy', '') }}/' + studentId,
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
                                            "Student deleted successfully",
                                        duration: 3000,
                                        gravity: "top",
                                        position: "right",
                                        backgroundColor: "#28a745",
                                        stopOnFocus: true,
                                    }).showToast();
                                    $('#students_table').DataTable().ajax
                                    .reload();
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
                $('#students_table').on('click', '.edit-btn', function() {
                    var studentId = $(this).data('id');

                    // Show a loading spinner while fetching data
                    Toastify({
                        text: 'Loading student data...',
                        duration: 2000,
                        gravity: 'top',
                        position: 'right',
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)"
                    }).showToast();

                    // Fetch the student data using AJAX
                    $.ajax({
                        url: '/students/' + studentId +
                            '/edit', // Your API route to fetch the student data
                        type: 'GET',
                        success: function(response) {
                            // Check if response contains the data object and expected fields
                            if (response.data && response.data.id) {
                                // Populate the form with fetched data
                                $('#id').val(response.data.id);
                                $('#nama_lengkap').val(response.data.nama_lengkap);
                                $('#nisn').val(response.data.nisn);
                                $('#nik').val(response.data.nik);
                                $('#tempat_lahir').val(response.data.tempat_lahir);
                                $('#tanggal_lahir').val(response.data.tanggal_lahir);
                                $('#umur').val(response.data.umur);
                                $('#tingkat_rombel').val(response.data.tingkat_rombel);
                                $('#jenis_kelamin').val(response.data.jenis_kelamin);
                                $('#status').val(response.data.status);
                                $('#alamat').val(response.data.alamat);
                                $('#no_telepon').val(response.data.no_telepon);
                                $('#kebutuhan_khusus').val(response.data.kebutuhan_khusus);
                                $('#disabilitas').val(response.data.disabilitas);
                                $('#nomor_kip_pip').val(response.data.nomor_kip_pip);
                                $('#nama_ayah').val(response.data.nama_ayah);
                                $('#nama_ibu').val(response.data.nama_ibu);
                                $('#nama_wali').val(response.data.nama_wali);
                                // Add other form fields as needed...

                                // Show the modal with animation
                                $('#studentModal').modal('show');

                                // Show success notification after data is loaded and modal is shown
                                Toastify({
                                    text: 'Student data loaded successfully!',
                                    duration: 3000,
                                    gravity: 'top',
                                    position: 'right',
                                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)"
                                }).showToast();

                            } else {
                                // If data is missing or undefined, show error notification
                                Toastify({
                                    text: 'Failed to load student data. Please try again.',
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
                                text: 'Error fetching student data',
                                duration: 3000,
                                gravity: 'top',
                                position: 'right',
                                backgroundColor: "linear-gradient(to right, #FF5F6D, #FF6D6D)"
                            }).showToast();
                        }
                    });
                });





                // Show Create Modal
                window.showCreateStudentModal = function() {
                    $('#studentModalLabel').text('Add Student');
                    $('#studentForm').trigger('reset');
                    $('#student_id').val('');
                    $('#studentModal').modal('show');
                }

                // Edit Student
                window.editStudent = function(id) {
                    $.get("{{ route('students.edit', '') }}/" + id, function(data) {
                        $('#studentModalLabel').text('Edit Student');
                        $('#student_id').val(data.id);
                        $('#nama_lengkap').val(data.nama_lengkap);
                        $('#nisn').val(data.nisn);
                        $('#nik').val(data.nik);
                        $('#no_telepon').val(data.no_telepon);
                        $('#tingkat_rombel').val(data.tingkat_rombel);
                        $('#status').val(data.status);
                        $('#studentModal').modal('show');
                    });
                }

                // Delete Student
                window.deleteStudent = function(id) {
                    if (confirm('Are you sure you want to delete this student?')) {
                        $.ajax({
                            url: "{{ route('students.destroy', '') }}/" + id,
                            method: 'DELETE',
                            success: function(response) {
                                table.ajax.reload();
                                alert(response.message);
                            },
                            error: function(xhr) {
                                alert('Error occurred: ' + xhr.responseText);
                            }
                        });
                    }
                }
            });
        </script>
    @endpush
</x-default-layout>
