    <div uk-grid>
        <div class="uk-width-1-1">
            <h2>Matched cars</h2>
            <table class="uk-table uk-table-middle uk-table-divider">
                <thead>
                    <tr>
                        <th class="uk-width-small">Car</th>
                        <th>Model</th>
                        <th>Time</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($matches): ?>
                    <?php foreach($matches as $row) : ?>
                        <tr>
                            <td><a href='<?php echo site_url("car/view/".$row->car); ?>'><?php echo $row->car; ?></a></td>
                            <td><?php echo $row->name; ?></td>
                            <td><?php echo $row->pdate." ".$row->pstart."-".$row->pend; ?></td>
                            <td><?php echo round($row->diff * $row->price, 2); ?>$</td>
                            <td>
                                <a class="uk-button uk-button-success" href="#" type="button">Request</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">
                                You don't have any matches.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
