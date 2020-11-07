<?php
namespace classes;
use SimpleXMLElement;

class Student extends Database{
  
    protected $studentId;

    function __construct($studentId) 
    {
        $this->studentId = $studentId;
    }

    /**
     * get student information
     *
     * @return void
     */
    public function get()
    {
        $student = $this->doSelectStudent($this->studentId);

        if($student){
            $grades = $this->doSelectStudentGrades($this->studentId);

            if($student['data_type'] == 'json'){
                $result = $this->renderJson($student, $grades);
                echo $result;
            } else {
                $result = $this->renderXml($student, $grades);
                Header('Content-type: text/xml');
                print($result->asXML());
            }
        }
    }

    /**
     * render json response
     *
     * @param array $student
     * @param array $grades
     * @return json
     */
    private function renderJson($student = array(), $grades = array())
    {
        $json = array();

        if($student && $grades){
            $json['student_id'] = $student['sid'];
            $json['student_name'] = $student['name'];

            $studentGrades = '';
            foreach($grades as $key => $grade){
                if(count($grades) - 1  == $key){
                    $studentGrades .= $grade['grade'];
                } else {
                    $studentGrades .= $grade['grade'] . ',';
                }
            }

            $json['grades'] = $studentGrades;
            $json['average'] = $this->getAverage($grades);
            $json['status'] = $this->getStatus($grades, $student['school_name']);
        }
        return json_encode($json);
    }

    /**
     * render xml response
     *
     * @param array $student
     * @param array $grades
     * @return xml
     */
    private function renderXml($student = array(), $grades = array())
    {
        $xml = new SimpleXMLElement('<xml/>');

        if($student && $grades){
            $studentXml = $xml->addChild('student');
            $studentXml->addChild('student_id', $student['sid']);
            $studentXml->addChild('student_name', $student['name']);

            $studentGrades = '';
            foreach($grades as $key => $grade){
                if(count($grades) - 1  == $key){
                    $studentGrades .= $grade['grade'];
                } else {
                    $studentGrades .= $grade['grade'] . ',';
                }
            }

            $studentXml->addChild('grades', $studentGrades);
            $studentXml->addChild('average', $this->getAverage($grades));
            $studentXml->addChild('status', $this->getStatus($grades, $student['school_name']));
        }

        return $xml;
    }

    /**
     * get average grade
     *
     * @param array $grades
     * @return decimal
     */
    private function getAverage($grades = array())
    {
        $sum = 0;
        foreach($grades as $grade){
            $sum += $grade['grade'];
        }

        $average = round($sum / count($grades), 2);
        return $average;
    }

    /**
     * get student status
     *
     * @param array $grades
     * @param string $schoolName
     * @return string
     */
    private function getStatus($grades = array(), $schoolName = '')
    {
        if($schoolName == 'CSM'){
            $average = $this->getAverage($grades);
            if($average >= 7){
                $status = 'pass';
            } else {
                $status = 'fail';
            }
        } elseif($schoolName == 'CSMB') {
            $highestGrade = $grades[0]['grade'];
            $lowestGradeKey = 0;
            $lowestGrade = $grades[0]['grade'];
            for($i = 1; $i < count($grades); $i++){
                if($highestGrade < $grades[$i]['grade']){
                    $highestGrade = $grades[$i]['grade'];
                }

                if($lowestGrade > $grades[$i]['grade']){
                    $lowestGrade = $grades[$i]['grade'];
                    $lowestGradeKey = $i;
                }
            }

            if(count($grades) > 2){
                unset($grades[$lowestGradeKey]);
            }

            if($highestGrade > 8){
                $status = 'pass';
            } else {
                $status = 'fail';
            }
        }

        return $status;
    }
}
