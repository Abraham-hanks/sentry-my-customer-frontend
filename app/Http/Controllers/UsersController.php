<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator as Paginator; // NAMESPACE FOR PAGINATOR
use Illuminate\Support\Facades\Cookie;

class UsersController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $url = env('API_URL', 'https://api.customerpay.me/'). '/user/all' ;
            $client = new Client();
            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $user_response = $client->request('GET', $url, $headers);

            if ( $user_response->getStatusCode() == 200 ) {

                $users = json_decode($user_response->getBody(), true);

                $perPage = 10;
                $page = $request->get('page', 1);
                if ($page > count($users) or $page < 1) {
                    $page = 1;
                }
                $offset = ($page * $perPage) - $perPage;
                $articles = array_slice($users, $offset, $perPage);
                $datas = new Paginator($articles, count($users), $perPage);

                return view('backend.users_list.index')->with('response', $datas->withPath('/'.$request->path()));
            }
            if ($user_response->getStatusCode() == 500) {

                return view('errors.500');
            }
        } catch(\Exception $e) {
            return view('errors.500');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = env('API_URL', 'https://api.customerpay.me/'). "/user/$id";

        try {
            $client = new Client();
            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $response = $client->request('GET', $url, $headers);
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            $user = json_decode($body);
            // return $body;
            if ($statusCode == 500) {
                return view('errors.500');
            }
            return view('backend.users_list.show')->with('response', $user);
        } catch (\Exception $e) {
            return view('errors.500');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
