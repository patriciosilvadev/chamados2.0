<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->morphs('area');
            $table->unsignedBigInteger('environment_id')->nullable();
            $table->unsignedBigInteger('spot_id')->nullable();
            $table->unsignedBigInteger('sector_id');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->longText('description');
            $table->tinyInteger('execution_by')->default(1); // 1 => mão de obra própria; 0 => mão de obra terceirizada;
            $table->string('attached_file_name')->nullable();
            $table->tinyInteger('status'); // 0 => concluído; 1 => aberto; 2 => andamento; 3 => recusado; 4 => em análise;
            $table->timestamp('desired_date')->nullable()->default(null); // preenchido pelo solicitante na criacao da OS;
            $table->timestamp('expected_date')->nullable()->default(null); // preenchido pelo suporte na atualização para status 2;
            $table->timestamp('real_date')->nullable()->default(null); // preenchido pelo suporte na atualização para status 0;
            $table->integer('expected_hours')->nullable()->default(null); // preenchido pelo suporte ao mudar o status para 2;
            $table->integer('real_hours')->nullable()->default(null); // preenchido pelo suporte ao mudar o status para 0;
            $table->json('done_by')->nullable()->default(null); // preenchido pelo suporte indicando um array com ids dos atendentes;
            $table->string('recurrent')->nullable();
            $table->timestamps();

            $table->foreign('environment_id')->references("id")->on("environments");
            $table->foreign('spot_id')->references("id")->on("spots");
            $table->foreign('sector_id')->references("id")->on("sectors");
            $table->foreign('service_id')->references("id")->on("services");
            $table->foreign('user_id')->references("id")->on("admin.users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supports');
    }
}
