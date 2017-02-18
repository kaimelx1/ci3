<div class="alek-index-box">
    <form class="form-horizontal interface" id="crud_edit" method="POST">
        <a class="btn btn-default back" href="/ci3/aleksandr_vashchenko_crud/">BACK</a>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="name" id="name" value="<?= trim($row['name'], "/'") ?>"
                       placeholder="Name"/>
            </div>
        </div>
        <div class="form-group">
            <label for="surname" class="col-sm-2 control-label">Surname</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="surname" id="surname"
                       value="<?= trim($row['surname'], "/'") ?>" placeholder="Surname"
                       required/>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input class="form-control" type="email" name="email" id="email"
                       value="<?= $row['email'] ?>" placeholder="Email"/>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input class="form-control" type="password" name="password" id="password" value=""
                       placeholder="Password"/>
            </div>
        </div>
        <?php $in_groups = explode(',', $row['groups']); ?>
        <div class="form-group">
            <label for="groups" class="col-sm-2 control-label">Groups</label>
            <div class="col-sm-10">
                <select name="groups[]" id="groups" class="form-control" multiple>
                    <?php foreach ($groups as $group) { ?>
                        <option
                            value="<?= $group['id'] ?>"<?php if (in_array($group['name'], $in_groups)) echo "selected"; ?>><?= $group['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a class="btn btn-default edit_send">Edit</a>
            </div>
        </div>
        <!-- Message -->
        <div class="form-group ajax_message container"></div>
    </form>
</div>