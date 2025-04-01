<?php

namespace App\Helpers\V1;

class Roles
{
    private const test_roles = [
        "Admin",
        "Super Admin",
        "General User",
    ];

    public const ADMIN_USER = 'Admin';
    public const SUPER_ADMIN_USER = 'Super Admin';
    public const GENERAL_USER = 'General User';

    public const USER_ROLES = [
        SELF::ADMIN_USER,
        SELF::SUPER_ADMIN_USER,
        SELF::GENERAL_USER
    ];
}