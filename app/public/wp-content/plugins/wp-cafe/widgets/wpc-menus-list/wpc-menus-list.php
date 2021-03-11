<?php

namespace WpCafe\Widgets\Wpc_Menus_list;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use \WpCafe\Utils\Wpc_Utilities as Wpc_Utilities;

defined( "ABSPATH" ) || exit;

class Wpc_Menus_List extends Widget_Base {

    /**
     * Retrieve the widget name.
     * @return string Widget name.
     */
    public function get_name() {
        return 'wpc-menu';
    }

    /**
     * Retrieve the widget title.
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'WPC Food Menu List', 'wpcafe' );
    }

    /**
     * Retrieve the widget icon.
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-menu-card';
    }

    /**
     * Retrieve the widget category.
     * @return string Widget category.
     */
    public function get_categories() {
        return ['wpcafe-menu'];
    }

    protected function _register_controls() {
        $get_data = apply_filters( 'elementor/control/search_control' , false);

        // Start of event section
        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__( 'WPC Food Menu List', 'wpcafe' ),
            ]
        );

        $this->add_control(
            'food_menu_style',
            [
                'label'   => esc_html__( 'Menu Style', 'wpcafe' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style-1',
                'options' => [
                    'style-1' => esc_html__( 'Menu Style 1', 'wpcafe' ),
                    'style-2' => esc_html__( 'Menu Style 2', 'wpcafe' ),
                ],
            ]
        );

        $this->add_control(
            'wpc_menu_cat',
            [
                'label'       => esc_html__( 'Menu Category', 'wpcafe' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => $this->get_menu_category(),
                'multiple'    => true,
                'label_block' => true,

            ]
        );
        $this->add_control(
            'wpc_menu_count',
            [
                'label'   => esc_html__( 'Menu count', 'wpcafe' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => '6',
            ]
        );
        $this->add_control(
            'wpc_menu_order',
            [
                'label'   => __( 'Menu Order', 'wpcafe' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC'  => __( 'ASC', 'wpcafe' ),
                    'DESC' => __( 'DESC', 'wpcafe' ),
                ],
            ]
        );
        $this->add_control(
            'show_thumbnail',
            [
                'label'        => esc_html__( 'Show Thumbnail', 'wpcafe' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'wpcafe' ),
                'label_off'    => esc_html__( 'Hide', 'wpcafe' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            'show_item_status',
            [
                'label'        => esc_html__( 'Show Item Status', 'wpcafe' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'wpcafe' ),
                'label_off'    => esc_html__( 'Hide', 'wpcafe' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            'wpc_show_desc',
            [
                'label'        => esc_html__( 'Show Description', 'wpcafe' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'wpcafe' ),
                'label_off'    => esc_html__( 'Hide', 'wpcafe' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            'wpc_desc_limit',
            [
                'label'     => esc_html__( 'Description Limit', 'wpcafe' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => '15',
                'condition' => ['wpc_show_desc' => 'yes'],
            ]
        );
        $this->add_control(
            'title_link_show',
            [
                'label'        => esc_html__( 'Use Title Link?', 'wpcafe' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'wpcafe' ),
                'label_off'    => esc_html__( 'Hide', 'wpcafe' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            'wpc_cart_button_show',
            [
                'label'        => esc_html__( 'Show add to cart button', 'wpcafe' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'wpcafe' ),
                'label_off'    => esc_html__( 'Hide', 'wpcafe' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        if( is_array( $get_data ) &&  count( $get_data )>0 && isset( $get_data['search_control'] ) ){
            $this->add_control( $get_data['search_control']['name'], $get_data['search_control']['parameter']);
        }

        $this->end_controls_section();

        // item status style section
        $this->start_controls_section(
            'item_status_style',
            [
                'label'     => __( 'Item Status Style', 'wpcafe' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => ['show_item_status' => 'yes'],
            ]
        );
        $this->add_control(
            'wpc_menu_item_status_color',
            [
                'label'     => esc_html__( 'Item Status Color', 'wpcafe' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpc-menu-tag li' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'wpc_menu_item_status_bg_color',
            [
                'label'     => esc_html__( 'Item Status BG Color', 'wpcafe' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpc-menu-tag li' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'wpc_menu_status_typo',
                'label'    => esc_html__( 'Typography', 'wpcafe' ),
                'selector' => '{{WRAPPER}} .wpc-menu-tag li',
            ]
        );
        $this->add_responsive_control(
            'wpc_menu_item_status_paddding',
            [
                'label'      => esc_html__( 'Padding', 'wpcafe' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpc-menu-tag li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // item cart button style section
        $this->start_controls_section(
            'item_cart_button_style',
            [
                'label'     => __( 'Cart Button Style', 'wpcafe' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => ['wpc_cart_button_show' => 'yes'],
            ]
        );
        $this->add_control(
            'wpc_cart_color',
            [
                'label'     => esc_html__( 'Cart Button Color', 'wpcafe' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpc-food-menu-item .wpc-add-to-cart a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'wpc_cart_button_bg_color',
            [
                'label'     => esc_html__( 'Cart Button BG Color', 'wpcafe' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpc-food-menu-item .wpc-add-to-cart a' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'wpc_cart_button_typo',
                'label'    => esc_html__( 'Typography', 'wpcafe' ),
                'selector' => '{{WRAPPER}} .wpc-food-menu-item .wpc-add-to-cart a i',
            ]
        );
        $this->add_responsive_control(
            'cart_btn_width',
            [
                'label'      => __( 'Width', 'wpcafe' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => '45',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wpc-food-menu-item .wpc-add-to-cart a' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cart_btn_height',
            [
                'label'      => __( 'Height', 'wpcafe' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => '45',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wpc-food-menu-item .wpc-add-to-cart a' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wpc_cart_btn_paddding',
            [
                'label'      => esc_html__( 'Padding', 'wpcafe' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpc-food-menu-item .wpc-add-to-cart a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // title style section
        $this->start_controls_section(
            'title_style',
            [
                'label' => __( 'Title Style', 'wpcafe' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'wpc_menu_title_color',
            [
                'label'     => esc_html__( 'Title Color', 'wpcafe' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpc-post-title a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'wpc_menu_title_hover_color',
            [
                'label'     => esc_html__( 'Title Hover Color', 'wpcafe' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpc-post-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        //control for title typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'wpc_menu_title',
                'label'    => esc_html__( 'Title Typography', 'wpcafe' ),
                'selector' => '{{WRAPPER}} .wpc-post-title',
            ]
        );
        $this->add_responsive_control(
            'wpc_title_margin',
            [
                'label'      => esc_html__( 'Title Margin', 'wpcafe' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpc-post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // price style section
        $this->start_controls_section(
            'price_style',
            [
                'label' => __( 'Price Style', 'wpcafe' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'wpc_menu_price_color',
            [
                'label'     => esc_html__( 'Price Color', 'wpcafe' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpc-menu-currency' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'wpc_menu_price_bg_color',
            [
                'label'     => esc_html__( 'Price Background Color', 'wpcafe' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpc-menu-currency' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        //control for title typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'wpc_menu_price',
                'label'    => esc_html__( 'Price Typography', 'wpcafe' ),
                'selector' => '{{WRAPPER}} .wpc-menu-currency',
            ]
        );

        $this->end_controls_section();

        // description style section
        $this->start_controls_section(
            'wpc_desc_style',
            [
                'label' => __( 'Description Style', 'wpcafe' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'wpc_menu_desc_color',
            [
                'label'     => esc_html__( 'Description Color', 'wpcafe' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpc-food-inner-content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        //control for title typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'wpc_menu_desc',
                'label'    => esc_html__( 'Description Typography', 'wpcafe' ),
                'selector' => '{{WRAPPER}} .wpc-food-inner-content p',
            ]
        );

        $this->add_responsive_control(
            'wpc_desc_margin',
            [
                'label'      => esc_html__( 'Description Margin', 'wpcafe' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpc-food-inner-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // advance style section
        $this->start_controls_section(
            'wpc_advance_style',
            [
                'label' => __( 'Advance Style', 'wpcafe' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'wpc_box_margin',
            [
                'label'      => esc_html__( 'Margin', 'wpcafe' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpc-food-menu-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wpc_box_padding',
            [
                'label'      => esc_html__( 'Padding', 'wpcafe' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpc-food-menu-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        //check if woocommerce exists
        if (!class_exists('Woocommerce')) { return; }
        $settings            = $this->get_settings();
        $unique_id = $this->get_id();

        // render template
        include WPC_CORE ."shortcodes/views/food-menu/food-list.php";
    }

    protected function get_menu_category() {
        return Wpc_Utilities::get_menu_category();
    }

}
