<?php
namespace App\Http\Response;

trait JsonResponse{
    public function success($msg='',$data=[]){
        return $this->JsonResponse('00000',$msg,$data);
    }
    public function error($msg='',$data=[]){
        return $this->JsonResponse('00001',$msg,$data);
    }
    public function JsonResponse($code,$msg,$data=[]){
        $message = [
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
        ];
        return response()->json($message);
    }
}