<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Nette\Utils\Json;

interface SearchUsersRepository
{
    public function searchUsers(Request $request): array;
}
