<?php

namespace App\Http\Controllers;

use App\Repositories\PostsQueryRepository;
use App\Repositories\ReportQueryRepository;
use App\Repositories\UserQueryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiSearchController extends ApiController
{
    public function searchUsers(Request $request)
    {
        $user_search =new UserQueryRepository();
        $query =  $user_search->searchUsers($request);
        $response = \Illuminate\Support\Facades\Http::withBody(json_encode($query), 'application/json')->post(env('SERVER_ADDRESS').'/users/_search')->json();
        return  $this->successResponse( array_column($response['hits']['hits'], '_source'), 201);
    }
    public function avgAgeQuery()
    {
        $report_repo =new ReportQueryRepository();
        $query = $report_repo->avgAgeQuery();
        $response = \Illuminate\Support\Facades\Http::withBody(json_encode($query), 'application/json')->post(env('SERVER_ADDRESS').'/users/_search?size=0')->json();
        return  $this->successResponse($response['aggregations'], 201);
    }
    public function searchPostByKeyWords(Request $request)
    {
        $post_search =new PostsQueryRepository();
        $query= $post_search->searchPostByKeyWords($request);
        $post_response = \Illuminate\Support\Facades\Http::withBody(json_encode($query), 'application/json')->post(env('SERVER_ADDRESS').'/users_posts/_search?size=10')->json();
        return  $this->successResponse(array_column($post_response['hits']['hits'], '_source'), 201);
    }
    public function postsByDate()
    {
        $report_repo =new ReportQueryRepository();
        $query =$report_repo->postsByDate();
        $response = \Illuminate\Support\Facades\Http::withBody(json_encode($query), 'application/json')->post(env('SERVER_ADDRESS').'/users_posts/_search')->json();
        return  $this->successResponse( $response['aggregations']['byDay']['buckets'], 201);
    }
    public function getPostByUserId(Request $request)
    {

        $post_search =new PostsQueryRepository();
        $query =$post_search->getPostByUserId($request);
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
