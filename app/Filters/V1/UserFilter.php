<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class UserFilter extends ApiFilter
{
    protected $safeParams = [
        'id' => ['eq', 'ne'],
        'company_id' => ['eq', 'ne'],
        'creator_id' => ['eq', 'ne'],
        'state_id' => ['eq', 'ne'],
        'last_updated_id' => ['eq', 'ne'],
        'area_id' => ['eq', 'ne', 'like'],
        'lga_id' => ['eq', 'ne', 'like'],
        'office_id' => ['eq', 'ne', 'like'],

        'firstname' => ['eq', 'ne', 'like'],
        'lastname' => ['eq', 'ne', 'like'],
        'othername' => ['eq', 'ne', 'like'],
        'image' => ['eq', 'ne', 'like'],
        'nin' => ['eq', 'ne', 'like'],
        'role' => ['eq', 'ne', 'like'],
        'email' => ['eq', 'ne', 'like'],
        'gender' => ['eq', 'ne', 'like'],
        'phone' => ['eq', 'ne', 'like'],
        'address' => ['eq', 'ne', 'like'],
        'status' => ['eq', 'ne', 'like'],
        'registeration_type' => ['eq', 'ne', 'like'],
        'state_verification_no' => ['eq', 'ne', 'like'],
        'date_of_birth' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],

        'is_email_verified' => ['eq', 'ne'],
        'email_verified_at' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'date_deactivated' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],

        'created_at' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'updated_at' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'deleted_at' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
    ];
}

