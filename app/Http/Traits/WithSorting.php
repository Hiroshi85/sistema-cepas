<?php

namespace App\Http\Traits;

trait WithSorting

{

    public $sortBy = 'id';

    public $sortDirection = 'asc';



    public function sortBy($field)

    {

        $this->sortDirection = $this->sortBy === $field

            ? $this->reverseSort()

            : 'asc';



        $this->sortBy = $field;
    }



    public function reverseSort()

    {

        return $this->sortDirection === 'asc'

            ? 'desc'

            : 'asc';
    }
}
