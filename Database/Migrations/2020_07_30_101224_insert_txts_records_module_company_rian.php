<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Modules\Dashboard\Repositories\TxtRepository;

class InsertTxtsRecordsModuleCompanyRian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        TxtRepository::new(['module' => 'CompanyOrDesign', 'service' => 'TxtOrder', 'alias' => 'Pedidos - OrDesign']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        TxtRepository::deleteByAlias('Pedidos - OrDesign');
    }
}
