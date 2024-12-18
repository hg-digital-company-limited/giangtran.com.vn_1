<?php

namespace App\Livewire\Services\SourceCode;

use App\Models\SourceCodeProduct;
use Livewire\Component;

class Detail extends Component
{
    public $sourceCodeDetail;
    public function mount($id)
    {
        $this->sourceCodeDetail = SourceCodeProduct::find($id);
        if (!$this->sourceCodeDetail) {
            abort(404);
        }
        $this->sourceCodeDetail->view_count++;
        $this->sourceCodeDetail->save();
    }
    public function render()
    {
        return view('livewire.services.source-code.detail');
    }
}
