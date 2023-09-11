<div>
    <div class="container mt-5">
        @include('livewire.modal')
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-insert">
            Tambah data
        </button>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-sm" widht="100%">
                    <thead>
                        <tr>
                            <th>nama</th>
                            <th>deskripsi</th>
                            <th>gambar</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rakbuku as $r)
                            <tr>
                                <td>{{ $r->nama }}</td>
                                <td>{{ $r->deskripsi }}</td>
                                <td><img src="{{ asset('storage/' . $r->gambar) }}" alt="" width="180px"></td>
                                <td>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#updateData"
                                        wire:click="editData({{ $r->id }})"
                                        class="btn btn-primary btn-sm">Edit</button>
                                    <a wire:click="destroy({{ $r->id }})" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
