<?php
	include "config.php";
	include "header.php";
?>
	<div id="menu">
		<ul>
			<li><a href="index.php?Controllers=Student">Trang chủ</a></li>
			<li><a href="index.php?Controllers=Student">Sinh viên</a></li>
			<li><a href="#">Điểm</a></li>
			<li><a href="#">Lớp</a></li>
			<li><a href="#">Môn Học</a></li>
		</ul>
	</div>
	<div><a href="add.php">ADD</a></div>
	&nbsp;
	<table>
	<tr>
		<td>Id</td>
		<td>Student Code</td>
		<td>Class Code</td>
		<td>Name</td>
		<td>Sex</td>
		<td>Address</td>
		<td>Date Birth</td>
		<td>Maths</td>
		<td>Physical</td>
		<td>Chemistry</td>
		<td>Action</td>
	</tr>
	<?php
	$sql = "SELECT * FROM students";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$i = 0;
		foreach ($stmt->fetchAll() as $row) {
		?>
			<tr class="">
				<td><?php echo $row["id"]; ?></td>
				<td><?php echo $row["student_code"]; ?></td>
				<?php
					$sql = "SELECT * FROM classes WHERE class_code ='" . $row["class_code_id"] . "'";
					$stmt = $conn->prepare($sql);
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				?>
					<td><?php foreach ( $stmt->fetchAll() as $key => $value) {
						echo $value["class_name"];
					} ?></td>
				<td><?php echo $row["name"]; ?></td>
				<td><?php 
					if ($row["name"] == 0) {
						echo "Nữ";
					} else if ($row["name"] == 1) {
						echo "Nam";
					} else {
						echo "Khác";
					}
					?></td>
				<td><?php echo $row["address"]; ?></td>
				<td><?php echo $row["date_birth"]; ?></td>
				<?php
					$sql = "SELECT * FROM subject_point WHERE code_student_id ='" . $row["student_code"] . "'";
					$stmt = $conn->prepare($sql);
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				?>
				<?php foreach ( $stmt->fetchAll() as $value) {
						echo "<td>" . $value["points"] . "</td>";
					} ?>
				<td style="text-align: center;">
				<?php echo 	"<a href='edit.php?id=" . $row["id"] . "' >Edit</a>"; ?>
				&nbsp;&nbsp; 
				<?php echo 	"<a href='DB.php?action=delete&id=" . $row["id"] . "&class_code_id=" . $row["class_code_id"]. "&student_code=" . $row["student_code"] . "' >Delete</a>"; ?>
				</td>
			</tr>
	<?php
		$i++;
	}
	?>
<?php
	include "footer.php";
?>