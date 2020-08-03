<?php
/*
Template Name: Intranät
*/

// This template serves all the intranet pages

// Check if user is logged in
if (!is_user_logged_in()) {

    // User is not logged in. Redirect browser to #login modal form.
    $url = home_url('/#login');
    header("Location: $url");
    exit();
} else {
    // User is logged in.

    // Add and start the Advanced Custom Fields loop
    add_action('genesis_entry_content', 'acf_loop');

    function acf_loop()
    {

        // ----------------------------------------
        // Add Advanced Custom Fields content below
        // ---------------------------------------- 
?>

        <?php
        // Intranät start page

        if (is_page(856)) {
            // Nothing needed here now; page created through Frontend Admin plugin
        }
        ?>


        <?php
        // Page = Medlemslista

        if (is_page(867)) {


            // Close Medlemslista page
        } ?>

                <?php
                // Page = Uppdrag

                if (is_page(890)) {
                    echo '<h2>Aktivitetsgruppen</h2>';
                    // Get ACF meta value for activity group and echo user in the group
                    $mont_users = get_users(array('orderby' => 'last_name', 'meta_key' => 'uppdrag', 'meta_value' => 'Aktivitetsgruppen'));
                    foreach ($mont_users as $user) {
                        if (esc_html($user->last_name) != '') {
                            echo '<p>' . esc_html($user->first_name) . ' ' . esc_html($user->last_name) . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->telnr) != '') {
                            $tel = esc_html($user->telnr);
                            echo '<a href="tel: ' . $tel . '">' . $tel . '</a>' . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->user_email) != '') {
                            echo '<a href="mailto:' . esc_html($user->user_email) . '">' . esc_html($user->user_email) . '</a>' . '</p>';
                        }
                    }

                    echo '<h2>Fadderfamiljen</h2>';
                    $mont_users = get_users(array('orderby' => 'last_name', 'meta_key' => 'uppdrag', 'meta_value' => 'Fadderfamiljen'));
                    foreach ($mont_users as $user) {
                        if (esc_html($user->last_name) != '') {
                            echo '<p>' . esc_html($user->first_name) . ' ' . esc_html($user->last_name) . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->telnr) != '') {
                            $tel = esc_html($user->telnr);
                            echo '<a href="tel: ' . $tel . '">' . $tel . '</a>' . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->user_email) != '') {
                            echo '<a href="mailto:' . esc_html($user->user_email) . '">' . esc_html($user->user_email) . '</a>' . '</p>';
                        }
                    }

                    echo '<h2>Hantverksgruppen</h2>';
                    $mont_users = get_users(array('orderby' => 'last_name', 'meta_key' => 'uppdrag', 'meta_value' => 'Hantverksgruppen'));
                    foreach ($mont_users as $user) {
                        if (esc_html($user->last_name) != '') {
                            echo '<p>' . esc_html($user->first_name) . ' ' . esc_html($user->last_name) . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->telnr) != '') {
                            $tel = esc_html($user->telnr);
                            echo '<a href="tel: ' . $tel . '">' . $tel . '</a>' . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->user_email) != '') {
                            echo '<a href="mailto:' . esc_html($user->user_email) . '">' . esc_html($user->user_email) . '</a>' . '</p>';
                        }
                    }

                    echo '<h2>Städmaterialansvarig</h2>';
                    $mont_users = get_users(array('orderby' => 'last_name', 'meta_key' => 'uppdrag', 'meta_value' => 'Städmaterialansvarig'));
                    foreach ($mont_users as $user) {
                        if (esc_html($user->last_name) != '') {
                            echo '<p>' . esc_html($user->first_name) . ' ' . esc_html($user->last_name) . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->telnr) != '') {
                            $tel = esc_html($user->telnr);
                            echo '<a href="tel: ' . $tel . '">' . $tel . '</a>' . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->user_email) != '') {
                            echo '<a href="mailto:' . esc_html($user->user_email) . '">' . esc_html($user->user_email) . '</a>' . '</p>';
                        }
                    }

                    echo '<h2>Städplaneringsansvarig</h2>';
                    $mont_users = get_users(array('orderby' => 'last_name', 'meta_key' => 'uppdrag', 'meta_value' => 'Städplaneringsansvarig'));
                    foreach ($mont_users as $user) {
                        if (esc_html($user->last_name) != '') {
                            echo '<p>' . esc_html($user->first_name) . ' ' . esc_html($user->last_name) . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->telnr) != '') {
                            $tel = esc_html($user->telnr);
                            echo '<a href="tel: ' . $tel . '">' . $tel . '</a>' . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->user_email) != '') {
                            echo '<a href="mailto:' . esc_html($user->user_email) . '">' . esc_html($user->user_email) . '</a>' . '</p>';
                        }
                    }

                    echo '<h2>Webbgruppen</h2>';
                    $mont_users = get_users(array('orderby' => 'last_name', 'meta_key' => 'uppdrag', 'meta_value' => 'Webbgruppen'));
                    foreach ($mont_users as $user) {
                        if (esc_html($user->last_name) != '') {
                            echo '<p>' . esc_html($user->first_name) . ' ' . esc_html($user->last_name) . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->telnr) != '') {
                            $tel = esc_html($user->telnr);
                            echo '<a href="tel: ' . $tel . '">' . $tel . '</a>' . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->user_email) != '') {
                            echo '<a href="mailto:' . esc_html($user->user_email) . '">' . esc_html($user->user_email) . '</a>' . '</p>';
                        }
                    }
                    // Close Aktivitetsgruppen page
                } ?>


                <?php //wp_reset_query(); 
                ?>


                <?php
                // Page = Styrelsen

                if (is_page(859)) {
                    if (get_field('inledningstext')) :
                        the_field('inledningstext');
                    endif;

                    echo '<h2>Styrelse Ordförande</h2>';
                    // Get ACF meta value for activity group and echo user in the group
                    $mont_users = get_users(array('orderby' => 'last_name', 'meta_key' => 'uppdrag', 'meta_value' => 'Styrelse Ordförande'));
                    foreach ($mont_users as $user) {
                        if (esc_html($user->last_name) != '') {
                            echo '<p>' . esc_html($user->first_name) . ' ' . esc_html($user->last_name) . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->telnr) != '') {
                            $tel = esc_html($user->telnr);
                            echo '<a href="tel: ' . $tel . '">' . $tel . '</a>' . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->user_email) != '') {
                            echo '<a href="mailto:' . esc_html($user->user_email) . '">' . esc_html($user->user_email) . '</a>' . '</p>';
                        }
                    }

                    if (get_field('ordforande_beskrivning')) :
                        the_field('ordforande_beskrivning');
                    endif;

                    echo '<h2>Styrelse Vice ordförande</h2>';
                    $mont_users = get_users(array('orderby' => 'last_name', 'meta_key' => 'uppdrag', 'meta_value' => 'Styrelse Vice ordförande'));
                    foreach ($mont_users as $user) {
                        if (esc_html($user->last_name) != '') {
                            echo '<p>' . esc_html($user->first_name) . ' ' . esc_html($user->last_name) . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->telnr) != '') {
                            $tel = esc_html($user->telnr);
                            echo '<a href="tel: ' . $tel . '">' . $tel . '</a>' . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->user_email) != '') {
                            echo '<a href="mailto:' . esc_html($user->user_email) . '">' . esc_html($user->user_email) . '</a>' . '</p>';
                        }
                    }

                    if (get_field('vice_ordforande_beskrivning')) :
                        the_field('vice_ordforande_beskrivning');
                    endif;

                    echo '<h2>Styrelse Sekreterare</h2>';
                    $mont_users = get_users(array('orderby' => 'last_name', 'meta_key' => 'uppdrag', 'meta_value' => 'Styrelse Sekreterare'));
                    foreach ($mont_users as $user) {
                        if (esc_html($user->last_name) != '') {
                            echo '<p>' . esc_html($user->first_name) . ' ' . esc_html($user->last_name) . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->telnr) != '') {
                            $tel = esc_html($user->telnr);
                            echo '<a href="tel: ' . $tel . '">' . $tel . '</a>' . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->user_email) != '') {
                            echo '<a href="mailto:' . esc_html($user->user_email) . '">' . esc_html($user->user_email) . '</a>' . '</p>';
                        }
                    }

                    if (get_field('sekreterare_beskrivning')) :
                        the_field('sekreterare_beskrivning');
                    endif;

                    echo '<h2>Styrelse Kassör</h2>';
                    $mont_users = get_users(array('orderby' => 'last_name', 'meta_key' => 'uppdrag', 'meta_value' => 'Styrelse Kassör'));
                    foreach ($mont_users as $user) {
                        if (esc_html($user->last_name) != '') {
                            echo '<p>' . esc_html($user->first_name) . ' ' . esc_html($user->last_name) . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->telnr) != '') {
                            $tel = esc_html($user->telnr);
                            echo '<a href="tel: ' . $tel . '">' . $tel . '</a>' . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->user_email) != '') {
                            echo '<a href="mailto:' . esc_html($user->user_email) . '">' . esc_html($user->user_email) . '</a>' . '</p>';
                        }
                    }

                    if (get_field('kassor_beskrivning')) :
                        the_field('kassor_beskrivning');
                    endif;

                    echo '<h2>Styrelse Personalansvarig</h2>';
                    $mont_users = get_users(array('orderby' => 'last_name', 'meta_key' => 'uppdrag', 'meta_value' => 'Styrelse Personalansvarig'));
                    foreach ($mont_users as $user) {
                        if (esc_html($user->last_name) != '') {
                            echo '<p>' . esc_html($user->first_name) . ' ' . esc_html($user->last_name) . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->telnr) != '') {
                            $tel = esc_html($user->telnr);
                            echo '<a href="tel: ' . $tel . '">' . $tel . '</a>' . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->user_email) != '') {
                            echo '<a href="mailto:' . esc_html($user->user_email) . '">' . esc_html($user->user_email) . '</a>' . '</p>';
                        }
                    }

                    if (get_field('personalansvarig_beskrivning')) :
                        the_field('personalansvarig_beskrivning');
                    endif;

                    echo '<h2>Styrelse Suppleant 1</h2>';
                    $mont_users = get_users(array('orderby' => 'last_name', 'meta_key' => 'uppdrag', 'meta_value' => 'Styrelse Suppleant 1'));
                    foreach ($mont_users as $user) {
                        if (esc_html($user->last_name) != '') {
                            echo '<p>' . esc_html($user->first_name) . ' ' . esc_html($user->last_name) . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->telnr) != '') {
                            $tel = esc_html($user->telnr);
                            echo '<a href="tel: ' . $tel . '">' . $tel . '</a>' . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->user_email) != '') {
                            echo '<a href="mailto:' . esc_html($user->user_email) . '">' . esc_html($user->user_email) . '</a>' . '</p>';
                        }
                    }

                    if (get_field('suppleant_1_beskrivning')) :
                        the_field('suppleant_1_beskrivning');
                    endif;

                    echo '<h2>Styrelse Suppleant 2</h2>';
                    $mont_users = get_users(array('orderby' => 'last_name', 'meta_key' => 'uppdrag', 'meta_value' => 'Styrelse Suppleant 2'));
                    foreach ($mont_users as $user) {
                        if (esc_html($user->last_name) != '') {
                            echo '<p>' . esc_html($user->first_name) . ' ' . esc_html($user->last_name) . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->telnr) != '') {
                            $tel = esc_html($user->telnr);
                            echo '<a href="tel: ' . $tel . '">' . $tel . '</a>' . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->user_email) != '') {
                            echo '<a href="mailto:' . esc_html($user->user_email) . '">' . esc_html($user->user_email) . '</a>' . '</p>';
                        }
                    }

                    if (get_field('suppleant_2_beskrivning')) :
                        the_field('suppleant_2_beskrivning');
                    endif;

                    echo '<h2>Styrelse Suppleant 3</h2>';
                    $mont_users = get_users(array('orderby' => 'last_name', 'meta_key' => 'uppdrag', 'meta_value' => 'Styrelse Suppleant 3'));
                    foreach ($mont_users as $user) {
                        if (esc_html($user->last_name) != '') {
                            echo '<p>' . esc_html($user->first_name) . ' ' . esc_html($user->last_name) . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->telnr) != '') {
                            $tel = esc_html($user->telnr);
                            echo '<a href="tel: ' . $tel . '">' . $tel . '</a>' . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->user_email) != '') {
                            echo '<a href="mailto:' . esc_html($user->user_email) . '">' . esc_html($user->user_email) . '</a>' . '</p>';
                        }
                    }

                    if (get_field('suppleant_3_beskrivning')) :
                        the_field('suppleant_3_beskrivning');
                    endif;

                    echo '<h2>Lekmannarevisor</h2>';
                    $mont_users = get_users(array('orderby' => 'last_name', 'meta_key' => 'uppdrag', 'meta_value' => 'Lekmannarevisor'));
                    foreach ($mont_users as $user) {
                        if (esc_html($user->last_name) != '') {
                            echo '<p>' . esc_html($user->first_name) . ' ' . esc_html($user->last_name) . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->telnr) != '') {
                            $tel = esc_html($user->telnr);
                            echo '<a href="tel: ' . $tel . '">' . $tel . '</a>' . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->user_email) != '') {
                            echo '<a href="mailto:' . esc_html($user->user_email) . '">' . esc_html($user->user_email) . '</a>' . '</p>';
                        }
                    }

                    if (get_field('lekmannarevisor_beskrivning')) :
                        the_field('lekmannarevisor_beskrivning');
                    endif;

                    echo '<h2>Valberedning</h2>';
                    $mont_users = get_users(array('orderby' => 'last_name', 'meta_key' => 'uppdrag', 'meta_value' => 'Valberedning'));
                    foreach ($mont_users as $user) {
                        if (esc_html($user->last_name) != '') {
                            echo '<p>' . esc_html($user->first_name) . ' ' . esc_html($user->last_name) . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->telnr) != '') {
                            $tel = esc_html($user->telnr);
                            echo '<a href="tel: ' . $tel . '">' . $tel . '</a>' . '<br />';
                        }
                        if (esc_html($user->last_name) != '' && esc_html($user->user_email) != '') {
                            echo '<a href="mailto:' . esc_html($user->user_email) . '">' . esc_html($user->user_email) . '</a>' . '</p>';
                        }
                    }

                    if (get_field('valberedning')) :
                        the_field('valberedning');
                    endif;

                    // Close Styrelsen page
                } ?>


                <?php wp_reset_query(); ?>


        <?php
        // ----------------------------------------
        // Close ACF loop
    }
    // ----------------------------------------

    //* Run the Genesis loop

    genesis();
}
