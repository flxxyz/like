<?php

namespace App\Controllers;


use App\Models\Domain;
use App\Models\DomainTotal;
use App\Models\User;
use Col\Lib\Config;
use Col\Request;

class LikeController extends BaseController
{
    public function __construct()
    {
        header("Pragma: no-cache");
        header("Expires: 0");
        header("Cache-Control: max-age=0, no-cache, no-store");
        header("Access-Control-Allow-Origin: *");
    }

    /**
     * 获取心心
     * @param Request $request
     * @return array|false|string
     */
    public function get(Request $request)
    {
        list($user, $domain) = $this->checkParam($request);

        $name = $request->get('user', 'flxxyz');
        $key = $request->get('key');

        $domain_total = DomainTotal::where([
            'user_id' => $user->id,
            'domain_id' => $domain->id,
        ])->find();
        if ($domain_total === false) {
            logger()->warn('用户与域名不匹配 name='.$name.',key='.$key);
            return $this->ajax('用户与域名不匹配', [], 404);
        }

        $data = [
            'count' => intval($domain_total->total),
        ];

        return $this->ajax('获取💗💗成功', $data);
    }

    /**
     * 加心心
     * @param Request $request
     * @return array|false|string
     */
    public function add(Request $request)
    {
        list($user, $domain) = $this->checkParam($request);

        $name = $request->get('user', 'flxxyz');
        $key = $request->get('key');

        $domain_total = DomainTotal::where([
            'user_id' => $user->id,
            'domain_id' => $domain->id,
        ])->find();
        if ($domain_total === false) {
            logger()->warn('用户与域名不匹配 name='.$name.',key='.$key);
            return $this->ajax('用户与域名不匹配', [], 404);
        }

        $bool = DomainTotal::where([
            'user_id' => $user->id,
            'domain_id' => $domain->id,
        ])->update([
            'total' => $domain_total->total + 1,
        ]);
        if ($bool === false) {
            $total = $domain_total->total;
        } else {
            $total = $domain_total->total + 1;
        }

        $data = [
            'count' => $total,
        ];

        return $this->ajax('😘爱你哟', $data);
    }

    /**
     * 检查参数
     * @param Request $request
     * @return array|false|string
     */
    public function checkParam(Request $request)
    {
        $name = $request->get('user', 'flxxyz');
        $key = $request->get('key');

        $this->checkReferer($name, $key);

        $domain = Domain::where([
            'hash' => $key,
        ])->find();
        if ($domain === false) {
            logger()->warn('查询域名失败 name='.$name.',key='.$key);
            exit($this->ajax('抱歉，域不存在', [], 404));
        }

        $user = User::where([
            'name' => $name,
        ])->find();
        if ($user === false) {
            logger()->warn('查询用户失败 name='.$name.',key='.$key);
            exit($this->ajax('查询用户失败', [], 404));
        }

        return [$user, $domain];
    }

    /**
     * 检查来源
     * @param $name
     * @param $key
     */
    public function checkReferer($name, $key)
    {
        if (!isset($_SERVER['HTTP_REFERER'])) {
            logger()->err('有二五仔直接请求来了！ name='.$name.', key='.$key);
            exit($this->ajax('非法访问', [], 400));
        }

        if (empty($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] == '') {
            logger()->err('居然不知道二五仔是哪里来的！！！ name='.$name.', key='.$key);
            exit($this->ajax('非法访问', [], 400));
        }

        $not_url = Config::get('app', 'not_url');
        $domain = parse_url($_SERVER['HTTP_REFERER']);
        foreach ($not_url as $value) {
            if (preg_match($value, $domain['host'], $match)) {
                logger()->err('这个二五仔来的位置被限制了 name='.$name.', key='.$key);
                exit($this->ajax('非法访问', [], 401));
            }
        }
    }
}