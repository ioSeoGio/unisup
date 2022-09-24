<?php declare(strict_types=1);
use models\User;

return [
    [
        'username' => 'admin',
        //12345678
        'password_hash' => '$2y$13$F2g0DJS8xzflDVLQ7Yzsm.51FGx1bDLBYFO9hOoVX1vv9u7PH1VR.',
        'email' => 'admin@gmail.com',
        'status' => User::STATUS_ACTIVE,
        'role' => User::ROLE_ADMIN,
        'access_token' => 'K1t9ek5Y5llzWcqee7G5lL2j9SR1Vj6r_1644828238',
    ],
    [
        'username' => 'moderator',
        //12345678
        'password_hash' => '$2y$13$F2g0DJS8xzflDVLQ7Yzsm.51FGx1bDLBYFO9hOoVX1vv9u7PH1VR.',
        'email' => 'moderator@gmail.com',
        'status' => User::STATUS_ACTIVE,
        'role' => User::ROLE_MODERATOR,
        'access_token' => 'moderator_1644828238',
    ],
    [
        'username' => 'user',
        //12345678
        'password_hash' => '$2y$13$F2g0DJS8xzflDVLQ7Yzsm.51FGx1bDLBYFO9hOoVX1vv9u7PH1VR.',
        'email' => 'user@gmail.com',
        'status' => User::STATUS_ACTIVE,
        'role' => User::ROLE_USER,
        'access_token' => 'user_1644828238',
    ],
];