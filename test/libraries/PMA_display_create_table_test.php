<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * tests for display_create_table.lib.php
 *
 * @package PhpMyAdmin-test
 */

use PMA\libraries\Theme;
use PMA\libraries\URL;

$GLOBALS['server'] = 0;
$GLOBALS['cfg']['Server']['DisableIS'] = false;
$GLOBALS['cfg']['DBG']['sql'] = false;
/*
 * Include to test.
 */

require_once 'libraries/database_interface.inc.php';
require_once 'libraries/display_create_table.lib.php';

/**
 * class PMA_DisplayCreateTable_Test
 *
 * this class is for testing display_create_table.lib.php functions
 *
 * @package PhpMyAdmin-test
 */
class PMA_DisplayCreateTable_Test extends PHPUnit_Framework_TestCase
{
    /**
     * Test for setUp
     *
     * @return void
     */
    public function setUp()
    {
        //$GLOBALS
        $GLOBALS['server'] = 0;
        $GLOBALS['cfg']['MaxRows'] = 10;
        $GLOBALS['cfg']['ServerDefault'] = "PMA_server";
        $GLOBALS['cfg']['TableNavigationLinksMode'] = 'icons';
        $GLOBALS['cfg']['LimitChars'] = 100;
        $GLOBALS['cfg']['ActionLinksMode'] = 'icons';
        $GLOBALS['cfg']['Server']['host'] = "localhost";
        $GLOBALS['cfg']['Server']['user'] = "pma_user";
        $GLOBALS['cfg']['ShowHint'] = true;
        $GLOBALS['cfg']['ActionLinksMode'] = 'icons';
        $GLOBALS['PMA_PHP_SELF'] = "server_privileges.php";

        //$_SESSION
        $_SESSION['relation'][$GLOBALS['server']] = "relation";
    }

    /**
     * Test for PMA_getHtmlForCreateTable
     *
     * @return void
     */
    public function testPMAGetHtmlForCreateTable()
    {
        $db = "pma_db";

        //Call the test function
        $html = PMA_getHtmlForCreateTable($db);

        //getImage
        $this->assertContains(
            PMA\libraries\Util::getImage('b_table_add.png'),
            $html
        );

        //__('Create table')
        $this->assertContains(
            __('Create table'),
            $html
        );

        //URL::getHiddenInputs
        $this->assertContains(
            URL::getHiddenInputs($db),
            $html
        );
        //label
        $this->assertContains(
            __('Name'),
            $html
        );
        $this->assertContains(
            __('Number of columns'),
            $html
        );

        //button
        $this->assertContains(
            __('Go'),
            $html
        );
    }
}
