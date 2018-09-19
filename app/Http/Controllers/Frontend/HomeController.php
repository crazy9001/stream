<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Vinkla\Alert\Alert;
use SSH;

class HomeController extends Controller
{
    protected $alert;

    public function __construct(Alert $alert)
    {
        $this->alert = $alert;
    }

    public function index()
    {
        return view('layout.FrontHome');
    }

    public function stream(Request $request)
    {
        $input = $request->only('source_stream', 'url_server', 'stream_key', 'source_video');
        $validator = Validator::make($input, [
            'source_stream' =>  'required',
            'url_server' => 'required',
            'stream_key' => 'required',
            'source_video' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Error.', $validator->errors()->first());
        }
        try {
            $ffmpeg = $input['source_stream'] == 'facebook' ? $this->generate_ffmpeg_facebook($input['source_video'], $input['url_server'], $input['stream_key']) : $this->generate_ffmpeg_youtube($input['source_video'], $input['url_server'], $input['stream_key']);
            shell_exec($ffmpeg);
            return $this->sendResponse('Success', 'success');
        }catch (\ErrorException $e) {
            dd($e);
        }
    }


    private function generate_ffmpeg_facebook($source_video, $rtmp, $rtmp_key)
    {
        $ffmpeg = 'ffmpeg -re -i ' . $source_video . ' -acodec libmp3lame  -ar 44100 -b:a 128k -pix_fmt yuv420p -profile:v baseline -s 426x240 -bufsize 6000k -vb 400k -maxrate 1500k -deinterlace -vcodec libx264 -preset veryfast -g 30 -r 30 -f flv "'. $rtmp . $rtmp_key .'"';
        return $ffmpeg;
    }

    private function generate_ffmpeg_youtube($source_video, $rtmp, $rtmp_key)
    {
        $ffmpeg = 'ffmpeg -re -loop 1 -i /home/toinn/Downloads/download.jpeg -i '.$source_video.' -pix_fmt yuv420p -r 30 -vb 1000k -c:v libx264 -c:a libmp3lame -vf scale=1280:720 -g 5 -f flv '. $rtmp . $rtmp_key;
        return $ffmpeg;
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

}
