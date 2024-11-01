<?php

/**
 * @package Shortcode Loan Calculator
 */
/*
 * Plugin Name: Shortcode Loan Calculator
 * Plugin URI: http://www.sagaio.com/tillagg-for-wordpress/
 * Description: Provides a shortcode [shortcode_loan_calculator] that returns the sum of the values provided in loan and multiplier.
 * Version: 1.0.1
 * Author: SAGAIO
 * Author URI: http://www.sagaio.com
 * License: MIT
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/

defined( 'ABSPATH' ) or die( 'Forbidden' );

class ShortcodeLoanCalculator {

    static function init() {

        add_action( 'customize_register', array(__CLASS__, 'sagaio_slc_customize_register' ));
        add_shortcode('shortcode_loan_calculator', array(__CLASS__, 'handle_shortcode'));

    }

    static function handle_shortcode( $atts = [] ) {
        $atts = shortcode_atts( array(
                'loan' => null,
                'multiplier' => null,
                'fallback_text' => 'Contact us for pricing',
            ), $atts );

        $decimals = get_option('sagaio_slc_decimals', 0);
        $decimals_sep = get_option('sagaio_slc_decimals_sep', ',');
        $thousands_sep = get_option('sagaio_slc_thousands_sep', ' ');

        if(!empty($atts['multiplier']) && $atts['multiplier'] !== 'global') {


            // Check if loan and multiplier has been added to the shortcode
            if((  !empty($atts['loan']) && !empty($atts['multiplier']) )) {

                $sum = (float)$atts['loan'] * (float)$atts['multiplier'];

                return number_format( $sum, $decimals, $decimals_sep, $thousands_sep );
            }

        } else if( $atts['multiplier'] === 'global' && !empty(get_option('sagaio_slc_global_multiplier'))) {

            // Check if loan and multiplier has been added to the shortcode
            if((  !empty($atts['loan']) )) {

                $multiplier = get_option('sagaio_slc_global_multiplier');
                $sum = $atts['loan'] * $multiplier;

                return number_format( $sum, $decimals, $decimals_sep, $thousands_sep );
            }

        }

        // Return a fallback text if loan or multiplier is empty
        return $atts['fallback_text'];
    }

    static function sagaio_slc_customize_register( $wp_customize ) {

        /* Add section for plugin settings */
        $wp_customize->add_section( 'sagaio_slc' , array(
          'title' => __( 'Shortcode Loan Calculator', 'sagaio-slc' ),
          'description' => __( 'Settings for SAGAIO Shortcode Loan Calculator', 'sagaio-slc' ),
          'priority' => 90, // Before Navigation.
        ) );

        /* Add settings for user control - text */
        $global_variables = [];
        $global_variables[] = array( 'slug'=>'sagaio_slc_global_multiplier', 'default' => '', 'label' => __( 'Global multiplier', 'sagaio-slc' ), 'description' => 'Will be overriden if you specify the "multiplier" argument in the shortcode' );

        foreach($global_variables as $global_variable)
        {
            $wp_customize->add_setting( $global_variable['slug'], array( 'default' => $global_variable['default'], 'type' => 'option', 'capability' => 'edit_theme_options' ));
            $wp_customize->add_control( $global_variable['slug'], array( 'type' => 'input', 'label' => $global_variable['label'], 'description' => $global_variable['description'], 'section' => 'sagaio_slc' ));
        }

        /* Add settings for thousands separator and decimals */
        $separators = [];
        $separators[] = array( 'slug'=>'sagaio_slc_thousands_sep', 'default' => ' ', 'label' => __( 'Thousands separator', 'sagaio-slc' ), 'description' => '1 blank sapce is the default' );
        $separators[] = array( 'slug'=>'sagaio_slc_decimals', 'default' => 0, 'label' => __( 'Number of decimals', 'sagaio-slc' ), 'description' => '0 is the default' );
        $separators[] = array( 'slug'=>'sagaio_slc_decimals_sep', 'default' => ',', 'label' => __( 'Decimal separator', 'sagaio-slc' ), 'description' => ', is the default' );

        foreach($separators as $separator)
        {
            $wp_customize->add_setting( $separator['slug'], array( 'default' => $separator['default'], 'type' => 'option', 'capability' => 'edit_theme_options' ));
            $wp_customize->add_control( $separator['slug'], array( 'type' => 'input', 'label' => $separator['label'], 'description' => $separator['description'], 'section' => 'sagaio_slc' ));
        }
    }
}

ShortcodeLoanCalculator::init();