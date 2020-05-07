<?php
include 'config.php';
include 'header.php';
?>
<?php
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;
$sql = "SELECT * FROM students WHERE id = $id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
foreach ($stmt->fetchAll() as $arr) {
    ?>
  <div class="form-style-5">
    <form method="POST" enctype="multipart/form-data" action="DB.php?action=edit&id=<?php echo $arr['id']; ?>">
      <fieldset>
        <legend style="text-align:center"><span class="number"></span> Edit <span class="number"></span></legend>
        <label>Studen Code</label>
        <input type="text" name="student_code" value="<?php echo $arr['student_code']; ?>">
        <label>Class</label>
        <select id="class_code_id" name="class_code_id">
          <option value="">---</option>
          <?php
            $sql = 'SELECT class_code,class_name FROM classes';
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($stmt->fetchAll() as $arrr) {
                ?>
            <option <?php echo isset($arr['class_code_id']) && $arr['class_code_id'] == $arrr['class_code'] ? 'selected' : ''; ?>
            value="<?php echo isset($arrr['class_code']) ? $arrr['class_code'] : null; ?>">
                <?php echo isset($arrr['class_name']) ? $arrr['class_name'] : null; ?>
            </option>
                <?php
            }
            ?>
        </select>
        <label>Name</label>
        <input type="text" name="name" value="<?php echo isset($arr['name']) ? $arr['name'] : null; ?>">
        <label for="sex">Sex</label>
        <select id="sex" name="sex">
            <option value="">---</option>
            <option <?php echo isset($arr['sex']) && $arr['sex'] == 0 ? 'selected' : null; ?> value="0">Female</option>
            <option <?php echo isset($arr['sex']) && $arr['sex'] == 1 ? 'selected' : null; ?> value="1">Made</option>
            <option <?php echo isset($arr['sex']) && $arr['sex'] == 2 ? 'selected' : null; ?> value="2">Other</option>
        </select>
        <label>Date Birth</label>
        <input type="date" name="date_birth" value="<?php echo isset($arr['date_birth']) ? $arr['date_birth'] : null; ?>">
        <label>Address</label>
        <input type="text" name="address" value="<?php echo isset($arr['address']) ? $arr['address'] : null; ?>">
        <?php
            $sql = "SELECT * FROM subject_point WHERE code_student_id ='" . $arr['student_code'] . "'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach ($stmt->fetchAll() as $value) {
            ?>
        <label><?php echo $value['subject']; ?></label>
        <input type="hidden" name="id[]" value="<?php echo isset($value['id']) ? $value['id'] : null; ?>">
        <input type="text" name="points[]" value="<?php echo isset($value['points']) ? $value['points'] : null; ?>">
        <?php } ?>
      </fieldset>
      <input type="submit" value="Apply" />
    </form>
  </div>
    <?php
}
include 'footer.php';
?>