<?php

/**
 * @doc https://developer.apple.com/library/archive/releasenotes/General/ValidateAppStoreReceipt/Chapters/ValidateRemotely.html
 * Class ApplePay
 */
class ApplePay
{
    /** 环境配置(建议提成配置)
     * @var bool
     */
    private $sandbox = false ;

    /** result as json
     * @param int $code
     * @param string $msg
     * @param array $data
     * @return string
     */
    private function jsonRet(int $code=200, string $msg='', array $data = [])
    {
        $result = [
            'code' => $code ,
            'message' => $msg ,
            'data' => $data ,
        ] ;
        return json_encode($result,true);
    }

    /** code400
     * @param string $msg
     * @return string
     */
    private function code400( $msg = '参数错误!' )
    {
        return $this->jsonRet(400,$msg);
    }

    /** code200
     * @param string $msg
     * @return string
     */
    private function code200( $msg = '操作成功!')
    {
        return $this->jsonRet(200,$msg);
    }

    /** log
     * @param $info
     */
    private function log($info)
    {
        //log info
    }

    /** ios apple 支付验证
     * @return string
     */
    public function apple()
    {
        //苹果支付认证的凭证(base64后的数据)
        $receipt = $_POST('receipt') ;
        if(empty($receipt)) {
            return $this->code400() ;
        }
        //环境配置
        if($this->sandbox) {
            $endpoint = 'https://sandbox.itunes.apple.com/verifyReceipt';//沙箱地址
        } else {
            $endpoint = 'https://buy.itunes.apple.com/verifyReceipt';//真实运营地址
        }
        //数据组装
        //$receipt ='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';
        $postData = json_encode(
            array('receipt-data' => $receipt)
            ,JSON_UNESCAPED_SLASHES);
        //自动订阅
        /*$postData = json_encode(
            array(
                //票证
                'receipt-data' => $receipt,
                //自动订阅 app store 秘钥
                'password'=>'4751d1ff0ecf44b092c6115fd62e7a73')
            ,JSON_UNESCAPED_SLASHES);*/
        //日志记录
        $this->log($postData);
        //curl操作
        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  //这两行一定要加，不加会报SSL 错误
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $response = curl_exec($ch);
        $errno    = curl_errno($ch);
        curl_close($ch);
        if ($errno != 0) {
            return $this->code400('curl请求有错误!') ;
        } else {
            $data = json_decode($response, true);
            if (!is_array($data)) {
                return $this->code400('数据错误!') ;
            }
            //判断购买是否成功
            if (!isset($data['status']) || $data['status'] != 0) {
                return $this->code400('无效的iOS支付数据!') ;
            }
            //无效的bundle_id
            if(!in_array($data['receipt']['bundle_id'],['ios申请的bundle_id类似于支付的app_id'])) {
                return $this->code400('无效的bundle_id:'.$data['receipt']['bundle_id']) ;
            }
            //多物品购买时
            // in_app为多个(坑)
            // ios一次支付可能返回多个,可能是上次成功后没有及时返回,这次成功后会把上次或上上次成功的返回
            if(!empty($inAppData = $data['receipt']['in_app'])) {
                //产品配置,对应ios申请的product_id eg : yw_6 支付6元
                $productB = ['yw_6'];
                //多物品信息
                foreach ($inAppData as $product) {
                    //订单重复验证
                    $appleData = $product->check('自身业务去重');
                    if($appleData) {
                        continue ;
                        //return $this->code400('交易单号重复,请不要重复验证!id:'.$transactionId) ;
                    }
                    if(isset($productB[$product['product_id']])) {
                        $productId = $product['product_id'];
                        $money = $productB[$productId] ;
                        if(!$money) {
                            return $this->code400('没有找到对应产品的金额,ID:'.$product['product_id']) ;
                        }
                        //业务逻辑处理
                        //加余额,记录资金日志之类的操作
                        $product['add_balance'] = true ;
                    }
                    //环境
                    $product['is_sandbox']   = $this->sandbox ;
                    //数据
                    $product['receipt_data']  = $receipt ;
                    //时间
                    $product['time']         = date('YmdHis') ;
                    //返回码
                    $product['err_no']       = '200' ;
                    //save $product 保存数据
                }
            }
            //根据自身需求返回数据
            $returnData = [] ;
            return $this->code200($returnData) ;
        }
    }
}


/**
 * @doc https://developer.apple.com/library/archive/releasenotes/General/ValidateAppStoreReceipt/Chapters/ValidateRemotely.html
 * @sandboxUrl https://sandbox.itunes.apple.com/verifyReceipt
 * @proUrl https://buy.itunes.apple.com/verifyReceipt
 * Class ApplePayVerify
 */
class ApplePayVerify
{
    /** 环境地址,默认沙箱环境
     * @var string
     */
    private $endpoint = 'https://sandbox.itunes.apple.com/verifyReceipt';

    /** 沙箱环境地址
     * @var string
     */
    private $sandbox_endpoint = 'https://sandbox.itunes.apple.com/verifyReceipt';

    /** 正式运营的地址
     * @var string
     */
    private $pro_endpoint = ' https://buy.itunes.apple.com/verifyReceipt';

    /** 环境配置,默认沙箱环境
     * @var bool
     */
    private $sandbox = true;

    /** 自动订阅
     * @var bool
     */
    private $auto_renewable = false;

    /** 自动订阅的 app store密钥
     * @var
     */
    private $auto_renewable_password;

    /** 苹果bundle_id
     * @var array
     */
    private $bundle_id = [];

    /**
     * ApplePayVerify constructor.
     * @param $bundle_id
     */
    public function __construct($bundle_id)
    {
        if (is_string($bundle_id)) {
            $this->bundle_id = [$bundle_id];
        }

        if (is_array($bundle_id)) {
            $this->bundle_id = $bundle_id;
        }
    }

    /** 静态初始化
     * @param string $bundle_id
     * @return ApplePayVerify
     */
    public static function init($bundle_id)
    {
        return new self($bundle_id);
    }

    /** 设置环境，默认为沙箱环境
     * @param bool $isSandbox
     * @return $this
     */
    public function setEnv(bool $isSandbox = true)
    {
        if ($isSandbox) {
            $this->endpoint = $this->sandbox_endpoint;
        } else {
            $this->endpoint = $this->pro_endpoint;
        }
        $this->sandbox = $isSandbox;
        return $this;
    }

    /** 设置自动订阅和密钥
     * @param bool $isAuto
     * @param string $password
     * @return $this
     */
    public function setAutoRenewable(bool $isAuto = false, $password = '')
    {
        if ($isAuto && $password) {
            $this->auto_renewable = true;
            $this->auto_renewable_password = $password;
        } else {
            $this->auto_renewable = false;
        }
        return $this;
    }

    /** result as json
     * @param int $code
     * @param string $msg
     * @param array $data
     * @return string
     */
    private function jsonRet(int $code = 200, string $msg = '', array $data = [])
    {
        $result = [
            'code' => $code,
            'message' => $msg,
            'data' => $data,
        ];
        return json_encode($result, true);
    }

    /** code400
     * @param string $msg
     * @return string
     */
    private function code400($msg = '参数错误!')
    {
        return $this->jsonRet(400, $msg);
    }

    /** code200
     * @param array $data
     * @param string $msg
     * @return string
     */
    private function code200($data = [], $msg = '操作成功!')
    {
        return $this->jsonRet(200, $msg, $data);
    }

    /** log
     * @param $info
     */
    private function log($info)
    {
        //log info
    }

    /** 获取票证验证的数据
     * @param $receipt
     * @return false|string
     */
    protected function getReceiptData($receipt)
    {
        if ($this->auto_renewable) {
            $postData = json_encode(
                array(
                    //票证
                    'receipt-data' => $receipt,
                    //自动订阅 app store 秘钥
                    'password' => $this->auto_renewable_password
                )
                , JSON_UNESCAPED_SLASHES);
        } else {
            $postData = json_encode(
                array(
                    'receipt-data' => $receipt
                )
                , JSON_UNESCAPED_SLASHES);
        }
        return $postData;
    }

    /**　ios apple 支付验证
     * @param $receipt string 苹果支付认证的凭证(base64后的数据)
     * @return string
     */
    public function appleReceipt($receipt)
    {
        //苹果支付认证的凭证(base64后的数据)
        if (empty($receipt)) {
            return $this->code400();
        }
        //数据组装
        //$receipt ='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';
        $postData = $this->getReceiptData($receipt);
        //日志记录
        $this->log($postData);
        //curl操作
        $ch = curl_init($this->endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  //这两行一定要加，不加会报SSL 错误
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $response = curl_exec($ch);
        $errno = curl_errno($ch);
        curl_close($ch);
        if ($errno != 0) {
            return $this->code400('curl请求有错误!');
        } else {
            $data = json_decode($response, true);
            if (!is_array($data)) {
                return $this->code400('数据错误!');
            }
            //判断购买是否成功
            if (!isset($data['status']) || $data['status'] != 0) {
                return $this->code400('无效的iOS支付数据!');
            }
            //无效的bundle_id
            if (!in_array($data['receipt']['bundle_id'], $this->bundle_id)) {
                return $this->code400('无效的bundle_id:' . $data['receipt']['bundle_id']);
            }
            //多物品购买时
            // in_app为多个(坑)
            // ios一次支付可能返回多个,可能是上次成功后没有及时返回,这次成功后会把上次或上上次成功的返回
            if (!empty($inAppData = $data['receipt']['in_app'])) {
                //处理自身逻辑
                //$this->appleAppData($inAppData);
                return $this->code200($data['receipt']);
            }
            return $this->code400('验证成功,但没有数据！');
        }
    }

	/**
	 * 数据示例
	 */
	public function appleReceiptBackData()
	{
		/**
		 * @version 1.0 -1.1.0
		 * @tag two
		 */
		$versionTwo = '{
    "msg": "操作成功",
    "code": 200,
    "data": {
        "status": 0,
        "environment": "Sandbox",
        "receipt": {
            "receipt_type": "ProductionSandbox",
            "adam_id": 0,
            "app_item_id": 0,
            "bundle_id": "com.duluduludala.btvideo",
            "application_version": "1",
            "download_id": 0,
            "version_external_identifier": 0,
            "receipt_creation_date": "2020-05-10 12:27:48 Etc/GMT",
            "receipt_creation_date_ms": "1589113668000",
            "receipt_creation_date_pst": "2020-05-10 05:27:48 America/Los_Angeles",
            "request_date": "2020-05-10 12:30:47 Etc/GMT",
            "request_date_ms": "1589113847593",
            "request_date_pst": "2020-05-10 05:30:47 America/Los_Angeles",
            "original_purchase_date": "2013-08-01 07:00:00 Etc/GMT",
            "original_purchase_date_ms": "1375340400000",
            "original_purchase_date_pst": "2013-08-01 00:00:00 America/Los_Angeles",
            "original_application_version": "1.0",
            "in_app": [
                {
                    "quantity": "1",
                    "product_id": "2003",
                    "transaction_id": "1000000662646469",
                    "original_transaction_id": "1000000662646469",
                    "purchase_date": "2020-05-10 12:27:47 Etc/GMT",
                    "purchase_date_ms": "1589113667000",
                    "purchase_date_pst": "2020-05-10 05:27:47 America/Los_Angeles",
                    "original_purchase_date": "2020-05-10 12:27:48 Etc/GMT",
                    "original_purchase_date_ms": "1589113668000",
                    "original_purchase_date_pst": "2020-05-10 05:27:48 America/Los_Angeles",
                    "expires_date": "2020-05-10 13:27:47 Etc/GMT",
                    "expires_date_ms": "1589117267000",
                    "expires_date_pst": "2020-05-10 06:27:47 America/Los_Angeles",
                    "web_order_line_item_id": "1000000052368183",
                    "is_trial_period": "false",
                    "is_in_intro_offer_period": "false"
                }
            ]
        },
        "latest_receipt_info": [
            {
                "quantity": "1",
                "product_id": "2003",
                "transaction_id": "1000000662646469",
                "original_transaction_id": "1000000662646469",
                "purchase_date": "2020-05-10 12:27:47 Etc/GMT",
                "purchase_date_ms": "1589113667000",
                "purchase_date_pst": "2020-05-10 05:27:47 America/Los_Angeles",
                "original_purchase_date": "2020-05-10 12:27:48 Etc/GMT",
                "original_purchase_date_ms": "1589113668000",
                "original_purchase_date_pst": "2020-05-10 05:27:48 America/Los_Angeles",
                "expires_date": "2020-05-10 13:27:47 Etc/GMT",
                "expires_date_ms": "1589117267000",
                "expires_date_pst": "2020-05-10 06:27:47 America/Los_Angeles",
                "web_order_line_item_id": "1000000052368183",
                "is_trial_period": "false",
                "is_in_intro_offer_period": "false",
                "subscription_group_identifier": "20633812"
            }
        ],
        "latest_receipt": "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",
        "pending_renewal_info": [
            {
                "auto_renew_product_id": "2003",
                "original_transaction_id": "1000000662646469",
                "product_id": "2003",
                "auto_renew_status": "1"
            }
        ]
    },
    "time": 1589113847
}';
    }

    /** 自身业务处理
     * @param $appData
     * @return string
     */
    public function appleAppData($appData)
    {
        $inAppData = $appData['in_app'];
        //产品配置,对应ios申请的product_id eg : yw_6 支付6元
        $productB = ['yw_6'];
        //多物品信息
        foreach ($inAppData as $product) {
            //订单重复验证
            $appleData = $product->check('自身业务去重');
            if ($appleData) {
                continue;
                //return $this->code400('交易单号重复,请不要重复验证!id:'.$transactionId) ;
            }
            //产品验证
            if (isset($productB[$product['product_id']])) {
                $productId = $product['product_id'];
                $money = $productB[$productId];
                if (!$money) {
                    return $this->code400('没有找到对应产品的金额,ID:' . $product['product_id']);
                }
                //业务逻辑处理
                //加余额,记录资金日志之类的操作
                $product['add_balance'] = true;
            }
            //环境
            $product['is_sandbox'] = $this->sandbox;
            //数据
            $product['receipt_data'] = '$receipt';
            //时间
            $product['time'] = date('YmdHis');
            //返回码
            $product['err_no'] = '200';
            //save $product 保存数据
        }
        //根据自身需求返回数据
        $returnData = [];
        return $this->code200($returnData);
    }
}