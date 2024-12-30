<?php

namespace App\Dtos;

use App\Interfaces\IBaseDto;

abstract class BaseDto implements IBaseDto
{
    public function toArray(): array
    {
        return (array) $this;
    }

}
