<?php

namespace App\Entities\DataIntentionsRequest\Repositories;

use Midnite81\GeoLocation\Services\GeoLocation;
use App\Entities\DataIntentionsRequest\DataIntentionsRequest;
use Illuminate\Http\Request;
use App\Entities\DataIntentionsRequest\Repositories\Interfaces\DataIntentionsRequestRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;


class DataIntentionsRequestRepository implements DataIntentionsRequestRepositoryInterface
{
    public function __construct(
        DataIntentionsRequest $dataIntentionRequest
    ) {
        $this->model = $dataIntentionRequest;
    }

    public function createDataIntentionRequest($intention_id)
    {
        $data = [
            'intention_id' => $intention_id,
            'city' => $this->getCity(),
            'type_device' => $this->getTypeDevice(),
            'browser' => $this->getBrowser(),
            'os' => $this->getOs() . " - " . php_uname(),
            'ip' => \Request::getClientIp(true)
        ];
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }



    private function getTypeDevice()
    {
        $typeDevice = 'Computador de Escritorio o Portátil';

        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $typeDevice = "Tablet";
        }

        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $typeDevice = "Celular";
        }

        if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
            $typeDevice = "Celular";
        }

        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
        $mobile_agents = array(
            'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
            'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
            'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
            'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
            'newt', 'noki', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
            'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
            'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
            'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
            'wapr', 'webc', 'winw', 'winw', 'xda ', 'xda-'
        );

        if (in_array($mobile_ua, $mobile_agents)) {
            $typeDevice = "Celular";
        }

        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'opera mini') > 0) {
            $typeDevice = "Celular";
            //Check for tablets on opera mini alternative headers
            $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));
            if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
                $typeDevice = "Tablet";
            }
        }

        return $typeDevice;
    }

    private function getOs()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_array =  array(
            '/windows nt 10/i'      =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );
        //
        $os_platform = "Unknown OS Platform";
        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $os_platform = $value;
            }
        }
        return $os_platform;
    }

    function getBrowser()
    {
        $agente = $_SERVER['HTTP_USER_AGENT'];
        $navegador = 'Unknown';

        if (preg_match('/MSIE/i', $agente) && !preg_match('/Opera/i', $agente)) {
            $navegador = 'Internet Explorer';
        } elseif (preg_match('/Firefox/i', $agente)) {
            $navegador = 'Mozilla Firefox';
        } elseif (preg_match('/Chrome/i', $agente)) {
            $navegador = 'Google Chrome';
        } elseif (preg_match('/Safari/i', $agente)) {
            $navegador = 'Apple Safari';
        } elseif (preg_match('/Opera/i', $agente)) {
            $navegador = 'Opera';
        } elseif (preg_match('/Netscape/i', $agente)) {
            $navegador = 'Netscape';
        }

        return $navegador;
    }

    public function getCity()
    {
        $geo = new GeoLocation();

        $ipLocation = $geo->getCity(\Request::getClientIp(true));

        return $ipLocation->addressString;
    }

    public function countDataIntentionsForTypedevice($from, $to)
    {
        try {
            return  $this->model->select('type_device', DB::raw('count(*) as total'))
                ->whereBetween('created_at', [$from, $to])
                ->groupBy('type_device')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countDataIntentionsForBrowser($from, $to)
    {
        try {
            return  $this->model->select('browser', DB::raw('count(*) as total'))
                ->whereBetween('created_at', [$from, $to])
                ->groupBy('browser')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }
}