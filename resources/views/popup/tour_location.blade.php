<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<div class="modal fade" id="addTourLocationModal" tabindex="-1" aria-labelledby="addTourLocationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTourLocationModalLabel">Add Tour Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tour.form.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="tourLocation" class="form-label">Tour Location</label>
                        <input type="text" class="form-control" id="tourLocation" name="tour_location" required>
                    </div>
                    <div class="mb-3">
                        <label for="tourplacesName" class="form-label">Tour Places Name</label>
                        <input type="text" class="form-control" id="tourplacesName" name="tour_places_name" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
