class ElementorCustomElement
{

	private static $instance = null;

	public static function get_instance()
	{
		if (!self::$instance)
			self::$instance = new self;
		return self::$instance;
	}

	public function init()
	{
		add_action('elementor/widgets/widgets_registered', array($this, 'widgets_registered'));
	}

	public function widgets_registered()
	{
 
      // We check if the Elementor plugin has been installed / activated.
		if (defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')) {
 
         // We look for any theme overrides for this custom Elementor element.
         // If no theme overrides are found we use the default one in this plugin.

			$widget_file = get_template_directory() . '/lib/custom-elementor-widget.php';
			$template_file = locate_template($widget_file);
			if (!$template_file || !is_readable($template_file)) {
				$template_file = get_template_directory() . '/lib/custom-elementor-widget.php';
			}
			if ($template_file && is_readable($template_file)) {
				require_once $template_file;
			}
		}
	}
}

ElementorCustomElement::get_instance()->init();
