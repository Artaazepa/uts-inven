<script>
    $(document).ready(function () {
        // Set up CSRF Token for AJAX (required for Laravel)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Token CSRF untuk Laravel
                'Content-Type': 'application/json',
            }
        });

        // Show Maintenance Schedule Modal
        $(".show-maintenance-modal").click(function () {
            const id = $(this).data("id"); // Mengambil ID jadwal dari tombol show
            let url = "{{ route('api.maintenance_schedule.show', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                method: "GET",
                headers: { 
                    "Content-Type": "application/json",
                },
                success: (res) => {
                    // Set data pada modal show dengan data dari response
                    $("#show_maintenance_modal #title").val(res.data.title);
                    $("#show_maintenance_modal #date").val(res.data.date);
                    $("#show_maintenance_modal #details").val(res.data.details);
                    $("#show_maintenance_modal #status").val(res.data.status);
                },
                error: (err) => {
                    alert("Error occurred, check console");
                    console.log(err);
                },
            });
        });

        // Edit Maintenance Schedule Modal
        $(".edit-maintenance-modal").on("click", function () {
            const id = $(this).data("id");  // Mengambil ID jadwal dari tombol edit
            let url = "{{ route('api.maintenance_schedule.show', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                method: "GET",
                success: (res) => {
                    // Set data pada modal edit dengan data dari response
                    $("#maintenance_schedule_edit_modal #title").val(res.data.title);
                    $("#maintenance_schedule_edit_modal #date").val(res.data.date);
                    $("#maintenance_schedule_edit_modal #details").val(res.data.details);
                    $("#maintenance_schedule_edit_modal #status").val(res.data.status);

                    // Set form action untuk update request
                    let updateURL = "{{ route('maintenance-schedule.update', ':id') }}".replace(':id', id);
                    $("#maintenance_schedule_edit_modal form").attr("action", updateURL);
                },
                error: (err) => {
                    alert("Error occurred, check console");
                    console.log(err);
                },
            });
        });
    });
</script>
