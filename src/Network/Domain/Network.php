<?php

declare(strict_types=1);

namespace Tappx\Network\Domain;

final class Network
{
    private array $params = [];

    public function __construct(string $key, int $timeout, int $testMode, array $dataRequest)
    {
        $this->params['key'] = $key;
        $this->params['timeout'] = $timeout;
        $this->params['cb'] = time();
        $this->params['Test'] = $testMode;
        $this->searchForFields($dataRequest);;
    }

    private function searchForFields(array $dataRequest)
    {
        if (isset($dataRequest['imp']['0']['banner']['w']) && $dataRequest['imp']['0']['banner']['h'])
            $this->params['sz'] = $dataRequest['imp']['0']['banner']['w'] . 'x' . $dataRequest['imp']['0']['banner']['h'];

        if (isset($dataRequest['device']['os']))
            $this->params['os'] = $dataRequest['device']['os'];

        if (isset($dataRequest['device']['ip']))
            $this->params['ip'] = $dataRequest['device']['ip'];

        if (isset($dataRequest['app']))
            $this->params['source'] = 'app';
        else
            $this->params['source'] = 'mweb';

        if (isset($dataRequest['app']['bundle']))
            $this->params['ab'] = $dataRequest['app']['bundle'];

        if (isset($dataRequest['device']['ifa']))
            $this->params['aid'] = $dataRequest['device']['ifa'];

        $this->params['mraid'] = 2;

        if (isset($dataRequest['device']['ua']))
            $this->params['ua'] = $dataRequest['device']['ua'];

        $this->params['aidl'] = 0;

        if (isset($dataRequest['device']['geo']['lat']))
            $this->params['lat'] = $dataRequest['device']['geo']['lat'];

        if (isset($dataRequest['device']['geo']['lon']))
            $this->params['lon'] = $dataRequest['device']['geo']['lon'];

        if (isset($dataRequest['app']['name']))
            $this->params['an'] = $dataRequest['app']['name'];

        if (isset($dataRequest['app']['storeurl']))
            $this->params['url'] = $dataRequest['app']['storeurl'];

        if (isset($dataRequest['app']['id']))
            $this->params['qapid'] = $dataRequest['app']['id'];

        $this->params['secure'] = 0;

        if (isset($dataRequest['device']['osv']))
            $this->params['ov'] = $dataRequest['device']['osv'];

        if (isset($dataRequest['device']['osv']))
            $this->params['ov'] = $dataRequest['device']['osv'];

        if (isset($dataRequest['device']['make']))
            $this->params['mn'] = $dataRequest['device']['make'];

        if (isset($dataRequest['device']['model']))
            $this->params['mo'] =  $dataRequest['device']['model'];

        if (isset($dataRequest['device']['language']))
            $this->params['ln'] =  $dataRequest['device']['language'];
    }

    public function params(): array
    {
        return $this->params;
    }
}