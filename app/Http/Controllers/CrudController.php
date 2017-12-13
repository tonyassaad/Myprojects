<?php

namespace App\Http\Controllers;

use App\Console\Commands\DuePages;
use App\Domain;
use App\Http\Controllers\Controller;
use App\pages;
use App\posts;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use function response;
use function view;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CrudController extends Controller {

    public function index() {
        return view('domain.create');
    }

    private function getDomains() {
        return Domain::all();
    }

    public function getPage() {
        $d = new DuePages();
        print_r($d->getOutput());
        $domains = $this->getDomains();
        return view('pages.create', compact('domains'));
    }

    public function getDomainsList() {
        $domains = $this->getDomains();
        return view('domain.list', compact('domains'));
    }

    public function createDomain(Request $request) {
        $rules = [
            'name' => 'required',
            'link' => 'required',
            'language' => 'required',
            'location' => 'required',
        ];

        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                return response()->json(['response' => ['error' => $message]]);
            }
        }
        try {

            $domain = new Domain();
            $domain->name = $request->input('name');
            $domain->link = $request->input('link');
            $domain->language = $request->input('language');

            $domain->long = $this->getGoogleLocationApi($request->input('location'))['lng'];
            $domain->lat = $this->getGoogleLocationApi($request->input('location'))['lat'];
            print_r($domain);

            $domain->save();
            return response()->json(['response' => ['success' => 'Successfully saved']]);
        } catch (QueryException $ex) {
            return $ex->getMessage();
        }
    }

    public function createPage(Request $request) {
        $rules = [
            'category' => 'required',
            'link' => 'required',
            'domain' => 'required'
        ];

        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                return response()->json(['response' => ['error' => $message]]);
            }
        }
        try {
            $page = new pages();
            $page->link = $request->input('link');
            $page->domain_id = $request->input('domain'); //get from select boxc
            $page->location_name = $request->input('location_name');
            $page->category = $request->input('category');
            $page->area = $request->input('area');
            $page->frequency = $request->input('frequency');
            $page->next_visit_time = Carbon::now();
            $page->last_visit_time = Carbon::now();
            $page->save();

            return response()->json(['response' => ['success' => 'Successfully saved']]);
        } catch (QueryException $ex) {
            return $ex->getMessage();
        }
    }

    public function getGoogleLocationApi($location) {
        $client = new Client();
        ///call google ap
        $google_response = $client->get('https://maps.googleapis.com/maps/api/geocode/json?&key=AIzaSyAmU2-8WMF56Sa_VGbziREkGnW0CW6zR6U&address=' . $location);
        $api_content = json_decode($google_response->getBody()->getContents());
        $location = [];
        foreach ($api_content->results as $content) {
            $location['lat'] = $content->geometry->location->lat;
            $location['lng'] = $content->geometry->location->lng;
        }
        return $location;
    }

    /* Assume we have the interface for deleting since i did not have time to create them */

    public function deleteDomain(Request $request) {
        $domain = Domain::find($request->input('domain_id'));
        $domain->delete();
    }

    public function deletePage(Request $request) {
        $page = pages::find($request->input('page_id'));
        $page->delete();
    }

    //Dispatch the job pushDuepages
    public function store(Request $request) {
        // Create podcast....
        posts::dispatch($post)->onQueue('processing');
    }

}
