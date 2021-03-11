<?php

namespace Elementor;

defined( "ABSPATH" ) || exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \WpCafe\Utils\Wpc_Utilities as Wpc_Utilities;

class Gloreya_Food_Menu_Tab extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'glorwya-menu-tab';
	}

	/**
	 * Retrieve the widget title.
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__('Gloryea Menu Tab', 'wpcafe-pro');
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
		// Start of event section 
		$this->start_controls_section(
			'section_tab',
			[
				'label' => esc_html__('WPC Menu Tab Pro', 'gloreya'),
			]
		);

		$this->add_control(
			'food_tab_menu_style',
			[
				'label' => esc_html__('Menu tab Style', 'gloreya'),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => esc_html__('Menu Style 1', 'gloreya'),
				],
			]
		);
		
		$this->add_control(
			'wpc_menu_col',
			[
				'label' => esc_html__('Menu Column', 'gloreya'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'12' => esc_html__('1', 'gloreya'),
					'6' => esc_html__('2', 'gloreya'),
					'4' => esc_html__('3', 'gloreya'),
					'3' => esc_html__('4', 'gloreya'),
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'post_cats', [
				'label' => esc_html__('Select Categories', 'gloreya'),
				'type'      => Controls_Manager::SELECT2,
				'options'   => $this->get_menu_category(),
				'label_block' => true,
				'multiple'  => true,
			]
		);
		$repeater->add_control(
			'tab_title', [
				'label'         => esc_html__('Tab title', 'gloreya'),
				'type'          => Controls_Manager::TEXT,
				'default'       => 'Add Label',
			]
		);

		$repeater->add_control(
			'label_icon', [
				'label' => esc_html__('Tab Category Icon', 'gloreya'),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);


		$this->add_control(
			'food_menu_tabs',
			[
				'label' => esc_html__('Tabs', 'gloreya'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tab_title' =>esc_html__('Add Label', 'gloreya'),
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);
		
		$this->add_control(
			'wpc_menu_count',
			[
				'label'         => esc_html__('Menu count', 'gloreya'),
				'type'          => Controls_Manager::NUMBER,
				'default'       => '6',
			]
		);
		$this->add_control(
			'wpc_menu_order',
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
			'wpc_show_desc',
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
			'wpc_desc_limit',
			[
				'label'         => esc_html__('Description Limit', 'gloreya'),
				'type'          => Controls_Manager::NUMBER,
				'default'       => '15',
				'condition' => ['wpc_show_desc' => 'yes']
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
			'wpc_delivery_time_show',
			[
				'label' => esc_html__('Show Preparing and Delivery Time', 'gloreya'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'gloreya'),
				'label_off' => esc_html__('Hide', 'gloreya'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'wpc_search_show',
			[
				'label' => esc_html__('Show Search', 'gloreya'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'gloreya'),
				'label_off' => esc_html__('Hide', 'gloreya'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'wpc_cart_button_show',
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
			'wpc_btn_text',
			[
				'label' => esc_html__('Button Text', 'gloreya'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => ['wpc_cart_button_show' => 'yes']
			]
		);
		$this->add_control(
			'customize_btn',
			[
				'label' => esc_html__('Button Text For Variable Product', 'gloreya'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'condition' => ['wpc_cart_button_show' => 'yes']
			]
		);

		
		$this->end_controls_section();


		// Start of nav section 
		$this->start_controls_section(
			'nav_style',
			[
				'label' => esc_html__('Nav style', 'gloreya'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'nav_align',
			[
				'label'			 => esc_html__('Alignment', 'gloreya'),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [

					'left'		 => [
						'title'	 => esc_html__('Left', 'gloreya'),
						'icon'	 => 'fa fa-align-left',
					],
					'center'	 => [
						'title'	 => esc_html__('Center', 'gloreya'),
						'icon'	 => 'fa fa-align-center',
					],
					'right'		 => [
						'title'	 => esc_html__('Right', 'gloreya'),
						'icon'	 => 'fa fa-align-right',
					],
					'justify'	 => [
						'title'	 => esc_html__('Justified', 'gloreya'),
						'icon'	 => 'fa fa-align-justify',
					],
				],
				'default'		 => 'center',
				'selectors' => [
					'{{WRAPPER}}  .wpc-nav' => 'text-align: {{VALUE}};',
				],
			]
		); //Responsive control end

		$this->add_control(
			'wpc_nav_position',
			[
				'label' => esc_html__('Nav Position', 'gloreya'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'top',
				'options' => [
					'left' => esc_html__('Left', 'gloreya'),
					'right' => esc_html__('Right', 'gloreya'),
					'top' => esc_html__('Top', 'gloreya'),
				],
			]
		);

		//control for nav typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'         => 'wpc_nav_typography',
				'label'         => esc_html__('Nav Title Typography', 'gloreya'),
				'selector'     => '{{WRAPPER}} .wpc-nav li a',
			]
		);

		//start of nav color tabs (normal and hover)
		$this->start_controls_tabs(
			'wpc_nav_tabs'
		);

		//start of nav normal color tab
		$this->start_controls_tab(
			'wpc_nav_normal_tab',
			[
				'label' => esc_html__('Normal', 'gloreya'),
			]
		);


		$this->add_control(
			'wpc_nav_color',
			[
				'label'         => esc_html__('Nav Title Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wpc-nav li a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'wpc_label_icon_color',
			[
				'label' => esc_html__('Nav Icon Color', 'gloreya'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpc-nav li a i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpc-nav li a > svg path' => 'fill: {{VALUE}}; stroke: {{VALUE}};'
				],

			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'nav_background_normal',
				'label' => esc_html__('Background', 'gloreya'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .wpc-nav li a',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'nav_border',
				'label' => esc_html__('Border', 'gloreya'),
				'selector' => '{{WRAPPER}} .wpc-nav li a',
			]
		);

		$this->end_controls_tab();
		//end of nav normal color tab

		//start of nav active color tab
		$this->start_controls_tab(
			'wpc_nav_active_tab',
			[
				'label' => esc_html__('Active', 'gloreya'),
			]
		);
		$this->add_control(
			'wpc_nav_active_color',
			[
				'label'         => esc_html__('Nav active color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wpc-nav li a.wpc-active' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpc-nav li a:after' => 'border-color: {{VALUE}} transparent transparent transparent;',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'nav_background_active',
				'label' => esc_html__('Background color', 'gloreya'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .wpc-nav li a.wpc-active',
			]
		);

		$this->add_control(
			'wpc_label_icon_active_color',
			[
				'label' => esc_html__('Nav Icon Active Color', 'gloreya'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpc-nav li a.wpc-active i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpc-nav li a.wpc-active > svg path' => 'fill: {{VALUE}}; stroke: {{VALUE}};'
				],

			]
		);


		$this->add_control(
			'wpc_nav_angle_active_color',
			[
				'label'         => esc_html__('Nav Angle Active color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wpc-nav li a:after' => 'border-color: {{VALUE}}  transparent transparent transparent;',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'nav_border_active',
				'label' => esc_html__('Border active', 'gloreya'),
				'selector' => '{{WRAPPER}} .wpc-nav li a.wpc-active',
			]
		);
		$this->end_controls_tab();
		//end of nav hover color tab

		$this->end_controls_tabs();
		//end of nav color tabs (normal and hover)


		$this->add_responsive_control(
			'wpc_menu_item_label_paddding',
			[
				'label' => esc_html__('Padding', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpc-nav li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'wpc_menu_item_label_margin',
			[
				'label' => esc_html__('Nav Margin', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpc-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'wpc_tab_devider',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__('Nav Icon', 'gloreya'),
				'separator' => 'before',

			]
		);


		//control for nav typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'         => 'wpc_nav_icon_typography',
				'label'         => esc_html__('Nav Icon Typography', 'gloreya'),
				'selector'     => '{{WRAPPER}} .wpc-nav li a i',
			]
		);
		$this->add_responsive_control(
			'nav_icon_width',
			[
				'label' => esc_html__('Icon Width', 'gloreya'),
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
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .wpc-nav li a > svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'nav_icon_height',
			[
				'label' => esc_html__('Icon Height', 'gloreya'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .wpc-nav li a > svg' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End of nav section 

		// item cart button style section 
		$this->start_controls_section(
			'item_pro_thumbanil_style',
			[
				'label' => esc_html__('Thumbnail Style', 'gloreya'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => ['food_tab_menu_style' => ['style-3','style-4']]

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
					'{{WRAPPER}} .wpc-food-menu-item .wpc-food-menu-thumb' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .wpc-food-menu-item .wpc-food-menu-thumb' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpc-food-menu-item .wpc-food-menu-thumb.wpc-post-bg-img' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'wpc_pro_thum_border_radius',
			[
				'label' => esc_html__('Border Radius', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpc-food-menu-item .wpc-food-menu-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'condition' => ['wpc_cart_button_show' => 'yes']
			]
		);
		$this->add_control(
			'wpc_pro_cart_color',
			[
				'label'         => esc_html__('Cart Button Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wpc-food-menu-item .wpc-add-to-cart a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'wpc_pro_cart_button_bg_color',
			[
				'label'         => esc_html__('Cart Button BG Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wpc-food-menu-item .wpc-add-to-cart a' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'         => 'wpc_pro_cart_button_typo',
				'label'         => esc_html__('Typography', 'gloreya'),
				'selector'     => '{{WRAPPER}} .wpc-food-menu-item .wpc-add-to-cart a',
			]
		);
		$this->add_responsive_control(
			'wpc_pro_cart_btn_width',
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
					'{{WRAPPER}} .wpc-food-menu-item .wpc-add-to-cart a' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'wpc_pro_cart_btn_height',
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
					'{{WRAPPER}} .wpc-food-menu-item .wpc-add-to-cart a' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'wpc_pro_cart_btn_paddding',
			[
				'label' => esc_html__('Padding', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpc-food-menu-item .wpc-add-to-cart a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'wpc_pro_cart_btn_border_raidus',
			[
				'label' => esc_html__('Border Radius', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpc-food-menu-item .wpc-add-to-cart a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'wpc_pro_cart_btn_position_rtl',
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
					'{{WRAPPER}} .wpc-food-menu-item .wpc-add-to-cart' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'wpc_pro_cart_btn_position_ttb',
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
					'{{WRAPPER}} .wpc-food-menu-item .wpc-add-to-cart' => 'bottom: {{SIZE}}{{UNIT}};',
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
			'wpc_menu_item_status_color',
			[
				'label'         => esc_html__('Item Status Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wpc-menu-tag li' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'wpc_menu_item_status_bg_color',
			[
				'label'         => esc_html__('Item Status BG Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wpc-menu-tag li' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'         => 'wpc_menu_status_typo',
				'label'         => esc_html__('Typography', 'gloreya'),
				'selector'     => '{{WRAPPER}} .wpc-menu-tag li',
			]
		);
		$this->add_responsive_control(
			'wpc_menu_item_status_paddding',
			[
				'label' => esc_html__('Padding', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpc-menu-tag li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'wpc_item_status_border_radius',
			[
				'label' => esc_html__('Border Radius', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpc-menu-tag li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'wpc_menu_title_color',
			[
				'label'         => esc_html__('Title Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wpc-post-title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'wpc_menu_title_hover_color',
			[
				'label'         => esc_html__('Title Hover Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wpc-post-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wpc_menu_title_border_color',
			[
				'label'         => esc_html__('Title Border Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'condition' => ['food_tab_menu_style' => 'style-3'],
				'selectors'     => [
					'{{WRAPPER}} .wpc-post-title.wpc-title-with-border .wpc-title-border' => 'background-image:radial-gradient(circle, {{VALUE}}, {{VALUE}} 10%, transparent 50%, transparent);',
				],
			]
		);
		//control for title typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'         => 'wpc_menu_title',
				'label'         => esc_html__('Title Typography', 'gloreya'),
				'selector'     => '{{WRAPPER}} .wpc-post-title',
			]
		);
		$this->add_responsive_control(
			'wpc_title_margin',
			[
				'label' => esc_html__('Title Margin', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpc-post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'wpc_menu_price_color',
			[
				'label'         => esc_html__('Price Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wpc-menu-currency' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'wpc_menu_price_bg_color',
			[
				'label'         => esc_html__('Price background Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'condition' => ['food_tab_menu_style' => ['style-2', 'style-4']],
				'selectors'     => [
					'{{WRAPPER}} .wpc-price' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wpc-food-tab-style4.wpc-food-menu-item span.wpc-menu-currency, .wpc-slider-grid-3 span.wpc-menu-currency' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'wpc_price_padding',
			[
				'label' => esc_html__('Padding', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpc-menu-currency' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'wpc_price_border_radius',
			[
				'label' => esc_html__('Border Radius', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpc-menu-currency' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		//control for title typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'         => 'wpc_menu_price',
				'label'         => esc_html__('Price Typography', 'gloreya'),
				'selector'     => '{{WRAPPER}} .wpc-menu-currency',
			]
		);

		$this->end_controls_section();

		// description style section 
		$this->start_controls_section(
			'wpc_desc_style',
			[
				'label' => esc_html__('Description Style', 'gloreya'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => ['wpc_show_desc' => 'yes'],
			]
		);
		$this->add_control(
			'wpc_menu_desc_color',
			[
				'label'         => esc_html__('Description Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wpc-food-inner-content p' => 'color: {{VALUE}};',
				],
			]
		);

		//control for title typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'         => 'wpc_menu_desc',
				'label'         => esc_html__('Description Typography', 'gloreya'),
				'selector'     => '{{WRAPPER}} .wpc-food-inner-content p',
			]
		);

		$this->add_responsive_control(
			'wpc_desc_padding',
			[
				'label' => esc_html__('Description Padding', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpc-food-inner-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'wpc_desc_margin',
			[
				'label' => esc_html__('Description Margin', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpc-food-inner-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// search field
		$this->start_controls_section(
			'wpc_search_field_style',
			[
				'label' => esc_html__('Search Field Style', 'gloreya'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => ['wpc_search_show'=> 'yes'],
			]
		);
		$this->add_responsive_control(
			'search_alignment',
			[
				'label' => __( 'Alignment', 'gloreya' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'gloreya' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'gloreya' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'gloreya' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
			
			]
		);

		$this->end_controls_section();


		// advance style section 
		$this->start_controls_section(
			'wpc_advance_style',
			[
				'label' => esc_html__('Advance Style', 'gloreya'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'wpc_box_margin',
			[
				'label' => esc_html__('Margin', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpc-food-menu-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'wpc_box_padding',
			[
				'label' => esc_html__('Padding', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpc-food-menu-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wpc-tab-grid .wpc-food-inner-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__('Box Shadow', 'gloreya'),
				'selector' => '{{WRAPPER}} .wpc-food-menu-item',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'wpc_menu_item_border',
				'label' => esc_html__('Border', 'gloreya'),
				'selector' => '{{WRAPPER}} .wpc-food-menu-item',
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		//check if woocommerce exists
		if (!class_exists('Woocommerce')) { return; }
		$settings   			= $this->get_settings();
		$style      			= $settings["food_tab_menu_style"];
		$food_menu_tabs      	= $settings["food_menu_tabs"];
		$show_item_status      	= $settings["show_item_status"];
		$show_thumbnail      	= $settings["show_thumbnail"];
		$wpc_cart_button      	= $settings["wpc_cart_button_show"];
		$title_link_show      	= $settings["title_link_show"];
		$wpc_btn_text      		= $settings["wpc_btn_text"];
		$wpc_desc_limit      	= $settings["wpc_desc_limit"];
		$customize_btn      	= $settings["customize_btn"];
		$show_thumbnail      	= $settings["show_thumbnail"];
		$wpc_menu_count      	= $settings["wpc_menu_count"];
		$wpc_menu_order      	= $settings["wpc_menu_order"];
		$wpc_menu_col       	= $settings["wpc_menu_col"];
		$wpc_show_desc      	= $settings["wpc_show_desc"];
		$wpc_nav_position 		= $settings["wpc_nav_position"];

	
		$wpc_standard_discount = \WpCafe\Core\Base\Wpc_Settings_Field::instance()->get_settings_option();
		$wpc_pro_standarad_off   = isset($wpc_standard_discount['wpc_pro_discount_standarad_off_message'])  ? sanitize_text_field($wpc_standard_discount['wpc_pro_discount_standarad_off_message']) : '';
		if ($wpc_pro_standarad_off !== '') {
		?>
			<div class="wpc_pro_standard_offer_message"><?php echo esc_html($wpc_pro_standarad_off); ?></div>
		<?php
		}
		$unique_id = $this->get_id();
		
		?>
		<div class="wpc-food-tab-wrapper  wpc-nav-shortcode  main_wrapper_<?php echo esc_html($unique_id)?> nav-position-<?php echo esc_attr($wpc_nav_position); ?>">
	
			<ul class="wpc-nav">
				<?php
				foreach ($food_menu_tabs as $tab_key => $value) {
					$active_class = (($tab_key == 0) ? 'wpc-active' : ' ');
					?>
					<li>
						<a href='#' class='wpc-tab-a <?php echo esc_attr($active_class); ?>' data-id='tab<?php echo esc_attr($this->get_id()) . "-" . $value['_id']; ?>'
						data-cat_id='<?php echo isset($value['post_cats'][0] ) ? intval( $value['post_cats'][0] ) : 0 ; ?>'>
							<?php \Elementor\Icons_Manager::render_icon($value['label_icon'], ['aria-hidden' => 'true']);
							?>

							<span><?php echo esc_html($value['tab_title']); ?></span>
						</a>
					</li>
				<?php
				}
				?>
			</ul>
			<div class="wpc-tab-content wpc-widget-wrapper">
				<?php
				foreach ($food_menu_tabs as $content_key => $value) {
					$active_class = (($content_key == 0) ? 'tab-active' : ' ');
					$cat_id = isset($value['post_cats'][0] ) ? intval( $value['post_cats'][0] ) : 0 ;
				?>
					<div class='wpc-tab <?php echo esc_attr($active_class); ?>' data-id='tab<?php echo esc_attr($this->get_id()) . "-" . $value['_id']; ?>'
					data-cat_id='<?php echo esc_attr( $cat_id ) ; ?>'>
						<div class="tab_template_<?php echo esc_attr( $cat_id.'_'.$unique_id ) ; ?>"></div>
                        <div class="template_data_<?php echo esc_attr( $cat_id.'_'.$unique_id ) ; ?>">
						<?php
						$products = Wpc_Utilities::product_query( "product", $wpc_menu_count , $value['post_cats'] , $wpc_menu_order );
				 			include GLOREYA_EDITOR_ELEMENTOR . "/widgets/style/food-menu-tab/{$style}.php"; 

						?>
                        </div>

					</div><!-- Tab pane 1 end -->
				<?php } ?>
			</div><!-- Tab content-->
		</div>
		<?php
	}

	protected function get_menu_category() {
		return Wpc_Utilities::get_menu_category();
	}
}
