<?php

set_time_limit(300);
$host = 'localhost';
$port = '8080';
$null = NULL;

$socket = socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'));
socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);
socket_bind($socket, $host, $port);
socket_listen($socket);

$users = array($socket);
while (true) {
    $read = $users;
    socket_select($read, $null, $null, 0);
    if (in_array($socket, $read)) {
        $users[] = $newsocket = socket_accept($socket);
        $datastring = socket_read($newsocket, 1024);
        handshak($datastring, $newsocket);
        socket_getpeername($newsocket, $ip, $ipport);
        send_message(encode(json_encode(array('name' => 'system', 'message' => 'new user connected [ ip = ' . $ip . ':' . $ipport . ' ] & number of users = ' . count($users) - 1))));
        unset($read[array_search($socket, $read)]);
    }
    foreach ($read as $readsocket) {
        while (socket_recv($readsocket, $datareadsocket, 1024, 0) >= 1) {
            send_message(encode(json_encode(array('name' => json_decode(decode($datareadsocket), true)['name'], 'message' => json_decode(decode($datareadsocket), true)['message']))));
            break 2;
        }
        $datastring = socket_read($readsocket, 1024, PHP_NORMAL_READ);
        if ($datastring === false) {
            socket_getpeername($readsocket, $ip, $ipport);
            unset($users[array_search($readsocket, $users)]);
            send_message(encode(json_encode(array('name' => 'system', 'message' => 'a user disconnected [ ip = ' . $ip . ':' . $ipport . ' ] & number of users = ' . count($users) - 1))));
        }
    }
}
socket_close($socket);

function encode($string) {
    $b1 = 0x80 | (0x1 & 0x0f);
    $length = strlen($string);
    if ($length <= 125) {
        $encode = pack('CC', $b1, $length);
    } elseif ($length > 125 && $length < 65536) {
        $encode = pack('CCn', $b1, 126, $length);
    } elseif ($length >= 65536) {
        $encode = pack('CCNN', $b1, 127, $length);
    }
    return $encode . $string;
}

function send_message($message) {
    global $users;
    foreach ($users as $readsocket) {
        socket_write($readsocket, $message, strlen($message));
    }
    return true;
}

function decode($string) {
    $length = ord($string[1]) & 127;
    if ($length == 126) {
        $decode = substr($string, 4, 4);
        $data = substr($string, 8);
    } elseif ($length == 127) {
        $decode = substr($string, 10, 4);
        $data = substr($string, 14);
    } else {
        $decode = substr($string, 2, 4);
        $data = substr($string, 6);
    }
    $string = '';
    for ($i = 0; $i < strlen($data); ++$i) {
        $string .= $data[$i] ^ $decode[$i % 4];
    }
    return $string;
}

function handshak($datastring, $newsocket) {
    $headers = array();
    $lines = preg_split('/\r\n/', $datastring);
    foreach ($lines as $line) {
        $line = chop($line);
        if (preg_match('/\A(\S+): (.*)\z/', $line, $matches)) {
            $headers[$matches[1]] = $matches[2];
        }
    }
    $secKey = $headers['Sec-WebSocket-Key'];
    $secAccept = base64_encode(pack('H*', sha1($secKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
    $buffer = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
            "Upgrade: websocket\r\n" .
            "Connection: Upgrade\r\n" .
            "Sec-WebSocket-Accept:$secAccept\r\n\r\n";
    socket_write($newsocket, $buffer, strlen($buffer));
}

?>
