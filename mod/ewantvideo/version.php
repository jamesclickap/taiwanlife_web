<?php

/**
 * Defines the version of ewantvideo.
 *
 * This code fragment is called by moodle_needs_upgrading() and
 * /admin/index.php.
 *
 * @package    mod_ewantvideo
 * @copyright  2013 Jonas Nockert <jonasnockert@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// TODO $module is deprecated for 2.7 and should be replaced with $plugin.
// However, Moodle 2.4 still requires $module and it would not make sense
// to break compatibility (yet).
$module->version  = 2016063001;
$module->requires = 2012120300;
$module->cron     = 0;
$module->component = 'mod_ewantvideo';
$module->maturity = MATURITY_STABLE;
$module->release  = '2.5';
