<?php
namespace App\Controller;

use App\Dto\UserRegisterDto;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsController]
class UserRegisterController
{
    private EntityManagerInterface $em;
    private UserPasswordHasherInterface $hasher;

    public function __construct(
        EntityManagerInterface $em,
        UserPasswordHasherInterface $hasher
    ) {
        $this->em = $em;
        $this->hasher = $hasher;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $existingUser = $this->em->getRepository(User::class)->findOneBy(['email' => $data['email']]);

        if ($existingUser) {
            return new JsonResponse(['error' => 'Email already exists'], 400);
        }

        $password = $data['password'];

        if (strlen($password) < 8) {
            return new JsonResponse(['error' => 'Le mot de passe doit contenir au moins 8 caractères.'], 400);
        }

        if (!preg_match('/[A-Z]/', $password)) {
            return new JsonResponse(['error' => 'Le mot de passe doit contenir au moins une lettre majuscule.'], 400);
        }

        if (!preg_match('/[0-9]/', $password)) {
            return new JsonResponse(['error' => 'Le mot de passe doit contenir au moins un chiffre.'], 400);
        }

        if (!preg_match('/[\W_]/', $password)) {
            return new JsonResponse(['error' => 'Le mot de passe doit contenir au moins un caractère spécial.'], 400);
        }

        $user = new User();
        $user->setEmail($data['email']);
        $user->setPassword($this->hasher->hashPassword($user, $password));
        $user->setRoles(['ROLE_USER']);

        $this->em->persist($user);
        $this->em->flush();

        return new JsonResponse([
            'user' => [
                'email' => $user->getEmail(),
            ]
        ], 201);
    }

}
