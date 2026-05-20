<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dossiers', function (Blueprint $table) {
            $table->id();

            $table->string('numero_reception');

            $table->text('objet');

            $table->unsignedBigInteger('autorite_id')
                ->nullable();

            $table->unsignedBigInteger('nature_id')
                ->nullable();

            $table->date('date_reception');

            $table->date('date_prevision_ppm')->nullable();

            $table->integer('respect_ppm')->nullable();

            $table->date('date_limite_dn')->nullable();

            $table->date('date_probable_signature')->nullable();

            $table->string('reference_lettre_dnccp')->nullable();

            $table->string('numero_bordereau')->nullable();

            $table->date('date_signature_reponse')->nullable();

            $table->unsignedBigInteger('ano_id')
                ->nullable();

            $table->unsignedBigInteger('type_version_id');

            $table->unsignedBigInteger('dossier_parent_id')
                ->nullable();

            $table->date('date_ouverture_offres')->nullable();

            $table->integer('delai_evaluation')->nullable();

            $table->unsignedBigInteger('statut_id');

            $table->integer('temps_traitement')->nullable();

            $table->unsignedBigInteger('created_by')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossiers');
    }
};
