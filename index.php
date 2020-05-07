<?php
include 'config.php';
include 'header.php';
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
    $sql = 'SELECT *,students.id FROM students INNER JOIN classes ON students.class_code_id = classes.class_code';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $i = 0;
    foreach ($stmt->fetchAll() as $row) {
        ?>
        <tr class="">
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['student_code']; ?></td>
            <td><?php echo $row['class_name'];?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php
            if ($row['sex'] == 0) {
                    echo 'Nữ';
            } elseif ($row['sex'] == 1) {
                    echo 'Nam';
            } else {
                    echo 'Khác';
            }
            ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['date_birth']; ?></td>
            <?php
            $sql = "SELECT points FROM subject_point WHERE code_student_id ='" . $row['student_code'] . "'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            ?>
            <?php foreach ($stmt->fetchAll() as $value) {
                echo '<td>' . $value['points'] . '</td>';
            } ?>
            <td style="text-align: center;">
                 <a href="edit.php?id=<?php echo $row['id'];?>">Edit</a>
                &nbsp;&nbsp;
                <a href="DB.php?action=delete&id=<?php echo $row['id'];?>&code_student_id=<?php echo $row['student_code'];?>" >Delete</a>
            </td>
        </tr>
        <?php
    }
    ?>
    <?php
    include 'footer.php';
    ?>