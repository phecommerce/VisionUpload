<div class="form-group">
    <label for="name" class="col-sm-3 control-label">Name*</label>

    <div class="col-sm-7">
        <input type="text" name="name" class="form-control" id="name"
               value="<?php if (isset($row['name'])) {
                   echo $row['name'];
               } ?>">
    </div>

</div>

<div class="form-group">
    <label for="username" class="col-sm-3 control-label">Username*</label>

    <div class="col-sm-7">
        <input type="text" name="username" class="form-control" id="username"
               value="<?php if (isset($row['username'])) {
                   echo $row['username'];
               } ?>">
    </div>
</div>

<div class="form-group">
    <label for="email" class="col-sm-3 control-label">Email*</label>

    <div class="col-sm-7">
        <input type="email" name="email" class="form-control" id="email"
               value="<?php if (isset($row['email'])) {
                   echo $row['email'];
               } ?>">
    </div>
</div>

<div class="form-group">
    <label for="password" class="col-sm-3 control-label">Password*</label>

    <div class="col-sm-7">
        <input type="password" name="password" class="form-control" id="password"
               value="<?php if (isset($row['password'])) {
                   echo $row['password'];
               } ?>">
    </div>
</div>

<div class="form-group">
    <label for="image" class="col-sm-3 control-label">Profile Photo*</label>

    <div class="col-sm-7">
        <input type="file" name="proffiles[]" class="form-control"
               value="<?php if (isset($row['proffiles[]'])) {
                   echo $row['proffiles[]'];
               } ?>">
    </div>
</div>
