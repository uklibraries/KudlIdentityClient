<?php
/**
 * Kudl Identity Client
 *
 * @copyright 2015 Michael Slone <m.slone@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 * @package Omeka\Plugins\Kudl IdentityClient
 */

class KudlIdentityClientPlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = array(
        'install',
        'config_form',
        'config',
        'uninstall',
    );

    protected $_filters = array(
        'ensureCollectionIdentifier' => array('Save', 'Item', 'Item Type Metadata', 'Collection ARK Identifier'),
        'ensureSeriesIdentifier' => array('Save', 'Item', 'Item Type Metadata', 'Series ARK Identifier'),
        'ensureInterviewIdentifier' => array('Save', 'Item', 'Item Type Metadata', 'Interview ARK Identifier'),
    );

    public function hookInstall()
    {
        $config = parse_ini_file(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config.ini');
        set_option('kudl_identity_library_path', $config['kudl_identity_library_path']);
    }

    public function hookUninstall()
    {
        delete_option('kudl_identity_library_path');
    }

    public function hookConfig($args)
    {
        set_option('kudl_identity_library_path', trim($args['post']['kudl_identity_library_path']));
    }

    public function hookConfigForm()
    {
        require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config_form.php';
    }

    public function ensureIdentifier($text, $args)
    {
        if ($text === "") {
            define('DS', DIRECTORY_SEPARATOR);
            $path = get_option('kudl_identity_library_path');
            require_once($path . DS . 'lib' . DS . 'Minter.php');
            $minter = new Minter($path . DS . 'config' . DS . 'connection.ini');
            return $minter->mint();
        }
        else {
            return $text;
        }
    }

    public function ensureCollectionIdentifier($text, $args)
    {
        return $this->ensureIdentifier($text, $args);
    }

    public function ensureSeriesIdentifier($text, $args)
    {
        return $this->ensureIdentifier($text, $args);
    }

    public function ensureInterviewIdentifier($text, $args)
    {
        return $this->ensureIdentifier($text, $args);
    }
}
