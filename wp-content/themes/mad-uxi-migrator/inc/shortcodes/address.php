<?php

$UXi_Shortcode_Company_Address = new UXi_Shortcode_Company_Address;

class UXi_Shortcode_Company_Address {

    public function __construct() {
        add_shortcode( "uxi_address", array($this, "shortcode") );
    }

    public function shortcode($atts) {

        $defaults = array(
            'name'                       => 'true',
            'name_size'                  => 'h3',  // '', h1-h6
            'name_align'                 => '',    // '', text-left, text-right, text-center
            'name_mobile_align'          => '',    // '', text-left-palm, text-right-palm, text-center-palm
            'address'                    => 'true',
            'country'                    => 'false',
            'map_link'                   => 'true',
            'phone'                      => 'true',
            'fax'                        => 'true',
            'email'                      => 'true',
            'hours'                      => 'true',
            'hours_heading_size'         => 'h4',  // '', h1 - h6
            'hours_heading_align'        => '',    // '', text-left, text-right, text-center
            'hours_heading_mobile_align' => '',    // '', text-left-palm, text-right-palm, text-center-palm
            'hours_inline'               => 'false',
            'payments'                   => 'true',
            'two_columns'                => 'false',
        );

        $atts = shortcode_atts($defaults, $atts);

        $company_info                 = uxi_get_company_info();
        $company_name                 = (isset($company_info['company']['name']['value'])) ? $company_info['company']['name']['value'] : '';
        $street                       = (isset($company_info['address']['street']['value'])) ? $company_info['address']['street']['value'] : '';
        $street2                      = (isset($company_info['address']['street2']['value']) && $company_info['address']['street2']['value'] !== '') ? ' <br>' . esc_html($company_info['address']['street2']['value']) : '';
        $city                         = (isset($company_info['address']['city']['value'])) ? $company_info['address']['city']['value'] : '';
        $state                        = (isset($company_info['address']['state']['value'])) ? $company_info['address']['state']['value'] : '';
        $zip                          = (isset($company_info['address']['zip']['value'])) ? $company_info['address']['zip']['value'] : '';
        $country_data                 = (isset($company_info['address']['country']['value'])) ? $company_info['address']['country']['value'] : '';
        $phone_label                  = (isset($company_info['contact']['phone_label']['value']) && $company_info['contact']['phone_label']['value']) ? $company_info['contact']['phone_label']['value'] : __('P:');
        $phone_number                 = (isset($company_info['contact']['phone']['value'])) ? $company_info['contact']['phone']['value'] : '';
        $phone_numbers                = (isset($company_info['contact']['phones']['value'])) ? $company_info['contact']['phones']['value'] : [];
        $fax_label                    = (isset($company_info['contact']['fax_label']['value']) && $company_info['contact']['fax_label']['value']) ? $company_info['contact']['fax_label']['value'] : __('F:');
        $fax_number                   = (isset($company_info['contact']['fax']['value'])) ? $company_info['contact']['fax']['value'] : '';
        $email_label                  = (isset($company_info['contact']['email_label']['value']) && $company_info['contact']['email_label']['value']) ? $company_info['contact']['email_label']['value'] : '';
        $email_address                = (isset($company_info['contact']['email']['value'])) ? $company_info['contact']['email']['value'] : '';
        $email_addresses              = (isset($company_info['contact']['emails']['value'])) ? $company_info['contact']['emails']['value'] : [];
        $business_hours               = (isset($company_info['business_hours']['hours']['value'])) ? $company_info['business_hours']['hours']['value'] : null;
        $payment_options              = (isset($company_info['payments']['options']['value'])) ? $company_info['payments']['options']['value'] : null;
        $payment_custom_options_text  = (isset($company_info['payments']['custom_options_text']['value'])) ? $company_info['payments']['custom_options_text']['value'] : '';
        $payment_custom_options_label = (isset($company_info['payments']['custom_options_label']['value'])) ? $company_info['payments']['custom_options_label']['value'] : '';


        if ($company_info) {

            // address
            $address_for_link = uxi_convert_address("{$company_info['address']['street']['value']} {$company_info['address']['street2']['value']} {$company_info['address']['city']['value']} {$company_info['address']['state']['value']} {$company_info['address']['zip']['value']} {$company_info['address']['country']['value']}");

            // email text
            $email_text = ($email_label !== '') ? $email_label : $email_address;

            if ($atts['two_columns'] == 'true') {
                $row = " row";
            } else {
                $row = '';
            }

            /**
             * Start output
             */

            $content = '';

            STATIC $i = 0;
            $i++;
            $id = "company-info-{$i}";
            $content .= '<section class="company-info'.$row.'" id="'.$id.'">';

            if (($atts['two_columns'] == 'true') && ($atts['hours'] == 'true')) {
                $content .= '<div class="grid-tab-6">';
            }

            if ($company_name !== '') {
                if ( $atts['name'] == 'true' ) {
                    $content .= '<h2 class="company-info-heading '.esc_attr($atts['name_size'].' '.$atts['name_align'].' '.$atts['name_mobile_align']).'">'.esc_html($company_name).'</h2>';
                } else if ($atts['name'] == 'false' ) {
                    $content .= '<h2 class="sr-only">'.esc_html($company_name).'</h2>';
                }
            }
            if ($atts['address'] == 'true' && $street !== '' && $city !== '' && $state !== '' && $zip !== '' ) {
                $content .= '<p class="company-info-address">';
                //
                $content .= '<span>';
                $content .= '<span>'.esc_html($street).$street2.'</span><br>';
                $content .= '<span>'.esc_html($city).'</span>, ';
                $content .= '<span>'.esc_html($state).'</span> ';
                $content .= '<span>'.esc_html($zip).'</span>';
                if ( $atts['country'] == 'true' && $country_data !== '' ) {
                    $content .= '<br><span>'.esc_html($country_data).'</span>';
                }
                $content .= '</span>';
                $content .= '</p>';
            }

            if ( $atts['map_link'] == 'true' ) {
                $content .= '<p class="company-info-map-link"><a href="'.esc_url('https://maps.google.com/maps/dir//'.$address_for_link).'" target="_blank">'.__('Get Directions').'</a></p>';
            }

            if ( $atts['phone'] == 'true' && $phone_number && empty($phone_numbers)) {
                $content .= '<p class="company-info-phone"><span>'.$phone_label.'</span> <a href="tel:'.esc_attr(uxi_numchar_only($phone_number)).'">'.esc_html($phone_number).'</a></p>';
            }

            if ( $phone_numbers && $atts['phone'] == 'true' ) {
                $content .= '<ul class="company-info-phones">';
                if ( $phone_number ) {
                    $content .= '<li class="company-info-phone">';
                    $content .= '<span>'.$phone_label.'</span> <a href="tel:'.esc_attr(uxi_numchar_only($phone_number)).'">'.esc_html($phone_number).'</a>';
                    $content .= '</li>';
                }
                foreach ($phone_numbers as $phone_data) {
                    $content .= '<li class="company-info-phone">';
                    if ($phone_data['label']) {
                        $content .= '<span>'.$phone_data['label'].'</span> ';
                    }
                    $content .= '<a href="tel:'.esc_attr(uxi_numchar_only($phone_data['number'])).'">'.esc_html($phone_data['number']).'</a>';
                    $content .= '</li>';
                }
                $content .= '</ul>';
            }

            if ( $atts['fax'] == 'true' && $fax_number !== '' ) {
                $content .= '<p class="company-info-fax"><span>'.$fax_label.'</span> <a href="tel:'.esc_attr(uxi_numchar_only($fax_number)).'">'.esc_html($fax_number).'</a></p>';
            }

            if ( $atts['email'] == 'true' && $email_address && empty($email_addresses)) {
                $content .= '<p class="company-info-email"><a href="mailto:'.esc_attr($email_address).'">'.esc_html($email_text).'</a></p>';
            }
            if ($atts['email'] == 'true' && $email_addresses) {
                $content .= '<ul class="company-info-emails">';
                if ($email_addresses) {
                    if ($email_address) {
                        $content .= '<li class="company-info-email"><a href="mailto:'.esc_attr($email_address).'">'.esc_html($email_text).'</a></li>';
                    }
                    foreach ($email_addresses as $email_data) {
                        $email_data_text = ($email_data['label']) ? $email_data['label'] : $email_data['email'];
                        $content .= '<li class="company-info-email"><a href="mailto:'.esc_attr($email_data['email']).'">'.esc_html($email_data_text).'</a></li>';
                    }
                }
                $content .= '</ul>';
            }

            if ( $atts['payments'] == 'true' && $payment_options ) {
                $content .= '<h3 class="sr-only">' . __('Accepted Payment Methods') . '</h3>';
                $content .= uxi_display_payments($payment_options, $payment_custom_options_label, $payment_custom_options_text);
            }

            if (($atts['two_columns'] == 'true') && ($atts['hours'] == 'true')) {
                $content .= '</div>';
                $content .= '<div class="grid-tab-6">';
            }

            if ($business_hours && $atts['hours'] == 'true') {
                $content .= '<h3 class="company-info-hours-heading '.esc_attr($atts['hours_heading_size'].' '.$atts['hours_heading_align'].' '.$atts['hours_heading_mobile_align']).'">'.__('Business Hours').'</h3>';
                $content .= uxi_get_hours($business_hours, true, $atts['hours_inline']);
            }

            if ( ($atts['two_columns'] == 'true') && ($atts['hours'] == 'true') ) {
                $content .= '</div>';
            }
            $content .= '</section>';
        } else {
            $content = '<div class="alert alert-info">'.__('UXi® Company Information Not Setup').'</div>';
        }

        return $content;
    }
}
