<?php

namespace App\Repositories;


interface ReportRepository
{
    public function postsByDate( ): array;
    public function avgAgeQuery( ): array;
}
