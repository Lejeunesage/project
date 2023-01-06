<?php

namespace App\Controllers;

use \Core\View;

/**
 * Home controller
 * 
 * PHP version 5.4
 */
class ControllersGaleries extends \Core\Controller {
  /**
   * Show the index page
   * 
   * @return void
   */
  public function galeriesAction() {
    // echo "Hello from the index action in the Home controller";
    View::render("galeries/galeries.php");
  }

  /**
   * Show the add new page
   * 
   * @return void
   */
  public function addNewAction() {
    echo "Hello from the addNew action in the Home controller";
    // echo "<p>Query string parameters: <pre>" . 
    // htmlspecialchars(print_r($_GET, true)) . "</pre></p>";
  }

  /**
   * Before filter
   * 
   * @return void
   */
  protected function before() {
    // echo "(before)";
  }

  /**
   * After filter
   * 
   * @return void
   */
  protected function after() {
    // echo "(after)";
  }
}
