<div>
    <div wire:ignore.self class="modal fade" id="modal-insert" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal()"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data">
                        <div class="input-group mb-2">
                            <input class="form-control" type="text" wire:model.live="nama">
                        </div>
                        @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="input-group mb-2">
                            <input class="form-control" type="text" wire:model.live="deskripsi">
                        </div>
                        @error('deskripsi')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="input-group mb-3">
                            <div class="img-box-profile text-center">
                                @if ($gambar)
                                    <img src="{{ $gambar->temporaryUrl() }}" class="preview-image">
                                @endif
                                <div wire:loading wire:target="gambar">
                                    @include('livewire.loading')
                                </div>
                                <input type="file" wire:model.live="gambar" id="{{ rand() }}" accept="">
                            </div>
                        </div>
                        @error('gambar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal()"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="button" wire:click.prevent="save()" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="updateData" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">edit mdoal</h1>
                    <button type="button" class="btn-close" wire:click="closeModal()" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data">
                        <div class="input-group mb-2">
                            <input class="form-control" type="text" wire:model.live="nama">
                        </div>
                        @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="input-group mb-2">
                            <input class="form-control" type="text" wire:model.live="deskripsi">
                        </div>
                        @error('deskripsi')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="input-group mb-3">
                            <div class="img-box-profile text-center">
                                @if ($oldImage)
                                    <span>gambar lama</span>
                                    <img src="{{asset('storage/'.$oldImage)}}" class="preview-image">
                                @endif
                                @if ($gambar)
                                    <span>gambar baru</span>
                                    <img src="{{ $gambar->temporaryUrl() }}" class="preview-image">
                                @endif
                                <div wire:loading wire:target="gambar">
                                    @include('livewire.loading')
                                </div>
                                <input type="file" wire:model.live="gambar" id="{{ rand() }}" accept="">
                            </div>
                        </div>
                        @error('gambar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal()"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="button" wire:click.prevent="update()" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
