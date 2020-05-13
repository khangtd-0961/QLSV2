<?php
include 'config.php';
include 'header.php';
?>
<?php
  $id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;
$sql = "SELECT students.*, subject_point.points, subject_point.subject ,subject_point.id FROM studentsRIGHT JOIN subject_point ON students.student_code = subject_point.code_student_id WHERE students.id = $id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
$newArrPoint = [];

foreach ($result as $key => $value) {
    $newArrPoint['id'] = $value[0];
    $newArrPoint['student_code'] = $value['student_code'];
    $newArrPoint['class_code_id'] = $value['class_code_id'];
    $newArrPoint['name'] = $value['name'];
    $newArrPoint['sex'] = $value['sex'];
    $newArrPoint['address'] = $value['address'];
    $newArrPoint['date_birth'] = $value['date_birth'];
    $newArrPoint['subject_point'][] = ['id' => $value['id'], 'subject' => $value['subject'], 'points' => $value['points']];
}
?>
  <div class="form-style-5">
    <form method="POST" enctype="multipart/form-data" action="DB.php?action=edit&id=<?php echo $newArrPoint['id']; ?>">
      <fieldset>
        <legend style="text-align:center"><span class="number"></span> Edit <span class="number"></span></legend>
        <label>Studen Code</label>
        <input type="text" name="student_code" value="<?php echo $newArrPoint['student_code']; ?>">
        <label>Class</label>
        <select id="class_code_id" name="class_code_id">
          <option value="">---</option>
          <?php
            $sql = 'SELECT class_code,class_name FROM classes';
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($stmt->fetchAll() as $newArrPointr) {
                ?>
            <option <?php echo isset($newArrPoint['class_code_id']) && $newArrPoint['class_code_id'] == $newArrPointr['class_code'] ? 'selected' : ''; ?>
            value="<?php echo isset($newArrPointr['class_code']) ? $newArrPointr['class_code'] : null; ?>">
                <?php echo isset($newArrPointr['class_name']) ? $newArrPointr['class_name'] : null; ?>
            </option>
                <?php
            }
            ?>
        </select>
        <label>Name</label>
        <input type="text" name="name" value="<?php echo isset($newArrPoint['name']) ? $newArrPoint['name'] : null; ?>">
        <label for="sex">Sex</label>
        <select id="sex" name="sex">
            <option value="">---</option>
            <option <?php echo isset($newArrPoint['sex']) && $newArrPoint['sex'] == 0 ? 'selected' : null; ?> value="0">Female</option>
            <option <?php echo isset($newArrPoint['sex']) && $newArrPoint['sex'] == 1 ? 'selected' : null; ?> value="1">Made</option>
            <option <?php echo isset($newArrPoint['sex']) && $newArrPoint['sex'] == 2 ? 'selected' : null; ?> value="2">Other</option>
        </select>
        <label>Date Birth</label>
        <input type="date" name="date_birth" value="<?php echo isset($newArrPoint['date_birth']) ? $newArrPoint['date_birth'] : null; ?>">
        <label>Address</label>
        <input type="text" name="address" value="<?php echo isset($newArrPoint['address']) ? $newArrPoint['address'] : null; ?>">
        <input type="hidden" name="id" value="<?php echo isset($newArrPoint['student_code']) ? $value['student_code'] : null; ?>">
        <?php
        foreach ($newArrPoint['subject_point'] as $key => $value) {
            echo '<label>' . $value['subject'] . '</label>';
            ?>
            <input type="hidden" name="id[]" value="<?php echo isset($value['id']) ? $value['id'] : null; ?>">
            <input type="text" name="points[]" value="<?php echo isset($value['points']) ? $value['points'] : null; ?>">
            <?php
        }
        ?>
      </fieldset>
      <input type="submit" value="Apply" />
    </form>
  </div>
    <?php
    include 'footer.php';
    ?>
