<?php
namespace App\Repositories\SourceCodeProduct;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Carbon;
use App\Repositories\SourceCodeProduct\SourceCodeProductRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class SourceCodeProductEloquentRepository extends EloquentRepository implements SourceCodeProductRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\SourceCodeProduct::class;
    }

    public function getById($id)
    {
        return $this->_model->find($id);
    }
}
