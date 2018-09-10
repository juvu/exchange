<?php

function userid()
{
	return 1;
}

function islogin()
{
	return 3;
}

/**
 * 百度获取美元兑人民币汇率.
 */
function getRateByBaidu($from = 'USD', $to = 'CNY', $amount = 1)
{
    $data = file_get_contents("http://www.baidu.com/s?wd={$from}%20{$to}&rsv_spt={$amount}");

    preg_match("/<div>1\D*=(\d*\.\d*)\D*<\/div>/", $data, $converted);

    $converted = preg_replace('/[^0-9.]/', '', $converted[1]);

    return number_format(round($converted, 3), 2);
}