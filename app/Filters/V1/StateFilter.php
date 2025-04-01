<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class StateFilter extends ApiFilter{
    protected $safeParams = [
        'id' => ['eq', 'ne'],

        'name' => ['eq', 'ne', 'like'],

        'created_at' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'updated_at' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
    ];
}

