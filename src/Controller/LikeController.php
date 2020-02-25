<?php

namespace App\Controller;

use App\Controller\BaseController;
use Exception;
use LeanCloud\Query;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class LikeController extends BaseController
{
    public function get(Request $request, Response $response)
    {
        $this->response = $response;
        $this->query = $request->getQueryParams();

        if ($this->checkReferer($code)) {
            return $this->json('非法访问', [], '', $code);
        }

        $query = new Query('Domain');
        try {
            $domain = $query->get($this->query('key'));
        } catch (Exception $e) {
            error_log('Query todo failed!');
            $domain = null;
        }

        if (is_null($domain)) {
            return $this->json('🙅‍不存在的领域', [], '', 404);
        }

        return $this->json('获取💗💗成功', [
            'count' => $domain->get('amount'),
        ], $domain->get('name'));
    }

    public function add(Request $request, Response $response)
    {
        $this->response = $response;
        $this->body = $request->getParsedBody();

        if ($this->checkReferer($code)) {
            return $this->json('非法访问', [], '', $code);
        }

        $query = new Query('Domain');
        try {
            $domain = $query->get($this->body('key'))->increment('amount');
        } catch (Exception $e) {
            error_log('Query data failed!');
            $domain = null;
        }

        if (is_null($domain)) {
            return $this->json('🙅‍不存在的领域', [], '', 404);
        }

        try {
            $domain->save();
        } catch (Exception $e) {
            error_log('Save data failed!');
        }

        return $this->json('😘爱你哟', [
            'count' => $domain->get('amount'),
        ], $domain->get('name'));
    }
}
