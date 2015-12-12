<?php
namespace App\Api\Transformers;
use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return $user->toArray();
    }
}
