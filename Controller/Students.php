<?php

class Controller_Students {
    public function action_index() {
        $student_id = app::factory()->id;
        $student_model = new Model_Student();

        $student_data = $student_model->get_data($student_id);

        $this->response_student_data($student_data);
    }

    private function response_student_data($student_data) {
        header('Content-Type: application/json');

        echo json_encode($student_data, JSON_UNESCAPED_SLASHES, JSON_PRETTY_PRINT);
    }
}