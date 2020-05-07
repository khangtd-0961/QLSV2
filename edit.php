<?php
  include "config.php";
  include "header.php";
?>
<?php
  $id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? $_GET["id"] : 0;
  $sql = "SELECT * FROM students WHERE id = $id";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
   foreach ($stmt->fetchAll() as $arr) {
?>
<div class="form-style-5">
  <form method="POST" enctype="multipart/form-data" action="<?php echo $form_action; ?>">
    <fieldset>
      <legend><span class="number">1</span> Add</legend>
     <label>Studen Code</label>
      <input type="text" name="student_code" placeholder="Your Student Code *" value="<?php echo isset($arr["student_code"]) ? $arr["student_code"] : null; ?>">
      <label>Class Code</label>
      <input type="text" name="class_code_id" placeholder="Your Class Code ID *" value="<?php echo isset($arr["class_code_id"]) ? $arr["class_code_id"] : null; ?>">
      <label>Name</label>
      <input type="text" name="name" placeholder="Your Name *" value="<?php echo isset($arr["name"]) ? $arr["name"] : null; ?>">
      <label for="sex">Sex</label>
      <select id="sex" name="sex" value="<?php echo isset($arr["sex"]) ? $arr["sex"] : null; ?>">
        <optgroup>
          <option value="0">Female</option>
          <option value="1">Made</option>
          <option value="2">Other</option>
        </optgroup>
      </select>
      <label>Date Birth</label>
      <input type="date" name="date_birth" placeholder="Your Date Birth *" value="<?php echo isset($arr["date_birth"]) ? $arr["date_birth"] : null; ?>">
      <label>Address</label>
      <input type="text" name="address" placeholder="Your Address *" value="<?php echo isset($arr["address"]) ? $arr["address"] : null; ?>">
    </fieldset>
    <input type="submit" value="Apply" />
  </form>
</div>
<?php
  }
  include "footer.php";
?>