<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pin;
use GuzzleHttp\Client as GuzzleClient;
use Guzzle\Plugin\Oauth\OauthPlugin;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use GuzzleHttp\Exception\RequestException;


class SentimentAnalysisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function json($text)
    {
    	$username = env('NLU_USERNAME');
    	$password = env('NLU_PASSWORD');

    	$text = "Help! I have emergency!";
    	$text = '"'. $text .'"';
    	// dd($text);

    	$client = new GuzzleClient();

    	$content = '{  "text": ' . $text . ',  "features": {    "sentiment": {},    "keywords": {"sentiment": true}, "emotion": {}  }}';

// dd($content);
    	$link = 'https://gateway.watsonplatform.net/natural-language-understanding/api/v1/analyze?version=2018-03-19';

    	$res = $client->request('POST', $link, [
    		'auth' => [$username, $password],
    		'headers' => [
    			'Content-Type' => 'application/json',
    		],
    		'body' => $content,
    		// $content
    	]);

    	if ($res->getStatusCode()==200) {
    		// dd($res->getBody());
    		$responseBody = $res->getBody()->getContents();
    		// dd($responseBody);
    		return $responseBody;
    		// $geoArray = json_decode($responseBody, true);
    	}

    	return  response()->json("Error");
    }

     public function index()
    {
    	$username = env('NLU_USERNAME');
    	$password = env('NLU_PASSWORD');

    	try {
	    	$client = new GuzzleClient(['http_errors' => false]);

	    	$text = '"It is an emergency, please help me! THe building is collapsed! I cant find my friend! My leg is bleeding"';

	    	$content = '{  "text": ' . $text . ',  "features": {    "sentiment": {},    "keywords": {}, "emotion": {}  }}';

	    	$link = 'https://gateway.watsonplatform.net/natural-language-understanding/api/v1/analyze?version=2018-03-19';

	    	$res = $client->request('POST', $link, [
	    		'auth' => [$username, $password],
	    		'headers' => [
	    			'Content-Type' => 'application/json',
	    		],
	    		'body' => $content,
	    		// $content
	    	]);

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
	    			$sentiment_coefficient = $sentiment["score"];
	    		}
	    		$emotions = $data["emotion"]["document"]["emotion"];

	    		$dominantEmotion = "joy";
	    		$dominantEmotionValue = 0;

	    		$emotion_coefficient = 0;

	    		foreach ($emotions as $emotion => $value) {
	    			if($value > $dominantEmotionValue) {
	    				$dominantEmotionValue = $value;
	    				$dominantEmotion = $emotion;
	    			}
	    			if($emotion=="fear") {
						$emotion_coefficient += $value;
					}
					if($emotion=="sadness") {
						$emotion_coefficient += $value/2;
					}

	    		}
	    		// dd($emotions);
	    	}
	    } catch(Exception $e) {
    		return ["emotion_coefficient"=> $emotion_coefficient, "sentiment" => $sentiment_coefficient];
	    }
	    catch(GuzzleHttp\Exception\ClientException $e) {
            return "Error or can't connect to host";   
        }

    	return ["emotion_coefficient"=> $emotion_coefficient, "sentiment" => $sentiment_coefficient];
    	// return response()->json("Error");
    }


}
