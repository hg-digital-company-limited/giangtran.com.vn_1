<?php
namespace App\Repositories\SourceCodeProduct;

use App\Repositories\RepositoryInterface;

interface SourceCodeProductRepositoryInterface extends RepositoryInterface
{
    public function getModel();
    public function getById($id);
}
