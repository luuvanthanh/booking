<?php
namespace App\Repositories\FromTo;

use App\Models\FromTo;
use App\Repositories\BaseRepository;

class FromToRepository extends BaseRepository implements FromToRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return FromTo::class;
    }

    public function getAll()
    {
        $fromTo = $this->model->all();

        return $fromTo;
    }
}