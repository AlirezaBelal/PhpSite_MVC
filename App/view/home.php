<?php if (isset($files) && isset(json_decode($files)[0])) { ?>
    <table class="table">
        <thead class="thead-dark" align="center">
        <tr>
            <?php foreach (json_decode($files)[0] as $key => $value) { ?>
                <?php if ($key != "id" && $key != "validation") { ?>
                    <th> <?php echo $key; ?> </th>
                <?php } ?>
            <?php } ?>
            <?php if ($isAdmin) { ?>
                <th>Delete</th>
            <?php } ?>
        </tr>

        <tbody align="center">
        <?php foreach (json_decode($files) as $file) { ?>
            <?php if ($file->validation == 0) {
                continue;
            } ?>
            <tr>
                <?php foreach ($file as $key => $value) { ?>
                    <?php if ($key != "id" && $key != "validation") { ?>
                        <?php if ($key == 'path') { ?>
                            <td>
                                <form action="/download" method="POST">
                                    <input value="<?php echo $file->id; ?>" type="hidden" name="id"/>
                                    <input type="submit" value="Download"
                                           class="btn btn-primary">
                                </form>
                            </td>

                        <?php } else { ?>
                            <td> <?php if ($key == 'size_file') echo round($value / 1048576, 1) . " Mb"; else echo $value; ?> </td>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                <?php if ($isAdmin) { ?>
                    <td>
                        <form action="/delete" method="POST">
                            <input type="hidden" value="<?php echo $file->id; ?>" name="id"/>
                            <input type="submit" value="Remove" class="btn btn-warning"/>
                        </form>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } ?>
