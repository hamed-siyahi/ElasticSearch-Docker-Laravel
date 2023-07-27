<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Nette\Utils\Json;

interface SearchPostsRepository
{
    public function searchPostByKeyWords(Request $request): array;
    public function getPostByUserId(Request $request): array;

}
