<?php
  include "header.php";
?>
<div class="form-style-5">
  <form method="POST" enctype="multipart/form-data" action="DB.php?action=add">
    <fieldset>
      <legend style="text-align: center;"><span class="number"></span> Add <span class="number"></span></legend>
      <label>Studen Code</label>
      <input type="text" name="student_code" placeholder="Your Student Code *">
      <label>Class Code</label>
      <input type="text" name="class_code_id" placeholder="Your Class Code ID *">
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
      <input type="text" name="date_birth" value="" placeholder="Your Date Birth *">
      <label>Address</label>
      <input type="text" name="address" placeholder="Your Address *" value="">
    </fieldset>
    <input type="submit" value="Apply" />
  </form>
</div>
<?php
 include "footer.php";
?>