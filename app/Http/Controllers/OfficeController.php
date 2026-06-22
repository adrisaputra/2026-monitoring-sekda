<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class OfficeController extends Controller
{
    ## Show Data
    public function index()
    {
        $title = "OPD";
		return view('admin.office.index',compact('title'));
    }

    ## Get Data
    public function get_office_index(Request $request)
    {

        if ($request->ajax()) {
            $counter = 1;

            $office = Office::limit(10);

            return DataTables::of($office)
            ->addIndexColumn()
            ->addColumn('number', function () use (&$counter) {
                return $counter++;
            })
            ->addColumn('action', function ($v) {
                $btn = '<a href="#" onClick="getData('.$v->id.')" id="'.$v->id.'" data-placement="top" title="Edit"  data-toggle="modal" data-target="#exampleModal" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                        </a>';
                $btn .= '<a href="#" onclick="deleteData('.$v->id.')" id="'.$v->id.'" class="warning confirm" data-toggle="tooltip" data-placement="top" title="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                        </a>';
                return $btn;
            })
            ->rawColumns(['action'])->make(true);
        }
        
    }

    public function validate(Request $request, $action)
    {
       if($request->ajax()) {

            $attributes = [
                'name' => 'Nama OPD',
            ];

            if($action==="Simpan"){
                $rules = [
                    'name' => 'required|string|max:255'
                ];
            } else {
                    $rules = [
                    'name' => 'required|string|max:255'
                ];
            }
            
            $validator = Validator::make($request->all(), $rules, [], $attributes);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
                    
            return response()->json(['success' => true]);
        }
    }

    ## Save Data
	public function store(Request $request)
    {
        if ($request->ajax()) {
            $office = New Office();
            $office->fill($request->all());
            $office->save();
            
            activity()->log('Tambah OPD Office');
            return response()->json(['success' => true,'message' => 'Tambah Data OPD Berhasil']);
        }
    }

    ## Get Data
    public function edit(Request $request, Office $office)
    {
        if ($request->ajax()) {
            return response()->json(['success' => true,'data' => $office]);
        }
    }

    ## Edit Data
    public function update(Request $request, Office $office)
    {
        if ($request->ajax()) {
            $office->name = $request->name;
            $office->save();
    
            activity()->log('Ubah Data OPD dengan ID = '.$office->id);
            return response()->json(['success' => true,'message' => 'Ubah Data OPD Berhasil']);
        }
    }

    ## Delete Data
    public function delete(Request $request, $office)
    {
        if ($request->ajax()) {
            $office = Office::where('id',$office)->first();
            $office->delete();
            activity()->log('Hapus Data OPD dengan ID = '.$office->id);
            return response()->json(['success' => true,'message' => 'Hapus Data OPD Berhasil']);
        }
    }

}
