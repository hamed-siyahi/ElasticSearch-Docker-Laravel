<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SearchController extends Controller
{

    public function searchData(Request $request)
    {
        $age_response = $this->avgAgeQuery();
        $users_response =isset($request->username)? $this->searchUsers($request):[];
        $post_searches = [];
//        $publish_rate = $this->postsByDate();
//        if (isset($request->caption_keywords)) {
//            $post_searches = $this->searchPostByKeyWords($request->caption_keywords);
//        }


        return view('index', compact('age_response','users_response'));


    }

    public function searchUsers(Request $request)
    {
        $username =$request->username;
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

        $response = \Illuminate\Support\Facades\Http::withBody(json_encode($query), 'application/json')->post('http://65.109.187.4:9200/social/users/_search')->json();
        return   array_column($response['hits']['hits'], '_source');
    }

    public function avgAgeQuery(): array
    {

        $query = ["aggs" => [
            "min_age" => ["min" => ["field" => "age"]],
            "max_age" => ["max" => ["field" => "age"]],
            "avg_age" => ["avg" => ["field" => "age"]]
        ]
        ];
        $age_response = \Illuminate\Support\Facades\Http::withBody(json_encode($query), 'application/json')->post('http://65.109.187.4:9200/social/users/_search?size=0')->json();
        return $age_response['aggregations'];
    }

    public function searchPostByKeyWords($keys): array
    {
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

        $post_response = \Illuminate\Support\Facades\Http::withBody(json_encode($query), 'application/json')->post('http://65.109.187.4:9200/user_posts/_search?size=10')->json();
        return array_column($post_response['hits']['hits'], '_source');
    }

    public function postsByDate(): array
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
//    dd(json_encode($query));
        $post_response = \Illuminate\Support\Facades\Http::withBody(json_encode($query), 'application/json')->post('http://65.109.187.4:9200/new_users/_search')->json();
        dd($post_response['aggregations']['byDay']['buckets']);
        return array_column($post_response['hits']['hits'], '_source');
    }

    public function getPostByUserId(Request $request)
    {
        $id = $request->_id;
        $query = [
            "query" => [
                "match" => [
                    "user_id" => $id
                ]
            ]
        ];
        $post_response = \Illuminate\Support\Facades\Http::withBody(json_encode($query), 'application/json')->post('http://65.109.187.4:9200/new_users/_search')->json();
        $jsonDecoded = array_column($post_response['hits']['hits'], '_source'); // add true, will handle as associative array

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
        return redirect()->route('home')->with('file_status', 'ok');

    }
}
