<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Market;
use App\Models\Coin;
use App\Models\TradeLog;
use App\Models\Sicon;
use App\Models\UserCoin;

class AjaxController extends Controller
{
    /**
     * 热门币种（页头）.
     *
     * @param Request $request [description]
     *
     * @return [type] [description]
     */
    public function getHotCoin(Request $request)
    {
        $data = array();

        //根据总销量查询热门币种
        $coins = Market::where(['status' => 1])->orderBy('id')->limit(4)->get()->toArray();
        //处理名称
        $data = array();
        foreach ($coins as $key => $coin) {
            $data[$key]['name'] = strtoupper(explode('_', $coin['name'])[0]).'/'.strtoupper(explode('_', $coin['name'])[1]);
            $data[$key]['new_price'] = $coin['new_price'];
            $data[$key]['change'] = $coin['change'];
        }

        return response()->json($data);
    }

    /**
     * 获取币种菜单.
     *
     * @param Request $request [description]
     *
     * @return [type] [description]
     */
    public function getJsonMenu(Request $request)
    {
        //币种
        $markets = Market::where(['status' => 1])->orderBy('id')->limit(4)->get()->toArray();

        foreach ($markets as $k => $v) {
            $v['xnb'] = explode('_', $v['name'])[0];
            $v['rmb'] = explode('_', $v['name'])[1];
            $coin = Coin::where('name', $v['xnb'])->first();
            $data[$k]['name'] = $v['name'];
            $data[$k]['img'] = '/storage/img/coin/'.$coin->img;
            $data[$k]['title'] = $coin->title;
        }

        return response()->json($data);
    }

    /**
     * 获取趋势
     *
     * @param Request $request [description]
     *
     * @return [type] [description]
     */
    public function trends(Request $request)
    {
        //币种
        $markets = Market::where(['status' => 1])->orderBy('id')->limit(4)->get()->toArray();

        foreach ($markets as $k => $v) {
            //获取3日趋势

            $data[$k]['data'] = $v['tendency'];
            $data[$k]['yprice'] = $v['new_price'];
        }

        return response()->json($data);
    }

    /**
     * 获取币种信息.
     *
     * @param Request $request [description]
     *
     * @return [type] [description]
     */
    public function allcoin(Request $request)
    {
        // 市场交易记录
        $marketLogs = array();
        /*foreach (C('market') as $k => $v) {
            $_tmp = S('getTradelog'.$k);
            if (!empty($_tmp)) {
                $marketLogs[$k] = $_tmp;
            } else {
                $tradeLog = M('TradeLog')->where(array('status' => 1, 'market' => $k))->order('id desc')->limit(50)->select();
                $_data = array();
                foreach ($tradeLog as $_k => $v) {
                    $_data['tradelog'][$_k]['addtime'] = date('m-d H:i:s', $v['addtime']);
                    $_data['tradelog'][$_k]['type'] = $v['type'];
                    $_data['tradelog'][$_k]['price'] = $v['price'] * 1;
                    $_data['tradelog'][$_k]['num'] = round($v['num'], 6);
                    $_data['tradelog'][$_k]['mum'] = round($v['mum'], 2);
                }
                $marketLogs[$k] = $_data;
                S('getTradelog'.$k, $_data);
            }
        }

        $themarketLogs = array();
        if ($marketLogs) {
            $last24 = time() - 86400;
            $_date = date('m-d H:i:s', $last24);
            foreach (C('market') as $k => $v) {
                $tradeLog = isset($marketLogs[$k]['tradelog']) ? $marketLogs[$k]['tradelog'] : null;
                if ($tradeLog) {
                    $sum = 0;
                    foreach ($tradeLog as $_k => $_v) {
                        if ($_v['addtime'] < $_date) {
                            continue;
                        }
                        $sum += $_v['mum'];
                    }
                    //$sum = M('TradeLog')->where(array('status' => 1, 'market' => $k))->sum('mum');
                    $themarketLogs[$k] = $sum;
                }
            }
        }*/

        $markets = Market::where(['status' => 1])->orderBy('id')->limit(4)->get()->toArray();

        foreach ($markets as $k => $v) {
            $jyd = explode('_', $v['name'])[0];

            $coin = Coin::where('name', $jyd)->first();

            $data[$k][0] = $coin->title;
            $data[$k][1] = round($v['new_price'], $v['round']);
            $data[$k][2] = round($v['buy_price'], $v['round']);
            $data[$k][3] = round($v['sell_price'], $v['round']);
            $data[$k][4] = round(TradeLog::where(array('status' => 1, 'market' => $k))->sum('mum'));
            $data[$k][5] = '';
            $cnum = Coin::where(array('name' => $jyd))->find('cs_cl');
            $data[$k][6] = round($data[$k][1] * $cnum);
            $data[$k][7] = round($v['change'], 2);
            $data[$k][8] = $v['name'];
            $data[$k][9] = '/storage/img/coin/'.$coin->img;
            $data[$k][10] = '';
            if (!userid()) {
                $data[$k][11] = 0;
            } else {
                $data[$k][11] = Sicon::where(array('userid' => userid(), 'market' => $v['name']))->find('status');
            }
        }

        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods:POST');
        header('Access-Control-Allow-Headers:x-requested-with,content-type');

        return response()->json($data);
    }

    /**
     * 计算用户总资产.
     *
     * @param Request $request [description]
     *
     * @return [type] [description]
     */
    public function allfinance(Request $request)
    {
        if (!userid()) {
            return false;
        }
        $UserCoin = UserCoin::where(array('userid' => userid()))->first();
        //获取所有开放的币种
        $coins = Coin::where(array('status' => 1))->get();
        //美元
        $usdt = 0;
        foreach ($coins as $coin) {
            if ($coin['name'] == 'usdt') {
                $usdt = bcadd($usdt, bcadd($UserCoin['usdt'], $UserCoin['usdtd'], 8), 8);
            } else {
                //获取市场最新成交价
                $newPrice = Market::where(array('name' => $coin['name'].'_usdt'))->select('new_price')->get();
                //换算成usdt
                $usdt = bcadd($usdt, bcmul(bcadd($UserCoin[$coin['name']], $UserCoin[$coin['name'].'d'], 8), $newPrice, 8), 8);
            }
        }
        $data = sprintf('%.2f', $usdt);
        //如果需要换算成人民币
        $data = bcmul($usdt, getRateByBaidu(), 2);

        return response()->json($data);
    }
}
