<?php

namespace Elementor;
use \WpCafe\Utils\Wpc_Utilities as Wpc_Utilities;

defined( "ABSPATH" ) || exit;

class Gloreya_food_menu_slider_Widget extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'gloreya-food-menu-slider-pro';
	}

	/**
	 * Retrieve the widget title.
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__('Gloreya Food Menu Slider', 'gloreya');
	}

	/**
	 * Retrieve the widget icon.
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-menu-card wpc-widget-icon';
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
				'label' => esc_html__('Gloreya Food Menu Slider', 'gloreya'),
			]
		);

		$this->add_control(
			'food_menu_style',
			[
				'label' => esc_html__('Menu Style', 'gloreya'),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => esc_html__('Menu Style 1', 'gloreya'),
				],
			]
		);

		$this->add_control(
			'gloreya_menu_cat',
			[
				'label' => esc_html__('Menu Category', 'gloreya'),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_menu_category(),
				'multiple' => true,
			]
		);
		$this->add_control(
			'gloreya_menu_count',
			[
				'label'         => esc_html__('Menu count', 'gloreya'),
				'type'          => Controls_Manager::NUMBER,
				'default'       => '6',
			]
		);
		$this->add_control(
			'gloreya_slider_count',
			[
				'label'         => esc_html__('Slider count', 'gloreya'),
				'type'          => Controls_Manager::NUMBER,
				'default'       => '6',
			]
		);
		$this->add_control(
			'show_item_status',
			[
				'label' => esc_html__('Show Item Status', 'gloreya'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'gloreya'),
				'label_off' => esc_html__('Hide', 'gloreya'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'gloreya_menu_order',
			[
				'label' => esc_html__('Menu Order', 'gloreya'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'ASC'  => esc_html__('ASC', 'gloreya'),
					'DESC' => esc_html__('DESC', 'gloreya'),
				],
			]
		);


		$this->add_control(
			'show_thumbnail',
			[
				'label' => esc_html__('Show Thumbnail', 'gloreya'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'gloreya'),
				'label_off' => esc_html__('Hide', 'gloreya'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);


		$this->add_control(
			'gloreya_show_desc',
			[
				'label' => esc_html__('Show Description', 'gloreya'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'gloreya'),
				'label_off' => esc_html__('Hide', 'gloreya'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'gloreya_desc_limit',
			[
				'label'         => esc_html__('Description Limit', 'gloreya'),
				'type'          => Controls_Manager::NUMBER,
				'default'       => '15',
				'condition' => ['gloreya_show_desc' => 'yes']
			]
		);
		$this->add_control(
			'title_link_show',
			[
				'label' => esc_html__('Use Title Link?', 'gloreya'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'gloreya'),
				'label_off' => esc_html__('Hide', 'gloreya'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'gloreya_cart_button_show',
			[
				'label' => esc_html__('Show Cart Button', 'gloreya'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'gloreya'),
				'label_off' => esc_html__('Hide', 'gloreya'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'gloreya_btn_text',
			[
				'label' => esc_html__('Button Text', 'gloreya'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => ['gloreya_cart_button_show' => 'yes']
			]
		);
		$this->add_control(
			'customize_btn',
			[
				'label' => esc_html__('Button Text For Variable Product', 'gloreya'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'condition' => ['gloreya_cart_button_show' => 'yes']
			]
		);


		$this->end_controls_section();


		// item cart button style section 
		$this->start_controls_section(
			'item_pro_thumbanil_style',
			[
				'label' => esc_html__('Thumbnail Style', 'gloreya'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => ['food_menu_style' => ['style-3']]

			]
		);
		$this->add_responsive_control(
			'thumbnail_width',
			[
				'label' => esc_html__('Width', 'gloreya'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .gloreya-food-menu-item .gloreya-food-menu-thumb.gloreya-post-bg-img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumbnail_height',
			[
				'label' => esc_html__('Height', 'gloreya'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .gloreya-food-menu-item .gloreya-food-menu-thumb.gloreya-post-bg-img' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'gloreya_pro_thum_border_radius',
			[
				'label' => esc_html__('Border Radius', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .gloreya-food-menu-item .gloreya-food-menu-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();



		// item slider nav style section 
		$this->start_controls_section(
			'gloreya_slider_style',
			[
				'label' => esc_html__('Slider Style', 'gloreya'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'gloreya_slider_nav_show',
			[
				'label' => esc_html__('Slider Nav Show', 'gloreya'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'gloreya'),
				'label_off' => esc_html__('Hide', 'gloreya'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'gloreya_slider_dot_show',
			[
				'label' => esc_html__('Slider dot Show', 'gloreya'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'gloreya'),
				'label_off' => esc_html__('Hide', 'gloreya'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'gloreya_slider_nav_bg_color',
			[
				'label'         => esc_html__('Slider Nav BG Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .gloreya-food-menu-slider .swiper-button-next, .gloreya-food-menu-slider .swiper-button-prev' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();


		// item status style section 
		$this->start_controls_section(
			'item_status_style',
			[
				'label' => esc_html__('Item Status Style', 'gloreya'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => ['show_item_status' => 'yes']
			]
		);
		$this->add_control(
			'gloreya_menu_item_status_color',
			[
				'label'         => esc_html__('Item Status Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .gloreya-menu-tag li' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'gloreya_menu_item_status_bg_color',
			[
				'label'         => esc_html__('Item Status BG Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .gloreya-menu-tag li' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'         => 'gloreya_menu_status_typo',
				'label'         => esc_html__('Typography', 'gloreya'),
				'selector'     => '{{WRAPPER}} .gloreya-menu-tag li',
			]
		);
		$this->add_responsive_control(
			'gloreya_menu_item_status_paddding',
			[
				'label' => esc_html__('Padding', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .gloreya-menu-tag li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'gloreya_item_status_border_radius',
			[
				'label' => esc_html__('Border Radius', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .gloreya-menu-tag li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		// title style section 
		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__('Title Style', 'gloreya'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'gloreya_menu_title_color',
			[
				'label'         => esc_html__('Title Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .gloreya-post-title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'gloreya_menu_title_hover_color',
			[
				'label'         => esc_html__('Title Hover Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .gloreya-post-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		//control for title typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'         => 'gloreya_menu_title',
				'label'         => esc_html__('Title Typography', 'gloreya'),
				'selector'     => '{{WRAPPER}} .gloreya-post-title',
			]
		);
		$this->add_responsive_control(
			'gloreya_title_margin',
			[
				'label' => esc_html__('Title Margin', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .gloreya-post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// item cart button style section 
		$this->start_controls_section(
			'item_pro_cart_button_style',
			[
				'label' => esc_html__('Cart Button Style', 'gloreya'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => ['gloreya_cart_button_show' => 'yes']
			]
		);
		$this->add_control(
			'gloreya_pro_cart_color',
			[
				'label'         => esc_html__('Cart Button Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .gloreya-food-menu-item .gloreya-add-to-cart a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'gloreya_pro_cart_button_bg_color',
			[
				'label'         => esc_html__('Cart Button BG Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .gloreya-food-menu-item .gloreya-add-to-cart a' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'         => 'gloreya_pro_cart_button_typo',
				'label'         => esc_html__('Typography', 'gloreya'),
				'selector'     => '{{WRAPPER}} .gloreya-food-menu-item .gloreya-add-to-cart a',
			]
		);
		$this->add_responsive_control(
			'gloreya_pro_cart_btn_width',
			[
				'label' => esc_html__('Width', 'gloreya'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 45,
				],
				'selectors' => [
					'{{WRAPPER}} .gloreya-food-menu-item .gloreya-add-to-cart a' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'gloreya_pro_cart_btn_height',
			[
				'label' => esc_html__('Height', 'gloreya'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 45,
				],
				'selectors' => [
					'{{WRAPPER}} .gloreya-food-menu-item .gloreya-add-to-cart a' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'gloreya_pro_cart_btn_paddding',
			[
				'label' => esc_html__('Padding', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .gloreya-food-menu-item .gloreya-add-to-cart a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'gloreya_pro_cart_btn_border_raidus',
			[
				'label' => esc_html__('Border Radius', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .gloreya-food-menu-item .gloreya-add-to-cart a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'gloreya_pro_cart_btn_position_rtl',
			[
				'label' => esc_html__('Button Right To Left', 'gloreya'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 500,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .gloreya-food-menu-item .gloreya-add-to-cart' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'gloreya_pro_cart_btn_position_ttb',
			[
				'label' => esc_html__('Button Bottom To Top', 'gloreya'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 500,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .gloreya-food-menu-item .gloreya-add-to-cart' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		// price style section 
		$this->start_controls_section(
			'price_style',
			[
				'label' => esc_html__('Price Style', 'gloreya'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'gloreya_menu_price_color',
			[
				'label'         => esc_html__('Price Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .gloreya-menu-currency' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'gloreya_menu_price_bg_color',
			[
				'label'         => esc_html__('Price BG Color', 'gloreya'),
				'type'          => Controls_Manager::COLOR,
				'condition'=> ['food_menu_style'=> ['style-2', 'style-3']],
				'selectors'     => [
					'{{WRAPPER}} .gloreya-food-menu-item .gloreya-price' => 'background: {{VALUE}};',
					'{{WRAPPER}} .gloreya-food-tab-style4.gloreya-food-menu-item span.gloreya-menu-currency, .gloreya-slider-grid-3.gloreya-food-menu-item span.gloreya-menu-currency' => 'background: {{VALUE}};',
				],
			]
		);

		//control for title typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'         => 'gloreya_menu_price',
				'label'         => esc_html__('Price Typography', 'gloreya'),
				'selector'     => '{{WRAPPER}} .gloreya-menu-currency',
			]
		);

		$this->end_controls_section();



		// description style section 
		$this->start_controls_section(
			'gloreya_desc_style',
			[
				'label' => esc_html__('Description Style', 'gloreya'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => ['gloreya_show_desc' => 'yes'],
			]
		);
		$this->add_control(
			'gloreya_menu_desc_color',
			[
				'label'         => esc_html__('Description Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .gloreya-food-inner-content p' => 'color: {{VALUE}};',
				],
			]
		);

		//control for title typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'         => 'gloreya_menu_desc',
				'label'         => esc_html__('Description Typography', 'gloreya'),
				'selector'     => '{{WRAPPER}} .gloreya-food-inner-content p',
			]
		);

		$this->add_responsive_control(
			'gloreya_desc_padding',
			[
				'label' => esc_html__('Description Padding', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .gloreya-food-inner-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'gloreya_desc_margin',
			[
				'label' => esc_html__('Description Margin', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .gloreya-food-inner-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// advance style section 
		$this->start_controls_section(
			'gloreya_advance_style',
			[
				'label' => esc_html__('Advance Style', 'gloreya'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'gloreya_box_margin',
			[
				'label' => esc_html__('Margin', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .gloreya-food-menu-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'gloreya_box_padding',
			[
				'label' => esc_html__('Padding', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .gloreya-food-slider1 .gloreya-food-inner-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .gloreya-tab-grid-style2 .gloreya-food-menu-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .gloreya-slider-grid-3 .gloreya-food-inner-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__('Box Shadow', 'gloreya'),
				'selector' => '{{WRAPPER}} .gloreya-food-menu-item',
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		$settings              = $this->get_settings();
		$style                 = $settings["food_menu_style"];
		$show_item_status      = $settings["show_item_status"];
		$gloreya_show_desc         = $settings["gloreya_show_desc"];
		$gloreya_desc_limit        = $settings["gloreya_desc_limit"];
		$title_link_show       = $settings["title_link_show"];
		$gloreya_cart_button       = $settings["gloreya_cart_button_show"];
		$gloreya_btn_text          = $settings["gloreya_btn_text"];
		$gloreya_menu_order        = $settings["gloreya_menu_order"];
		$show_thumbnail        = $settings["show_thumbnail"];
		$gloreya_slider_dot_show   = $settings["gloreya_slider_dot_show"];
		$gloreya_slider_nav_show   = $settings["gloreya_slider_nav_show"];
		$gloreya_slider_count      = $settings["gloreya_slider_count"];
		$customize_btn      		= $settings["customize_btn"];
		$gloreya_menu_cat      			= $settings["gloreya_menu_cat"];
		$gloreya_menu_count      		= $settings["gloreya_menu_count"];


		$gloreya_pro_standarad_off   = isset($gloreya_standard_discount['gloreya_pro_discount_standarad_off_message'])  ? sanitize_text_field($gloreya_standard_discount['gloreya_pro_discount_standarad_off_message']) : '';
		?>
		<div class="gloreya-food-wrapper">
			<?php
			if ($gloreya_pro_standarad_off !== '') {
			?>
				<div class="gloreya_pro_standard_offer_message"><?php echo esc_html($gloreya_pro_standarad_off); ?></div>
			<?php
			}
			$unique_id = $this->get_id();

			$products = Wpc_Utilities::product_query( "product", $gloreya_menu_count , $settings['gloreya_menu_cat'] , $gloreya_menu_order );
			include  GLOREYA_EDITOR_ELEMENTOR . "/widgets/style/food-menu-slider/{$style}.php";

			?>
		</div>
		<?php
	}

	protected function get_menu_category() {
		return Wpc_Utilities::get_menu_category();
	}


}
