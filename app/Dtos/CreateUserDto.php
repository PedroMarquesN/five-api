<?php

namespace App\Dtos;

class CreateUserDto extends BaseDto
{

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $password)
    {


    }

}
