<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Nette\Utils\Json;

class ReportQueryRepository implements ReportRepository
{


    public function postsByDate( ): array
    {
        return  [
            "size" => 0,
            "aggs" => [
                "byDay" => [
                    "date_histogram" => [
                        "field" => "created_at",
                        "calendar_interval" => "1d"
                    ]
                ]
            ]
        ];
    }

    public function avgAgeQuery( ): array
    {
        return ["aggs" => [
            "min_age" => ["min" => ["field" => "age"]],
            "max_age" => ["max" => ["field" => "age"]],
            "avg_age" => ["avg" => ["field" => "age"]]
        ]
        ];
    }
}
