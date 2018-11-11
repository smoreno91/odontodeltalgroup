<?php
/**
 * Created by KP.
 * Date: 4/14/2017
 * Time: 16:22
 */
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="custom_card">
            <div class="header">
                <h2><?php esc_html_e('Pending Appointments', 'flex-appointments') ?></h2>
            </div>
            <div class="body table-responsive">
                <?php
                if (empty($pendings)):
                    ?>
                    <div class="fa-pending-empty"><?php esc_html_e('There are no pending appointments.', 'flex-appointments') ?></div>
                    <?php
                else:
                    ?>

                    <table class="table">
                        <thead>
                        <tr>
                            <th class="fa-check-list">
                                <div class="fa-pending-page-caption">
                                    <input type="checkbox" class="fa-select-all">
                                    <button class="fa-approve-all button button-primary"><?php esc_html_e('Approve', 'flex-appointments') ?></button>
                                    <button class="fa-delete-all button"><?php esc_html_e('Delete', 'flex-appointments') ?></button>
                                </div>
                            </th>
                            <th><?php esc_html_e('User', 'flex-appointments') ?></th>
                            <th><?php esc_html_e('Appointment informations', 'flex-appointments') ?></th>
                            <th><?php esc_html_e('Options', 'flex-appointments') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($pendings as $appointment):
                            $display_name = ($appointment->fa_uid != 0) ? get_user_by('ID', $appointment->fa_uid)->display_name : getGuestUserById($appointment->fa_gid)[0]->fa_guest_name;
                            ?>

                            <tr class="fa-pending-block">
                                <th scope="row" class="fa-check-list fa-select-appt"><input type="checkbox"
                                                                                            class="fa-checkbox"
                                                                                            value="<?php echo $appointment->fa_id ?>">
                                </th>
                                <td>
                                    <a class="fa fa-user" data-uid="<?php echo $appointment->fa_uid ?>"
                                       data-gid="<?php echo $appointment->fa_gid ?>"><?php echo $display_name ?></a>
                                </td>
                                <td class="pending-appt " data-app-id="<?php echo $appointment->fa_id ?>">
                                    <div class="fa-pending-block" data-app-id="<?php echo $appointment->fa_id ?>">
                                        <div class="fa-pending-date"><?php echo date_format(date_create($appointment->fa_date), 'l, F d, Y') ?></div>
                                        <i class="dashicons dashicons-clock"></i>
                                        <p class="fa-pending-time"><?php echo convertTimeToDisplay($appointment->fa_time) ?></p>
                                    </div>
                                </td>
                                <td class="fa-pendding-btn">
                                    <button data-app-id="<?php echo $appointment->fa_id ?>"
                                            data-app-date="<?php echo $appointment->fa_date ?>"
                                            class="fa-approve-btn button-primary">
                                        <?php esc_html_e('Approve', 'flex-appointments') ?>
                                    </button>
                                    <button class="fa-delete-btn"
                                            data-app-id="<?php echo $appointment->fa_id ?>"><?php esc_html_e('Delete', 'flex-appointments') ?></button>
                                </td>

                            </tr>
                            <?php
                        endforeach; ?>
                        </tbody>
                    </table>

                    <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</div>