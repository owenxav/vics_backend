<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class PlateNumberFilter extends ApiFilter
{
    protected $safeParams = [
        'id' => ['eq', 'ne'],
        'company_id' => ['eq', 'ne'],
        'creator_id' => ['eq', 'ne'],
        'last_updated_id' => ['eq', 'ne'],
        'deactivated_by_id' => ['eq', 'ne'],
        'state_id' => ['eq', 'ne'],

        'number' => ['eq', 'ne', 'like'],
        'number_status' => ['eq', 'ne', 'like'],
        'status' => ['eq', 'ne', 'like'],
        'agent_id' => ['eq', 'ne', 'like'],
        'owner_id' => ['eq', 'ne', 'like'],
        'request_id' => ['eq', 'ne', 'like'],
        'stock_id' => ['eq', 'ne', 'like'],
        'type' => ['eq', 'ne', 'like'],
        'sub_type' => ['eq', 'ne', 'like'],

        'date_deactivated' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        
        'created_at' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'updated_at' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
    ];
} 