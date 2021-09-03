<?php 

use App\core\router\Router;

Router::$title = 'User';
?>

<?php if (isset($users) && isset(json_decode($users)[0])) { ?>

    <table class="table">
        <thead class="thead-dark" align="center">
        <tr>
            <?php foreach (json_decode($users)[0] as $key => $value) { ?>
                <?php if ($key == "name") { ?>
                    <th> <?php echo $key; ?> </th>
                <?php } elseif ($key != "isadmin") { ?>
                    <th></th>
                <?php } ?>
            <?php } ?>
        </tr>
        </thead>


        <tbody align="center">
        <?php foreach (json_decode($users) as $user) { ?>
            <?php if ($user->name == $Online_admin) {
                continue;
            } ?>
            <tr>

                <td class="<?php if ($user->isadmin) echo "bg-secondary"; ?>">
                    <?php echo $user->name; ?>
                </td>

                <td class="<?php if ($user->isadmin) echo "bg-secondary"; ?>">

                    <form action="<?php if ($user->isconfirm == 1) echo "/downUser"; else echo "/updateUser"; ?>"
                          method="POST">

                        <input type="hidden" value="<?php echo $user->name ?>" name="name"/>

                        <?php if ($user->isconfirm == 1) { ?>
                            <input type="submit" class="btn btn-danger" value="verifier to normal"/>
                        <?php } else { ?>
                            <input type="submit" class="btn btn-primary" value="normal to verifier"/>
                        <?php } ?>
                    </form>
                </td>

                <td class="<?php if ($user->isadmin) echo "bg-secondary"; ?>">
                    <form action="<?php if ($user->situation_user) echo "/block"; else echo "/unblock"; ?>" method="POST">
                        <input type="hidden" value="<?php echo $user->name ?>" name="name"/>
                        <?php if ($user->situation_user) { ?>
                            <input type="submit" class="btn btn-danger" value="Block User"/>
                        <?php } else { ?>
                            <input type="submit" class="btn btn-primary" value="Unblock User"/>
                        <?php } ?>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php }?>
