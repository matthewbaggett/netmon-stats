<?php

require_once("../bootstrap.php");
require_once("../database.php");

$results = ['cols' => [], 'rows' => []];

$results['cols'] = [
    [
        'type' => 'datetime',
        'label' => 'time',
    ],
    [
        'type' => 'number',
        'label' => 'Upstream',
    ],
    [
        'type' => 'number',
        'label' => 'Downstream',
    ],
    [
        'type' => 'number',
        'label' => 'Latency',
    ]
];

foreach($pdo->query("SELECT * FROM speedtests ORDER BY `time` ASC") as $speedtest){
    $result = [
        ['v' => date_format_for_google_maps($speedtest['time'])],
        ['v' => $speedtest['up']/1000000, 'f' => number_format($speedtest['up']/1000000,2) . "Mbps"],
        ['v' => $speedtest['down']/1000000,'f' => number_format($speedtest['down']/1000000,2) . "Mbps"],
        ['v' => $speedtest['ping'], 'f' => number_format($speedtest['ping'],2) . "ms"],
    ];

    $results['rows'][] = ['c' => $result];
}

echo json_encode($results, JSON_PRETTY_PRINT);

function date_format_for_google_maps($time){
    $time = strtotime($time);
    return sprintf(
        "Date(%d, %d, %d, %d, %d, %d)",
        date("Y", $time),
        intval(date("m", $time)) - 1,
        date("d", $time),
        date("H", $time),
        date("i", $time),
        date("s", $time)
    );
}