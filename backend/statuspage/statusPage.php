<?php
namespace NerdBaggy\StatusPage;

class statusPage
{
    
    public function getChecks($action = null)
    {
        $cache = phpFastCache();
        
        $allChecks = $cache->get('statuspage-allChecks');
        if ($allChecks === null) {

            if ($action === 'update'){
                $this->updateCache(true);
            }else{
                $this->updateCache(false);
            }
            $allChecks = $cache->get('statuspage-allChecks');
        }

        $needsUpdated = false;
        foreach ($allChecks as $key => $cid) {
            $allCheckInfo[] = $cache->get('statuspage-' . $cid);
            if (count($allCheckInfo[0]['log']) === 0 && $action === 'update'){
                $needsUpdated = true;
                unset($allCheckInfo);
                break;
            }
        }

        if ($needsUpdated){
            $this->updateCache(true);
            
            foreach ($allChecks as $key => $cid) {
                $allCheckInfo[] = $cache->get('statuspage-' . $cid);
            }
        }
        return $allCheckInfo;
    }
    
    public function updateCache($action)
    {
        date_default_timezone_set("UTC");
        $cache            = phpFastCache();
        $checksArray      = $this->getChecksJson($action);
        $excludedMonitors = unserialize(constant('excludedMonitors'));
        
        foreach ($checksArray['monitors']['monitor'] as $key => $check) {
            if (!in_array($check['id'], $excludedMonitors)) {
                
                
                $allCheckID[]       = $check['id'];
                $fixedResponseTimes = array();
                $fixedEventTime = array();

                if (is_array($check['responsetime'])) {
                    
                    foreach ($check['responsetime'] as $key => $restime) {
                        $fixedResponseTimes[] = array(
                            'datetime' => date("Y-m-d G:i:s", strtotime($restime['datetime'])),
                            'value' => $restime['value']
                            );
                    }

                }

                if (!is_null($check['log'])){



                   foreach ($check['log'] as $key => $dt) {
                    $fixedEventTime[] = array(
                        'actualTime' => $dt['datetime'],
                        'type' => $dt['type'],
                        'datetime' => strtotime($dt['datetime'])
                        );
                }

            }


            $tempCheck = array(
                'id' => $check['id'],
                'name' => html_entity_decode($check['friendlyname']),
                'type' => $check['type'],
                'interval' => $check['interval'],
                'status' => $check['status'],
                'allUpTimeRatio' => $check['alltimeuptimeratio'],
                'customUptimeRatio' => explode("-", $check['customuptimeratio']),
                'log' => $fixedEventTime,
                'responseTime' => $fixedResponseTimes,
                'timezone' => intval($checksArray['timezone']),
                'currentTime' => time() + (intval($checksArray['timezone']))* 60
                );
            $cache->set('statuspage-' . $check['id'], $tempCheck, constant('cacheTime'));
        }
    }
    $cache->set('statuspage-allChecks', $allCheckID, constant('cacheTime'));
}

public function getTableHeaders()
{
    foreach (unserialize(constant('historyDaysNames')) as $key => $historyDaysName) {
        $headToSend[] = $historyDaysName;
    }
    $headToSend[] = 'Total';
    return $headToSend;
}

public function padIt($checks)
{
    return 'StatusPage(' . json_encode($checks) . ')';
}

private function getChecksJson($action)
{
    $apiKey     = constant('apiKey');
    $historyDay = constant('historyDay');
    
    $url = "https://api.uptimerobot.com/getMonitors?apikey=$apiKey&format=json&noJsonCallback=1&customUptimeRatio=$historyDay";
    
    if ($action){

        $url .= '&logs=1&responseTimes=1&responseTimesAverage=30&showTimezone=1';
    }

    if (constant('includedMonitors') != '') {
        $monitors = constant('includedMonitors');
        $url .= "&monitors=$monitors";
    }
    
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_USERAGENT => 'UptimeRobot Public Status Page',
        CURLOPT_CONNECTTIMEOUT => 10
        ));
    $checks = json_decode(curl_exec($curl), TRUE);
        //Checks to make sure curl is happy
    if (curl_errno($curl)) {
        return False;
    }
    curl_close($curl);
        //Checks to make sure UptimeRobot didn't return any errors
    if ($checks['stat'] != 'ok') {
        error_log('UptimeRobot API Error - ' . $checks['message']);
        return False;
    }
    return $checks;
}

}
