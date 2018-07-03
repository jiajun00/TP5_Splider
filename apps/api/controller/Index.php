<?php
/*
/**
* Index 模块服务接口
*/

namespace app\api\controller;
use \think\View;
class Index extends Common
{
    /**
     * 首页
     */
    public function index()
    {
        return view();
    }
    
}
