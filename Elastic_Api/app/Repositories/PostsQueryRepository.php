<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Nette\Utils\Json;

class PostsQueryRepository implements SearchPostsRepository
{


    public function searchPostByKeyWords(Request $request): array
    {
        // Input like this caption_keywords[]
        $keys =$request->caption_keywords;
        $key_words = [];
        foreach ($keys as $i => $word) {
            $key_words[$i] = $word;
        }
          return  [
                "query" => [
                    "constant_score" => [
                        "filter" => [
                            "terms" => [
                                "caption" => $key_words
                            ]
                        ]
                    ]
                ]
            ];
    }
    public function getPostByUserId(Request $request): array
    {
        $id = $request->_id??"";
        return[
            "query" => [
                "match" => [
                    "user_id" => $id
                ]
            ]
        ];
    }
}
