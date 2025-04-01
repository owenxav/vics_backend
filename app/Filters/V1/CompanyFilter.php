<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class CompanyFilter extends ApiFilter{
    protected $safeParams = [
        'id' => ['eq', 'ne'],

        'name' => ['eq', 'ne', 'like'],
        'state_id' => ['eq', 'ne'],
        'licence' => ['eq', 'ne', 'like'],
        'email' => ['eq', 'ne', 'like'],
        'phone' => ['eq', 'ne', 'like'],
        'address' => ['eq', 'ne', 'like'],
        'color' => ['eq', 'ne', 'like'],
        'logo' => ['eq', 'ne', 'like'],
        'logo_svg' => ['eq', 'ne', 'like'],

        'created_at' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'updated_at' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
    ];
}

