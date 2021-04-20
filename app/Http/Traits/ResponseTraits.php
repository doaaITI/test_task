<?php
namespace App\Http\Traits;

trait ResponseTraits {


    public function prepare_response($error = false, $errors = null, $message = '', $data = null ,$status = 0 ,$server_status) {

        $array = array(
            'status'  =>$status,
            'error'   => $error,
            'errors'  => $errors,
            'message' => $message,
            'data'    => $data
        );


        return response()->json($array ,$server_status);
    }
}