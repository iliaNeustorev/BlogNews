<?php

namespace App\Http\Requests\Сategory;


class Update extends Store
{
    protected function makeUniqueRule(){
        return parent::makeUniqueRule()->ignore(request()->category->id);
    }
}
