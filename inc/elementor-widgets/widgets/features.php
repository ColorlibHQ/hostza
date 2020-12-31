<?php
namespace Hostzaelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Utils;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Hostza elementor Team Member section widget.
 *
 * @since 1.0
 */
class Hostza_Features extends Widget_Base {

	public function get_name() {
		return 'hostza-features';
	}

	public function get_title() {
		return __( 'Features', 'hostza' );
	}

	public function get_icon() {
		return 'eicon-featured-image';
	}

	public function get_categories() {
		return [ 'hostza-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------   Features content ------------------------------
		$this->start_controls_section(
			'features_block',
			[
				'label' => __( 'Features', 'hostza' ),
			]
		);
		$this->add_control(
            'features_content', [
                'label' => __( 'Create Feature', 'hostza' ),
                'type'  => Controls_Manager::REPEATER,
                'title_field' => '{{{ label }}}',
                'fields' => [
                    [
                        'name'  => 'hov_img',
                        'label' => __( 'Feature Hover Image', 'hostza' ),
                        'type'  => Controls_Manager::MEDIA,
                    ],
                    [
                        'name'  => 'label',
                        'label' => __( 'Title', 'hostza' ),
                        'type'  => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => __( 'Best Equipment', 'hostza' )
                    ],
                    [
                        'name'      => 'short_brief',
                        'label'     => __( 'Short Brief', 'hostza' ),
                        'type'      => Controls_Manager::TEXTAREA,
                        'default'   => __( 'Winged day grass creepeth us second signs', 'hostza' )
                    ],
                    [
                        'name'  => 'main_img',
                        'label' => __( 'Feature Image', 'hostza' ),
                        'type'  => Controls_Manager::MEDIA,
                    ]
                ]
            ]
        );

		$this->end_controls_section(); // End Features content       


	}

	protected function render() {

    $settings = $this->get_settings();
    $features = !empty( $settings['features_content'] ) ? $settings['features_content'] : '';
    ?>

    <!-- our_offer part start-->
    <section class="our_offer">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col-lg-12">
                    <?php
                    if( is_array( $features ) && count( $features ) > 0 ){
                        foreach ( $features as $feature ) {
                            $hov_img  = !empty( $feature['hov_img']['id'] ) ? wp_get_attachment_image( $feature['hov_img']['id'], 'hostza_feature_img_icon_39x58', array( 'alt' => 'single feature image' ) ) : '';
                            $feature_title = !empty( $feature['label'] ) ? $feature['label'] : '';
                            $feature_desc  = !empty( $feature['short_brief'] ) ? $feature['short_brief'] : '';
                            $main_img      = !empty( $feature['main_img']['id'] ) ? wp_get_attachment_image( $feature['main_img']['id'], 'hostza_feature_img_476x570', array( 'alt' => 'single feature big image' ) ) : '';
                    ?>
                    <div class="single_offer_part">
                        <div class="single_offer">
                            <?php
                                // Hover Image =============
                                if( $main_img ){
                                    echo wp_kses_post( $main_img );
                                }
                            ?>
                            <div class="hover_text">
                                <?php
                                    // Hover Image =============
                                    if( $hov_img ){
                                        echo wp_kses_post( $hov_img );
                                    }
                                    
                                    // Feature Title =============
                                    if( $feature_title ){
                                        echo '<h2>'. esc_html( $feature_title ) . '</h2>';
                                    }

                                    // Feature Short Brief =============
                                    if( $feature_desc ){
                                        echo '<p>'. wp_kses_post( $feature_desc ) . '</p>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- our_offer part end-->
    <?php
    }
}
