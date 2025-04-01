<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class PlateNumberOrderFilter extends ApiFilter
{
    protected $safeParams = [
        'id' => ['eq', 'ne'],
        'company_id' => ['eq', 'ne'],
        'creator_id' => ['eq', 'ne'],
        'last_updated_id' => ['eq', 'ne'],
        'deactivated_by_id' => ['eq', 'ne'],
        'state_id' => ['eq', 'ne'],
        'invoice_id' => ['eq', 'ne'],
        'vehicle_id' => ['eq', 'ne'],

        'type' => ['eq', 'ne', 'like'],
        'status' => ['eq', 'ne', 'like'],
        'assignment_status' => ['eq', 'ne', 'like'],
        'fancy_plate' => ['eq', 'ne', 'like'],
        'prefix' => ['eq', 'ne'],
        'recommended_number' => ['eq', 'ne'],
        'total_number_requested' => ['eq', 'ne'],
        'tracking_id' => ['eq', 'ne', 'like'],
        'workflow_approval_status' => ['eq', 'ne', 'like'],
        'plate_number_type' => ['eq', 'ne', 'like'],
        'plate_number_sub_type' => ['eq', 'ne', 'like'],
        'workflow_id' => ['eq', 'ne', 'like'],
        'reference_number' => ['eq', 'ne', 'like'],

        'date_deactivated' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        
        'created_at' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'updated_at' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
    ];
} 