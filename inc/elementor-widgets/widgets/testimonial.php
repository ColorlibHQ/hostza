<?php
namespace Hostzaelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
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
 * Hostza elementor section widget.
 *
 * @since 1.0
 */
class Hostza_Testimonial extends Widget_Base {

	public function get_name() {
		return 'hostza-testimonial';
	}

	public function get_title() {
		return __( 'Testimonial', 'hostza' );
	}

	public function get_icon() {
		return 'eicon-post-slider';
	}

	public function get_categories() {
		return [ 'hostza-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Customers review content ------------------------------
		$this->start_controls_section(
			'customersreview_content',
			[
				'label' => __( 'Customers Review', 'hostza' ),
			]
		);

		$this->add_control(
            'review_slider', [
                'label' => __( 'Create Review', 'hostza' ),
                'type'  => Controls_Manager::REPEATER,
                'title_field' => '{{{ client_name }}}',
                'fields' => [
                    [
                        'name'  => 'quote_img',
                        'label' => __( 'Quote Image', 'hostza' ),
                        'type'  => Controls_Manager::MEDIA,
                    ],
                    [
                        'name'  => 'desc',
                        'label' => __( 'Review Text', 'hostza' ),
                        'type'  => Controls_Manager::TEXTAREA,
                        'default'   => __('Also made from. Give may saying meat there from heaven it lights face had is gathered god dea earth light for life may itself shall whales made they\'re blessed whales also made from give may saying meat. There from heaven it lights face had amazing place', 'hostza')
                    ],
                    [
                        'name'  => 'client_img',
                        'label' => __( 'Client Image', 'hostza' ),
                        'type'  => Controls_Manager::MEDIA,
                    ],
                    [
                        'name'  => 'client_name',
                        'label' => __( 'Client Name', 'hostza' ),
                        'type'  => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => esc_html__( 'Mosan Cameron', 'hostza' )
                    ],
                    [
                        'name'  => 'designation',
                        'label' => __( 'Designation', 'hostza' ),
                        'type'  => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => esc_html__( 'Executive of fedex', 'hostza' )
                    ],
                ],
            ]
		);

		$this->end_controls_section(); // End exibition content

        /**
         * Style Tab
         *
         */
		//------------------------------ Style Section ------------------------------
		$this->start_controls_section(
			'style_section', [
				'label' => __( 'Style Items', 'hostza' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'rev_txt_color', [
				'label'     => __( 'Review Text Color', 'hostza' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .review_part .client_review_single .client_review_text p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'client_name_color', [
				'label'     => __( 'Client Name Color', 'hostza' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .review_part .client_review_single h4' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'desig_color', [
				'label'     => __( 'Client Designation Color', 'hostza' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .review_part .client_review_single h4 span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

        /*------------------------------ Background Style ------------------------------*/
        $this->start_controls_section(
            'section_bg', [
                'label' => __( 'Style Background', 'hostza' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'section_bgheading',
            [
                'label'     => __( 'Section Background Settings', 'hostza' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'section-bg',
                'label' => __( 'Section Background', 'hostza' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .review_part',
            ]
        );

        $this->add_control(
            'bg_overlay_heading',
            [
                'label'     => __( 'Background Overlay Settings', 'hostza' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'bg_overlay', [
                'label'     => __( 'Background Overlay', 'hostza' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#221f3f',
                'selectors' => [
                    '{{WRAPPER}} .review_part:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();   

	}

	protected function render() {

    $settings = $this->get_settings();
    // call load widget script
	$this->load_widget_script();
    $reviews = !empty( $settings['review_slider'] ) ? $settings['review_slider'] : '';
    ?>

    <!--::review_part start::-->
    <section class="review_part gray_bg section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="client_review_part owl-carousel">
                        <?php
                        if( is_array( $reviews ) && count( $reviews ) > 0 ){
                            foreach ($reviews as $review ) {
                                $quote_img     = !empty( $review['quote_img']['id'] ) ? wp_get_attachment_image( $review['quote_img']['id'], 'hostza_quote_thumb_59x51', '', array('class' => 'Quote', 'alt' => 'quote image' ) ) : '';
                                $desc          = !empty( $review['desc'] ) ? $review['desc'] : '';
                                $client_img    = !empty( $review['client_img']['id'] ) ? wp_get_attachment_image( $review['client_img']['id'], 'hostza_review_client_img_160x160', '', array('class' => 'image','alt' => 'client image' ) ) : '';
                                $client_name   = !empty( $review['client_name'] ) ? $review['client_name'] : '';
                                $designation   = !empty( $review['designation'] ) ? '<span>' . esc_html($review['designation']) . '</span>' : '';
                            ?>      
                        <div class="client_review_single">
                            <?php
                                // Price Image =============
                                if( $quote_img ){
                                    echo wp_kses_post( $quote_img );
                                }

                                echo '<div class="client_review_text">';
                                    // Review text =============
                                    if( $desc ){
                                        echo '<p>'. wp_kses_post( $desc ) . '</p>';
                                    }
                                echo '</div>';
                                
                                echo '<div class="client_img">';
                                    // Client Image =============
                                    if( $client_img ){
                                        echo wp_kses_post( $client_img );
                                    }
                                echo '</div>';

                                // Client info =============
                                if( $client_name ){
                                    echo '<h4>'. esc_html( $client_name ) . ', ' . $designation . '</h4>';
                                } 
                            ?>
                        </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::review_part end::-->
    <?php

    }

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            var review = $('.client_review_part');
            if (review.length) {
                review.owlCarousel({
                items: 1,
                loop: true,
                dots: true,
                autoplay: true,
                autoplayHoverPause: true,
                autoplayTimeout: 5000,
                nav: false,
                smartSpeed: 2000,
                });
            }
        })(jQuery);
        </script>
        <?php 
        }
    }
	
}
