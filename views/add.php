<div class="alek-index-box">
    <form class="form-horizontal interface" id="crud_add" method="POST">
        <a class="btn btn-default back" href="/ci3/aleksandr_vashchenko_crud/">BACK</a>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="name" id="name" value="" placeholder="Name"/>
            </div>
        </div>
        <div class="form-group">
            <label for="surname" class="col-sm-2 control-label">Surname</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="surname" id="surname" value="" placeholder="Surname"/>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input class="form-control" type="email" name="email" id="email" value="" placeholder="Email"/>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input class="form-control" type="password" name="password" id="password" value=""
                       placeholder="Password"/>
            </div>
        </div>
        <div class="form-group">
            <label for="groups" class="col-sm-2 control-label">Groups</label>
            <div class="col-sm-10">
                <select name="groups[]" id="groups" class="form-control" multiple>
                    <?php foreach ($groups as $group) { ?>
                        <option value="<?= $group['id'] ?>"><?= $group['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a class="btn btn-default add_send">Add</a>
            </div>
        </div>
        <!-- Message -->
        <div class="form-group ajax_message container"></div>
    </form>
</div>