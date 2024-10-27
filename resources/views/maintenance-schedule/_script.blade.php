@push('js')
<script>
    $(document).ready(function () {
        console.log('Document ready'); // Debugging line

        // Set up CSRF Token for AJAX (required for Laravel)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Show Maintenance Modal
        $(".show-maintenance").click(function () {
            const id = $(this).data("id");
            let url = "{{ route('api.maintenance_schedule.show', ':paramID') }}".replace(':paramID', id);

            $.ajax({
                url: url,
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
                success: (res) => {
                    if (res.data) {
                        $("#show_maintenance_modal #name").val(res.data.name);
                        $("#show_maintenance_modal #description").val(res.data.description);
                        $("#show_maintenance_modal #scheduled_date").val(res.data.scheduled_date);
                        $("#show_maintenance_modal #status").val(res.data.status);
                        $("#show_maintenance_modal").modal("show");  // Open the show modal
                    } else {
                        alert("Data not found for the selected maintenance item.");
                    }
                },
                error: (err) => {
                    alert("An error occurred while loading maintenance details. Please check the console for more details.");
                    console.error("Error:", err);
                }
            });
        });

        // Edit Maintenance Schedule Modal
        $(".update-maintenance").click(function () {
            const id = $(this).data("id");
            let url = "{{ route('api.maintenance_schedule.show', ':paramID') }}".replace(':paramID', id);
            let updateURL = "{{ route('maintenance-schedule.update', ':paramID') }}".replace(':paramID', id);

            $.ajax({
                url: url,
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
                success: (res) => {
                    if (res.data) {
                        // Convert the date to yyyy-MM-dd format
                        const scheduledDate = new Date(res.data.scheduled_date);
                        const year = scheduledDate.getFullYear();
                        const month = String(scheduledDate.getMonth() + 1).padStart(2, '0'); // Menambahkan 1 karena bulan dimulai dari 0
                        const day = String(scheduledDate.getDate()).padStart(2, '0');
                        const formattedDate = `${year}-${month}-${day}`;

                        $("#maintenance_schedule_edit_modal #item_name").val(res.data.item_name);
                        $("#maintenance_schedule_edit_modal #description").val(res.data.description);
                        $("#maintenance_schedule_edit_modal #scheduled_date").val(formattedDate);
                        $("#maintenance_schedule_edit_modal #status").val(res.data.status);
                        $("#maintenance_schedule_edit_modal form").attr("action", updateURL);
                        $("#maintenance_schedule_edit_modal").modal("show");
                    } else {
                        alert("Data not found for the selected maintenance item.");
                    }
                },
                error: (err) => {
                    alert("An error occurred while loading maintenance details. Please check the console for more details.");
                    console.error("Error:", err);
                }
            });
        });
    });
</script>
@endpush
