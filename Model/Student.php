<?php

class Model_Student extends Model_Base {
    public function __construct() {
        parent::__construct();
    }

    public function get_list() {
        return $this->db->getAll("SELECT * FROM students");
    }

    public function get_data($student_id) {
        $student = $this->db->getRow("
          SELECT s.*, 
            b.name AS board_name
          FROM students s 
          LEFT JOIN boards b ON (
            s.board_id = b.id
          )
          WHERE s.id = ?i
        ", $student_id);

        if (!$student) throw new Exception("student not found");

        $student_grades = $this->db->getCol("SELECT grade FROM grades WHERE student_id = ?i", $student_id);

        $student['grades'] = $student_grades;
        $student['average'] = round(array_sum($student_grades)/count($student_grades));
        $student['pass'] = $this->student_pass($student_grades, $student['board_name']);

        return $student;

    }

    private function student_pass($student_grades, $board) {
        switch ($board) {
            case 'CSM':
                $average = round(array_sum($student_grades)/count($student_grades));
                $pass = $average >= 7;
                break;
            case 'CSMB':
                $pass = max($student_grades) > 8;
                break;
            default:
                $pass = false;
                break;
        }

        return $pass;
    }
}