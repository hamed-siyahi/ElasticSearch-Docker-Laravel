<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiSearchController extends ApiController
{
    public function searchUsers(Request $request)
    {
        $username =$request->username??"";
        $number =$request->number??"";

        $query = [
            "query" => [
                "bool" => [
                    "must" => [
                        ["match" => ["username" => $username]],
                        ["match" => ["number" => $number]]
                    ]
                ]
            ]
        ];

        $response = \Illuminate\Support\Facades\Http::withBody(json_encode($query), 'application/json')->post(env('SERVER_ADDRESS').'/users/_search')->json();
        return  $this->successResponse( array_column($response['hits']['hits'], '_source'), 201);
    }

    public function avgAgeQuery()
    {

        $query = ["aggs" => [
            "min_age" => ["min" => ["field" => "age"]],
            "max_age" => ["max" => ["field" => "age"]],
            "avg_age" => ["avg" => ["field" => "age"]]
        ]
        ];
        $response = \Illuminate\Support\Facades\Http::withBody(json_encode($query), 'application/json')->post(env('SERVER_ADDRESS').'/users/_search?size=0')->json();
        return  $this->successResponse($response['aggregations'], 201);
    }

    public function searchPostByKeyWords(Request $request)
    {
        // Input like this caption_keywords[]
        $keys =$request->caption_keywords;
        $key_words = [];
        foreach ($keys as $i => $word) {
            $key_words[$i] = $word;
        }
        $query =
            [
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

        $post_response = \Illuminate\Support\Facades\Http::withBody(json_encode($query), 'application/json')->post(env('SERVER_ADDRESS').'/users_posts/_search?size=10')->json();
        return  $this->successResponse(array_column($post_response['hits']['hits'], '_source'), 201);
    }

    public function postsByDate()
    {
        $query = [
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
        $response = \Illuminate\Support\Facades\Http::withBody(json_encode($query), 'application/json')->post(env('SERVER_ADDRESS').'/users_posts/_search')->json();
        return  $this->successResponse( $response['aggregations']['byDay']['buckets'], 201);
    }

    public function getPostByUserId(Request $request)
    {
        $id = $request->_id??"";
        $query = [
            "query" => [
                "match" => [
                    "user_id" => $id
                ]
            ]
        ];
        $post_response = \Illuminate\Support\Facades\Http::withBody(json_encode($query), 'application/json')->post(env('SERVER_ADDRESS').'/users_posts/_search')->json();
        $jsonDecoded = array_column($post_response['hits']['hits'], '_source');

        $fh = fopen('fileout.csv', 'w');
        if (is_array($jsonDecoded)) {
            foreach ($jsonDecoded as $line) {
                foreach ($line as $key => $value) {
                    if (is_array($value)) {
                        $line[$key] = $value[0];
                    }
                }

                if (is_array($line)) {
                    fputcsv($fh, $line);
                }
            }
        }
        fclose($fh);
        $file = public_path() . '/' . 'fileout.csv';
        return response()->download($file);

    }
}
