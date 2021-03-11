<?php

namespace WpCafe\Widgets\Wpc_Resevation_Form;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use \WpCafe\Utils\Wpc_Utilities as Wpc_Utilities;

defined( "ABSPATH" ) || exit;

class Wpc_Resevation_Form extends Widget_Base {

    /**
     * Retrieve the widget name.
     * @return string Widget name.
     */
    public function get_name() {
        return 'wpc-reservation-form';
    }

    /**
     * Retrieve the widget title.
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'WPC Reservation Form', 'wpcafe' );
    }

    /**
     * Retrieve the widget icon.
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-user-circle-o';
    }

    /**
     * Retrieve the widget category.
     * @return string Widget category.
     */
    public function get_categories() {
        return ['wpcafe-menu'];
    }

    protected function _register_controls() {
        // Start of event section
        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__( 'WPC Reservation Form', 'wpcafe' ),
            ]
        );

        $this->add_control(
			'style',
			[
				'label' => __( 'Style', 'wpcafe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1' => esc_html__('Style 1', 'wpcafe'),
					'2' => esc_html__('Style 2', 'wpcafe'),
				],
				'default' => '1',
			]
		);


        $this->add_control(
            'wpc_reservation_image',
            [
                'label' => __( 'Reservation Image', 'wpcafe' ),
                'type'  => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'wpc_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'wpcafe' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .wpc-reservation-field label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'wpc_label_typo',
                'label'    => esc_html__( 'Typography', 'wpcafe' ),
                'selector' => '{{WRAPPER}} .wpc-reservation-field label',
            ]
        );

        $this->end_controls_section();
        // Start of event section
        $this->start_controls_section(
            'section_input_field',
            [
                'label' => esc_html__( 'Input field', 'wpcafe' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'wpc_input_color',
            [
                'label'     => esc_html__( 'Input Color', 'wpcafe' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}   .wpc-reservation-field .wpc-form-control' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'wpc_input_bg_color',
            [
                'label'     => esc_html__( 'Input Background Color', 'wpcafe' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}   .wpc-reservation-field .wpc-form-control' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'wpc_input_placeholder_color',
            [
                'label'     => esc_html__( 'Input Placeholder Color', 'wpcafe' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}   .wpc-reservation-field .wpc-form-control::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'wpc_input_typo',
                'label'    => esc_html__( 'Typography', 'wpcafe' ),
                'selector' => '{{WRAPPER}}  .wpc-reservation-field .wpc-form-control',
            ]
        );
        $this->add_responsive_control(
            'input_height',
            [
                'label'      => __( 'Input Height', 'wpcafe' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wpc-reservation-field .wpc-form-control' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'input_textarea_height',
            [
                'label'      => __( 'Textarea Height', 'wpcafe' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wpc-reservation-form .wpc-reservation-field .wpc-form-control#wpc-message,{{WRAPPER}} .wpc-reservation-form .wpc-reservation-field .wpc_cancell_message' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'input_padding',
            [
                'label'      => __( 'Input Padding', 'wpcafe' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpc-reservation-field .wpc-form-control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Start of button section
        $this->start_controls_section(
            'section_button',
            [
                'label' => esc_html__( 'Button', 'wpcafe' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'wpc_btn_link_color',
            [
                'label'     => esc_html__( 'Button Link color', 'wpcafe' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}   #wpc_book_table'     => 'color: {{VALUE}};',
                    '{{WRAPPER}}   #wpc_cancel_request' => 'color: {{VALUE}};',
                ],
            ]
        );

        //start of nav color tabs (normal and hover)
        $this->start_controls_tabs(
            'wpc_btn_tabs'
            
        );

        //start of nav normal color tab
        $this->start_controls_tab(
            'wpc_btn_normal_tab',
            [
                'label' => __( 'Normal', 'wpcafe' ),
            ]
        );

        $this->add_control(
            'wpc_btn_color',
            [
                'label'     => esc_html__( 'Button color', 'wpcafe' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}   .wpc-btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'wpc_btn_bg_color',
            [
                'label'     => esc_html__( 'Button Background color', 'wpcafe' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}   .wpc-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'btn_box_shadow',
                'label'    => __( 'Box Shadow', 'wpcafe' ),
                'selector' => '{{WRAPPER}}  .wpc-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'btn_border',
                'label'    => esc_html__( 'Border', 'wpcafe' ),
                'selector' => '{{WRAPPER}} .wpc-btn',
            ]
        );

        $this->end_controls_tab();
		//end of nav normal color tab

        //start of nav active color tab
        $this->start_controls_tab(
            'wpc_btn_hover_tab',
            [
                'label' => __( 'Hover', 'wpcafe' ),
            ]
        );
        $this->add_control(
            'wpc_btn_Hover_color',
            [
                'label'     => esc_html__( 'Button Hover color', 'wpcafe' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}   .wpc-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'wpc_btn_bg_hover_color',
            [
                'label'     => esc_html__( 'Button Background Hover color', 'wpcafe' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}   .wpc-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'btn_box__hover_shadow',
                'label'    => __( 'Box Shadow', 'wpcafe' ),
                'selector' => '{{WRAPPER}}  .wpc-btn:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'btn_border_hover',
                'label'    => esc_html__( 'Border', 'wpcafe' ),
                'selector' => '{{WRAPPER}} .wpc-btn:hover',
            ]
        );
        $this->end_controls_tab();
        //end of nav hover color tab

        $this->end_controls_tabs();
        //end of nav color tabs (normal and hover)

        $this->add_responsive_control(
            'wpc_btn_padding',
            [
                'label'      => __( 'Button Padding', 'wpcafe' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpc-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Start of event section
        $this->start_controls_section(
            'section_advance',
            [
                'label' => esc_html__( 'Advance', 'wpcafe' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'wpc_form_bg_color',
            [
                'label'     => esc_html__( 'Form Backround color', 'wpcafe' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}   .wpc-reservation-form' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'calender_bg_color',
            [
                'label'     => esc_html__( 'Calender BG color', 'wpcafe' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpc-reservation-field.date.wpc-reservation-calender-field, {{WRAPPER}} .wpc-reservation-form .wpc_reservation_user_info' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .wpc-reservation-field.date .flatpickr-day, {{WRAPPER}} .wpc-food-menu-item.style2:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'label'    => __( 'Box Shadow', 'wpcafe' ),
                'selector' => '{{WRAPPER}}  .wpc_reservation_form',
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => __( 'Box Padding', 'wpcafe' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpc_reservation_form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings          = $this->get_settings();
        $reservation_image = $settings['wpc_reservation_image']['url'];
        $style = $settings['style'];
        echo do_shortcode( "[wpc_reservation_form wpc_image_url='$reservation_image' form_style='$style'] " );
    }

    protected function get_menu_category() {
        return Wpc_Utilities::get_menu_category();
    }

}
