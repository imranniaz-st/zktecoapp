<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rats\Zkteco\Lib\ZKTeco;

class ZKTecoController extends Controller
{
    /**
     * Display the form for inputting device addresses.
     */
    public function showForm()
    {
        $defaultAddresses = implode("\n", [
            '34.117.83.172',
            '34.110.9.191',
            '31.136.247.17',
            '125.141.136.134',
            '147.47.39.174',
            '139.39.175.196',
            '214.79.28.233',
            '31.200.26.130',
            '31.33.14.220',
            '109.36.89.175',
            '139.38.172.218',
            '94.121.64.5',
            '156.254.98.59',
            '214.17.1.106',
            '34.120.193.245',
            '166.104.147.228',
            '83.66.219.134',
            '34.102.153.150',
            '162.99.52.195',
            '66.51.123.181',
            '34.160.150.18',
            '214.75.35.145',
            '163.191.90.98',
            '31.200.76.66',
            '214.77.167.110',
            '198.99.67.62',
            '156.254.107.230',
            '195.128.35.11',
            '34.54.204.0',
            '72.3.23.217',
            '168.221.123.106',
            '34.43.253.217',
            '214.78.112.196',
            '175.139.181.26',
            '214.17.87.105',
            '137.132.231.153',
            '161.223.174.58',
            '5.209.157.80',
            '93.110.59.105',
            '214.2.194.121',
            '34.36.56.18',
            '139.38.26.90',
            '152.30.129.18',
            '137.132.254.200',
            '112.15.42.104',
            '144.167.221.66',
            '146.148.227.125',
            '94.121.213.6',
            '198.190.86.253',
            '176.168.65.40'
        ]);

        return view('zkteco.form', compact('defaultAddresses'));
    }

    /**
     * Check the status of multiple ZKTeco devices.
     */
    public function checkMultipleStatus(Request $request)
    {
        $addressesInput = $request->input('addresses', '');
        $addresses = [];

        $lines = explode("\n", $addressesInput);
        foreach ($lines as $line) {
            $parts = explode(',', trim($line));
            if (count($parts) > 0) {
                $addresses[] = [
                    'ip' => trim($parts[0]),
                    'port' => isset($parts[1]) ? (int) trim($parts[1]) : 4370,
                ];
            }
        }

        $statuses = [];

        foreach ($addresses as $address) {
            $ip = $address['ip'];
            $port = $address['port'];
            $timeout = 5; // Timeout in seconds

            $zk = new ZKTeco($ip, $port);

            // Set up the context for the connection with a timeout
            $context = stream_context_create([
                'socket' => [
                    'connect' => [
                        'timeout' => $timeout,
                    ],
                ],
            ]);

            // Attempt to connect to the device
            try {
                $connected = $zk->connect($context);

                if ($connected) {
                    $status = [
                        'ip' => $ip,
                        'port' => $port,
                        'connected' => true,
                        'version' => $zk->version(),
                        'os_version' => $zk->osVersion(),
                        'platform' => $zk->platform(),
                        'firmware_version' => $zk->fmVersion(),
                        'serial_number' => $zk->serialNumber(),
                        'device_name' => $zk->deviceName(),
                        'device_time' => $zk->getTime(),
                    ];

                    // Disconnect from the device
                    $zk->disconnect();
                } else {
                    $status = [
                        'ip' => $ip,
                        'port' => $port,
                        'connected' => false,
                    ];
                }
            } catch (\Exception $e) {
                $status = [
                    'ip' => $ip,
                    'port' => $port,
                    'connected' => false,
                    'error' => $e->getMessage(),
                ];
            }

            $statuses[] = $status;
        }

        return view('zkteco.status', ['statuses' => $statuses]);
    }
}
