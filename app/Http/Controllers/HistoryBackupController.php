<?php
namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;

use App\Model\HistoryBackup as Hbkp;

class HistoryBackupController extends Controller
{
    /**
     * PArsed File, get info backpus BD.
     *
     * @return Response
     */
     
    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}
	
    public function index()
    {
    	
		
        $urlupload = 'dbadmins.sqlserver.store';
        #$carteras  = Carteras::orderBy('created_at', 'DESC') ->groupBy('finanzas_cartera') -> paginate();
        #$backups = new Hbkp();
        $rows = Hbkp::TipoBD() -> paginate(); 

        return view('historybackup.index', compact('urlupload', 'rows' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
    	try{
            $i =0;
    		Log::info(print_r("Start store ".dirname(__FILE__),TRUE));
			$backups = new Hbkp();
			$file =  $backups -> cargarContenido($request);

            Log::debug($request->url());
            $type_db = array_reverse(explode('/',$request->url()))[0];
            $backups -> analyzeFormat($file, $type_db);
            Log::info(print_r($type_db,TRUE));
            Log::info(print_r($file->getClientOriginalName(),TRUE));
            $dateFromFileName = $backups -> getDateFromFile($type_db, $file->getClientOriginalName());
			try{
				foreach ($backups -> getMatrizRespaldos() as $nameCliet => $values) {
                    foreach ($values as $key => $value) {
                        $backup = new Hbkp();
						$backup -> parser ($nameCliet, $value, $type_db,$dateFromFileName);
						Log::info(print_r("start save ".$i++." ".dirname(__FILE__),TRUE));
						$backup -> save();	
					 	unset($backup);
					}
					
				}
			} catch (\Exception $e) {
				Log::debug(print_r("Store => ". $e -> getMessage()." ". dirname(__FILE__),TRUE));
			}
			
			Log::info(print_r("Finalizando storage ".__FILE__,TRUE));
            $notices = array("se inserto la informacion de forma correcta", "test");
            return \Redirect::route('api.dbadmins.respaldos.uploads.index') -> with ('notices',$notices);;
			#return "exito";	
    	} catch (\Exception $e) {
    		Log::info(print_r("Finalizando storage Error ".$e -> getMessage()." ".__FILE__,TRUE));
    		return "Fallo ".$e -> getMessage() ;
    	}
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
