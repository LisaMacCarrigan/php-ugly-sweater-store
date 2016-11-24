require_once "scssphp/scss.inc.php";

use Leafo\ScssPhp\Server;

$directory = "stylesheets";

Server::serveFrom($directory);
