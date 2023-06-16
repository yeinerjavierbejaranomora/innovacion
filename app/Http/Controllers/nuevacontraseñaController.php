namespace App\Http\Controllers;

use Illuminate\Http\Request;

class nuevacontraseñaController extends Controller
{
    public function index() {
        return view('nuevaContraseña.index');
    }
}