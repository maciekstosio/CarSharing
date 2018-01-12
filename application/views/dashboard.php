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
                            <td><?php echo $row->license_plate; ?></td>
                            <td><?php echo $row->type; ?></td>
                            <td><?php echo $row->price; ?>$</td>
                            <td>
                                <?php if($row->active < 0): ?>
                                    <button class="uk-button uk-button-success" type="button">Activate</button>
                                <?php endif; ?>
                                <?php if($row->active > 0): ?>
                                    <button class="uk-button uk-button-danger" type="button">Deactivate</button>
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
                    <tr>
                        <td>DW 3E175</td>
                        <td>12 Paź 1997</td>
                        <td>12:30</td>
                        <td>15:00</td>
                        <td>
                            <button class="uk-button uk-button-danger" type="button">Discard</button>
                            <button class="uk-button uk-button-success" type="button">Accept</button>
                        </td>
                    </tr>
                    <tr>
                        <td>DW 610XC</td>
                        <td>15 Paź 1997</td>
                        <td>12:30</td>
                        <td>15:00</td>
                        <td>
                            <button class="uk-button uk-button-danger" type="button">Discard</button>
                            <button class="uk-button uk-button-success" type="button">Accept</button>
                        </td>
                    </tr>
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
                    <tr>
                        <td>Toyota Corolla</td>
                        <td>12 Paź 1997</td>
                        <td>12:30</td>
                        <td>15:00</td>
                        <td><button class="uk-button uk-button-danger" type="button">Cancel</button></td>
                    </tr>
                    <tr>
                        <td>Toyota Corolla</td>
                        <td>15 Paź 1997</td>
                        <td>12:30</td>
                        <td>15:00</td>
                        <td><button class="uk-button uk-button-danger" type="button">Cancel</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>