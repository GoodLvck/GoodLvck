<?php
/**
 * @package Nicepage Website Builder
 * @author Nicepage https://www.nicepage.com
 * @copyright Copyright (c) 2016 - 2019 Nicepage
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
defined('JPATH_BASE') or die();

/**
 * Class NicepageInstallerEvents
 */
class NicepageInstallerEvents extends JPlugin
{
    /**
     * Status type
     */
    const STATUS_ERROR     = 'error';

    /**
     * Status type
     */
    const STATUS_INSTALLED = 'installed';

    /**
     * Status type
     */
    const STATUS_UPDATED   = 'updated';

    /**
     * Messages list
     *
     * @var array
     */
    protected static $messages = array();

    /**
     * Top level installer
     *
     * @var
     */
    protected $toplevel_installer;

    /**
     * Set top installer
     *
     * @param object $installer Installer object
     */
    public function setTopInstaller($installer)
    {
        $this->toplevel_installer = $installer;
    }

    /**
     * NicepageInstallerEvents constructor.
     *
     * @param object $subject Subject
     * @param array  $config  Config
     */
    public function __construct(&$subject, $config = array())
    {
        parent::__construct($subject, $config);

        jimport('joomla.filesystem.file');
        jimport('joomla.filesystem.folder');

        $install_html_file = dirname(__FILE__) . '/../install.html';
        $install_css_file  = dirname(__FILE__) . '/../install.css';
        $tmp_path          = JPATH_ROOT . '/tmp';

        if (JFolder::exists($tmp_path)) {
            // Copy install.css to tmp dir for inclusion
            JFile::copy($install_css_file, $tmp_path . '/install.css');
            JFile::copy($install_html_file, $tmp_path . '/install.html');
        }
    }

    /**
     * Add message to list
     *
     * @param array  $package Package
     * @param string $status  Status value
     * @param string $message Text message
     */
    public static function addMessage($package, $status, $message = '')
    {
        self::$messages[] = call_user_func_array(array('NicepageInstallerEvents', $status), array($package, $message));
    }

    /**
     * Load custom css
     *
     * @return string
     */
    protected static function loadCss()
    {
        jimport('joomla.filesystem.file');
        jimport('joomla.filesystem.folder');
        $buffer            = '';

        // Drop out Style
        if (file_exists(JPATH_ROOT . '/tmp/install.html')) {
            $buffer .= JFile::read(JPATH_ROOT . '/tmp/install.html');
        }

        return $buffer;
    }

    /**
     * Get error html content
     *
     * @param array  $package Package
     * @param string $msg     Message text
     *
     * @return string
     */
    public static function error($package, $msg)
    {
        ob_start();
        ?>
    <li class="nicepageinstall-failure">
        <span class="nicepageinstall-icon"><span></span></span>
        <span class="nicepageinstall-row"><?php echo ucfirst(trim($package['name'] . ' installation failed'));?></span>
        <span class="nicepageinstall-errormsg">
            <?php echo $msg; ?>
        </span>
    </li>
    <?php
        $out = ob_get_clean();

        return $out;
    }

    /**
     * Get installed html page
     *
     * @param array $package Package
     *
     * @return string
     */
    public static function installed($package)
    {
        ob_start();
        ?>
    <li class="nicepageinstall-success">
        <span class="nicepageinstall-icon"><span></span></span>
        <span class="nicepageinstall-row"><?php echo ucfirst(trim($package['name']. ' installation was successful'));?></span></li>
    <?php
        $out = ob_get_clean();

        return $out;
    }

    /**
     * Get updated html page
     *
     * @param array $package Package
     *
     * @return string
     */
    public static function updated($package)
    {
        ob_start();
        ?>
    <li class="nicepageinstall-update">
        <span class="nicepageinstall-icon"><span></span></span>
        <span class="nicepageinstall-row"><?php echo ucfirst(trim($package['name'] . ' update was successful'));?></span>
    </li>
    <?php
        $out = ob_get_clean();

        return $out;
    }

    /**
     * On extension after install
     *
     * @param object $installer Installer object
     * @param int    $eid       Id
     */
    public function onExtensionAfterInstall($installer, $eid)
    {
        $lang = JFactory::getLanguage();
        $lang->load('install_override', dirname(__FILE__), $lang->getTag(), true);
        $this->toplevel_installer->set('extension_message', $this->getMessages());
    }

    /**
     * On extension after update
     *
     * @param object $installer Installer object
     * @param int    $eid       Id
     */
    public function onExtensionAfterUpdate($installer, $eid)
    {
        $lang = JFactory::getLanguage();
        $lang->load('install_override', dirname(__FILE__), $lang->getTag(), true);
        $this->toplevel_installer->set('extension_message', $this->getMessages());
    }

    /**
     * Get messages html content
     *
     * @return string
     */
    protected function getMessages()
    {
        $buffer = '';
        $buffer .= self::loadCss();
        $buffer .= '<div id="nicepageinstall"><ul id="nicepageinstall-status">';
        $buffer .= implode('', self::$messages);
        $buffer .= '</ul>';
        $buffer .= '</div>';

        return $buffer;
    }
}
