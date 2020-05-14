<?php
include 'config.php';
$action = isset($_GET['action']) ? $_GET['action'] : null;

switch ($action) {
    case 'add':
        try {
            $stmt = $conn->prepare(
                'INSERT INTO students (student_code, class_code_id, name, sex, address, date_birth) 
                VALUES (:studentCode, :classCodeId, :name, :sex, :address, :dateBirth)'
            );

            $stmt->bindParam(':studentCode', $studentCode);
            $stmt->bindParam(':classCodeId', $classCodeId);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':sex', $sex);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':dateBirth', $dateBirth);

            $studentCode = $_POST['student_code'];
            $classCodeId = $_POST['class_code_id'];
            $name = $_POST['name'];
            $sex = $_POST['sex'];
            $address = $_POST['address'];
            $dateBirth = $_POST['date_birth'];

            $stmt->execute();
            $points = $_POST['points'];
            $points1 = $_POST['points1'];
            $points2 = $_POST['points2'];
            $arraySubjectpoint = [
                [
                    $studentCode,
                    'Maths',
                    $points,
                ],
                [
                    $studentCode,
                    'Physical',
                    $points1,
                ],
                [
                    $studentCode,
                    'Chemistry',
                    $points2,
                ],
            ];
            $args = array_fill(0, count($arraySubjectpoint[0]), '?');
            $stmt1 = $conn->prepare('INSERT INTO subject_point (code_student_id, subject, points) 
            VALUES (' . implode(', ', $args) . ')');
            foreach ($arraySubjectpoint as $value) {
                $stmt1->execute($value);
            }
            header('location:index.php');
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
        break;

    case 'delete':
        try {
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            $codeStudentId = isset($_GET['code_student_id']) ? $_GET['code_student_id'] : null;
            $sql = "DELETE FROM students WHERE id = $id";
            $sql2 = "DELETE FROM subject_point WHERE code_student_id = '$codeStudentId'";
            $conn->exec($sql);
            $conn->exec($sql2);
            header('location:index.php');
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
        break;

    case 'edit':
        try {
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            $stmt = $conn->prepare("UPDATE students SET student_code = :studentCode, class_code_id = :classCodeId,
            name = :name, sex = :sex, address = :address, date_birth = :dateBirth WHERE id=$id");
            $stmt->bindParam(':studentCode', $studentCode);
            $stmt->bindParam(':classCodeId', $classCodeId);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':sex', $sex);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':dateBirth', $dateBirth);


            $studentCode = $_POST['student_code'];
            $classCodeId = $_POST['class_code_id'];
            $name = $_POST['name'];
            $sex = $_POST['sex'];
            $address = $_POST['address'];
            $dateBirth = $_POST['date_birth'];
            $subjecId = $_POST['id'];
            $points = $_POST['points'];
            
            foreach ($points as $key => $value) {
                $stmt1 = $conn->prepare('UPDATE subject_point SET points = :points WHERE id = :subjecId');
                $stmt1->bindParam(':points', $value);
                $stmt1->bindParam(':subjecId', $subjecId[$key]);
                $stmt1->execute();
            }
            $stmt->execute();
            header('location:index.php');
        } catch (Exception $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollback();
                // If we got here our two data updates are not in the database
            }
            echo 'Error: ' . $e->getMessage();
        }
        break;
}
