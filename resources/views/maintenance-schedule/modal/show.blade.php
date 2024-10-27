<!-- Modal Detail Jadwal Pemeliharaan -->
<div class="modal fade" id="show_maintenance_schedule" data-backdrop="static" data-keyboard="false" tabindex="-1"
    role="dialog" aria-labelledby="showMaintenanceScheduleLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showMaintenanceScheduleLabel">Detail Jadwal Pemeliharaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="show_item_name">Nama Jadwal Pemeliharaan</label>
                            <input type="text" class="form-control" id="show_item_name" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="show_scheduled_date">Tanggal Pemeliharaan</label>
                            <input type="text" class="form-control" id="show_scheduled_date" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="show_status">Status</label>
                            <input type="text" class="form-control" id="show_status" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="show_description">Deskripsi Pemeliharaan</label>
                            <textarea class="form-control" id="show_description" style="height: 100px" readonly></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
