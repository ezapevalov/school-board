<?php

class Controller_Index {
    public function action_index() {
        header('Content-Type: application/json');

        echo json_encode([
            'hint' => 'This is a default entry point. Try /students/[id]'
        ], JSON_UNESCAPED_SLASHES, JSON_PRETTY_PRINT);
    }
}