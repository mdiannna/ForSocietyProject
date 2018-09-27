<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pin;
use GuzzleHttp\Client as GuzzleClient;
use Guzzle\Plugin\Oauth\OauthPlugin;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class AlertMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('maps.alert');
    }

    public function putMarkers()
    {
        $markers = Pin::where('pin_type_id', 1)->get();
        // return view('put_markers_map', compact('markers'));
         return view('maps.alert', compact('markers'));
    }
    

    // save pin to database
    public function saveMarker(Request $request)
    {
      // dd($request->details);

        // $request->emotions_coefficient = 
        // $request->sentiment = $emotionsSentiments["sentiment"];

        $data = $request->except(['message', '_token']);
        // dd($data);
        if($request->details) {
          $emotionsSentiments = $this->analyzeText($request->details);
          $data["emotions_coefficient"]=$emotionsSentiments["emotions_coefficient"];
          $data["sentiment"]=$emotionsSentiments["sentiment"];
        }
        // dd($data);

        $p = Pin::create($data);

        // dd($p);
        $response = array(
          'status' => 'success',
          'msg' => $request->message . $request->details .'added',
          'message' => 'Alert added on map',
          'message-type' => 'success'
        );

        $request->session()->flash('message', 'Alert added on map');
        $request->session()->flash('message-type', 'success');

        return response()->json($response); 
    }

    /**
    Analyze message to determine emotions
    */
    public function analyzeText($text) {
      try {
        $username = env('NLU_USERNAME');
        $password = env('NLU_PASSWORD');

        $client = new GuzzleClient(['http_errors' => false]);
        
        // $text = "Help! I have emergency!";
        $text = '"'. $text .'"';
        
        $content = '{  "text": ' . $text . ',  "features": {    "sentiment": {},    "keywords": {}, "emotion": {}  }}';

        $link = 'https://gateway.watsonplatform.net/natural-language-understanding/api/v1/analyze?version=2018-03-19';
        try {

          $res = $client->request('POST', $link, [
            'auth' => [$username, $password],
            'headers' => [
              'Content-Type' => 'application/json',
            ],
            'body' => $content,
            // $content
          ]);
        } 

          catch (Exception $e) {

            return ["emotions_coefficient"=> 0, "sentiment" => 0];
        }
       catch(GuzzleHttp\Exception\ClientException $e) {
            return ["emotions_coefficient"=> 0, "sentiment" => 0];
       }


        if ($res->getStatusCode()==200) {
          
          // dd($res->getBody());
          $responseBody = $res->getBody()->getContents();
          // dd($responseBody);
          // return $responseBody;
          $data = json_decode($responseBody, true);

          // has score and label
          $sentiment = $data["sentiment"]["document"];
          // dd($sentiment);
          $sentiment_coefficient = 0;

          if($sentiment["label"]=="negative") {
            $sentiment_coefficient = -$sentiment["score"];
          }
          $emotions = $data["emotion"]["document"]["emotion"];

          $dominantEmotion = "joy";
          $dominantEmotionValue = 0;

          $emotions_coefficient = 0;

          foreach ($emotions as $emotion => $value) {
            if($value > $dominantEmotionValue) {
              $dominantEmotionValue = $value;
              $dominantEmotion = $emotion;
            }
            if($emotion=="fear") {
              $emotions_coefficient += $value;
            }
            if($emotion=="sadness") {
              $emotions_coefficient += $value/2;
            }
          }
        return ["emotions_coefficient"=> $emotions_coefficient, "sentiment" => $sentiment_coefficient];

        }
       
      }
       catch(GuzzleHttp\Exception\ClientException $e) {
            // return "Error or can't connect to host";   
            return ["emotions_coefficient"=> 0, "sentiment" => 0];
        }
        catch(Exception $e) {
          return ["emotions_coefficient"=> 0, "sentiment" => 0];
        }

        // dd($emotions);
      // }

        return  ["emotions_coefficient"=> 0, "sentiment" => 0];

    }
}
