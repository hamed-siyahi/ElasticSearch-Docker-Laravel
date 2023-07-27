<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Nette\Utils\Json;

class UserQueryRepository implements SearchUsersRepository
{


    public function searchUsers(Request $request): array
    {
        $username = $request->username ?? "";
        $number = $request->number ?? "";

        return [
            "query" => [
                "bool" => [
                    "must" => [
                        ["match" => ["username" => $username]],
                        ["match" => ["number" => $number]]
                    ]
                ]
            ]
        ];
    }
}
