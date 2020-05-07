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
            $a = [
                [
                    "$studentCode",
                    'Maths',
                    "$points",
                ],
                [
                    "$studentCode",
                    'Physical',
                    "$points1",
                ],
                [
                    "$studentCode",
                    'Chemistry',
                    "$points2",
                ],
            ];
            $args = array_fill(0, count($a[0]), '?');
            $stmt1 = $conn->prepare('INSERT INTO subject_point (code_student_id, subject, points) 
            VALUES (' . implode(', ', $args) . ')');
            foreach ($a as $value) {
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
            $sql = "DELETE FROM students WHERE id = $id";
            $conn->exec($sql);
            header('location:index.php');
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
        break;
    case 'edit':
        try {
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            $stmt = $conn->prepare('UPDATE students SET (student_code, class_code_id, name, sex, address, date_birth) 
            VALUES (:studentCode, :classCodeId, :name, :sex, :address, :dateBirth)');

            $stmt->bindParam(':student_code', $studentCode);
            $stmt->bindParam(':class_code_id', $classCodeId);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':sex', $sex);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':date_birth', $dateBirth);

            $studentCode = $_POST['student_code'];
            $classCodeId = $_POST['class_code_id'];
            $name = $_POST['name'];
            $sex = $_POST['sex'];
            $address = $_POST['address'];
            $dateBirth = $_POST['date_birth'];
            $stmt->execute();
            header('location:index.php');
        } catch (Exception $e) {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            echo 'Error: ' . $e->getMessage();
        }
        break;
}
