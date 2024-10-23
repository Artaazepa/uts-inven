<!-- Modal Tambah Jadwal Pemeliharaan -->
<div class="modal fade" id="maintenance_schedule_create_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    role="dialog" aria-labelledby="createMaintenanceScheduleLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createMaintenanceScheduleLabel">Tambah Jadwal Pemeliharaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('maintenance-schedule.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Field Nama Jadwal Pemeliharaan -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="item_name">Nama Jadwal Pemeliharaan</label>
                                <input type="text" name="item_name" id="item_name"
                                    class="form-control @error('item_name', 'store') is-invalid @enderror" 
                                    value="{{ old('item_name') }}" placeholder="Masukan nama jadwal..">
                                @error('item_name', 'store')
                                <div class="d-block invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Field Tanggal Jadwal -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="scheduled_date">Tanggal Pemeliharaan</label>
                                <input type="date" name="scheduled_date" id="scheduled_date"
                                    class="form-control @error('scheduled_date', 'store') is-invalid @enderror" 
                                    value="{{ old('scheduled_date') }}">
                                @error('scheduled_date', 'store')
                                <div class="d-block invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Field Deskripsi Jadwal (Opsional) -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="description">Deskripsi Pemeliharaan</label>
                                <textarea name="description" class="form-control @error('description', 'store') is-invalid @enderror"
                                    id="description" placeholder="Masukan deskripsi (opsional).."
                                    style="height: 100px;">{{ old('description') }}</textarea>
                                @error('description', 'store')
                                <div class="d-block invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Field Status Jadwal -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="status">Status Jadwal</label>
                                <select name="status" id="status" class="form-control @error('status', 'store') is-invalid @enderror">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="planned" {{ old('status') == 'planned' ? 'selected' : '' }}>Planned</option>
                                    <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="canceled" {{ old('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                </select>
                                @error('status', 'store')
                                <div class="d-block invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
