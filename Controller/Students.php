<?php

use Spatie\ArrayToXml\ArrayToXml;

class Controller_Students {
    public function action_index() {
        $student_id = app::factory()->id;
        $student_model = new Model_Student();

        $student_data = $student_model->get_data($student_id);

        $this->response_student_data($student_data);
    }

    private function response_student_data($student_data) {
        switch ($student_data['board_name']) {
            case 'CSMB': // response XML
                header("Content-type: text/xml; charset=utf-8");

                echo ArrayToXml::convert($student_data);
                break;
            case 'CSM': // response JSON
            default:
                header('Content-Type: application/json; charset=utf-8');

                echo json_encode($student_data, JSON_UNESCAPED_SLASHES);
                break;
        }
    }
}