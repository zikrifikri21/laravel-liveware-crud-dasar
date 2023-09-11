<?php

namespace App\Livewire;

use App\Models\RakBuku;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Blog extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    #[Rule('image|max:1024')]
    public $gambar;
    public $nama;
    public $deskripsi;
    public $deleteId = '';
    public $blogId;
    public $oldImage;


    public $updateMode = false;
    public $inputs = [];
    public $i = 1;

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }
    protected $rules = [
        'nama' => 'required|min:2|max:3',
        'deskripsi' => 'required|min:2',
        'gambar' => 'required|mimes:png,jpg,jpeg|max:300',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editData(int $blogId)
    {
        $this->resetValidation();
        $xblog = RakBuku::find($blogId);
        if ($xblog) {
            $this->blogId = $xblog->id;
            $this->nama = $xblog->nama;
            $this->deskripsi = $xblog->deskripsi;
            $this->oldImage = $xblog->gambar;
        } else {
            return redirect()->to('/');
        }
    }
    public function update()
    {
        $this->validate();
        $ex = $this->gambar->getClientOriginalExtension();
        $blog = RakBuku::findOrFail($this->blogId);
        $gambar = $blog->gambar;
        if (!empty($blog->gambar)) {
            File::delete('storage/' . $blog->gambar);
            $gambar = $this->gambar->storeAs('public/images', Str::random(12) . $ex, 'public');
        } else {
            $gambar = $blog->gambar;
        }

        $blog->update([
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
            'gambar' => $gambar,
        ]);

        $this->reset();
        $this->alert('success', 'mantap euy');
        $this->dispatch('modal-close');
    }

    public function closeModal()
    {
        $this->reset();
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function save()
    {
        $this->validate();
        $ex = $this->gambar->getClientOriginalExtension();
        $x = new RakBuku();
        $x->nama = $this->nama;
        $x->deskripsi = $this->deskripsi;
        $x->gambar = $this->gambar->storeAs('public/images', Str::random(12) . $ex, 'public');
        $x->save();

        $this->reset();
        $this->dispatch('modal-close');
        $this->alert('success', 'mantap euy');
    }

    public function render()
    {
        return view('livewire.blog', [
            'rakbuku' => RakBuku::all(),
        ]);
    }

    public function destroy($id)
    {
        $x = RakBuku::findOrFail($id);
        if (!empty($x->gambar)) {
            File::delete('storage/' . $x->gambar);
        }
        $x->delete();
        $this->alert('success', 'Berhasil dihapus!');
    }
}
