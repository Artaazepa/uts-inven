<!-- Modal Edit Maintenance Schedule -->
<div class="modal fade" id="maintenance_schedule_edit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
	role="dialog" aria-labelledby="editMaintenanceScheduleLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editMaintenanceScheduleLabel">Ubah Jadwal Pemeliharaan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<form method="POST" action="{{ route('maintenance-schedule.update', $schedule->id) }}">
					@csrf
					@method('PUT')
					<div class="row">
						<!-- Nama Pemeliharaan -->
						<div class="col-lg-12">
							<div class="form-group">
								<label for="item_name">Nama Jadwal Pemeliharaan</label>
								<input type="text" class="form-control" name="item_name" id="item_name"
									value="{{ old('item_name', $schedule->item_name) }}" placeholder="Masukkan nama jadwal">
								@error('item_name')
								<div class="d-block invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
						</div>

						<!-- Tanggal Pemeliharaan -->
						<div class="col-lg-12">
							<div class="form-group">
								<label for="scheduled_date">Tanggal Pemeliharaan</label>
								<input type="date" class="form-control" name="scheduled_date" id="scheduled_date"
									value="{{ old('scheduled_date', \Carbon\Carbon::parse($schedule->scheduled_date)->format('Y-m-d')) }}">
								@error('scheduled_date')
								<div class="d-block invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
						</div>

						<!-- Deskripsi Pemeliharaan -->
						<div class="col-lg-12">
							<div class="form-group">
								<label for="description">Deskripsi Pemeliharaan</label>
								<textarea class="form-control" name="description" id="description"
									style="height: 100px">{{ old('description', $schedule->description) }}</textarea>
								@error('description')
								<div class="d-block invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
						</div>

						<!-- Status Pemeliharaan -->
						<div class="col-lg-12">
							<div class="form-group">
								<label for="status">Status</label>
								<select class="form-control" name="status" id="status">
									<option value="">-- Pilih Status --</option>
									<option value="planned" {{ old('status', $schedule->status) == 'planned' ? 'selected' : '' }}>Planned</option>
									<option value="ongoing" {{ old('status', $schedule->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
									<option value="completed" {{ old('status', $schedule->status) == 'completed' ? 'selected' : '' }}>Completed</option>
									<option value="canceled" {{ old('status', $schedule->status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
								</select>
								@error('status')
								<div class="d-block invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
