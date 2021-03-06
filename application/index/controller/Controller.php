<?php

namespace app\index\controller;

use think\Request;
use think\Controller as BaseController;
use app\index\service\UserService;

class Controller extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        Request::hook('all',function(Request $request){
            $data = $request->param();
            unset($data[$request->server('REDIRECT_URL')]);
            return $data;
        });
    }

    /**
     * 返回Json数据
     *
     * @param array $data   数据信息
     * @param string $message   状态信息
     * @param integer $code 状态码
     * @return \think\response\Json
     */
    protected function asJson($data=[],$message='提交成功',$code=200)
    {
        return json([
            'message' =>$message,
            'code'    =>$code,
            'data'    =>$data
        ]);
    }
    /**
     * 获取登录用户信息
     * @return array
     */
    public function userInfo()
    {
        return json_decode(session('user'),true);
    }
}
