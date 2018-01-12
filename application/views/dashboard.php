    <div class="uk-child-width-1-2" uk-grid>
        <div>
            <h2>My cars</h2>
            <table class="uk-table uk-table-middle uk-table-divider">
                <thead>
                    <tr>
                        <th class="uk-width-small">Car plates</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($my_cars): ?>
                        <?php foreach($my_cars as $row) : ?>
                            <tr>
                                <td><a href='<?php echo site_url("car/view/".$row->license_plate); ?>'><?php echo $row->license_plate; ?></a></td>
                                <td><?php echo $row->type; ?></td>
                                <td><?php echo $row->price; ?>$</td>
                                <td>
                                    <?php if($row->availability_count>0): ?>
                                        <?php if($row->active < 1): ?>
                                            <a class="uk-button uk-button-success" href='<?php echo site_url("car/activate/".$row->license_plate); ?>' type="button">Activate</a>
                                        <?php endif; ?>
                                        <?php if($row->active > 0): ?>
                                            <a class="uk-button uk-button-danger" href='<?php echo site_url("car/deactivate/".$row->license_plate); ?>' type="button">Deactivate</a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">
                                You don't have any cars.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div>
            <h2>Recived requests</h2>
            <table class="uk-table uk-table-middle uk-table-divider">
                <thead>
                    <tr>
                        <th class="uk-width-small">Car plates</th>
                        <th>Date</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($recived_requests): ?>
                        <?php foreach($my_cars as $row) : ?>
                            <tr>
                                <td><?php echo $row->car; ?></td>
                                <td><?php echo $row->date; ?></td>
                                <td><?php echo $row->start; ?>$</td>
                                <td><?php echo $row->end; ?>$</td>
                                <td>
                                    <a class="uk-button uk-button-success" href='<?php echo site_url("car/accept_request/".$row->id); ?>' type="button">Activate</a>
                                    <a class="uk-button uk-button-danger" href='<?php echo site_url("car/decline_request/".$row->id); ?>' type="button">Deactivate</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">
                                You don't have any request.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="uk-child-width-1-2" uk-grid>
        <div>
            <h2>My plans</h2>
            <table class="uk-table uk-table-middle uk-table-divider">
                <thead>
                    <tr>
                        <th class="uk-width-small">Date</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>12 Paź 1997</td>
                        <td>12:30</td>
                        <td>15:00</td>
                        <td><button class="uk-button uk-button-danger" type="button">Remove</button></td>
                    </tr>
                    <tr>
                        <td>15 Paź 1997</td>
                        <td>12:30</td>
                        <td>15:00</td>
                        <td><button class="uk-button uk-button-danger" type="button">Remove</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <h2>Sent requests</h2>
            <table class="uk-table uk-table-middle uk-table-divider">
                <thead>
                    <tr>
                        <th class="uk-width-small">Car</th>
                        <th>Date</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($sent_requests): ?>
                        <?php foreach($sent_requests as $row) : ?>
                            <tr>
                                <td><?php echo $row->car; ?></td>
                                <td><?php echo $row->date; ?></td>
                                <td><?php echo $row->start; ?>$</td>
                                <td><?php echo $row->end; ?>$</td>
                                <td>
                                    <a class="uk-button uk-button-danger" href='<?php echo site_url("car/cancel_request/".$row->id); ?>' type="button">Cancel</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">
                                You haven't sent any requests.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>