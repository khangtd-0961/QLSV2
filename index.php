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
    $sql = 'SELECT classes.class_name, students.*, subject_point.points  FROM students INNER JOIN classes ON students.class_code_id = classes.class_code INNER JOIN subject_point ON students.student_code = subject_point.code_student_id';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $results = $stmt->fetchAll();

    $newArr = [];
    $count=0;
    foreach ($results as $key => $value) {
        $newArr[$value['id']]['id'] = $value['id'];
        $newArr[$value['id']]['class_code'] = $value['class_code'];
        $newArr[$value['id']]['class_name'] = $value['class_name'];
        $newArr[$value['id']]['student_code'] = $value['student_code'];
        $newArr[$value['id']]['class_code_id'] = $value['class_code_id'];
        $newArr[$value['id']]['name'] = $value['name'];
        $newArr[$value['id']]['sex'] = $value['sex'];
        $newArr[$value['id']]['address'] = $value['address'];
        $newArr[$value['id']]['date_birth'] = $value['date_birth'];
        $newArr[$value['id']]['points'][] = $value['points'];
        $count++;
    }

    foreach ($newArr as $row) {
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
            <?php foreach ($row['points'] as $values) {
                echo '<td>' . $values . '</td>';
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
