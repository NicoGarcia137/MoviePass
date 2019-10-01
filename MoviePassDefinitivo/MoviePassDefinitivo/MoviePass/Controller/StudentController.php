<?php
    namespace Controllers;

    use Repositories\StudentRepository as StudentRepository;
    use Models\Student as Student;

    class StudentController
    {
        private $studentRepository;

        public function __construct()
        {
            $this->studentRepository = new StudentRepository();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."student-add.php");
        }

        public function ShowListView()
        {
            $studentList = $this->studentRepository->GetAll();

            require_once(VIEWS_PATH."student-list.php");
        }

        public function Add($recordId, $firstName, $lastName)
        {
            $student = new Student();
            $student->setRecordId($recordId);
            $student->setfirstName($firstName);
            $student->setLastName($lastName);

            $this->studentRepository->Add($student);

            $this->ShowAddView();
        }
    }
?>