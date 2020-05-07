<?php
	include "config.php";
	$action = isset($_GET["action"]) ? $_GET["action"] : null;
	switch ($action) {
		case 'add':
			try {
				$stmt = $conn->prepare("INSERT INTO students (student_code, class_code_id, name, sex, address, date_birth) VALUES (:student_code, :class_code_id, :name, :sex, :address, :date_birth)");

				$stmt->bindParam(':student_code', $student_code);
				$stmt->bindParam(':class_code_id', $class_code_id);
				$stmt->bindParam(':name', $name);
				$stmt->bindParam(':sex', $sex);
				$stmt->bindParam(':address', $address);
				$stmt->bindParam(':date_birth', $date_birth);

				$student_code = $_POST["student_code"];
				$class_code_id = $_POST["class_code_id"];
				$name = $_POST["name"];
				$sex = $_POST["sex"];
				$address = $_POST["address"];
				$date_birth = $_POST["date_birth"];

				$stmt->execute();
				$points = $_POST["points"];
				$points1 = $_POST["points1"];
				$points2 = $_POST["points2"];
				$a = array(
					array(
						"$student_code",
						"Maths",
						"$points"
					),
					array(
						"$student_code",
						"Physical",
						"$points1"
					),
					array(
						"$student_code",
						"Chemistry",
						"$points2"
					)
				);
				$args = array_fill(0, count($a[0]), '?');
				// foreach ($_POST["points"] as  $value) {
				// 		$a[] = $value;
				// 	}	
				$stmt1 = $conn->prepare("INSERT INTO subject_point (code_student_id, subject, points) VALUES (".implode(',', $args).")");		
				foreach ($a as  $value) {
						$stmt1->execute($value);
					}	
				header("location:index.php");
			 } catch (Exception $e) {
			 	echo "Error: " . $e->getMessage();
			 } 
			break;
		
		case 'delete':
			try {
				$id = isset($_GET["id"]) ? $_GET["id"] : null;
				$sql = "DELETE FROM students WHERE id = $id";
				$conn->exec($sql);
				header("location:index.php");
			} catch (Exception $e) {
				echo "Error: " . $e->getMessage();
			}
			break;
		case 'edit':
			try {
				$id = isset($_GET["id"]) ? $_GET["id"] : null;
				$stmt = $conn->prepare("UPDATE students SET (student_code, class_code_id, name, sex, address, date_birth) VALUES (:student_code, :class_code_id, :name, :sex, :address, :date_birth)");

				$stmt->bindParam(':student_code', $student_code);
				$stmt->bindParam(':class_code_id', $class_code_id);
				$stmt->bindParam(':name', $name);
				$stmt->bindParam(':sex', $sex);
				$stmt->bindParam(':address', $address);
				$stmt->bindParam(':date_birth', $date_birth);

				$student_code = $_POST["student_code"];
				$class_code_id = $_POST["class_code_id"];
				$name = $_POST["name"];
				$sex = $_POST["sex"];
				$address = $_POST["address"];
				$date_birth = $_POST["date_birth"];

				$stmt->execute();
				header("location:index.php");
			} catch (Exception $e) {
				
			}
			break;
	}