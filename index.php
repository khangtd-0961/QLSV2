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
				<td><?php echo $row["class_code_id"]; ?></td>
				<td><?php echo $row["name"]; ?></td>
				<td><?php echo $row["sex"]; ?></td>
				<td><?php echo $row["address"]; ?></td>
				<td><?php echo $row["date_birth"]; ?></td>
				<td style="text-align: center;">
				<?php echo 	"<a href='edit.php?id=" . $row["id"] . "' >Edit</a>"; ?>
				&nbsp;&nbsp; 
				<?php echo 	"<a href='DB.php?action=delete&id=" . $row["id"] . "' >Delete</a>"; ?>
				</td>
			</tr>
	<?php
		$i++;
	}
	?>
<?php
	include "footer.php";
?>