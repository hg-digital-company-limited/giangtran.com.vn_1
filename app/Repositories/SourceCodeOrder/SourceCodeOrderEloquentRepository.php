<?php
namespace App\Repositories\SourceCodeOrder;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Carbon;
use App\Repositories\SourceCodeOrder\SourceCodeOrderRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class SourceCodeOrderEloquentRepository extends EloquentRepository implements SourceCodeOrderRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\SourceCodeOrder::class;
    }

}
