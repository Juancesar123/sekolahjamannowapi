<?php

namespace App\Containers\Sekolah\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Sekolah\Models\Sekolah;
use App\Containers\Sekolah\UI\API\Requests\CreateSekolahRequest;
use App\Containers\Sekolah\UI\API\Requests\DeleteSekolahRequest;
use App\Containers\Sekolah\UI\API\Requests\ListingSekolahRequest;
use App\Containers\Sekolah\UI\API\Requests\UpdateSekolahRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
/**
 * Class SekolahController
 *
 * @package App\Containers\Sekolah\UI\API\Controllers
 */
class SekolahController extends ApiController
{
    /**
     * @param CreateSekolahRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createSekolah(CreateSekolahRequest $request)
    {
        $fields = ['namasekolah'];

        $input = $request->input();


        $imageName = "fotosiswa/images".date("Y-m-d H:i:s").".jpeg";    
        Storage::disk('local')->put($imageName,$input["foto"]);
        $data = $request->sanitizeInput($fields);
        
            $sekolah = new Sekolah();
            $checkNamaSekolah = $sekolah->checkNamaSekolah($data["namasekolah"]);
            if($checkNamaSekolah > 0){
                return response()->json(["Message" => "Nama Sekolah yang anda masukkan sudah Tersedia", "Code" => 500]);
            }
        try{    
            $sekolah->namasekolah = $data['namasekolah'];
            $sekolah->alamat = $input["alamat"];
            $sekolah->foto = $imageName;
            $sekolah->save();
            return response()->json(["Message" => "Sekolah Sukses Di Masukkan", "Code" => 201]);
        }catch(QueryException $e){
            return response()->json(["Message" => "Sekolah Gagal Di Masukkan", "Code" => 500]);
        }

        
    }

    /**
     * @param FindSekolahByIdRequest $request
     * @return array
     */
    public function findSekolahById(/*FindSekolahByIdRequest $request*/)
    {
        /*$sekolah = Apiato::call('Sekolah@FindSekolahByIdAction', [$request]);

        return $this->transform($sekolah, SekolahTransformer::class);*/
    }

    /**
     * @param GetAllSekolahsRequest $request
     * @return array
     */
    public function getAllSekolahs(Request $request)
    {   
        $paginate = 10;
        $input = $request->input();

        //print_r($input);
        $querySekolah = Sekolah::selectRaw("idsekolah, namasekolah, alamat, foto");
        if(isset($input['idsekolah']) && !empty($input['idsekolah'])){
            $querySekolah->whereRaw("idsekolah = ?",[$input['idsekolah']]);
            //$paginate = $input['idsekolah'];
        }
        if(isset($input['namasekolah']) && !empty($input['namasekolah'])){
            $querySekolah->whereRaw("namasekolah = ?",[$input['namasekolah']]);
            //$paginate = $input['namasekolah'];
        }
        if(isset($input['paging']) && intval($input['paging']) > 0){
            $paginate = $input['paging'];
        }
        $sekolahs = $querySekolah->paginate($paginate);
        $data = [];
        $i = 1;
        if(!empty($sekolahs)){
            foreach($sekolahs as $sekolah){
                $data[] = [
                    'No' => $i++,
                    'idsekolah' => $sekolah->idsekolah,
                    'namasekolah' => $sekolah->namasekolah,
                    'alamat' => $sekolah->alamat,
                    'foto' => $sekolah->foto
                ];
            }
            //$sekolahs = Apiato::call('Sekolah@GetAllSekolahsAction', [$request]);
            return response()->json(["Data" => $data, "Code" => 203]);
        }else{
            return response()->json(["Message" => "Data is Empty", "Code" => 500]);
        }
        //return $this->transform($sekolahs, SekolahTransformer::class);
    }

    /**
     * @param UpdateSekolahRequest $request
     * @return array
     */
    public function updateSekolah(UpdateSekolahRequest $request)
    {
        $fields = ['namasekolah'];

        $input = $request->input();


        $imageName = "fotosiswa/images".date("Y-m-d H:i:s").".jpeg";    
        Storage::disk('local')->put($imageName,$input["foto"]);
        $data = $request->sanitizeInput($fields);
        
        $sekolah = new Sekolah();
        $checkNamaSekolah = $sekolah->checkNamaSekolah($data["namasekolah"]);
        if($checkNamaSekolah > 0){
            return response()->json(["Message" => "Nama Sekolah yang anda masukkan sudah Tersedia", "Code" => 500]);
        }
        $sekolah = null;

        try{
            $sekolah = Sekolah::whereRaw("idsekolah = ?",[$input['idsekolah']])->first();    
            $sekolah->namasekolah = $data['namasekolah'];
            $sekolah->alamat = $input["alamat"];
            $sekolah->foto = $imageName;
            $sekolah->save();
            return response()->json(["Message" => "Sekolah Sukses Diubah", "Code" => 201]);
        }catch(QueryException $e){
            return response()->json(["Message" => "Sekolah Gagal Diubah", "Code" => 500]);
        }
        /*$sekolah = Apiato::call('Sekolah@UpdateSekolahAction', [$request]);

        return $this->transform($sekolah, SekolahTransformer::class);*/
    }

    /**
     * @param DeleteSekolahRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteSekolah(DeleteSekolahRequest $request)
    {
        $input = $request->input();
        try{
            Sekolah::whereRaw("idsekolah = ?",[$input['idsekolah']])->delete();
            return response()->json(["Message" => "Sekolah Sukses Dihapus", "Code" => 200]);
        }catch(QueryException $e){
            return response()->json(["Message" => "Sekolah Gagal Dihapus", "Code" => 500]);
        }
        
    }
}
