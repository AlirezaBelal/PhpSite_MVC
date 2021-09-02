<?php if (isset($files) && isset(json_decode($files)[0])) { ?>

    <table class="table">
        <thead class="thead-dark" align="center">

        <?php foreach(json_decode($files)[0] as $key => $value) { ?>
            <?php if ($key != "id") { ?>
                <th> <?php echo $key; ?> </th>
            <?php } ?>
        <?php } ?>
        <th>Delete</th>
        </thead>

        <tbody align="center">

        <?php foreach(json_decode($files) as $file) { ?>

            <tr>
                <?php foreach($file as $key => $value) { ?>
                    <?php if ($key != "id") { ?>
                        <?php if ($key == 'path') { ?>
                            <td>
                                <form action="/download" method="POST">
                                    <input value="<?php echo $file->id; ?>" type="hidden" name="id" /> 
                                    <input type="submit" value="Download" class="btn btn-primary" />
                                </form>
                            </td>
                        <?php } else { ?>
                            <td> <?php if ($key == 'size_file') echo round($value / 1048576, 1) . " Mb"; else echo $value; ?> </td>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                <td>
                    <form action="/delete" method="POST">
                        <input type="hidden" value="<?php echo $file->id; ?>" name="id" />
                        <input type="submit" value="Remove" class="btn btn-warning" />
                    </form>
                </td>  
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } ?>
