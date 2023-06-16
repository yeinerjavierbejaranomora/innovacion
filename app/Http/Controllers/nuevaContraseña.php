namespace App\Http\Controllers;

use Illuminate\Http\Request;

class nuevacontraseñaController extends Controller
{
    public function index() {
        /*$roles = DB::table('roles')->get();
        var_dump($roles);*/
        return view('nuevaContraseña.index');
    }
}