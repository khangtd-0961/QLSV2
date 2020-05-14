<?php
include 'config.php';
include 'header.php';
?>
<div class="form-style-5">
  <form method="POST" enctype="multipart/form-data" action="DB.php?action=add">
    <fieldset>
      <legend style="text-align: center;"><span class="number"></span> Add <span class="number"></span></legend>
      <label>Studen Code</label>
      <input type="text" name="student_code" placeholder="Your Student Code *">
      <label>Class</label>
      <select id="class_code_id" name="class_code_id" value="">
        <optgroup>
          <option value="">---</option>
          <?php
            $sql = 'SELECT class_code,class_name FROM classes';
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($stmt->fetchAll() as $arr) {
                ?>
            <option value="<?php echo isset($arr['class_code']) ? $arr['class_code'] : null; ?>">
                <?php echo isset($arr['class_name']) ? $arr['class_name'] : null; ?>
            </option>
                <?php
            }
            ?>
        </optgroup>
      </select>
      <label>Name</label>
      <input type="text" name="name" placeholder="Your Name *" value="">
      <label for="sex">Sex</label>
      <select id="sex" name="sex" value="">
        <optgroup>
          <option value="0">Female</option>
          <option value="1">Made</option>
          <option value="2">Other</option>
        </optgroup>
      </select>
      <label>Date Birth</label>
      <input type="date" name="date_birth" value="" placeholder="Your Date Birth *">
      <label>Address</label>
      <input type="text" name="address" placeholder="Your Address *" value="">
      <label>Maths</label>
      <input type="text" name="points" placeholder="Your Maths Point *">
      <label>Physical</label>
      <input type="text" name="points1" placeholder="Your Physical Point *">
      <label>Chemistry</label>
      <input type="text" name="points2" placeholder="Your Chemistry Point *">
    </fieldset>
    <input type="submit" value="Apply" />
  </form>
</div>
<?php
include 'footer.php';
?>
