<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\datapelanggandatatable;
use App\datapelanggan as Datapelanggan;
use App\Repositories\Repository;
use Flash;
use Validator;
class datapelangganController extends Controller
{
    protected $model;

    public function __construct(Datapelanggan $datapelanggan)
    {
        // set the model
        $this->model = new Repository($datapelanggan);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(datapelanggandatatable $dataTable)
    {
        return $dataTable->render('admin.pages.datapelanggan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.datapelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datapelanggan = new Datapelanggan();
        $validator = Validator::make($request->all(),$datapelanggan->rules);
        if ($validator->fails()) {
            return view('admin.pages.datapelanggan.create')->withErrors($validator);
        }
        $this->model->create($request->only($this->model->getModel()->fillable));
        Flash::success('Data Pelanggan sukses di simpan');
        return redirect(route('datapelanggan.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agama = $this->model->show($id);

        if (empty($agama)) {
            Flash::error('Agama not found');

            return redirect(route('agamas.index'));
        }

        return view('admin.pages.datapelanggan.show')->with('datapelanggan', $agama);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agama = $this->model->show($id);

        if (empty($agama)) {
            Flash::error('Agama not found');

            return redirect(route('datapelanggan.index'));
        }

        return view('admin.pages.datapelanggan.edit')->with('datapelanggan', $agama);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //DD($request->all());
        $this->model->update($request->only($this->model->getModel()->fillable), $id);
        Flash::success('Data Pelanggan sukses di Ubah');
         return redirect(route('datapelanggan.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Datapelanggan::withTrashed()
                ->where('id', 1)
                ->get();
        Flash::success('Data Pelanggan sukses di hapus');
        return redirect(route('datapelanggan.index'));
    }
}
