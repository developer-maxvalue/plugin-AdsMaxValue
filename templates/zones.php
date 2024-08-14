<?php
include_once 'base.php';
?>
<div id="content-wrapper" style="display:none;">
    <div class="wrap">
        <h1>Manage Zones</h1>
        <form method="post" action="">
            <input type="hidden" name="action" value="add_zone">
            <table>
                <tr>
                    <th>Zone Name</th>
                    <td><input type="text" name="zone_name"></td>
                </tr>
                <tr>
                    <th>Zone Description</th>
                    <td><textarea name="zone_description"></textarea></td>
                </tr>
            </table>
            <input type="submit" value="Add Zone">
        </form>
        <h2>Existing Zones</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($zones as $zone): ?>
                    <tr>
                        <td><?php echo $zone->id; ?></td>
                        <td><?php echo $zone->zone_name; ?></td>
                        <td><?php echo $zone->zone_description; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>