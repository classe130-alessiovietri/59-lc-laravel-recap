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
        Schema::table('posts', function (Blueprint $table) {
            /* Crea la colonna category_id ->  */
            // $table->unsignedBigInteger('category_id')->nullable()->after('published');

            // /* Aggiunge la foreign key sulla colonna category_id */
            // $table->foreign('category_id')
            //         ->references('id')
            //         ->on('categories');

            /*
                OPPURE, in una sola istruzione
            */

            $table->foreignId('category_id')
                    ->nullable()
                    ->after('published')
                    ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'category_id')) {
                /* PRIMA rimuovo il vincolo di foreign key (altrimenti non posso droppare la colonna) */
                // $table->dropForeign('posts_category_id_foreign');
                // OPPURE
                $table->dropForeign(['category_id']);

                /* E poi droppo la colonna */
                $table->dropColumn('category_id');
            }
        });
    }
};
