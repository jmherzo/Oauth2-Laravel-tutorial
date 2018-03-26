<?php

namespace App\Policies;

use App\User;
use App\Product;
use App\Policy;
use App\Privilege;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the product.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function view(User $user, Product $product, $policyId )
    {
        
    }

    /**
     * Determine whether the user can create products.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {

        $policyId = 5;
        $roleNumber = Privilege::select('role_header')->where('id' , $user->privilege_id)->first();
        $granted = Policy::select($roleNumber)->where('id',$policyId)->get();
        $respuesta;

        if ($granted->$roleNumber == 1){
            $respuesta = true;
        }else {
            $respuesta = false;
        }
        return $respuesta;
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function update(User $user, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function delete(User $user, Product $product)
    {
        //
    }
}
