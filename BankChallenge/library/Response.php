<?php
class Response {
    public $Status;
    public $Message;

    public function __construct($status, $message) {
        $this->Status = $status;
        $this->Message = $message;
    }

    public function ToJson() {
        echo json_encode([
            'Status' => $this->Status,
            'Message' => $this->Message
        ]);
    }

    public function ExitScript() {
        $this->ToJson();
        exit;
    }
}
?>