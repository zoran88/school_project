<?php
namespace classes;

class Student extends Database{
  
    protected $studentId;

    function __construct($studentId) 
    {
        $this->studentId = $studentId;
    }

    public function get()
    {
        $student = $this->doSelectStudent($this->studentId);

        if($student){
            $grades = $this->doSelectStudentGrades($this->studentId);
        }

        return false;
    }
}
