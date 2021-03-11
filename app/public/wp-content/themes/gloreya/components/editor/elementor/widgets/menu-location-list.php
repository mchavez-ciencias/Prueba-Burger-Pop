<?php

namespace Elementor;

defined("ABSPATH") || exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \WpCafe\Utils\Wpc_Utilities as Wpc_Utilities;
// use WpCafe_Pro\Utils\Utilities as Pro_Utilities;


class Gloreya_Menu_Location_List extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'gloreya-location-list';
	}

	/**
	 * Retrieve the widget title.
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('GLOREYA Location List', 'gloreya');
	}

	/**
	 * Retrieve the widget icon.
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-menu-card wpc-widget-icon';
	}

	/**
	 * Retrieve the widget category.
	 * @return string Widget category.
	 */
	public function get_categories()
	{
		return ['wpcafe-menu'];
	}

	protected function _register_controls()
	{
		// Start of event section 
		$this->start_controls_section(
			'section_tab',
			[
				'label' => esc_html__('Location List', 'gloreya'),
			]
		);

		$this->add_control(
			'food_cat_style',
			[
				'label' => esc_html__('Location Style', 'gloreya'),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => esc_html__('Style 1', 'gloreya'),
				],
			]
		);
		$this->add_control(
			'wpc_menu_col',
			[
				'label' => esc_html__('Column', 'gloreya'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'12' => esc_html__('1', 'gloreya'),
					'6' => esc_html__('2', 'gloreya'),
					'4' => esc_html__('3', 'gloreya'),
					'3' => esc_html__('4', 'gloreya'),
					'2' => esc_html__('6', 'gloreya'),
				],
			]
		);

		$this->add_control(
			'location_limit',
			[
				'label' 		=> esc_html__('Location Limit', 'gloreya'),
				'description'	=> esc_html__('Limit works when food location is not selected', 'gloreya'),
				'type' 			=> Controls_Manager::NUMBER,
				'default' 		=> '20',

			]
		);
		$this->add_control(
			'wpc_menu_cat',
			[
				'label' => esc_html__('Location', 'gloreya'),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_menu_location(),
				'multiple' => true,
			]
		);
		$this->add_control(
			'hide_empty',
			[
				'label'     	=> esc_html__('Hide Empty?', 'gloreya'),
				'description'	=> esc_html__('Hide empty works when food location is not selected', 'gloreya'),
				'type'      	=> Controls_Manager::SWITCHER,
				'default'   	=> '',
			]
		);
		$this->add_control(
			'show_count',
			[
				'label' => esc_html__('Show Count', 'gloreya'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'gloreya'),
				'label_off' => esc_html__('Hide', 'gloreya'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__('Title Style', 'gloreya'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'titlte_color',
			[
				'label'         => esc_html__('Title Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wpc-category-title a' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'titlte_bg_color',
			[
				'label'         => esc_html__('Title BG Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wpc-category-title a' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'         => 'title_typo',
				'label'         => esc_html__('Typography', 'gloreya'),
				'selector'     => '{{WRAPPER}} .wpc-category-title',
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Padding', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpc-category-title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'readmore_btn_style',
			[
				'label' => esc_html__('Button Style', 'gloreya'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => ['food_cat_style' => 'style-4']
			]
		);
		$this->add_control(
			'btn_color',
			[
				'label'         => esc_html__('Button Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wpc-readmore-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_hover_color',
			[
				'label'         => esc_html__('Button Hover Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wpc-single-cat-item:hover .wpc-readmore-link' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'btn_bg_color',
			[
				'label'         => esc_html__('Button BG Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wpc-readmore-link' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_bg_hover_color',
			[
				'label'         => esc_html__('Button BG Hover Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wpc-single-cat-item:hover .wpc-readmore-link' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'         => 'btn_typo',
				'label'         => esc_html__('Typography', 'gloreya'),
				'selector'     => '{{WRAPPER}} .wpc-readmore-link',
			]
		);
		$this->add_responsive_control(
			'btn_width',
			[
				'label' => __('Width', 'gloreya'),
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
					'{{WRAPPER}} .wpc-readmore-link' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_height',
			[
				'label' => __('Height', 'gloreya'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .wpc-readmore-link' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'thumbnail_style',
			[
				'label' => esc_html__('Thumbnail Style', 'gloreya'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'img_width',
			[
				'label' => __('Width', 'gloreya'),
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
					'{{WRAPPER}} .wpc-cat-thumb' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'img_height',
			[
				'label' => __('Height', 'gloreya'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .wpc-cat-thumb' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'advance_style',
			[
				'label' => esc_html__('Advance Style', 'gloreya'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'wpc_box_bg_color',
			[
				'label'         => esc_html__('Box Bacground Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wpc-location-list-style4 .wpc-single-cat-item' => 'background-color: {{VALUE}};',
				],
				'condition' => ['food_cat_style' => ['style-4']],
			]
		);
		$this->add_control(
			'wpc_box_bg_hover_color',
			[
				'label'         => esc_html__('Box Hover Bacground Color', 'gloreya'),
				'type'         => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wpc-location-list-style4 .wpc-single-cat-item:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => ['food_cat_style' => ['style-4']],
			]
		);

		$this->add_responsive_control(
			'box_border_radius',
			[
				'label' => esc_html__('Border Radius', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpc-single-cat-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_margin',
			[
				'label' => esc_html__('Margin', 'gloreya'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpc-single-cat-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}


	protected function render()
	{
		$settings   		 = $this->get_settings();
		$style      		 = $settings["food_cat_style"];
		$grid_column         = $settings['wpc_menu_col'];
		$categories_id       = $settings['wpc_menu_cat'];
		$hide_empty          = $settings['hide_empty'] == 'yes' ? true : false;
		$show_count          = $settings['show_count'];
		$location_limit      = $settings['location_limit'];

		$taxonomy = 'wpcafe_location';
		if (is_array($categories_id) && isset($categories_id[0]) && $categories_id[0] !== "" && count($categories_id) > 0) {
			$cats = $categories_id;
		} else {
			$cats = $this->get_all_cat_by_texonomy($taxonomy, $location_limit, $hide_empty);
		}
		?>
		<div class="wpc-menu-location-wrap wpc-location-list-<?php echo esc_attr($style); ?>">
			<?php include GLOREYA_EDITOR_ELEMENTOR . "/widgets/style/food-menu-location-style/{$style}.php"; ?>
		</div>
		<?php

	}

	function get_all_cat_by_texonomy($taxonomy, $limit, $hide_empty)
	{
		$args = array(
			'taxonomy'      => $taxonomy,
			'number'        => $limit,
			'hide_empty'    => $hide_empty,
		);

		return get_categories($args);
	}

	// menu location
	public static function get_menu_location($id = null)
	{
		$menu_category = [];
		try {

			if (is_null($id)) {
				$terms = get_terms([
					'taxonomy'   => 'wpcafe_location',
					'hide_empty' => false,
				]);

				foreach ($terms as $cat) {
					$menu_category[$cat->term_id] = $cat->name;
				}

				return $menu_category;
			} else {
				// return single menu
				return get_post($id);
			}
		} catch (\Exception $es) {
			return [];
		}
	}
}
