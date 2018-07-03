<?php

namespace app\api\controller;

use think\Controller;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parser;
//use Lcobucci\JWT\Signer\Rsa\Sha256;
/**
 * Description of JwtController
 *
 * @author linjiajun
 */
class Jwt extends Controller{
    private $key='123';
    /*
     * 使用密钥生成token
     */
    public function token(){
        $builder = new Builder();
        $signer = new Sha256();
        // 设置发行人
        $builder->setIssuer('http://qqxio.cn'); 
        // 设置接收人
        $builder->setAudience('http://qqxio.org'); 
        // 设置id
        $builder->setId('4f1g23a12aa', true); 
        // 设置生成token的时间
        $builder->setIssuedAt(time()); 
        // 设置在60秒内该token无法使用
        $builder->setNotBefore(time() + 60); 
        // 设置过期时间
        $builder->setExpiration(time() + 3600); 
        // 给token设置一个id
        $builder->set('uid', 1); 
        // 对上面的信息使用sha256算法签名
        $builder->sign($signer, $this->key);
        // 获取生成的token
        $token = $builder->getToken();
        return $token;
    }
    
    /*
     * 使用RSA和ECDSA签名 生成token
     */
//    public function token_other(){
//        $signer = new Sha256();
//        $keychain = new Keychain();
//
//        $builder = new Builder();
//        $builder->setIssuer('http://example.com');
//        $builder->setAudience('http://example.org');
//        $builder->setId('4f1g23a12aa', true);
//        $builder->setIssuedAt(time());
//        $builder->setNotBefore(time() + 60);
//        $builder->setExpiration(time() + 3600);
//        $builder->set('uid', 1);
//        // 与上面不同的是这里使用的是你的私钥，并提供私钥的地址
//        $builder->sign($signer, $keychain->getPrivateKey('file://{私钥地址}'));
//        $toekn = $builder->getToken();
//    }
    
    /*
     * 秘钥解密
     */
    public function verificationtoken($jwt){
        $parse = (new Parser())->parse($jwt);
        dump($parse);
        $signer = new Sha256();
        $res = $parse->verify($signer,$this->key);// 验证成功返回true 失败false
        return $res;
    }
    
    function test(){
        $token = $this->token();
        $token  = object_to_array($token);
        dump($token);
        echo "Lcobucci\JWT\Tokenheaders";
        $jwt = $token["Tokenpayload"];
        dump($jwt);exit;
//        $res = $this->verificationtoken($jwt);
        dump($res);
    }
        
}
