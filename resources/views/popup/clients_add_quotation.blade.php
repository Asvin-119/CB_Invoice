<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Modal -->
<div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="addClientModalLabel">Add Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to add new client -->
                <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Primary Contact -->
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Primary Contact</label>
                        <div class="col-sm-3 mb-2">
                            <select id="salutation" class="form-control" name="salutation">
                                <option>Mr.</option>
                                <option>Mrs.</option>
                                <option>Ms.</option>
                                <option>Miss.</option>
                                <option>Dr.</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="firstName" name="first_name" placeholder="First Name" required>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Last Name" required>
                        </div>
                    </div>

                    <!-- Display Name -->
                    <div class="form-group row pt-3">
                        <label class="col-sm-3 col-form-label">Client Display Name</label>
                        <div class="col-sm-9">
                            <input type="text" id="displayName" name="display_name" class="form-control" placeholder="Client Display Name" readonly required>
                        </div>
                    </div>

                    <!-- Client Email -->
                    <div class="form-group row pt-3">
                        <label class="col-sm-3 col-form-label">Client Email</label>
                        <div class="col-sm-9">
                            <input type="email" name="email" class="form-control" placeholder="Client Email" required>
                        </div>
                    </div>

                    <!-- Client Phone -->
                    <div class="form-group row pt-3">
                        <label class="col-sm-3 col-form-label">Client Phone No</label>
                        <div class="col-sm-9">
                            <input type="text" name="mobile_phone" class="form-control" placeholder="Mobile Number">
                        </div>
                    </div>

                    <!-- Client Image -->
                    <div class="form-group row pt-3">
                        <label class="col-sm-3 col-form-label">Client Image</label>
                        <div class="col-sm-9">
                            <input type="file" name="client_image" class="form-control">
                        </div>
                    </div>

                    <!-- Tour Consultant -->
                    <div class="form-group row pt-3">
                        <label class="col-sm-3 col-form-label">Tour Consultant</label>
                        <div class="col-sm-9">
                            <input type="text" name="tour_consultant" class="form-control" placeholder="Tour Consultant">
                        </div>
                    </div>

                    <!-- Source / Agent -->
                    <div class="form-group row pt-3">
                        <label class="col-sm-3 col-form-label">Source / Agent</label>
                        <div class="col-sm-9">
                            <input type="text" name="source" class="form-control" placeholder="Source / Agent">
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="text-center pt-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        const salutation = document.getElementById('salutation');
        const firstName = document.getElementById('firstName');
        const lastName = document.getElementById('lastName');
        const displayName = document.getElementById('displayName');

        function updateDisplayName() {
            const salutationValue = salutation.value;
            const firstNameValue = firstName.value;
            const lastNameValue = lastName.value;
            displayName.value = `${salutationValue} ${firstNameValue} ${lastNameValue}`.trim();
        }

        salutation.addEventListener('change', updateDisplayName);
        firstName.addEventListener('input', updateDisplayName);
        lastName.addEventListener('input', updateDisplayName);
    });
</script>


@if(session('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-start",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        Toast.fire({
            icon: "success",
            title: "{{ session('success') }}"
        });
    </script>
@endif
