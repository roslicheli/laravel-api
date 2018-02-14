<?php 

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformer extends TransformerAbstract
{

    public function transform(User $model)
    {
        return [
            'id'=> $model->id,
            'username'=> $model->username,
            'name'=> $model->name,
            'email'=> $model->email,
            'created_at'=> $model->created_at,
            'updated_at'=> $model->updated_at,
            'deleted_at'=> $model->deleted_at,
        ];
    }

}