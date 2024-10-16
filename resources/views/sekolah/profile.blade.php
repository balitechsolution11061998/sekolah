<x-default-layout>
    @section('title', 'School Profile')

    @push('styles')
        <!-- Add Bootstrap 5 and custom styles -->
        <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <style>
            .profile-card {
                max-width: 900px;
                margin: auto;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                /* Rounded corners */
                overflow: hidden;
                /* Ensure child elements are clipped */
            }

            .profile-header {
                background-color: #007bff;
                color: #fff;
                padding: 20px;
                border-radius: 10px 10px 0 0;
                /* Rounded top corners */
                text-align: center;
            }

            .profile-header h2 {
                font-size: 28px;
                /* Slightly larger font size */
                margin-bottom: 0;
            }

            .profile-body {
                padding: 20px;
            }

            .profile-body table {
                width: 100%;
                border-collapse: collapse;
                /* Remove gaps between cells */
            }

            .profile-body table td {
                padding: 12px;
                /* Increased padding */
                vertical-align: top;
            }

            .profile-footer {
                text-align: right;
                padding: 15px 20px;
                /* More padding for footer */
                border-top: 1px solid #ddd;
                background-color: #f8f9fa;
                /* Light background for footer */
            }

            .profile-footer .btn {
                padding: 10px 20px;
                /* Larger button padding */
                border-radius: 5px;
                /* Rounded button */
                transition: background-color 0.3s;
                /* Smooth transition for hover */
            }

            .profile-footer .btn:hover {
                background-color: #0056b3;
                /* Darker blue on hover */
            }

            /* Custom styles for form inputs */
            .form-control {
                border-radius: 5px;
                /* Rounded corners for inputs */
                border: 1px solid #ced4da;
                /* Custom border color */
            }

            .form-control:focus {
                box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
                /* Focus shadow */
            }

            /* Custom styles for modal */
            .modal-content {
                border-radius: 10px;
                /* Rounded corners for modal */
            }
        </style>
    @endpush

    <div class="container mt-5">
        @if ($sekolah)
            <div class="card profile-card">
                <div class="profile-header text-center p-4"
                    style="background-color: #f8f9fa; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <!-- Displaying the logo -->
                    <img src="{{ asset($sekolah->logo) }}" alt="School Logo" class="img-fluid rounded-circle mb-3"
                        style="max-width: 150px; border: 3px solid #007bff;">
                    <h2 style="font-family: 'Montserrat', sans-serif; color: #343a40; font-weight: 600;">
                        {{ $sekolah->nama_sekolah }}</h2>
                </div>

                <div class="profile-body">
                    <table class="table table-borderless">
                        <tr>
                            <td><strong>Nama Sekolah:</strong></td>
                            <td>{{ $sekolah->nama_sekolah }}</td>
                        </tr>
                        <tr>
                            <td><strong>NPSN:</strong></td>
                            <td>{{ $sekolah->npsn }}</td>
                        </tr>
                        <tr>
                            <td><strong>NSS:</strong></td>
                            <td>{{ $sekolah->nss ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Kode Pos:</strong></td>
                            <td>{{ $sekolah->kode_pos }}</td>
                        </tr>
                        <tr>
                            <td><strong>Nomor Telpon:</strong></td>
                            <td>{{ $sekolah->nomor_telpon ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Alamat:</strong></td>
                            <td>{{ $sekolah->alamat }}</td>
                        </tr>
                        <tr>
                            <td><strong>Website:</strong></td>
                            <td>{{ $sekolah->website ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong></td>
                            <td>{{ $sekolah->email ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Kepala Sekolah:</strong></td>
                            <td>{{ $sekolah->kepala_sekolah }}</td>
                        </tr>
                        <tr>
                            <td><strong>NIP Kepala Sekolah:</strong></td>
                            <td>{{ $sekolah->nip_kepala_sekolah ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="profile-footer">
                    <button class="btn btn-primary" id="editProfileButton" data-bs-toggle="modal"
                        data-bs-target="#editSekolahModal">
                        <i class="fas fa-edit"></i> Edit Profile
                    </button>
                </div>
            </div>
        @else
            <div class="alert alert-warning text-center">
                <strong>No school profile available. Please create a new profile.</strong>
            </div>
            <!-- Add form to create new profile -->
            <div class="card profile-card">
                <div class="profile-header">
                    <h2>Create School Profile</h2>
                </div>
                <div class="profile-body">
                    <form id="createSekolahForm" action="{{ route('schoolprofile.save') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="logo">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama_sekolah">Nama Sekolah</label>
                            <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="npsn">NPSN</label>
                            <input type="text" class="form-control" id="npsn" name="npsn" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nss">NSS</label>
                            <input type="text" class="form-control" id="nss" name="nss">
                        </div>
                        <div class="form-group mb-3">
                            <label for="kode_pos">Kode Pos</label>
                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nomor_telpon">Nomor Telpon</label>
                            <input type="text" class="form-control" id="nomor_telpon" name="nomor_telpon">
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" id="website" name="website">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group mb-3">
                            <label for="kepala_sekolah">Kepala Sekolah</label>
                            <input type="text" class="form-control" id="kepala_sekolah" name="kepala_sekolah"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nip_kepala_sekolah">NIP Kepala Sekolah</label>
                            <input type="text" class="form-control" id="nip_kepala_sekolah"
                                name="nip_kepala_sekolah">
                        </div>
                        <div class="profile-footer">
                            <button type="submit" class="btn btn-primary">Create Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        <div class="modal fade" id="editSekolahModal" tabindex="-1" aria-labelledby="editSekolahModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg"> <!-- Changed to modal-lg for wider layout -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSekolahModalLabel">Edit School Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form id="createSekolahForm" action="{{ route('schoolprofile.save') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <!-- Logo Upload -->
                            <div class="form-group mb-4 text-center">
                                <label for="logo" class="form-label fw-bold">Upload School Logo</label>
                                <input type="file" class="form-control" id="logo" name="logo">
                            </div>

                            <!-- School Name & NPSN -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nama_sekolah"
                                            name="nama_sekolah" placeholder="Nama Sekolah" required>
                                        <label for="nama_sekolah">Nama Sekolah</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="npsn" name="npsn"
                                            placeholder="NPSN" required>
                                        <label for="npsn">NPSN</label>
                                    </div>
                                </div>
                            </div>

                            <!-- NSS & Kode Pos -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nss" name="nss"
                                            placeholder="NSS">
                                        <label for="nss">NSS</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="kode_pos" name="kode_pos"
                                            placeholder="Kode Pos" required>
                                        <label for="kode_pos">Kode Pos</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Nomor Telpon & Alamat -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nomor_telpon"
                                            name="nomor_telpon" placeholder="Nomor Telpon">
                                        <label for="nomor_telpon">Nomor Telpon</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Alamat" id="alamat" name="alamat" style="height: 100px" required></textarea>
                                        <label for="alamat">Alamat</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Website & Email -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="website" name="website"
                                            placeholder="Website">
                                        <label for="website">Website</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email">
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Kepala Sekolah & NIP -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="kepala_sekolah"
                                            name="kepala_sekolah" placeholder="Kepala Sekolah" required>
                                        <label for="kepala_sekolah">Kepala Sekolah</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nip_kepala_sekolah"
                                            name="nip_kepala_sekolah" placeholder="NIP Kepala Sekolah">
                                        <label for="nip_kepala_sekolah">NIP Kepala Sekolah</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Create Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/toastify-js@1.11.2/src/toastify.min.js"></script>

        <script>
            document.getElementById('editProfileButton').addEventListener('click', function() {
                // Fetch the profile data using an AJAX request
                fetch('/schoolprofile/get')
                    .then(response => response.json())
                    .then(data => {
                        // Populate the modal form with the fetched data
                        document.getElementById('nama_sekolah').value = data.nama_sekolah;
                        document.getElementById('npsn').value = data.npsn;
                        document.getElementById('nss').value = data.nss;
                        document.getElementById('kode_pos').value = data.kode_pos;
                        document.getElementById('nomor_telpon').value = data.nomor_telpon;
                        document.getElementById('alamat').value = data.alamat;
                        document.getElementById('website').value = data.website;
                        document.getElementById('email').value = data.email;
                        document.getElementById('kepala_sekolah').value = data.kepala_sekolah;
                        document.getElementById('nip_kepala_sekolah').value = data.nip_kepala_sekolah;
                    })
                    .catch(error => console.error('Error fetching profile:', error));
            });

            // Form submission handling with Toastify notification
            $('#createSekolahForm').submit(function(event) {
                event.preventDefault();
                var form = $(this);

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Show success notification
                        Toastify({
                            text: "Profile updated successfully!",
                            duration: 3000,
                            close: true,
                            gravity: "top",
                            position: 'center',
                            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                        }).showToast();

                        // Hide the modal
                        $('#editSekolahModal').modal('hide');

                        // Refresh the profile data by making an AJAX call to fetch the updated profile
                        $.ajax({
                            url: '/getSekolahProfile', // Replace with your route to fetch updated profile
                            type: 'GET',
                            success: function(data) {
                                // Update the profile card with new data
                                $('.profile-header img').attr('src', data.logo);
                                $('.profile-header h2').text(data.nama_sekolah);
                                $('td:contains("Nama Sekolah")').next().text(data.nama_sekolah);
                                $('td:contains("NPSN")').next().text(data.npsn);
                                $('td:contains("NSS")').next().text(data.nss ?? 'N/A');
                                $('td:contains("Kode Pos")').next().text(data.kode_pos);
                                $('td:contains("Nomor Telpon")').next().text(data
                                    .nomor_telpon ?? 'N/A');
                                $('td:contains("Alamat")').next().text(data.alamat);
                                $('td:contains("Website")').next().text(data.website ?? 'N/A');
                                $('td:contains("Email")').next().text(data.email ?? 'N/A');
                                $('td:contains("Kepala Sekolah")').next().text(data
                                    .kepala_sekolah);
                                $('td:contains("NIP Kepala Sekolah")').next().text(data
                                    .nip_kepala_sekolah ?? 'N/A');
                            }
                        });
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;

                        // Display error notifications
                        $.each(errors, function(key, value) {
                            Toastify({
                                text: value[0],
                                duration: 3000,
                                close: true,
                                gravity: "top",
                                position: 'center',
                                backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                            }).showToast();
                        });
                    }
                });
            });
        </script>
    @endpush
</x-default-layout>
