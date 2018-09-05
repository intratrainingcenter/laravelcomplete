<?php

namespace App\DataTables;
use Illuminate\Support\Facades\DB;
use App\riwayattransaksi;
use Yajra\DataTables\Services\DataTable;

use Illuminate\Support\Facades\Cache;
class datariwayattransaksiDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', 'admin.pages.riwayattransaksi.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(riwayattransaksi $model)
    {
            return DB::table('riwayattransaksis')
            ->join('datapelanggans', 'riwayattransaksis.datapelanggan_id', '=', 'datapelanggans.id')
            ->select('riwayattransaksis.*','datapelanggans.nama');
    
       
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'nama',
            'totalharga',
            'qty',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'datariwayattransaksi_' . date('YmdHis');
    }
}
