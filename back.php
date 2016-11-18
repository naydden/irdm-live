<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require __DIR__ . '/vendor/autoload.php'; // make sure we load dependencies

class BackEnd implements MessageComponentInterface {
	protected $clients;

	public function __construct() {
		$this->clients = new \SplObjectStorage;
	}

	public function onOpen(ConnectionInterface $conn) {
		$this->clients->attach($conn);
		$this->clients->send("hell");
		echo "New Client Connected! ({$conn->resourceId})\n";
	}

	public function onMessage(ConnectionInterface $from, $msg) {
        echo "New Message!\n";
    }

    public function onClose(ConnectionInterface $conn) {
    	$this->clients->detach($conn);
        echo "Closed connection {$conn->resourceId}\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
    	$conn->close();
        echo "ERROR - {$e->getMessage()}\n";
    }
}

$app = new Ratchet\App('localhost', 8080);
$app->route('/', new BackEnd);
$app->run();
