<?php 

namespace App\Traits;

/**
 * trait reponse 
 */
trait ResponseApi
{

  public function sendResponse($message, $data = null, $statusCode, $isSuccess = true)
  {

    if(!$message) return response()->json(['message' => 'Message is required'], 500);

    if($isSuccess) {

        return response()->json([
          'success' => true,
          'message' => $message,
          'data' => $data
        ], $statusCode);
        
    } else {

        return response()->json([
          'success' => false,
          'message' => $message,
        ], $statusCode);

    }

  }

  public function success($message, $data, $statusCode = 200)
  {
    return $this->sendResponse($message, $data, $statusCode);
  }

  public function error($message, $statusCode = 500)
  {
    return $this->sendResponse($message, null, $statusCode, false);
  }

}
