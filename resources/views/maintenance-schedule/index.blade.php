<x-layout>
    <!-- Page Title & Heading -->
    <x-slot name="title">Halaman Jadwal Pemeliharaan</x-slot>
    <x-slot name="page_heading">Jadwal Pemeliharaan</x-slot>

    <div class="card">
        <div class="card-body">
            <!-- Include alert utilities -->
            @include('utilities.alert')

            <!-- Action Buttons -->
            <div class="d-flex justify-content-end mb-3">
                <div class="btn-group">
                    <!-- Import Excel Button -->
                    @can('import jadwal')
                    <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#excel_menu">
                        <i class="fas fa-fw fa-upload"></i>
                        Import Excel
                    </button>
                    @endcan

                    <!-- Export Excel Button -->
                    @can('export jadwal')
                    <form action="{{ route('maintenance-schedule.export') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success mr-2">
                            <i class="fas fa-fw fa-download"></i>
                            Export Excel
                        </button>
                    </form>
                    @endcan

                    <!-- Add Schedule Button -->
                    @can('tambah jadwal')
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#maintenance_schedule_create_modal">
                        <i class="fas fa-fw fa-plus"></i> Tambah Jadwal
                    </button>
                    @endcan
                </div>
            </div>

            <!-- Maintenance Schedule Data Table -->
            <div class="row">
                <div class="col-lg-12">
                    <x-datatable>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Jadwal</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Status</th> <!-- Kolom Status -->
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($maintenance_schedules as $schedule)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $schedule->item_name }}</td>
                                <td>{{ date('d-m-Y', strtotime($schedule->scheduled_date)) }}</td>
                                <td>
                                    @if($schedule->status == 'completed')
                                    <span class="badge badge-success">Completed</span>
                                    @elseif($schedule->status == 'ongoing')
                                    <span class="badge badge-secondary">Ongoing</span>
                                    @elseif($schedule->status == 'canceled')
                                    <span class="badge badge-danger">Canceled</span>
                                    @else
                                    <span class="badge badge-warning">Planned</span>
                                    @endif
                                </td>
                                <td>{{ Str::limit($schedule->description, 55, '...') }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        

                                        <!-- Edit Jadwal Button -->
                                        @can('ubah jadwal')
                                        <a data-id="{{ $schedule->id }}" class="btn btn-sm btn-success text-white update-maintenance mr-2"
                                            data-toggle="modal" data-target="#maintenance_schedule_edit_modal" data-placement="top"
                                            title="Ubah data">
                                            <i class="fas fa-fw fa-edit"></i>
                                        </a>
                                        @endcan

                                        <!-- Delete Jadwal Button -->
                                        @can('hapus jadwal')
                                        <form action="{{ route('maintenance-schedule.destroy', $schedule->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger text-white delete-button"
                                                onclick="return confirm('Yakin ingin menghapus jadwal ini?')">
                                                <i class="fas fa-fw fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    @push('modal')
    @include('maintenance-schedule.modal.create') <!-- Modal Tambah Jadwal -->
    @include('maintenance-schedule.modal.show')   <!-- Modal Detail Jadwal -->
    @include('maintenance-schedule.modal.edit')   <!-- Modal Edit Jadwal -->
    {{-- @include('maintenance-schedule.modal.import') <!-- Modal Import Jadwal --> --}}
    @endpush

    <!-- Custom Scripts -->
    @push('js')
    @include('maintenance-schedule._script')  <!-- Custom Scripts untuk Edit -->
    @endpush

</x-layout>
