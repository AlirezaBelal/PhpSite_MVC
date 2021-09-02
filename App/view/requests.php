<?php if (isset($requests) && isset(json_decode($requests)[0])) { ?>
    <table class="table">
        <thead class="thead-dark" align="center">
        <tr>
            <?php foreach (json_decode($requests)[0] as $key => $value) { ?>
                <?php if ($key != "id") { ?>
                    <th> <?php echo $key; ?> </th>
                <?php } ?>
            <?php } ?>
            <th></th>
        </tr>
        </thead>

        <?php foreach (json_decode($requests) as $request) { ?>
            <tr align="center">
                <?php foreach ($request as $key => $value) { ?>
                    <?php if ($key != "id") { ?>
                        <td>  <?php if ($key == 'size_file') echo round($value / 1048576, 1) . " Mb"; else echo $value; ?> </td>
                    <?php }
                } ?>

                <td>
                    <form action="/accept" method="POST">
                        <input type="hidden" value="<?php echo $request->id; ?>" name="id"/>
                        <input type="submit" class="btn btn-primary" value="Accept"/>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php } ?>
