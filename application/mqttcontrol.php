<?php
require "database.php";
$client = new Mosquitto\Client();
$client->onConnect('connect');
$client->onDisconnect('disconnect');
$client->onSubscribe('subscribe');
$client->onMessage('message');
$client->connect("localhost", 1883, 5);
$client->subscribe('/#', 1);

$db = new database();
while (true) {
    $client->loop();
    $control = $db->get_data();
    print_r($control[0]);
    foreach ($control as $c => $value) {
        $control = $db->get_data();
        if ($value['nilai'] == 1) {
            $topic = "buzzer/" . $value['chip_id'];
            $pesan = "1";
            $mid = $client->publish($topic, $pesan, 1, 0);
            echo "Sent message ID: {$mid}\n";
            //      $client->loop();
            // sleep(2);
        } else {
            $topic = "buzzer/" . $value['chip_id'];
            $pesan = "0";
            $mid = $client->publish($topic, $pesan, 1, 0);
            echo "Sent message ID: {$mid}\n";
        }
    }
    $mid = $client->publish('/hello', "Hello from PHP at " . date('Y-m-d H:i:s'), 1, 0);
    echo "Sent message ID: {$mid}\n";
    $client->loop();

    sleep(2);
}

$client->disconnect();
unset($client);

function connect($r)
{
    echo "I got code {$r}\n";
}

function subscribe()
{
    echo "Subscribed to a topic\n";
}

function message($message)
{
    printf("Got a message ID %d on topic %s with payload:\n%s\n\n", $message->mid, $message->topic, $message->payload);
    $hasil = json_decode($message->payload, TRUE);
    // print_r ($hasil);
    $data = [];
    if ($message->topic == "buzzer") {
        $hasil = json_decode($message->payload, TRUE);
        $data = [];

        foreach ($hasil as $item) {
            $data[] = [
                'chip_id' => $item['chip_id'],
                'nilai' => $item['nilai'],
            ];
        }
    }
    $db = new database();
    $db->update_control($data);
}


function disconnect()
{
    echo "Disconnected cleanly\n";
}
