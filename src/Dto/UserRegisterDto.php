<?php

namespace App\Dto;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use Symfony\Component\Validator\Constraints as Assert;
use App\Controller\UserRegisterController;

#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/register',
            controller: UserRegisterController::class,
            read: false,
            status: 201
        )
    ]
)]
final class UserRegisterDto
{
    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank]
    #[Assert\Length(min: 8)]
    public string $password;

    public function __construct(string $email = '', string $password = '')
    {
        $this->email = $email;
        $this->password = $password;
    }
}
