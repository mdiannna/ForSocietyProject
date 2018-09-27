<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client as GuzzleClient;
use Guzzle\Plugin\Oauth\OauthPlugin;

use Illuminate\Http\Request;
use GuzzleHttp\HandlerStack;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use \Carbon\Carbon as Carbon;
use Goutte\Client as GoutteClient;

class EarthquakeInfoController extends Controller
{
    public function pastHourRomania() {
        try {
            $client = new GuzzleClient();
            
            $res = $client->request('GET', 'http://www.seismicportal.eu/fdsnws/event/1/query?format=json&limit=1000');
            
            if ($res->getStatusCode()==200) {
                $responseBody = $res->getBody()->getContents();
                $geoArray = json_decode($responseBody, true);
                
                $earthquakes = [];
                foreach ($geoArray['features'] as $geoFeature) {
                    if($geoFeature['properties']['flynn_region']=='ROMANIA') {

                        $dateNow = Carbon::now();
                        $dateEarthquake = Carbon::parse($geoFeature['properties']['time']);

                        if( ($dateNow->diffInHours($dateEarthquake) < 1 
                            && $dateNow->diffInMinutes($dateEarthquake) > 0) 
                            || ($dateNow->diffInHours($dateEarthquake) == 1 
                                && $dateNow->diffInMinutes($dateEarthquake) == 0) 
                        ) {

                            array_push($earthquakes, $geoFeature['properties']);
                    }
                }
            }


            //     // Use Google Maps API to find location name based on lat and long
            // foreach ($earthquakes as &$earthquake) {
            //     try {
            //         if($earthquake['lon'] > 0) {
            //             $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$earthquake['lat'].','.$earthquake['lon']);
            //             $earthquake["location"] = json_decode($res->getBody()->getContents(),true)["results"][0]["formatted_address"];
            //         }

            //     }
            //     catch(Exception $e){
            //     }
            // }

            return view('earthquakes-info.romania', ['earthquakes' => $earthquakes, 'title' => 'Cutremure în ultima oră în România']);
        }
    } catch(GuzzleHttp\Exception\ClientException $e) {
        return "Error or can't connect to host";   
    }
    return "Error or no data";
}


public function allRomania() {
    try {
        $client = new GuzzleClient();

        $res = $client->request('GET', 'http://www.seismicportal.eu/fdsnws/event/1/query?format=json&limit=1000');

        if ($res->getStatusCode()==200) {
            $responseBody = $res->getBody()->getContents();
            $responseArray = json_decode($responseBody, true);
            $earthquakes = $this->findRomania($responseBody);

            // foreach ($earthquakes as &$earthquake) {
            //     try {
            //         if($earthquake['lon'] > 0) {
            //             $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$earthquake['lat'].','.$earthquake['lon']);
            //             $earthquake["location"] = json_decode($res->getBody()->getContents(),true)["results"][0]["formatted_address"];
            //         }

            //     }
            //     catch(Exception $e){

            //     }
            // }

            return view('earthquakes-info.romania', ['earthquakes' => $earthquakes, 'title' => 'Cele mai recente cutremure in Romania']);
        }
    } catch(GuzzleHttp\Exception\ClientException $e) {
        return "Error or can't connect to host";   
    }

    return "Error or no data";
}


public function all() {
    try {
        $client = new GuzzleClient();

        $res = $client->request('GET', 'http://www.seismicportal.eu/fdsnws/event/1/query?format=json&limit=1000');

        if ($res->getStatusCode()==200) {
            $responseBody = $res->getBody()->getContents();
            $responseArray = json_decode($responseBody, true);
            $earthquakes = $this->findAll($responseBody);

            // foreach ($earthquakes as &$earthquake) {
            //     try {
            //         if($earthquake['lon'] > 0) {
            //             $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$earthquake['lat'].','.$earthquake['lon']);
            //             $earthquake["location"] = json_decode($res->getBody()->getContents(),true)["results"][0]["formatted_address"];
            //         }

            //     }
            //     catch(Exception $e){

            //     }
            // }

            // return view('earthquakes-info.all', ['earthquakes' => $earthquakes, 'title' => 'Recent earthquakes']);
            return view('earthquakes-info.all', ['earthquakes' => $earthquakes, 'title' => 'Recent earthquakes worldwide']);
        }
    } catch(GuzzleHttp\Exception\ClientException $e) {
        return "Error or can't connect to host";   
    }

    return "Error or no data";
}

function findAll($geoJson) {
    $geoArray = json_decode($geoJson, true);
    $response = [];
    foreach ($geoArray['features'] as $geoFeature) {
        array_push($response, $geoFeature['properties']);
    }
    return $response;
}

function findRomania($geoJson) {
    $geoArray = json_decode($geoJson, true);
    $response = [];
    foreach ($geoArray['features'] as $geoFeature) {
        if($geoFeature['properties']['flynn_region']=='ROMANIA') {
            array_push($response, $geoFeature['properties']);
        }
    }
    return $response;
}

function findRomania2($geoJson) {
    $geoArray = json_decode($geoJson, true);
    $response = [];

    foreach ($geoArray['features'] as $geoFeature) {
            // if (in_array($key, $geoFeature['properties']['keys'])) {
        if ($geoFeature['properties']['geometry'] && $geoFeature['properties']['geometry']['flynn_region']=='Romania') {
            array_push($response, $geoFeature['properties']);
        }
    }
    return $response;
}

public function raw() {
    try{
        $client = new GuzzleClient();

        $res = $client->request('GET', 'http://www.seismicportal.eu/fdsnws/event/1/query?format=json&limit=1000');
        if ($res->getStatusCode()==200) {

            $responseBody = $res->getBody()->getContents();
            return $res->getBody();
        }
    } catch(GuzzleHttp\Exception\ClientException $e) {
        return "Error or can't connect to host";   
    }

    return "Error or no data";
}
}
